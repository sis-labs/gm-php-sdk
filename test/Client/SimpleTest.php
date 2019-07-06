<?php

namespace GmaTest\ApiClient;

use PHPUnit\Framework\TestCase;
use \Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\RequestInterface;

use GuzzleHttp\Handler\MockHandler;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

use Gma\ApiClient\Client\Simple;

function add_header($header, $value)
{
    return function (callable $handler) use ($header, $value) {
        return function (
            RequestInterface $request,
            array $options
        ) use ($handler, $header, $value) {
            $request = $request->withHeader($header, $value);
            return $handler($request, $options);
        };
    };
}

class SimpleTest extends TestCase {

  public function testClient() {
    // GIVEN
    
    // WHEN
    
    // THEN
    $this->assertTrue(true);
  }
  
  public function testMiddlewareUsage() {
    // GIVEN
    $url = "http://192.168.1.101:3003";
    $resource = "/reactions";
    
    // WHEN
    $stack = new HandlerStack();
    $stack->setHandler(new CurlHandler());
    $stack->push(add_header('x-correlation-id', (string)Uuid::uuid4()));
    $stack->push(add_header('User-agent', 'gm-php-sdk'));
    $client = new HttpClient(['base_uri' => $url, 'handler' => $stack]);
    
    // THEN
    $response = $client->request('GET', $resource);
    $this->assertEquals(200, $response->getStatusCode());
    $c = \explode(';', $response->getHeader('content-type')[0]);
    $this->assertEquals("application/json", $c[0]);
    $r = json_decode($response->getBody());
    $this->assertEquals("this is a test", $r->content);
  }

  public function testMiddleware() {
      // GIVEN
      $url = "http://192.168.1.101:3003";
      $resource = "/reactions";

      $stack = new HandlerStack();
      $stack->setHandler(new CurlHandler());
      $stack->push(Middleware::mapRequest(function(RequestInterface $request) {
        return $request->withHeader('x-correlation-id', (string)Uuid::uuid4());
      }));
      $stack->push(Middleware::mapRequest(function(RequestInterface $request) {
        return $request->withHeader('User-agent', 'gm-php-sdk');
      }));
      $stack->push(Middleware::mapRequest(function(RequestInterface $request) {
        return $request->withHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c');
      }));
      $client = new HttpClient(['base_uri' => $url, 'handler' => $stack]);

      // WHEN
      $response = $client->request('GET', $resource);

      // THEN
      $this->assertEquals(200, $response->getStatusCode());
      $c = \explode(';', $response->getHeader('content-type')[0]);
      $this->assertEquals('application/json', $c[0]);
      $r = json_decode($response->getBody());
      $this->assertEquals('this is a test', $r->content);
  }

  public function testGuzzleMockHandler() {
      // GIVEN
      $url = 'http://192.168.1.101:3003';
      $resource = '/reactions';

      $mock = new MockHandler([
          new Response(200, ['content-type' => 'application/json'])
      ]);

      $stack = HandlerStack::create($mock);
      $client = new HttpClient(['handler' => $stack]);
      
      // WHEN
      $response = $client->request('GET', $resource);

      // THEN
      $this->assertEquals(200, $response->getStatusCode());
      $c = \explode(';', $response->getHeader('content-type')[0]);
      $this->assertEquals('application/json', $c[0]);
  }

}

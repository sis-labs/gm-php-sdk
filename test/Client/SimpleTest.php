<?php

namespace GmaTest\ApiClient;

use PHPUnit\Framework\TestCase;
use \Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\RequestInterface;

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
  
  public function testUsage() {
    // GIVEN
    $url = "http://localhost:3003";
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

}

<?php

namespace GmaTest\ApiClient;

use PHPUnit\Framework\TestCase;
use \Firebase\JWT\JWT;

use Gma\ApiClient\Client\Simple;

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
    $client = new \GuzzleHttp\Client(['base_uri' => $url]);
    
    // THEN
    $response = $client->request('GET', $resource);
    echo $response->getStatusCode();
    echo $response->getHeader('content-type')[0];
    $r = json_decode($response->getBody());
    echo $r->content;
  }

}

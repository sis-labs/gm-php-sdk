<?php

namespace GmaTest\ApiClient\Storage;

use PHPUnit\Framework\TestCase;
use \Mockery;

use Gma\ApiClient\Configuration\ConfigurationInterface;
use Gma\ApiClient\Storage\SessionStorageService;
use Gma\ApiClient\Storage\StorageAdapter;

class SessionStorageServiceTest extends TestCase {

  public function tearDown() {
    \Mockery::close();
  }

  public function testGetReadToken() {
    // GIVEN
    $key = 'access_token';
    $adapter = Mockery::mock('Gma\ApiClient\Storage\StorageAdapter');
    $adapter->shouldReceive('get')
      ->with('access_token')
      ->times(1)
      ->andReturn('test');
    
    // WHEN
    $service = new SessionStorageService($key, $adapter);
    $value = $service->getToken($key);
    
    // THEN
    $this->assertEquals('test', $value);
  }
  
  public function testWriteToken() {
    // GIVEN
    $key = 'access_token';
    $value = 'sampleValue';
    $adapter = Mockery::mock('Gma\ApiClient\Storage\StorageAdapter');
    $adapter->shouldReceive('set')
      ->with('access_token', 'sampleValue')
      ->times(1);
    
    // WHEN
    $service = new SessionStorageService($key, $adapter);
    $service->store($value);
    
    // THEN
    $this->assertTrue(true); // making a fake assertion to avoid phpunit exception
  }
}


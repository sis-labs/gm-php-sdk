<?php

namespace GmaTest\ApiClient\Storage;

use PHPUnit\Framework\TestCase;
use \Mockery;

use Gma\ApiClient\Storage\AbstractTokenStorageFactory;
use Gma\ApiClient\Storage\AccessTokenStorageFactory;
use Gma\ApiClient\Storage\StorageFactory;
use Gma\ApiClient\Storage\RefreshTokenStorageFactory;
use Gma\ApiClient\Configuration\ConfigurationInterface;

class AbstractTokenStorageFactoryTest extends TestCase {

  private function check($cl, $type) {
    // GIVEN
    $configuration = Mockery::mock('ConfigurationInterface');
    $buildRecipe = [
      'type' => 'session',
      'security' => 'none',
      'configuration' => $configuration,
      'key' => 'access_token',
      'auto_erase' => true
    ];
    
    // WHEN
    $factory = AbstractTokenStorageFactory::create($type, $buildRecipe, $configuration, null);
    
    // THEN
    $this->assertInstanceOf($cl, $factory);
  }
  
  public function testAccessToken() {
    $this->check(AccessTokenStorageFactory::class, StorageFactory::ACCESS_TOKEN);
  }
  
  public function testRefreshToken() {
    $this->check(RefreshTokenStorageFactory::class, StorageFactory::REFRESH_TOKEN);
  }
  /**
   * @expectedException     \Exception
   */
  public function testWrongType() {
    $this->check(null, 'wrongType');
  }
}


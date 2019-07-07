<?php

namespace Gma\ApiClient\Storage;

use Gma\ApiClient\Configuration\ConfigurationInterface;

class StorageFactory {

  const ACCESS_TOKEN = 'access_token';
  const REFRESH_TOKEN = 'refresh_token';

  protected $factories = [
    self::ACCESS_TOKEN => null,
    self::REFRESH_TOKEN => null,
  ];
  
  private static $instance;

  public static function getInstance() {
    if(null == self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }
  
  public function compose(ConfigurationInterface $configuration, $storageConfiguration, $registry) : StorageFactory {
    array_walk($storageConfiguration, function($recipe, $key) use ($configuration, $registry) {
      $consolidatedRecipe = array_merge([
        'security' => 'none',
        'auto_erase' => false,
        'configuration' => $configuration
      ], $recipe);
      $this->factories[$key] = AbstractTokenStorageFactory::create($key, $consolidatedRecipe, $configuration, $registry);
    });
    return $this;
  }
  
  private function getTokenFactory($name) {
    return $this->factories[$name];
  }
  
  public final function getAccessTokenFactory() {
    return $this->getTokenFactory(self::ACCESS_TOKEN);
  }
  
  public final function getRefreshTokenFactory() {
    return $this->getTokenFactory(self::REFRESH_TOKEN);
  }
}

<?php

namespace Gma\ApiClient\Storage;
use Gma\ApiClient\Storage\RefreshTokenStorageFactory;
use Gma\ApiClient\Storage\AccessTokenStorageFactory;

abstract class AbstractTokenStorageFactory {

  public static function create($type, $buildRecipe, $configuration, $registry) {
    switch($type) {
      case StorageFactory::REFRESH_TOKEN:
        return new RefreshTokenStorageFactory($configuration, $buildRecipe, $registry);
      case StorageFactory::ACCESS_TOKEN:
        return new AccessTokenStorageFactory($configuration, $buildRecipe, $registry);
      default:
        throw new \Exception("Wrong type of token requested to setup the factory stack");
    }
  }
  
  protected $configuration;
  protected $buildRecipe;
  protected $registry;
  protected $reader = null;
  protected $writer = null;
  
  protected abstract function buildReader();
  protected abstract function buildWriter();
  
  private function setupStack() {
    $baseTokenWriter = sprintf('%sTokenWriter', $this->buildRecipe['type']);
    $baseTokenWriter = $this->registry->get($baseTokenWriter); // should create a new instance
    $baseTokenReader = sprintf('%sTokenReader', $this->buildRecipe['type']);
    $baseTokenReader = $this->registry->get($baseTokenReader); // should create a new instance
  }
  
  public function __construct($configuration, $buildRecipe, $registry) {
    $this->configuration = $configuration;
    $this->buildRecipe = $buildRecipe;
    $this->registry = $registry;
  }

  public function getReader() {
    if(null == $this->reader) {
      $this->buildReader();
    }
    return $this->reader();
  }
  
  public function getWriter() {
    if(null == $this->writer) {
      $this->buildWriter();
    }
    return $this->writer();
  }
}


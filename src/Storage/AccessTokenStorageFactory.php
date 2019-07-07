<?php

namespace Gma\ApiClient\Storage;

final class AccessTokenStorageFactory extends AbstractTokenStorageFactory {

  public function __construct($configuration, $buildRecipe, $registry) {
    parent::__construct($configuration, $buildRecipe, $registry);
  }

  protected function buildReader() {
    throw new \Exception('not implemented yet');
  }
  
  protected function buildWriter() {
    throw new \Exception('not implemented yet');
  }
}

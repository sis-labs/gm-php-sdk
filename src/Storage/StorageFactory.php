<?php

namespace Gma\ApiClient\Storage;

use Gma\ApiClient\Configuration\ConfigurationInterface;

abstract class StorageFactory {
  public static function compose(ConfigurationInterface $configuration, $storageConfiguration) : StorageFactory {
    return null;
  }
}

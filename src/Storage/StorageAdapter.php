<?php

namespace Gma\ApiClient\Storage;

interface StorageAdapter {
  function get($key);
  function set($key, $value);
}

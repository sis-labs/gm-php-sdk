<?php

namespace Gma\ApiClient\Storage;

class InMemoryStorageAdapter {
  private $data = [];
  
  public function get($key) {
    if(array_key_exists($key, $this->data) {
      return $this->data[$key];
    }
    return null;
  }
  
  public function set($key, $value) {
    $this->data[$key] = $value;
  }
}

<?php

namespace Gma\ApiClient\Storage;

class SessionStorageAdapter {
  public function get($key) {
    if(array_key_exists($key, $_SESSION) {
      return $_SESSION[$key];
    }
    return null;
  }
  
  public function set($key, $value) {
    $_SESSION[$key] = $value;
  }
}

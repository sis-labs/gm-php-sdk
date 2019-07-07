<?php

namespace Gma\ApiClient\Storage;

use Gma\ApiClient\Storage\TokenReaderInterface;
use Gma\ApiClient\Storage\TokenWriterInterface;
use Gma\ApiClient\Storage\StorageAdapter;
use Gma\ApiClient\Storage\SessionStorageAdapter;


class SessionStorageService implements TokenReaderInterface, TokenWriterInterface {

  private $key; // storage key in the session
  private $adapter;
  
  public function __construct($key, StorageAdapter $adapter = null) {
    $this->key = $key;
    $this->adapter = $adapter ?? new SessionStorageAdapter();
  }

  public function getToken(): string {
    return $this->adapter->get($this->key);
  }
  
  public function store(string $token) {
    return $this->adapter->set($this->key, $token);
  }
}


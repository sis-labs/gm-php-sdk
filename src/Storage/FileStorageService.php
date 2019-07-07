<?php

namespace Gma\ApiClient\Storage;

use Gma\ApiClient\Storage\TokenReaderInterface;
use Gma\ApiClient\Storage\TokenWriterInterface;
use Gma\ApiClient\Storage\StorageAdapter;
use Gma\ApiClient\Storage\SessionStorageAdapter;

class FileStorageService implements TokenReaderInterface, TokenWriterInterface {

  private $filename;
  
  public function __construct($filename) {
    $this->filename = $filename;
  }

  public function getToken(): string {
    return file_get_contents($this->filename);
  }
  
  public function store(string $token) {
    file_put_contents($this->filename, $token);
  }

}
 

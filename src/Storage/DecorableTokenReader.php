<?php

namespace Gma\ApiClient\Storage;

use Gma\ApiClient\Storage\TokenReaderInterface;

abstract class DecorableTokenReader implements TokenReaderInterface {

  private $reader;
  
  public function __construct(TokenReaderInterface $reader) {
    $this->reader = $reader;
  }
}


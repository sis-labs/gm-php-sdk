<?php

namespace Gma\ApiClient\Storage;

use Gma\ApiClient\Storage\TokenWriterInterface;

abstract class DecorableTokenWriter implements TokenWriterInterface {

  private $writer;
  
  public function __construct(TokenWriterInterface $writer) {
    $this->writer = $writer;
  }
}


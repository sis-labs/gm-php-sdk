<?php

namespace Gma\ApiClient\Storage;

use phpseclib\Crypt\RSA;

use Gma\ApiClient\Storage\TokenWriterInterface;
use Gma\ApiClient\Storage\DecorableTokenWriter;

class RsaStorageTokenWriter extends DecorableTokenWriter implements TokenWriterInterface {

  private $key; // the public key here
  private $passphrase;
  
  public function __construct($writer, $key, $passphrase) {
    parent::__construct($writer);
    $this->key = $key;
    $this->passphrase = $passphrase;
  }

  public function store(string $token) {
    $rsa = new RSA();
    $rsa->loadKey($this->key);
    $this->writer->store($rsa->encrypt($token));
  }
}


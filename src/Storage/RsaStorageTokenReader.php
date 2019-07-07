<?php

namespace Gma\ApiClient\Storage;

use phpseclib\Crypt\RSA;

use Gma\ApiClient\Storage\TokenReaderInterface;
use Gma\ApiClient\Storage\DecorableTokenReader;

class RsaStorageTokenReader extends DecorableTokenReader implements TokenReaderInterface {

  private $key; // the private key here
  private $passphrase;
  
  public function __construct($reader, $key, $passphrase) {
    parent::__construct($reader);
    $this->key = $key;
    $this->passphrase = $passphrase;
  }

  public function getToken(): string {
    $data = $this->reader->getToken();
    $rsa = new RSA();
    $rsa->loadKey($this->key);
    return $rsa->decrypt($data);
  }
}


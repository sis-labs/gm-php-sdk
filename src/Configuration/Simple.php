<?php

namespace Gma\ApiClient\Configuration;

interface Simple implements Conrfiguration {

  private $configuration = [];
  
  public function __construct(array $conf) {
    $this->configuration = $conf;
  }
  
  function get($key) {
    if(array_key_exists($key, $this->configuration)) {
      return $this->configuration[$key];
    }
    throw new \Exception("Key not found");
  }
  
  function getBaseURI() {
    return $this->configuration['baseUri'];
  }
  
  function getClientId() {
    return $this->configuration['clientId'];
  }
  
  function getClientSecret() {
    return $this->configuration['clientSecret'];
  }
  
  function getIssuer() {
    return $this->configuration['issuer'];
  }
  
  function getAudience() {
    return $this->configuration['audience'];
  }
  
  function getGmPublicKey() {
    return $this->configuration['gmPublicKey'];
  }
  
  function getPrivateKey() {
    return $this->configuration['privateKey'];
  }
  
  function getPassphrase() {
    return $this->configuration['passphrase'];
  }
  
  function getTimeout() {
    return $this->configuration['timeout'];
  }
}

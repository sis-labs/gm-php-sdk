<?php

namespace Gma\ApiClient\Configuration;

class Simple extends AbstractConfiguration implements Conrfiguration {

  private $configuration = [];
  
  public function __construct(array $conf) {
    $this->configuration = $conf;
  }
  
  public function get($key, $default = null) {
    if(array_key_exists($key, $this->configuration)) {
      return $this->configuration[$key];
    }
    return $default;
  }

  public function getOAuthServerBaseURI() {
      
  }
  
  public function getBaseURI() {
    return $this->configuration[self::BASE_URI];
  }
  
  public function getClientId() {
    return $this->configuration[self::CLIENT_ID];
  }
  
  public function getClientSecret() {
    return $this->configuration[self::CLIENT_SECRET];
  }
  
  public function getIssuer() {
    return $this->configuration[self::ISSUER];
  }
  
  public function getAudience() {
    return $this->configuration[self::AUDIENCE];
  }
  
  public function getGmPublicKey() {
    return $this->configuration[self::GM_PUBLIC_KEY];
  }
  
  public function getPrivateKey() {
    return $this->configuration[self::PRIVATE_KEY];
  }
  
  public function getPassphrase() {
    return $this->configuration[self::PASSPHRASE];
  }
  
  public function getTimeout() {
    return $this->configuration[self::TIMEOUT];
  }

  public function getScopes() {
    return $this->configuration[self::SCOPES];
  }
}

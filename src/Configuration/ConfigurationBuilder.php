<?php

namespace Gma\ApiClient\Configuration;

/**
 * Simple definition of the configuration
 */
class ConfigurationBuilder {
  private $data = [];
  
  private function __construct() {
    // nothing to do right now
  }
  
  public static function create() {
    return new self();
  }
  
  public function setBaseURI($baseUri): ConfigurationBuilder {
    $this->data['baseUri'] = $baseUri;
    return $this;
  }
  
  public function setClientId($clientId): ConfigurationBuilder {
    $this->data['clientId'] = $clientId;
    return $this;
  }
  
  public function setClientSecret($clientSecret): ConfigurationBuilder {
    $this->data['clientSecret'] = $clientSecret;
    return $this;
  }
  
  public function setAudience($audience): ConfigurationBuilder {
    $this->data['audience'] = $audience;
    return $this;
  }
  
  public function setGmPublicKey($gmPublicKey): ConfigurationBuilder {
    $this->data['gmPublicKey'] = $gmPublicKey;
    return $this;
  }
  
  public function setPrivateKey($privateKey): ConfigurationBuilder {
    $this->data['privateKey'] = $privateKey;
    return $this;
  }
  
  public function setPassphrase($passphrase): ConfigurationBuilder {
    $this->data['passphrase'] = $passphrase;
    return $this;
  }
  
  public function setTimeout($timeout): ConfigurationBuilder {
    $this->data['timeout'] = $timeout;
    return $this;
  }
  
  public function build(): ConfigurationInterface {
    return new Simple($this->data);
  }
}

<?php

namespace Gma\ApiClient\Configuration;

use Gma\ApiClient\Configuration\AbstractConfiguration as BaseConfiguration;

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
    $this->data[BaseConfiguration::BASE_URI] = $baseUri;
    return $this;
  }
  
  public function setOauthServerURI($uri): ConfigurationBuilder {
    $this->data[BaseConfiguration::OAUTH_SERVER_URI] = $uri;
    return $this;
  }
  
  public function setClientId($clientId): ConfigurationBuilder {
    $this->data[BaseConfiguration::CLIENT_ID] = $clientId;
    return $this;
  }
  
  public function setClientSecret($clientSecret): ConfigurationBuilder {
    $this->data[BaseConfiguration::CLIENT_SECRET] = $clientSecret;
    return $this;
  }
  
  public function setAudience($audience): ConfigurationBuilder {
    $this->data[BaseConfiguration::AUDIENCE] = $audience;
    return $this;
  }
  
  public function setGmPublicKey($gmPublicKey): ConfigurationBuilder {
    $this->data[BaseConfiguration::GM_PUBLIC_KEY] = $gmPublicKey;
    return $this;
  }
  
  public function setPrivateKey($privateKey): ConfigurationBuilder {
    $this->data[BaseConfiguration::PRIVATE_KEY] = $privateKey;
    return $this;
  }
  
  public function setPassphrase($passphrase): ConfigurationBuilder {
    $this->data[BaseConfiguration::PASSPHRASE] = $passphrase;
    return $this;
  }
  
  public function setTimeout($timeout): ConfigurationBuilder {
    $this->data[BaseConfiguration::TIMEOUT] = $timeout;
    return $this;
  }
  
  public function setIssuer($issuer): ConfigurationBuilder {
    $this->data[BaseConfiguration::ISSUER] = $issuer;
    return $this;
  }
  
  public function setScopes($scopes): ConfigurationBuilder {
    $this->data[BaseConfiguration::SCOPES] = $scopes;
    return $this;
  }
  
  public function build(): ConfigurationInterface {
    return new Simple($this->data);
  }
}

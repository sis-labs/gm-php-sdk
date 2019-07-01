<?php

namespace Gma\ApiClient;

use Gma\ApiClient\Configuration\ConfigurationInterface as Configuration;

class Simple extends Base {

  public function __construct(Configuration $configuration, $httpClient) {
    parent::__construct($configuration, $httpClient);
  }
  
  public function initialize() {}
  
  public function get($resourceUrl) {}
  
  public function post($resourceUrl, $payload) {}
  
  public function put($resourceUrl, $payload, $version) {}
  
  public function patch($resourceUrl, $diff, $version) {}
  
  public function delete($resourceUrl, $id, $version) {}

}

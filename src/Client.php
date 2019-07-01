<?php

namespace Gma\ApiClient;

use Gma\ApiClient\Configuration\ConfigurationInterface as Configuration;

class Client {

  private configuration;
  private client;
  
  public function __construct(Configuration $configuration) {
    $this->configuration = $configuration;
    $this->client = new GuzzleHttp\Client();
  }
  
  public function initialize() {}
  public function initializeAsync() {}
  
  public function get($resourceUrl) {}
  function function getAsync($resourceUrl);
  
  public function post($resourceUrl, $payload) {}
  public function postAsync($resourceUrl, $payload) {}
  
  public function put($resourceUrl, $payload, $version) {}
  public function putAsync($resourceUrl, $payload, $version) {}
  
  public function patch($resourceUrl, $diff, $version) {}
  public function patchAsync($resourceUrl, $diff, $version) {}
  
  public function delete($resourceUrl, $id, $version) {}
  public function deleteAsync($resourceUrl, $id, $version) {}

}

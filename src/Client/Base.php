<?php

namespace Gma\ApiClient\Client;

use Gma\ApiClient\Configuration\ConfigurationInterface as Configuration;
use Psr\Http\Message\RequestInterface;

function add_header($header, $value)
{
    return function (callable $handler) use ($header, $value) {
        return function (
            RequestInterface $request,
            array $options
        ) use ($handler, $header, $value) {
            $request = $request->withHeader($header, $value);
            return $handler($request, $options);
        };
    };
}

abstract class Base {
  protected configuration;
  protected httpClient;
  
  public function __construct(Configuration $configuration, $httpClient) {
    $this->configuration = $configuration;
    $this->httpClient = $httpClient;
    //$this->client = new GuzzleHttp\Client();
  }
}

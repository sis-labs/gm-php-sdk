<?php

namespace Gma\ApiClient\Configuration;

interface ConfigurationInterface {
  function get($key);
  function getBaseURI();
  function getClientId();
  function getClientSecret();
  function getIssuer();
  function getAudience();
  function getGmPublicKey();
  function getPrivateKey();
  function getPassphrase();
  function getTimeout();
}

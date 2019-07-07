<?php

namespace GmaTest\ApiClient\Configuration;

use PHPUnit\Framework\TestCase;
use Gma\ApiClient\Configuration\ConfigurationBuilder;
use Gma\ApiClient\Configuration\AbstractConfiguration as BaseConfiguration;

class ConfigurationBuilderTest extends TestCase {

  public function testBuilder() {
    // GIVEN
    $baseUri = 'https://api.gm.ch';
    $oauthServerUri = 'https://oauth.gm.ch';
    $clientId = 'client_id';
    $clientSecret = 'client_secret';
    $audience = 'rest-api-test';
    $gmPublicKey = 'thepublickey';
    $privateKey = 'theprivatekey';
    $passphrase = 'passphrase';
    $timeout = 10;
    $scopes = 'ALL';
    $issuer = 'me';
    
    // WHEN
    $configuration = ConfigurationBuilder::create()
      ->setBaseURI($baseUri)
      ->setOauthServerURI($oauthServerUri)
      ->setClientId($clientId)
      ->setClientSecret($clientSecret)
      ->setAudience($audience)
      ->setGmPublicKey($gmPublicKey)
      ->setPrivateKey($privateKey)
      ->setPassphrase($passphrase)
      ->setTimeout($timeout)
      ->setScopes($scopes)
      ->setIssuer($issuer)
      ->build();
    
    // THEN
    $vars = array_diff_key(get_defined_vars(), ['configuration' => '']);
    foreach($vars as $k => $v) {
      $m = ($k == 'oauthServerUri') ? 'getOAuthServerBaseURI': 'get' . ucfirst($k);
      $this->assertEquals($v, $configuration->$m());
    }
  }
}

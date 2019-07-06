<?php

namespace GmaTest\ApiClient\Configuration;

use PHPUnit\Framework\TestCase;
use Gma\ApiClient\Configuration\Simple as SimpleConfiguration;
use Gma\ApiClient\Configuration\AbstractConfiguration as BaseConfiguration;

class SimpleTest extends TestCase {

    public function testGetSuccess() {
        // GIVEN
        $stack = [
            BaseConfiguration::CLIENT_ID => 'my_client_id'
        ];
        $configuration = new SimpleConfiguration($stack);

        // WHEN
        $clientId = $configuration->get(BaseConfiguration::CLIENT_ID);

        // THEN
        $this->assertEquals('my_client_id', $clientId);
    }

    public function testGetFallbackToDefaultValue() {
        // GIVEN
        $configuration = new SimpleConfiguration([]);

        // WHEN
        $clientId = $configuration->get(BaseConfiguration::CLIENT_ID, 'my_client_id');

        // THEN
        $this->assertEquals('my_client_id', $clientId);
    }

    public function testGetFallbackToNull() {
        // GIVEN
        $configuration = new SimpleConfiguration([]);

        // WHEN
        $clientId = $configuration->get(BaseConfiguration::CLIENT_ID);

        // THEN
        $this->assertNull($clientId);
    }

    // this can be simplify, I just check functional capabilities of such stuff
    private function perform($stack, $method, $callback) {
        $configuration = new SimpleConfiguration($stack);
        $actual = $configuration->$method();
        $callback($actual);
    }
    

    public function testScopeSuccess() {
        $this->perform([
            BaseConfiguration::SCOPES => 'ALL'
        ], 'getScopes', function($scopes) {
            $this->assertEquals('ALL', $scopes);
        });
    }

    public function testBaseURI() {
        $this->perform([
            BaseConfiguration::BASE_URI => 'http://localhost:3000'
        ], 'getBaseURI' ,function($baseUri) {
            $this->assertEquals('http://localhost:3000', $baseUri);
        });
    }

    public function testOAuthServerBaseURI() {
        $this->perform([
            BaseConfiguration::OAUTH_SERVER_URI => 'http://localhost:3000'
        ], 'getOAuthServerBaseURI', function($uri) {
            $this->assertEquals('http://localhost:3000', $uri);
        });
    }

    public function testClientId() {
        $this->perform([
            BaseConfiguration::CLIENT_ID => 'my_client_id'
        ], 'getClientId', function($clientId) {
            $this->assertEquals('my_client_id', $clientId);
        });
    }

    public function testClientSecret() {
        $this->perform([
            BaseConfiguration::CLIENT_SECRET => 'my_client_secret'
        ], 'getClientSecret', function($clientSecret) {
            $this->assertEquals('my_client_secret', $clientSecret);
        });
    }

    public function testIssuer() {
        $this->perform([
            BaseConfiguration::ISSUER => 'issuer_test'
        ], 'getIssuer', function($issuer) {
            $this->assertEquals('issuer_test', $issuer);
        });
    }

    public function testAudience() {
        $this->perform([
            BaseConfiguration::AUDIENCE => 'test_audience'
        ], 'getAudience', function($audience) {
            $this->assertEquals('test_audience', $audience);
        });
    }

    public function testGmPublicKey() {
        $this->perform([
            BaseConfiguration::GM_PUBLIC_KEY => '--------BEGIN-PUBLIC-KEY--------'
        ], 'getGmPublicKey', function($key) {
            $this->assertEquals('--------BEGIN-PUBLIC-KEY--------', $key);
        });
    }

    public function testPrivateKey() {
        $this->perform([
            BaseConfiguration::PRIVATE_KEY =>  '--------BEGIN-PRIVATE-KEY--------'
        ], 'getPrivateKey', function($key) {
            $this->assertEquals('--------BEGIN-PRIVATE-KEY--------', $key);
        });
    }

    public function testPassphrase() {
        $this->perform([
            BaseConfiguration::PASSPHRASE => 'testtest'
        ], 'getPassphrase', function($passphrase) {
            $this->assertEquals('testtest', $passphrase);
        });
    }

    public function testTimeout() {
        $this->perform([
            BaseConfiguration::TIMEOUT => 20
        ], 'getTimeout', function($timeout) {
            $this->assertEquals(20, $timeout);
        });
    }
}

<?php

namespace GmaTest\ApiClient\Storage;

use PHPUnit\Framework\TestCase;
use \Mockery;
use Gma\ApiClient\Storage\StorageFactory;
use Gma\ApiClient\Storage\ITokenReader;
use Gma\ApiClient\Storage\ITokenWriter;
use Gma\ApiClient\Storage\DecorableTokenReader;
use Gma\ApiClient\Storage\DecorableTokenWriter;
use Gma\ApiClient\Configuration\ConfigurationInterface;

class StorageFactoryTest extends TestCase {

  const privateKey = <<<EOD-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
-----END RSA PRIVATE KEY-----
EOD;

    const publicKey = <<<EOD-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8kGa1pSjbSYZVebtTRBLxBz5H
4i2p/llLCrEeQhta5kaQu/RnvuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t
0tyazyZ8JXw+KgXTxldMPEL95+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4
ehde/zUxo6UvS7UrBQIDAQAB
-----END PUBLIC KEY-----
EOD;

  const gmPublickKey = <<<EOD-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEApx7HorgmJ3t5fYvmqkZN
LJN9cRsHP7RHiT2gyVI62ObwDPJPkcSRW6ubVZ4rXZ1QmPMczFUc0zU/9tdkHpT8
UzIz+4PPBQhIBTB2xsMfbeHXqYysd4xVhnpZ372+/lT5FsPuvxHmwUM7DHF2Tvgk
AFts8ZactkUcEPjCypOEtaZ5gh7N8nUZn6A88Rl0xvMNuRT66AZhbQcB/MPqC+5w
tvEQVaZtin8sGcS8qpKbF0cNnKOOhARJk962em4skozbDYwsvdYW5Pug4WVNSgf5
5KyG+wcgJO65bzkvjycTmtNkgr0IsN8RfKUeWBPhEZ4VE+EySAl2g511cHkX59g+
GihFYwE/4aS0vnoL/2gCzqh8j+5klbF20sLvjgkrfD3aaE6f5fNLeUDOjuxvMHOL
AJXZqC85g1gFz2lEV4ruYYxRafAHHF8OB+WLXqkYGdNXbBr4ZbIgvEpY+BxM/P50
NV0SeD0y1COljwWMIdf3kASGyDWcTE9QFe3KFPY18U0/Kogv3vIHe84N/9k8PYpn
7eQfGvi2VuRgEJzQN5/fGumi1EDHJFpnEi4UxuufzDMlMLgWL0/5OUXjNegW/m/w
BL+fsfw3QFOfFXIRuFj9etHmHYzRrfOVhIddFJbRiTIb548urkOOEZV3HML133cO
jev5DX4XjbBN0zsUczkE14sCAwEAAQ==
-----END PUBLIC KEY-----
EOD;

  public function tearDown() {
      Mockery::close();
  }

  public function testCompose() {
    // GIVEN
    $configuration = Mockery::mock('ConfigurationInterface');
    /*
    $configuration->shouldReceive([
      'getGmPublicKey' => self::gmPublickKey,
      'getPrivateKey' => self::privateKey,
      'getPassphrase' => 'testtest'
    ]);
    */

    $storageFactoryConfiguration = [
      'access_token' => [
        'type': 'session',
        'security' => 'none',
        'configuration' => $configuration,
        'key': 'access_token',
        'auto_erase': true
      ],
      'refresh_token' => [
        'type' => 'file',
        'security' => 'rsa',
        'configuration' => $configuration,
        'key': 'refresh_token',
        'auto_erase' => true
      ],
    ];
    
    // WHEN
    $storageFactory = StorageFactory::compose($configuration, $storageFactoryConfiguration);
    $accessTokenReader = $storageFactory->getAccessTokenReader();
    $accessTokenWriter = $storageFactory->getAccessTokenWriter();
    $refreshTokenReader = $storageFactory->getRefreshTokenReader();
    $refreshTokenWriter = $storageFactory->getRefreshTokenWriter();
    
    // THEN
    $this->assertInstanceOf(ITokenReader::class, $accessTokenReader);
    $this->assertInstanceOf(ITokenReader::class, $refreshTokenReader);
    $this->assertInstanceOf(ITokenWriter::class, $accessTokenWriter);
    $this->assertInstanceOf(ITokenWriter::class, $refreshTokenWriter);
    
    $this->assertInstanceOf(DecorableTokenReader::class, $accessTokenReader);
    $this->assertInstanceOf(DecorableTokenReader::class, $refreshTokenReader);
    $this->assertInstanceOf(DecorableTokenWriter::class, $accessTokenWriter);
    $this->assertInstanceOf(DecorableTokenWriter::class, $refreshTokenWriter);
    
    $this->assertInstanceOf(SessionTokenReader::class, $accessTokenReader);
    $this->assertInstanceOf(SessionTokenWriter::class, $accessTokenWriter);
    
    $this->assertInstanceOf(FileTokenReader::class, $refreshTokenReader);
    $this->assertInstanceOf(FileTokenWriter::class, $refreshTokenWriter);
  }
}

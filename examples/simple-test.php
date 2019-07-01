<?php

namespace GmaTest\ApiClient;

use PHPUnit\Framework\TestCase;
use \Firebase\JWT\JWT;

use Gma\ApiClient\Client;

class ClientTest extends TestCase {

  const privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
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

    const publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8kGa1pSjbSYZVebtTRBLxBz5H
4i2p/llLCrEeQhta5kaQu/RnvuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t
0tyazyZ8JXw+KgXTxldMPEL95+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4
ehde/zUxo6UvS7UrBQIDAQAB
-----END PUBLIC KEY-----
EOD;

  public function testClient() {
    // GIVEN
    $issuer = "server.mydom.com";
    $audience = "gm-rest-api-name";
    $issuedAt = 1561917071;
    $noBefore = 1561910000;
    $token = array(
        "iss" => $issuer,
        "aud" => $audience,
        "iat" => $issuedAt,
        "nbf" => $noBefore
    );
  
    // WHEN
    $jwt = JWT::encode($token, self::privateKey, 'RS256');
    $decoded = JWT::decode($jwt, self::publicKey, array('RS256'));

    // THEN
    $expectedJwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJzZXJ2ZXIubXlkb20uY29tIiwiYXVkIjoiZ20tcmVzdC1hcGktbmFtZSIsImlhdCI6MTU2MTkxNzA3MSwibmJmIjoxNTYxOTEwMDAwfQ.eFsfI4IVWINSeI9AO24YUsis-lyNBTQ1lIOmDCu_yKJsSthcqJRwW4Atq4p4JFduPGCW_FXKGJKk_ss7OtHn5obQslwjfrPey8EidyFRes05thZ_ojlIRsbi9rezxEjhOj1sdt8d_wYtCnwF1rKdSbDlAAzumps_PXnWC-IWqqY";
    $this->assertEquals($expectedJwt, $jwt);
    $this->assertEquals($issuer, $decoded->iss);
    $this->assertEquals($audience, $decoded->aud);
    $this->assertEquals($issuedAt, $decoded->iat);
    $this->assertEquals($noBefore, $decoded->nbf);
    $decoded_array = (array) $decoded;
    $this->assertEquals($issuer, $decoded_array['iss']);
    $this->assertEquals($audience, $decoded_array['aud']);
    $this->assertEquals($issuedAt, $decoded_array['iat']);
    $this->assertEquals($noBefore, $decoded_array['nbf']);
  }

}

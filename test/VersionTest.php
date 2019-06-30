<?php

namespace GmaTest\ApiClient;

use PHPUnit\Framework\TestCase;
use Gma\ApiClient\Version;

class VersionTest extends TestCase {

  public function testVersion() {
    // GIVEN
    $version = Version::getVersion();
    $expected = "0.0.1";
    
    // WHEN
    $actual = $version->toString();
    
    // THEN
    $this->assertEquals($expected, $actual);
  }

}

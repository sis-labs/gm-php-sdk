<?php

namespace Gma\ApiClient;

class Version {
  const Major = '0';
  const Minor = '0';
  const Patch = '1';
  
  private function __construct() {}
  
  public static function getVersion() {
    return new self();
  }
  
  public function toString() {
    return sprintf("%s.%s.%s", self::Major, self::Minor, self::Patch);
  }
}

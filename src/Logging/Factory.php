<?php

namespace Gma\ApiClienet\Logging;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class LoggingFactory {
  public static function getLogger($name) {
    $logger = new Logger($name);
    // TODO: add the configuration 
    $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
    $logger->pushHandler(new FirePHPHandler());
    return $logger;
  }
}


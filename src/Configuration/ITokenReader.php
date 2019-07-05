<?php

namespace Gma\ApiClient\Configuration;

interface ITokenReader {
  /**
   * Read the token from the store location
   *
   * @return the token
   */
  function getToken(): string;
}

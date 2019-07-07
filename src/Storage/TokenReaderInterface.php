<?php

namespace Gma\ApiClient\Storage;

/**
 * Interface used to define the way we are reading information from the storage location
 */
interface TokenReaderInterface {

  /**
   * Read the token from the store location.
   * This kind of reader can read refresh token and access token.
   * Note: refresh token should be stored in a secure location.
   * security around the access token isn't a concern.
   *
   * @return string the token
   */
  function getToken(): string;
}


<?php

namespace Gma\ApiClient\Storage;

/**
 * Contract for token storage definition
 */
interface TokenWriterInterface {
  /**
   * Persist the token in the token store.
   */
  function store(string $token);
}

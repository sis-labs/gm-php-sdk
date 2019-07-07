<?php

namespace Gma\ApiClient\Configuration;

/**
 * Contract for token storage definition
 */
interface TokenWriterInterface {
  /**
   * Persist the token in the token store.
   */
  function store(string token);
}

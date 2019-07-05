<?php

namespace Gma\ApiClient\Configuration;

/**
 * Contract for token storage definition
 */
interface ITokenWriter {
  /**
   * Persist the token in the token store.
   */
  function store(string token);
}

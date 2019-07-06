<?php

namespace Gma\ApiClient\Configuration;

/**
 * Define the contract the configuration has to fill.
 *
 * This should be an adapter on the database or something
 * like that. The implementation comes with a simple implementation
 * and with a builder that allow custom definition of the way
 * to fill the configuration.
 *
 * The configuration MUST be a read only object in order to keep
 * the system deterministic. No side effect is allowed at the 
 * configuration level.
 */
interface ConfigurationInterface {
  /**
   * Fetch a key in the configuration, If the key
   * doesn't exists in the configuration, the default
   *
   * @param (string) $key the key to look into the configuration
   * @param [optional](mixed) $default the default value to return if the key doesn't exists in the configuration
   * @return (mixed) the value associate to the key in the configuration or the default value
   */
  function get($key, $default = null);

  /**
   * Fetch the base URI of the remote oauth server.
   * The system will use standard path to perform oauth2 request.
   *
   * @return string the base URI to the oauth server to call.
   */
  function getOAuthServerBaseURI();

  /**
   * Fetch the base URI to use to ask the remote service. This URI
   * SHOULD NOT integrate the resource on the remote server but only
   * the common base path to the service on the remote server.
   *
   * ex: http://localhost:3000/demo/v1 (all requested resources are behind this URI)
   *
   * @return string the base URI
   */
  function getBaseURI();

  /**
   * Fetch the client_id define to perform request on the oauth
   * server.
   *
   * @return string the client id
   */
  function getClientId();

  /**
   * Fetch the client secret to perform request on the oauth
   * server. This item should stay secret!
   *
   * @return string the client secret
   */
  function getClientSecret();

  /**
   * Fetch the issuer of the token made to requesting a fresh
   * token on the oauth server.
   * Check the documentation to have an overview of the way
   * of working with our oauth service.
   *
   * @return string the issuer configured for the client
   */
  function getIssuer();

  /**
   * Fetch the audience to ask for on the oauth server.
   * Check the documentation to have an overview of the way
   * of working with our oauth service.
   *
   * @return string the audience to ask on the remote service
   */
  function getAudience();

  /**
   * Fetch the public key used to validate the token generated on
   * the oauth server.
   * The only supported format of the key is PEM!
   * Note: the system supports both a plain string or a path to the
   * file where the key is stored.
   *
   * @return string the path to the file where the key is store or the key itself in PEM format
   */
  function getGmPublicKey();

  /**
   * Fetch the private key of the client used to sign the token to send request on the oauth
   * server.
   * The only supported format of the key is PEM!
   * Note: the system supports both a plain string or a path the file where the key is stored.
   *
   * @return string the path to the file where the key is store or the key itself in PEM format
   */
  function getPrivateKey();

  /**
   * Fetch the passphrase used to access to the content of the private key.
   *
   * @return string the passphrase to use to read the private key
   */
  function getPassphrase();

  /**
   * Fetch the timeout to use when the system performs request on the remote
   * service.
   *
   * @return string|int the timeout
   */
  function getTimeout();

  /**
   * Fetch the list of scopes to integrate on the request made on the oauth server.
   * This list will be integrated in the generated JWT token.
   *
   * If the method returns a string, this will be a csv string.
   *
   * @return array|string the list of scopes
   */
  function getScopes();
}

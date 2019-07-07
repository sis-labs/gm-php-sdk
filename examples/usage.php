<?php

use Gma\ApiClient\Client;
use Gma\ApiClient\Configuration\ConfigurationBuilder;

// fake implementation of a logger, please check MonoLog or such implementation like that
$myLogger = new \stdClass();
$myLogger->log = function($level, $message, $meta = []) {}
$myLogger->trace = function($message, $meta = []) {}
$myLogger->debug = function($message, $meta = []) {}
$myLogger->info = function($message, $meta = []) {}
$myLogger->warn = function($message, $meta = []) {}
$myLogger->error = function($message, $meta = []) {}
$myLogger->fatal = function($message, $meta = []) {}

// Fetch / create the configuration (you can use the builder, use the SimpleImplemention
// or provide your own implementation of the ConfigurationInterface
$configuration = ConfigurationBuilder::create()
  ->setBaseURI('https://api.gm.ch')
  ->setOauthServerURI('https://oauth.gm.ch')
  ->setClientId('client_id')
  ->setClientSecret('client_secret')
  ->setAudience('rest-api-test')
  ->setGmPublicKey('thepublickey')
  ->setPrivateKey('theprivatekey')
  ->setPassphrase('passphrase')
  ->setTimeout(10)
  ->setScopes('ALL')
  ->setIssuer('me')
  ->build();

/*
 * The client is using store to put tokens into or fetch token from.
 *
 * The system come with default implementation which are used by default (take care, default
 * implementation of the refresh token use file to store information which may be unwanted, if
 * you plan to use a container based or a distributed infrastructure).
 */
$storageFactoryConfiguration = [
  'access_token' => [
    // each type of storage has its own configuration, for now, we are only provided the session storage
    // check the documentation of this implementation to gather information about how to correctly
    // configure it and what is his real behavior.
    'type': 'session',
    'security' => 'rsa',
    'configuration' => $configuration,
    'key': 'access_token',
    'auto_erase': true
  ],
  'refresh_token' => [
    // The only refresh token storage method we offer is file for now. It has several limitation and
    // isn't production ready in the mind of authors.
    // You can benefit of some layers of the implementation since we are using a decoration system
    // to read token. Check documentation / implementation of the TokenReaderInterface and the
    // DecorableTokenReader / DecorableTokenWriter.
    'type' => 'file',
    'security' => 'rsa',
    'configuration' => $configuration,
    'key': 'refresh_token',
    'auto_erase' => true
  ],
];
$tokenStorageFactory = StorageFactory::compose($configuration, $storageFactoryConfiguration);

// you can tweak the client to push extra configuration like reporting
$options = ['logging' => 
  [
    // check the documentation for the logging
    'active' => 1,  // if the logging is active but no other configuration is defined, the system will use its own.
    'level' => 'DEBUG', // optional, the instance should be configured with the expected level
    'instance' => $myLogger
  ]
];

$client = new Client($configuration, $tokenStorageFactory, $options);

/*
 * In all process, if the request option contains a key name callback and if the callback
 * is a valid function or if it implements the RequestCallbackInterface, this callback will be
 * invoke with the plain result of the service (see RequestCallbackInterface for documentation).
 *
 * Optionally ,you can pass specific parameters to the request
 * TODO: implement the mapping process option which allow the user to pass a mapper for the resource
 * and thus return in the type expected by tge client.
 *
 * In the mind of authors, the requestProcessOptions has been designed to be use once per request which
 * means that no real intention of use the same options for all requests has been envisaged. If you 
 * want to define such things. you will probably want to use options define at the client level. 
 * The client options accepts the same information of the request options, the order the system is
 * looking for options is the following one:
 *   - requestOptions
 *   - clientOptions
 *   - configuration (if related key exists)
 *   - default implementation (see documentation for information)
 * At soon the system find a definition of the option it it stops the research process and use the
 * options found.
 */
$requestProcessOptions = ['resultType' => 'stdclass'];

// then use the client to fetch data (all data are return as an stdClass or an associative array depending on the configuration)
// by default, the result is an associative array
$resources = $client->get('/resources');
// or
$resources = $client->get('/resources', $requestProcessOptions);

// You can invoke all HTTP methods on the client.
$result = $client->post('/resources', $requestOptions);
$result = $client->get('/resources/1234', $requestOptions);
$result = $client->put('/resources/1234', $requestOptions);
$result = $client->patch('/resources/1234', $requestOptions);
$result = $client->delete('/resources/1234', $requestOptions);


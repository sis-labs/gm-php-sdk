<?php

use Gma\ApiClient\Client;
use Gma\ApiClient\Configuration;

// This configuration is an adapter for you configuration.
// perform all configuration here or define your own instance of the ConfigurationInterface
$configuration = Configuration::getBuilder()
  ->setIssuer("my-issuer") // name of you r client
  ->setClientId("") // your client id
  ->setClientSecret("") // your client secret
  ->setAudience("rest-api") // audience for the api you want to consume
  ->setGmPublicKey("path-to-gm-public-key") // path to the public key or content of the public key
  ->setPrivateKey("path-to-your-private-key") // path to your private key or content of the private key
  ->setPassphrase("passphrase") // passphrase for your private key
  ->setBaseURI("http://api.groupemutuel.ch")
  ->setTimeout(1000) // timeout duration in milliseconds
  ->build();

// If the client's configuration is not valid, it will raise an exception
$client = new Client($configuration);

// perform the handshake with our service to obtain the JWT token
$client->initialize();

// Fetch a new resource from our service
// The result depends on the resources you ask
// If the callback is null, the result of the process will be return
$client->get("resource-url");

// To create a new resource, send the following request
// If the callback is null, the result of the process will be return
$client->post("resource-url", $payload);

// You can also put or patch resource
// If the callback is null, the result of the process will be return
// The version is the optional, it represents the version of the resource you want to patch
$client->put("resource-url", $payload, $version);
$client->patch("resource-url", $diff, $version);

// you can also delete a resource
$client->delete("resource-url", $id, $version);

?>

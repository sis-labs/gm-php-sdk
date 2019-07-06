<?php

namespace Gma\ApiClient\Configuration;

abstract class AbstractConfiguration {
    const BASE_URI = 'base_uri';
    const OAUTH_SERVER_URI = 'oauth_server_uri';
    const CLIENT_ID = 'client_id';
    const CLIENT_SECRET = 'client_secret';
    const ISSUER = 'issuer';
    const AUDIENCE = 'audience';
    const GM_PUBLIC_KEY = 'gm_public_key';
    const PRIVATE_KEY = 'private_key';
    const PASSPHRASE = 'passphrase';
    const TIMEOUT = 'timeout';
    const SCOPES = 'scopes';
}
<?php

/* Access Token */
/*
request:
POST /token HTTP/1.1
Host authorization-server.mydom.org

grant_type=client_credentials
&client_id=<client_id>
&client_secret=<client_secret>

response:
200;
Cache-Control: no-store
Pragma: no-cache
content-type: application/json
{
  "access_token": <fresh_access_token>,
  "token_type": "bearer",
  "expires_in": 3600,
  "refresh_token": <refresh_token>,
  "scope": <csv_list_of_scopes>
}

400:
Cache-Control: no-store
Pragma: no-cache
content-type: application/json
{
  "error": "invalid_request",
  "error_description": "...",
  "error_uri": "..."
}
 */

/* Refresh Token */
/*
request:
POST /token HTTP/1.1 (or http2)
HOST: authorization-server.mydom.org
Headers:
Authorization: Bearer <generated_signed_jwt>

grant_type=refresh_token
&refresh_token=<refresh_token>
&client_id=<client_id>
&client_secret=<client_secret>
&scope=<csv_list_of_scope>

response:
Cache-Control: no-store
Pragma: no-cache
content-type: application/json
{
  "access_token": <fresh_access_token>,
  "refresh_token": <fresh_refresh_token>,
  "token_type": "bearer",
  "expires": 3600
}
 */
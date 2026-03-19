---
category: Integrate
title: OAuth2 Client Credentials Flow
---
# OAuth2 Client Credentials Flow

Use the Client Credentials flow when a backend service needs to access Matomo APIs without user interaction.

Typical examples include:

* Internal analytics dashboards
* Scheduled exports
* Backend integrations

## Request an access token

```bash
curl -X POST 'https://matomo.example.com/index.php?module=OAuth2&action=token' \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'grant_type=client_credentials' \
  -d 'client_id=analytics_app' \
  -d 'client_secret=7fa9c0f81b8b4a12' \
  -d 'scope=matomo:read'
```

## Example token response

```json
{
  "token_type": "Bearer",
  "expires_in": 3600,
  "access_token": "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9..."
}
```

Depending on your client configuration, a refresh token may also be available through the token endpoint for supported grant types.

## When to use this flow

Use this flow only for trusted server-side applications that can keep credentials secret.

If the application needs a user to log in and approve access, use the [Authorization Code flow](/guides/oauth2/authorization-code) instead.

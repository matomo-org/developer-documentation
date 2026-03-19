---
category: Integrate
title: OAuth2 Authorization Code Flow
---
# OAuth2 Authorization Code Flow

Use the Authorization Code flow when your application acts on behalf of a Matomo user.

## Flow overview

The Authorization Code flow works like this:

1. Your application redirects the user to the Matomo authorization endpoint.
2. The user logs in and approves access.
3. Matomo redirects back with an authorization `code`.
4. Your application exchanges the code for an access token.
5. Your application calls Matomo APIs using `Authorization: Bearer ACCESS_TOKEN`.

## PKCE for public clients

Public clients should use PKCE. PKCE requires a `code_verifier` and a derived `code_challenge`.

Example values:

```text
code_verifier = dBjftJeZ4CVP-mB92K27uhbUJU1p1r_wW1gFWFOEjXk
code_challenge = E9Melhoa2OwvFrEMTJguCHaoeK1t8URWbuGJSstw-cM
```

Where:

```text
code_challenge = BASE64URL(SHA256(code_verifier))
```

## Redirect the user to the authorization endpoint

### Public client with PKCE

```text
https://matomo.example.com/index.php?module=OAuth2&action=authorize
&response_type=code
&client_id=analytics_app
&redirect_uri=https://example-app.com/oauth/callback
&scope=matomo:read
&state=abc123
&code_challenge=E9Melhoa2OwvFrEMTJguCHaoeK1t8URWbuGJSstw-cM
&code_challenge_method=S256
```

### Confidential client

```text
https://matomo.example.com/index.php?module=OAuth2&action=authorize
&response_type=code
&client_id=analytics_app
&redirect_uri=https://example-app.com/oauth/callback
&scope=matomo:read
&state=abc123
```

After the user approves access, Matomo redirects back to your application:

```text
https://example-app.com/oauth/callback?code=AUTHORIZATION_CODE&state=abc123
```

## Exchange the authorization code for tokens

The requested scope needs to match the client configuration. At the time of writing, the plugin allows only one scope per request.

### PKCE token request

```bash
curl -X POST 'https://matomo.example.com/index.php?module=OAuth2&action=token' \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'grant_type=authorization_code' \
  -d 'client_id=analytics_app' \
  -d 'redirect_uri=https://example-app.com/oauth/callback' \
  -d 'code=AUTHORIZATION_CODE' \
  -d 'code_verifier=dBjftJeZ4CVP-mB92K27uhbUJU1p1r_wW1gFWFOEjXk'
```

### Confidential client token request

```bash
curl -X POST 'https://matomo.example.com/index.php?module=OAuth2&action=token' \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'grant_type=authorization_code' \
  -d 'client_id=analytics_app' \
  -d 'client_secret=7fa9c0f81b8b4a12' \
  -d 'redirect_uri=https://example-app.com/oauth/callback' \
  -d 'code=AUTHORIZATION_CODE'
```

## Example token response

```json
{
  "token_type": "Bearer",
  "expires_in": 3600,
  "access_token": "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9...",
  "refresh_token": "def50200a1b9"
}
```

## Refresh an access token

### Public client

```bash
curl -X POST 'https://matomo.example.com/index.php?module=OAuth2&action=token' \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'grant_type=refresh_token' \
  -d 'client_id=analytics_app' \
  -d 'refresh_token=def50200a1b9'
```

### Confidential client

```bash
curl -X POST 'https://matomo.example.com/index.php?module=OAuth2&action=token' \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'grant_type=refresh_token' \
  -d 'client_id=analytics_app' \
  -d 'client_secret=7fa9c0f81b8b4a12' \
  -d 'refresh_token=def50200a1b9'
```

## What to read next

Once you have an access token, see [Calling Matomo APIs with OAuth2](/guides/oauth2/api-usage).

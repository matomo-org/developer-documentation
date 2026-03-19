---
category: Integrate
title: OAuth2 Setup
---
# Setting up OAuth2

In this guide you will learn how to configure an OAuth client so an external application can request access tokens for Matomo.

## What the OAuth2 plugin provides

The plugin adds a first-party OAuth2 Authorization Server to Matomo. Once enabled, applications can authenticate against Matomo using bearer tokens instead of sharing a permanent `token_auth`.

The plugin supports these grant types:

* Authorization Code with PKCE
* Client Credentials
* Refresh Token

The plugin currently supports these scopes:

* `matomo:read`
* `matomo:write`
* `matomo:admin`
* `matomo:superuser`

## OAuth endpoints

Matomo exposes these OAuth2 endpoints:

| Endpoint | Description |
|--------|-------------|
| `/index.php?module=OAuth2&action=authorize` | Authorization endpoint |
| `/index.php?module=OAuth2&action=token` | Token endpoint |

Optional cleaner routes can also be configured:

```text
/oauth2/authorize
/oauth2/token
```

## Create an OAuth client

Navigate to one of the following screens:

```text
Administration => Platform => OAuth2   (Matomo On-Premise)
Administration => Export => OAuth2     (Matomo Cloud)
```

Create a client and configure:

* The client type
* The allowed grant types
* The allowed scopes
* The redirect URI for the Authorization Code flow

You can create either of these client types:

* **Confidential** clients, which use a client secret
* **Public** clients, which do not use a client secret and should use PKCE

Example client:

```text
Client ID: analytics_app
Client Secret: 7fa9c0f81b8b4a12
Redirect URI: https://example-app.com/oauth/callback
```

## Choosing the right client type

Use a **public** client when your application cannot safely store a client secret, for example in a browser-based or mobile application. These clients should use PKCE.

Use a **confidential** client when your application runs on a trusted backend and can safely keep the client secret private.

## What to read next

Once your client is configured, continue with the [Authorization Code guide](/guides/oauth2/authorization-code) or the [Client Credentials guide](/guides/oauth2/client-credentials).

---
category: Integrate
title: OAuth 2.0 Developer FAQ
---
# OAuth 2.0 Developer FAQ

## Which grant types are supported?

The plugin supports:

* Authorization Code with PKCE
* Client Credentials
* Refresh Token

## Which scopes are available?

The plugin provides these scopes:

* `matomo:read`
* `matomo:write`
* `matomo:admin`
* `matomo:superuser`

See the [permissions guide](/guides/permissions) for more information.

At the time of writing, only one scope can be requested at a time.

## When should I use a public client?

Use a public client when your application cannot safely store a client secret, for example in a browser or mobile app. Public clients should use PKCE.

## When should I use a confidential client?

Use a confidential client when your application runs on a trusted backend and can safely protect the client secret.

## Where do I manage OAuth clients?

Use one of these screens:

```text
Administration => Platform => OAuth2   (Matomo On-Premise)
Administration => Export => OAuth2     (Matomo Cloud)
```

## Which endpoints does the plugin expose?

The plugin exposes these endpoints:

* `/index.php?module=OAuth2&action=authorize`
* `/index.php?module=OAuth2&action=token`

Optional cleaner routes can also be configured:

* `/oauth2/authorize`
* `/oauth2/token`

## When is a client secret shown?

For confidential clients, the client secret is shown in full only when the client is created or when the secret is rotated. After that, the secret is masked in the UI.

## Can I rotate a client secret?

Yes. Confidential clients support secret rotation from the edit screen. Rotate the secret if you need a new value or if the existing one may have been exposed.

## Can I still use `token_auth`?

Yes. The OAuth 2.0 plugin adds an alternative authentication method for external applications. Existing `token_auth` based integrations continue to be relevant for Matomo installations where the plugin is not enabled.

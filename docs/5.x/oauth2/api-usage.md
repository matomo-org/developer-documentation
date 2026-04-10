---
category: Integrate
title: OAuth 2.0 API Usage
---
# Calling Matomo APIs with OAuth 2.0

Once your application has obtained an access token, it can call Matomo APIs using the `Authorization` header.

```text
Authorization: Bearer ACCESS_TOKEN
```

## Example API request

```bash
curl 'https://matomo.example.com/index.php' \
  -H 'Authorization: Bearer ACCESS_TOKEN' \
  -d 'module=API' \
  -d 'method=VisitsSummary.get' \
  -d 'idSite=1' \
  -d 'period=day' \
  -d 'date=today' \
  -d 'format=json'
```

## OAuth 2.0 compared to `token_auth`

By default, many Matomo API guides use `token_auth` examples because `token_auth` is available in every Matomo installation.

When the OAuth 2.0 plugin is installed, external applications can use OAuth 2.0 bearer tokens instead. This avoids sharing a long-lived auth token with the external application, lets you choose a grant type that matches the integration, and makes it easier to limit and revoke access without affecting other applications.

If you are integrating a backend service with no user interaction, the Client Credentials flow is usually the best fit. If your application acts on behalf of a user, use the Authorization Code flow.

## Notes

* Use HTTPS whenever you send access tokens.
* The plugin currently allows only one scope per request.
* Keep using the standard `token_auth` flow in integrations where the OAuth 2.0 plugin is not installed.

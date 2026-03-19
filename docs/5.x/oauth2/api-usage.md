---
category: Integrate
title: OAuth2 API Usage
---
# Calling Matomo APIs with OAuth2

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

## OAuth2 compared to `token_auth`

By default, many Matomo API guides use `token_auth` examples because `token_auth` is available in every Matomo installation.

When the OAuth2 plugin is installed, external applications can use OAuth2 bearer tokens instead. This avoids sharing a long-lived auth token with the external application and lets you choose a grant type that matches the integration.

If you are integrating a backend service with no user interaction, the Client Credentials flow is usually the best fit. If your application acts on behalf of a user, use the Authorization Code flow.

## Notes

* Use HTTPS whenever you send access tokens.
* The plugin currently allows only one scope per request.
* Keep using the standard `token_auth` flow in integrations where the OAuth2 plugin is not installed.

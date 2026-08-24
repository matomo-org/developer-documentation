---
category: Integrate
subGuides:
  - oauth2/setup
  - oauth2/authorization-code
  - oauth2/client-credentials
  - oauth2/api-usage
  - oauth2/faq
---
# OAuth 2.0

This section contains guides that will help you authenticate external applications against Matomo using OAuth 2.0.

The **OAuth 2.0** plugin adds a first-party OAuth 2.0 Authorization Server to Matomo. It allows external applications to access Matomo APIs using OAuth 2.0 access tokens instead of sending a `token_auth`.

The plugin supports the **Authorization Code** flow with **PKCE**, **Client Credentials**, and **Refresh Token** support. Applications authenticate with bearer tokens and can be limited to the scopes granted to each OAuth client.

OAuth 2.0 clients can be managed in Matomo under **Administration => Platform => OAuth 2.0**. In Matomo Cloud, this screen is available under **Administration => Export => OAuth 2.0**. From there you can create, edit, pause, resume, or delete clients, and rotate secrets for confidential clients.

If you are looking for general API authentication details, also see [Authentication In Depth](/guides/authentication-in-depth) and [Querying the Reporting API](/guides/querying-the-reporting-api).

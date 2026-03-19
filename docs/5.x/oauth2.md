---
category: Integrate
subGuides:
  - oauth2/setup
  - oauth2/authorization-code
  - oauth2/client-credentials
  - oauth2/api-usage
  - oauth2/faq
---
# OAuth2

This section contains guides that will help you authenticate external applications against Matomo using OAuth2.

**OAuth2** is a plugin for Matomo that adds a first-party OAuth2 Authorization Server. It allows external applications to access Matomo APIs using OAuth2 access tokens instead of sending a `token_auth`.

The plugin supports the **Authorization Code** flow with **PKCE**, **Client Credentials**, and **Refresh Token** support. OAuth clients can be managed in Matomo under **Administration => Platform => OAuth2**. In Matomo Cloud, this screen is available under **Administration => Export => OAuth2**.

If you are looking for general API authentication details, also see [Authentication In Depth](/guides/authentication-in-depth) and [Querying the Reporting API](/guides/querying-the-reporting-api).

---
category: DevelopInDepth
title: Authentication
---
# Authentication In Depth

There are different ways a user can authenticate in Matomo:

* Using username / password and the regular login form. 
* The [logme](https://matomo.org/faq/how-to/faq_30/) feature can be used to log someone in using username and password in the URL. 
* Using a `token_auth` URL parameter for our HTTP API's and widgets.

## Username and password login

When a username and password combination is used to log in, then we search in the `user` table for the matching user and check if the provided password is correct. We are storing passwords using PHP's [password_hash](https://www.php.net/manual/en/function.password-hash.php).

On successful login we create a session and store a cookie for the session in the user's browser.

This also all applies to the "logme" feature.

## Auth token 

Token auths are stored hashed with a salt in the `user_token_auth` table. See [how to create a token auth](https://matomo.org/faq/general/faq_114/).

Each user can have multiple tokens. They all have the same permissions and it's not possible to set different permissions or scopes for different tokens.

Token auths are used for the [Tracking API](/api-reference/tracking-api), the [Reporting API](/api-reference/reporting-api) and when [embedding widgets](https://matomo.org/docs/embed-matomo-reports/#embed-a-matomo-report-in-a-html-page)

When a `token_auth` URL parameter is provided, then we don't create a session. This means when a widget is embedded all requests done from this widget need to include the `token_auth` parameter.

When it is a token_auth, then the authentication happens [here](https://github.com/matomo-org/matomo/blob/4.4.1/plugins/Login/Auth.php#L63). Please note that Matomo will always first authenticate using the anonymous user, and then call the same method again later using the token only. Meaning if you are using the debugger you will see the `authenticate` method being called twice.

### Adding the token_auth to a UI request in JS

In JavaScript we are adding the correct `token_auth` value automatically to all requests if you are doing an API request. For all other requests you need to add the token manually. You can add the `token_auth` to a request either using `ajaxRequest.withTokenInUrl();` when it is a request using `ajaxHelper`.

### Special case "force_api_session=1"

The Matomo UI uses the `token_auth` URL parameter to load and change all kind of data. Because the token auths are stored hashed, we cannot get the plain text value of a token and thus not use any configured token_auth from the `user_token_auth` DB table for these requests.

That's why we create a random token_auth when a user logs into the Matomo UI and store this token as part of the session. To learn more about the session read below. The token is only valid for the specific session and it won't work for anyone else.

When there is a "&force_api_session=1" parameter either in the request GET or POST then we will be starting a session after all even if it is an HTTP API call. In that case we then compare the provided token_auth value from the URL against the token_auth value from the session. At the time of writing this logic is mostly handled [here](https://github.com/matomo-org/matomo/blob/4.4.1/core/Access.php#L160-L180).

For actions that change data we require this parameter to be posted for slightly better security. For API requests that read data it can be a regular URL parameter.

#### Knowing if "force_api_session=1" needs to be set or not

In Javascript there is a method `piwik.broadcast.isWidgetizeRequestWithoutSession()` that we usually use to decide if we need to append the "force_api_session" URL parameter or not [see example](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/vue/src/AjaxHelper/AjaxHelper.ts#L669).

## Session authentication

We are storing session data in the `session` table. 

The session data looks like `{data: base64 encoded session data}`. If you wanted to see the actual stored data you need to base64 decode the value from the data attribute.

If you are searching for your session ID in the `session.id` column this won't work as the IDs are stored hashed for security reasons. This way a user with DB access cannot take over someone else's session.

When there is a request and we can use a session, then Matomo [checks first if the user is authenticated using the session cookie](https://github.com/matomo-org/matomo/blob/4.4.1/core/Session/SessionAuth.php). If that's not the case, then it falls back to the regular authentication. 

## Security considerations

* Matomo has a brute force detection built-in and enabled by default. It can be configured in "Matomo Admin -> General settings".
* When a `token_auth` parameter is set by us, then we usually POST the token_auth. This is for security reasons so the token_auth won't appear in server logs. Otherwise a sysadmin could see the token in the logs and do all sort of actions on behalf of another user.
* Remember that users should not share the token_auth as it is the same as them sharing their username/password.

## Alternative login plugins

It is possible to write plugins that provide [alternative Login methods](https://plugins.matomo.org/search?query=login&post_type=product) like [LDAP](https://plugins.matomo.org/LoginLdap), [SAML](https://plugins.matomo.org/LoginSaml), etc.

How this is done is not documented yet unfortunately.

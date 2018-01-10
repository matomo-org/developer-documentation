---
category: Integrate
previous: reporting-api-tutorial
next: reporting-api-clients
---
# Querying the Reporting API

This guide explains how to call the Piwik API to request your web analytics data. There are two methods:

- using the standard HTTP API 
- using Piwik's PHP code directly

## Call the Piwik API using the HTTP API

If you want to request data in any language (PHP, Python, Ruby, ASP, C++, Java, etc.) you can use the HTTP API. It is a simple way to request data via an HTTP GET.

<div markdown="1" class="alert alert-warning">
**Security Notice**

If the API call requires the token_auth and the HTTP request is sent over untrusted networks, we highly advise that you use an encrypted request. Otherwise, your token\_auth is exposed to eavesdroppers. This can be done using https instead of http. In the following example, replace the string "http" by "https".
</div>

You can, for example, get the top 100 search engine keywords used to find your website during the current week. Here is an example in PHP:

```php
{@include escape https://raw.github.com/matomo-org/matomo/master/misc/others/api_rest_call.php}
```

Here is the output of this code:

```html
{@include escape https://piwik.org/api_rest_call.php}
``` 

## Call the Piwik API in PHP

If you want to request data in a PHP script **that is on the same server as Piwik**, you can use this simple technique. This is a more efficient solution as it doesn't require network calls. You directly call the PHP Piwik runtime and get the PHP data structure back.

If you are developing a plugin, you should be using this technique. Please note that including index.php will set the default timezone of the calling code to UTC.

```php
{@include escape https://raw.github.com/matomo-org/matomo/master/misc/others/api_internal_call.php}
```

Here is the output of this script:

```xml
{@include escape http://demo.piwik.org/misc/others/api_internal_call.php}
```

## Learn more

To learn more about all the options available when calling the reporting API, read the [Reporting API reference](/api-reference/reporting-api).

You can also have a look at the [list of client libraries](/guides/reporting-api-clients) available to call the reporting API.

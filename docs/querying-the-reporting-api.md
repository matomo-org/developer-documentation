# Querying the Reporting API

This guide explains how to call the Piwik API to request your web analytics data. There are two methods:

*   using the standard REST API over HTTP
*   using the Piwik PHP library files directly

## Call the Piwik API using the REST API over HTTP

If you want to request data in any language (PHP, Python, Ruby, ASP, C++, Java, etc.) you can use the REST API. It is a simple way to request data via standard HTTP GET.

**Security Notice:** if the API call requires the token_auth and the HTTP request is sent over untrusted networks, we highly advise that you use an encrypted request. Otherwise, your token\_auth is exposed to eavesdroppers. This can be done using https instead of http. In the following example, replace the string "http" by "https".

You can, for example, get your top 100 search engine keywords used to find your website during the current week. Here is an example in PHP:

<pre markdown="1"><code>
[include url="https://raw.github.com/piwik/piwik/master/misc/others/api_rest_call.php"]
</code></pre>

Here is the output of this code:

<pre markdown="1"><code>
[include url="http://piwik.org/wp-content/uploads/api_rest_call.php"]
</code></pre>

## Call the Piwik API in PHP

If you want to request data in a PHP script that is on the same server as Piwik, you can use this simple technique. This is a more efficient solution as it doesn't require network calls. You directly call the PHP Piwik runtime and get the PHP data structure back.

If you are developing a plugin, you have to use this technique.

<pre markdown="1"><code>[include url="https://raw.github.com/piwik/piwik/master/misc/others/api_internal_call.php"]</code></pre>

Here is the output of this script:

<pre markdown="1"><code>[include url="http://demo.piwik.org/misc/others/api_internal_call.php"]</code></pre>
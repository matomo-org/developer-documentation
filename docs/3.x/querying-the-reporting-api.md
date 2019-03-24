---
category: Integrate
previous: reporting-api-tutorial
next: reporting-api-clients
---
# Querying the Reporting API

This guide explains how to call the Piwik API to request your web analytics data. 

## Call the Piwik API using the HTTP API

If you want to request data in any language (PHP, Python, Ruby, ASP, C++, Java, etc.) you can use the HTTP API. It is a simple way to request data via an HTTP GET.

<div markdown="1" class="alert alert-warning">
**Security Notice**

If the API call requires the token_auth and the HTTP request is sent over untrusted networks, we highly advise that you use an encrypted request. Otherwise, your token\_auth is exposed to eavesdroppers. This can be done by using https instead of http.
</div>

You can, for example, get the list of countries where most of your visitors in the current month are from. Here is an example in PHP:

```php
<?php

// this token is used to authenticate your API request.
// You can get the token on the API page inside your Matomo interface
$token_auth = 'anonymous';

// we call the REST API and request the 100 first keywords for the last month for the idsite=7
$url = "https://demo.matomo.org/";
$url .= "?module=API&method=UserCountry.getCountry";
$url .= "&idSite=62&period=month&date=today";
$url .= "&format=JSON&filter_limit=10";
$url .= "&token_auth=$token_auth";

$fetched = file_get_contents($url);
$content = json_decode($fetched,true);

// case error
if (!$content) {
    print("No data found");
}

print("<h1>Countries with most visits</h1>\n");
foreach ($content as $row) {
    
    $countryName = htmlspecialchars($row["label"], ENT_QUOTES, 'UTF-8');
    $hits = $row['nb_visits'];

    print("<b>$countryName</b> ($hits visits)<br>\n");
}
```

Here is the output of this code:

```html
<h1>Countries with most visits</h1>
<b>United States</b> (50504 visits)<br>
<b>Australia</b> (23099 visits)<br>
<b>United Kingdom</b> (22298 visits)<br>
<b>Indonesia</b> (15631 visits)<br>
<b>Germany</b> (14497 visits)<br>
<b>Singapore</b> (10969 visits)<br>
<b>Philippines</b> (9974 visits)<br>
<b>Malaysia</b> (9419 visits)<br>
<b>India</b> (9195 visits)<br>
<b>Thailand</b> (8956 visits)<br>
``` 

## Learn more

To learn more about all the options available when calling the reporting API, read the [Reporting API reference](/api-reference/reporting-api).

You can also have a look at the [list of client libraries](/guides/reporting-api-clients) available to call the reporting API.

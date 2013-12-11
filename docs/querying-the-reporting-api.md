# Querying the Reporting API

## Piwik API Tutorial: Get Your Top 10 Keywords

This tutorial will show you how easy it is to request the **yesterday's top 10 keywords in XML format**.

### Build the URL

To build the URL of the API call, you need:

*   your Piwik base URL (replace demo.piwik.org with the URL and path of your Piwik server

        **http://demo.piwik.org/?module=API**

*   the name of the method you want to call. It has the format _moduleName.methodToCall_ (see the list on [API Methods](/reporting-api/listing#api-method-list)). You need to request the last keywords from the plugin Referers: the method parameter is:

        **method=Referers.getKeywords**

*   the website id.

        **idSite=1**

*   the date parameter. This can be _today_, _yesterday_, or any date with the format _YYYY-MM-DD_

        **date=yesterday**

*   the period parameter. This can be _day_, _week_, _month_ or _year_

        **period=day**

    Alternatively, if you wanted to request all of the keywords from a given date, you could use a date range parameter. For example, to request all of the keywords since January 1st 2011:`**period=range&date=2011-01-01,yesterday**`

*   the format parameter. Defines the output format of the data: XML, JSON, CSV, PHP (serialized PHP), HTML (simple html)

        **format=xml**

*   (optional) the filter_limit parameter that defines the number of rows returned

        **filter_limit=10**

The final url is **[http://demo.piwik.org/?module=API&method=Referers.getKeywords&idSite=3&date=yesterday&period=day&format=xml&filter_limit=10](http://demo.piwik.org/?module=API&method=Referers.getKeywords&idSite=3&date=yesterday&period=day&format=xml&filter_limit=10)**

### XML Output

Here is the output of this request:

<pre markdown="1">[include url="http://demo.piwik.org/?module=API&method=Referers.getKeywords&idSite=3&date=yesterday&period=day&format=xml&filter_limit=10"]
</pre>

### Other useful examples

*   XML of the visits of the last 10 days, one entry per day
[http://demo.piwik.org/?module=API&method=VisitsSummary.getVisits&idSite=3&period=day&date=last10&format=xml](http://demo.piwik.org/?module=API&method=VisitsSummary.getVisits&idSite=3&period=day&date=last10&format=xml)

*   XML containing keywords from the last 3 weeks, one entry per week
[http://demo.piwik.org/?module=API&method=Referers.getKeywords&idSite=3&period=week&date=last3&format=xml](http://demo.piwik.org/?module=API&method=Referers.getKeywords&idSite=3&period=week&date=last3&format=xml)

*   XML containing the keywords from the last 3 days which match the pattern "piwik"
[http://demo.piwik.org/?module=API&method=Referers.getKeywords&idSite=3&period=day&date=last3&format=xml&filter_column=label&filter_pattern=piwik](http://demo.piwik.org/?module=API&method=Referers.getKeywords&idSite=3&period=day&date=last3&format=xml&filter_column=label&filter_pattern=piwik)

*   RSS feed containing the top 30 keywords for the last 3 weeks,  ordered by the number of actions people did when coming from these  keywords
[http://demo.piwik.org/?module=API&method=Referers.getKeywords&idSite=3&period=week&date=last3&format=rss&filter_limit=30&filter_sort_column=3](http://demo.piwik.org/?module=API&method=Referers.getKeywords&idSite=3&period=week&date=last3&format=rss&filter_limit=30&filter_sort_column=3)
You can get the data in one of these formats: XML, JSON, HTML, CSV, TSV, etc. See the [API Reference](/reporting-api/listing) for the documentation.

There are also functions for Websites, Users, Goals, PDF Reports (create, update, delete operations) and a lot more.

Check out the [Piwik API Reference](/reporting-api/listing)

## Calling Techniques

This section explains how to call the Piwik API to request your web analytics data. There are two methods:

*   using the standard REST API over HTTP
*   using the Piwik PHP library files directly

### Call the Piwik API using the REST API over HTTP

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

### Call the Piwik API in PHP

If you want to request data in a PHP script that is on the same server as Piwik, you can use this simple technique. This is a more efficient solution as it doesn't require network calls. You directly call the PHP Piwik runtime and get the PHP data structure back.

If you are developing a plugin, you have to use this technique.

<pre markdown="1"><code>[include url="https://raw.github.com/piwik/piwik/master/misc/others/api_internal_call.php"]</code></pre>

Here is the output of this script:

<pre markdown="1"><code>[include url="http://demo.piwik.org/misc/others/api_internal_call.php"]</code></pre>
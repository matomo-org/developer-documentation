# Tracking API

This page contains the API Reference for the Piwik Tracking API. This REST API allows to record Visitor and Events data in Piwik using any programming language. This Tracking API is different from the [Analytics API](http://piwik.org/docs/analytics-api/).

Note: This doc is aimed at developers who are not using Javascript, PHP or Java. For JS, PHP and Java languages, there is already a client available. See the main documentation about **[Piwik Tracking API](http://piwik.org/docs/tracking-api/).**

## Tracking API endpoint

To track page views, events, visits, you have to send a HTTP request to your Tracking REST API endpoint: **http://your-piwik-domain.tld/piwik.php**

## Tracking API reference

This section explains the various HTTP GET parameters that you can set to the Tracking API request to ensure your data is as complete and useful as possible. Some of these fields will not be available in your app / software which is expected: only a few parameters are required.

Note: all parameters values that are strings (such as 'url', 'action_name', etc.) must be URL encoded.

*   Required and recommended parameters

    *   `idsite` **(required)** &mdash; Defines the numeric Website ID being tracked
    *   `rec` **(required)** &mdash; The parameter &amp;rec=1 is required to enable tracking.
    *   `url` **<strong>(required)**</strong> &mdash; The full URL for the current action.
    *   `action_name` **(recommended)** &mdash; The custom Page title used to build the Piwik report Actions&gt;Page Titles. It is possible to [use slashes / to set one or several ](http://piwik.org/faq/how-to/#faq_62)[categories for this action](http://piwik.org/faq/how-to/#faq_62). For example, 'Help / Feedback' will create the Action "Feedback" in the category "Help".
    *   `_id` **(recommended)** &mdash; The unique user id, must be a 16 characters hexadecimal string. It is important to always set the same _id values for a given user. Typically you would need a way to persist this value for your user &mdash; for example using Sessions or a a new field in your "users" table in your DB. If this value is not set Piwik will still work, but unique visitors tracking might be less accurate.
    *   `rand` **(recommended)** &mdash; A random parameter, for example a random number generated before each request &mdash; this is useful to avoid the tracking request being cached by the browser or a proxy.
    *   `apiv` **(recommended)** &mdash; The parameter &amp;apiv=1 defines the api version you want to use.

*   Optional visitor info &mdash; we recommend to set these values if they are available and relevant to your use case.

    *   `urlref` &mdash; The full Referrer URL. This is used to populate the "Referrers" report (Websites, Search engines and keywords)
    *   `_cvar` &mdash; Visit scope [custom variables](http://piwik.org/docs/custom-variables/). This is a string JSON encoded of the custom variable array (see below for an example value).
    *   `_idvc` &mdash; The current count of visits for this visitor. To set this value correctly, it would be required to store the value for each visitor in your application (using Sessions or persisting in your DB). Then you would manually increment by one on each new visit or "session", depending on how you choose to defined a visit. This value is used to populate the report "Visitors &gt; Engagement &gt; Visits by visit number".
    *   `_viewts` &mdash; The UNIX timestamp of the time of the previous visit by this visitor. This parameter is used to populate the report "Visitors &gt; Engagement &gt; Visits by days since last visit"
    *   `_idts` &mdash; The UNIX timestamp of the time of the first visit by this visitor. This could be set to the date where the user first started using your sofware/app, or when the user created his account. This parameter is used to populate the report "Goals &gt; Days to Conversion"
    *   `_rcn` &mdash; The Campaign name (see [Tracking Campaigns](http://piwik.org/docs/tracking-campaigns/)). Used to populate report Referrers &gt; Campaigns. Note: _rcn value will only be used for the first pageview of a given visitor.
    *   `_rck` &mdash; The Campaign Keyword (see [Tracking Campaigns](http://piwik.org/docs/tracking-campaigns/)). Used to populate report Referrers &gt; Campaigns (clicking on a campaign loads all keywords for this campaign). Note: _rck value will only be used for the first pageview of a given visitor.
    *   `res` &mdash; The resolution of the device, eg _1280x1024_
    *   `h` &mdash; The current hour &mdash; local time
    *   `m` &mdash; The current minute &mdash; local time
    *   `s` &mdash; The current second &mdash; local time

    *   `ua` &mdash; This value is the User-Agent HTTP header string is used by Piwik to detect Operating System and browser used.

        Note: Alternatively you can set the User-Agent HTTP header instead of using the &amp;ua= parameter.
    *   `lang` &mdash; This value is the Accept-Language HTTP header, which lets Piwik detect user country (based on language) if [GeoIP](http://piwik.org/faq/troubleshooting/#faq_65) is not enabled.

        Note: Alternatively you can set the Accept-Language HTTP header instead of using the &amp;lang= parameter.

*   Optional action/event info &mdash; we recommend to set these values if they are available and relevant to your use case.

    *   `cvar` &mdash; Page scope [custom variables.]()This is a string JSON encoded of the custom variable array (see below for an example value)
    *   `link` &mdash; An external URL the user has opened. We recommend to also set the 'url' parameter to this same value.
    *   `download` &mdash; URL the user has downloaded. We recommend to also set the 'url' parameter to this same value.
    *   `search` &mdash; The Site Search keyword. When specified, the request will not be tracked as normal pageview but will instead be tracked as a "Site Search" request.

        *   `search_cat` &mdash; when 'search' is specified, you can optionally specify a search category
        *   `search_count` &mdash; when 'search' is specified, we also recommend to set the search_count to the number of search results displayed in the page. Piwik will then specifically report "No Result Search Keyword", ie. keywords that were tracked with &amp;search_count=0

        *   `idgoal` &mdash; The request will trigger a conversion for the specified Goal
    *   `revenue` &mdash; Defines a monetary revenue for the current goal conversion. Only used if "idgoal" is specified in the request.
    *   `gt_ms` &mdash; Average generation time, in milliseconds. This value is used to process the "Avg. generation time" column, in the Page URL and Page Title reports, as well as a site wide running average of the&nbsp;speed of all pageviews. Note: when using the Javascript tracker this value is set to (Time for server to generate response + Time for client to download response).

*   Special parameters requiring authentication via token_auth

    The following parameters require that you set `&token_auth=` to your token_auth value. The token_auth must be either the Super User token_auth, or a user with "admin" permission for this website ID.

    *   `token_auth` &mdash; 32 characters to authenticate the API request
    *   `cip` &mdash; (requires token_auth to be set) defines the visitor IP &mdash; ipv4 and ipv6 notations supported.
    *   `cdt` &mdash; (requires token_auth to be set) defines the date &amp; time to record the visit to. This is useful to record visits and page views in the past. The expected format is: 2011-04-05%2000%3A11%3A42 which is the URL encoded string of: 2011-04-05 00:11:42

        Note: if you record data in the past, you will need to force Piwik to re-process reports for the past dates: see this FAQ for more information
    *   `cid` &mdash; (requires token_auth to be set) defines the visitor ID for this request. You must set this value to exactly a 16 character hexadecimal string (containing only characters 01234567890abcdefABCDEF). When specified, the Visitor ID will be "enforced". This means that if there is no recent visit with this visitor ID, a new one will be created. If a visit is found in the last 30 minutes with your specified Visitor Id, then the new action will be recorded to this existing visit.
    *   `new_visit=1` &mdash; (requires token_auth to be set) if new_visit=1 is set, a new visit will automatically be created for the action being tracked. This feature is also [available in Javascript](http://piwik.org/faq/how-to/#faq_187).

*   Specifying any of the user's [Geo location](http://piwik.org/docs/geo-locate/) details requires token_auth to be set:

    *   `country` &mdash; The two letter country code of the visitor, eg _fr_, _de_, _us_.
    *   `region` &mdash; The two letter region code as defined by [MaxMind's](http://www.maxmind.com?rId=piwik) GeoIP databases. See [here](http://dev.maxmind.com/static/maxmind-region-codes.csv) for a list of them for every country (the region codes are located in the second column to the left of the region name and to the right of the country code).
    *   `city` &mdash; The name of the city the visitor is located in.
    *   `lat` &mdash; The visitor's latitude, eg _22.456_.
    *   `long` &mdash; The visitor's longitude, eg _22.456_.

**Note about tracking bots**

By default Piwik does not track bots. If you use the REST Tracking API, you might want to also enable tracking of these requests that Piwik detect as both (using basic user agent matching or IPs from known bots). To enable Bot Tracking in Piwik, set the parameter &amp;**bots**=1 to the piwik.php request.

## Example HTTP request to Piwik Tracking API

Here is an example of a real tracking request, as done by [Piwik Mobile app](http://piwik.org/mobile/) for the anonymous Piwik Mobile Analytics.

<pre>http://piwik-server/piwik.php?_cvar={"1":["OS","iphone 5.0"],"2":["Piwik Mobile Version","1.6.2"],"3":["Locale","en::en"],"4":["Num Accounts","2"]}&amp;action_name=View settings&amp;url=http://mobileapp.piwik.org/window/settings &amp;idsite=8876&amp;rand=351459&amp;h=18&amp;m=13&amp;s=3 &amp;rec=1&amp;apiv=1&amp;cookie= &amp;urlref=http://iphone.mobileapp.piwik.org&amp;_id=af344a398df83874 &amp;_idvc=19&amp;res=320×480&amp;</pre>

**Explanation:** this URL has custom variables for the OS, Piwik version, Accounts created, tracks an event "View settings" with a fake URL, records the screen resolution, and also includes `_id, a custom unique ID generated to ensure all requests for the same Mobile App user will be recorded for the same visit in Piwik.

## Debugging the Tracking API requests

To verify that your data is being tracked properly, you can enable debug logging in the Piwik tracking file piwik.php.

**Tracking requests will then output the tracking logs rather than displaying a 1*1 transparent GIF beacon.**

Follow these simple steps to enable debug logging in piwik.php:

1.  In the file `path/to/piwik/piwik.php`, you can set `$GLOBALS['PIWIK_TRACKER_DEBUG'] = true;`
2.  Look at the http requests that are sent to Piwik

    *   If the requests take place in the browser, you can use a tool like [Firebug Net panel](http://getfirebug.com/) to see all requests to "piwik.php"
    *   If the requests are triggered from your app or software directly, you can output or log the Tracking URL piwik.php?… and manually load it to view the logging messages.

## Advanced: Bulk Tracking Requests

**What is Bulk Tracking?**

Some applications such as the [Piwik log importer](http://piwik.org/log-analytics/), have to track many visits, sometimes tens, hundreds, thousands or even more all at once. Tracking these requests with one HTTP request per visit or action can result in _enormous_ delays because there is a delay of several milliseconds to establish the HTTP connection. Using the bulk tracking feature, however, these requests can be sent all at once as a POST request, making your application far more efficient.

**How to Track several pages with one request?**

To send a bulk tracking request, you must POST a JSON object to the Piwik tracking endpoint. The object must contain the following properties:

*   `token_auth` &mdash; token_auth can be found in the API page. Provide at least Admin or Super User permission to use
*   `requests` An array of individual tracking requests. Each tracking request should be the query string you'd send if you were going to track that action individually.

**Example Data**

<pre>{
   "requests": [
      "?idsite=1&amp;url=http://example.org&amp;action_name=Test bulk log Pageview&amp;rec=1",
      "?idsite=1&amp;url=http://example.net/test.htm&amp;action_name=Another bul k page view&amp;rec=1"
   ],
   "token_auth": "33dc3f2536d3025974cccb4b4d2d98f4"
}</pre>

**Example Bulk Tracking Call using CURL**

Here is an example POST request passing the JSON containing the token and the requests.

<pre>$ curl -i -X POST -d '{"requests":["?idsite=1&amp;url=http://example.org&amp;action_name=Test bulk log Pageview&amp;rec=1","?idsite=1&amp;url=http://example.net/test.htm&amp;action_name=Another bulk page view&amp;rec=1"],"token_auth":"33dc3f2536d3025974cccb4b4d2d98f4"}' http://piwik.example.com/piwik.php</pre>

This will track 2 requests using only 1 http request to Piwik.


**More information**

See the **[doc about Piwik Tracking API](http://piwik.org/docs/tracking-api/)** for more information. If you're stuck, ask in the forums (after making a search) or [hire a Piwik expert](http://piwik.org/consulting/).

If you have any feedback or suggestion about this doc let us know in the comment field below.
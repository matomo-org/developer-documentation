## The Tracking HTTP API

To track page views, events, visits, you have to send a HTTP GET request to your Tracking HTTP API endpoint, for example, **http://your-piwik-domain.tld/piwik.php** with the correct query parameters set.

### Supported Query Parameters

This section lists the various query parameters that are supported by the Tracking API. The data for some of these fields will not be available in your app / software which is expected, but you should provide as much information as you can.

_Note: all parameters values that are strings (such as 'url', 'action\_name', etc.) must be URL encoded._

* Required parameters

  * `idsite` **(required)** &mdash; The ID of the website we're tracking a visit/action for.
  * `rec` **(required)** &mdash; Required for tracking, must be set to one, eg, `&rec=1`.
  * `url` **(required)** &mdash; The full URL for the current action.

* Recommended parameters

  * `action_name` **(recommended)** &mdash; The title of the action being tracked. It is possible to [use slashes / to set one or several](http://piwik.org/faq/how-to/#faq_62) [categories for this action](http://piwik.org/faq/how-to/#faq_62). For example, **Help / Feedback** will create the Action **Feedback** in the category **Help**.
  * `_id` **(recommended)** &mdash; The unique visitor ID, must be a 16 characters hexadecimal string. Every unique visitor must be assigned a different ID and this ID must not change after it is assigned. If this value is not set Piwik will still track visits, but the unique visitors metric might be less accurate.
  * `rand` **(recommended)** &mdash; Meant to hold a random value that is generated before each request. Using it helps avoid the tracking request being cached by the browser or a proxy.
  * `apiv` **(recommended)** &mdash; The parameter &amp;apiv=1 defines the api version to use (currently always set to 1)

* Optional User info _(We recommend that these parameters be used if the information is available and relevant to your use case.)_

    * `urlref` &mdash; The full HTTP Referrer URL. This value is used to determine how someone got to your website (ie, through a website, search engine or campaign).
    * `_cvar` &mdash; Visit scope [custom variables](http://piwik.org/docs/custom-variables/). This is a JSON encoded string of the custom variable array (see below for an example value).
    * `_idvc` &mdash; The current count of visits for this visitor. To set this value correctly, it would be required to store the value for each visitor in your application (using sessions or persisting in a database). Then you would manually increment the counts by one on each new visit or "session", depending on how you choose to define a visit. This value is used to populate the report _Visitors > Engagement > Visits by visit number_.
    * `_viewts` &mdash; The UNIX timestamp of this visitor's previous visit. This parameter is used to populate the report _Visitors > Engagement > Visits by days since last visit_.
    * `_idts` &mdash; The UNIX timestamp of this visitor's first visit. This could be set to the date where the user first started using your software/app, or when he/she created an account. This parameter is used to populate the _Goals > Days to Conversion_ report.
    * `_rcn` &mdash; The Campaign name (see [Tracking Campaigns](http://piwik.org/docs/tracking-campaigns/)). Used to populate the _Referrers > Campaigns_ report. _Note: this parameter will only be used for the first pageview of a visit._
    * `_rck` &mdash; The Campaign Keyword (see [Tracking Campaigns](http://piwik.org/docs/tracking-campaigns/)). Used to populate the _Referrers > Campaigns_ report (clicking on a campaign loads all keywords for this campaign). _Note: this parameter will only be used for the first pageview of a visit._
    * `res` &mdash; The resolution of the device the visitor is using, eg **1280x1024**.
    * `h` &mdash; The current hour (local time).
    * `m` &mdash; The current minute (local time).
    * `s` &mdash; The current second (local time).
    * plugins used by the visitor can be specified by setting the following parameters to 1: `fla` (Flash), `java` (Java), `dir` (Director), `qt` (Quicktime), `realp` (Real Player), `pdf` (PDF), `wma` (Windows Media), `gears` (Gears), `ag` (Silverlight).

    * `ua` &mdash; An override value for the **User-Agent** HTTP header field. The user agent is used to detect the operating system and browser used.
    * `lang` &mdash; An override value for the **Accept-Language** HTTP header field. This value is used to detect the visitor's country if [GeoIP](http://piwik.org/faq/troubleshooting/#faq_65) is not enabled.
    * `uid` &mdash; defines the [User ID](http://piwik.org/docs/user-id/) for this request. User ID is any non empty unique string identifying the user (such as an email address or a username). To access this value, users must be logged-in in your system so you can fetch this user ID from your system, and pass it to Piwik. The User ID appears in the visitor log, the Visitor profile, and you can [Segment](http://developer.piwik.org/api-reference/segmentation) reports for one or several User ID (`userId` segment). When specified, the User ID will be "enforced". This means that if there is no recent visit with this User ID, a new one will be created. If a visit is found in the last 30 minutes with your specified User ID, then the new action will be recorded to this existing visit. 
    * `cid` &mdash; defines the visitor ID for this request. You must set this value to exactly a 16 character hexadecimal string (containing only characters 01234567890abcdefABCDEF). We recommended to set the User ID via `uid` rather than use this `cid`.  
    * `new_visit` &mdash; If set to 1, will force a new visit to be created for this action. This feature is also [available in Javascript](http://piwik.org/faq/how-to/#faq_187).

    

* Optional Action info (measure Page view, Outlink, Download, Site search)

    * `cvar` &mdash; Page scope [custom variables](http://piwik.org/docs/custom-variables/). This is a JSON encoded string of the custom variable array (see below for an example value).
    * `link` &mdash; An external URL the user has opened. Used for tracking outlink clicks. We recommend to also set the **url** parameter to this same value.
    * `download` &mdash; URL of a file the user has downloaded. Used for tracking downloads. We recommend to also set the **url** parameter to this same value.
    * `search` &mdash; The Site Search keyword. When specified, the request will not be tracked as a normal pageview but will instead be tracked as a [Site Search](http://piwik.org/docs/site-search/) request.
    * `search_cat` &mdash; when **search** is specified, you can optionally specify a search category with this parameter.
    * `search_count` &mdash; when **search** is specified, we also recommend to set the search\_count to the number of search results displayed on the results page. When keywords are tracked with &search_count=0 they will appear in the "No Result Search Keyword" report.
    * `idgoal` &mdash; If specified, the tracking request will trigger a conversion for the [goal](http://piwik.org/docs/tracking-goals-web-analytics/) of the website being tracked with this ID.
    * `revenue` &mdash; A monetary value that was generated as revenue by this goal conversion. Only used if **idgoal** is specified in the request.
    * `gt_ms` &mdash; The amount of time it took the server to generate this action, in milliseconds. This value is used to process the [Page speed report](http://piwik.org/docs/page-speed/) **Avg. generation time** column in the Page URL and Page Title reports, as well as a site wide running average of the speed of your server. _Note: when using the Javascript tracker this value is set to the ime for server to generate response + the time for client to download response._
    * `cs` &mdash; The charset of the page being tracked. Specify the charset if the data you send to Piwik is encoded in a different character set than the default `utf-8`.

* Optional [Event Tracking](http://piwik.org/docs/event-tracking/) info
    * `e_c` &mdash; The event category. Must not be empty. (eg. Videos, Music, Games...)
    * `e_a` &mdash; The event action. Must not be empty. (eg. Play, Pause, Duration, Add Playlist, Downloaded, Clicked...)
    * `e_n` &mdash; The event name.  (eg. a Movie name, or Song name, or File name...)
    * `e_v` &mdash; The event value. Must be a float or integer value (numeric), not a string.

* Optional [Content Tracking](http://piwik.org/docs/content-tracking/) info
    * `c_n` &mdash; The name of the content. For instance 'Ad Foo Bar'
    * `c_p` &mdash; The actual content piece. For instance the path to an image, video, audio, any text
    * `c_t` &mdash; The target of the content. For instance the URL of a landing page
    * `c_i` &mdash; The name of the interaction with the content. For instance a 'click'
    
  To track a content impression set `c_n` and optionally `c_p` and `c_t`. To track a content interaction set `c_i` and `c_n` and optionally `c_p` and `c_t`. To map an interaction to an impression make sure to set the same value for `c_n` and `c_p`. It is recommended to set a value for `c_p`.

* Ecommerce info

    Use the following values to record a cart and/or an [ecommerce](http://piwik.org/docs/ecommerce-analytics/) order. You must also set `&idgoal=0` in the request.

    * `ec_id` &mdash; The unique string identifier for the ecommerce order
    * `revenue` &mdash; The grand total for the ecommerce order
    * `ec_st` &mdash; The sub total of the order (excludes shipping)
    * `ec_tx` &mdash; Tax Amount of the order
    * `ec_sh` &mdash; Shipping cost of the Order
    * `ec_dt` &mdash; Discount offered
    * `ec_items` &mdash; Items in the Ecommerce order. This is a JSON encoded array of items. Each item is an array with the following info in this order: item sku, item name, item category, item price, item quantity.

* Special parameters

    The following parameters require that you set `&token_auth=` to the token\_auth value of the Super User or a user with admin access to the website visits are being tracked for.

    * `token_auth` &mdash; 32 character authorization key used to authenticate the API request.
    * `cip` &mdash; Override value for the visitor IP (both IPv4 and IPv6 notations supported).
    * `cdt` &mdash; Override for the datetime of the request (normally the current time is used). This can be used to record visits and page views in the past. The expected format is: `2011-04-05 00:11:42` (remember to URL encode the value!). The datetime must be sent in UTC timezone.
      _Note: if you record data in the past, you will need to [force Piwik to re-process reports for the past dates](http://piwik.org/faq/how-to/#faq_59)._
      
      If you set `cdt` to a datetime older than four hours then `token_auth` must be set. If you set `cdt` with a datetime in the last four hours then you don't need to pass `token_auth`.
    * `country` &mdash; An override value for the country. Should be set to the two letter country code of the visitor (lowercase), eg **fr**, **de**, **us**.
    * `region` &mdash; An override value for the region. Should be set to the two letter region code as defined by [MaxMind's](http://www.maxmind.com?rId=piwik) GeoIP databases. See [here](http://dev.maxmind.com/static/maxmind-region-codes.csv) for a list of them for every country (the region codes are located in the second column, to the left of the region name and to the right of the country code).
    * `city` &mdash; An override value for the city. The name of the city the visitor is located in, eg, **Tokyo**.
    * `lat` &mdash; An override value for the visitor's latitude, eg _22.456_.
    * `long` &mdash; An override value for the visitor's longitude, eg _22.456_.

#### Tracking Bots

By default Piwik does not track bots. If you use the Tracking HTTP API directly, you may be interested in tracking bot requests. To enable Bot Tracking in Piwik, set the parameter &**bots**=1 in your requests to piwik.php.

#### Example Tracking Request

Here is an example of a real tracking request used by the [Piwik Mobile app](http://piwik.org/mobile/) when anonymously tracking Mobile App usage:

    [http]

    http://piwik-server/piwik.php?_cvar={"1":["OS","iphone 5.0"],"2":["Piwik Mobile Version","1.6.2"],"3":["Locale","en::en"],"4":["Num Accounts","2"]}&action_name=View settings&url=http://mobileapp.piwik.org/window/settings &idsite=8876&rand=351459&h=18&m=13&s=3 &rec=1&apiv=1&cookie= &urlref=http://iphone.mobileapp.piwik.org&_id=af344a398df83874 &_idvc=19&res=320×480&

_Note: for clarity, parameter values are not URL encoded in this example._

**Explanation:** this URL has custom variables for the OS, Piwik version, number of accounts created. It tracks an event named **View settings** with a fake URL, records the screen resolution and also includes a custom unique ID generated to ensure all requests for the same Mobile App user will be recorded for the same visit in Piwik.

### Bulk Tracking

Some applications such as the [Piwik log importer](http://piwik.org/log-analytics/), have to track many visits, sometimes tens, hundreds, thousands or even more all at once. Tracking these requests with one HTTP request per visit or action can result in _enormous_ delays due to the amount of time it takes to send an HTTP request, Using the bulk tracking feature, however, these requests can be sent all at once making the application far more efficient.

To send a bulk tracking request, an HTTP POST must be made with a JSON object to the Piwik tracking endpoint. The object must contain the following properties:

* `requests` &mdash; an array of individual tracking requests. Each tracking request should be the query string you'd send if you were going to track that action individually.
* `token_auth` &mdash; (optional) token_auth which is found in the API page. Specify this only needed if you use any of the parameters that require `token_auth`

#### Example Requests

This is an example of the payload of a bulk tracking request:

    {
       "requests": [
          "?idsite=1&url=http://example.org&action_name=Test bulk log Pageview&rec=1",
          "?idsite=1&url=http://example.net/test.htm&action_name=Another bul k page view&rec=1"
       ],
       "token_auth": "33dc3f2536d3025974cccb4b4d2d98f4"
    }

Here is the command to send this request to Piwik using curl (without `token_auth` which is optional in this case):

    curl -i -X POST -d '{"requests":["?idsite=1&url=http://example.org&action_name=Test bulk log Pageview&rec=1","?idsite=1&url=http://example.net/test.htm&action_name=Another bulk page view&rec=1"]}' http://piwik.example.com/piwik.php

This will track **two** actions using only **one** HTTP request to Piwik.

## Debugging the Tracker

To verify that your data is being tracked properly, you can enable debug logging in the Piwik tracking file, **piwik.php**.

**Tracking requests will then output the tracking log messages rather than displaying a 1*1 transparent GIF beacon.**

Follow these steps to enable and view debug logging for the tracker:

1. In your config file `path/to/piwik/config/config.ini.php`, write the following:

    `[Tracker]
    debug = 1`


2. Look at the HTTP requests that are sent to Piwik.
    * If the requests take place in a browser, you can use a tool like the [Firebug](http://getfirebug.com/) to see all requests to **piwik.php**.
    * If the requests are triggered from your app or software directly, you can output or log the output of tracking requests and to view the debug messages.

## Learn more

* For **a list of tracking clients** see this [page](http://piwik.org/docs/tracking-api/).
* To learn more **about geolocation** read the [GeoIP user docs](http://piwik.org/docs/geo-locate/).
* To learn **about Piwik's JavaScript tracker** read our [documentation for the tracker](http://piwik.org/docs/javascript-tracking/).

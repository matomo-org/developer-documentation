---
category: API Reference
---
# Tracking HTTP API

To track page views, events, visits, you have to send an HTTP request (GET or POST) to your Tracking HTTP API endpoint, for example, **https://your-matomo-domain.example/matomo.php** with the correct query parameters set.

## Supported Query Parameters

This section lists the various query parameters that are supported by the Tracking API. The data for some of these fields will not be available in your app / software which is expected, but you should provide as much information as you can.

_Note: all parameters values that are strings (such as 'url', 'action\_name', etc.) must be URL encoded._

### Required parameters

* `idsite` **(required)** &mdash; The ID of the website we're tracking a visit/action for.
* `rec` **(required)** &mdash; Required for tracking, must be set to one, eg, `&rec=1`.

### Recommended parameters

* `action_name` **(recommended)** &mdash; The title of the action being tracked. It is possible to [use slashes / to set one or several](https://matomo.org/faq/how-to/#faq_62) [categories for this action](https://matomo.org/faq/how-to/#faq_62). For example, **Help / Feedback** will create the Action **Feedback** in the category **Help**.
* `url` **(recommended)** &mdash; The full URL for the current action.
* `_id` **(recommended)** &mdash; The unique visitor ID, must be a 16 characters hexadecimal string. Every unique visitor must be assigned a different ID and this ID must not change after it is assigned. If this value is not set Piwik will still track visits, but the unique visitors metric might be less accurate.
* `rand` **(recommended)** &mdash; Meant to hold a random value that is generated before each request. Using it helps avoid the tracking request being cached by the browser or a proxy.
* `apiv` **(recommended)** &mdash; The parameter &amp;apiv=1 defines the api version to use (currently always set to 1)

### Optional User info

_(We recommend that these parameters be used if the information is available and relevant to your use case.)_

* `urlref` &mdash; The full HTTP Referrer URL. This value is used to determine how someone got to your website (ie, through a website, search engine or campaign).
* `res` &mdash; The resolution of the device the visitor is using, eg **1280x1024**.
* `h` &mdash; The current hour (local time).
* `m` &mdash; The current minute (local time).
* `s` &mdash; The current second (local time).
* plugins used by the visitor can be specified by setting the following parameters to 1: `fla` (Flash), `java` (Java), `dir` (Director), `qt` (Quicktime), `realp` (Real Player), `pdf` (PDF), `wma` (Windows Media), `gears` (Gears), `ag` (Silverlight).
* `cookie`  &mdash; when set to 1, the visitor's client is known to support cookies.

* `ua` &mdash; An override value for the **User-Agent** HTTP header field. The user agent is used to detect the operating system and browser used.
* `uadata` &mdash; JSON encoded **Client Hints** collected by javascript. This will be used to enrich the detected user agent data. (requires Matomo 4.12.0)
* `lang` &mdash; An override value for the **Accept-Language** HTTP header field. This value is used to detect the visitor's country if [GeoIP](https://matomo.org/faq/troubleshooting/#faq_65) is not enabled.
* `uid` &mdash; defines the [User ID](https://matomo.org/docs/user-id/) for this request. User ID is any non-empty unique string identifying the user (such as an email address or a username). To access this value, users must be logged-in in your system so you can fetch this user ID from your system, and pass it to Piwik. The User ID appears in the visits log, the Visitor profile, and you can [Segment](https://developer.matomo.org/api-reference/segmentation) reports for one or several User ID (`userId` segment). When specified, the User ID will be "enforced". This means that if there is no recent visit with this User ID, a new one will be created. If a visit is found in the last 30 minutes with your specified User ID, then the new action will be recorded to this existing visit.
* `cid` &mdash; defines the visitor ID for this request. You must set this value to exactly a 16 character hexadecimal string (containing only characters 01234567890abcdefABCDEF). We recommended setting the User ID via `uid` rather than use this `cid`.
* `new_visit` &mdash; If set to 1, will force a new visit to be created for this action. This feature is also [available in JavaScript](https://matomo.org/faq/how-to/#faq_187).
* `dimension[0-999]` &mdash; A Custom Dimension value for a specific Custom Dimension ID (requires Piwik 2.15.1 + [Custom Dimensions plugin](https://plugins.matomo.org/CustomDimensions) see the [Custom Dimensions guide](https://matomo.org/docs/custom-dimensions/)). If Custom Dimension ID is `2` use `dimension2=dimensionValue` to send a value for this dimension. The configured Custom Dimension has to be in scope "Visit".
* `_cvar` &mdash; Visit scope [custom variables](https://matomo.org/docs/custom-variables/). This is a JSON encoded string of the custom variable array (see below for an example value). (Note: it is recommended to use "Custom Dimensions" instead of "Custom Variables")

### Optional [Acquisition Channel Attribution](https://matomo.org/guide/reports/acquisition-and-marketing-channels/)

In Matomo, it is possible to measure the channel used by the visitor to find the website, and then to attribute conversions to specific campaigns or channels. This is useful to identify which marketing efforts are driving the most traffic and conversions.

* To attribute a visit (and all the conversions triggered by this visit) to a channel, you can set the campaigns details in the Page URL and encode it before passing it to the Matomo Tracking API via the `url` parameter. You can [generate a Campaign Tracking URL using the URL Builder](https://matomo.org/faq/tracking-campaigns-url-builder/) to include Campaign name, medium, source, content, Campaign ID, placement, group in the URL. 

You may also use the following Tracking API parameters to additionally ensure goal conversions will be recorded with the right Campaign name or Campaign keyword:
* `_rcn` &mdash; The Campaign name used to attribute goal conversions. (Note: this will only be used to attribute goal conversions, not visits)
* `_rck` &mdash; The Campaign keyword used to attribute goal conversions. (Note: this will only be used to attribute goal conversions, not visits)
  
### Optional Action info (measure Page view, Outlink, Download, Site search)

* `cvar` &mdash; Page scope [custom variables](https://matomo.org/docs/custom-variables/). This is a JSON encoded string of the custom variable array (see below for an example value).
* `link` &mdash; An external URL the user has opened. Used for tracking outlink clicks. We recommend to also set the **url** parameter to this same value.
* `download` &mdash; URL of a file the user has downloaded. Used for tracking downloads. We recommend to also set the **url** parameter to this same value.
* `search` &mdash; The Site Search keyword. When specified, the request will not be tracked as a normal pageview but will instead be tracked as a [Site Search](https://matomo.org/docs/site-search/) request.
* `search_cat` &mdash; when **search** is specified, you can optionally specify a search category with this parameter.
* `search_count` &mdash; when **search** is specified, we also recommend setting the search\_count to the number of search results displayed on the results page. When keywords are tracked with &search_count=0 they will appear in the "No Result Search Keyword" report.
* `pv_id` &mdash; Accepts a six character unique ID that identifies which actions were performed on a specific page view. When a page was viewed, all following tracking requests (such as events) during that page view should use the same pageview ID. Once another page was viewed a new unique ID should be generated. Use `[0-9a-Z]` as possible characters for the unique ID.
* `idgoal` &mdash; If specified, the tracking request will trigger a conversion for the [goal](https://matomo.org/docs/tracking-goals-web-analytics/) of the website being tracked with this ID.
* `revenue` &mdash; A monetary value that was generated as revenue by this goal conversion. Only used if **idgoal** is specified in the request.
* `gt_ms` &mdash; The amount of time it took the server to generate this action, in milliseconds. This value is used to process the [Page speed report](https://matomo.org/docs/page-speed/) **Avg. generation time** column in the Page URL and Page Title reports, as well as a site wide running average of the speed of your server. _Note: when using the JavaScript tracker this value is set to the time for server to generate response + the time for client to download response._
* `cs` &mdash; The charset of the page being tracked. Specify the charset if the data you send to Piwik is encoded in a different character set than the default `utf-8`.
* `dimension[0-999]` &mdash; A Custom Dimension value for a specific Custom Dimension ID (requires Piwik 2.15.1 + [Custom Dimensions plugin](https://plugins.matomo.org/CustomDimensions) see the [Custom Dimensions guide](https://matomo.org/docs/custom-dimensions/)). If Custom Dimension ID is `2` use `dimension2=dimensionValue` to send a value for this dimension. The configured Custom Dimension has to be in scope "Action".
* `ca` &mdash; Stands for custom action. `&ca=1` can be optionally sent along any tracking request that isn't a page view. For example it can be sent together with an event tracking request `e_a=Action&e_c=Category&ca=1`. The advantage being that should you ever disable the event plugin, then the event tracking requests will be ignored vs if the parameter is not set, a page view would be tracked even though it isn't a page view. For more background information check out [#16570](https://github.com/matomo-org/matomo/issues/16569). Do not use this parameter together with a `ping=1` tracking request.

### Optional [Page Performance](https://matomo.org/faq/how-to/how-do-i-see-page-performance-reports/) info

For pageviews the following page performance metrics can be tracked:

* `pf_net` &mdash; Network time. How long it took to connect to server.
* `pf_srv` &mdash; Server time. How long it took the server to generate page.
* `pf_tfr` &mdash; Transfer time. How long it takes the browser to download the response from the server
* `pf_dm1` &mdash; Dom processing time. How long the browser spends loading the webpage after the response was fully received until the user can start interacting with it.
* `pf_dm2` &mdash; Dom completion time. How long it takes for the browser to load media and execute any Javascript code listening for the DOMContentLoaded event.
* `pf_onl` &mdash; Onload time. How long it takes the browser to execute Javascript code waiting for the window.load event.

All page performance metrics expect a value in milliseconds.

### Optional [Event Tracking](https://matomo.org/docs/event-tracking/) info
* `e_c` &mdash; The event category. Must not be empty. (eg. Videos, Music, Games...)
* `e_a` &mdash; The event action. Must not be empty. (eg. Play, Pause, Duration, Add Playlist, Downloaded, Clicked...)
* `e_n` &mdash; The event name.  (eg. a Movie name, or Song name, or File name...)
* `e_v` &mdash; The event value. Must be a float or integer value (numeric), not a string.

Note: Trailing and leading whitespaces will be trimmed from parameter values for `e_c`, `e_a` and `e_n`. Strings filled with whitespaces will be considered as (invalid) empty values.

### Optional [Content Tracking](https://matomo.org/docs/content-tracking/) info
* `c_n` &mdash; The name of the content. For instance 'Ad Foo Bar'
* `c_p` &mdash; The actual content piece. For instance the path to an image, video, audio, any text
* `c_t` &mdash; The target of the content. For instance the URL of a landing page
* `c_i` &mdash; The name of the interaction with the content. For instance a 'click'

To track a content impression set `c_n` and optionally `c_p` and `c_t`. To track a content interaction set `c_i` and `c_n` and optionally `c_p` and `c_t`. To map an interaction to an impression make sure to set the same value for `c_n` and `c_p`. It is recommended to set a value for `c_p`.

### Optional [Ecommerce](https://matomo.org/docs/ecommerce-analytics/) info

Use the following values to record a cart and/or an ecommerce order.

* you must set `&idgoal=0` in the request to track an ecommerce interaction: cart update or an ecommerce order.
* `ec_id` &mdash; The unique string identifier for the ecommerce order (required when tracking an ecommerce order)
* `ec_items` &mdash; Items in the Ecommerce order. This is a JSON encoded array of items. Each item is an array with the following info in this order: 
  * item sku (required), 
  * item name (or if not applicable, set it to an empty string), 
  * item category (or if not applicable, set it to an empty string), 
  * item price (or if not applicable, set it to 0), 
  * item quantity (or if not applicable, set it to 1). 

 An example value of `ec_items` would be: `%5B%5B%22item1%20SKU%22%2C%22item1%20name%22%2C%22item1%20category%22%2C11.1111%2C2%5D%2C%5B%22item2%20SKU%22%2C%22item2%20name%22%2C%22%22%2C0%2C1%5D%5D` (URL decoded version is: `[["item1 SKU","item1 name","item1 category",11.1111,2],["item2 SKU","item2 name","",0,1]]`).
* `revenue` &mdash; The grand total for the ecommerce order (required when tracking an ecommerce order)
* `ec_st` &mdash; The sub total of the order; excludes shipping.
* `ec_tx` &mdash; Tax Amount of the order
* `ec_sh` &mdash; Shipping cost of the Order
* `ec_dt` &mdash; Discount offered

### Other parameters (require authentication via `token_auth`)

The following parameters require that you set `&token_auth=` to the token\_auth value of the Super User, or a user with *write* or *admin* permission to the website visits are being tracked for.

* `token_auth` &mdash; 32 character authorization key used to authenticate the API request. We recommend creating a user specifically for accessing the Tracking API, and give the user only *write* permission on the website(s).
* `cip` &mdash; Override value for the visitor IP (both IPv4 and IPv6 notations supported).
* `cdt` &mdash; Override for the datetime of the request (normally the current time is used). This can be used to record visits and page views in the past. The expected format is either a datetime such as: `2011-04-05 00:11:42` (remember to URL encode the value!), or a valid UNIX timestamp such as `1301919102`. The datetime must be sent in UTC timezone.
 _Note: if you record data in the past, you will need to [force Piwik to re-process reports for the past dates](https://matomo.org/faq/how-to/#faq_59)._
 If you set `cdt` to a datetime older than 24 hours then `token_auth` must be set. If you set `cdt` with a datetime in the last 24 hours then you don't need to pass `token_auth`.
* `country` &mdash; An override value for the country. Should be set to the two letter country code of the visitor (lowercase), eg **fr**, **de**, **us**.
* `region` &mdash; An override value for the region. Should be set to a ISO 3166-2 region code, which are used by [MaxMind's](https://www.maxmind.com?rId=piwik) and [DB-IP's](https://db-ip.com/db/?refid=mtm) GeoIP2 databases. See [here](https://www.iso.org/obp/ui/#search/code/) for a list of them for every country.
* `city` &mdash; An override value for the city. The name of the city the visitor is located in, eg, **Tokyo**.
* `lat` &mdash; An override value for the visitor's latitude, eg _22.456_.
* `long` &mdash; An override value for the visitor's longitude, eg _22.456_.

### Media Analytics parameters

Analytics for your Media content (video players and audio players) can be recorded
using the premium [Media Analytics](https://plugins.matomo.org/MediaAnalytics) plugin's HTTP Tracking API parameters.

Activity and consumption of your videos and audios can be measured via the parameters `ma_id`, `ma_ti`, `ma_re`,
`ma_mt` , `ma_pn`, `ma_st`, `ma_le`, `ma_ps`, `ma_ttp`, `ma_w`, `ma_h`, `ma_fs`, `ma_se`.

Learn more in the [Media Analytics HTTP Tracking API Reference](/guides/media-analytics/custom-player#media-analytics-http-tracking-api-reference).

### Queued Tracking parameters

[Queued Tracking](https://plugins.matomo.org/QueuedTracking) can scale your large traffic Matomo (Piwik) service by queuing tracking requests in Redis or Mysql for better performance and reliability when you experience peaks.

* `queuedtracking` &mdash; When set to `0` (zero), the queued tracking handler won't be used and instead the tracking request will be executed directly. This can be useful when you need to debug a tracking problem or want to test that the tracking works in general.

### Other parameters

* `send_image` &mdash; If set to 0 (`send_image=0`) Piwik will respond with an HTTP 204 response code instead of a GIF image. This improves performance and can fix errors if images are not allowed to be obtained directly (eg Chrome Apps). Available since Piwik 2.10.0
* `ping`  &mdash; If set to 1 (`ping=1`), the request will be a [Heartbeat request](https://matomo.org/faq/how-to/faq_21824/) which will not track any new activity (such as a new visit, new action or new goal). The heartbeat request will only update the visit's total time to provide accurate "Visit duration" metric when this parameter is set. It won't record any other data. This means by sending an additional tracking request when the user leaves your site or app with `&ping=1`, you fix the issue where the time spent of the last page visited is reported as 0 seconds.

## Tracking Bots

By default Piwik does not track bots. If you use the Tracking HTTP API directly, you may be interested in tracking bot requests. To enable Bot Tracking in Piwik, set the parameter `&bots=1` in your requests to `matomo.php`.

## Example Tracking Request

Here is an example of a real tracking request used by the [Matomo Mobile app](https://matomo.org/mobile/) when anonymously tracking Mobile App usage:

    https://matomo-server/matomo.php?_cvar={"1":["OS","iphone 5.0"],"2":["Piwik Mobile Version","1.6.2"],"3":["Locale","en::en"],"4":["Num Accounts","2"]}&action_name=View settings&url=http://mobileapp.matomo.org/window/settings &idsite=8876&rand=351459&h=18&m=13&s=3 &rec=1&apiv=1&cookie=1&urlref=https://iphone.mobileapp.piwik.org&_id=af344a398df83874 &_idvc=19&res=320×480&

_Note: for clarity, parameter values are not URL encoded in this example._

**Explanation:** this URL has custom variables for the OS, Piwik version, number of accounts created. It tracks an event named **View settings** with a fake URL, records the screen resolution and also includes a custom unique ID generated to ensure all requests for the same Mobile App user will be recorded for the same visit in Piwik.

## Bulk Tracking

Some applications such as the [Piwik log importer](https://matomo.org/log-analytics/), have to track many visits, sometimes tens, hundreds, thousands or even more all at once. Tracking these requests with one HTTP request per visit or action can result in _enormous_ delays due to the amount of time it takes to send an HTTP request, Using the bulk tracking feature, however, these requests can be sent all at once making the application far more efficient.

To send a bulk tracking request, an HTTP POST must be made with a JSON object to the Piwik tracking endpoint. The object must contain the following properties:

* `requests` &mdash; an array of individual tracking requests. Each tracking request should be the query string you'd send if you were going to track that action individually.
  * Note that for Piwik to store your tracking data accurately, your tracking requests should be sent in chronological order (the oldest requests should appear first).
* `token_auth` &mdash; (optional) token_auth which is found in the API page. Specify this only needed if you use any of the parameters that require `token_auth`

### Example Bulk Requests

This is an example of the payload of a bulk tracking request:

    {
       "requests": [
          "?idsite=1&url=https://example.org&action_name=Test bulk log Pageview&rec=1",
          "?idsite=1&url=https://example.net/test.htm&action_name=Another bulk page view&rec=1"
       ],
       "token_auth": "33dc3f2536d3025974cccb4b4d2d98f4"
    }

Here is the command to send this request to Piwik using curl (without `token_auth` which is optional in this case):

    curl -i -X POST -d '{"requests":["?idsite=1&url=https://example.org&action_name=Test bulk log Pageview&rec=1","?idsite=1&url=http://example.net/test.htm&action_name=Another bulk page view&rec=1"]}' https://matomo.example.com/matomo.php

This will track **two** actions using only **one** HTTP request to Piwik.

## Debugging the Tracker

To verify that your data is being tracked properly, you can enable debug logging in the Piwik tracking file, **matomo.php**.

**Tracking requests will then output the tracking log messages rather than displaying a 1*1 transparent GIF beacon. For security reasons, this should not be done in production or only for a very short time frame.**


Follow these steps to enable and view debug logging for the tracker:

1. In your config file `path/to/matomo/config/config.ini.php`, write the following:

        [Tracker]
        debug = 1
        
Since Matomo 3.10 to enable the profiling of SQL queries you additionally need to enable:

        [Tracker]
        enable_sql_profiler = 1
        
2. Look at the HTTP requests that are sent to Piwik.
    * If the requests take place in a browser, you can use a tool such as the [Firefox Developer Edition](https://www.mozilla.org/en-US/firefox/developer/) to see all requests to **matomo.php**.
    * If the requests are triggered from your app or software directly, you can output or log the output of tracking requests and to view the debug messages.
    * You can also [log messages to file or database](https://matomo.org/faq/troubleshooting/faq_115/) (requires at least Piwik 2.15.0).

If you receive too many tracking requests and the log gets spammed by these requests or if you want to only debug some specific requests you can alternatively enable `debug_on_demand` in `config.ini.php`:

    [Tracker]
    debug_on_demand = 1


In this case messages will be only logged for Tracker requests that have a URL parameter `&debug=1` set. This is considered more secure but should be still only enabled for a short time frame.

## Learn more

* For **a list of tracking clients** see this [page](/guides/tracking-api-clients).
* To learn more **about geolocation** read the [GeoIP user docs](https://matomo.org/docs/geo-locate/).
* To learn **about Piwik's JavaScript tracker** read our [documentation for the tracker](https://matomo.org/docs/javascript-tracking/).

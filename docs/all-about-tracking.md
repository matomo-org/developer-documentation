# All About Tracking

<!-- Meta (to be deleted)
Purpose:
- describe how server-side tracking works (include notes such as scheduled task running, ),
- how clients should work,
- how plugins can hook into tracking process,
- tracker cache,
- tracker API (query parameters),
- how data is inserted into each table (log_action, conversion, etc.),
- referrer detection (and other stuff, ie how conversions are detected),
- how plugins can track their own data
- about bulk tracking requests

Audience: developers interested in the tracking API, devs interested in tracking new data, devs interested in understanding how the tracker works

Expected Result: developers who know how the tracker works, know where the tracking API reference is and devs who know how to track new data

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
- probably something. not an expert in the tracker and the code can be hard to follow.
- wrote while tired, probably bad writing
- JavaScript tracking client info is missing. don't really want to put it here.
-->

## About this guide

**Read this guide if**

* you'd like to know **how to use the HTTP tracking API**
* you'd like to know **how plugins can extend the tracker and track new data**
* you'd like to know **the tracking system extracts information from tracking requests**
* you'd like to know **how the tracker inserts data into log tables**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* are knowledgeable about how HTTP works (eg, request & response headers),
* have a general understanding of extending Piwik (if not, read our [Getting Started](#) guide),

## Tracker Functionality

The Piwik Tracker tracks the data that Piwik analyzes. Tracker clients send HTTP requests to Piwik and based on the values of certain query parameters and HTTP request fields, visits, actions and conversions are tracked. This document explains exactly how this process works.

### Types of Tracking Requests

Different types of tracking requests will do different things. There are three types of tracking requests that the Piwik Tracker will recognize. These are requests to track visitor actions, requests to manually convert a goal and requests to track ecommerce orders. These three actions cannot be done simultaneously.

#### Visit Tracking Request

This type of tracking request is one that tracks visit related information such as a pageview, outlink or download. When the tracker receives this type of request, it will do the following things:

1. checks if this visit is from a returning visitor
2. if this is not a returning visitor, a new visit is tracked
3. if this is a returning visitor, the tracker examines the last visit action of the visitor. If the action currently being tracked occurred over 30 minutes after the last known action of the visitor, a new visit is created. If not, the ongoing visit is queried.
4. the visit action is recorded

##### Visitor Detection

Returning visitors are detected by checking if the visitor ID sent with the tracking request is a known visitor ID or if the visit configuration used by the visitor has been seen before.

The visitor ID is set by the tracking client and stored as a cookie. When the tracker finds a visitor ID in the database that matches the one in the cookie, we know there is a returning visit. We don't, however, use the visitor ID alone as it is not always valid. Some browsers (or just browsers that are configured a certain way) will create new visitor IDs on each pageview. This is why we also try to match a visit's configuration.

The configuration of a visit includes:

* the operating system used,
* the browser used,
* the browser's version,
* the visitor's IP address,
* the language used in the browser
* and the browser plugins enabled.

If a visitor ID does not match (or there is no visitor ID) and the tracker sees a configuration that is exactly the same as the current visit's, it will assume the new visit is from that returning visitor.

The use of visit configuration does create a risk of attributing a visit to the wrong visitor, but we believe this inaccuracy is far better than the creation of a new visit on every pageview.

##### Action Type Creation

Visit actions are not recorded with the URLs and page titles of the actions. Instead, the URLs and page titles are stored in [Action Type](#) entities and visit actions link to them by ID.

Action types are created when visit actions with new URLs, page titles or other action data are found.

#### Geolocation

The location of a visitor is provided by an implementation of the [LocationProvider](#) base type. The implementation to use is stored in the **usercountry.location_provider** option.

Currently, Piwik provides two ways of geolocating browser visits. The default method guesses the country by the browser language used. The other method uses a [GeoIP](#) database to geolocate visits using the visitor's IP address.

New LocationProviders can be created simply by subclassing the [LocationProvider](#) class and making sure the file is included with the rest of a plugin. Piwik will automatically know it is available.

#### Conversion Tracking Request

Conversion tracking requests are tracking requests that have the `idGoal` query parameter set. These requests do just one thing: they trigger a conversion for a particular goal.

TODO: looks like visits and actions are recorded too?

#### Ecommerce Tracking

TODO: 

### The Tracker Cache

The tracker mostly queries and manipulates the log tables, but sometimes it needs to use other data. For example, options that tell the tracker what visits to exclude and which location provider to use when geolocating. The queries used to get this data are not expensive, but doing them on every tracking request would result in performance degradation.

So instead, the tracker caches this information in a file that is read on every request. When users change this data in the database, the relevant part of Piwik will invalidate the cache so on the next tracking request the tracker will re-query and cache the data.

#### Adding more to the tracker cache

Plugins can add data to the tracker cache by handling the [Tracker.setTrackerCacheGeneral](#) event. If a plugin needs to add data that is associated with a specific site, it can add the data through the [Site.getSiteAttributes](#) event.

When data that should be in the tracker cache is changed or removed, the [Cache::deleteTrackerCache](#) method should be called so the next tracking request will query and cache the new data.

### Scheduled Tasks

Tracking requests can also execute scheduled tasks. This is done so scheduled tasks will still execute even for users who don't setup the [archive.php cron script](#).

Scheduled tasks will only execute if the tracker is not authenticated, if the tracker was not executed through the command line and if the `[Tracker] record_statistics` INI config option is set to `1`. They are always executed after the tracking request is handled.

TODO: authenticated to any user or just super user?

### Debugging the Tracker

To verify that your data is being tracked properly, you can enable debug logging in the Piwik tracking file, **piwik.php**.

**Tracking requests will then output the tracking log messages rather than displaying a 1*1 transparent GIF beacon.**

Follow these steps to enable debug logging for the tracker:

1. In the file `path/to/piwik/piwik.php`, you can set `$GLOBALS['PIWIK_TRACKER_DEBUG'] = true;`
2. Look at the HTTP requests that are sent to Piwik.
    * If the requests take place in a browser, you can use a tool like the [Firebug](http://getfirebug.com/) to see all requests to **piwik.php**.
    * If the requests are triggered from your app or software directly, you can output or log the output of tracking requests and to view the debug messages.

## Extending the Tracker

Plugins can add extra data to tracked visits by handling the [Tracker.newVisitorInformation](#) event. The UserCountry plugin uses this event to add geolocation information to a visit and the DevicesDetection plugin uses this event to add device information beyond the operating system used.

Plugins that want to add new data to the log tables themselves can alter the tables to add new columns. See [this section in the Peristence & the MySQL Backend guide](#).

## The Tracking Web API

To track page views, events, visits, you have to send a HTTP request to your Tracking REST API endpoint, for example, **http://your-piwik-domain.tld/piwik.php** with the correct query parameters set.

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
  * `apiv` **(recommended)** &mdash; The Tracking API version to use, for example, `&apiv=1`. TODO: what's the current API version?

* Optional visitor info _(We recommend that these parameters be used if the information is available and relevant to your use case.)_

    * `urlref` &mdash; The full HTTP Referrer URL. This value is used to determine how someone got to your website (ie, through a website, search engine or campaign).
    * `_cvar` &mdash; Visit scope [custom variables](http://piwik.org/docs/custom-variables/). This is a JSON encoded string of the custom variable array (see below for an example value).
    * `_idvc` &mdash; The current count of visits for this visitor. To set this value correctly, it would be required to store the value for each visitor in your application (using sessions or persisting in a database). Then you would manually increment the counts by one on each new visit or "session", depending on how you choose to define a visit. This value is used to populate the report _Visitors > Engagement > Visits by visit number_.
    * `_viewts` &mdash; The UNIX timestamp of this visitor's previous visit. This parameter is used to populate the report _Visitors > Engagement > Visits by days since last visit_.
    * `_idts` &mdash; The UNIX timestamp of this visitor's first visit. This could be set to the date where the user first started using your sofware/app, or when he/she created an account. This parameter is used to populate the _Goals > Days to Conversion_ report.
    * `_rcn` &mdash; The Campaign name (see [Tracking Campaigns](http://piwik.org/docs/tracking-campaigns/)). Used to populate the _Referrers > Campaigns_ report. _Note: this parameter will only be used for the first pageview of a visit._
        TODO: first pageview of a visit or first of all visitors visits? (said 'first pageview of a visitor' before) (same for below)
    * `_rck` &mdash; The Campaign Keyword (see [Tracking Campaigns](http://piwik.org/docs/tracking-campaigns/)). Used to populate the _Referrers > Campaigns_ report (clicking on a campaign loads all keywords for this campaign). _Note: this parameter will only be used for the first pageview of a visit._
    * `res` &mdash; The resolution of the device the visitor is using, eg **1280x1024**.
    * `h` &mdash; The current hour (local time).
    * `m` &mdash; The current minute (local time).
    * `s` &mdash; The current second (local time).

    * `ua` &mdash; An override value for the **User-Agent** HTTP header field. The user agent is used to detect the operating system and browser used.
    * `lang` &mdash; An override value for the **Accept-Language** HTTP header field. This value is used to detect the visitor's country if [GeoIP](http://piwik.org/faq/troubleshooting/#faq_65) is not enabled.

* Optional action/event info

    * `cvar` &mdash; Page scope [custom variables](#). This is a JSON encoded string of the custom variable array (see below for an example value).
    * `link` &mdash; An external URL the user has opened. Used for tracking outlink clicks. We recommend to also set the **url** parameter to this same value.
    * `download` &mdash; URL of a file the user has downloaded. Used for tracking downloads. We recommend to also set the **url** parameter to this same value.
    * `search` &mdash; The Site Search keyword. When specified, the request will not be tracked as a normal pageview but will instead be tracked as a [Site Search](#) request.
    * `search_cat` &mdash; when **search** is specified, you can optionally specify a search category with this parameter.
    * `search_count` &mdash; when **search** is specified, we also recommend to set the search\_count to the number of search results displayed on the results page.
      TODO: removed this text, not sure if it has any important info: "Piwik will then specifically report "No Result Search Keyword", ie. keywords that were tracked with &search_count=0"
    * `idgoal` &mdash; If specified, the tracking request will trigger a conversion for the goal of the website being tracked with this ID.
    * `revenue` &mdash; A monetary value that was generated as revenue by this goal conversion. Only used if **idgoal** is specified in the request.
    * `gt_ms` &mdash; The amount of time it took the server to generate this action, in milliseconds. This value is used to process the **Avg. generation time** column in the Page URL and Page Title reports, as well as a site wide running average of the speed of your server. _Note: when using the Javascript tracker this value is set to the ime for server to generate response + the time for client to download response._

* Special parameters

    The following parameters require that you set `&token_auth=` to the token\_auth value of the Super User or a user with admin access to the website visits are being tracked for.

    * `token_auth` &mdash; 32 character authorization key used to authenticate the API request.
    * `cip` &mdash; Override value for the visitor IP (both IPv4 and IPv6 notations supported).
    * `cdt` &mdash; Override for the datetime of the request (normally the current time is used). This can be used to record visits and page views in the past. The expected format is: `2011-04-05 00:11:42` (remember to URL encode the value!).
      _Note: if you record data in the past, you will need to [force Piwik to re-process reports for the past dates](#)._
    * `cid` &mdash; defines the visitor ID for this request. You must set this value to exactly a 16 character hexadecimal string (containing only characters 01234567890abcdefABCDEF). When specified, the Visitor ID will be "enforced". This means that if there is no recent visit with this visitor ID, a new one will be created. If a visit is found in the last 30 minutes with your specified Visitor Id, then the new action will be recorded to this existing visit.  TODO: can't _id just be used in this case?
    * `new_visit` &mdash; If set to 1, will force a new visit to be created for this action. This feature is also [available in Javascript](http://piwik.org/faq/how-to/#faq_187).
    * `country` &mdash; An override value for the country. Should be set to the two letter country code of the visitor (lowercase), eg **fr**, **de**, **us**.
    * `region` &mdash; An override value for the region. Should be set to the two letter region code as defined by [MaxMind's](http://www.maxmind.com?rId=piwik) GeoIP databases. See [here](http://dev.maxmind.com/static/maxmind-region-codes.csv) for a list of them for every country (the region codes are located in the second column, to the left of the region name and to the right of the country code).
    * `city` &mdash; An override value for the city. The name of the city the visitor is located in, eg, **Tokyo**.
    * `lat` &mdash; An override value for the visitor's latitude, eg _22.456_.
    * `long` &mdash; An override value for the visitor's longitude, eg _22.456_.

#### Tracking Bots

By default Piwik does not track bots. If you use the Tracking Web API directly, you may be interested in tracking bot reqeusts. To enable Bot Tracking in Piwik, set the parameter &**bots**=1 in your requests to piwik.php.

#### Example Tracking Request

Here is an example of a real tracking request used by the [Piwik Mobile app](http://piwik.org/mobile/) for the anonymous Piwik Mobile Analytics:

TODO: what does 'anonymous Piwik Mobile Analytics' mean?

    http://piwik-server/piwik.php?_cvar={"1":["OS","iphone 5.0"],"2":["Piwik Mobile Version","1.6.2"],"3":["Locale","en::en"],"4":["Num Accounts","2"]}&action_name=View settings&url=http://mobileapp.piwik.org/window/settings &idsite=8876&rand=351459&h=18&m=13&s=3 &rec=1&apiv=1&cookie= &urlref=http://iphone.mobileapp.piwik.org&_id=af344a398df83874 &_idvc=19&res=320×480&

_Note: for clarity, parameter values are not URL encoded in this example._

**Explanation:** this URL has custom variables for the OS, Piwik version, number of accounts created. It tracks an event named **View settings** with a fake URL, records the screen resolution and also includes a custom unique ID generated to ensure all requests for the same Mobile App user will be recorded for the same visit in Piwik.

### Bulk Tracking

Some applications such as the [Piwik log importer](http://piwik.org/log-analytics/), have to track many visits, sometimes tens, hundreds, thousands or even more all at once. Tracking these requests with one HTTP request per visit or action can result in _enormous_ delays due to the amount of time it takes to send an HTTP request, Using the bulk tracking feature, however, these requests can be sent all at once making the application far more efficient.

To send a bulk tracking request, an HTTP POST must be made with a JSON object to the Piwik tracking endpoint. The object must contain the following properties:

* `token_auth` &mdash; token_auth can be found in the API page. Provide at least Admin or Super User permission to use
* `requests` &mdash; an array of individual tracking requests. Each tracking request should be the query string you'd send if you were going to track that action individually.

#### Example Requests

This is an example of the payload of a bulk tracking request:

    {
       "requests": [
          "?idsite=1&url=http://example.org&action_name=Test bulk log Pageview&rec=1",
          "?idsite=1&url=http://example.net/test.htm&action_name=Another bul k page view&rec=1"
       ],
       "token_auth": "33dc3f2536d3025974cccb4b4d2d98f4"
    }

It can be sent to Piwik using curl with the following command:

    curl -i -X POST -d '{"requests":["?idsite=1&url=http://example.org&action_name=Test bulk log Pageview&rec=1","?idsite=1&url=http://example.net/test.htm&action_name=Another bulk page view&rec=1"],"token_auth":"33dc3f2536d3025974cccb4b4d2d98f4"}' http://piwik.example.com/piwik.php

This will track **two** actions using only **one** HTTP request to Piwik.

## Learn more

* For **a list of tracking clients** see this [page](#).
* To learn **how Piwik persists the log data that is tracked** read our [Persistence & the MySQL Backend](#) guide.
* To learn more **about geolocation** read the [GeoIP user docs](#).
* To learn **about Piwik's JavaScript tracker** read our [documentation for the tracker](#).
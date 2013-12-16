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

[Read more](http://developer.piwik.org/api-reference/tracking-api#debugging-the-tracker).


## Extending the Tracker

Plugins can add extra data to tracked visits by handling the [Tracker.newVisitorInformation](#) event. The UserCountry plugin uses this event to add geolocation information to a visit and the DevicesDetection plugin uses this event to add device information beyond the operating system used.

Plugins that want to add new data to the log tables themselves can alter the tables to add new columns. See [this section in the Peristence & the MySQL Backend guide](#).

## The Tracking HTTP API

To track page views, events, visits, you have to send a HTTP request to your Tracking HTTP API endpoint, for example, **http://your-piwik-domain.tld/piwik.php** with the correct query parameters set.

[View the Tracking HTTP API Reference docs.](/api-reference/tracking-api)

## Learn more

* For **a list of tracking clients** see this [page](http://piwik.org/docs/tracking-api/).
* To learn more **about geolocation** read the [GeoIP user docs](http://piwik.org/docs/geo-locate/).
* To learn **about Piwik's JavaScript tracker** read our [documentation for the tracker](http://piwik.org/docs/javascript-tracking/).
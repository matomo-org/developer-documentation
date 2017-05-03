---
category: Integrate
title: JavaScript Tracker API Reference
---
# Media Analytics JavaScript Tracker API Reference

This guide is the JavaScript Tracker API Reference for [Media Analytics](https://www.media-analytics.net/).

You may also be interested in the Media Analytics [Reporting HTTP API Reference](https://developer.piwik.org/api-reference/reporting-api#MediaAnalytics). 

## Calling MediaAnalytics tracker methods

In the `piwik.js` tracker we differentiate between two kind of methods:

* Calling a **tracker instance method** affects only a specific Piwik tracker instance. In the docs you can 
  identify a tracker method when the method name contains a single dot (`.`), for example 
  `MediaAnalytics.disableTrackEvents`.
* Calling a **static method** affects all created tracker instances. In the docs you can identify a static method when 
  the method name contains `::`, for example `MediaAnalytics::removePlayer`.

In most cases only one Piwik tracker will be used so the only difference is how you call that method:

* Tracker methods are called via `_paq.push(['MediaAnalytics.$methodName']);` or on a tracker instance directly eg. 
  `Piwik.getAsyncTracker().MediaAnalytics.$methodName();`
  
* Static methods are called via `_paq.push(['MediaAnalytics::$methodName']);` or directly on the `Piwik.MediaAnalytics` object,
  eg. `Piwik.MediaAnalytics.$methodName()`.

If you do not want to use the `_paq.push` methods, you need to define a `window.piwikMediaAnalyticsAsyncInit` method 
that is called as soon as the media tracker has been initialized:

```js
window.piwikMediaAnalyticsAsyncInit = function () {
    Piwik.MediaAnalytics.removePlayer('youtube'); 
};
```

## Static methods

### `scanForMedia(documentOrHTMLElementToScanForMedia)`.
When this method is called, the MediaAnalytics tracker will search the DOM for new videos and audio and start tracking 
that media. As a parameter you can optionally pass an `HTMLElement` if only a part of the DOM should be searched for 
new media. This is especially useful for one page web applications. If no such parameter is given, the entire DOM will 
be search for new media elements. 

Example:
```js
_paq.push(['MediaAnalytics::scanForMedia']);
_paq.push(['MediaAnalytics::scanForMedia', document.getElementById('test')]);
// or 
Piwik.MediaAnalytics.scanForMedia();
Piwik.MediaAnalytics.scanForMedia(document.getElementById('test'));
```

### `setPingInterval(pingIntervalInSeconds)`

By default, the tracker sends a tracking request to your Piwik every 5 seconds while a media is currently playing. 
This is needed to track the current position within the video and to update for how long the media has been played.
If you want to send this update more or less frequently, you can set a different ping interval using this method.

### `removePlayer(playerName)`

If you do not want to track any media of a certain player, you can disable that player by calling this method.
`playerName` should be either `'html5'`, `'vimeo'`, `'youtube'` or `'jwplayer'`.

### `addPlayer(playerName, player)`

Allows you to track a [custom media player](/guides/media-analytics/custom-player). This is useful if you are using a 
media player that is not yet supported by the MediaAnalytics plugin. We might also be able to support new players within 
this plugin, [let us know which media player you use](https://piwik.org/support).

### `disableMediaAnalytics()`

Allows you to completely disable the tracking of any media. This is useful if you for example manage multiple websites
in your Piwik and there are some sites where you do not want to track any media. If called early in your tracking code
 or via the `piwikMediaAnalyticsAsyncInit` method, it will not even search for media on your web page.

### `enableMediaAnalytics()`

If you have disabled the tracking of media via `disableMediaAnalytics()` you can enable it at a later point via this method.
It is recommended to call `scanForMedia()` just after enabling the media tracking to make sure it detects all media on 
your website or in your application.

### `isMediaAnalyticsEnabled()`

Allows you to detect whether the tracking of media is currently enabled. Returns a boolean `true` or `false`.

### `enableDebugMode()`

Enables the debug mode that logs debug information to the developer console of your browser. This should **not** be 
enabled in production.

### `setPiwikTrackers()`

Allows you to set the tracker instances the tracker should use when tracking the progress and events of Media. Can be either
 a single tracker instance, or an array of Piwik tracker instances. This is useful when you are working with multiple Piwik
 tracker instances using `Piwik.getTracker` instead of `Piwik.addTracker`. 
 
### `getPiwikTrackers()`

Returns an array of Piwik tracker instances that are used by the Media Analytics plugin. By default, this will return the same
as `Piwik.getAsyncTrackers()` and will return all tracker instances that were created eg via `Piwik.addTracker` or 
`_paq.push(['addTracker']);` unless custom Piwik tracker instances were set via `setPiwikTrackers()`.

### `mediaType`

The `mediaType` property defines constants that are useful when you track the usage of a [custom media player](/guides/media-analytics/custom-player)
via the `addPlayer()` method.

* `mediaType.VIDEO` -  Defines the current media is a video
* `mediaType.AUDIO` -  Defines the current media is an audio

You can access this property as follows: `Piwik.MediaAnalytics.mediaType.VIDEO`.

### `element`

* `element.getAttribute(htmlElement, attributeName)` Lets you read the value of an HTML attribute. If the attribute is not set, it will return `null`.
* `element.setAttribute(htmlElement, attributeName, attributeValue)` Lets you set a value of an HTML attribute on an HTML element.
* `element.isMediaIgnored(htmlElement)` Detects whether the given element is supposed to be ignored when tracking media (has a `data-piwik-ignore` attribute).
* `element.getMediaTitle(htmlElement)` Tries to detect a media title from one of the HTML attributes `data-piwik-title`, `title` or `alt`. Returns `null` if no title can be found.
* `element.getMediaResource(htmlElement, actualResource)` If the element has set a value for the `data-piwik-resource` attribute, it will return that value and `actualResource` otherwise. 
* `element.isFullscreeen(htmlElement)` Detects whether the given element (video) is currently viewed in full screen.

## Tracker methods

### `disableTrackEvents()`

Disables the tracking of events like `play`, `pause` or `resume` while still tracking the media usage. When calling 
this method no events for your media will be shown in "Actions => Events" and neither in the [Visitor log](https://piwik.org/docs/user-profile/).

Example:

```js
// disables the tracking of events on all Piwik trackers
_paq.push(['MediaAnalytics.disableTrackEvents']); 

// or if you are using multiple Piwik trackers and only want to disable it for a specific tracker:
var tracker = Piwik.getAsyncTracker(piwikUrl, piwikSiteId);
tracker.MediaAnalytics.disableTrackEvents();
```

### `enableTrackEvents()`

If the tracking of events was disabled via `disableTrackEvents()`, you can enable it again using this method.

### `isTrackEventsEnabled()`

Detects if the tracking of events is currently enabled or disabled. Returns a boolean `true` or `false`.

### `disableTrackProgress()`

Disables the tracking of media progress while still tracking events like `play`, `pause` or `resume`. Calling this 
method means there will be no data available under the "Media" menu category (like how often or how long a 
media was played). 

### `enableTrackProgress()`

If the tracking of progress was disabled via `disableTrackProgress()`, you can enable it again using this method.
 
### `isTrackProgressEnabled()`
 
Detect if the tracking of progress is currently enabled or disabled. Returns a boolean `true` or `false`.


## What to read next

You may be interested in the [Media Analytics HTTP Tracking API Reference](/guides/media-analytics/custom-player#media-analytics-http-tracking-api-reference),
 or the [Reporting HTTP API Reference](https://developer.piwik.org/api-reference/reporting-api#MediaAnalytics).
 If you use a player other than Youtube / Vimeo / HTML5 / JwPlayer / Flowplayer / Video.js, learn about [implementing analytics for your Custom Video Player](/guides/media-analytics/custom-player).

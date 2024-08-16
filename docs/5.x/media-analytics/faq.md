---
category: Integrate
---
# Developer FAQ

This page is the Developer FAQ for [Media Analytics](https://www.media-analytics.net/). You may also be interested in the [Media Analytics User FAQs](https://matomo.org/faq/media-analytics/).

## How do I enable video analytics for Youtube videos? 

You need to add `&enablejsapi=1` to the Youtube URLs: [read more about setting up Youtube Analytics](/guides/media-analytics/setup#tracking-youtube-videos).

## How do I enable video analytics for Vimeo videos? 

Vimeo videos will be tracked by default if you use `<iframe>` embed code: [learn more about setting up Vimeo Analytics](/guides/media-analytics/setup#tracking-vimeo-videos).

## How do I enable audio analytics for SoundCloud? 

SoundCloud will be tracked by default if you use the `<iframe>` embed code.

## How do I enable HTML5 video analytics, and/or HTML5 audio analytics? 

HTML5 videos and audio will be tracked by default, giving you a wide range of analytics reports for your HTML5 `<video>` and `<audio>` elements.
Learn more about [HTML5 video analytics](/guides/media-analytics/setup#tracking-html5-videos) and [HTML5 Audio analytics](/guides/media-analytics/setup#tracking-html5-audios).  

## I have a single page website or a web application, how can I re-scan the DOM to find new media that was added after the initial page load for example via Ajax / XHR? 

You can re-scan the entire document for new media like this:

```js
_paq.push(['MediaAnalytics::scanForMedia']);
```
 
If you have only updated parts of your web page, you can search for newly added videos and audio only in that area by passing a 
DOM element as a second parameter:

```js
var updatedElement = document.getElementById('justUpdatedElement');
_paq.push(['MediaAnalytics::scanForMedia', updatedElement]);
```
 
## As a developer I want to see more details about the logged data, is it possible? 

Yes, you can enable the debug mode by calling the following method:

```js
_paq.push(['MediaAnalytics::enableDebugMode']);
```
 
Calling this method will start logging all tracking requests and some more information to the developer 
console of your browser. 

## Is it possible to change the ping interval when a media is played?  

Yes, it is possible by calling the method `setPingInterval`. By default, an update is sent every 5 seconds. 
Sending the ping more frequently can be useful to get a bit more accurate statistics, sending it less frequently can
be useful to reduce the amount of traffic your server has to handle.

```js
var intervalInSeconds = 2;
_paq.push(['MediaAnalytics::setPingInterval', intervalInSeconds]);
```

Make sure to call this method as early as possible, for example just after `_paq.push(['setSiteId', 'X']);`

## How do I setup media analytics when using multiple Piwik JavaScript trackers?

Piwik lets you track a website into different Piwik installations or into different Piwik websites. Learn more about 
using [Multiple Piwik trackers on the JavaScript Tracking guide](/guides/tracking-javascript-guide#multiple-piwik-trackers).

If you are using the regular `_paq.push` tracking method, everything will work out of the box when you create more trackers 
via `_paq.push(['addTracker', url, idsite]);`

Using `_paq.push` for multiple trackers is a good and simple way when you want to track the same data into different Piwik installations or into different Piwik websites.

```js
// configuration of first tracker
_paq.push(['setTrackerUrl', 'https://example.com/matomo.php']);
_paq.push(['setSiteId', 1]);
// configuration of second tracker
_paq.push(['addTracker', 'https://example.com/matomo.php', 2]);
```

If you are working with Piwik tracker instances because you want to configure each tracker instance differently and track
different data into each Piwik, you need to set the tracker instances manually:

```js
window.matomoAsyncInit = function () {
    // This works from Piwik 2.17.1. Before 2.17.1 you need to define a method
    // `window.matomoMediaAnalyticsAsyncInit` instead of `window.matomoAsyncInit`.
    
    var matomoTracker1 = Matomo.getTracker('https://example.com/matomo.php', 1);
    var matomoTracker2 = Matomo.getTracker('https://example.com/matomo.php', 2);
    var matomoTracker3 = Matomo.getTracker('https://example.com/matomo.php', 3);

    Matomo.MediaAnalytics.setMatomoTrackers([matomoTracker1, matomoTracker2, matomoTracker3]);

    // Media Analytics tracking is enabled by default, you can customize the tracking like this:
    matomoTracker2.MediaAnalytics.disableTrackProgress();
    matomoTracker3.MediaAnalytics.disableTrackEvents();
}
```

It is important to define these methods before the Piwik tracker file is loaded. Otherwise, your `matomoAsyncInit` 
or `matomoMediaAnalyticsAsyncInit` method will never be called.

In order to use your additional tracker(s) outside the `matomoAsyncInit` function, you will need to declare the tracker name as a global variable. For example:

```js
  var matomoTracker1;
  window.matomoAsyncInit = function () {
  matomoTracker1 = Matomo.getTracker('https://example.com/matomo.php', 1);
  }
```
This will then allow the added tracker to be used for tracking events, such as link clicks:

```js
onclick="matomoTracker1.trackEvent('Test Events', 'Click', 'Clicked X', 0);"
```

## Is it possible to not use the "paq.push" methods and instead call the MediaAnalytics tracker methods directly?

Yes. To initialize the Media tracker you need to define a callback method `window.matomoMediaAnalyticsAsyncInit`
which will be executed as soon as the media tracker is initialized. As soon as this callback is called, you can be sure
that the `Matomo.MediaAnalytics` object is defined.

In the `matomo.js` tracker we differentiate between two kind of methods:

* Calling a **tracker instance method** affects only a specific tracker instance. In the docs you can 
  identify a tracker method when the method name contains a single dot (`.`). For example `MediaAnalytics.disableTrackEvents` 
  refers to a tracker method tracker that can be called like `tracker.MediaAnalytics.disableTrackEvents()`.
* Calling a **static method** affects all created tracker instances. In the docs you can identify a static method when 
  the method name contains `::`. For example `MediaAnalytics::removePlayer` refers to a static method 
  `Matomo.MediaAnalytics.removePlayer()`.

```js
window.matomoMediaAnalyticsAsyncInit = function () {
    // static methods
    var intervalInSeconds = 2;
    Matomo.MediaAnalytics.removePlayer('youtube'); 
    Matomo.MediaAnalytics.setPingInterval(intervalInSeconds);
     
    // tracker methods
    var tracker = Matomo.getAsyncTracker(); 
    // get tracker instance if you do not have a reference to the tracker instance yet
    tracker.MediaAnalytics.disableTrackEvents();
};
```

## Can I disable the tracking only on a specific tracker instance?

Yes. The static method `disableMediaAnalytics` disables the tracking for all of your created tracker instances.
However, the tracker methods `disableTrackEvents` and `disableTrackProgress` can be used to disable the tracking only 
for a specific tracker instance like this:

```js
window.matomoMediaAnalyticsAsyncInit = function () {
    // get tracker instance if you do not have a reference to the tracker instance yet
    var tracker = Matomo.getAsyncTracker(matomoSiteUrl, piwikSiteId); 
    tracker.MediaAnalytics.disableTrackEvents();
    tracker.MediaAnalytics.disableTrackProgress();
};
```

## How do I define a media title in case the title cannot be detected automatically?

Piwik will automatically detect the title of a video or audio in most cases. In case you are using an old version
of a media player, or an exotic media player which does not allow us to detect the title automatically, you can optionally 
define a callback method to detect the title of a video or audio manually based on your own custom logic. 

For example if you always have only on video on a page, you could fallback to use the page title as video title: 

```js
_paq.push(['MediaAnalytics::setMediaTitleFallback', function (mediaElement) {
    return document.title;
}]);
```

In case you have multiple videos on a page, or you want to detect the title relative to the video or audio element, 
you can do this based on the `mediaElement` argument:

```js
_paq.push(['MediaAnalytics::setMediaTitleFallback', function (mediaElement) {
    return $(mediaElement).parent().find('h2').text();
}]);
```

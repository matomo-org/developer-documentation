---
category: Integrate
---
# Developer FAQ

This page is the Developer FAQ for [Media Analytics](http://www.media-analytics.net/). You may also be interested in the [Media Analytics User FAQs](https://piwik.org/faq/media-analytics/).

__How do I enable video analytics for Youtube videos?__

You need to add `&enablejsapi=1` to the Youtube URLs: [read more about setting up Youtube Analytics](/guides/media-analytics/setup#tracking-youtube-videos).

__How do I enable video analytics for Vimeo videos?__

Vimeo videos will be tracked by default if you use `<iframe>` embed code: [learn more about setting up Vimeo Analytics](/guides/media-analytics/setup#tracking-vimeo-videos).

__How do I enable HTML5 video analytics, and/or HTML5 audio analytics?__

HTML5 videos and audio will be tracked by default, giving you a wide range of analytics reports for your HTML5 `<video>` and `<audio>` elements.
Learn more about [HTML5 video analytics](/guides/media-analytics/setup#tracking-html5-videos) and [HTML5 Audio analytics](/guides/media-analytics/setup#tracking-html5-audios).  

__I have a single page website or a web application, how can I re-scan the DOM to find new media that was added after the initial page load for example via Ajax / XHR?__

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
 
__As a developer I want to see more details about the logged data, is it possible?__

Yes, you can enable the debug mode by calling the following method:

```js
_paq.push(['MediaAnalytics::enableDebugMode']);
```
 
Calling this method will start logging all tracking requests and some more information to the developer 
console of your browser. 

__Is it possible to change the ping interval when a media is played?__ 

Yes, it is possible by calling the method `setPingInterval`. By default, an update is sent every 5 seconds. 
Sending the ping more frequently can be useful to get a bit more accurate statistics, sending it less frequently can
be useful to reduce the amount of traffic your server has to handle.

```js
var intervalInSeconds = 2;
_paq.push(['MediaAnalytics::setPingInterval', intervalInSeconds]);
```

Make sure to call this method as early as possible, for example just after `_paq.push(['setSiteId', 'X'])`.

## Using MediaAnalytics when using multiple Piwik JavaScript trackers

Piwik lets you track a website into different Piwik installations or into different Piwik websites. Learn more about 
using [Multiple Piwik trackers on the JavaScript Tracking guide](/guides/tracking-javascript-guide#multiple-piwik-trackers).

__Is it possible to not use the "paq.push" methods and instead call the MediaAnalytics tracker methods directly?__

Yes. To initialize the Media tracker you need to define a callback method `window.piwikMediaAnalyticsAsyncInit`
which will be executed as soon as the media tracker is initialized. As soon as this callback is called, you can be sure
that the `Piwik.MediaAnalytics` object is defined.

In the `piwik.js` tracker we differentiate between two kind of methods:

* Calling a **tracker instance method** affects only a specific tracker instance. In the docs you can 
  identify a tracker method when the method name contains a single dot (`.`). For example `MediaAnalytics.disableTrackEvents` 
  refers to a tracker method tracker that can be called like `tracker.MediaAnalytics.disableTrackEvents()`.
* Calling a **static method** affects all created tracker instances. In the docs you can identify a static method when 
  the method name contains `::`. For example `MediaAnalytics::removePlayer` refers to a static method 
  `Piwik.MediaAnalytics.removePlayer()`.

```js
window.piwikMediaAnalyticsAsyncInit = function () {
    // static methods
    var intervalInSeconds = 2;
    Piwik.MediaAnalytics.removePlayer('youtube'); 
    Piwik.MediaAnalytics.setPingInterval(intervalInSeconds);
     
    // tracker methods
    var tracker = Piwik.getAsyncTracker(); 
    // get tracker instance if you do not have a reference to the tracker instance yet
    tracker.MediaAnalytics.disableTrackEvents();
};
```

__Can I disable the tracking only on a specific tracker instance?__

Yes. The static method `disableMediaAnalytics` disables the tracking for all of your created tracker instances.
However, the tracker methods `disableTrackEvents` and `disableTrackProgress` can be used to disable the tracking only 
for a specific tracker instance like this:

```js
window.piwikMediaAnalyticsAsyncInit = function () {
    // get tracker instance if you do not have a reference to the tracker instance yet
    var tracker = Piwik.getAsyncTracker(piwikSiteUrl, piwikSiteId); 
    tracker.MediaAnalytics.disableTrackEvents();
    tracker.MediaAnalytics.disableTrackProgress();
};
```


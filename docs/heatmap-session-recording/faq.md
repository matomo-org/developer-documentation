---
category: Integrate
---
# Developer FAQ

This page is the Developer FAQ for [Heatmap & Session Recording](https://www.heatmap-analytics.com/). You may also be interested in the [Heatmap & Session Recording User FAQs](https://piwik.org/faq/heatmap-session-recording/).

## How do I prevent the capturing of keystrokes when recording a session? 

There are two ways to do this: 

* Disable the capturing of keystrokes each time you configure a session recording in Piwik > Session Recordings > Manage.
* Add the following code to your Piwik tracking code to make sure to never record any entered keystrokes: ` _paq.push(['HeatmapSessionRecording::disableCaptureKeystrokes']);`

If you want to capture keystrokes but mask the keystrokes a user entered, have a look at [masking keystrokes](/guides/heatmap-session-recording/setup#masking-keystrokes-in-form-fields).

## Which form fields (credit card) are masked automatically when recording a session? 

Any input field with the type `password` will be masked automatically. We also mask form fields if the field name is `password`.

Additionally, we mask a form field when the name equals any of `credit-card-number, cvv, cvc, ccname, cc-name, cc-number, cardnumber`, or when the autocomplete is set to any of `cc-csc, cc-name, cc-number`. We also ignore any form element with an id of `cvv`. If a user enters between 12 and 21 digits in sequence, we assume it is a credit card number and mask it automatically. Form fields within iframes won't be recorded at all.

Want to mask the keystrokes of additional form fields? Have a look at [masking keystrokes](/guides/heatmap-session-recording/setup#masking-keystrokes-in-form-fields).

## How do I use Heatmap & Session Recording on a single-page website or web application? 

Single-page websites and web applications are supported out of the box: Heatmaps and Sessions will be recorded as expected.
When you call the `trackPageView` method in your single-page website or web app, a new page view is detected automatically.
 
To learn more about the detection of page views, have a look at the [disableAutoDetectNewPageView() API reference](/guides/heatmap-session-recording/reference#disableautodetectnewpageview)

## I am tracking "virtual" page views, how do I make sure to record all activities within a page view?

If you use the `trackPageView` method to track for example an event, a download, or to track errors, then
 Piwik assumes the user is actually viewing a new page and as a result any ongoing recording of session or heatmap activities
will be stopped. 

To solve this issue it is recommended to either:

* [track events](https://piwik.org/docs/event-tracking/) instead of tracking page views,
* or to disable the automatic detection of new page views by calling the following method: `_paq.push(['HeatmapSessionRecording::disableAutoDetectNewPageView']);`

To learn more about the detection of page views, have a look at the [disableAutoDetectNewPageView() API reference](/guides/heatmap-session-recording/reference#disableautodetectnewpageview).

## How do I capture heatmap and session activities for longer than 10 minutes per page view?  

By default, Piwik will stop the recording of new activities after 10 minutes after the last page view. You can increase this time limit by 
calling the `setMaxCaptureTime` method. We recommend to set this value to less than 29 minutes. Piwik creates a new visit 
after an inactivity of 30 minutes and there may be a risk of creating a new visit without the user being actually "active".

```js
var maxTimeInSeconds = 60 * 30;
_paq.push(['HeatmapSessionRecording::setMaxCaptureTime', maxTimeInSeconds]);
```

## How do I force or prevent the recording of my own activities?  

When you configure a heatmap or a session, you define a "sample limit" and a so called "sample rate" (also known as "traffic"). 

* The sample limit defines how many page views will be recorded in total, for example 5000. 

* The sample rate defines how likely a certain page view will be recorded when it is viewed. For example a sample rate of 10% means that approximately every 10th
page view will be recorded. To reach a sample limit of 5000 page views being recorded, you would actually need about 50.000 page views. 

When your sample rate is lower than 100%, your activities may not be actually recorded. To make sure to be included in the 
sample group, you can append a URL parameter `&pk_hsr_forcesample=1` to the currently viewed page. 
On the contrary,  to prevent your activities from being tracked you can add a URL parameter `&pk_hsr_forcesample=0`. 

## How do I record activities only for specific visitors? 

If you want to record sessions or generate heatmaps only for a certain type of visitors, you can define a trigger method that
customizes whether activities will be recorded or not. For example, you could include only users with a certain age, only users that are logged in,
 only visitors from a certain country, or only record activities during the day.

```js
_paq.push(['HeatmapSessionRecording::setTrigger', function (config) {
    // config includes for example the ID of a heatmap or a session recording
    
    if (age > 30) {
        return true;
    }
    
    return false;
}]);
```

## How do I configure multiple Piwik JavaScript trackers?

Piwik lets you track a website into different Piwik installations or into different Piwik websites. Learn more about 
using [Multiple Piwik trackers on the JavaScript Tracking guide](/guides/tracking-javascript-guide#multiple-piwik-trackers).

If you are using the regular `_paq.push` tracking method, everything will work out of the box when you create more trackers 
via `_paq.push(['addTracker', url, idsite]);`

Using `_paq.push` for multiple trackers is a good and simple way when you want to track the same data into different Piwik websites.

```js
// configuration of first tracker
_paq.push(['setTrackerUrl', 'https://example.com/piwik.php']);
_paq.push(['setSiteId', 1]);
// configuration of second tracker
_paq.push(['addTracker', 'https://example.com/piwik.php', 2]);
```

If you are working with Piwik tracker instances because you want to configure each tracker instance differently and track
different data into each Piwik, you may need to set the tracker instances manually:

```js
window.piwikAsyncInit = function () {
    var piwikTracker1 = Piwik.getTracker('https://example.com/piwik.php', 1);
    var piwikTracker2 = Piwik.getTracker('https://example.com/piwik.php', 2);
    var piwikTracker3 = Piwik.getTracker('https://example.com/piwik.php', 3);

    if (Piwik.HeatmapSessionRecording) {
        Piwik.HeatmapSessionRecording.setPiwikTrackers([piwikTracker1, piwikTracker2, piwikTracker3]);

        // You can customize the tracking like this:
        piwikTracker2.HeatmapSessionRecording.disable();
        piwikTracker3.HeatmapSessionRecording.addConfig({heatmap: {id:5}});
    }
}
```

It is important to define these methods in your website before the Piwik tracker file is loaded. Otherwise, the 
`piwikAsyncInit` method will be never called.

## How do I prevent the HTTP request to a configs.php on each page view?  

Piwik needs to detect on each page whether a heatmap or a session recording is supposed to be tracked. To do this, Piwik
issues an HTTP request to a file named `plugins/HeatmapSessionRecording/configs.php` on each page view. This request
should be very fast as no database connection will be needed and the script is optimized for performance.

Starting from Piwik 3.0.5, if your `piwik.js` is writable, it will execute this request on each page view only when actually a heatmap or session recording is configured to reduce server load. Find out if your `piwik.js` is writable by going to Administration, and open the "System Check" report. If the System Check displays a warning for "Writable Piwik.js" then [learn how to solve this](/guides/heatmap-session-recording/setup#when-the-piwikjs-in-your-piwik-directory-file-is-not-writable).
 
If you always want to prevent such a request to your server, for example to reduce the load on your server, you need to call a 
method `HeatmapSessionRecording.addConfig()` or disable the tracking completely using `HeatmapSessionRecording.disable()`.
 
Learn more about this in the [addConfig() API reference](/guides/heatmap-session-recording/reference#addconfig).

When you track your analytics data into multiple Piwik installations, the Heatmap & Session Recording plugin may be installed
only in one of the Piwik installation. To disable Heatmap & Session Recording for the Piwik instance that do not support this 
feature, call `tracker.HeatmapSessionRecording.disable();` as follows: 

```js
// configuration of first tracker which has the plugin installed
_paq.push(['setTrackerUrl', 'https://example.com/piwik.php']);
_paq.push(['setSiteId', 1]);
// configuration of second tracker which does not have the plugin installed
_paq.push(['addTracker', 'https://not-supported-piwik.com/piwik.php', 2]);

window.piwikAsyncInit = function () {
    // will never issue an HTTP request to configs.php for this Piwik instance
    var tracker = Piwik.getAsyncTracker('https://not-supported-piwik.com/piwik.php', 2);
    if (tracker.HeatmapSessionRecording) {
        tracker.HeatmapSessionRecording.disable();
    }
}
```

## How do I take a screenshot for a heatmap when the heatmap is configured manually via `addConfig()`?  

By default, Piwik will automatically take a screenshot of your web page when the first visitor takes part in your heatmap.
If you target multiple page URLs for a heatmap, you may want to force generate a screenshot for a specific page URL. 
When you configure a heatmap, you can therefore define a specific screenshot URL so Piwik will only take a screenshot when 
this URL is being viewed. 

If you configure a heatmap manually using the [addConfig()](/guides/heatmap-session-recording/reference#addconfig) method,
no screenshot will be taken automatically as the JavaScript client cannot know whether a screenshot has been taken yet.

To take a screenshot from a certain page, you need to open the page in your browser and append the URL parameter `&pk_hsr_capturescreen=1`. 

## Is it possible to not use the `paq.push` methods and instead call the `HeatmapSessionRecording` tracker methods directly?

Yes, you can be sure that the `Piwik.HeatmapSessionRecording` object is available as soon as the callback method 
`window.piwikHeatmapSessionRecordingAsyncInit` is called.

In the `piwik.js` tracker we differentiate between two kind of methods:

* Calling a **tracker instance method** affects only a specific tracker instance. In the docs you can 
  identify a tracker method when the method name contains a single dot (`.`). For example `HeatmapSessionRecording.disable` 
  refers to a tracker method tracker that can be called like `tracker.HeatmapSessionRecording.disable()`.
* Calling a **static method** affects all created tracker instances. In the docs you can identify a static method when 
  the method name contains `::`. For example `HeatmapSessionRecording::disableCaptureKeystrokes` refers to a static method 
  `Piwik.HeatmapSessionRecording.disableCaptureKeystrokes()`.

```js
window.piwikHeatmapSessionRecordingAsyncInit = function () {
    // static method
    Piwik.HeatmapSessionRecording.disableCaptureKeystrokes();
     
    // tracker method
    var tracker = Piwik.getAsyncTracker(); 
    tracker.HeatmapSessionRecording.disable();
};
```

## How do I disable the tracking only on a specific tracker instance?

The static method `HeatmapSessionRecording::disable` disables the tracking for all of your created tracker instances.
The tracker method `disable` can be used to disable the tracking only for a specific tracker instance like this:

```js
window.piwikHeatmapSessionRecordingAsyncInit = function () {
    // get tracker instance if you do not have a reference to the tracker instance yet
    var tracker = Piwik.getAsyncTracker(piwikSiteUrl, piwikSiteId); 
    tracker.HeatmapSessionRecording.disable();
};
```

## As a developer I want to see more details about the logged data, is it possible? 

Yes, you can enable the debug mode by calling the following method:

```js
_paq.push(['HeatmapSessionRecording::enableDebugMode']);
```
 
Calling this method will start logging all tracking requests and some more information to the developer 
console of your browser. 

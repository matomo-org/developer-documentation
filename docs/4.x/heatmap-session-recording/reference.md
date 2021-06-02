---
category: Integrate
title: JavaScript Tracker API Reference
---
# Heatmap & Session Recording JavaScript Tracker API Reference

This guide is the JavaScript Tracker API Reference for [Heatmap & Session Recording](https://www.heatmap-analytics.com/).

You may also be interested in the Heatmap & Session Recording [Reporting HTTP API Reference](https://developer.matomo.org/api-reference/reporting-api#HeatmapSessionRecording). 

## Calling Heatmap & Session Recording tracker methods

In the `matomo.js` tracker we differentiate between two methods:

* Calling a **tracker instance method** affects only a specific Piwik tracker instance. In the docs you can 
  identify a tracker method when the method name contains a single dot (`.`), for example 
  `HeatmapSessionRecording.disable`.
* Calling a **static method** affects all created tracker instances. In the docs you can identify a static method when 
  the method name contains `::`, for example `HeatmapSessionRecording::disableCaptureKeystrokes`.

In most cases only one Piwik tracker will be used so the only difference is how you call that method:

* Tracker methods are called via `_paq.push(['HeatmapSessionRecording.$methodName']);` or on a tracker instance directly eg. 
  `Matomo.getAsyncTracker().HeatmapSessionRecording.$methodName();`
* Static methods are called via `_paq.push(['HeatmapSessionRecording::$methodName']);` or directly on the `Matomo.HeatmapSessionRecording` object,
  eg. `Matomo.HeatmapSessionRecording.$methodName()`.

If you do not want to use the `_paq.push` methods, you need to define a `window.matomoHeatmapSessionRecordingAsyncInit` method 
that is called as soon as the media tracker has been initialized:

```js
window.matomoHeatmapSessionRecordingAsyncInit = function () {
    Matomo.HeatmapSessionRecording.disable();
};
```

If you access a `HeatmapSessionRecording` property directly without using `_paq`, we recommend to check if the variable actually exists. Sometimes the Heatmap & Session Recording tracking code may not be available when currently no heatmaps and no session recordings are configured:

```js
window.matomoAsyncInit = function () {
    var tracker = Matomo.getAsyncTracker('matomo.php', 2);		     
    if (tracker.HeatmapSessionRecording) {
        tracker.HeatmapSessionRecording.disable();
    }
    
    if (Matomo.HeatmapSessionRecording) {
        Matomo.HeatmapSessionRecording.disable();
    }
}
```

## Static methods

### `disableAutoDetectNewPageView()`

To support single-page websites and web applications out of the box, Heatmap & Session Recording will automatically 
detect a new page view when you call the `trackPageView` method. This applies if you call `trackPageView` several times without 
an actual page reload. Piwik will after each call of `trackPageView` stop the recording of any activities and re-evaluate 
based on the new URL whether if it should record activities for the new page or not. 
 
If you use `trackPageView` for any other purposes than an actual page view, for example for error or event tracking, 
the recording of session and heatmap activities will be stopped too early and may lead to misleading results. 
In this case it is recommended to disable the default behaviour by calling this method.

If you have a single-page website and you use `trackPageView` for any other purposes than an actual page view, it is recommended
to disable the default behaviour using this method and let Heatmap & Session Recording explicitly know when there is a new page view
 by calling the method `setNewPageView()`.

Example:
```js
_paq.push(['HeatmapSessionRecording::disableAutoDetectNewPageView']);
// or 
Matomo.HeatmapSessionRecording.disableAutoDetectNewPageView();
```

### `enableAutoDetectNewPageView()`

The automatic detection of new page views is enabled by default, see above. If you disable the auto detection, you can enable 
it again at a later point using this method.

### `disableRecordMovements()`

By default, mouse and touch movements will be recorded as they are needed for the "Move Heatmap" and to show mouse movements
when replaying a recorded session. You can disable the recording of any movements by calling this method.

Example:
```js
_paq.push(['HeatmapSessionRecording::disableRecordMovements']);
// or
Matomo.HeatmapSessionRecording.disableRecordMovements();
```

### `enableRecordMovements()`

The recording of mouse and touch movements is enabled by default, see above. If you disable mouse movements, you can enable
them again at a later point by using this method.

### `setNewPageView(fetchConfig)`

If you have disabled the automatic detection of new page views, this method lets you define manually when a visitor
views a new page. This means if a recording is currently active, it will be stopped and depending on the changed URL
a new recording may be started. If you want to prevent a new recording to be started, or if you want to configure manually
whether a new recording should be started, set `fetchConfig = false`. 

### `setMaxCaptureTime(maxTimeInSeconds)`

By default, the activities of a visitor is only recorded for up to 10 minutes in a single page view. If you want to record 
activities for a longer or shorter period, you can change the limit using this method. 

Example:
```js
_paq.push(['HeatmapSessionRecording::setMaxCaptureTime', 60 * 30]);
// or 
Matomo.HeatmapSessionRecording.setMaxCaptureTime(60 * 30);
```

### `setMaxTextInputLength(maxLengthCharacters)`

By default, when a user enters text into a form field, we truncate any entered text after 500 characters. If you wanted to record more characters, you can define another limit using this method.

Example:
```js
_paq.push(['HeatmapSessionRecording::setMaxTextInputLength', 100000]);
// or 
Matomo.HeatmapSessionRecording.setMaxTextInputLength(100000);
```

### `disableCaptureKeystrokes()`

When you configure a new session recording in Piwik, you can choose whether keystrokes should be recorded or not. If enabled,
keystrokes that are entered by a user into text form elements will be recorded and replayed later in the recorded session. If 
you want to make sure to never record any keystrokes entered by your users, call this method.

Password fields and some common credit card fields will be automatically masked before sending the data to your Piwik.
For privacy reasons you can mask the keystrokes of form fields by setting a `data-matomo-mask` (or `data-piwik-mask`) attribute on any element. 
Learn more about this in [masking keystrokes](/guides/heatmap-session-recording/setup#masking-keystrokes-in-form-fields).

### `enableCaptureKeystrokes()`

Lets you enable the recording of keystrokes. When you call this method, the capturing of keystrokes will be enabled even 
if you configured the session recording in Piwik to not capture keystrokes.

### `setTrigger(shouldTriggerFunction)`

Lets you customize whether a heatmap or session should be recorded. This lets you for example restrict the recording of activities
to certain target groups, to certain times, to certain locations, and more. An example of how to use `setTrigger` to record activities only for specific visitors and/or pages [is available in this FAQ](https://developer.matomo.org/guides/heatmap-session-recording/faq#how-do-i-record-activities-only-for-specific-visitors-andor-pages).

### `matchTrackerUrl()`

When you configure a Heatmap or a Session Recording in Piwik, you can define page rules based on URL, URL path and URL parameters
 to limit the recording to certain pages. By default, these rules are matched against the current browser URL.
If you track custom URLs using the `setCustomUrl()` tracker method and want to apply the configured rules against a possibly set 
custom URL, call this method.

This is useful if you have for example URLs like `www.example.com/#page1` and you track a custom URL like 
`_paq.push(['setCustomUrl', 'www.example.com/page1']);`

By default, the target page rules you configure will be matched against 
`www.example.com/#page1`. When you call this method, the target page rules will be matched against `www.example.com/page1`.

### `disable()`

Allows you to completely disable the tracking of any Heatmap or Session Recording data. This is useful if you for example 
manage multiple websites in your Piwik and there are some websites where you do not want to track any such activities. It is recommended
to call this method as early in your tracking code as possible or during the `matomoHeatmapSessionRecordingAsyncInit` method.

### `enable()`

If you have disabled the tracking of heatmap and session activities via `disable()`, you can enable it at a later point 
via this method.

### `isEnabled()`

Allows you to detect whether the tracking of Heatmaps or Session Recordings is currently enabled. 

### `enableDebugMode()`

Enables the debug mode that logs debug information to the developer console of your browser. This should **not** be 
enabled in production.

### `setMatomoTrackers()`

Allows you to set the tracker instances to be used when tracking heatmap and session activities. Can be either
 a single tracker instance, or an array of Piwik tracker instances. This is useful when you are working with multiple Piwik
 tracker instances using `Matomo.getTracker` instead of `Matomo.addTracker`. 
 
### `getPiwikTrackers()`

Returns an array of Piwik tracker instances that are used by the Heatmap and Session Recording plugin. By default, 
this will return the same as `Matomo.getAsyncTrackers()` and will return all tracker instances that were created eg 
via `Matomo.addTracker` or `_paq.push(['addTracker']);` unless custom Piwik tracker instances were set via `setMatomoTrackers()`.

## Tracker methods

### `disable()`

Disables the tracking of any heatmap and session activities. This is useful when you have multiple Piwik tracker
 instances on your website and you want to track activities only into one Piwik. If called early in your tracking code, 
 it will not even try to detect whether a recording should be started, saving you one HTTP request on each page view. If you
 use only one Piwik tracker on your website - which is normal in most of the cases - this method is equivalent to 
 `HeatmapSessionRecording::disable`.

Example:

```js
// disables the tracking of any activities on all Piwik trackers
_paq.push(['HeatmapSessionRecording::disable']); 

// or if you are using multiple Piwik trackers and only want to disable it for a specific tracker:
var tracker = Matomo.getAsyncTracker(matomoUrl, matomoSiteId);
tracker.HeatmapSessionRecording.disable();
```

### `enable()`

If the tracking was disabled via `disable()`, you can enable it again using this method.

### `isEnabled()`

Detects if the tracking is currently enabled or disabled.

### `addConfig()`

By default, Heatmap & Session Recording configures itself by issuing an HTTP request to your Piwik installation to
 detect automatically whether any activities should be recorded on the current page. This way you don't need to change
 your website when you configure new heatmaps or session recordings. This HTTP request is executed on each page view 
 and may add some load to your server. If you want to instead configure manually when to record a heatmap or a session, 
 you can do this calling this method. Please note that you will need to change the tracking code on your website manually if you want to stop or start 
 recording a session or a heatmap. You will also need to detect manually whether a page should be a recorded for example
 based on its URL. As a benefit of this, it saves you an HTTP request on each page view. 
 
Please note that if you generate heatmaps and record sessions regularly, it will add quite an effort on your side to manage the manual tracking using `addConfig()`.
Another possibility would be to call the [Heatmap & Session Recording Reporting API](https://developer.matomo.org/api-reference/reporting-api#HeatmapSessionRecording)
via HTTP to receive all configured heatmaps and session recordings and embed a config automatically into your website based
on this. You could cache this information on your server for a fast performance and not having to do anything manually.
 
#### Configuring the plugin manually to avoid an HTTP request

To not recording any session or heatmap activity on the current page, set an empty object like this:

```js
_paq.push(['HeatmapSessionRecording.addConfig', {}]); 
```

To start recording activities for a heatmap, define a `heatmap` property like this:

```js
_paq.push(['HeatmapSessionRecording.addConfig', {heatmap: {id: 5, sample_rate: "100.0"}}]); 
```

To start recording activities for a session, set a `session` property:

```js
_paq.push(['HeatmapSessionRecording.addConfig', {session: {id: 6, sample_rate: "100.0", min_time: 30, keystrokes: true, activity: true}}]); 
```

The config properties have the following meaning:

 * `id` The id of a heatmap or a session recording
 * `sample_rate` How often a recording should be started. If you set 100, the activities will always be recorded when someone views this page. If you set it to `10`, only in 10% of all page views the activities will be actually recorded. You may use one decimal, eg `0.1` for 0.1% of all page views.
 * `min_time` If set, a session will be only recorded if the visitor has been at least for that many seconds on the current page.
 * `keystrokes` Defines whether keystrokes should be recorded or not. Defaults to `false`.
 * `activity` If enabled, requires the user to at least click and scroll once before a session is actually recorded. Defaults to `false`.

#### Limiting the number of requests

Please note that any configured sample limit on the session recording or heatmap will be ignored when you configure the tracker manually.
This means you should have an eye on the number of recorded sessions and heatmap activities and remove the configuration as soon as you have
reached the number of page views you want.

## What to read next

You may be interested in the [Heatmap & Session Recording HTTP Reporting API Reference](https://developer.matomo.org/api-reference/reporting-api#HeatmapSessionRecording).

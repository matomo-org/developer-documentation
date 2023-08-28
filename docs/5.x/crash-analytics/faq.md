---
category: Integrate
title: Developer FAQ
---
# Crash Analytics Developer FAQ

## As a developer I want to see more details about the logged data, is it possible?

Yes, you can enable the debug mode by calling the following method:

```js
_paq.push(['CrashAnalytics::enableDebugMode']);
```

Calling this method will start logging all tracking requests and some more information to the developer console of your browser.

## How do I use crash analytics when using multiple Matomo JavaScript trackers?

Matomo lets you track a website into different Matomo installations or into different Matomo websites. Learn more about using [Multiple Matomo trackers on the JavaScript Tracking guide](https://developer.matomo.org/guides/tracking-javascript-guide#multiple-piwik-trackers).

If you are using the regular `_paq.push` tracking method, everything will work out of the box when you create more trackers via `_paq.push(['addTracker', url, idsite]);`

Using `_paq.push` for multiple trackers is a good and simple way when you want to track the same data into different Matomo installations or into different Matomo websites.

```js
// configuration of first tracker
_paq.push(['setTrackerUrl', 'https://example.com/matomo.php']);
_paq.push(['setSiteId', 1]);
// configuration of second tracker
_paq.push(['addTracker', 'https://example.com/matomo.php', 2]);
```

If you are working with Matomo tracker instances because you want to configure each tracker instance differently and track different data into each Matomo, you need to set the tracker instances manually:

```js
window.matomoAsyncInit = function () {
	// This works from Matomo 2.17.1. Before 2.17.1 you need to define a method
	// `window.matomoCrashAnalyticsAsyncInit` instead of `window.matomoAsyncInit`.

	var matomoTracker1 = Matomo.getTracker('https://example.com/matomo.php', 1);
	var matomoTracker2 = Matomo.getTracker('https://example.com/matomo.php', 2);

	Matomo.CrashAnalytics.setMatomoTrackers([matomoTracker1, matomoTracker2]);

	// Crash Analytics tracking is enabled by default, you can customize the tracking like this:
	matomoTracker2.CrashAnalytics.disable();
}
```

It is important to define these methods before the Matomo tracker file is loaded. Otherwise, your matomoAsyncInit or matomoCrashAnalyticsAsyncInit method will never be called.

## Is it possible to not use the "paq.push" methods and instead call the CrashAnalytics tracker methods directly?

Yes. To initialize the Crash Analytics tracker you need to define a callback method window.matomoCrashAnalyticsAsyncInit which will be executed as soon as the Crash Analytics tracker is initialized. As soon as this callback is called, you can be sure that the Matomo.CrashAnalytics object is defined.

In the matomo.js tracker we differentiate between two kind of methods:

* Calling a tracker instance method affects only a specific tracker instance. In the docs you can identify a tracker method when the method name contains a single dot (.). For example `CrashAnalytics.disable` refers to a tracker method that can be called like `tracker.CrashAnalytics.disable()`.
* Calling a static method affects all created tracker instances. In the docs you can identify a static method when the method name contains `::`. For example `CrashAnalytics::setSampleRate` refers to a static method `Matomo.CrashAnalytics.setSampleRate()`.

```js
window.matomoCrashAnalyticsAsyncInit = function () {
	// static methods
	var sampleRatePercent = 30;
	Matomo.CrashAnalytics.setSampleRate(sampleRatePercent);

	// tracker methods
	var tracker = Matomo.getAsyncTracker();
	// get tracker instance if you do not have a reference to the tracker instance yet
	tracker.CrashAnalytics.disable();
};
```

## Can I disable the tracking only on a specific tracker instance?

Yes. The static method `CrashAnalytics::disable` disables the tracking for all of your created tracker instances. However, the tracker method `disable()` can be used to disable the tracking only for a specific tracker instance like this:

```js
window.matomoCrashAnalyticsAsyncInit = function () {
	// get tracker instance if you do not have a reference to the tracker instance yet
	var tracker = Matomo.getAsyncTracker(matomoSiteUrl, piwikSiteId);
	tracker.CrashAnalytics.disable();
};
```

## How can I customize the source URI for crashes?

If you’d like to change the source URI that is tracked for crashes from a specific `<script>`, say because the `<script>` `src` has a cache buster, you can use the `data-matomo-resource` feature.

Add `data-matomo-resource` as an attribute to the `<script>` element. The value of the attribute is what will appear as the crash’s source. It will also be replaced in the crash’s stack trace, providing you with clearer reports.

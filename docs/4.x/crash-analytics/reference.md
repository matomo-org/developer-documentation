---
category: Integrate
title: JavaScript Tracker API Reference
---
# Crash Analytics JavaScript Tracker API Reference

This guide is the JavaScript Tracker API Reference for **Crash Analytics**

You may also be interested in the Crash Analytics [Reporting HTTP API Reference](https://developer.matomo.org/api-reference/reporting-api#CrashAnalytics).

## Calling CrashAnalytics tracker methods

In the `matomo.js` tracker we differentiate between two kind of methods:

* Calling a **tracker instance method** affects only a specific Matomo tracker instance. In the docs you can
  identify a tracker method when the method name contains a single dot (`.`), for example
  `CrashAnalytics.disableTrackEvents`.
* Calling a **static method** affects all created tracker instances. In the docs you can identify a static method when
  the method name contains `::`, for example `CrashAnalytics::removePlayer`.

In most cases only one Matomo tracker will be used so the only difference is how you call that method:

* Tracker methods are called via `_paq.push(['CrashAnalytics.$methodName']);` or on a tracker instance directly eg.
  `Matomo.getAsyncTracker().CrashAnalytics.$methodName();`

* Static methods are called via `_paq.push(['CrashAnalytics::$methodName']);` or directly on the `Matomo.CrashAnalytics` object,
  eg. `Matomo.CrashAnalytics.$methodName()`.

If you do not want to use the `_paq.push` methods, you need to define a `window.matomoCrashAnalyticsAsyncInit` method
that is called as soon as the media tracker has been initialized:

```js
window.matomoCrashAnalyticsAsyncInit = function () {
	Matomo.CrashAnalytics.setSampleRate(50);
};
```

## Static methods

### `setSampleRate(percentageOfCrashesToTrack)`

Configures a “sample rate” for crash tracking so only a percentage of crashes encountered will be tracked. For example, passing `50` would mean only 50% of crash tracking requests would actually be sent to Matomo. Use this method if you need to reduce the potential load on your Matomo servers. Defaults to 100%.

### `getSampleRate()`

Returns the configured “sample rate”. See documentation for `setSampleRate()`.

### `setMaxNoOfCrashRequestsAllowed(amount)`

Sets the maximum number of crash requests that are allowed to be sent per tracker. Once this limit is reached, no further crash tracking requests are sent. Defaults to 50.

Note: if the page is reloaded the count of crash requests sent resets, but if a pageview is tracked, it will not reset. This is significant if you’re using this functionality within a single page application where actual page loads/reloads may be rare.

### `getMatomoTrackers()`

Returns an array of Matomo tracker instances that are used by the Crash Analytics plugin. By default, this will return the same as `Matomo.getAsyncTrackers()` and will return all tracker instances that were created eg via `Piwik.addTracker` or `_paq.push(['addTracker']);` unless custom Matomo tracker instances were set via `setMatomoTrackers().`

### `setMatomoTrackers(trackerOrArrayOfTrackers)`

Allows you to set the tracker instances the tracker should use when tracking crashes. Can be either a single tracker instance, or an array of Matomo tracker instances. This is useful when you are working with multiple Matomo tracker instances using `Matomo.getTracker` instead of `Piwik.addTracker`.

### `enable()`

Allows you to completely disable the tracking of any crashes. This is useful if you for example manage multiple websites in your Matomo and there are some sites where you do not want to track crashes.

### `disable()`

If you have disabled the tracking of crashes via `disable()` you can enable it at a later point via this method.

### `isCrashAnalyticsEnabled()`

Returns whether Crash Analytics is currently enabled at a global level.

### `disableStackTraceLogging()`

If you do not want to track stack traces of crashes, perhaps because the crashes could potentially contain Personally Identifiable Information (PII), you can call this method to make
sure stack traces do not get sent with tracking requests.

By default stack trace logging is enabled.

### `enableStackTraceLogging()`

If you have disabled stack trace logging via `disableStackTraceLogging()` and want to re-enable it at a later point, you can call this method.

### `doNotTrackUncaughtErrors()`

By default Matomo Crash Analytics will detect uncaught errors and unhandled promise rejections and automatically track them. If for some reason you don’t want this behavior and only want to track crashes manually, call `doNotTrackUncaughtErrors()`.

### `trackUncaughtErrors()`

If you have previously called `doNotTrackUncaughtErrors()` and want to re-enable it at a later point, you can call `trackUncaughtErrors()`.

### `setCrashCategory(category)`

Sets a custom crash category that should be sent with automatically tracked uncaught errors and unhandled rejections. Call `setCrashCategory(null)` to unset the category.

### `onlyTrackSourcesWithDomain(domain)`

Allows you to limit crash tracking to crashes that originate from a source file hosted on a specific domain. If you’re only interested in crashes that occur on one domain, call this method to automatically ignore all other crashes. Note that this will include subdomains of `domain`, so if you call this method with `mysite.com`, crashes from domains like `js.mysite.com` will be included.

### `doNotTrackSourcesWithDomain(domainOrArrayOfDomains)`

Allows you to exclude crashes from crash tracking if they originate from a source file hosted on one or a list of domains. If you use JavaScript from another organization or product that you have no control over, for instance, you can ignore any crashes that occur from those source files with this method.

### `trackBrowserExtensionErrors()`

Some browsers will report crashes that occur in browser extensions to the website causing them to be tracked in Matomo. By default these crashes are ignored, but if you’d like them to be tracked, you can call `trackBrowserExtensionErrors()`.

### `doNotTrackBrowserExtensions()`

Allows you to re-disable browser extension crash tracking if you have previously enabled it.

Note: by default browser extension crashes are not tracked.

### `customizeStackTraces(customizeCallback)`

Allows you to customize a crash stack trace (for instance, by referencing source maps) via a callback before the crash is tracked. The `customizeCallback` must have a signature of `function (stackTrace, callback)` and must provide the updated stack trace with the `callback` parameter. Note that because you must provide the updated trace via another callback, you can use asynchronous code here.

Example:
```js
_paq.push([‘CrashAnalytics::customizeStackTraces’, function myCustomizeFunction(stackTrace, callback) {
    doSomethingWithStackTrace(stackTrace).then(function (customizedStackTrace) {
      callback(customizedStackTrace);
    });
});
```

If the page unloads before your customizer function completes, the request will be sent with the unaltered stack trace, so at least something is tracked.

### `trackJsError(errorLike, optionalCategory)`

Manually tracks a crash using a JavaScript `Error` instance or an object that looks like one. The `message` and `stack` properties map to the values sent for a crash’s message and stack trace. The crash’s type is set as the class name of the error. The originating source location URI, line an column are all parsed from the stack trace.

Note: crashes with identical message and stack traces (before customization) will only be tracked once per page load.

### `trackCrash(message, type, category, stack, location, line, column)`

Manually tracks a crash. The only required piece of information is the `message`. If a `stack` is provided but no `location`, `line` or `column`, it will be parsed from the stack trace before being sent out.

Note: crashes with identical message and stack traces (before customization) will only be tracked once per page load.

### `enableDebugMode()`

Enables the debug mode that logs debug information to the developer console of your browser. This should **not** be enabled in production.

## Tracker methods

### `enable()`

Disables the tracking of crashes for a specific tracker instance.

Example:
```js
// disables the tracking of events on all Matomo trackers
_paq.push([‘CrashAnalytics.disable’]);

// or if you are using multiple Matomo trackers and only want to disable it for a specific tracker:
var tracker = Matomo.getAsyncTracker(matomoUrl, matomoSiteId);
tracker.CrashAnalytics.disable();
```

### `disable()`

If the tracking of crashes was disabled via `disableTrackEvents()`, you can enable it again using this method.

### `isEnabled()`

Returns whether crash tracking is enabled for the specific tracker instance.

## What to read next

You may be interested in the [Crash Analytics HTTP API Reference](https://developer.matomo.org/api-reference/reporting-api#CrashAnalytics).

If you want to track crashes in a language that does not have an official tracking SDK, then you will need to use the Crash Analytics HTTP API.

A crash request consists of the following parameters:

* `ca`: must always be included and always set to `1`
* `cra`: the message of the error (required).
* `cra_st`: the stack trace of the error (optional).
* `cra_ct`: the category of the error (optional).
* `cra_tp`: the error type (optional)
* `cra_ru`: a URI for the source file that originated the error (optional)
* `cra_rl`: the line of the source file where the error occurred (optional)
* `cra_rc`: the column of the source file where the error occurred (optional)

**Note:** the user of the HTTP API is responsible for determining the source location of an error, including file URI, line number and column number. The Crash Analytics HTTP tracker will not deduce this information from the stack trace.


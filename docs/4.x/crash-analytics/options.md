---
category: Integrate
title: Enriching and Restricting 
---
# Enriching and customising tracking of crashes

## How do I set a category for automatically tracked crashes?

To set a category for uncaught errors and unhandled promise rejections, use the `setCrashCategory()` method:

```js
_paq.push(["CrashAnalytics::setCrashCategory", "my custom category"]);
```

This category will be applied to every automatically tracked crash. You can unset the value by passing `null` to `setCrashCategory()`.

## How can I apply source maps or otherwise customize stack traces before they are tracked?

The JavaScript tracker provides the option to set a callback to customize stack traces before they are sent to Matomo. This callback is set via the `customizeStackTraces()` method:

```js
_paq.push(["CrashAnalytics::customizeStackTraces", async function myCustomizeFunction(stackTrace, callback) {
    const customizedStackTrace = await doSomethingWithStackTrace(stackTrace);
    callback(customizedStackTrace);
}]);
```

Note: if a page unload occurs before your customizer callback completes, the unaltered stack trace will be logged as we’d rather have something logged than nothing.

## How do I limit the number of crash related tracking requests to reduce load on my Matomo instance?

There are two ways to limit the amount of tracking requests that are sent: setting a max number of requests per tracker and setting a sample rate to only track a percentage of crashes.

To **limit the total number of of requests per tracker**, use the `setMaxNoOfCrashRequestsAllowed()` method:

```js
_paq.push(["CrashAnalytics::setMaxNoOfCrashRequestsAllowed", 100]);
```

If a tracker reaches this limit, it will stop sending Crash Analytics requests entirely. The only way requests are sent again is if the user reloads the page.

By default, trackers are limited to 50 Crash Analytics requests per page view.

To **set a sample rate** use the `setSampleRate()` method:

```js
_paq.push(["CrashAnalytics::setSampleRate", 50]);
```

This will limit the crashes tracked to a percentage of the total encountered. The above snippet will, for instance, will configure the JavaScript tracker to track only 50% of all crashes.

Note: these limits apply both to automatically tracked crashes and to manually tracked crashes.

## How do I prevent duplicate crashes from being tracked?

The JavaScript tracker will detect duplicate crashes (by checking the crash message and stack trace) and avoid tracking them. There’s nothing you need to do to enable this.

## How do I prevent stack traces from being tracked?

If your errors may contain Personally Identifiable Information (PII) or other types of personal information in the stack trace, you can make sure stack traces are not sent to Matomo via the `disableStackTraceLogging()` method:

```js
_paq.push(["CrashAnalytics::disableStackTraceLogging"]);
```

## How do I prevent errors from third party domains from being tracked?

To ignore crashes whose source is a JavaScript file from a specific domain, exclude the domain with `doNotTrackSourcesWithDomain()`:

```js
_paq.push(["CrashAnalytics::doNotTrackSourcesWithDomain", ["facebook.com", "someothersite.com"]]);
```

To ignore every domain **except** the ones you care about, use the `onlyTrackSourcesWithDomain()` method:

```js
_paq.push(["CrashAnalytics::onlyTrackSourcesWithDomain", ["mysite.com"]);
```

## How can I make sure browser extension errors are tracked?

By default, the JavaScript tracker will ignore errors that come from browser extensions. If instead you’d like to see these errors, use the `trackBrowserExtensionErrors()` method:

```js
_paq.push(["CrashAnalytics::trackBrowserExtensionErrors"]);
```

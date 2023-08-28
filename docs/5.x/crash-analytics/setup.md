---
category: Integrate
title: Setting up
---
# Setting up Crash Analytics

In this guide you will learn how to get [Crash Analytics](https://www.crash-analytics.net/) to provide insights into what’s failing in your website or application.

## Setup

No extra tracking code is required to start using CrashAnalytics for JavaScript crash tracking. When the plugin is enabled in Matomo, websites that have the Matomo tracking code will automatically start tracking crashes.

## What crashes are tracked automatically?

Both uncaught errors and unhandled promise rejections are logged automatically. By uncaught errors we mean errors like:

```js
function throwError() {
    throw new Error(‘uncaught in a function’);
}

throwError(); // the error thrown here will be logged

setTimeout(() => {
    throw new Error(‘uncaught in timeout’); // this will also be logged
});
```

By unhandled promise rejections we mean errors like:

```js
Promise.resolve().then(() => {
    return MyApiClient.fetchSomeData();
}).then((data) => {
    if (!data.length) {
        throw new Error(‘no data found!’); // since there is nothing to catch this, it will be logged
    }
    return data;
});

new Promise((resolve, reject) => {
    doSomethingWithCallback((err, value) => {
        if (err) {
            reject(err); // this will get logged
            return;
        }

        if (!value.length) {
            reject(“no data found!”); // this will get logged even though it’s not an Error instance, just a string
        }

        resolve(value);
    });
});
```

## How can I disable automatic crash tracking?

If for some reason you don’t wish to automatically track crashes and only track them manually, you can disable this functionality by using the `doNotTrackUncaughtErrors()` method:

```js
_paq.push(["CrashAnalytics::doNotTrackUncaughtErrors"]);
```

If you need to re-enable it for some reason, you can use the `trackUncaughtErrors()` method:

```js
_paq.push(["CrashAnalytics::trackUncaughtErrors"]);
```

## How do I track a crash manually?

The JS tracker has a `trackJsError()` method and a `trackCrash()` method that can both be used manually. `trackJsError` takes a single `error` parameter, which can be an actual Error instance or an object with a `message` property:

```js
_paq.push(["CrashAnalytics::trackJsError", new MyApiError('the error message')]);

_paq.push(["CrashAnalytics::trackJsError", { message: 'my error message' }]);
```

If you pass in an exception, the error type will be set the class name of the exception (as in, `error.constructor.name`). If you’d like to pass in custom information for the type, you can use the `trackCrash()` method:

```js
_paq.push(["CrashAnalytics::trackCrash", "my error message", "my error type"]);
```

You can also set a custom stack trace, category, line number and column number this way:

```js
_paq.push(["CrashAnalytics::trackCrash", "my error message", "my error type", "my category", "a custom stack trace value", 50, 60]);
```

# Enriching and Restricting

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

By default trackers are limited to 50 Crash Analytics requests.

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

## Server side error tracking

Crashes that occur server side can also be tracked with Matomo Crash Analytics. The official tracker SDKs can be used to easily track such exceptions.

Or you can use the HTTP API directly, if using a language for which Matomo does not provide an official tracking SDK.

**Do note that tracking exceptions server side will send network requests and not every language supports fire and forget requests.**

## How to track exceptions with the PHP tracker?

To track an exception you caught, use the `trackPhpThrowable()` method:

```php
$tracker = new \MatomoTracker(...);

try {
    doSomeComplicatedTask();
} catch (\Throwable $ex) {
    $tracker->trackPhpThrowable($ex);
}
```

Like the JavaScript tracker, this method will deduce as much information as possible from the exception, including the stack trace, source line and column, and error type.

## Manual track crashing

There is also a method that can be used to track a crash or error if you don’t have an exception:

```php
$tracker = new \MatomoTracker(...);

if (!is_file(‘myveryimportantfile’)) {
    $tracker->trackCrash(‘myveryimportantfile is expected, but cannot be found!’, ‘IllegalState’, ‘my category’, $stack = null, __FILE__);
    return;
}
```

Though you can also simply create an exception which in most cases would be simpler:

```php
$tracker = new \MatomoTracker(...);
if (!is_file(‘myveryimportantfile’)) {
    $tracker->trackPhpThrowable(new IllegalStateException(‘myveryimportantfile is expected, but cannot be found!’));
}
```

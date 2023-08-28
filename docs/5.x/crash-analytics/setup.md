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


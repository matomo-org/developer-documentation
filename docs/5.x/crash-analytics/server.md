---
category: Integrate
title: Application tracking
---
# Tracking application and server-side crashes

Crashes that occur in an application or server-side can also be tracked with Matomo Crash Analytics. The official tracker SDKs can be used to easily track such exceptions.

Or you can use the HTTP API directly, if using a language for which Matomo does not provide an official tracking SDK.

**Do note that tracking exceptions server side will send network requests and not every language supports fire and forget requests.**

For available methods please check the tracker SDK documentation.

### How to track exceptions with the PHP tracker?

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

#### Manual track crashing with the PHP tracker

There is also a method that can be used to track a crash or error if you don’t have an exception:

```php
$tracker = new \MatomoTracker(...);

if (!is_file('myveryimportantfile')) {
    $tracker->trackCrash('myveryimportantfile is expected, but cannot be found!', 'IllegalState', 'my category', $stack = null, __FILE__);
    return;
}
```

Though you can also simply create an exception which in most cases would be simpler:

```php
$tracker = new \MatomoTracker(...);
if (!is_file('myveryimportantfile')) {
    $tracker->trackPhpThrowable(new IllegalStateException('myveryimportantfile is expected, but cannot be found!'));
}
```

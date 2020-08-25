---
category: Integrate
title: JavaScript Tracker API Reference
---
# Form Analytics JavaScript Tracker API Reference

This guide is the JavaScript Tracker API Reference for [Form Analytics](https://www.form-analytics.net/).

You may also be interested in the Form Analytics [Reporting HTTP API Reference](https://developer.matomo.org/api-reference/reporting-api#FormAnalytics). 

## Calling Form Analytics tracker methods

In the `matomo.js` tracker we differentiate between two kind of methods:

* Calling a **tracker instance method** affects only a specific Piwik tracker instance. In the docs you can 
  identify a tracker method when the method name contains a single dot (`.`), for example 
  `FormAnalytics.disable`.
* Calling a **static method** affects all created tracker instances. In the docs you can identify a static method when 
  the method name contains `::`, for example `FormAnalytics::scanForForms`.

In most cases only one Piwik tracker will be used so the only difference is how you call that method:

* Tracker methods are called via `_paq.push(['FormAnalytics.$methodName']);` or on a tracker instance directly eg. 
  `Matomo.getAsyncTracker().FormAnalytics.$methodName()`.
* Static methods are called via `_paq.push(['FormAnalytics::$methodName']);` or directly on the `Matomo.FormAnalytics` object,
  eg. `Matomo.FormAnalytics.$methodName()`.

If you do not want to use the `_paq.push` methods, you may define a `window.matomoFormAnalyticsAsyncInit` method 
that is called as soon as the form tracker has been initialized:

```js
window.matomoFormAnalyticsAsyncInit = function () {
    Matomo.FormAnalytics.disableFormAnalytics();
};
```

## Static methods

### `scanForForms(documentOrHTMLElementToScanForForms)`.
By default, Piwik detects all forms on your website automatically. If you modify the DOM after the page was loaded (for 
example in a single-page web application), you may need to call this method to make sure Piwik finds all your forms. 
When you call this method, the Form Analytics tracker will search the DOM for new forms and start the tracking 
of those forms. As a parameter, you can optionally pass an `HTMLElement` if only a part of the DOM should be searched for 
new form. This is especially useful for one page web applications. If no such parameter is given, the entire DOM will 
be search for new form elements. 

Example:
```js
_paq.push(['FormAnalytics::scanForForms']);
_paq.push(['FormAnalytics::scanForForms', document.getElementById('test')]);
// or 
Matomo.FormAnalytics.scanForForms();
Matomo.FormAnalytics.scanForForms(document.getElementById('test'));
```

### `trackForm(formElement)`

This method is almost the same as `scanForForms`. However, `scanForForms` will detect only forms that are either a
`form` element, a `data-matomo-form` attribute, or a `data-piwik-form` attribute. If neither of this is the case for one of your forms, you can use 
this method to make sure Piwik will track data for all form fields within this element. It is recommended to set a 
`data-matomo-name` or a `data-piwik-name` attribute to let Piwik know the name of your form.

### `trackFormSubmit(formElement)`

By default, Piwik will automatically listen to the form submit event. If you are not using a `form` element, you may 
 need to let Piwik know when the form was submitted by calling this method:
 
```html
<div data-matomo-form id="login"></div>
<a href="#" onclick="_paq.push(['FormAnalytics::trackFormSubmit', document.getElementById('login')])">Submit</a>
```

### `trackFormConversion(nodeOrFormName, formId)`

Piwik differentiates between form submits and form conversions. A form may be submitted several times before it is converted
as a visitor may have to correct form validation errors. To track a form conversion, you can configure one or several pages in the Piwik administration and as soon as a visitor views any of these
 configured pages, a conversion will be tracked. If you do not redirect a user to a specific page after submitting a 
 form successfully, you can trigger a form conversion manually by calling this method.
 
```html
<div data-matomo-form name="cloudlogin" id="login"></div>

<!-- when the form is still shown on the same page you can pass the form element -->
<a href="#" onclick="_paq.push(['FormAnalytics::trackFormConversion', document.getElementById('login')])">Submit</a>

<script>
// when the form is not displayed anymore, you can pass the name and / or the id of the form to track a conversion 
_paq.push(['FormAnalytics::trackFormConversion', 'cloudlogin', 'login']);
</script>
```

### `disableFormAnalytics()`

Allows you to completely disable the tracking of any forms. This is useful if you for example manage multiple websites
in your Piwik and there are some sites where you do not want to track any forms. If called early in your tracking code
 or via the `matomoFormAnalyticsAsyncInit` method, it will not even search for forms on your web page.

### `enableFormAnalytics()`

If you have disabled the tracking of forms via `disableFormAnalytics()`, you can enable it at a later point via this method.
It is recommended to call `scanForForms()` just after enabling the form tracking to make sure it detects all forms on 
your website or in your application.

### `isFormAnalyticsEnabled()`

Allows you to detect whether the tracking of forms is currently enabled. Returns a boolean `true` or `false`.

### `enableDebugMode()`

Enables the debug mode that logs debug information to the developer console of your browser. This should **not** be 
enabled in production.

### `setPiwikTrackers()`

Allows you to set the tracker instances the tracker should use when tracking your forms. Can be either
 a single tracker instance, or an array of Piwik tracker instances. This is useful when you are working with multiple Piwik
 tracker instances using `Matomo.getTracker` instead of `Matomo.addTracker`. 
 
### `setTrackingTimer(delayInMilliSeconds)`

By default, the tracker sends a tracking request to your Piwik 1.5 seconds after a user interacted with a form. If a
user interacts several times with your forms during those 1.5 seconds, the tracking request will be delayed by another 
1.5 seconds. This way, Piwik can group several form tracking requests into one request when a user is heavily interacting with your form.
If you want to send this update more or less frequently, you can set a different delay using this method. It is usually not 
needed to call this method unless you want to reduce the number of requests sent to your server.

## Tracker methods

### `disable()`

Disables the tracking of any forms to this Piwik instance. If you have only one tracker on your website, it is the same
 as calling `disableFormAnalytics()`. If you have multiple Piwik trackers on your web page, you can disable the tracking
 for a specific Piwik instances by calling this method.

Example:

```js
_paq.push(['FormAnalytics.disable']); 

// or if you are using multiple Piwik trackers and only want to disable it for a specific tracker:
var tracker = Matomo.getTracker(matomoUrl, matomoSiteId);
tracker.FormAnalytics.disable();
```

### `enable()`

If the tracking of forms was disabled via `disable()`, you can enable it again using this method.

### `isEnabled()`

Detects if the tracking of forms is currently enabled or disabled for this tracker. Returns a boolean `true` or `false`.


## What to read next

You may be interested in the [Form Analytics HTTP API Reference](https://developer.matomo.org/api-reference/reporting-api#FormAnalytics).

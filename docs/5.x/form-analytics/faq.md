---
category: Integrate
title: Developer FAQ
---
# Form Analytics Developer FAQ

This page is the Developer FAQ for [Form Analytics](https://www.form-analytics.net/). You may also be interested in the [Form Analytics User FAQs](https://matomo.org/faq/form-analytics/).

## I have a single page website or a web application, how can I re-scan the DOM to find new forms or form fields that were added after the initial page load, for example via Ajax / XHR? 

You can re-scan the entire document for new forms like this:

```js
_paq.push(['FormAnalytics::scanForForms']);
```
 
If you have only updated parts of your web page, you can search for newly added forms and form fields only in that area by passing a 
DOM element as a second parameter:

```js
var updatedElement = document.getElementById('justUpdatedElement');
_paq.push(['FormAnalytics::scanForForms', updatedElement]);
```
 
## How do I force a form or field name?

When Piwik finds a form on your page, it reads the `name` and `id` attribute of your forms and fields.

```html
<form name="cloud_login" id="login">...</form>
<input name="username" id="username_field">
```

For forms, Piwik will read both the form `name` and form `id` to match against any of your configured forms in Piwik. For form fields, Piwik will first
check if there is a `name` attribute, and if no value is set, use the field `id` attribute as a fallback. 

Some websites or apps use randomized names that always change, for example:

```html
// first request
<form name="349391ac34f">...</form>
<input name="349391ac34f">

// next request
<form name="23493493ca2">...</form>
<input name="23493493ca2">
```

In this case, you should set a fixed name that always remains the same using the `data-matomo-name` (recommended) or `data-piwik-name` attribute:

```html
<form name="349391ac34f" data-matomo-name="cloud_login">...</form>
<input name="349391ac34f" data-matomo-name="username">
```

Please note that you do not have to set a custom name if the name is always the same: in Piwik itself you can map a
cryptic name like `input_4` to a human readable name like "Username" without having to change your website.
 
## How do I prevent a form or form field from being tracked?

When you don't want a form or form field to be tracked, simply add a `data-matomo-ignore` (recommended) or a `data-piwik-ignore` attribute to the form or the
field you want to ignore. If you ignore the whole form, Piwik will not even send any tracking request for this form.

```html
<form data-matomo-ignore>...</form>
<input data-matomo-ignore type="text">
```
 
## How do we track a form with Piwik when our website does not use a form element?

Usually, forms are wrapped within a `form` element. However, this might not always be the case. You can still track such
forms automatically by adding a `data-matomo-form` (recommended) or a `data-piwik-form` attribute to an element that contains all the form fields:

```html
<div data-matomo-form data-matomo-name="myformname">
    <input name="username" type="text">
    <input name="password" type="text">
</div>
```

Alternatively, it is also possible to instruct Piwik to track a form manually:
 
```html
<div id="loginform">
    <input name="username" type="text">
    <input name="password" type="text">
</div>
<script>
    _paq.push(['FormAnalytics::trackForm', document.getElementById('loginform')]);
</script>
```
 
## How do I track a form submit manually?

Piwik automatically tracks a form submit by listening to the form `submit` event. In case you are not using a 
`form` element or if your form does not have a `submit` button, you need to instruct Piwik when the form was 
submitted by calling this method:
 
```html
<div data-matomo-form id="login"></div>
<a href="#" onclick="_paq.push(['FormAnalytics::trackFormSubmit', document.getElementById('login')])">Submit</a>
```

The second parameter should reference either the form element that was submitted, or any element within that form. 
 
## How do I track a form conversion manually?

Piwik can automatically track a form conversion when the form is configured under "Administration => Forms". If your website
 does not forward the user to another page after submitting a form successfully, you may need to track a form conversion
 manually. When you implement a form conversion manually, make sure to track the conversion only when the form was submitted without any validation errors.
  This means there might be several forms submits before a form is actually converted.
 
If you don't redirect a user to another page when the form is converted and the form is still shown on the same page when
the conversion happens, you can track a form conversion like this: 

```html
<form name="cloudloginName" id="loginId"></form>
<script>
if (noValidationErrors) {
    _paq.push(['FormAnalytics::trackFormConversion', document.getElementById('loginId')]);
}
</script>
```

The second parameter should reference either the form element that was converted, or any element within that form. 

Often when a form submit occurs you might reload the page or redirect a user to another page. 
In this case, you can manually track a form conversion by specifying the forms' `name` and `id` like this:

```js
_paq.push(['FormAnalytics::trackFormConversion', 'cloudloginName', 'loginId']);
```

It is required to pass the same values as the form has in its HTML markup. If the form doesn't have a `name` or `id` 
attribute, simply set an empty string like this:

```js
_paq.push(['FormAnalytics::trackFormConversion', '', 'loginId']);
```

It is recommended to call this `FormAnalytics::trackFormConversion` method as early as possible in your Piwik tracking code.

Please note that if your form does not have a submit button, you may have to call both methods `FormAnalytics::trackFormSubmit` and `FormAnalytics::trackFormConversion`. 
This is because  a form conversion does not automatically track a form submit.

```js
_paq.push(['FormAnalytics::trackFormSubmit', document.getElementById('loginId')]);
if (noValidationErrors) {
    _paq.push(['FormAnalytics::trackFormConversion', document.getElementById('loginId')]);
}
```

 
## As a developer I want to see more details about the form analytics data being logged in my website, is it possible? 

Yes, you can enable the debug mode by calling the following method:

```js
_paq.push(['FormAnalytics::enableDebugMode']);
```
 
Calling this method will start logging all tracking requests and some more information to the developer console of your browser. 

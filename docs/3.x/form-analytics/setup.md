---
category: Integrate
title: Setting up
---
# Setting up Form Analytics

In this guide you will learn how to get [Form Analytics](https://www.form-analytics.net/) to automatically track your website's online forms.

## Embedding the Form Analytics JavaScript Tracker

If you have already embedded the [Piwik JavaScript Tracking Code](/guides/tracking-javascript-guide) into your website,
the Form Analytics will automatically start tracking the usage of your web forms. 

The tracker code for forms is automatically added into your Piwik JavaScript tracker file `/piwik.js` as long as the file `piwik.js` in your Piwik directory is writable by the webserver/PHP.
 
To check whether this works by default for you, login into Piwik as a Super User, go to Administration, and open the "System Check" report. 
If the System Check displays a warning for "Writable Piwik.js" then [learn below how to solve this](#when-the-piwikjs-in-your-piwik-directory-file-is-not-writable).

## Tracking Forms

Piwik detects and starts the tracking of your forms automatically if they have set a form `name` or a form `id` attribute like this:

```html
<form name="cloud_login">...</form>
<form id="cloud_login">...</form>
```

If your form does not have any of these attributes, we recommend setting such an attribute. If you can neither set a form `name`
nor a form `id`, you will still be able to track the form if there is only one form on your page. To track such a form go to
"Administration => Forms" and create a new form. There you can define one or multiple pages that you want to track into this
newly created form.

## Custom form and field names

If your form or field names change randomly, can also define a form name by using the `data-matomo-name` (recommended) or the `data-piwik-name` attribute like this:

```html
<form data-matomo-name="cloud_login">...</form>
```

Similarly you can define a readable name for your fields like this:

```html
<input data-matomo-name="username" type="text">
```

Note that in Piwik Form Analytics itself you can give a readable name to any form or any field. If your form has for example a field named "input_4",
you can map this field name to a human readable name like "Username" directly in the Piwik user interface. 
You don't need to set a `data-matomo-name` or a `data-piwik-name` in this case.

## Custom form elements

If you do not use a `<form>` element to mark your forms, you can specify a `data-matomo-form` (recommended) or a `data-piwik-form` attribute on any element 
to let Piwik know that this element contains a form. Piwik will then discover this form and all fields automatically.

```html
<div data-matomo-form data-matomo-name="cloud_login">
    <input name="username" type="text">
</div>
```

Alternatively, you can add a form manually using the JavaScript tracker code `_paq.push(['FormAnalytics::trackForm', formNode]);`

Read more about this in the [Form Analytics API Reference](/guides/form-analytics/reference).

## Ignoring forms

If you do not want a form to be tracked, you can specify a `data-matomo-ignore` or a `data-piwik-ignore` attribute on your form like this:

```html
<form name="cloud_signup" data-matomo-ignore></form>
```

If set, it will not even send any tracking requests for this form to your Piwik. This is useful if you want to exclude
for example forms that are shown on each page like a search or a newsletter sign up form.

## When the `piwik.js` in your Piwik directory file is not writable
 
When your Settings > System Check reports that "The Piwik JavaScript tracker file `piwik.js` is not writable 
which means other plugins cannot extend the JavaScript tracker." then you have two options to solve this issue:

1. Make the `piwik.js` file writable, for example by executing `chmod a+w piwik.js` or `chown $phpuser piwik.js` (replace `$phpuser` with actual username) in your Piwik directory. 
We recommend running the [Piwik console](/guides/piwik-on-the-command-line) command `./console custom-piwik-js:update` after you have made the file writable.
2. or Load the FormAnalytics tracker file manually in your website by adding in all your pages ideally in the `<head>`: 
   `<script src="https://your-piwik-domain/plugins/FormAnalytics/tracker.min.js">`

#### Are there any disadvantages of including the file manually?

Yes, there are:

* An additional HTTP request is needed to load your website which increases your page load time
* If your `piwik.js` ever becomes writable, the FormAnalytics tracker would be loaded twice (in such a case the tracker notices it was already initialized and won't track everything twice)

If possible, we recommend making the `piwik.js` file writable.

## What to read next

Now that you've setup Form Analytics, you may want to have a look at the [Form Analytics FAQ](/guides/form-analytics/faq) or the [Form Analytics API reference](/guides/form-analytics/reference).

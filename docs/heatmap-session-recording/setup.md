---
category: Integrate
title: Setting up
---
# Setting up Heatmap & Session Recording

In this guide you will learn how to customize the tracking of [Heatmaps & Session Recordings](https://www.heatmap-analytics.com/).
By default, you do not need to change your tracking code and Piwik takes care of everything. However, you can adjust the tracking
in various ways.

## Embedding the Heatmap & Session Recording JavaScript Tracker

If you have already embedded the [Piwik JavaScript Tracking Code](/guides/tracking-javascript-guide) into your website,
the Heatmap & Session Recording will automatically start tracking user activities. The tracking code is directly added 
in your Piwik JavaScript tracker file `/piwik.js` as long as the file `piwik.js` in your Piwik directory is writable 
by the webserver/PHP.

To check whether this works by default for you, login into Piwik as a Super User, go to Administration, and open the "System Check" report. 
If the System Check displays a warning for "Writable Piwik.js" then [learn below how to solve this](#when-the-piwikjs-in-your-piwik-directory-file-is-not-writable).

## Configuring Heatmaps & Session Recordings

To configure the recording of a session or a heatmap, log in to your Piwik and click on "Heatmaps => Manage" or "Session Recordings => Manage".

There you will be able to configure on which pages you want to record activities and how many sessions should be recorded. 
Piwik will automatically detect any configured heatmap or session recording and start recording activities when needed. 
You don't need to change your tracking code or your website to configure .

To detect if any activities need to be recorded, an HTTP request will be issued on each page view to your Piwik. While this request is 
fast and does for example not connect to your database, it may still add a bit of load to your server. If you want to avoid such 
a request on each page view, have a look at the API reference for [`addConfig()`](/guides/heatmap-session-recording/reference#addconfig).

## Masking keystrokes in form fields

When you record a session, Piwik may record keystrokes / text that a visitor enters into a form field depending on your session recording 
configuration in Piwik. If enabled, Piwik will record text entered into text and textarea form fields and replay them later
in the session recording video. Passwords and [common credit card fields](/guides/heatmap-session-recording/faq#which-form-fields-credit-card-are-masked-automatically-when-recording-a-session) will be automatically masked. This means any text
entered into such a masked field will be replaced with asterisks, for example `secure` may be tracked as `******`.

If you want to capture keystrokes but mask specific form fields that may hold sensitive data, you can set a `data-matomo-mask` (or `data-piwik-mask`) HTML attribute.

You can mask an individual form field like this:
 
```html
<input type="text" name="sensitivedata" data-matomo-mask>
```

Alternatively, you can mask a set of form fields within your web page by specifying the `data-matomo-mask` attribute on a `form` element like this:

```html
<form data-piwik-mask>
  <div>
    <input type="text" name="tax_number">
    <input type="text" name="passport_id">
  </div>
</form>
```

To disable the recording of any keystrokes, call `_paq.push(['HeatmapSessionRecording::disableCaptureKeystrokes']);`
If disabled, no text entered into any form field will be sent to Piwik, not even masked form fields.

## Masking content on your website

When you record a session or generate a heatmap, Matomo may record user sensitive data which is displayed on your website. To mask such content which is not displayed as part of a form element (see above) but any other element (such as a `<p>` or `<div>`), you can use the `data-matomo-mask` attribute as well. The `data-matomo-mask` attribute works from version 3.1.9 of Heatmap & Session Recording.

You can mask an individual element like this:
 
```html
<span data-matomo-mask>Firstname lastname</span>
```

Alternatively, you can mask a set of elements within your web page by specifying the `data-matomo-mask` attribute on an element that is higher in the hierarchy:

```html
<div data-matomo-mask>
  <p>
  <span>Firstname</span>
  <span>Lastname</span>
  </p>
</div>
```

When the content is masked, each character will be replaced by an asterisk (`*`) before sending the data to Matomo. It will also mask any content that is shown in a `title`, `alt`, `label` or `placeholder` attribute.

## When the `piwik.js` in your Piwik directory file is not writable
 
When your Settings > System Check reports that "The Piwik JavaScript tracker file `piwik.js` is not writable 
which means other plugins cannot extend the JavaScript tracker." then you have two options to solve this issue:

1. Make the `piwik.js` file writable, for example by executing `chmod a+w piwik.js` or `chown $phpuser piwik.js` (replace `$phpuser` with actual username) in your Piwik directory. 
We recommend running the [Piwik console](/guides/piwik-on-the-command-line) command `./console custom-piwik-js:update` after you have made the file writable.
2. or Load the HeatmapSessionRecording tracker file manually in your website by adding in all your pages ideally in the `<head>`: 
   `<script src="https://your-piwik-domain/plugins/HeatmapSessionRecording/tracker.min.js">`

#### Are there any disadvantages of including the file manually?

Yes, there are:

* An additional HTTP request is needed to load your website which increases your page load time
* If your `piwik.js` ever becomes writable, the HeatmapSessionRecording tracker would be loaded twice (in such a case the tracker notices it was already initialized and won't track everything twice)

If possible, we recommend making the `piwik.js` file writable.

## What to read next

Now that you've completed the setup, you may want to read the [Heatmap & Session Recording developer FAQ](/guides/heatmap-session-recording/faq), 
or learn more about the [Heatmap & Session Recording JavaScript API](/guides/heatmap-session-recording/reference).

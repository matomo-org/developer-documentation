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
in your Piwik JavaScript tracker file `/matomo.js` as long as the file `matomo.js` in your Piwik directory is writable 
by the webserver/PHP.

To check whether this works by default for you, login into Piwik as a Super User, go to Administration, and open the "System Check" report. 
If the System Check displays a warning for "Writable Matomo.js" then [learn below how to solve this](#when-the-matomojs-in-your-piwik-directory-file-is-not-writable).

## Configuring Heatmaps & Session Recordings

To configure the recording of a session or a heatmap, log in to your Piwik and click on "Heatmaps => Manage" or "Session Recordings => Manage".

There you will be able to configure on which pages you want to record activities and how many sessions should be recorded. 
Piwik will automatically detect any configured heatmap or session recording and start recording activities when needed. 
You don't need to change your tracking code or your website to configure .

To detect if any activities need to be recorded, an HTTP request will be issued on each page view to your Piwik. While this request is 
fast and does for example not connect to your database, it may still add a bit of load to your server. If you want to avoid such 
a request on each page view, have a look at the API reference for [`addConfig()`](/guides/heatmap-session-recording/reference#addconfig).

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

## Unmasking keystrokes in form fields

When you record a session, Matomo may record keystrokes that a visitor enters into a form field depending on your session recording 
configuration. By default, no keystrokes are captured. If the feature to record keystrokes is enabled, Matomo will record any text entered into form fields and replay them later
in the session recording video but any entered text will be "masked". This means any text entered into such a masked field will be replaced with asterisks, for example `secure` may be tracked as `******`.

If you wanted to record keystrokes for some form fields in plain text, you need to enable the capturing of keystrokes in the session recording and specifically whitelist
in the HTML of your website or app which form fields are OK to be recorded by specifying a `data-matomo-unmask` attribute. There is also a `data-matomo-mask`
attribute to prevent the recording of sensitive information if a parent was whitelisted.

Please note that some fields, such as passwords, common credit card fields, and [some other fields](/guides/heatmap-session-recording/faq#which-form-fields-credit-card-are-always-masked-when-recording-a-session) will be always masked to prevent the recording of potential personal or sensitive information in plain text. 

You can unmask an individual form field like this:
 
```html
<input type="text" name="example_field_record_plain_text" data-matomo-unmask>
```

Alternatively, you can mask a set of form fields within your web page by specifying the `data-matomo-unmask` or `data-matomo-mask` attribute on a `form` element like this:

```html
<form data-matomo-unmask>
  <div>
    <input type="text" name="example_field_record_plain_text">
    <input type="text" name="tax_number" data-matomo-mask>
    <input type="text" name="passport_id" data-matomo-mask>
  </div>
</form>
```

To force that no keystrokes will be recorded even when enabled in the UI, call `_paq.push(['HeatmapSessionRecording::disableCaptureKeystrokes']);`
If disabled, no text entered into any form field will be sent to Piwik, not even masked form fields.

## When the `matomo.js` in your Piwik directory file is not writable
 
When your Settings > System Check reports that "The Piwik JavaScript tracker file `matomo.js` is not writable 
which means other plugins cannot extend the JavaScript tracker." then you have two options to solve this issue:

1. Make the `matomo.js` file writable, for example by executing `chmod a+w piwik.js` or `chown $phpuser piwik.js` (replace `$phpuser` with actual username) in your Piwik directory. 
We recommend running the [Piwik console](/guides/piwik-on-the-command-line) command `./console custom-matomo-js:update` after you have made the file writable.
2. or Load the HeatmapSessionRecording tracker file manually in your website by adding in all your pages ideally in the `<head>`: 
   `<script src="https://your-matomo-domain/plugins/HeatmapSessionRecording/tracker.min.js">`

Note: Loading the tracker file manually won't work if you are using [Matomo for WordPress](https://matomo.org/installing-matomo-for-wordpress/). The Matomo JS tracker will automatically include the tracking code so loading it manually won't be needed. To find the correct path for the Matomo JS Tracker file see the Matomo Endpoints section in the [Matomo for WordPress System Report](https://matomo.org/faq/wordpress/how-do-i-find-and-copy-the-system-report-in-matomo-for-wordpress/). In most cases the path looks like this: `//your-matomo-domain/wp-content/uploads/matomo/matomo.js`. Matomo for WordPress will automatically use the correct path unless you configure the tracking code manually.


#### Are there any disadvantages of including the file manually?

Yes, there are:

* An additional HTTP request is needed to load your website which increases your page load time
* If your `matomo.js` ever becomes writable, the HeatmapSessionRecording tracker would be loaded twice (in such a case the tracker notices it was already initialized and won't track everything twice)

If possible, we recommend making the `matomo.js` file writable.

## What to read next

Now that you've completed the setup, you may want to read the [Heatmap & Session Recording developer FAQ](/guides/heatmap-session-recording/faq), 
or learn more about the [Heatmap & Session Recording JavaScript API](/guides/heatmap-session-recording/reference).

---
category: Integrate
---

# Single-Page Application/Progressive Web App Tracking

In the rapidly evolving digital landscape, single-page applications (SPAs) and Progressive Web Apps (PWAs) have emerged as a prevalent choice for developers, given their fast load times, smooth user experience, and offline capabilities. This document serves as a comprehensive guide to setting up accurate tracking within SPAs and PWAs using Matomo, an open-source analytics platform. We cover multiple solutions to ensure you gather meaningful and correct data, vital for optimising user experience and achieving your digital objectives.

# Solution 1) Embed Matomo Tag Manager Container Code

If you're using [Tag Manager](https://matomo.org/tag-manager/) to implement your Matomo Analytics Tracking, then in your Single Page Application,  whenever there is a new page loaded in your app you will need your [Matomo Tag](https://matomo.org/docs/tag-manager/#configuring-a-tag) to be triggered for the Page view to be tracked.

To trigger your Matomo tag (which calls `trackPageView`), you can either:

1. In your [Matomo Tag Manager container](https://matomo.org/faq/tag-manager/create-a-container-in-matomo-tag-manager/), navigate to [Triggers](https://matomo.org/guide/tag-manager/triggers/) and click “Create new Trigger”.
2. Select the “History Change” trigger under the “User Engagement” section.
3. Give your trigger a name, and click “Create New Trigger”.
4. Create another trigger, this time selecting “Pageview” for the trigger type.
5. Next, navigate to [Tags](https://matomo.org/guide/tag-manager/tags/) and click “Create New Tag” and select “Matomo Analytics” as the Tag type.
6. Select your Matomo Configuration Variable and set the Tracking type to “Pageview”.
7. Set the Custom Title to `{{PageTitle}}`.
8. Set the Custom URL to `{{PageOrigin}}/{{PageHash}}` if your SPA or PWA app updates only the `#` part of the URL. Otherwise, set it as `{{PageUrl}}`.
9. Under the option “Execute this tag when any of these triggers are triggered”, select the “History Change” and “Pageview” triggers that we created.
10. Use the [Preview/Debug](https://matomo.org/faq/tag-manager/preview-debug-a-tag-manager-container/) mode to test and ensure that your Triggers & Tag are working as expected.
11. Once you’ve confirmed that the Trigger and Tag are working as expected, publish the changes so that they’re deployed to your website.


## How to Trigger Matomo Tag Manager PageView, DOMReady and WindowLoad event using javascript.
- In your Single Page App, if you are using the 'Pageview Trigger' to trigger a Pageview, you can trigger a Tag Manager Event `{event: 'mtm.PageView'}` by calling the following line in JavaScript: `window._mtm.push({'event': 'mtm.PageView'});`. This would also work similarly when you use the 'DOM Ready Trigger' (call `window._mtm.push({'event': 'DOMReady'});`) or when you use the 'Window Loaded Trigger' (call `_mtm.push({'event': 'WindowLoad'});`.

# Solution 2) Embedding the Tracking Code manually

If you're not using the Tag Manager, then you need to embed your Matomo JavaScript tracking code into your single-page website or web application as you would for a classic website.

To embed the tracking code manually, you have two options:

1. either you can consider using an existing SDK that may be available for your framework: [see all available integrations for Matomo](https://matomo.org/integrate/#programming-language-platforms-and-frameworks).
2. or you can simply embed the tracking code manually in your app. To find your tracking code, go to “Administration” in the top right in your Matomo instance, click on “Tracking Code” and adjust the tracking code to your needs. You can find more information in our [JavaScript Tracking Client documentation](https://developer.matomo.org/guides/tracking-javascript-guide)


In the sections below you will learn how to setup Matomo tracking with single-page applications (SPAs). It addresses how to track page views, reset custom variables and dimensions, update referrer URLs, scan for new content, and implement Heatmap & Session Recording. A comprehensive example illustrates how these elements integrate within an SPA environment. Information on offline tracking and support resources are also provided.

## Tracking a New Page View

The challenge begins when you need to track a new page view. A single-page application is different from a usual website as there is no regular new page load and Matomo cannot detect automatically when a new page is viewed. This means you need to let Matomo know whenever the URL and the page title changes. You can do
this using the methods `setCustomUrl` and `setDocumentTitle` like this:

```javascript
window.addEventListener('hashchange', function() {
        _paq.push(['setCustomUrl', '/' + window.location.hash.substr(1)]);
        _paq.push(['setDocumentTitle', 'My New Title']);
        _paq.push(['trackPageView']);
});
```
### Resetting previously set custom variables

If you have set any [Custom Variables](https://matomo.org/docs/custom-variables/) in scope “page”, you need to make sure to delete these custom variables again as they would be attributed to the new page view as well otherwise:

```javascript
_paq.push(['deleteCustomVariables', 'page']);
_paq.push(['trackPageView']);
```

Note: we recommend you use [Custom Dimensions](https://matomo.org/docs/custom-dimensions/) instead of Custom Variables as they will be deprecated in the future.

### Resetting previously set custom dimensions

Similar to Custom Variables, you also need to unset [Custom Dimensions](https://matomo.org/docs/custom-dimensions/) when changing the page as they would otherwise be tracked again.

```javascript
_paq.push(['deleteCustomDimension', 1]);
_paq.push(['trackPageView']);
```

### Updating the referrer

Depending on whether you want to track the previous page as a referrer for the new page view, you should update the referrer URL by setting it to the previous page URL:

```javascript
_paq.push(['setReferrerUrl', previousPageUrl]);
_paq.push(['trackPageView']);
```

## Making Matomo Aware of New Content

When you show a new page, your single-page DOM might change as well. For example, you might replace parts of your page with new content that you loaded from your server via Ajax. This means you need to instruct Matomo to scan the DOM for new content. We'll now go over various content types (Videos & Audio, Forms, Links and Downloads, Content tracking).

### Video and Audio tracking

If you use the [Media Analytics](https://matomo.org/docs/media-analytics/) feature to track your videos and audios, whenever a new page is displayed you need to call the following method:

```javascript
_paq.push(['MediaAnalytics::scanForMedia', documentOrElement]);
```
When you don’t pass any parameter, it will scan the entire DOM for new media. Alternatively, you can pass an element to scan only a certain area of your website or app for new media.

### Form tracking

If you use the [Form Analytics](https://matomo.org/docs/form-analytics/) feature to measure the performance of your online forms, whenever a new page is displayed you need to call the following method:

```javascript
_paq.push(['FormAnalytics::scanForForms', documentOrElement]);
```

Where `documentOrElement` points either to `document` to re-scan the entire
DOM (the default when no parameter is set) or you can pass an element to
restrict the re-scan to a specific area.

### A/B testing

If you use the [A/B Testing](https://matomo.org/docs/ab-testing/) feature to test your experiments, whenever a new page is displayed you need to embed the js code again before tracking a new pageview as explained below:

```javascript
window.addEventListener('pathchange', function() {
   var _paq = window._paq = window._paq || [];
   _paq.push(['setCustomUrl', window.location.pathname]);
   _paq.push(['setDocumentTitle', document.title]);
   _paq.push(['AbTesting::create', {
      name: 'theExperimentName',
      includedTargets: [{"attribute":"url","type":"starts_with","value":"http:\/\/www.example.org","inverted":"0"}],
      excludedTargets: [],
      variations: [
         {
            name: 'original',
            activate: function (event) {
               // usually nothing needs to be done here
            }
         },
         {
            name: 'blue',
            activate: function(event) {
               // eg $('#btn').attr('style', 'color: ' + this.name + ';');
            }
         }
      ]
   }]);
   _paq.push(['trackPageView']);
});
```

### Link tracking

Supposing that you use the link tracking feature to measure [outlinks](https://matomo.org/faq/new-to-piwik/faq_71/) and [downloads](https://matomo.org/faq/new-to-piwik/faq_47/), Matomo needs to re-scan the entire DOM for newly added links whenever your DOM changes. To make sure Matomo will track such links, call this method:

```javascript
_paq.push(['enableLinkTracking']);
```

### Content tracking

If you use the [Content Tracking](https://matomo.org/docs/content-tracking/) feature, whenever a new page is displayed and some parts of your DOM changes, you need to call this method :

```javascript
_paq.push(['trackContentImpressionsWithinNode', documentOrElement]);
```
Where `documentOrElement` points either to `document` or an element similar to the other methods. Matomo will then scan the page for newly added content blocks.

### Heatmap & Session Recording

To support single-page websites and web applications out of the box, [Heatmap](https://matomo.org/docs/heatmaps/) & [Session Recording](https://matomo.org/docs/session-recording/) will automatically detect a new page view when you call the `trackPageView` method. This applies if you call `trackPageView` several times without an actual page reload. Matomo will stop the recording of any activities after each call of `trackPageView` and re-evaluate whether it should record activities for the new page based on the new URL.

If you have a single-page website and you use `trackPageView` for any other purposes than an actual page view, it is recommended to disable the default behaviour using this method and let Heatmap & Session Recording explicitly know when there is a new page view by calling the two methods `disableAutoDetectNewPageView` and `setNewPageView`.

If you're setting a Custom URL in the single-page website, you may need to use the [`matchTrackerUrl()`](https://developer.matomo.org/guides/heatmap-session-recording/reference#matchtrackerurl) in order to allow the Matomo tracker to correctly trigger Heatmaps and Session Recordings.

Learn more in the [JS Tracker API reference for Heatmaps & Session Recording](https://developer.matomo.org/guides/heatmap-session-recording/reference#disableautodetectnewpageview).

## Measuring Single-Page Apps: Complete Example

In this example we show how everything works together assuming you want to track a new page whenever a hash changes:

```javascript
var currentUrl = location.href;
window.addEventListener('hashchange', function() {
    _paq.push(['setReferrerUrl', currentUrl]);
     currentUrl = '/' + window.location.hash.substr(1);
    _paq.push(['setCustomUrl', currentUrl]);
    _paq.push(['setDocumentTitle', 'My New Title']);

    // remove all previously assigned custom variables, requires Piwik 3.0.2
    _paq.push(['deleteCustomVariables', 'page']);
    _paq.push(['AbTesting::create', {
       name: 'theExperimentName',
       includedTargets: [{"attribute":"url","type":"starts_with","value":"http:\/\/www.example.org","inverted":"0"}],
       excludedTargets: [],
       variations: [
          {
             name: 'original',
             activate: function (event) {
                // usually nothing needs to be done here
             }
          },
          {
             name: 'blue',
             activate: function(event) {
                // eg $('#btn').attr('style', 'color: ' + this.name + ';');
             }
          }
       ]
    }]);
    _paq.push(['trackPageView']);
    
    // make Matomo aware of newly added content
    var content = document.getElementById('content');
    _paq.push(['MediaAnalytics::scanForMedia', content]);
    _paq.push(['FormAnalytics::scanForForms', content]);
    _paq.push(['trackContentImpressionsWithinNode', content]);
    _paq.push(['enableLinkTracking']);
});
```


## Offline Tracking

If your web application requires offline tracking, please refer to the [Matomo offline tracking](https://matomo.org/faq/how-to/how-do-i-set-up-matomo-offline-tracking/) guide.


## Questions?

If you have any questions or need help, please [get in touch with our support team](https://matomo.org/support/) or for free support: [ask on the forum](https://forum.matomo.org).

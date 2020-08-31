---
category: Integrate
---
# JavaScript Tracking Client

You can use the JavaScript tracking client to track any application that supports JavaScript: for example websites!

This guide will explain how you can use the JavaScript tracking client to customize the way some of the web analytics data is recorded in Piwik.

## Finding the Piwik Tracking Code

To use all the features described in this page, you need to use the latest version of the tracking code. To find the tracking code for your website, follow the steps below:

- log in to Piwik with your admin or Super User account
- click on your username in the top right menu, and click *Settings* to access the administration area
- click on *Tracking Code* in the left menu
- copy and paste the JavaScript tracking code into your pages, just after the opening `<body>` tag (or within the `<head>` section)

The tracking code looks as follows:

```html
<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq = window._paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//{$MATOMO_URL}/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', {$IDSITE}]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
```

In your tracking code, `{$MATOMO_URL}` would be replaced by your Piwik URL and `{$IDSITE}` would be replaced by the idsite of the website you are tracking in Piwik.

This code might look a bit strange to those of you familiar with JavaScript, but that is because it is made to run asynchronously. In other words, browsers will not wait for the `matomo.js` file to be downloaded in order to show your page.

For asynchronous tracking, configuration and tracking calls are pushed onto the global `_paq` array for execution, independent of the asynchronous loading of `matomo.js`. The format is:

```javascript
_paq.push([ 'API_method_name', parameter_list ]);
```

You can also push functions to be executed. For example:

```javascript
var visitor_id;
_paq.push([ function() { visitor_id = this.getVisitorId(); }]);
```

or for example, to fetch a custom variable (name, value) using the asynchronous code:

```javascript
_paq.push(['setCustomVariable','1','VisitorType','Member']);
_paq.push([ function() { var customVariable = this.getCustomVariable(1); }]);
```

You can push to the `_paq` array even after the `matomo.js` file has been loaded and run.

If your Piwik tracking code doesn't look like this one, you may be using the deprecated version.
Older versions still work as expected and will track your visitors, but we highly recommend that you update your pages to use the most recent tracking code.

## JavaScript tracker features

### Custom page name

By default, Piwik uses the URL of the current page as the page title in Piwik reports.
If your URLs are not simple, or if you want to customize the way Piwik tracks your pages,
you can specify the page title to use in the JavaScript code.

A common use case is to set the title of the HTML page as the document title:

```javascript
_paq.push(['setDocumentTitle', document.title]);
_paq.push(['trackPageView']);
```

If you track **multiple sub-domains in the same website**, you may want your page titles to be prefixed by the sub-domain make it easy for you to see the traffic and data for each sub-domain. You can do so simply:

```javascript
_paq.push(['setDocumentTitle', document.domain + "/" + document.title]);
_paq.push(['trackPageView']);
```

Advanced users can also dynamically generate the page name, for example, using PHP:

```javascript
_paq.push(['setDocumentTitle', "<?php echo $myPageTitle ?>"]);
_paq.push(['trackPageView']);
```

### Manually trigger events

By default, Piwik tracks page views when the JavaScript tracking code loads and executes on each page view.

However, on modern web applications, user interactions do not necessarily involve loading a new page. For example, when users click on a JavaScript link, or when they click on a tab (which triggers a JS event), or when they interact with elements of the user interface, you can still track these interactions with Piwik.

To track any user interaction or click with Piwik, you can manually call the JavaScript function `trackEvent()`. For example, if you wanted to track a click on a JavaScript menu, you could write:

```html
<a href="#" onclick="_paq.push(['trackEvent', 'Menu', 'Freedom']);">Freedom page</a>
```

You can learn more about [Tracking Events](https://matomo.org/docs/event-tracking/#tracking-events) in the user guide.

### Manually trigger goal conversions

By default, Goals in Piwik are defined as "matching" parts of the URL (starts with, contains, or regular expression matching). You can also track goals for given page views, downloads, or outlink clicks.

In some situations, you may want to register conversions on other types of actions, for example:

- when a user submits a form
- when a user has stayed more than a given amount of time on the page
- when a user does some interaction in your Flash application
- when a user has submitted his cart and has done the payment: you can give the Piwik tracking code to the payment website which will then register the conversions in your Piwik database, with the conversion's custom revenue

To trigger a goal conversion:

```javascript
// logs a conversion for goal 1
_paq.push(['trackGoal', 1]);
```

You can also register a conversion for this goal with a custom revenue. For example, you can generate the call to `trackGoal()` dynamically to set the revenue of the transaction:

```javascript
// logs a conversion for goal 1 with the custom revenue set
_paq.push(['trackGoal', 1, <?php echo $cart->getCartValue(); ?>]);
```

Find more information about goal tracking in Piwik in the [**Tracking Goals**](https://matomo.org/docs/tracking-goals-web-analytics/) documentation.

### Accurately measure the time spent on each page

By default, when a user visits only one page view during a visit, Piwik will assume that the visitor has spent 0 second on the website. This has a few consequences:

* when the visitor views only one page view, the "Visit duration" will be 0 second.
* when the visitor views more than one page, then the last page view of the visit will have a "Time spent on page" of 0 second.

It is possible to configure Piwik so that it accurately measures the time spent on the last page of a visit. To better measure time spent on the page, add to your JavaScript code the following:

```javascript
// accurately measure the time spent on the last pageview of a visit
_paq.push(['enableHeartBeatTimer']);
```

Piwik will then send requests to count the actual time spent on the page, when the user is actively viewing the page (i.e. when the tab is active and in focus). The heart beat request is executed when:

 * switching to another browser tab after the current tab was active for at least 15 seconds (can be configured see below)
 * navigating to another page within the same tab. 

```javascript
// Change how long a tab needs to be active to be counted as viewed in seconds/
// Requires a page to be actively viewed for 30 seconds for any heart beat request to be sent.
_paq.push(['enableHeartBeatTimer', 30]);
```

Note: When testing the heart beat timer, remember to make sure the browser tab has focus and not eg. the developer tools or another panel.

## Ecommerce tracking

Piwik allows for advanced and powerful Ecommerce tracking. Check out the [Ecommerce Analytics](https://matomo.org/docs/ecommerce-analytics/) documentation for more information about Ecommerce reports and how to set up Ecommerce tracking.

## Internal search tracking

Piwik offers advanced [Site Search Analytics](https://matomo.org/docs/site-search/) feature, letting you track how your visitors use your internal website search engine. By default, Piwik can read URL parameters that will contain the search keyword. However, you can also record the site search keyword manually using the JavaScript function `trackSiteSearch(...)`

In your website, in standard pages, you would typically have a call to record Page views via `matomoTracker.trackPageView()`. On your search result page, you would call **instead** `piwikTracker.trackSiteSearch(keyword, category, searchCount)` function to record the internal search request. Note: the 'keyword' parameter is required, but category and searchCount are optional.

```javascript
_paq.push(['trackSiteSearch',
    // Search keyword searched for
    "Banana",
    // Search category selected in your search engine. If you do not need this, set to false
    "Organic Food",
    // Number of results on the Search results page. Zero indicates a 'No Result Search Keyword'. Set to false if you don't know
    0
]);

// We recommend not to call trackPageView() on the Site Search Result page
// _paq.push(['trackPageView']);
```

We also highly recommend to set the searchCount parameter, as Piwik will specifically report "No Result Keywords", ie. Keywords that were searched, but did not return any result. It is usually very interesting to know what users search for but can't find (yet?) on your website. Learn more about [Site Search Analytics in the User Doc](https://matomo.org/docs/site-search/).

## Custom variables

Custom variables are a powerful feature that enable you to track custom values for each visit, and/or each page view. Please see the [Tracking custom variables](https://matomo.org/docs/custom-variables/) documentation page for general information.

You can set up up to 5 custom variables (name and value) for each visit to your website, and/or up to 5 custom variables for each page view. If you set a custom variable to a visitor, when he comes back one hour or two days later, it will be a new visit and his/her custom variables will be empty.

There are two "scopes" which you can set your custom variables to. The "scope" is the 4th parameter of the function `setCustomVariable()`.

- when scope = "visit", the custom variable's name and value will be stored in the visit in the database. You can therefore store up to 5 custom variables of scope "visit" for each visit.
- when scope = "page", the custom variable's name and value will be stored for the page view being tracked. You can therefore store up to 5 custom variables of scope "page" for each page view.

The "index" parameter is the custom variable slot index, an integer from 1 to 5. (note: [read this FAQ](https://matomo.org/faq/how-to/faq_17931/) if you need more than the default 5 slots).

Custom variable statistics are reported in Piwik under **Visitors &gt; custom variables**. Both custom variables of scope "visit" and "page" are aggregated in this report.

### Custom variables for visits

```javascript
setCustomVariable(index, name, value, scope = "visit")
```

This function is used to create, or update a custom variable name and value. For example, imagine you want to store in each visit the gender of the user. You would store the custom variable with a name = "gender", value = "male" or "female".

**Important:** a given custom variable name must always be stored in the same "index". For example, if you choose to store the variable **name = "Gender"** in **index = 1** and you record another custom variable in index = 1, then the "Gender" variable will be deleted and replaced with the new custom variable stored in index 1.

```javascript
_paq.push(['setCustomVariable',
    // Index, the number from 1 to 5 where this custom variable name is stored
    1,
    // Name, the name of the variable, for example: Gender, VisitorType
    "Gender",
    // Value, for example: "Male", "Female" or "new", "engaged", "customer"
    "Male",
    // Scope of the custom variable, "visit" means the custom variable applies to the current visit
    "visit"
]);

_paq.push(['trackPageView']);
```

You only need to set a variable with scope "visit" once, and the value will be recorded for the whole visit.

### Custom variable for page views

```javascript
setCustomVariable(index, name, value, scope = "page")
```

As well as tracking custom variables for "visits", it is sometimes useful to track custom variables for each page view separately. For example, for a "News" website or blog, a given article may be categorized into one or several categories. In this case, you could set one or several custom variables with `name="category"`, one with `value="Sports"` and another with `value="Europe"` if the article is classified in Sports and Europe Categories. The custom variables report will then report on how many visits and page views were in each of your website's categories. This information can be difficult to obtain with standard Piwik reports because they report on "Best Page URLs" and "Best Page Titles" which might not contain the "category" information.

```javascript
// Track 2 custom variables with the same name, but in different slots.
// You will then access the statistics about your articles' categories in the 'Visitors &gt; custom variables' report
_paq.push(['setCustomVariable', 1, 'Category', 'Sports', 'page']);

// Track the same name but in a different Index
_paq.push(['setCustomVariable', 2, 'Category', 'Europe', 'page']);
// Here you could track other custom variables with scope "page" in Index 3, 4 or 5
// The order is important: first setCustomVariable is called and then trackPageView records the request

_paq.push(['trackPageView']);
```

**Important:** It is possible to store a custom variables of scope "visit" in "index" 1, and store a different custom variable of scope "page" in the same "index" 1. Therefore, you can technically **track up to 10 custom variables names and values on every page** of your website (5 with a "page" scope stored in the actual page view, 5 with a "visit" scope stored in the visit).

```javascript
_paq.push(['setCustomVariable',
    // Index, the number from 1 to 5 where this custom variable name is stored for the current page view
    1,
    // Name, the name of the variable, for example: Category, Sub-category, UserType
    "category",
    // Value, for example: "Sports", "News", "World", "Business", etc.
    "Sports",
    // Scope of the custom variable, "page" means the custom variable applies to the current page view
    "page"
]);

_paq.push(['trackPageView']);
```

### Deleting a custom variable

```javascript
deleteCustomVariable(index, scope)
```

If you created a custom variable and then decide to remove this variable from a visit or page view, you can use deleteCustomVariable.

To persist the change in the Piwik server, you must call the function before the call to `trackPageView();`

```javascript
_paq.push(['deleteCustomVariable', 1, "visit"]); // Delete the variable in index 1 stored for the current visit
_paq.push(['trackPageView']);
```

### Retrieving a custom variable

```javascript
getCustomVariable(index, scope)
```

This function can be used to get the custom variable name and value. By default, it will only work for custom variables that were set during the same page load.

Note: it is possible to configure Piwik so that `getCustomVariable` will also return the name and value of a custom variable of scope "visit", even when it was set in a previous pageview in the same visit. To enable this behavior, call the JavaScript function `storeCustomVariablesInCookie` before the call to `trackPageView`. This will enable the storage of Custom Variables of scope "visit" in a first party cookie. The custom variables cookie will be valid for the duration of the visit (30 minutes after the last action). You can then retrieve the custom variable names and values using `getCustomVariable`. If there is no custom variable in the requested index, it will return false.

```javascript
_paq.push([ function() {

    var customVariable = this.getCustomVariable( 1, "visit" );
    // Returns the custom variable: [ "gender", "male" ]

    // do something with customVariable...

}]);

_paq.push(['trackPageView']);
```

## Custom Dimensions

[Custom Dimensions](https://matomo.org/docs/custom-dimensions/) are a powerful feature that enable you to track custom values for each visit, and/or each action (page view, outlink, download). This feature is not shipped with Piwik directly but can be installed as a plugin via the [Piwik Marketplace (CustomDimensions plugin)](https://plugins.matomo.org/CustomDimensions). Before you can use a Custom Dimension you need to install the plugin and configure at least one dimension, see the [Custom Dimensions guide](https://matomo.org/docs/custom-dimensions/). You will get a numeric ID for each configured Custom Dimension which can be used to set a value for it.

### Tracking a Custom Dimension across tracking requests

To track a value simply specify the ID followed by a value:

```javascript
_paq.push(['setCustomDimension', customDimensionId = 1, customDimensionValue = 'Member']);
```

Please note once a Custom Dimension is set, the value will be used for all following tracking requests and may lead to
inaccurate results if this is not wanted. For example if you track a page view, the Custom Dimension value will be as well tracked for each following event, outlink, download, etc. within the same page load. Calling this method will not actually trigger a tracking request, instead the values will be sent along with the following tracking requests. To delete a Custom Dimension value after a tracking request call
`_paq.push(['deleteCustomDimension', customDimensionId]);`

#### Setting a custom dimension for the initial page view

To set a custom dimension for the initial page view, make sure to position the method call `setCustomDimension` before `trackPageView`:

```javascript
_paq.push(['setCustomDimension', customDimensionId = 1, customDimensionValue = 'Member']);
_paq.push(['trackPageView']);
// _paq.push(['enableLinkTracking']);
// rest of tracking code
```

### Tracking a Custom Dimension for one specific action only

It is possible to set a Custom Dimension for one specific action only. If you want to track a Page view, you can send one or more specific Custom Dimension values along with this tracking request as follows:

`_paq.push(['trackPageView', pageTitle, {dimension1: 'DimensionValue'}]);`

To define a dimension value pass an object defining one or multiple properties as the last parameter (make sure to specify all parameters as defined in the method, we do not automatically assume the last parameter is customData but instead all parameters that a method defines need to be passed to each method). The property name for a dimension starts with `dimension` followed by a Custom Dimension ID, for example `dimension1`. The same behaviour applies for several other methods:

```javascript
_paq.push(['trackEvent', category, action, name, value, {dimension1: 'DimensionValue'}]);
_paq.push(['trackSiteSearch', keyword, category, resultsCount, {dimension1: 'DimensionValue'}]);
_paq.push(['trackLink', url, linkType, {dimension1: 'DimensionValue'}]);
_paq.push(['trackGoal', idGoal, customRevenue, {dimension1: 'DimensionValue'}]);
```

The advantage is that the set dimension value will be only used for this particular action and you do not have to delete the value after a tracking request. You may set multiple dimension values like this:

`_paq.push(['trackPageView', pageTitle, {dimension1: 'DimensionValue', dimension4: 'Test', dimension7: 'Value'}]);`

### Retrieving a Custom Dimension value

```javascript
getCustomDimension(customDimensionId)
```

This function can be used to get the value of a Custom Dimension. It will only work if a Custom Dimension was set during the same page load.


## User ID

[User ID](https://matomo.org/docs/user-id/) is a feature in Piwik that lets you connect together a given user's data collected from multiple devices and multiple browsers. There are two steps to implementing User ID:

- You must assign a unique and persistent non-empty string that represents each logged-in user. Typically, this ID will be an email address or a username provided by your authentication system.
- You must set the user ID for each pageview, otherwise the pageview will be tracked without the user ID set.  
- You must then pass this User ID string to Piwik via the `setUserId` method call just before calling any of the `track*` functions (`trackPageview`, `trackEvent`, `trackGoal`, `trackSiteSearch`, etc.) for example:

```javascript
_paq.push(['setUserId', 'USER_ID_HERE']);
_paq.push(['trackPageView']);
```

Note: `USER_ID_HERE` must be a unique and persistent non-empty string that represents a user across devices.

### When user is logged in, set the User ID

Let's take an example. Imagine that your website authenticate your users via a login form using a PHP script. Here is what your Piwik JavaScript snippet may look like:

```javascript
var _paq = window._paq = window._paq || [];

<?php
// If user is logged-in then call 'setUserId'
// $userId variable must be set by the server when the user has successfully authenticated to your app.
if (isset($userId)) {
     echo sprintf("_paq.push(['setUserId', '%s']);", $userId);
}
?>

_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
```

### When user logs out, reset User ID 

When the user has logged out and a User ID is not available anymore, it is recommended to notify Matomo by calling the `resetUserId` method before `trackPageView`. 

If you want to create a new visit when your users logout, then you can also force Matomo to create a new Visit by calling `resetUserId` and `appendToTrackingUrl` (twice) as below:


```javascript

// User has just logged out, we reset the User ID
_paq.push(['resetUserId']);

// we also force a new visit to be created for the pageviews after logout
_paq.push(['appendToTrackingUrl', 'new_visit=1']); 

_paq.push(['trackPageView']);

// we finally make sure to not again create a new visit afterwards (important for Single Page Applications)
_paq.push(['appendToTrackingUrl', '']); 

```


## Content Tracking

There are several ways to track content impressions and interactions manually, semi-automatically and automatically. Please be aware that content impressions will be tracked using bulk tracking which will always send a `POST` request, even if `GET` is configured which is the default. For more details have a look at the [in-depth guide to Content Tracking](https://developer.matomo.org/guides/content-tracking).

### Track all content impressions within a page

You can use the method `trackAllContentImpressions()` to scan the entire DOM for content blocks. For each content block we will track a content impression immediately. If you only want to track visible content impression have a look at `trackVisibleContentImpressions()`.

```javascript
_paq.push(['trackPageView']);
_paq.push(['trackAllContentImpressions']);
```

We won't send an impression of the same content block twice if you call this method multiple times unless `trackPageView()` is called meanwhile. This is useful for single page applications.

### Track only visible content impressions within a page.

Enable to track only visible content impressions via `trackVisibleContentImpressions(checkOnScroll, timeIntervalInMs)`. With visible we mean the content block has been in the view port and is not hidden (opacity, visibility, display, ...).

- Optionally you can tell us to not rescan the DOM after each scroll by passing `checkOnScroll=false`. Otherwise, we will check whether the previously hidden content blocks became visible meanwhile after a scroll and if so track the impression.
  * Limitation: If a content block is placed within a scrollable element (`overflow: scroll`), we do currently not detect when such an element becomes visible.
- Optionally you can tell us to rescan the entire DOM for new content impressions every X milliseconds by passing `timeIntervalInMs=500`. By default, we will rescan the DOM every 750ms. To disable it pass `timeIntervalInMs=0`.
  * Rescanning the entire DOM and detecting the visible state of content blocks can take a while depending on the browser, hardware and amount of content. In case your frames per second goes down you might want to increase the interval or disable it completely. In case you disable it you can still rescan the DOM manually at any time by calling this method again or `trackContentImpressionsWithinNode()`.

Both `checkOnScroll` and `timeIntervalInMs` cannot be changed after this method was called the first time.

```javascript
_paq.push(['trackPageView']);
_paq.push(['trackVisibleContentImpressions', true, 750]);
```

### Track content impressions only for a part of the page

Use the method `trackContentImpressionsWithinNode(domNode, contentTarget)` if you are adding elements to your DOM after we have tracked the initial impressions. Calling this method will make sure an impression will be tracked for all content blocks contained within this node.

Example

```javascript
var div = $('<div>...<div data-track-content>...</div>...<div data-track-content>...</div></div>');
$('#id').append(div);

_paq.push(['trackContentImpressionsWithinNode', div[0]]);
```

We would detect two new content impressions in this example. In case you have enabled to track only visible content blocks we will respect this.

### Track an interaction semi-automatic

Interactions with content blocks are usually tracked automatically as soon as a visitor is clicking on it. Sometimes you might want to trigger an interaction manually for instance in case you want to trigger an interaction based on a form submit or a double click. To do so call the method `trackContentInteractionNode(domNode, contentInteraction)`.

Example

```javascript
formElement.addEventListener('submit', function () {
    _paq.push(['trackContentInteractionNode', this, 'submittedForm']);
});
```

- The passed `domNode` can be any node within a content block or the content block element itself. Nothing will be tracked in case there is no content block found.
- Optionally you can set the name of the content interaction, for instance `click` or `submit`. If none is provided, the value `Unknown` will be used.
- You should disable the automatic interaction tracking of that content block by setting the CSS class `piwikContentIgnoreInteraction` or the attribute `data-content-ignoreinteraction`. Otherwise an interaction might be tracked on top of it as soon as a visitor performs a click.

We call this kind of tracking semi-automatic as you triggered the interaction manually but the content name, piece and target is detected automatically. Detecting the content name and piece automatically makes sure we can map the interaction with a previously tracked impression.

### Tracking content impressions and interactions manually
You should use the methods `trackContentImpression(contentName, contentPiece, contentTarget)` and `trackContentInteraction( contentInteraction, contentName, contentPiece, contentTarget)` only in conjunction together. It is not recommended to use `trackContentInteraction()` after an impression was tracked automatically as we can map an interaction to an impression only if you do set the same content name and piece that was used to track the related impression.

Example

```javascript
_paq.push(['trackContentImpression', 'Content Name', 'Content Piece', 'https://www.example.com']);

div.addEventListener('click', function () {
    _paq.push(['trackContentInteraction', 'tabActivated', 'Content Name', 'Content Piece', 'https://www.example.com']);
});
```

Be aware that each call to those methods will send one request to your Piwik tracker instance. Doing this too many times can cause performance problems.

## Measuring domains and/or sub-domains

Whether you are tracking one domain, or a subdomain, or both at the same time, etc. you may need to configure the Piwik JavaScript tracking code. There are two things that may need to be configured: 1) how tracking cookies are created and shared, and 2) which clicks should be tracked as 'Outlinks'.

### Tracking one domain

This is the standard use case. Piwik tracks the visits of one domain name with no subdomain, in a single Piwik website.

```javascript
// Default Tracking code
_paq.push(['setSiteId', 1]);
_paq.push(['setTrackerUrl', u+'matomo.php']);
_paq.push(['trackPageView']);
```

If you are tracking one specific subdomain, this default tracking code also works.

### Tracking one domain and its subdomains in the same website

To record users across the main domain name and any of its subdomains, we tell Piwik to share the cookies across all subdomains. `setCookieDomain()` is called in the Piwik tracking code in example.com/* and all subdomains.

```javascript
_paq.push(['setSiteId', 1]);
_paq.push(['setTrackerUrl', u+'matomo.php']);

// Share the tracking cookie across example.com, www.example.com, subdomain.example.com, ...
_paq.push(['setCookieDomain', '*.example.com']);

// Tell Piwik the website domain so that clicks on these domains are not tracked as 'Outlinks'
_paq.push(['setDomains', '*.example.com']);

_paq.push(['trackPageView']);
```
### Tracking your visitors across multiple domain names in the same website

To accurately track a visitor across different domain names into a single visit within one Piwik website, we need to set up what is called Cross Domain linking. Cross domain tracking in Piwik makes sure that when the visitor visits multiple websites and domain names, the visitor data will be stored in the same visit and that the visitor ID is reused across domain names. A typical use case where cross domain is needed is, for example, when an ecommerce online store is on `www.awesome-shop.com` and the ecommerce shopping cart technology is on another domain such as `secure.cart.com`.

Cross domain linking uses a combination of the two tracker methods `setDomains` and `enableCrossDomainLinking`. Learn how to set up cross-domain linking in our guide: [How do I accurately measure a same visitor across multiple domain names (cross domain linking)?](https://matomo.org/faq/how-to/faq_23654/)


### Tracking subdirectories of a domain in separate websites

When tracking subdirectories of a domain in their own separate Piwik website, it is recommended to customise the tracking code to ensure optimal data accuracy and performance.

For example, if your website offers a 'User profile' functionality, you may wish to track each user profile pages in a separate website in Piwik. In the main domain homepage, you would use the default tracking code:

```javascript
// idSite = X for the Homepage
// In Administration > Websites for idSite=X, the URL is set to `example.com/`
_paq.push(['setSiteId', X]);
_paq.push(['setTrackerUrl', u+'matomo.php']);
_paq.push(['trackPageView']);
```

In the `example.com/user/MyUsername` page (and in every other user profile), you would construct calls to custom `setSiteId`, `setCookiePath` and `setDomains`:

```javascript
// The idSite Y will be different from other user pages
// In Administration > Websites for idSite=Y, the URL is set to `example.com/user/MyUsername`
_paq.push(['setSiteId', Y]);

// Create the tracking cookie specifically in `example.com/user/MyUsername`
_paq.push(['setCookiePath', '/user/MyUsername']);

// Tell Piwik the website domain so that clicks on other pages (eg. /user/AnotherUsername) will be tracked as 'Outlinks'
_paq.push(['setDomains', 'example.com/user/MyUsername']);

_paq.push(['setTrackerUrl', u+'matomo.php']);
_paq.push(['trackPageView']);
```

When tracking many subdirectories in separate websites, the function `setCookiePath` prevents the number of cookies to quickly increase and prevent browser from deleting some of the cookies. This ensures optimal data accuracy and improves performance for your users (fewer cookies are sent with each request).

The function`setDomains` ensures that clicks of users leaving your website (subdirectory `example.com/user/MyUsername`) are correctly tracked as 'Outlinks'.

### Tracking a group of pages in a separate website

*(available since Piwik 2.16.1)*

In some rare cases, you may want to track all pages matching a wildcard in a particular website, and track clicks on other pages (not matching the wildcard) as 'Outlinks'.

In the pages `/index_fr.htm` or `/index_en.htm` write:


```javascript
// clicks on links not starting with example.com/index will be tracked as 'Outlinks'
_paq.push(['setDomains', 'example.com/index*']);

// when using a wildcard *, we do not need to configure cookies with `setCookieDomain`
// or `setCookiePath` as cookies are correctly created in the main domain by default

_paq.push(['setTrackerUrl', u+'matomo.php']);
_paq.push(['trackPageView']);
```

Notes:

* the wildcard `*` is supported only when specified at the end of the string.
* since the wildcard can match several paths, calls to `setCookieDomain` or `setCookiePath` are omitted to ensure tracking cookie is correctly shared for all pages matching the wildcard.


For more information about tracking websites and subdomains in Piwik, see the FAQ: [How to configure Piwik to monitor several websites, domains and sub-domains](https://matomo.org/faq/new-to-piwik/#faq_104)

## Download and Outlink tracking

### Enabling Download & Outlink tracking

The default Piwik JavaScript tracker code automatically enables the download & outlink tracking automatically, which is done by calling the `enableLinkTracking` function:

```javascript

// Enable Download & Outlink tracking
_paq.push(['enableLinkTracking']);

```
It is recommended to add this line just after the first call to `trackPageView` or `trackEvent`.

### Outlinks are tracked automatically

By default all links to domains other than the current domain have click tracking enabled, and each click will be counted as an outlink. If you use multiple domains and subdomains, you may see clicks on your subdomains appearing in the *Pages > Outlinks* report.

### Tracking outlinks and ignore alias domains

If you only want clicks to external websites to appear in your outlinks report, you can use the function `setDomains()` to specify the list of alias domains or subdomains. Wildcard domains (*.example.org) are supported to let you easily ignore clicks to all subdomains.

```javascript
// Don't track Outlinks on all clicks pointing to *.hostname1.com or *.hostname2.com
// Note: the currently tracked website is added to this array automatically
_paq(['setDomains', ["*.hostname1.com", "hostname2.com"]]);

_paq.push(['trackPageView']);
```

Since Piwik 2.15.1 you may also append a path to a domain and Piwik will correctly detect links to the same domain but different path as an outlink.

```javascript
// Don't track Outlinks on all clicks pointing to *.hostname1.com/product1/* or *.hostname2.com/product1/*
// Track all clicks not pointing to *.hostname1.com/product1/* or *.hostname2.com/product1/* as outlink.
_paq(['setDomains', ["*.hostname1.com/product1", "hostname2.com/product1"]]);
```

Learn more about this use case [Tracking subdirectories of a domain in separate websites](#tracking-subdirectories-of-a-domain-in-separate-websites).

### Tracking a click as an outlink via CSS or JavaScript

If you want to force Piwik to consider a link as an outlink (links to the current domain or to one of the alias domains), you can add the 'piwik_link' css class to the link:

```html
<a href='https://mysite.com/partner/' class='piwik_link'>Link I want to track as an outlink</a>
```

Note: you can customize and rename the CSS class used to force a click to be recorded as an outlink:

```javascript
// now all clicks on links with the css class "external" will be counted as outlinks

// you can also pass an array of strings
_paq.push(['setLinkClasses', "external"]);

_paq.push(['trackPageView']);
```

Alternatively, you can use JavaScript to manually trigger a click on an outlink (it will work the same for page views or file downloads). In this example, custom outlink is trigged when the email address is clicked:

```html
<a href="mailto:namexyz@mydomain.co.uk" target="_blank" onClick="_paq.push(['trackLink', 'https://mydomain.co.uk/mailto/Agent namexyz', 'link']);">namexyz@mydomain.co.uk </a>
```

### Tracking file downloads

By default, any file ending with one of these extensions will be considered a 'download' in the Piwik interface:

```
7z|aac|arc|arj|apk|asf|asx|avi|bin|bz|bz2|csv|deb|dmg|doc|
exe|flv|gif|gz|gzip|hqx|jar|jpg|jpeg|js|mp2|mp3|mp4|mpg|
mpeg|mov|movie|msi|msp|odb|odf|odg|odp|ods|odt|ogg|ogv|
pdf|phps|png|ppt|qt|qtm|ra|ram|rar|rpm|sea|sit|tar|
tbz|tbz2|tgz|torrent|txt|wav|wma|wmv|wpd||xls|xml|z|zip
```

### Customise the type of files tracked as downloaded

To replace the list of extensions you want to track as file downloads, you can use `setDownloadExtensions( string )`:

```javascript
// we now only track clicks on images
_paq.push(['setDownloadExtensions', "jpg|png|gif"]);

_paq.push(['trackPageView']);
```

If you want to track a new file type, you can just add it to the list by using `addDownloadExtensions( filetype )`:

```javascript
// clicks on URLs finishing by mp5 or mp6 will be counted as downloads
_paq.push(['addDownloadExtensions', "mp5|mp6"]);
_paq.push(['trackPageView']);
```

If you want to ignore a special file type, you can just remove it from the list by using `removeDownloadExtensions( filetype )`:

``javascript
// clicks on URLs finishing by png or mp4 will not be counted as downloads
_paq.push(['removeDownloadExtensions', "png|mp4"]);
_paq.push(['trackPageView']);
```


### Recording a click as a download

If you want to force Piwik to consider a link as a download, you can add the `matomo_download` or `piwik_download` css class to the link:

```html
<a href='last.php' class='matomo_download'>Link I want to track as a download</a>
```

Note: you can customize and rename the CSS class used to force a click to be recorded as a download:

```javascript
// now all clicks on links with the css class "download" will be counted as downloads

// you can also pass an array of strings
_paq.push(['setDownloadClasses', "download"]);

_paq.push(['trackPageView']);
```

Alternatively, you can use JavaScript to manually trigger a click on a download. In this example, custom download is trigged when the link is clicked:

```html
<a href="https://secure.example.com/this-is-a-file-url" target="_blank" onClick="_paq.push(['trackLink', 'https://mydomain.co.uk/mailto/Agent namexyz', 'download']);">Download</a>
```

### Changing the Pause Timer

When a user clicks to download a file, or clicks on an outbound link, Piwik records it. In order to do so, it adds a small delay before the user is redirected to the requested file or link. The default value is 500ms, but you can set it to a shorter length of time. It should be noted, however, that doing so results in the risk that this period of time is not long enough for the data to be recorded in Piwik.

```javascript
_paq.push(['setLinkTrackingTimer', 250]); // 250 milliseconds

_paq.push(['trackPageView']);
```


### Disabling Download & Outlink tracking

By default, the Piwik tracking code enables clicks and download tracking. To disable all automatic download and outlink tracking, you must remove the call to the `enableLinkTracking()` function:

```javascript
_paq.push(['trackPageView']);

// we comment out the function that enables link tracking
// _paq.push(['enableLinkTracking']);
```

#### Disabling for specific CSS classes

You can disable automatic download and outlink tracking for links with specific CSS classes:

```javascript
 // you can also pass an array of strings
_paq.push(['setIgnoreClasses', "no-tracking"]);
_paq.push(['trackPageView']);
```

This will result in clicks on a link `<a href='https://example.com' class='no-tracking'>Test</a>` not being counted.

#### Disabling for a specific link

If you want to ignore download or outlink tracking on a specific link, you can add the `matomo_ignore` or 'piwik_ignore' css class to it:

```html
<a href='https://builds.matomo.org/latest.zip' class='matomo_ignore'>File I don't want to track as a download</a>
```

## Asking for consent

[View our integration guide for implementing tracking or cookie consent.](/guides/tracking-consent)

## Optional: creating a custom opt-out form

If you'd like to provide your users with the ability to opt-out entirely from tracking, you can use an opt-out form. Matomo ships with an
opt-out form implementation that uses third-party cookies (which you can configure within Matomo on the _Matomo > Administration > Privacy_ page).

This form is simple to embed since it only requires that you add an iframe to your website, but it is not always ideal. Some users block third-party
cookies so the opt-out form wouldn't work for them. You may also want to display custom text or graphics in the opt-out form, or you may
want to allow users to opt-out of your sites individually instead of altogether.

In such a case, you may want to consider creating a custom opt-out form. The specifics of creating an HTML/JS form are out of scope for
this document, but there are some things every custom opt-out form will have to do: **check if the user is currently opted out**,
**opt a user out** and **opt a user in**. Here is how to do those things:

**check if the user is currently opted out**

Use the `isUserOptedOut()` method like so:

```js
_paq.push([function () {
  if (this.isUserOptedOut()) {
    // ... change form to say user is currently opted out ...
  } else {
    // ... change form to say user is currently opted in ...
  }
}])
```

**opt a user out**

Use the `optUserOut()` method:

```js
_paq.push(['optUserOut']);
```

**opt a user in**

Use the `forgetUserOptOut()` method:

```js
_paq.push(['forgetUserOptOut']);
```

Below is an example opt-out form that replicates the built in Matomo opt-out form:

```html
<div id="optout-form">
  <p>You may choose not to have a unique web analytics cookie identification number assigned to your computer to avoid the aggregation and analysis of data collected on this website.</p>
  <p>To make that choice, please click below to receive an opt-out cookie.</p>

  <p>
    <input type="checkbox" id="optout" />
    <label for="optout"><strong></strong></label>
  </p>
</div>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
  function setOptOutText(element) {
    _paq.push([function() {
      element.checked = !this.isUserOptedOut();
      document.querySelector('label[for=optout] strong').innerText = this.isUserOptedOut()
        ? 'You are currently opted out. Click here to opt in.'
        : 'You are currently opted in. Click here to opt out.';
    }]);
  }

  var optOut = document.getElementById("optout");
  optOut.addEventListener("click", function() {
    if (this.checked) {
      _paq.push(['forgetUserOptOut']);
    } else {
      _paq.push(['optUserOut']);
    }
    setOptOutText(optOut);
  });
  setOptOutText(optOut);
});
</script>
```

## Multiple Piwik trackers

By default, the Piwik JavaScript Tracking code collects your analytics data into one Piwik server. The Piwik service URL is specified in your JavaScript Tracking code (for example: `var u="//matomo.example.org";`). In some cases, you may want to track your analytics data into more than just one Piwik server or into multiple websites on the same Piwik server.

*If you haven't upgraded yet to Piwik 2.16.2 or later, please upgrade now! (Instructions for 2.16.1 or older versions are found below.)*

### Duplicate your data into different websites in one Piwik server

You may need to collect a duplicate of your web analytics data into the same Piwik server, but in another website.

#### Recommended solution: use RollUp Reporting plugin

When you need to duplicate data into another website, or consolidate several websites into one or more groups (called RollUps) the recommended solution is to use the [RollUp Reporting premium plugin](https://plugins.matomo.org/RollUpReporting). Using this plugin has several advantages over the other solution as you can easily group one or more websites together, and the RollUps do not cause the tracking data to be duplicated which improves overall performance.

#### Alternative solution: duplicate the tracking data

Alternatively to using the RollUp Reporting plugin you can duplicate the tracking data. To duplicate the data you can call `addTracker` with a Piwik URL and your website ID where to duplicate the data:

```js
  var u="//matomo.example.org/";
  _paq.push(['setTrackerUrl', u+'matomo.php']);
  _paq.push(['setSiteId', '1']);

  // We will also collect the website data into Website ID = 7
  var websiteIdDuplicate = 7;
  // The data will be duplicated into `piwik.example.org/matomo.php`
  _paq.push(['addTracker', u+'matomo.php', websiteIdDuplicate]);
  // Your data is now tracked in both website ID 1 and website 7 into your piwik.example.org server!
```

As this solution causes every visitor's event, pageview, etc. to be tracked twice in your Piwik server, we generally do not recommend it.

### Collect your analytics data into two or more Piwik servers

The example below shows how to use `addTracker`  method to track the same analytics data into a second Piwik server. The main Piwik server is `piwik.example.org/matomo.php` where the data is stored into website ID `1`. The second Piwik server is `analytics.example.com/matomo.php` where the data is stored into website ID `77`. When you implement this in your website, please replace these two Matomo URLs and Matomo website IDs with your own Matomo URLs and website IDs.

```html
<script type="text/javascript">
  var _paq = window._paq = window._paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);

  (function() {
    var u="//matomo.example.org/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '1']);

    // Add this code below within the Piwik JavaScript tracker code
    // Important: the tracker url includes the /matomo.php
    var secondaryTrackerUrl = 'https://analytics.example.com/matomo.php';
    var secondaryWebsiteId = 77;
    // Also send all of the tracking data to this other Piwik server, in website ID 77
    _paq.push(['addTracker', secondaryTrackerUrl, secondaryWebsiteId]);
    // That's it!

    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
```

### Customise one of the tracker object instances

Note: by default any tracker added via `addTracker` is configured the same as the main default tracker object (regarding cookies, custom dimensions, user id, download & link tracking, domains and sub-domains, etc.). If you want to configure one of the Piwik tracker object instances that was added via `addTracker`, you may call the `Matomo.getAsyncTracker(optionalMatomoUrl, optionalPiwikSiteId)`  method. This method returns the tracker instance object which you can configure differently than the main JavaScript tracker object instance.

### Duplicate the tracking data when calling the JavaScript API directly (not via `_paq.push`)

It is possible to track your analytics data into either a different website ID on the same server or you may record a copy of your data into another Piwik server altogether. Each call to `Piwik.getTracker()` returns a unique Piwik Tracker object (instance) which can be configured.

```html
<script type="text/javascript">
    window.matomoAsyncInit = function () {
        try {
            var matomoTracker = Matomo.getTracker("https://URL_1/matomo.php", 1);
            matomoTracker.trackPageView();
            var piwik2 = Matomo.getTracker("https://URL_2/matomo.php", 4);
            piwik2.trackPageView();
        } catch( err ) {}
    };
</script>
```

The `matomoAsyncInit()` method will be executed once the Piwik tracker is loaded and initialized. In earlier versions you must load Piwik synchronous.


## JavaScript Tracker Reference

View all features of the Tracking client in the [JavaScript Tracker Reference](/guides/tracking-javascript).

## Frequently Asked Questions

If you have any question about JavaScript Tracking in Piwik, [please search the website](https://matomo.org/), or [ask in the forums](https://forum.matomo.org).

- [How do I enable tracking for users without JavaScript?](https://matomo.org/faq/how-to/faq_176/)
- [How does Piwik track downloads?](https://matomo.org/faq/new-to-piwik/faq_47/)
- [How to track single-page websites and web applications](https://matomo.org/blog/2017/02/how-to-track-single-page-websites-using-piwik-analytics/)
- [How to track error pages and get the list of 404 and referrers urls.](https://matomo.org/faq/how-to/faq_60/)
- [How can I set custom groups of pages (structure) so that page view are aggregated by categories?](https://matomo.org/faq/how-to/faq_62/)
- [How do I set up Piwik to track multiple websites without revealing the Piwik server URL footprint in JS?](https://matomo.org/faq/how-to/faq_132/)
- [How do I customise the matomo.js being loaded on all my websites?](https://matomo.org/faq/how-to/faq_19087/)
- [How do I disable all tracking cookies used by Piwik in the javascript code?](https://matomo.org/faq/general/faq_157/)

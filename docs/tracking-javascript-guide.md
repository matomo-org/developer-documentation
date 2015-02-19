---
category: Integrate
---
# JavaScript Tracking Client

You can use the Javascript tracking client to track any application that supports Javascript: for example websites!

This guide will explain how you can use the Javascript tracking client to customize the way some of the web analytics data is recorded in Piwik.

## Finding the Piwik Tracking Code

To use all the features described in this page, you need to use the latest version of the tracking code. To find the tracking code for your website, follow the steps below:

- log in to Piwik with your admin or Super User account
- click on your username in the top right menu, and click *Settings* to access the administration area
- click on *Tracking Code* in the left menu
- copy and paste the Javascript tracking code into your pages, just after the `<body>` tag

The tracking code looks as follows:

```html
<!-- Piwik -->
<script type="text/javascript">
    var _paq = _paq || [];
    (function(){ var u=(("https:" == document.location.protocol) ? "https://{$PIWIK_URL}/" : "http://{$PIWIK_URL}/");
    _paq.push(['setSiteId', {$IDSITE}]);
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript'; g.defer=true; g.async=true; g.src=u+'piwik.js';
    s.parentNode.insertBefore(g,s); })();
</script>
<!-- End Piwik Code -->
```

In your tracking code, `{$PIWIK_URL}` would be replaced by your Piwik URL and `{$IDSITE}` would be replaced by the idsite of the website you are tracking in Piwik.

This code might look a bit strange to those of you familiar with JavaScript, but that is because it is made to run asynchronously. In other words, browsers will not wait for the `piwik.js` file to be downloaded in order to show your page.

For asynchronous tracking, configuration and tracking calls are pushed onto the global `_paq` array for execution, independent of the asynchronous loading of `piwik.js`. The format is:

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

You can push to the `_paq` array even after the `piwik.js` file has been loaded and run.

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

By default, Piwik tracks page views when the Javascript tracking code loads and executes on each page view.

However, on modern web applications, user interactions do not necessarily involve loading a new page. For example, when users click on a JavaScript link, or when they click on a tab (which triggers a JS event), or when they interact with elements of the user interface, you can still track these interactions with Piwik.

To track any user interaction or click with Piwik, you can manually call the Javascript function `trackEvent()`. For example, if you wanted to track a click on a JavaScript menu, you could write:

```html
<a href="#" onclick="javascript:_paq.push(['trackEvent', 'Menu', 'Freedom']);">Freedom page</a>
```

You can learn more about [Tracking Events](http://piwik.org/docs/event-tracking/#tracking-events) in the user guide.

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

Find more information about goal tracking in Piwik in the [**Tracking Goals**](http://piwik.org/docs/tracking-goals-web-analytics/) documentation.

## Ecommerce tracking

Piwik allows for advanced and powerful Ecommerce tracking. Check out the [Ecommerce Analytics](http://piwik.org/docs/ecommerce-analytics/) documentation for more information about Ecommerce reports and how to set up Ecommerce tracking.

## Internal search tracking

Piwik offers advanced [Site Search Analytics](http://piwik.org/docs/site-search/) feature, letting you track how your visitors use your internal website search engine. By default, Piwik can read URL parameters that will contain the search keyword. However, you can also record the site search keyword manually using the Javascript function `trackSiteSearch(...)`

In your website, in standard pages, you would typically have a call to record Page views via `piwikTracker.trackPageView()`. On your search result page, you would call **instead** `piwikTracker.trackSiteSearch(keyword, category, searchCount)` function to record the internal search request. Note: the 'keyword' parameter is required, but category and searchCount are optional.

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

We also highly recommend to set the searchCount parameter, as Piwik will specifically report "No Result Keywords", ie. Keywords that were searched, but did not return any result. It is usually very interesting to know what users search for but can't find (yet?) on your website. Learn more about [Site Search Analytics in the User Doc](http://piwik.org/docs/site-search/).

## Custom variables

Custom variables are a powerful feature that enable you to track custom values for each visit, and/or each page view. Please see the [Tracking custom variables](http://piwik.org/docs/custom-variables/) documentation page for general information.

You can se tup up to 5 custom variables (name and value) for each visit to your website, and/or up to 5 custom variables for each page view. If you set a custom variable to a visitor, when he comes back 1 hour or 2 days later, it will be a new visit and his/her custom variables will be empty.

There are two "scopes" which you can set your custom variables to. The "scope" is the 4th parameter of the function `setCustomVariable()`.

- when scope = "visit", the custom variable's name and value will be stored in the visit in the database. You can therefore store up to 5 custom variables of scope "visit" for each visit.
- when scope = "page", the custom variable's name and value will be stored for the page view being tracked. You can therefore store up to 5 custom variables of scope "page" for each page view.

Custom variable statistics are reported in Piwik under **Visitors &gt; custom variables**. Both custom variables of scope "visit" and "page" are aggregated in this report.

### Custom variables for visits

```javascript
setCustomVariable(index, name, value, scope = "visit")
```

This function is used to create, or update a custom variable name and value. For example, imagine you want to store in each visit the gender of the user. Yow would store the custom variable with a name = "gender", value = "male" or "female".

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

Note: it is possible to configure Piwik so that `getCustomVariable` will also return the name and value of a custom variable of scope "visit", even when it was set in a previous pageview in the same visit. To enable this behavior, call the Javascript function `storeCustomVariablesInCookie` before the call to `trackPageView`. This will enable the storage of Custom Variables of scope "visit" in a first party cookie. The custom variables cookie will be valid for the duration of the visit (30 minutes after the last action). You can then retrieve the custom variable names and values using `getCustomVariable`. If there is no custom variable in the requested index, it will return false.

```javascript
_paq.push([ function() {

    var customVariable = this.getCustomVariable( 1, "visit" );
    // Returns the custom variable: [ "gender", "male" ]

    // do something with customVariable...

}]);

_paq.push(['trackPageView']);
```

## User ID

[User ID](http://piwik.org/docs/user-id/) is a feature in Piwik that lets you connect together a given user's data collected from multiple devices and multiple browsers. There are two steps to implementing User ID:

- You must assign a unique and persistent non empty string that represents each logged-in user. Typically this ID will be an email address or a username provided by your authentication system.
- You must then pass this User ID string to Piwik via the `setUserId` method call just before calling track* function, for example:

```javascript
_paq.push(['setUserId', 'USER_ID_HERE']);
_paq.push(['trackPageView']);
```

Note: `USER_ID_HERE` must be a unique and persistent non empty string that represents a user across devices.

Let's take an example. Imagine that your website authenticate your users via a login form using a PHP script. Here is what your Piwik JavaScript snippet may look like:

```javascript
var _paq = _paq || [];

<?php
// If used is logged-in then call 'setUserId' 
// $userId variable must be set by the server when the user has successfully authenticated to your app.
if (isset($userId)) {
     echo sprintf("_paq.push(['setUserId', '%s']);", $userId);
}
?>

_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
```


## Content Tracking

There are several ways to track content impressions and interactions manually, semi-automatically and automatically. Please be aware that content impressions will be tracked using bulk tracking which will always send a `POST` request, even if `GET` is configured which is the default. For more details have a look at the [in-depth guide to Content Tracking](http://developer.piwik.org/guides/content-tracking).

### Track all content impressions within a page

You can use the method `trackAllContentImpressions()` to scan the entire DOM for content blocks. For each content block we will track a content impression immediately. If you only want to track visible content impression have a look at `trackVisibleContentImpressions()`.

```javascript
_paq.push(['trackPageView']);
_paq.push(['trackAllContentImpressions']);
```

We won't send an impression of the same content block twice if you call this method multiple times unless `trackPageView()` is called meanwhile. This is useful for single page applications. 

### Track only visible content impressions within a page.

Enable to track only visible content impressions via `trackVisibleContentImpressions(checkOnSroll, timeIntervalInMs)`. With visible we mean the content block has been in the view port and is not hidden (opacity, visibility, display, ...).

- Optionally you can tell us to not rescan the DOM after each scroll by passing `checkOnSroll=false`. Otherwise we will check whether the previously hidden content blocks became visible meanwhile after a scroll and if so track the impression.
  * Limitation: If a content block is placed within a scrollable element (`overflow: scroll`), we do currently not detect when such an element becomes visible.
- Optionally you can tell us to rescan the entire DOM for new content impressions every X milliseconds by passing `timeIntervalInMs=500`. By default we will rescan the DOM every 750ms. To disable it pass `timeIntervalInMs=0`.
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
You should use the methods `trackContentImpression(contentName, contentPiece, contentTarget)` and `trackContentInteraction(contentName, contentPiece, contentInteraction)` only in conjunction together. It is not recommended to use `trackContentInteraction()` after an impression was tracked automatically as we can map an interaction to an impression only if you do set the same content name and piece that was used to track the related impression.

Example

```javascript
_paq.push(['trackContentImpression', 'Content Name', 'Content Piece', 'http://www.example.com']);

div.addEventListener('click', function () {
    _paq.push(['trackContentInteraction', 'tabActivated', 'Content Name', 'Content Piece', 'http://www.example.com']);
});
```

Be aware that each call to those methods will send one request to your Piwik tracker instance. Doing this too many times can cause performance problems.

## Cookie configuration

Piwik uses first-party cookies to keep track some information (number of visits, original referrer, and unique visitor ID). First-party cookies ensure higher user privacy (since cookies are not sent to a third-party server), and are therefore accepted in most browsers by default.

Piwik creates a set of cookies for each domain and subdomain. If you want to track some subdomains and share the same cookie for accurate statistics, it is necessary to customize the Piwik Tracking code.

### Tracking one domain

This is the standard use case. Piwik tracks the visits of one domain name with no subdomain, in a single Piwik website.

```javascript
// Default Tracking code
_paq.push(['setSiteId', 1]);
_paq.push(['setTrackerUrl', u+'piwik.php']);
_paq.push(['trackPageView']);
```

### Tracking subdomains in the same website

If you want to record visits for the main domain name as well as its subdomains, you would want to share cookies across all domains. You can do so by calling `setCookieDomain()`, in all subdomains tracking codes.

```javascript
_paq.push(['setSiteId', 1]);
_paq.push(['setTrackerUrl', u+'piwik.php']);

// Same cookie as: example.com, www.example.com, subdomain.example.com, ...
_paq.push(['setCookieDomain', '*.example.com']);
_paq.push(['setDomains', '*.example.com']); // Download & Click tracking alias domains

_paq.push(['trackPageView']);
```

### Tracking subdirectories or pages as different websites

By default, Piwik uses only one cookie for a domain name, and all its pages and subdirectories.

There may be cases where you track a subdirectory as a separate website in Piwik. If a visitor visits more than a few subdirectories, this will cause some inaccuracy in your reports: time on site, number of visits, conversion referrer, returning and new visitors. In this use case, you can ensure your reports stay accurate by creating a different cookie for each subpath you are tracking in different Piwik websites. The function `setCookiePath()` is used to set the Cookie path.

For example, if your website has user profiles, you could track each user profile page analytics as a unique website in Piwik. In the main domain homepage, you would use the default tracking code.

```javascript
// idSite = X for the Homepage
_paq.push(['setSiteId', X]);

_paq.push(['setTrackerUrl', u+'piwik.php']);
_paq.push(['trackPageView']);
```

In the `/user/myusername` page, you would write:

```javascript
// The idSite Y will be different from other user pages
_paq.push(['setSiteId', Y]);
_paq.push(['setCookiePath', '/user/MyUsername']);

_paq.push(['setTrackerUrl', u+'piwik.php']);
_paq.push(['trackPageView']);
```

For more information about tracking websites and subdomains in Piwik, see the FAQ: [How to configure Piwik to monitor several websites, domains and sub-domains](http://piwik.org/faq/new-to-piwik/#faq_104)

## Download & Outlink tracking

### Outlink tracking exclusions

By default all links to domains other than the current domain have click tracking enabled, and each click will be counted as an outlink. If you use multiple domains and subdomains, you may see clicks on your subdomains appearing in the *Pages > Outlinks* report.

If you only want clicks to external websites to appear in your outlinks report, you can use the function `setDomains()` to specify the list of alias domains or subdomains. Wildcard domains (*.example.org) are supported to let you easily ignore clicks to all subdomains.

```javascript
// Don't track Outlinks on all clicks pointing to *.hostname1.com or *.hostname2.com
// Note: the currently tracked website is added to this array automatically
_paq(['setDomains', ["*.hostname1.com", "hostname2.com"]]);

_paq.push(['trackPageView']);
```

### Disabling Download & Outlink tracking

By default, the Piwik tracking code enables clicks and download tracking. To disable all automatic download and outlink tracking, you must remove the call to the `enableLinkTracking()` function:

```javascript
// we comment out the function that enables link tracking
// _paq.push(['enableLinkTracking']);
_paq.push(['trackPageView']);
```

#### Disabling for specific CSS classes

You can disable automatic download and outlink tracking for links with specific CSS classes:

```javascript
 // you can also pass an array of strings
_paq.push(['setIgnoreClasses', "no-tracking"]);
_paq.push(['trackPageView']);
```

This will result in clicks on a link `<a href='http://example.com' class='no-tracking'>Test</a>` not being counted.

#### Disabling for a specific link

If you want to ignore download or outlink tracking on a specific link, you can add the 'piwik_ignore' css class to it:

```html
<a href='http://builds.piwik.org/latest.zip' class='piwik_ignore'>File I don't want to track as a download</a>
```

### Recording a click as a download

If you want to force Piwik to consider a link as a download, you can add the 'piwik_download' css class to the link:

```html
<a href='last.php' class='piwik_download'>Link I want to track as a download</a>
```

Note: you can customize and rename the CSS class used to force a click to be recorded as a download:

```javascript
// now all clicks on links with the css class "download" will be counted as downloads

// you can also pass an array of strings
_paq.push(['setDownloadClasses', "download"]);

_paq.push(['trackPageView']);
```

### Recording a click as an outlink

If you want to force Piwik to consider a link as an outlink (links to the current domain or to one of the alias domains), you can add the 'piwik_link' css class to the link:

```html
<a href='http://mysite.com/partner/' class='piwik_link'>Link I want to track as an outlink</a>
```

Note: you can customize and rename the CSS class used to force a click to being recorded as an outlink:

```javascript
// now all clicks on links with the css class "external" will be counted as outlinks

// you can also pass an array of strings
_paq.push(['setLinkClasses', "external"]);

_paq.push(['trackPageView']);
```

Alternatively, you can use JavaScript to manually trigger a click on an outlink (it will work the same for page views or file downloads). In this example, custom outlink is trigged when the email address is clicked:

```html
<a href="mailto:namexyz@mydomain.co.uk" target="_blank" onClick="javascript:_paq.push(['trackLink', 'http://mydomain.co.uk/mailto/Agent namexyz', 'link']);">namexyz@mydomain.co.uk </a>
```

### Changing the Pause Timer

When a user clicks to download a file, or clicks on an outbound link, Piwik records it. In order to do so, it adds a small delay before the user is redirected to the requested file or link. The default value is 500ms, but you can set it to a shorter length of time. It should be noted, however, that doing so results in the risk that this period of time is not long enough for the data to be recorded in Piwik.

```javascript
_paq.push(['setLinkTrackingTimer', 250]); // 250 milliseconds

_paq.push(['trackPageView']);
```

### File extensions for tracking downloads

By default, any file ending with one of these extensions will be considered a 'download' in the Piwik interface:

```
7z|aac|arc|arj|apk|asf|asx|avi|bin|bz|bz2|csv|deb|dmg|doc|
exe|flv|gif|gz|gzip|hqx|jar|jpg|jpeg|js|mp2|mp3|mp4|mpg|
mpeg|mov|movie|msi|msp|odb|odf|odg|odp|ods|odt|ogg|ogv|
pdf|phps|png|ppt|qt|qtm|ra|ram|rar|rpm|sea|sit|tar|
tbz|tbz2|tgz|torrent|txt|wav|wma|wmv|wpd||xls|xml|z|zip
```

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

## Multiple Piwik trackers

It is possible to track a page using multiple Piwik trackers that point to the same or different Piwik servers. To improve page loading time, you can load `piwik.js` once. Each call to `Piwik.getTracker()` returns a unique Piwik Tracker object (instance) which can be configured.

```html
<script type="text/javascript">
    window.piwikAsyncInit = function () {
        try {
            var piwikTracker = Piwik.getTracker("http://URL_1/piwik.php", 1);
            piwikTracker.trackPageView();
            var piwik2 = Piwik.getTracker("http://URL_2/piwik.php", 4);
            piwik2.trackPageView();
        } catch( err ) {}
    };
</script>
```

The `piwikAsyncInit()` method was introduced in Piwik 2.3 and will be executed once the Piwik tracker is loaded and initialized. In earlier versions you must load Piwik synchronous.

Note that you can also set the website ID and the Piwik tracker URL manually, instead of setting them in the getTracker call:

```javascript
// we replace Piwik.getTracker("http://example.com/piwik/", 12)
var piwikTracker = Piwik.getTracker();
piwikTracker.setSiteId( 12 );
piwikTracker.setTrackerUrl( "http://example.com/piwik/" );
piwikTracker.trackPageView();
```


## Frequently Asked Questions

If you have any question about JavaScript Tracking in Piwik, [please search the website](http://piwik.org/search/), or [ask in the forums](http://forum.piwik.org).

- [How do enable tracking for users without Javascript?](http://piwik.org/faq/how-to/#faq_176)
- [How does Piwik track downloads?](http://piwik.org/faq/new-to-piwik/#faq_47)
- [How to track error pages and get the list of 404 and referrers urls.](http://piwik.org/faq/how-to/#faq_60)
- [How can I set custom groups of pages (structure) so that page view are aggregated by categories?](http://piwik.org/faq/how-to/#faq_62)
- [How do I setup Piwik to track multiple websites without revealing the Piwik server URL footprint in JS?](http://piwik.org/faq/how-to/#faq_132)
- [How do I customise the piwik.js being loaded on all my websites?](http://piwik.org/faq/how-to/faq_19087/)
- [How do I disable all tracking cookies used by Piwik in the javascript code?](http://piwik.org/faq/general/#faq_157)

---
category: API Reference
---
# JavaScript Tracking Client

## User guide

Read also the **[Javascript Tracking Client](/guides/tracking-javascript-guide)** user guide to get familiar with the Javascript tracking client.

## List of all Methods Available in the Tracking API

### Requesting the Tracker Instance from the Piwik Class

*   `Piwik.getTracker( trackerUrl, siteId )` - get a new instance of the Tracker
*   `Piwik.getAsyncTracker()` - get the internal instance of the Tracker used for asynchronous tracking

### Using the Tracker Object

*   `trackEvent(category, action, [name], [value])` - Logs an event with an event category (Videos, Music, Games...), an event action (Play, Pause, Duration, Add Playlist, Downloaded, Clicked...), and an optional event name and optional numeric value.
*   `trackPageView([customTitle])` - Logs a visit to this page
*   `trackSiteSearch(keyword, [category], [resultsCount])` - Log an internal site search for a specific keyword, in an optional category, specifying the optional count of search results in the page.
*   `trackGoal( idGoal, [customRevenue]);` - Manually log a conversion for the numeric goal ID, with an optional numeric custom revenue customRevenue.
*   `trackLink( url, linkType )` - Manually log a click from your own code. url is the full URL which is to be tracked as a click. linkType can either be 'link' for an outlink or 'download' for a download.
*   `trackAllContentImpressions()` - Scans the entire DOM for all content blocks and tracks all impressions once the DOM ready event has been triggered.
*   `trackVisibleContentImpressions ( checkOnSroll, timeIntervalInMs )` - Scans the entire DOM for all content blocks as soon as the page is loaded. It tracks an impression only if a content block is actually visible.
*   `trackContentImpressionsWithinNode( domNode )` - Scans the given DOM node and its children for content blocks and tracks an impression for them if no impression was already tracked for it.
*   `trackContentInteractionNode( domNode, contentInteraction )` - Tracks an interaction with the given DOM node / content block.
*   `trackContentImpression( contentName, contentPiece, contentTarget )` - Tracks a content impression using the specified values. 
*   `trackContentInteraction( contentInteraction, contentName, contentPiece, contentTarget )` - Tracks a content interaction using the specified values.
*   `logAllContentBlocksOnPage` - Log all found content blocks within a page to the console. This is useful to debug / test content tracking.
*   `enableLinkTracking( enable )` - Install link tracking on all applicable link elements. Set the enable parameter to true to use pseudo click-handler (treat middle click and open contextmenu as left click). A right click (or any click that opens the context menu) on a link will be tracked as clicked even if "Open in new tab" is not selected. If "false" (default), nothing will be tracked on open context menu or middle click. 
*   `enableHeartBeatTimer( delayInSeconds )` - Install a Heart beat timer that will regularly send requests to Piwik in order to better measure the time spent on the page. These requests will be sent only when the user is actively viewing the page (when the tab is active and in focus). These requests will not track additional actions or pageviews. By default, `delayInSeconds` is set to 15 seconds. 

### Configuration of the Tracker Object

*   `setDocumentTitle( string )` - Override document.title
*   `setDomains( array)` - Set array of hostnames or domains to be treated as local. For wildcard subdomains, you can use: `setDomains('.example.com');` or `setDomains('*.example.com');`. You can also specify a path along a domain: `setDomains('*.example.com/subsite1');`
*   `setCustomUrl( string )` - Override the page's reported URL
*   `setReferrerUrl( string )` - Override the detected Http-Referer
*   `setSiteId( integer )` - Specify the website ID. Redundant: can be specified in `getTracker()` constructor.
*   `setApiUrl( string )` - Specify the Piwik HTTP API URL endpoint. Points to the root directory of piwik, e.g. http://piwik.example.org/ or https://example.org/piwik/. This function is only useful when the 'Overlay' report is not working. By default you do not need to use this function.
*   `setTrackerUrl( string )` - Specify the Piwik server URL. Redundant: can be specified in `getTracker()` constructor.
*   `setDownloadClasses( string | array )` - Set classes to be treated as downloads (in addition to piwik_download)
*   `setDownloadExtensions( string | array )` - Set list of file extensions to be recognized as downloads. Example: 'doc' or ['doc', 'xls']
*   `addDownloadExtensions( string | array )` - Specify additional file extensions to be recognized as downloads. Example: 'doc' or ['doc', 'xls']
*   `removeDownloadExtensions( string | array )` - Specify file extensions to be removed from the list of download file extensions. Example: 'doc' or ['doc', 'xls']
*   `setIgnoreClasses( string | array )` - Set classes to be ignored if present in link (in addition to piwik_ignore)
*   `setLinkClasses( string | array )` - Set classes to be treated as outlinks (in addition to piwik_link)
*   `setLinkTrackingTimer( integer )` - Set delay for link tracking in milliseconds.
*   `discardHashTag( bool )` - Set to true to not record the hash tag (anchor) portion of URLs
*   `setGenerationTimeMs(generationTime)` - By default Piwik uses the browser DOM Timing API to accurately determine the time it takes to generate and download the page. You may overwrite the value by specifying a milliseconds value here.
*   `appendToTrackingUrl(appendToUrl)` - Appends a custom string to the end of the HTTP request to piwik.php?
*   `setDoNotTrack( bool )` - Set to true to not track users who opt out of tracking using Mozilla's (proposed) Do Not Track setting.
*   `disableCookies()` - Disables all first party cookies. Existing Piwik cookies for this websites will be deleted on the next page view.
*   `deleteCookies()` - Deletes the tracking cookies currently currently set (this is useful when [creating new visits](http://piwik.org/faq/how-to/#faq_187))
*   `killFrame()` - Enables a frame-buster to prevent the tracked web page from being framed/iframed.
*   `redirectFile( url )` - Forces the browser load the live URL if the tracked web page is loaded from a local file (e.g., saved to someone's desktop).
*   `setHeartBeatTimer( minimumVisitLength, heartBeatDelay )` - records how long the page has been viewed if the minimumVisitLength (in seconds) is attained; the heartBeatDelay determines how frequently to update the server
*   `getVisitorId()` - returns the 16 characters ID for the visitor
*   `getVisitorInfo()` - returns the visitor cookie contents in an array
*   `getAttributionInfo()` - returns the visitor attribution array (Referer information and / or Campaign name &amp; keyword).
    Attribution information is used by Piwik to credit the correct referrer ([first or last referrer](http://piwik.org/faq/general/#faq_106)) used when a user triggers a goal conversion.

    You can also use any of the following functions to get specific attributes of data:

    *   `piwikTracker.getAttributionCampaignName()`
    *   `piwikTracker.getAttributionCampaignKeyword()`
    *   `piwikTracker.getAttributionReferrerTimestamp()`
    *   `piwikTracker.getAttributionReferrerUrl()`

*   `getUserId()` - returns the User ID string if it was set.
*   `setUserId( userId )` -  Sets a [User ID](http://piwik.org/docs/user-id/) to this user (such as an email address or a username).
*   `setCustomVariable (index, name, value, scope)` - Set a custom variable.
*   `deleteCustomVariable (index, scope)` - Delete a custom variable.
*   `getCustomVariable (index, scope)` - Retrieve a custom variable.
*   `storeCustomVariablesInCookie()` -  When called then the Custom Variables of scope "visit" will be stored (persisted) in a first party cookie for the duration of the visit. This is useful if you want to call `getCustomVariable` later in the visit. (by default custom variables are not stored on the visitor's computer.)
*   `setCustomDimension (customDimensionId, customDimensionValue)` - Set a custom dimension. (requires Piwik 2.15.1 + [Custom Dimensions plugin](https://plugins.piwik.org/CustomDimensions))
*   `deleteCustomDimension (customDimensionId)` - Delete a custom dimension. (requires Piwik 2.15.1 + [Custom Dimensions plugin](https://plugins.piwik.org/CustomDimensions))
*   `getCustomDimension (customDimensionId)` - Retrieve a custom dimension. (requires Piwik 2.15.1 + [Custom Dimensions plugin](https://plugins.piwik.org/CustomDimensions))
*   `setCampaignNameKey(name)` - Set campaign name parameter(s). (Help: [Customize Campaign name parameter names](http://piwik.org/faq/how-to/#faq_120))
*   `setCampaignKeywordKey(keyword)` - Set campaign keyword parameter(s). (Help: [Customize Campaign keyword parameter names](http://piwik.org/faq/how-to/#faq_120))
*   `setConversionAttributionFirstReferrer( bool )` - Set to true to attribute a conversion to the first referrer. By default, conversion is attributed to the most recent referrer.

### Ecommerce

Piwik provides [ecommerce analytics](https://piwik.org/docs/ecommerce-analytics/) that let you measure items added to carts, and learn detailed metrics about abandoned carts and purchased orders.

*   `setEcommerceView( productSKU, productName, categoryName, price )` - Sets the current page view as a product or category page view. When you call `setEcommerceView` it must be followed by a call to `trackPageView` to record the product or category page view.
*   `addEcommerceItem( productSKU, [productName], [productCategory], [price], [quantity] )` - Adds a product into the ecommerce order. Must be called for each product in the order. 
*   `trackEcommerceCartUpdate( grandTotal )` - Tracks a shopping cart. Call this javascript function every time a user is adding, updating or deleting a product from the cart.
*   `trackEcommerceOrder( orderId, grandTotal, [subTotal], [tax], [shipping], [discount] )` - Tracks an Ecommerce order, including any ecommerce item previously added to the order. `orderId` and `grandTotal` (ie. revenue) are required parameters.


### Configuration of Tracking Cookies

Starting with Piwik 1.2, first party cookies are used. Consideration must be given to retention times and avoiding conflicts with other cookies, trackers, and apps.

*   `setCookieNamePrefix( prefix )` - the default prefix is '_pk_'.
*   `setCookieDomain( domain )` - the default is the document domain; if your web site can be visited at both www.example.com and example.com, you would use: `tracker.setCookieDomain('.example.com');` or `tracker.setCookieDomain('*.example.com');`
*   `setCookiePath( path )` - the default is '/'.
*   `setVisitorCookieTimeout( seconds )` - the default is 13 months
*   `setReferralCookieTimeout( seconds )` - the default is 6 months
*   `setSessionCookieTimeout( seconds )` - the default is 30 minutes

### Advanced uses

*   `addListener( element )` - Add click listener to a specific link element. When clicked, Piwik will log the click automatically.
*   `setRequestMethod( method )` - Set the request method to either "GET" or "POST". (The default is "GET".) To use the POST request method, the Piwik host must be the same as the tracked website host (Piwik installed in the same domain as your tracked website).
*   `setCustomRequestProcessing( function )` - Set a function that will process the request content. The function will be called once the request (query parameters string) has been prepared, and before the request content is sent.
*   `setRequestContentType( contentType )` - Set request Content-Type header value. Applicable when "POST" request method is used via `setRequestMethod`.

## Unit Tests Covering piwik.js

The Piwik JavaScript Tracking API is covered by an extensive JavaScript unit test suite to ensure that the code quality is as high as possible, and that we never break this functionality. Tests are written using QUnit. To run the tests, simply checkout the [Piwik Git repository](http://piwik.org/participate/contributing-with-git/) and go to `/path/to/piwik/tests/javascript/`. Tests are run inside your browser.

The Piwik JavaScript API has been tested with numerous web browsers. To maximize coverage, we use services like [crossbrowsertesting.com](http://crossbrowsertesting.com/) and [browsershots.org](http://browsershots.org/).

## Minify piwik.js

The piwik.js is minified to reduce the size that your website visitors will have to download. The YUI Compressor is used to minify the JavaScript ([more information](https://github.com/piwik/piwik/blob/master/js/README.md#introduction)). You can find the original non minified version in [/js/piwik.js](https://github.com/piwik/piwik/blob/master/js/piwik.js#L1).

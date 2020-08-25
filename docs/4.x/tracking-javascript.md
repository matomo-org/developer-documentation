---
category: API Reference
---
# JavaScript Tracking Client

## User guide

Read also the **[JavaScript Tracking Client](/guides/tracking-javascript-guide)** user guide to get familiar with the JavaScript tracking client.

## List of all Methods Available in the Tracking API

### Requesting the Tracker Instance from the Piwik Class

*   `Matomo.getTracker( trackerUrl, siteId )` - Get a new instance of the Tracker
*   `Matomo.getAsyncTracker( optionalMatomoUrl, optionalMatomoSiteId )` - Get the internal instance of the Tracker used for asynchronous tracking

### Using the Tracker Object

*   `trackPageView([customTitle])` - Log a page view 
*   `trackEvent(category, action, [name], [value])` - Log an event with an event category (Videos, Music, Games...), an event action (Play, Pause, Duration, Add Playlist, Downloaded, Clicked...), and an optional event name and optional numeric value.
*   `trackSiteSearch(keyword, [category], [resultsCount])` - Log an internal site search for a specific keyword, in an optional category, specifying the optional count of search results in the page.
*   `trackGoal( idGoal, [customRevenue]);` - Log a conversion for the numeric goal ID, with an optional numeric custom revenue customRevenue.
*   `trackLink( url, linkType )` - Log a click from your own code. url is the full URL which is to be tracked as a click. linkType can either be 'link' for an outlink or 'download' for a download.
*   `trackAllContentImpressions()` - Scan the entire DOM for all content blocks and tracks all impressions once the DOM ready event has been triggered.
*   `trackVisibleContentImpressions ( checkOnScroll, timeIntervalInMs )` - Scan the entire DOM for all content blocks as soon as the page is loaded. It tracks an impression only if a content block is actually visible.
*   `trackContentImpressionsWithinNode( domNode )` - Scan the given DOM node and its children for content blocks and tracks an impression for them if no impression was already tracked for it.
*   `trackContentInteractionNode( domNode, contentInteraction )` - Track an interaction with the given DOM node / content block.
*   `trackContentImpression( contentName, contentPiece, contentTarget )` - Track a content impression using the specified values.
*   `trackContentInteraction( contentInteraction, contentName, contentPiece, contentTarget )` - Track a content interaction using the specified values.
*   `logAllContentBlocksOnPage()` - Log all found content blocks within a page to the console. This is useful to debug / test content tracking.
*    `ping()` - Send a ping request. Ping requests do not track new actions. If they are sent within the standard visit length, they will extend the existing visit and the current last action for the visit. If sent after the standard visit length, ping requests will create a new visit using the last action in the last known visit. See also `enableHeartBeatTimer`.
*   `enableHeartBeatTimer( activeTimeInseconds )` - Install a Heart beat timer that will send additional requests to Matomo in order to better measure the time spent on the page. These requests will be sent only when the user is actively viewing the page (when the tab is active and in focus). These requests will not track additional actions or pageviews. By default, `activeTimeInSeconds` is set to 15 seconds. Meaning only if the page was viewed for at least 15 seconds a ping request will be sent. See also `ping` and the [developer guide](https://developer.matomo.org/guides/tracking-javascript-guide#accurately-measure-the-time-spent-on-each-page).
*   `enableLinkTracking( enable )` - Install link tracking on all applicable link elements. Set the enable parameter to true to use pseudo click-handler (treat middle click and open contextmenu as left click). A right click (or any click that opens the context menu) on a link will be tracked as clicked even if "Open in new tab" is not selected. If "false" (default), nothing will be tracked on open context menu or middle click.
* `enableCrossDomainLinking()` - Enable cross domain linking. By default, the visitor ID that identifies a unique visitor is stored in the browser's first party cookies. This means the cookie can only be accessed by pages on the same domain. If you own multiple domains and would like to track all the actions and pageviews of a specific visitor into the same visit, you may enable [cross domain linking (learn more)](https://matomo.org/faq/how-to/faq_23654/) . Whenever a user clicks on a link it will append a URL parameter `pk_vid` to the clicked URL which forwards the current visitor ID value to the page of the different domain.
* `setCrossDomainLinkingTimeout( timeout )` - Set the cross domain linking timeout (in seconds). By default, the two visits across domains will be linked together when the link is clicked and the page is loaded within a 180 seconds timeout window.`
* `getCrossDomainLinkingUrlParameter()` - Get the query parameter to append to links to handle cross domain linking. Use this to add cross domain support for links that are added to the DOM dynamically.  [Learn more about cross domain linking](https://matomo.org/faq/how-to/faq_23654/). 

### Configuration of the Tracker Object

*   `setDocumentTitle( string )` - Override document.title
*   `setDomains( array )` - Set array of hostnames or domains to be treated as local. For wildcard subdomains, you can use: `setDomains('.example.com');` or `setDomains('*.example.com');`. You can also specify a path along a domain: `setDomains('*.example.com/subsite1');`
*   `setCustomUrl( string )` - Override the page's reported URL
*   `setReferrerUrl( string )` - Override the detected Http-Referer
*   `setSiteId( integer )` - Specify the website ID. Redundant: can be specified in `getTracker()` constructor.
*   `setApiUrl( string )` - Specify the Piwik HTTP API URL endpoint. Points to the root directory of piwik, e.g. https://matomo.example.org/ or https://example.org/matomo/. This function is only useful when the 'Overlay' report is not working. By default, you do not need to use this function.
*   `setTrackerUrl( string )` - Specify the Piwik server URL. Redundant: can be specified in `getTracker()` constructor.
*   `getMatomoUrl()` - Return the Matomo server URL.
*   `getPiwikUrl()` - Deprecated, use `getMatomoUrl()` instead. 
*   `getCurrentUrl()` - Return the current url of the page that is currently being visited. If a custom URL was set before calling this method, the custom URL will be returned.
*   `setDownloadClasses( string | array )` - Set classes to be treated as downloads (in addition to matomo_download)
*   `setDownloadExtensions( string | array )` - Set list of file extensions to be recognized as downloads. Example: 'doc' or ['doc', 'xls']
*   `addDownloadExtensions( string | array )` - Specify additional file extensions to be recognized as downloads. Example: 'doc' or ['doc', 'xls']
*   `removeDownloadExtensions( string | array )` - Specify file extensions to be removed from the list of download file extensions. Example: 'doc' or ['doc', 'xls']
*   `setIgnoreClasses( string | array )` - Set classes to be ignored if present in link (in addition to matomo_ignore and piwik_ignore)
*   `setLinkClasses( string | array )` - Set classes to be treated as outlinks (in addition to piwik_link)
*   `setLinkTrackingTimer( integer )` - Set delay for link tracking in milliseconds.
*   `getLinkTrackingTimer()` - Get delay for link tracking (in milliseconds).
*   `discardHashTag( bool )` - Set to true to not record the hash tag (anchor) portion of URLs
*   `setGenerationTimeMs(generationTime)` - By default Piwik uses the browser DOM Timing API to accurately determine the time it takes to generate and download the page. You may overwrite the value by specifying a milliseconds value here.
*   `appendToTrackingUrl(appendToUrl)` - Append a custom string to the end of the HTTP request to matomo.php?
*   `setDoNotTrack( bool )` - Set to true to not track users who opt out of tracking using Mozilla's (proposed) Do Not Track setting.
*   `killFrame()` - Enable a frame-buster to prevent the tracked web page from being framed/iframed.
*   `redirectFile( url )` - Force the browser load the live URL if the tracked web page is loaded from a local file (e.g., saved to someone's desktop).
*   `setHeartBeatTimer( minimumVisitLength, heartBeatDelay )` - Record how long the page has been viewed if the minimumVisitLength (in seconds) is attained; the heartBeatDelay determines how frequently to update the server
*   `getVisitorId()` - Return the 16 characters ID for the visitor
*   `setVisitorId( visitorId )` -  `visitorId` needs to be a 16 digit hex string. The visitorId won't be persisted in a cookie and needs to be set on every new page load. 
*   `getVisitorInfo()` - Return the visitor cookie contents in an array
*   `getAttributionInfo()` - Return the visitor attribution array (Referer information and / or Campaign name &amp; keyword).
    Attribution information is used by Piwik to credit the correct referrer ([first or last referrer](https://matomo.org/faq/general/#faq_106)) used when a user triggers a goal conversion.

    You can also use any of the following functions to get specific attributes of data:

    *   `matomoTracker.getAttributionCampaignName()`
    *   `matomoTracker.getAttributionCampaignKeyword()`
    *   `matomoTracker.getAttributionReferrerTimestamp()`
    *   `matomoTracker.getAttributionReferrerUrl()`

*   `getUserId()` - Return the User ID string if it was set.
*   `setUserId( userId )` -  Sets a [User ID](https://matomo.org/docs/user-id/) to this user (such as an email address or a username).
*   `resetUserId` - Clears (un-set) the User ID.
*   `setCustomVariable (index, name, value, scope)` - Set a custom variable.
*   `deleteCustomVariable (index, scope)` - Delete a custom variable.
*   `getCustomVariable (index, scope)` - Retrieve a custom variable.
*   `storeCustomVariablesInCookie()` -  When called then the Custom Variables of scope "visit" will be stored (persisted) in a first party cookie for the duration of the visit. This is useful if you want to call `getCustomVariable` later in the visit. (by default custom variables are not stored on the visitor's computer.)
*   `setCustomDimension (customDimensionId, customDimensionValue)` - Set a custom dimension. (requires [Custom Dimensions plugin](https://plugins.matomo.org/CustomDimensions))
*   `deleteCustomDimension (customDimensionId)` - Delete a custom dimension. (requires [Custom Dimensions plugin](https://plugins.matomo.org/CustomDimensions))
*   `getCustomDimension (customDimensionId)` - Retrieve a custom dimension. (requires [Custom Dimensions plugin](https://plugins.matomo.org/CustomDimensions))
*   `setCampaignNameKey(name)` - Set campaign name parameter(s). (Help: [Customize Campaign name parameter names](https://matomo.org/faq/how-to/#faq_120))
*   `setCampaignKeywordKey(keyword)` - Set campaign keyword parameter(s). (Help: [Customize Campaign keyword parameter names](https://matomo.org/faq/how-to/#faq_120))
*   `setConversionAttributionFirstReferrer( bool )` - Set to true to attribute a conversion to the first referrer. By default, conversion is attributed to the most recent referrer.

### Ecommerce

Piwik provides [ecommerce analytics](https://matomo.org/docs/ecommerce-analytics/) that let you measure items added to carts, and learn detailed metrics about abandoned carts and purchased orders.

*   `setEcommerceView( productSKU, productName, categoryName, price )` - Set the current page view as a product or category page view. When you call `setEcommerceView` it must be followed by a call to `trackPageView` to record the product or category page view.
*   `addEcommerceItem( productSKU, [productName], [productCategory], [price], [quantity] )` - Add a product into the ecommerce order. Must be called for each product in the order.
*   `removeEcommerceItem( productSKU )` - Remove the specified product from the untracked ecommerce order.
*   `clearEcommerceCart()` - Remove all products in the untracked ecommerce order. _Note: this is done automatically after `trackEcommerceOrder()` is called.
*   `getEcommerceItems()` - Return all ecommerce items currently in the untracked ecommerce order. The returned array will be a copy, so changing it won't affect the ecommerce order. To affect what gets tracked, use the `addEcommerceItem()`/`removeEcommerceItem()`/`clearEcommerceCart()` methods. Use this method to see what will be tracked before you track an order or cart update.
*   `trackEcommerceCartUpdate( grandTotal )` - Track a shopping cart. Call this javascript function every time a user is adding, updating or deleting a product from the cart.
*   `trackEcommerceOrder( orderId, grandTotal, [subTotal], [tax], [shipping], [discount] )` - Track an Ecommerce order, including any ecommerce item previously added to the order. `orderId` and `grandTotal` (ie. revenue) are required parameters.

### Managing Consent

Matomo provides a mechanism to manage your user's tracking consent. You can require that users consent before you track any of their actions, disable tracking for users that do not consent, and re-enable tracking for those that consent later. No cookies will be used when no consent is given. Once consent is given, cookies will be used.

*   `requireConsent()` - By default the Matomo tracker assumes consent to tracking. To change this behavior so nothing is tracked until a user consents, you must call `requireConsent`.
*   `setConsentGiven()` - Mark that the current user has consented. The consent is one-time only, so in a subsequent browser session, the user will have to consent again. To remember consent, see the method below: `rememberConsentGiven`.
*   `rememberConsentGiven( hoursToExpire )` - Mark that the current user has consented, and remembers this consent through a browser cookie. The next time the user visits the site, Matomo will remember that they consented, and track them. If you call this method, you do not need to call `setConsentGiven`.
*   `forgetConsentGiven()` - Remove a user's consent, both if the consent was one-time only and if the consent was remembered. After calling this method, the user will have to consent again in order to be tracked.

Matomo also provides a mechanism to manage your user's cookie consent. You can require that users consent to using cookies. Tracking requests will be always sent but depending on the consent cookies will be used or not used.

*   `requireCookieConsent()` - By default the Matomo tracker assumes consent to using cookies. To change this behavior so no cookies are used by default, you must call `requireCookieConsent`.
*   `setCookieConsentGiven()` - Mark that the current user has consented to using cookies. The consent is one-time only, so in a subsequent browser session, the user will have to consent again. To remember cookie consent, see the method below: `rememberCookieConsentGiven`.
*   `rememberCookieConsentGiven( hoursToExpire )` - Mark that the current user has consented to using cookies, and remembers this consent through a browser cookie. The next time the user visits the site, Matomo will remember that they consented, and use cookies. If you call this method, you do not need to call `setCookieConsentGiven`.
*   `forgetCookieConsentGiven()` - Remove a user's cookie consent, both if the consent was one-time only and if the consent was remembered. After calling this method, the user will have to consent again in order for cookies to be used.

You can use these methods to build your own consent form/pages. [Learn more about asking for consent.](https://developer.matomo.org/guides/tracking-javascript-guide#asking-for-consent)

### Configuration of Tracking Cookies

Piwik uses first party cookies to keep track of some user information over time. Consideration must be given to retention times and avoiding conflicts with other cookies, trackers, and apps.

*   `disableCookies()` - Disable all first party cookies. Existing Piwik cookies for this websites will be deleted on the next page view. Cookies will be even disabled if the user has given cookie consent using the method `rememberCookieConsentGiven()`.
*   `deleteCookies()` - Delete the tracking cookies currently currently set (this is useful when [creating new visits](https://matomo.org/faq/how-to/#faq_187))
*   `hasCookies()` - Return whether cookies are enabled and supported by this browser.
*   `setCookieNamePrefix( prefix )` - the default prefix is '_pk_'.
*   `setCookieDomain( domain )` - the default is the document domain; if your website can be visited at both www.example.com and example.com, you would use: `tracker.setCookieDomain('.example.com');` or `tracker.setCookieDomain('*.example.com');`
*   `setCookiePath( path )` - the default is '/'.
*   `setSecureCookie( bool )` - set to true to enable the Secure cookie flag on all first party cookies. This should be used when your website is only available under HTTPS so that all tracking cookies are always sent over secure connection.
*   `setVisitorCookieTimeout( seconds )` - the default is 13 months
*   `setReferralCookieTimeout( seconds )` - the default is 6 months
*   `setSessionCookieTimeout( seconds )` - the default is 30 minutes

### Advanced uses

*   `addListener( element )` - Add click listener to a specific link element. When clicked, Piwik will log the click automatically.
*   `setRequestMethod( method )` - Set the request method to either "GET" or "POST". (The default is "GET".) To use the POST request method, either 1) the Piwik host is the same as the tracked website host (Piwik installed in the same domain as your tracked website), or 2) if Piwik is not installed on the same host as your website, you need to [enable CORS (Cross domain requests) as explained in this FAQ](https://matomo.org/faq/how-to/faq_18694/).
*   `setCustomRequestProcessing( function )` - Set a function that will process the request content. The function will be called once the request (query parameters string) has been prepared, and before the request content is sent.
*   `setRequestContentType( contentType )` - Set request Content-Type header value. Applicable when "POST" request method is used via `setRequestMethod`.
* `disableQueueRequest()` - Disable the feature which groups together multiple tracking requests and send them as a bulk POST request. Disabling this feature is useful when you want to be able to [replay all logs](https://matomo.org/faq/log-analytics-tool/faq_19221/): one must use `disableQueueRequest` to disable this behaviour to later be able to replay logged Matomo logs (otherwise a subset of the requests wouldn't be able to be replayed).

## Unit Tests Covering matomo.js

The Piwik JavaScript Tracking API is covered by an extensive JavaScript unit test suite to ensure that the code quality is as high as possible, and that we never break this functionality. Tests are written using QUnit. To run the tests, simply checkout the [Piwik Git repository](/guides/contributing-to-piwik-core) and go to `/path/to/matomo/tests/javascript/`. Tests are run inside your browser.

The Piwik JavaScript API has been tested with numerous web browsers. To maximize coverage, we use services like [crossbrowsertesting.com](https://crossbrowsertesting.com/) and [browsershots.org](https://browsershots.org/).

## Minify matomo.js

The matomo.js is minified to reduce the size that your website visitors will have to download. The YUI Compressor is used to minify the JavaScript ([more information](https://github.com/matomo-org/matomo/blob/master/js/README.md#introduction)). You can find the original non minified version in [/js/piwik.js](https://github.com/matomo-org/matomo/blob/master/js/piwik.js#L1).

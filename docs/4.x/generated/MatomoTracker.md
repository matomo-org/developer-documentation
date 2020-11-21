MatomoTracker
=============

MatomoTracker implements the Matomo Tracking Web API.

For more information, see: https://github.com/matomo-org/matomo-php-tracker/

Properties
----------

This class defines the following properties:

- [`$URL`](#$url) &mdash; Matomo base URL, for example http://example.org/matomo/ Must be set before using the class by calling MatomoTracker::$URL = 'http://yourwebsite.org/matomo/';
- [`$DEBUG_APPEND_URL`](#$debug_append_url)
- [`$DEBUG_LAST_REQUESTED_URL`](#$debug_last_requested_url) &mdash; Used in tests to output useful error messages.

<a name="$url" id="$url"></a>
<a name="URL" id="URL"></a>
### `$URL`

Matomo base URL, for example http://example.org/matomo/
Must be set before using the class by calling
MatomoTracker::$URL = 'http://yourwebsite.org/matomo/';

#### Signature

- It is a `string` value.

<a name="$debug_append_url" id="$debug_append_url"></a>
<a name="DEBUG_APPEND_URL" id="DEBUG_APPEND_URL"></a>
### `$DEBUG_APPEND_URL`

#### Signature

- Its type is not specified.


<a name="$debug_last_requested_url" id="$debug_last_requested_url"></a>
<a name="DEBUG_LAST_REQUESTED_URL" id="DEBUG_LAST_REQUESTED_URL"></a>
### `$DEBUG_LAST_REQUESTED_URL`

Used in tests to output useful error messages.

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Builds a MatomoTracker object, used to track visits, pages and Goal conversions for a specific website, by using the Matomo Tracking API.
- [`setPageCharset()`](#setpagecharset) &mdash; By default, Matomo expects utf-8 encoded values, for example for the page URL parameter values, Page Title, etc.
- [`setUrl()`](#seturl) &mdash; Sets the current URL being tracked
- [`setUrlReferrer()`](#seturlreferrer) &mdash; Sets the URL referrer used to track Referrers details for new visits.
- [`setGenerationTime()`](#setgenerationtime) &mdash; Sets the time that generating the document on the server side took.
- [`setPerformanceTimings()`](#setperformancetimings) &mdash; Sets timings for various browser performance metrics.
- [`clearPerformanceTimings()`](#clearperformancetimings) &mdash; Clear / reset all previously set performance metrics.
- [`setAttributionInfo()`](#setattributioninfo) &mdash; Sets the attribution information to the visit, so that subsequent Goal conversions are properly attributed to the right Referrer URL, timestamp, Campaign Name & Keyword.
- [`setCustomVariable()`](#setcustomvariable) &mdash; Sets Visit Custom Variable.
- [`getCustomVariable()`](#getcustomvariable) &mdash; Returns the currently assigned Custom Variable.
- [`clearCustomVariables()`](#clearcustomvariables) &mdash; Clears any Custom Variable that may be have been set.
- [`setCustomDimension()`](#setcustomdimension) &mdash; Sets a specific custom dimension
- [`clearCustomDimensions()`](#clearcustomdimensions) &mdash; Clears all previously set custom dimensions
- [`getCustomDimension()`](#getcustomdimension) &mdash; Returns the value of the custom dimension with the given id
- [`setCustomTrackingParameter()`](#setcustomtrackingparameter) &mdash; Sets a custom tracking parameter.
- [`clearCustomTrackingParameters()`](#clearcustomtrackingparameters) &mdash; Clear / reset all previously set custom tracking parameters.
- [`setNewVisitorId()`](#setnewvisitorid) &mdash; Sets the current visitor ID to a random new one.
- [`setIdSite()`](#setidsite) &mdash; Sets the current site ID.
- [`setBrowserLanguage()`](#setbrowserlanguage) &mdash; Sets the Browser language.
- [`setUserAgent()`](#setuseragent) &mdash; Sets the user agent, used to detect OS and browser.
- [`setCountry()`](#setcountry) &mdash; Sets the country of the visitor.
- [`setRegion()`](#setregion) &mdash; Sets the region of the visitor.
- [`setCity()`](#setcity) &mdash; Sets the city of the visitor.
- [`setLatitude()`](#setlatitude) &mdash; Sets the latitude of the visitor.
- [`setLongitude()`](#setlongitude) &mdash; Sets the longitude of the visitor.
- [`enableBulkTracking()`](#enablebulktracking) &mdash; Enables the bulk request feature.
- [`enableCookies()`](#enablecookies) &mdash; Enable Cookie Creation - this will cause a first party VisitorId cookie to be set when the VisitorId is set or reset
- [`disableSendImageResponse()`](#disablesendimageresponse) &mdash; If image response is disabled Matomo will respond with a HTTP 204 header instead of responding with a gif.
- [`doTrackPageView()`](#dotrackpageview) &mdash; Tracks a page view
- [`doTrackEvent()`](#dotrackevent) &mdash; Tracks an event
- [`doTrackContentImpression()`](#dotrackcontentimpression) &mdash; Tracks a content impression
- [`doTrackContentInteraction()`](#dotrackcontentinteraction) &mdash; Tracks a content interaction.
- [`doTrackSiteSearch()`](#dotracksitesearch) &mdash; Tracks an internal Site Search query, and optionally tracks the Search Category, and Search results Count.
- [`doTrackGoal()`](#dotrackgoal) &mdash; Records a Goal conversion
- [`doTrackAction()`](#dotrackaction) &mdash; Tracks a download or outlink
- [`addEcommerceItem()`](#addecommerceitem) &mdash; Adds an item in the Ecommerce order.
- [`doTrackEcommerceCartUpdate()`](#dotrackecommercecartupdate) &mdash; Tracks a Cart Update (add item, remove item, update item).
- [`doBulkTrack()`](#dobulktrack) &mdash; Sends all stored tracking actions at once.
- [`doTrackEcommerceOrder()`](#dotrackecommerceorder) &mdash; Tracks an Ecommerce order.
- [`doPing()`](#doping) &mdash; Sends a ping request.
- [`setEcommerceView()`](#setecommerceview) &mdash; Sets the current page view as an item (product) page view, or an Ecommerce Category page view.
- [`getUrlTrackPageView()`](#geturltrackpageview) &mdash; Builds URL to track a page view.
- [`getUrlTrackEvent()`](#geturltrackevent) &mdash; Builds URL to track a custom event.
- [`getUrlTrackContentImpression()`](#geturltrackcontentimpression) &mdash; Builds URL to track a content impression.
- [`getUrlTrackContentInteraction()`](#geturltrackcontentinteraction) &mdash; Builds URL to track a content impression.
- [`getUrlTrackSiteSearch()`](#geturltracksitesearch) &mdash; Builds URL to track a site search.
- [`getUrlTrackGoal()`](#geturltrackgoal) &mdash; Builds URL to track a goal with idGoal and revenue.
- [`getUrlTrackAction()`](#geturltrackaction) &mdash; Builds URL to track a new action.
- [`setForceVisitDateTime()`](#setforcevisitdatetime) &mdash; Overrides server date and time for the tracking requests.
- [`setForceNewVisit()`](#setforcenewvisit) &mdash; Forces Matomo to create a new visit for the tracking request.
- [`setIp()`](#setip) &mdash; Overrides IP address
- [`setUserId()`](#setuserid) &mdash; Force the action to be recorded for a specific User.
- [`getUserIdHashed()`](#getuseridhashed) &mdash; Hash function used internally by Matomo to hash a User ID into the Visitor ID.
- [`setVisitorId()`](#setvisitorid) &mdash; Forces the requests to be recorded for the specified Visitor ID.
- [`getVisitorId()`](#getvisitorid) &mdash; If the user initiating the request has the Matomo first party cookie, this function will try and return the ID parsed from this first party cookie (found in $_COOKIE).
- [`getUserAgent()`](#getuseragent) &mdash; Returns the currently set user agent.
- [`getIp()`](#getip) &mdash; Returns the currently set IP address.
- [`getUserId()`](#getuserid) &mdash; Returns the User ID string, which may have been set via: $v->setUserId('username@example.org');
- [`deleteCookies()`](#deletecookies) &mdash; Deletes all first party cookies from the client
- [`getAttributionInfo()`](#getattributioninfo) &mdash; Returns the currently assigned Attribution Information stored in a first party cookie.
- [`setTokenAuth()`](#settokenauth) &mdash; Some Tracking API functionality requires express authentication, using either the Super User token_auth, or a user with 'admin' access to the website.
- [`setLocalTime()`](#setlocaltime) &mdash; Sets local visitor time
- [`setResolution()`](#setresolution) &mdash; Sets user resolution width and height.
- [`setBrowserHasCookies()`](#setbrowserhascookies) &mdash; Sets if the browser supports cookies This is reported in "List of plugins" report in Matomo.
- [`setDebugStringAppend()`](#setdebugstringappend) &mdash; Will append a custom string at the end of the Tracking request.
- [`setPlugins()`](#setplugins) &mdash; Sets visitor browser supported plugins
- [`disableCookieSupport()`](#disablecookiesupport) &mdash; By default, MatomoTracker will read first party cookies from the request and write updated cookies in the response (using setrawcookie).
- [`getRequestTimeout()`](#getrequesttimeout) &mdash; Returns the maximum number of seconds the tracker will spend waiting for a response from Matomo.
- [`setRequestTimeout()`](#setrequesttimeout) &mdash; Sets the maximum number of seconds that the tracker will spend waiting for a response from Matomo.
- [`setRequestMethodNonBulk()`](#setrequestmethodnonbulk) &mdash; Sets the request method to POST, which is recommended when using setTokenAuth() to prevent the token from being recorded in server logs.
- [`setProxy()`](#setproxy) &mdash; If a proxy is needed to look up the address of the Matomo site, set it with this
- [`setOutgoingTrackerCookie()`](#setoutgoingtrackercookie) &mdash; Sets a cookie to be sent to the tracking server.
- [`getIncomingTrackerCookie()`](#getincomingtrackercookie) &mdash; Gets a cookie which was set by the tracking server.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Builds a MatomoTracker object, used to track visits, pages and Goal conversions
for a specific website, by using the Matomo Tracking API.

#### Signature

-  It accepts the following parameter(s):
    - `$idSite` (`int`) &mdash;
       Id site to be tracked
    - `$apiUrl` (`string`) &mdash;
       "http://example.org/matomo/" or "http://matomo.example.org/" If set, will overwrite MatomoTracker::$URL

<a name="setpagecharset" id="setpagecharset"></a>
<a name="setPageCharset" id="setPageCharset"></a>
### `setPageCharset()`

By default, Matomo expects utf-8 encoded values, for example
for the page URL parameter values, Page Title, etc.

It is recommended to only send UTF-8 data to Matomo.
If required though, you can also specify another charset using this function.

#### Signature

-  It accepts the following parameter(s):
    - `$charset` (`string`) &mdash;
      
- It returns a `$this` value.

<a name="seturl" id="seturl"></a>
<a name="setUrl" id="setUrl"></a>
### `setUrl()`

Sets the current URL being tracked

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
       Raw URL (not URL encoded)
- It returns a `$this` value.

<a name="seturlreferrer" id="seturlreferrer"></a>
<a name="setUrlReferrer" id="setUrlReferrer"></a>
### `setUrlReferrer()`

Sets the URL referrer used to track Referrers details for new visits.

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
       Raw URL (not URL encoded)
- It returns a `$this` value.

<a name="setgenerationtime" id="setgenerationtime"></a>
<a name="setGenerationTime" id="setGenerationTime"></a>
### `setGenerationTime()`

Sets the time that generating the document on the server side took.

#### See Also

- `setPerformanceTimings`

#### Signature

-  It accepts the following parameter(s):
    - `$timeMs` (`int`) &mdash;
       Generation time in ms
- It returns a `$this` value.

<a name="setperformancetimings" id="setperformancetimings"></a>
<a name="setPerformanceTimings" id="setPerformanceTimings"></a>
### `setPerformanceTimings()`

Sets timings for various browser performance metrics.

#### See Also

- `https://developer.mozilla.org/en-US/docs/Web/API/PerformanceTiming`

#### Signature

-  It accepts the following parameter(s):
    - `$network` (`null`|`int`) &mdash;
       Network time in ms (connectEnd – fetchStart)
    - `$server` (`null`|`int`) &mdash;
       Server time in ms (responseStart – requestStart)
    - `$transfer` (`null`|`int`) &mdash;
       Transfer time in ms (responseEnd – responseStart)
    - `$domProcessing` (`null`|`int`) &mdash;
       DOM Processing to Interactive time in ms (domInteractive – domLoading)
    - `$domCompletion` (`null`|`int`) &mdash;
       DOM Interactive to Complete time in ms (domComplete – domInteractive)
    - `$onload` (`null`|`int`) &mdash;
       Onload time in ms (loadEventEnd – loadEventStart)
- It returns a `$this` value.

<a name="clearperformancetimings" id="clearperformancetimings"></a>
<a name="clearPerformanceTimings" id="clearPerformanceTimings"></a>
### `clearPerformanceTimings()`

Clear / reset all previously set performance metrics.

#### Signature

- It does not return anything or a mixed result.

<a name="setattributioninfo" id="setattributioninfo"></a>
<a name="setAttributionInfo" id="setAttributionInfo"></a>
### `setAttributionInfo()`

Sets the attribution information to the visit, so that subsequent Goal conversions are
properly attributed to the right Referrer URL, timestamp, Campaign Name & Keyword.

This must be a JSON encoded string that would typically be fetched from the JS API:
matomoTracker.getAttributionInfo() and that you have JSON encoded via JSON2.stringify()

If you call enableCookies() then these referral attribution values will be set
to the 'ref' first party cookie storing referral information.

#### See Also

- `function` &mdash; getAttributionInfo() in https://github.com/matomo-org/matomo/blob/master/js/matomo.js

#### Signature

-  It accepts the following parameter(s):
    - `$jsonEncoded` (`string`) &mdash;
       JSON encoded array containing Attribution info
- It returns a `$this` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="setcustomvariable" id="setcustomvariable"></a>
<a name="setCustomVariable" id="setCustomVariable"></a>
### `setCustomVariable()`

Sets Visit Custom Variable.

See https://matomo.org/docs/custom-variables/

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`int`) &mdash;
       Custom variable slot ID from 1-5
    - `$name` (`string`) &mdash;
       Custom variable name
    - `$value` (`string`) &mdash;
       Custom variable value
    - `$scope` (`string`) &mdash;
       Custom variable scope. Possible values: visit, page, event
- It returns a `$this` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getcustomvariable" id="getcustomvariable"></a>
<a name="getCustomVariable" id="getCustomVariable"></a>
### `getCustomVariable()`

Returns the currently assigned Custom Variable.

If scope is 'visit', it will attempt to read the value set in the first party cookie created by Matomo Tracker
 ($_COOKIE array).

#### See Also

- `matomo.js` &mdash; getCustomVariable()

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`int`) &mdash;
       Custom Variable integer index to fetch from cookie. Should be a value from 1 to 5
    - `$scope` (`string`) &mdash;
       Custom variable scope. Possible values: visit, page, event

- *Returns:*  `mixed` &mdash;
    An array with this format: array( 0 => CustomVariableName, 1 => CustomVariableValue ) or false
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="clearcustomvariables" id="clearcustomvariables"></a>
<a name="clearCustomVariables" id="clearCustomVariables"></a>
### `clearCustomVariables()`

Clears any Custom Variable that may be have been set.

This can be useful when you have enabled bulk requests,
and you wish to clear Custom Variables of 'visit' scope.

#### Signature

- It does not return anything or a mixed result.

<a name="setcustomdimension" id="setcustomdimension"></a>
<a name="setCustomDimension" id="setCustomDimension"></a>
### `setCustomDimension()`

Sets a specific custom dimension

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`int`) &mdash;
       id of custom dimension
    - `$value` (`string`) &mdash;
       value for custom dimension
- It returns a `$this` value.

<a name="clearcustomdimensions" id="clearcustomdimensions"></a>
<a name="clearCustomDimensions" id="clearCustomDimensions"></a>
### `clearCustomDimensions()`

Clears all previously set custom dimensions

#### Signature

- It does not return anything or a mixed result.

<a name="getcustomdimension" id="getcustomdimension"></a>
<a name="getCustomDimension" id="getCustomDimension"></a>
### `getCustomDimension()`

Returns the value of the custom dimension with the given id

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`int`) &mdash;
       id of custom dimension

- *Returns:*  `string`|`null` &mdash;
    

<a name="setcustomtrackingparameter" id="setcustomtrackingparameter"></a>
<a name="setCustomTrackingParameter" id="setCustomTrackingParameter"></a>
### `setCustomTrackingParameter()`

Sets a custom tracking parameter. This is useful if you need to send any tracking parameters for a 3rd party
plugin that is not shipped with Matomo itself. Please note that custom parameters are cleared after each
tracking request.

#### Signature

-  It accepts the following parameter(s):
    - `$trackingApiParameter` (`string`) &mdash;
       The name of the tracking API parameter, eg 'bw_bytes'
    - `$value` (`string`) &mdash;
       Tracking parameter value that shall be sent for this tracking parameter.
- It returns a `$this` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="clearcustomtrackingparameters" id="clearcustomtrackingparameters"></a>
<a name="clearCustomTrackingParameters" id="clearCustomTrackingParameters"></a>
### `clearCustomTrackingParameters()`

Clear / reset all previously set custom tracking parameters.

#### Signature

- It does not return anything or a mixed result.

<a name="setnewvisitorid" id="setnewvisitorid"></a>
<a name="setNewVisitorId" id="setNewVisitorId"></a>
### `setNewVisitorId()`

Sets the current visitor ID to a random new one.

#### Signature

- It returns a `$this` value.

<a name="setidsite" id="setidsite"></a>
<a name="setIdSite" id="setIdSite"></a>
### `setIdSite()`

Sets the current site ID.

#### Signature

-  It accepts the following parameter(s):
    - `$idSite` (`int`) &mdash;
      
- It returns a `$this` value.

<a name="setbrowserlanguage" id="setbrowserlanguage"></a>
<a name="setBrowserLanguage" id="setBrowserLanguage"></a>
### `setBrowserLanguage()`

Sets the Browser language. Used to guess visitor countries when GeoIP is not enabled

#### Signature

-  It accepts the following parameter(s):
    - `$acceptLanguage` (`string`) &mdash;
       For example "fr-fr"
- It returns a `$this` value.

<a name="setuseragent" id="setuseragent"></a>
<a name="setUserAgent" id="setUserAgent"></a>
### `setUserAgent()`

Sets the user agent, used to detect OS and browser.

If this function is not called, the User Agent will default to the current user agent.

#### Signature

-  It accepts the following parameter(s):
    - `$userAgent` (`string`) &mdash;
      
- It returns a `$this` value.

<a name="setcountry" id="setcountry"></a>
<a name="setCountry" id="setCountry"></a>
### `setCountry()`

Sets the country of the visitor. If not used, Matomo will try to find the country
using either the visitor's IP address or language.

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):
    - `$country` (`string`) &mdash;
      
- It returns a `$this` value.

<a name="setregion" id="setregion"></a>
<a name="setRegion" id="setRegion"></a>
### `setRegion()`

Sets the region of the visitor. If not used, Matomo may try to find the region
using the visitor's IP address (if configured to do so).

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):
    - `$region` (`string`) &mdash;
      
- It returns a `$this` value.

<a name="setcity" id="setcity"></a>
<a name="setCity" id="setCity"></a>
### `setCity()`

Sets the city of the visitor. If not used, Matomo may try to find the city
using the visitor's IP address (if configured to do so).

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):
    - `$city` (`string`) &mdash;
      
- It returns a `$this` value.

<a name="setlatitude" id="setlatitude"></a>
<a name="setLatitude" id="setLatitude"></a>
### `setLatitude()`

Sets the latitude of the visitor. If not used, Matomo may try to find the visitor's
latitude using the visitor's IP address (if configured to do so).

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):
    - `$lat` (`float`) &mdash;
      
- It returns a `$this` value.

<a name="setlongitude" id="setlongitude"></a>
<a name="setLongitude" id="setLongitude"></a>
### `setLongitude()`

Sets the longitude of the visitor. If not used, Matomo may try to find the visitor's
longitude using the visitor's IP address (if configured to do so).

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):
    - `$long` (`float`) &mdash;
      
- It returns a `$this` value.

<a name="enablebulktracking" id="enablebulktracking"></a>
<a name="enableBulkTracking" id="enableBulkTracking"></a>
### `enableBulkTracking()`

Enables the bulk request feature. When used, each tracking action is stored until the
doBulkTrack method is called. This method will send all tracking data at once.

#### Signature

- It does not return anything or a mixed result.

<a name="enablecookies" id="enablecookies"></a>
<a name="enableCookies" id="enableCookies"></a>
### `enableCookies()`

Enable Cookie Creation - this will cause a first party VisitorId cookie to be set when the VisitorId is set or reset

#### Signature

-  It accepts the following parameter(s):
    - `$domain` (`string`) &mdash;
       (optional) Set first-party cookie domain. Accepted values: example.com, *.example.com (same as .example.com) or subdomain.example.com
    - `$path` (`string`) &mdash;
       (optional) Set first-party cookie path
    - `$secure` (`bool`) &mdash;
       (optional) Set secure flag for cookies
    - `$httpOnly` (`bool`) &mdash;
       (optional) Set HTTPOnly flag for cookies
    - `$sameSite` (`string`) &mdash;
       (optional) Set SameSite flag for cookies
- It does not return anything or a mixed result.

<a name="disablesendimageresponse" id="disablesendimageresponse"></a>
<a name="disableSendImageResponse" id="disableSendImageResponse"></a>
### `disableSendImageResponse()`

If image response is disabled Matomo will respond with a HTTP 204 header instead of responding with a gif.

#### Signature

- It does not return anything or a mixed result.

<a name="dotrackpageview" id="dotrackpageview"></a>
<a name="doTrackPageView" id="doTrackPageView"></a>
### `doTrackPageView()`

Tracks a page view

#### Signature

-  It accepts the following parameter(s):
    - `$documentTitle` (`string`) &mdash;
       Page title as it will appear in the Actions > Page titles report

- *Returns:*  `mixed` &mdash;
    Response string or true if using bulk requests.

<a name="dotrackevent" id="dotrackevent"></a>
<a name="doTrackEvent" id="doTrackEvent"></a>
### `doTrackEvent()`

Tracks an event

#### Signature

-  It accepts the following parameter(s):
    - `$category` (`string`) &mdash;
       The Event Category (Videos, Music, Games...)
    - `$action` (`string`) &mdash;
       The Event's Action (Play, Pause, Duration, Add Playlist, Downloaded, Clicked...)
    - `$name` (`string`|`bool`) &mdash;
       (optional) The Event's object Name (a particular Movie name, or Song name, or File name...)
    - `$value` (`float`|`bool`) &mdash;
       (optional) The Event's value

- *Returns:*  `mixed` &mdash;
    Response string or true if using bulk requests.

<a name="dotrackcontentimpression" id="dotrackcontentimpression"></a>
<a name="doTrackContentImpression" id="doTrackContentImpression"></a>
### `doTrackContentImpression()`

Tracks a content impression

#### Signature

-  It accepts the following parameter(s):
    - `$contentName` (`string`) &mdash;
       The name of the content. For instance 'Ad Foo Bar'
    - `$contentPiece` (`string`) &mdash;
       The actual content. For instance the path to an image, video, audio, any text
    - `$contentTarget` (`string`|`bool`) &mdash;
       (optional) The target of the content. For instance the URL of a landing page.

- *Returns:*  `mixed` &mdash;
    Response string or true if using bulk requests.

<a name="dotrackcontentinteraction" id="dotrackcontentinteraction"></a>
<a name="doTrackContentInteraction" id="doTrackContentInteraction"></a>
### `doTrackContentInteraction()`

Tracks a content interaction. Make sure you have tracked a content impression using the same content name and
content piece, otherwise it will not count. To do so you should call the method doTrackContentImpression();

#### Signature

-  It accepts the following parameter(s):
    - `$interaction` (`string`) &mdash;
       The name of the interaction with the content. For instance a 'click'
    - `$contentName` (`string`) &mdash;
       The name of the content. For instance 'Ad Foo Bar'
    - `$contentPiece` (`string`) &mdash;
       The actual content. For instance the path to an image, video, audio, any text
    - `$contentTarget` (`string`|`bool`) &mdash;
       (optional) The target the content leading to when an interaction occurs. For instance the URL of a landing page.

- *Returns:*  `mixed` &mdash;
    Response string or true if using bulk requests.

<a name="dotracksitesearch" id="dotracksitesearch"></a>
<a name="doTrackSiteSearch" id="doTrackSiteSearch"></a>
### `doTrackSiteSearch()`

Tracks an internal Site Search query, and optionally tracks the Search Category, and Search results Count.

These are used to populate reports in Actions > Site Search.

#### Signature

-  It accepts the following parameter(s):
    - `$keyword` (`string`) &mdash;
       Searched query on the site
    - `$category` (`string`) &mdash;
       (optional) Search engine category if applicable
    - `$countResults` (`bool`|`int`) &mdash;
       (optional) results displayed on the search result page. Used to track "zero result" keywords.

- *Returns:*  `mixed` &mdash;
    Response or true if using bulk requests.

<a name="dotrackgoal" id="dotrackgoal"></a>
<a name="doTrackGoal" id="doTrackGoal"></a>
### `doTrackGoal()`

Records a Goal conversion

#### Signature

-  It accepts the following parameter(s):
    - `$idGoal` (`int`) &mdash;
       Id Goal to record a conversion
    - `$revenue` (`float`) &mdash;
       Revenue for this conversion

- *Returns:*  `mixed` &mdash;
    Response or true if using bulk request

<a name="dotrackaction" id="dotrackaction"></a>
<a name="doTrackAction" id="doTrackAction"></a>
### `doTrackAction()`

Tracks a download or outlink

#### Signature

-  It accepts the following parameter(s):
    - `$actionUrl` (`string`) &mdash;
       URL of the download or outlink
    - `$actionType` (`string`) &mdash;
       Type of the action: 'download' or 'link'

- *Returns:*  `mixed` &mdash;
    Response or true if using bulk request

<a name="addecommerceitem" id="addecommerceitem"></a>
<a name="addEcommerceItem" id="addEcommerceItem"></a>
### `addEcommerceItem()`

Adds an item in the Ecommerce order.

This should be called before doTrackEcommerceOrder(), or before doTrackEcommerceCartUpdate().
This function can be called for all individual products in the cart (or order).
SKU parameter is mandatory. Other parameters are optional (set to false if value not known).
Ecommerce items added via this function are automatically cleared when doTrackEcommerceOrder() or getUrlTrackEcommerceOrder() is called.

#### Signature

-  It accepts the following parameter(s):
    - `$sku` (`string`) &mdash;
       (required) SKU, Product identifier
    - `$name` (`string`) &mdash;
       (optional) Product name
    - `$category` (`string`|`array`) &mdash;
       (optional) Product category, or array of product categories (up to 5 categories can be specified for a given product)
    - `$price` (`float`|`int`) &mdash;
       (optional) Individual product price (supports integer and decimal prices)
    - `$quantity` (`int`) &mdash;
       (optional) Product quantity. If not specified, will default to 1 in the Reports
- It returns a `$this` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="dotrackecommercecartupdate" id="dotrackecommercecartupdate"></a>
<a name="doTrackEcommerceCartUpdate" id="doTrackEcommerceCartUpdate"></a>
### `doTrackEcommerceCartUpdate()`

Tracks a Cart Update (add item, remove item, update item).

On every Cart update, you must call addEcommerceItem() for each item (product) in the cart,
including the items that haven't been updated since the last cart update.
Items which were in the previous cart and are not sent in later Cart updates will be deleted from the cart (in the database).

#### Signature

-  It accepts the following parameter(s):
    - `$grandTotal` (`float`) &mdash;
       Cart grandTotal (typically the sum of all items' prices)

- *Returns:*  `mixed` &mdash;
    Response or true if using bulk request

<a name="dobulktrack" id="dobulktrack"></a>
<a name="doBulkTrack" id="doBulkTrack"></a>
### `doBulkTrack()`

Sends all stored tracking actions at once. Only has an effect if bulk tracking is enabled.

To enable bulk tracking, call enableBulkTracking().

#### Signature


- *Returns:*  `string` &mdash;
    Response
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="dotrackecommerceorder" id="dotrackecommerceorder"></a>
<a name="doTrackEcommerceOrder" id="doTrackEcommerceOrder"></a>
### `doTrackEcommerceOrder()`

Tracks an Ecommerce order.

If the Ecommerce order contains items (products), you must call first the addEcommerceItem() for each item in the order.
All revenues (grandTotal, subTotal, tax, shipping, discount) will be individually summed and reported in Matomo reports.
Only the parameters $orderId and $grandTotal are required.

#### Signature

-  It accepts the following parameter(s):
    - `$orderId` (`string`|`int`) &mdash;
       (required) Unique Order ID. This will be used to count this order only once in the event the order page is reloaded several times. orderId must be unique for each transaction, even on different days, or the transaction will not be recorded by Matomo.
    - `$grandTotal` (`float`) &mdash;
       (required) Grand Total revenue of the transaction (including tax, shipping, etc.)
    - `$subTotal` (`float`) &mdash;
       (optional) Sub total amount, typically the sum of items prices for all items in this order (before Tax and Shipping costs are applied)
    - `$tax` (`float`) &mdash;
       (optional) Tax amount for this order
    - `$shipping` (`float`) &mdash;
       (optional) Shipping amount for this order
    - `$discount` (`float`) &mdash;
       (optional) Discounted amount in this order

- *Returns:*  `mixed` &mdash;
    Response or true if using bulk request

<a name="doping" id="doping"></a>
<a name="doPing" id="doPing"></a>
### `doPing()`

Sends a ping request.

Ping requests do not track new actions. If they are sent within the standard visit length (see global.ini.php),
they will extend the existing visit and the current last action for the visit. If after the standard visit length,
ping requests will create a new visit using the last action in the last known visit.

#### Signature


- *Returns:*  `mixed` &mdash;
    Response or true if using bulk request

<a name="setecommerceview" id="setecommerceview"></a>
<a name="setEcommerceView" id="setEcommerceView"></a>
### `setEcommerceView()`

Sets the current page view as an item (product) page view, or an Ecommerce Category page view.

This must be called before doTrackPageView() on this product/category page.

On a category page, you may set the parameter $category only and set the other parameters to false.

Tracking Product/Category page views will allow Matomo to report on Product & Categories
conversion rates (Conversion rate = Ecommerce orders containing this product or category / Visits to the product or category)

#### Signature

-  It accepts the following parameter(s):
    - `$sku` (`string`) &mdash;
       Product SKU being viewed
    - `$name` (`string`) &mdash;
       Product Name being viewed
    - `$category` (`string`|`array`) &mdash;
       Category being viewed. On a Product page, this is the product's category. You can also specify an array of up to 5 categories for a given page view.
    - `$price` (`float`) &mdash;
       Specify the price at which the item was displayed
- It returns a `$this` value.

<a name="geturltrackpageview" id="geturltrackpageview"></a>
<a name="getUrlTrackPageView" id="getUrlTrackPageView"></a>
### `getUrlTrackPageView()`

Builds URL to track a page view.

#### See Also

- `doTrackPageView()`

#### Signature

-  It accepts the following parameter(s):
    - `$documentTitle` (`string`) &mdash;
       Page view name as it will appear in Matomo reports

- *Returns:*  `string` &mdash;
    URL to matomo.php with all parameters set to track the pageview

<a name="geturltrackevent" id="geturltrackevent"></a>
<a name="getUrlTrackEvent" id="getUrlTrackEvent"></a>
### `getUrlTrackEvent()`

Builds URL to track a custom event.

#### See Also

- `doTrackEvent()`

#### Signature

-  It accepts the following parameter(s):
    - `$category` (`string`) &mdash;
       The Event Category (Videos, Music, Games...)
    - `$action` (`string`) &mdash;
       The Event's Action (Play, Pause, Duration, Add Playlist, Downloaded, Clicked...)
    - `$name` (`string`|`bool`) &mdash;
       (optional) The Event's object Name (a particular Movie name, or Song name, or File name...)
    - `$value` (`float`|`bool`) &mdash;
       (optional) The Event's value

- *Returns:*  `string` &mdash;
    URL to matomo.php with all parameters set to track the pageview
- It throws one of the following exceptions:
    - ``

<a name="geturltrackcontentimpression" id="geturltrackcontentimpression"></a>
<a name="getUrlTrackContentImpression" id="getUrlTrackContentImpression"></a>
### `getUrlTrackContentImpression()`

Builds URL to track a content impression.

#### See Also

- `doTrackContentImpression()`

#### Signature

-  It accepts the following parameter(s):
    - `$contentName` (`string`) &mdash;
       The name of the content. For instance 'Ad Foo Bar'
    - `$contentPiece` (`string`) &mdash;
       The actual content. For instance the path to an image, video, audio, any text
    - `$contentTarget` (`string`|`false`) &mdash;
       (optional) The target of the content. For instance the URL of a landing page.

- *Returns:*  `string` &mdash;
    URL to matomo.php with all parameters set to track the pageview
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case $contentName is empty

<a name="geturltrackcontentinteraction" id="geturltrackcontentinteraction"></a>
<a name="getUrlTrackContentInteraction" id="getUrlTrackContentInteraction"></a>
### `getUrlTrackContentInteraction()`

Builds URL to track a content impression.

#### See Also

- `doTrackContentInteraction()`

#### Signature

-  It accepts the following parameter(s):
    - `$interaction` (`string`) &mdash;
       The name of the interaction with the content. For instance a 'click'
    - `$contentName` (`string`) &mdash;
       The name of the content. For instance 'Ad Foo Bar'
    - `$contentPiece` (`string`) &mdash;
       The actual content. For instance the path to an image, video, audio, any text
    - `$contentTarget` (`string`|`false`) &mdash;
       (optional) The target the content leading to when an interaction occurs. For instance the URL of a landing page.

- *Returns:*  `string` &mdash;
    URL to matomo.php with all parameters set to track the pageview
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case $interaction or $contentName is empty

<a name="geturltracksitesearch" id="geturltracksitesearch"></a>
<a name="getUrlTrackSiteSearch" id="getUrlTrackSiteSearch"></a>
### `getUrlTrackSiteSearch()`

Builds URL to track a site search.

#### See Also

- `doTrackSiteSearch()`

#### Signature

-  It accepts the following parameter(s):
    - `$keyword` (`string`) &mdash;
      
    - `$category` (`string`) &mdash;
      
    - `$countResults` (`int`) &mdash;
      
- It returns a `string` value.

<a name="geturltrackgoal" id="geturltrackgoal"></a>
<a name="getUrlTrackGoal" id="getUrlTrackGoal"></a>
### `getUrlTrackGoal()`

Builds URL to track a goal with idGoal and revenue.

#### See Also

- `doTrackGoal()`

#### Signature

-  It accepts the following parameter(s):
    - `$idGoal` (`int`) &mdash;
       Id Goal to record a conversion
    - `$revenue` (`float`) &mdash;
       Revenue for this conversion

- *Returns:*  `string` &mdash;
    URL to matomo.php with all parameters set to track the goal conversion

<a name="geturltrackaction" id="geturltrackaction"></a>
<a name="getUrlTrackAction" id="getUrlTrackAction"></a>
### `getUrlTrackAction()`

Builds URL to track a new action.

#### See Also

- `doTrackAction()`

#### Signature

-  It accepts the following parameter(s):
    - `$actionUrl` (`string`) &mdash;
       URL of the download or outlink
    - `$actionType` (`string`) &mdash;
       Type of the action: 'download' or 'link'

- *Returns:*  `string` &mdash;
    URL to matomo.php with all parameters set to track an action

<a name="setforcevisitdatetime" id="setforcevisitdatetime"></a>
<a name="setForceVisitDateTime" id="setForceVisitDateTime"></a>
### `setForceVisitDateTime()`

Overrides server date and time for the tracking requests.

By default Matomo will track requests for the "current datetime" but this function allows you
to track visits in the past. All times are in UTC.

Allowed only for Admin/Super User, must be used along with setTokenAuth()

#### See Also

- `setTokenAuth()`

#### Signature

-  It accepts the following parameter(s):
    - `$dateTime` (`string`) &mdash;
       Date with the format 'Y-m-d H:i:s', or a UNIX timestamp. If the datetime is older than one day (default value for tracking_requests_require_authentication_when_custom_timestamp_newer_than), then you must call setTokenAuth() with a valid Admin/Super user token.
- It returns a `$this` value.

<a name="setforcenewvisit" id="setforcenewvisit"></a>
<a name="setForceNewVisit" id="setForceNewVisit"></a>
### `setForceNewVisit()`

Forces Matomo to create a new visit for the tracking request.

By default, Matomo will create a new visit if the last request by this user was more than 30 minutes ago.
If you call setForceNewVisit() before calling doTrack*, then a new visit will be created for this request.

#### Signature

- It returns a `$this` value.

<a name="setip" id="setip"></a>
<a name="setIp" id="setIp"></a>
### `setIp()`

Overrides IP address

Allowed only for Admin/Super User, must be used along with setTokenAuth()

#### See Also

- `setTokenAuth()`

#### Signature

-  It accepts the following parameter(s):
    - `$ip` (`string`) &mdash;
       IP string, eg. 130.54.2.1
- It returns a `$this` value.

<a name="setuserid" id="setuserid"></a>
<a name="setUserId" id="setUserId"></a>
### `setUserId()`

Force the action to be recorded for a specific User. The User ID is a string representing a given user in your system.

A User ID can be a username, UUID or an email address, or any number or string that uniquely identifies a user or client.

#### Signature

-  It accepts the following parameter(s):
    - `$userId` (`string`) &mdash;
       Any user ID string (eg. email address, ID, username). Must be non empty. Set to false to de-assign a user id previously set.
- It returns a `$this` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getuseridhashed" id="getuseridhashed"></a>
<a name="getUserIdHashed" id="getUserIdHashed"></a>
### `getUserIdHashed()`

Hash function used internally by Matomo to hash a User ID into the Visitor ID.

Note: matches implementation of Tracker\Request->getUserIdHashed()

#### Signature

-  It accepts the following parameter(s):
    - `$id`
      
- It returns a `string` value.

<a name="setvisitorid" id="setvisitorid"></a>
<a name="setVisitorId" id="setVisitorId"></a>
### `setVisitorId()`

Forces the requests to be recorded for the specified Visitor ID.

Rather than letting Matomo attribute the user with a heuristic based on IP and other user fingeprinting attributes,
force the action to be recorded for a particular visitor.

If not set, the visitor ID will be fetched from the 1st party cookie, or will be set to a random UUID.

#### Signature

-  It accepts the following parameter(s):
    - `$visitorId` (`string`) &mdash;
       16 hexadecimal characters visitor ID, eg. "33c31e01394bdc63"
- It returns a `$this` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getvisitorid" id="getvisitorid"></a>
<a name="getVisitorId" id="getVisitorId"></a>
### `getVisitorId()`

If the user initiating the request has the Matomo first party cookie,
this function will try and return the ID parsed from this first party cookie (found in $_COOKIE).

If you call this function from a server, where the call is triggered by a cron or script
not initiated by the actual visitor being tracked, then it will return
the random Visitor ID that was assigned to this visit object.

This can be used if you wish to record more visits, actions or goals for this visitor ID later on.

#### Signature


- *Returns:*  `string` &mdash;
    16 hex chars visitor ID string

<a name="getuseragent" id="getuseragent"></a>
<a name="getUserAgent" id="getUserAgent"></a>
### `getUserAgent()`

Returns the currently set user agent.

#### Signature

- It returns a `string` value.

<a name="getip" id="getip"></a>
<a name="getIp" id="getIp"></a>
### `getIp()`

Returns the currently set IP address.

#### Signature

- It returns a `string` value.

<a name="getuserid" id="getuserid"></a>
<a name="getUserId" id="getUserId"></a>
### `getUserId()`

Returns the User ID string, which may have been set via:
    $v->setUserId('username@example.org');

#### Signature

- It returns a `bool` value.

<a name="deletecookies" id="deletecookies"></a>
<a name="deleteCookies" id="deleteCookies"></a>
### `deleteCookies()`

Deletes all first party cookies from the client

#### Signature

- It does not return anything or a mixed result.

<a name="getattributioninfo" id="getattributioninfo"></a>
<a name="getAttributionInfo" id="getAttributionInfo"></a>
### `getAttributionInfo()`

Returns the currently assigned Attribution Information stored in a first party cookie.

This function will only work if the user is initiating the current request, and his cookies
can be read by PHP from the $_COOKIE array.

#### See Also

- `matomo.js` &mdash; getAttributionInfo()

#### Signature


- *Returns:*  `string` &mdash;
    JSON Encoded string containing the Referrer information for Goal conversion attribution.
               Will return false if the cookie could not be found

<a name="settokenauth" id="settokenauth"></a>
<a name="setTokenAuth" id="setTokenAuth"></a>
### `setTokenAuth()`

Some Tracking API functionality requires express authentication, using either the
Super User token_auth, or a user with 'admin' access to the website.

The following features require access:
- force the visitor IP
- force the date &  time of the tracking requests rather than track for the current datetime

#### Signature

-  It accepts the following parameter(s):
    - `$token_auth` (`string`) &mdash;
       token_auth 32 chars token_auth string
- It returns a `$this` value.

<a name="setlocaltime" id="setlocaltime"></a>
<a name="setLocalTime" id="setLocalTime"></a>
### `setLocalTime()`

Sets local visitor time

#### Signature

-  It accepts the following parameter(s):
    - `$time` (`string`) &mdash;
       HH:MM:SS format
- It returns a `$this` value.

<a name="setresolution" id="setresolution"></a>
<a name="setResolution" id="setResolution"></a>
### `setResolution()`

Sets user resolution width and height.

#### Signature

-  It accepts the following parameter(s):
    - `$width` (`int`) &mdash;
      
    - `$height` (`int`) &mdash;
      
- It returns a `$this` value.

<a name="setbrowserhascookies" id="setbrowserhascookies"></a>
<a name="setBrowserHasCookies" id="setBrowserHasCookies"></a>
### `setBrowserHasCookies()`

Sets if the browser supports cookies
This is reported in "List of plugins" report in Matomo.

#### Signature

-  It accepts the following parameter(s):
    - `$bool` (`bool`) &mdash;
      
- It returns a `$this` value.

<a name="setdebugstringappend" id="setdebugstringappend"></a>
<a name="setDebugStringAppend" id="setDebugStringAppend"></a>
### `setDebugStringAppend()`

Will append a custom string at the end of the Tracking request.

#### Signature

-  It accepts the following parameter(s):
    - `$string` (`string`) &mdash;
      
- It returns a `$this` value.

<a name="setplugins" id="setplugins"></a>
<a name="setPlugins" id="setPlugins"></a>
### `setPlugins()`

Sets visitor browser supported plugins

#### Signature

-  It accepts the following parameter(s):
    - `$flash` (`bool`) &mdash;
      
    - `$java` (`bool`) &mdash;
      
    - `$quickTime` (`bool`) &mdash;
      
    - `$realPlayer` (`bool`) &mdash;
      
    - `$pdf` (`bool`) &mdash;
      
    - `$windowsMedia` (`bool`) &mdash;
      
    - `$silverlight` (`bool`) &mdash;
      
- It returns a `$this` value.

<a name="disablecookiesupport" id="disablecookiesupport"></a>
<a name="disableCookieSupport" id="disableCookieSupport"></a>
### `disableCookieSupport()`

By default, MatomoTracker will read first party cookies
from the request and write updated cookies in the response (using setrawcookie).

This can be disabled by calling this function.

#### Signature

- It does not return anything or a mixed result.

<a name="getrequesttimeout" id="getrequesttimeout"></a>
<a name="getRequestTimeout" id="getRequestTimeout"></a>
### `getRequestTimeout()`

Returns the maximum number of seconds the tracker will spend waiting for a response
from Matomo. Defaults to 600 seconds.

#### Signature

- It does not return anything or a mixed result.

<a name="setrequesttimeout" id="setrequesttimeout"></a>
<a name="setRequestTimeout" id="setRequestTimeout"></a>
### `setRequestTimeout()`

Sets the maximum number of seconds that the tracker will spend waiting for a response
from Matomo.

#### Signature

-  It accepts the following parameter(s):
    - `$timeout` (`int`) &mdash;
      
- It returns a `$this` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="setrequestmethodnonbulk" id="setrequestmethodnonbulk"></a>
<a name="setRequestMethodNonBulk" id="setRequestMethodNonBulk"></a>
### `setRequestMethodNonBulk()`

Sets the request method to POST, which is recommended when using setTokenAuth()
to prevent the token from being recorded in server logs. Avoid using redirects
when using POST to prevent the loss of POST values. When using Log Analytics,
be aware that POST requests are not parseable/replayable.

#### Signature

-  It accepts the following parameter(s):
    - `$method` (`string`) &mdash;
       Either 'POST' or 'GET'
- It returns a `$this` value.

<a name="setproxy" id="setproxy"></a>
<a name="setProxy" id="setProxy"></a>
### `setProxy()`

If a proxy is needed to look up the address of the Matomo site, set it with this

#### Signature

-  It accepts the following parameter(s):
    - `$proxy` (`string`) &mdash;
       IP as string, for example "173.234.92.107"
    - `$proxyPort` (`int`) &mdash;
      
- It does not return anything or a mixed result.

<a name="setoutgoingtrackercookie" id="setoutgoingtrackercookie"></a>
<a name="setOutgoingTrackerCookie" id="setOutgoingTrackerCookie"></a>
### `setOutgoingTrackerCookie()`

Sets a cookie to be sent to the tracking server.

#### Signature

-  It accepts the following parameter(s):
    - `$name`
      
    - `$value`
      
- It does not return anything or a mixed result.

<a name="getincomingtrackercookie" id="getincomingtrackercookie"></a>
<a name="getIncomingTrackerCookie" id="getIncomingTrackerCookie"></a>
### `getIncomingTrackerCookie()`

Gets a cookie which was set by the tracking server.

#### Signature

-  It accepts the following parameter(s):
    - `$name`
      

- *Returns:*  `bool`|`string` &mdash;
    


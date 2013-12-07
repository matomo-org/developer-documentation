PiwikTracker
============

PiwikTracker implements the Piwik Tracking API.

Properties
----------

This class defines the following properties:

- [`$URL`](#$url) &mdash; Piwik base URL, for example http://example.org/piwik/ Must be set before using the class by calling  PiwikTracker::$URL = 'http://yourwebsite.org/piwik/';
- [`$DEBUG_APPEND_URL`](#$debug_append_url)
- [`$DEBUG_LAST_REQUESTED_URL`](#$debug_last_requested_url) &mdash; Used in tests to output useful error messages.

<a name="$url" id="$url"></a>
<a name="URL" id="URL"></a>
### `$URL`

Piwik base URL, for example http://example.org/piwik/ Must be set before using the class by calling  PiwikTracker::$URL = 'http://yourwebsite.org/piwik/';

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

- [`__construct()`](#__construct) &mdash; Builds a PiwikTracker object, used to track visits, pages and Goal conversions for a specific website, by using the Piwik Tracking API.
- [`setPageCharset()`](#setpagecharset) &mdash; By default, Piwik expects utf-8 encoded values, for example for the page URL parameter values, Page Title, etc.
- [`setUrl()`](#seturl) &mdash; Sets the current URL being tracked
- [`setUrlReferrer()`](#seturlreferrer) &mdash; Sets the URL referrer used to track Referrers details for new visits.
- [`setGenerationTime()`](#setgenerationtime) &mdash; Sets the time that generating the document on the server side took.
- [`setUrlReferer()`](#seturlreferer)
- [`setAttributionInfo()`](#setattributioninfo) &mdash; Sets the attribution information to the visit, so that subsequent Goal conversions are properly attributed to the right Referrer URL, timestamp, Campaign Name & Keyword.
- [`setCustomVariable()`](#setcustomvariable) &mdash; Sets Visit Custom Variable.
- [`getCustomVariable()`](#getcustomvariable) &mdash; Returns the currently assigned Custom Variable.
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
- [`doTrackPageView()`](#dotrackpageview) &mdash; Tracks a page view
- [`doTrackEvent()`](#dotrackevent) &mdash; Tracks an event
- [`doTrackSiteSearch()`](#dotracksitesearch) &mdash; Tracks an internal Site Search query, and optionally tracks the Search Category, and Search results Count.
- [`doTrackGoal()`](#dotrackgoal) &mdash; Records a Goal conversion
- [`doTrackAction()`](#dotrackaction) &mdash; Tracks a download or outlink
- [`addEcommerceItem()`](#addecommerceitem) &mdash; Adds an item in the Ecommerce order.
- [`doTrackEcommerceCartUpdate()`](#dotrackecommercecartupdate) &mdash; Tracks a Cart Update (add item, remove item, update item).
- [`doBulkTrack()`](#dobulktrack) &mdash; Sends all stored tracking actions at once.
- [`doTrackEcommerceOrder()`](#dotrackecommerceorder) &mdash; Tracks an Ecommerce order.
- [`setEcommerceView()`](#setecommerceview) &mdash; Sets the current page view as an item (product) page view, or an Ecommerce Category page view.
- [`getUrlTrackPageView()`](#geturltrackpageview) &mdash; Builds URL to track a page view.
- [`getUrlTrackEvent()`](#geturltrackevent) &mdash; Builds URL to track a custom event.
- [`getUrlTrackSiteSearch()`](#geturltracksitesearch) &mdash; Builds URL to track a site search.
- [`getUrlTrackGoal()`](#geturltrackgoal) &mdash; Builds URL to track a goal with idGoal and revenue.
- [`getUrlTrackAction()`](#geturltrackaction) &mdash; Builds URL to track a new action.
- [`setForceVisitDateTime()`](#setforcevisitdatetime) &mdash; Overrides server date and time for the tracking requests.
- [`setIp()`](#setip) &mdash; Overrides IP address
- [`setVisitorId()`](#setvisitorid) &mdash; Forces the requests to be recorded for the specified Visitor ID rather than using the heuristics based on IP and other attributes.
- [`getVisitorId()`](#getvisitorid) &mdash; If the user initiating the request has the Piwik first party cookie, this function will try and return the ID parsed from this first party cookie (found in $_COOKIE).
- [`deleteCookies()`](#deletecookies) &mdash; Deletes all first party cookies from the client
- [`getAttributionInfo()`](#getattributioninfo) &mdash; Returns the currently assigned Attribution Information stored in a first party cookie.
- [`setTokenAuth()`](#settokenauth) &mdash; Some Tracking API functionnality requires express authentication, using either the Super User token_auth, or a user with 'admin' access to the website.
- [`setLocalTime()`](#setlocaltime) &mdash; Sets local visitor time
- [`setResolution()`](#setresolution) &mdash; Sets user resolution width and height.
- [`setBrowserHasCookies()`](#setbrowserhascookies) &mdash; Sets if the browser supports cookies This is reported in "List of plugins" report in Piwik.
- [`setDebugStringAppend()`](#setdebugstringappend) &mdash; Will append a custom string at the end of the Tracking request.
- [`setPlugins()`](#setplugins) &mdash; Sets visitor browser supported plugins
- [`disableCookieSupport()`](#disablecookiesupport) &mdash; By default, PiwikTracker will read first party cookies from the request and write updated cookies in the response (using setrawcookie).
- [`getRequestTimeout()`](#getrequesttimeout) &mdash; Returns the maximum number of seconds the tracker will spend waiting for a response from Piwik.
- [`setRequestTimeout()`](#setrequesttimeout) &mdash; Sets the maximum number of seconds that the tracker will spend waiting for a response from Piwik.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Builds a PiwikTracker object, used to track visits, pages and Goal conversions for a specific website, by using the Piwik Tracking API.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$idSite` (`int`) &mdash;

      <div markdown="1" class="param-desc"> Id site to be tracked</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$apiUrl` (`string`) &mdash;

      <div markdown="1" class="param-desc"> "http://example.org/piwik/" or "http://piwik.example.org/" If set, will overwrite PiwikTracker::$URL</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="setpagecharset" id="setpagecharset"></a>
<a name="setPageCharset" id="setPageCharset"></a>
### `setPageCharset()`

By default, Piwik expects utf-8 encoded values, for example for the page URL parameter values, Page Title, etc.

#### Description

It is recommended to only send UTF-8 data to Piwik.
If required though, you can also specify another charset using this function.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$charset` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="seturl" id="seturl"></a>
<a name="setUrl" id="setUrl"></a>
### `setUrl()`

Sets the current URL being tracked

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Raw URL (not URL encoded)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="seturlreferrer" id="seturlreferrer"></a>
<a name="setUrlReferrer" id="setUrlReferrer"></a>
### `setUrlReferrer()`

Sets the URL referrer used to track Referrers details for new visits.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Raw URL (not URL encoded)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setgenerationtime" id="setgenerationtime"></a>
<a name="setGenerationTime" id="setGenerationTime"></a>
### `setGenerationTime()`

Sets the time that generating the document on the server side took.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$timeMs` (`int`) &mdash;

      <div markdown="1" class="param-desc"> Generation time in ms</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="seturlreferer" id="seturlreferer"></a>
<a name="setUrlReferer" id="setUrlReferer"></a>
### `setUrlReferer()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setattributioninfo" id="setattributioninfo"></a>
<a name="setAttributionInfo" id="setAttributionInfo"></a>
### `setAttributionInfo()`

Sets the attribution information to the visit, so that subsequent Goal conversions are properly attributed to the right Referrer URL, timestamp, Campaign Name & Keyword.

#### Description

This must be a JSON encoded string that would typically be fetched from the JS API:
piwikTracker.getAttributionInfo() and that you have JSON encoded via JSON2.stringify()

If you call enableCookies() then these referral attribution values will be set
to the 'ref' first party cookie storing referral information.

#### See Also

- `function` &mdash; getAttributionInfo() in https://github.com/piwik/piwik/blob/master/js/piwik.js

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$jsonEncoded` (`string`) &mdash;

      <div markdown="1" class="param-desc"> JSON encoded array containing Attribution info</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="setcustomvariable" id="setcustomvariable"></a>
<a name="setCustomVariable" id="setCustomVariable"></a>
### `setCustomVariable()`

Sets Visit Custom Variable.

#### Description

See http://piwik.org/docs/custom-variables/

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$id` (`int`) &mdash;

      <div markdown="1" class="param-desc"> Custom variable slot ID from 1-5</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Custom variable name</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Custom variable value</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$scope` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Custom variable scope. Possible values: visit, page, event</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getcustomvariable" id="getcustomvariable"></a>
<a name="getCustomVariable" id="getCustomVariable"></a>
### `getCustomVariable()`

Returns the currently assigned Custom Variable.

#### Description

If scope is 'visit', it will attempt to read the value set in the first party cookie created by Piwik Tracker ($_COOKIE array).

#### See Also

- `Piwik.js` &mdash; getCustomVariable()

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$id` (`int`) &mdash;

      <div markdown="1" class="param-desc"> Custom Variable integer index to fetch from cookie. Should be a value from 1 to 5</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$scope` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Custom variable scope. Possible values: visit, page, event</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ An array with this format: array( 0 => CustomVariableName, 1 => CustomVariableValue ) or false
    - `mixed`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="setnewvisitorid" id="setnewvisitorid"></a>
<a name="setNewVisitorId" id="setNewVisitorId"></a>
### `setNewVisitorId()`

Sets the current visitor ID to a random new one.

#### Signature

- It does not return anything.

<a name="setidsite" id="setidsite"></a>
<a name="setIdSite" id="setIdSite"></a>
### `setIdSite()`

Sets the current site ID.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$idSite` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setbrowserlanguage" id="setbrowserlanguage"></a>
<a name="setBrowserLanguage" id="setBrowserLanguage"></a>
### `setBrowserLanguage()`

Sets the Browser language.

#### Description

Used to guess visitor countries when GeoIP is not enabled

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$acceptLanguage` (`string`) &mdash;

      <div markdown="1" class="param-desc"> For example "fr-fr"</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setuseragent" id="setuseragent"></a>
<a name="setUserAgent" id="setUserAgent"></a>
### `setUserAgent()`

Sets the user agent, used to detect OS and browser.

#### Description

If this function is not called, the User Agent will default to the current user agent.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$userAgent` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setcountry" id="setcountry"></a>
<a name="setCountry" id="setCountry"></a>
### `setCountry()`

Sets the country of the visitor.

#### Description

If not used, Piwik will try to find the country
using either the visitor's IP address or language.

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$country` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setregion" id="setregion"></a>
<a name="setRegion" id="setRegion"></a>
### `setRegion()`

Sets the region of the visitor.

#### Description

If not used, Piwik may try to find the region
using the visitor's IP address (if configured to do so).

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$region` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setcity" id="setcity"></a>
<a name="setCity" id="setCity"></a>
### `setCity()`

Sets the city of the visitor.

#### Description

If not used, Piwik may try to find the city
using the visitor's IP address (if configured to do so).

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$city` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setlatitude" id="setlatitude"></a>
<a name="setLatitude" id="setLatitude"></a>
### `setLatitude()`

Sets the latitude of the visitor.

#### Description

If not used, Piwik may try to find the visitor's
latitude using the visitor's IP address (if configured to do so).

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$lat` (`float`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setlongitude" id="setlongitude"></a>
<a name="setLongitude" id="setLongitude"></a>
### `setLongitude()`

Sets the longitude of the visitor.

#### Description

If not used, Piwik may try to find the visitor's
longitude using the visitor's IP address (if configured to do so).

Allowed only for Admin/Super User, must be used along with setTokenAuth().

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$long` (`float`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="enablebulktracking" id="enablebulktracking"></a>
<a name="enableBulkTracking" id="enableBulkTracking"></a>
### `enableBulkTracking()`

Enables the bulk request feature.

#### Description

When used, each tracking action is stored until the
doBulkTrack method is called. This method will send all tracking data at once.

#### Signature

- It does not return anything.

<a name="enablecookies" id="enablecookies"></a>
<a name="enableCookies" id="enableCookies"></a>
### `enableCookies()`

Enable Cookie Creation - this will cause a first party VisitorId cookie to be set when the VisitorId is set or reset

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$domain` (`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Set first-party cookie domain. Accepted values: example.com, *.example.com (same as .example.com) or subdomain.example.com</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$path` (`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Set first-party cookie path</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="dotrackpageview" id="dotrackpageview"></a>
<a name="doTrackPageView" id="doTrackPageView"></a>
### `doTrackPageView()`

Tracks a page view

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$documentTitle` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Page title as it will appear in the Actions > Page titles report</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ Response string or true if using bulk requests.
    - `mixed`

<a name="dotrackevent" id="dotrackevent"></a>
<a name="doTrackEvent" id="doTrackEvent"></a>
### `doTrackEvent()`

Tracks an event

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$category` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The Event Category (Videos, Music, Games...)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$action` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The Event's Action (Play, Pause, Duration, Add Playlist, Downloaded, Clicked...)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) The Event's object Name (a particular Movie name, or Song name, or File name...)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`float`) &mdash;

      <div markdown="1" class="param-desc"> (optional) The Event's value</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ Response string or true if using bulk requests.
    - `mixed`

<a name="dotracksitesearch" id="dotracksitesearch"></a>
<a name="doTrackSiteSearch" id="doTrackSiteSearch"></a>
### `doTrackSiteSearch()`

Tracks an internal Site Search query, and optionally tracks the Search Category, and Search results Count.

#### Description

These are used to populate reports in Actions > Site Search.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$keyword` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Searched query on the site</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$category` (`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Search engine category if applicable</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$countResults` (`bool`|`int`) &mdash;

      <div markdown="1" class="param-desc"> (optional) results displayed on the search result page. Used to track "zero result" keywords.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ Response or true if using bulk requests.
    - `mixed`

<a name="dotrackgoal" id="dotrackgoal"></a>
<a name="doTrackGoal" id="doTrackGoal"></a>
### `doTrackGoal()`

Records a Goal conversion

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$idGoal` (`int`) &mdash;

      <div markdown="1" class="param-desc"> Id Goal to record a conversion</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$revenue` (`float`) &mdash;

      <div markdown="1" class="param-desc"> Revenue for this conversion</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ Response or true if using bulk request
    - `mixed`

<a name="dotrackaction" id="dotrackaction"></a>
<a name="doTrackAction" id="doTrackAction"></a>
### `doTrackAction()`

Tracks a download or outlink

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$actionUrl` (`string`) &mdash;

      <div markdown="1" class="param-desc"> URL of the download or outlink</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$actionType` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Type of the action: 'download' or 'link'</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ Response or true if using bulk request
    - `mixed`

<a name="addecommerceitem" id="addecommerceitem"></a>
<a name="addEcommerceItem" id="addEcommerceItem"></a>
### `addEcommerceItem()`

Adds an item in the Ecommerce order.

#### Description

This should be called before doTrackEcommerceOrder(), or before doTrackEcommerceCartUpdate().
This function can be called for all individual products in the cart (or order).
SKU parameter is mandatory. Other parameters are optional (set to false if value not known).
Ecommerce items added via this function are automatically cleared when doTrackEcommerceOrder() or getUrlTrackEcommerceOrder() is called.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sku` (`string`) &mdash;

      <div markdown="1" class="param-desc"> (required) SKU, Product identifier</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Product name</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$category` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Product category, or array of product categories (up to 5 categories can be specified for a given product)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$price` (`float`|`int`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Individual product price (supports integer and decimal prices)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$quantity` (`int`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Product quantity. If not specified, will default to 1 in the Reports</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="dotrackecommercecartupdate" id="dotrackecommercecartupdate"></a>
<a name="doTrackEcommerceCartUpdate" id="doTrackEcommerceCartUpdate"></a>
### `doTrackEcommerceCartUpdate()`

Tracks a Cart Update (add item, remove item, update item).

#### Description

On every Cart update, you must call addEcommerceItem() for each item (product) in the cart,
including the items that haven't been updated since the last cart update.
Items which were in the previous cart and are not sent in later Cart updates will be deleted from the cart (in the database).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$grandTotal` (`float`) &mdash;

      <div markdown="1" class="param-desc"> Cart grandTotal (typically the sum of all items' prices)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ Response or true if using bulk request
    - `mixed`

<a name="dobulktrack" id="dobulktrack"></a>
<a name="doBulkTrack" id="doBulkTrack"></a>
### `doBulkTrack()`

Sends all stored tracking actions at once.

#### Description

Only has an effect if bulk tracking is enabled.

To enable bulk tracking, call enableBulkTracking().

#### Signature

- _Returns:_ Response
    - `string`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="dotrackecommerceorder" id="dotrackecommerceorder"></a>
<a name="doTrackEcommerceOrder" id="doTrackEcommerceOrder"></a>
### `doTrackEcommerceOrder()`

Tracks an Ecommerce order.

#### Description

If the Ecommerce order contains items (products), you must call first the addEcommerceItem() for each item in the order.
All revenues (grandTotal, subTotal, tax, shipping, discount) will be individually summed and reported in Piwik reports.
Only the parameters $orderId and $grandTotal are required.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$orderId` (`string`|`int`) &mdash;

      <div markdown="1" class="param-desc"> (required) Unique Order ID. This will be used to count this order only once in the event the order page is reloaded several times. orderId must be unique for each transaction, even on different days, or the transaction will not be recorded by Piwik.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$grandTotal` (`float`) &mdash;

      <div markdown="1" class="param-desc"> (required) Grand Total revenue of the transaction (including tax, shipping, etc.)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$subTotal` (`float`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Sub total amount, typically the sum of items prices for all items in this order (before Tax and Shipping costs are applied)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tax` (`float`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Tax amount for this order</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$shipping` (`float`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Shipping amount for this order</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$discount` (`float`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Discounted amount in this order</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ Response or true if using bulk request
    - `mixed`

<a name="setecommerceview" id="setecommerceview"></a>
<a name="setEcommerceView" id="setEcommerceView"></a>
### `setEcommerceView()`

Sets the current page view as an item (product) page view, or an Ecommerce Category page view.

#### Description

This must be called before doTrackPageView() on this product/category page.
It will set 3 custom variables of scope "page" with the SKU, Name and Category for this page view.
Note: Custom Variables of scope "page" slots 3, 4 and 5 will be used.

On a category page, you may set the parameter $category only and set the other parameters to false.

Tracking Product/Category page views will allow Piwik to report on Product & Categories
conversion rates (Conversion rate = Ecommerce orders containing this product or category / Visits to the product or category)

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sku` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Product SKU being viewed</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Product Name being viewed</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$category` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> Category being viewed. On a Product page, this is the product's category. You can also specify an array of up to 5 categories for a given page view.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$price` (`float`) &mdash;

      <div markdown="1" class="param-desc"> Specify the price at which the item was displayed</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="geturltrackpageview" id="geturltrackpageview"></a>
<a name="getUrlTrackPageView" id="getUrlTrackPageView"></a>
### `getUrlTrackPageView()`

Builds URL to track a page view.

#### See Also

- `doTrackPageView()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$documentTitle` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Page view name as it will appear in Piwik reports</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ URL to piwik.php with all parameters set to track the pageview
    - `string`

<a name="geturltrackevent" id="geturltrackevent"></a>
<a name="getUrlTrackEvent" id="getUrlTrackEvent"></a>
### `getUrlTrackEvent()`

Builds URL to track a custom event.

#### See Also

- `doTrackEvent()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$category` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The Event Category (Videos, Music, Games...)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$action` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The Event's Action (Play, Pause, Duration, Add Playlist, Downloaded, Clicked...)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) The Event's object Name (a particular Movie name, or Song name, or File name...)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`float`) &mdash;

      <div markdown="1" class="param-desc"> (optional) The Event's value</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ URL to piwik.php with all parameters set to track the pageview
    - `string`

<a name="geturltracksitesearch" id="geturltracksitesearch"></a>
<a name="getUrlTrackSiteSearch" id="getUrlTrackSiteSearch"></a>
### `getUrlTrackSiteSearch()`

Builds URL to track a site search.

#### See Also

- `doTrackSiteSearch()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$keyword` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$category` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$countResults` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="geturltrackgoal" id="geturltrackgoal"></a>
<a name="getUrlTrackGoal" id="getUrlTrackGoal"></a>
### `getUrlTrackGoal()`

Builds URL to track a goal with idGoal and revenue.

#### See Also

- `doTrackGoal()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$idGoal` (`int`) &mdash;

      <div markdown="1" class="param-desc"> Id Goal to record a conversion</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$revenue` (`float`) &mdash;

      <div markdown="1" class="param-desc"> Revenue for this conversion</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ URL to piwik.php with all parameters set to track the goal conversion
    - `string`

<a name="geturltrackaction" id="geturltrackaction"></a>
<a name="getUrlTrackAction" id="getUrlTrackAction"></a>
### `getUrlTrackAction()`

Builds URL to track a new action.

#### See Also

- `doTrackAction()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$actionUrl` (`string`) &mdash;

      <div markdown="1" class="param-desc"> URL of the download or outlink</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$actionType` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Type of the action: 'download' or 'link'</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ URL to piwik.php with all parameters set to track an action
    - `string`

<a name="setforcevisitdatetime" id="setforcevisitdatetime"></a>
<a name="setForceVisitDateTime" id="setForceVisitDateTime"></a>
### `setForceVisitDateTime()`

Overrides server date and time for the tracking requests.

#### Description

By default Piwik will track requests for the "current datetime" but this function allows you
to track visits in the past. All times are in UTC.

Allowed only for Super User, must be used along with setTokenAuth()

#### See Also

- `setTokenAuth()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$dateTime` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Date with the format 'Y-m-d H:i:s', or a UNIX timestamp</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setip" id="setip"></a>
<a name="setIp" id="setIp"></a>
### `setIp()`

Overrides IP address

#### Description

Allowed only for Super User, must be used along with setTokenAuth()

#### See Also

- `setTokenAuth()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ip` (`string`) &mdash;

      <div markdown="1" class="param-desc"> IP string, eg. 130.54.2.1</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setvisitorid" id="setvisitorid"></a>
<a name="setVisitorId" id="setVisitorId"></a>
### `setVisitorId()`

Forces the requests to be recorded for the specified Visitor ID rather than using the heuristics based on IP and other attributes.

#### Description

Allowed only for Admin/Super User, must be used along with setTokenAuth().

You may set the Visitor ID based on a user attribute, for example the user email:
     $v->setVisitorId( substr(md5( $userEmail ), 0, 16));

If not set, the visitor ID will be fetched from the 1st party cookie, or will be set to a random UUID.

#### See Also

- `setTokenAuth()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$visitorId` (`string`) &mdash;

      <div markdown="1" class="param-desc"> 16 hexadecimal characters visitor ID, eg. "33c31e01394bdc63"</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getvisitorid" id="getvisitorid"></a>
<a name="getVisitorId" id="getVisitorId"></a>
### `getVisitorId()`

If the user initiating the request has the Piwik first party cookie, this function will try and return the ID parsed from this first party cookie (found in $_COOKIE).

#### Description

If you call this function from a server, where the call is triggered by a cron or script
not initiated by the actual visitor being tracked, then it will return
the random Visitor ID that was assigned to this visit object.

This can be used if you wish to record more visits, actions or goals for this visitor ID later on.

#### Signature

- _Returns:_ 16 hex chars visitor ID string
    - `string`

<a name="deletecookies" id="deletecookies"></a>
<a name="deleteCookies" id="deleteCookies"></a>
### `deleteCookies()`

Deletes all first party cookies from the client

#### Signature

- It does not return anything.

<a name="getattributioninfo" id="getattributioninfo"></a>
<a name="getAttributionInfo" id="getAttributionInfo"></a>
### `getAttributionInfo()`

Returns the currently assigned Attribution Information stored in a first party cookie.

#### Description

This function will only work if the user is initiating the current request, and his cookies
can be read by PHP from the $_COOKIE array.

#### See Also

- `Piwik.js` &mdash; getAttributionInfo()

#### Signature

- _Returns:_ JSON Encoded string containing the Referrer information for Goal conversion attribution. Will return false if the cookie could not be found
    - `string`

<a name="settokenauth" id="settokenauth"></a>
<a name="setTokenAuth" id="setTokenAuth"></a>
### `setTokenAuth()`

Some Tracking API functionnality requires express authentication, using either the Super User token_auth, or a user with 'admin' access to the website.

#### Description

The following features require access:
- force the visitor IP
- force the date & time of the tracking requests rather than track for the current datetime
- force Piwik to track the requests to a specific VisitorId rather than use the standard visitor matching heuristic

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$token_auth` (`string`) &mdash;

      <div markdown="1" class="param-desc"> token_auth 32 chars token_auth string</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setlocaltime" id="setlocaltime"></a>
<a name="setLocalTime" id="setLocalTime"></a>
### `setLocalTime()`

Sets local visitor time

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$time` (`string`) &mdash;

      <div markdown="1" class="param-desc"> HH:MM:SS format</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setresolution" id="setresolution"></a>
<a name="setResolution" id="setResolution"></a>
### `setResolution()`

Sets user resolution width and height.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$width` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$height` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setbrowserhascookies" id="setbrowserhascookies"></a>
<a name="setBrowserHasCookies" id="setBrowserHasCookies"></a>
### `setBrowserHasCookies()`

Sets if the browser supports cookies This is reported in "List of plugins" report in Piwik.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$bool` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setdebugstringappend" id="setdebugstringappend"></a>
<a name="setDebugStringAppend" id="setDebugStringAppend"></a>
### `setDebugStringAppend()`

Will append a custom string at the end of the Tracking request.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$string` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setplugins" id="setplugins"></a>
<a name="setPlugins" id="setPlugins"></a>
### `setPlugins()`

Sets visitor browser supported plugins

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$flash` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$java` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$director` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$quickTime` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$realPlayer` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$pdf` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$windowsMedia` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$gears` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$silverlight` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="disablecookiesupport" id="disablecookiesupport"></a>
<a name="disableCookieSupport" id="disableCookieSupport"></a>
### `disableCookieSupport()`

By default, PiwikTracker will read first party cookies from the request and write updated cookies in the response (using setrawcookie).

#### Description

This can be disabled by calling this function.

#### Signature

- It does not return anything.

<a name="getrequesttimeout" id="getrequesttimeout"></a>
<a name="getRequestTimeout" id="getRequestTimeout"></a>
### `getRequestTimeout()`

Returns the maximum number of seconds the tracker will spend waiting for a response from Piwik.

#### Description

Defaults to 600 seconds.

#### Signature

- It does not return anything.

<a name="setrequesttimeout" id="setrequesttimeout"></a>
<a name="setRequestTimeout" id="setRequestTimeout"></a>
### `setRequestTimeout()`

Sets the maximum number of seconds that the tracker will spend waiting for a response from Piwik.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$timeout` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


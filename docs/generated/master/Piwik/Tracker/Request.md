<small>Piwik\Tracker</small>

Request
=======

Piwik - Open source web analytics


Constants
---------

This class defines the following constants:

- `UNKNOWN_RESOLUTION`
- `GENERATION_TIME_MS_MAXIMUM`

Properties
----------

This class defines the following properties:

- [`$params`](#$params)
- [`$forcedVisitorId`](#$forcedvisitorid)
- [`$isAuthenticated`](#$isauthenticated)

<a name="params" id="params"></a>
### `$params`

#### Signature

- It is a(n) `array` value.

<a name="forcedvisitorid" id="forcedvisitorid"></a>
### `$forcedVisitorId`

#### Signature

- Its type is not specified.


<a name="isauthenticated" id="isauthenticated"></a>
### `$isAuthenticated`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`isAuthenticated()`](#isauthenticated)
- [`authenticateTrackingApi()`](#authenticatetrackingapi) &mdash; This method allows to set custom IP + server time + visitor ID, when using Tracking API.
- [`authenticateSuperUserOrAdmin()`](#authenticatesuperuseroradmin)
- [`getDaysSinceFirstVisit()`](#getdayssincefirstvisit)
- [`getDaysSinceLastOrder()`](#getdayssincelastorder)
- [`getDaysSinceLastVisit()`](#getdayssincelastvisit)
- [`getVisitCount()`](#getvisitcount)
- [`getBrowserLanguage()`](#getbrowserlanguage) &mdash; Returns the language the visitor is viewing.
- [`getLocalTime()`](#getlocaltime)
- [`getCurrentDate()`](#getcurrentdate) &mdash; Returns the current date in the "Y-m-d" PHP format
- [`getGoalRevenue()`](#getgoalrevenue)
- [`getParam()`](#getparam)
- [`getCurrentTimestamp()`](#getcurrenttimestamp)
- [`isTimestampValid()`](#istimestampvalid)
- [`getIdSite()`](#getidsite)
- [`getUserAgent()`](#getuseragent)
- [`getCustomVariables()`](#getcustomvariables)
- [`truncateCustomVariable()`](#truncatecustomvariable)
- [`shouldUseThirdPartyCookie()`](#shouldusethirdpartycookie)
- [`setThirdPartyCookie()`](#setthirdpartycookie) &mdash; Update the cookie information.
- [`makeThirdPartyCookie()`](#makethirdpartycookie)
- [`getCookieName()`](#getcookiename)
- [`getCookieExpire()`](#getcookieexpire)
- [`getCookiePath()`](#getcookiepath)
- [`getVisitorId()`](#getvisitorid) &mdash; Is the request for a known VisitorId, based on 1st party, 3rd party (optional) cookies or Tracking API forced Visitor ID
- [`getIp()`](#getip)
- [`setForceIp()`](#setforceip)
- [`setForceDateTime()`](#setforcedatetime)
- [`setForcedVisitorId()`](#setforcedvisitorid)
- [`getForcedVisitorId()`](#getforcedvisitorid)
- [`overrideLocation()`](#overridelocation)
- [`getPlugins()`](#getplugins)
- [`getParamsCount()`](#getparamscount)
- [`getPageGenerationTime()`](#getpagegenerationtime)

<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

- It accepts the following parameter(s):
    - `$params`
    - `$tokenAuth`
- It does not return anything.

<a name="isauthenticated" id="isauthenticated"></a>
### `isAuthenticated()`

#### Signature

- It returns a(n) `bool` value.

<a name="authenticatetrackingapi" id="authenticatetrackingapi"></a>
### `authenticateTrackingApi()`

This method allows to set custom IP + server time + visitor ID, when using Tracking API.

#### Description

These two attributes can be only set by the Super User (passing token_auth).

#### Signature

- It accepts the following parameter(s):
    - `$tokenAuthFromBulkRequest`
- It does not return anything.

<a name="authenticatesuperuseroradmin" id="authenticatesuperuseroradmin"></a>
### `authenticateSuperUserOrAdmin()`

#### Signature

- It accepts the following parameter(s):
    - `$tokenAuth`
    - `$idSite`
- It does not return anything.

<a name="getdayssincefirstvisit" id="getdayssincefirstvisit"></a>
### `getDaysSinceFirstVisit()`

#### Signature

- It can return one of the following values:
    - `float`
    - `int`

<a name="getdayssincelastorder" id="getdayssincelastorder"></a>
### `getDaysSinceLastOrder()`

#### Signature

- It can return one of the following values:
    - `bool`
    - `float`
    - `int`

<a name="getdayssincelastvisit" id="getdayssincelastvisit"></a>
### `getDaysSinceLastVisit()`

#### Signature

- It can return one of the following values:
    - `float`
    - `int`

<a name="getvisitcount" id="getvisitcount"></a>
### `getVisitCount()`

#### Signature

- It can return one of the following values:
    - `int`
    - `mixed`

<a name="getbrowserlanguage" id="getbrowserlanguage"></a>
### `getBrowserLanguage()`

Returns the language the visitor is viewing.

#### Signature

- _Returns:_ browser language code, eg. "en-gb,en;q=0.5"
    - `string`

<a name="getlocaltime" id="getlocaltime"></a>
### `getLocalTime()`

#### Signature

- It returns a(n) `string` value.

<a name="getcurrentdate" id="getcurrentdate"></a>
### `getCurrentDate()`

Returns the current date in the "Y-m-d" PHP format

#### Signature

- It accepts the following parameter(s):
    - `$format`
- It returns a(n) `string` value.

<a name="getgoalrevenue" id="getgoalrevenue"></a>
### `getGoalRevenue()`

#### Signature

- It accepts the following parameter(s):
    - `$defaultGoalRevenue`
- It does not return anything.

<a name="getparam" id="getparam"></a>
### `getParam()`

#### Signature

- It accepts the following parameter(s):
    - `$name`
- It does not return anything.

<a name="getcurrenttimestamp" id="getcurrenttimestamp"></a>
### `getCurrentTimestamp()`

#### Signature

- It does not return anything.

<a name="istimestampvalid" id="istimestampvalid"></a>
### `isTimestampValid()`

#### Signature

- It accepts the following parameter(s):
    - `$time`
- It does not return anything.

<a name="getidsite" id="getidsite"></a>
### `getIdSite()`

#### Signature

- It does not return anything.

<a name="getuseragent" id="getuseragent"></a>
### `getUserAgent()`

#### Signature

- It does not return anything.

<a name="getcustomvariables" id="getcustomvariables"></a>
### `getCustomVariables()`

#### Signature

- It accepts the following parameter(s):
    - `$scope`
- It does not return anything.

<a name="truncatecustomvariable" id="truncatecustomvariable"></a>
### `truncateCustomVariable()`

#### Signature

- It accepts the following parameter(s):
    - `$input`
- It does not return anything.

<a name="shouldusethirdpartycookie" id="shouldusethirdpartycookie"></a>
### `shouldUseThirdPartyCookie()`

#### Signature

- It does not return anything.

<a name="setthirdpartycookie" id="setthirdpartycookie"></a>
### `setThirdPartyCookie()`

Update the cookie information.

#### Signature

- It accepts the following parameter(s):
    - `$idVisitor`
- It does not return anything.

<a name="makethirdpartycookie" id="makethirdpartycookie"></a>
### `makeThirdPartyCookie()`

#### Signature

- It does not return anything.

<a name="getcookiename" id="getcookiename"></a>
### `getCookieName()`

#### Signature

- It does not return anything.

<a name="getcookieexpire" id="getcookieexpire"></a>
### `getCookieExpire()`

#### Signature

- It does not return anything.

<a name="getcookiepath" id="getcookiepath"></a>
### `getCookiePath()`

#### Signature

- It does not return anything.

<a name="getvisitorid" id="getvisitorid"></a>
### `getVisitorId()`

Is the request for a known VisitorId, based on 1st party, 3rd party (optional) cookies or Tracking API forced Visitor ID

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getip" id="getip"></a>
### `getIp()`

#### Signature

- It does not return anything.

<a name="setforceip" id="setforceip"></a>
### `setForceIp()`

#### Signature

- It accepts the following parameter(s):
    - `$ip`
- It does not return anything.

<a name="setforcedatetime" id="setforcedatetime"></a>
### `setForceDateTime()`

#### Signature

- It accepts the following parameter(s):
    - `$dateTime`
- It does not return anything.

<a name="setforcedvisitorid" id="setforcedvisitorid"></a>
### `setForcedVisitorId()`

#### Signature

- It accepts the following parameter(s):
    - `$visitorId`
- It does not return anything.

<a name="getforcedvisitorid" id="getforcedvisitorid"></a>
### `getForcedVisitorId()`

#### Signature

- It does not return anything.

<a name="overridelocation" id="overridelocation"></a>
### `overrideLocation()`

#### Signature

- It accepts the following parameter(s):
    - `$visitorInfo`
- It does not return anything.

<a name="getplugins" id="getplugins"></a>
### `getPlugins()`

#### Signature

- It does not return anything.

<a name="getparamscount" id="getparamscount"></a>
### `getParamsCount()`

#### Signature

- It does not return anything.

<a name="getpagegenerationtime" id="getpagegenerationtime"></a>
### `getPageGenerationTime()`

#### Signature

- It does not return anything.


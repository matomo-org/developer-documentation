<small>Piwik\Tracker</small>

Request
=======

Piwik - Open source web analytics


Constants
---------

This class defines the following constants:

- `UNKNOWN_RESOLUTION`
- `GENERATION_TIME_MS_MAXIMUM`

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`isAuthenticated()`](#isauthenticated)
- [`authenticateSuperUserOrAdmin()`](#authenticatesuperuseroradmin)
- [`getDaysSinceFirstVisit()`](#getdayssincefirstvisit)
- [`getDaysSinceLastOrder()`](#getdayssincelastorder)
- [`getDaysSinceLastVisit()`](#getdayssincelastvisit)
- [`getVisitCount()`](#getvisitcount)
- [`getBrowserLanguage()`](#getbrowserlanguage) &mdash; Returns the language the visitor is viewing.
- [`getLocalTime()`](#getlocaltime)
- [`getGoalRevenue()`](#getgoalrevenue)
- [`getParam()`](#getparam)
- [`getCurrentTimestamp()`](#getcurrenttimestamp)
- [`getIdSite()`](#getidsite)
- [`getUserAgent()`](#getuseragent)
- [`getCustomVariables()`](#getcustomvariables)
- [`truncateCustomVariable()`](#truncatecustomvariable)
- [`setThirdPartyCookie()`](#setthirdpartycookie) &mdash; Update the cookie information.
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
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

- It accepts the following parameter(s):
    - `$params`
    - `$tokenAuth`
- It does not return anything.

<a name="isauthenticated" id="isauthenticated"></a>
<a name="isAuthenticated" id="isAuthenticated"></a>
### `isAuthenticated()`

#### Signature

- It returns a `bool` value.

<a name="authenticatesuperuseroradmin" id="authenticatesuperuseroradmin"></a>
<a name="authenticateSuperUserOrAdmin" id="authenticateSuperUserOrAdmin"></a>
### `authenticateSuperUserOrAdmin()`

#### Signature

- It accepts the following parameter(s):
    - `$tokenAuth`
    - `$idSite`
- It does not return anything.

<a name="getdayssincefirstvisit" id="getdayssincefirstvisit"></a>
<a name="getDaysSinceFirstVisit" id="getDaysSinceFirstVisit"></a>
### `getDaysSinceFirstVisit()`

#### Signature

- It can return one of the following values:
    - `float`
    - `int`

<a name="getdayssincelastorder" id="getdayssincelastorder"></a>
<a name="getDaysSinceLastOrder" id="getDaysSinceLastOrder"></a>
### `getDaysSinceLastOrder()`

#### Signature

- It can return one of the following values:
    - `bool`
    - `float`
    - `int`

<a name="getdayssincelastvisit" id="getdayssincelastvisit"></a>
<a name="getDaysSinceLastVisit" id="getDaysSinceLastVisit"></a>
### `getDaysSinceLastVisit()`

#### Signature

- It can return one of the following values:
    - `float`
    - `int`

<a name="getvisitcount" id="getvisitcount"></a>
<a name="getVisitCount" id="getVisitCount"></a>
### `getVisitCount()`

#### Signature

- It can return one of the following values:
    - `int`
    - `mixed`

<a name="getbrowserlanguage" id="getbrowserlanguage"></a>
<a name="getBrowserLanguage" id="getBrowserLanguage"></a>
### `getBrowserLanguage()`

Returns the language the visitor is viewing.

#### Signature

- _Returns:_ browser language code, eg. "en-gb,en;q=0.5"
    - `string`

<a name="getlocaltime" id="getlocaltime"></a>
<a name="getLocalTime" id="getLocalTime"></a>
### `getLocalTime()`

#### Signature

- It returns a `string` value.

<a name="getgoalrevenue" id="getgoalrevenue"></a>
<a name="getGoalRevenue" id="getGoalRevenue"></a>
### `getGoalRevenue()`

#### Signature

- It accepts the following parameter(s):
    - `$defaultGoalRevenue`
- It does not return anything.

<a name="getparam" id="getparam"></a>
<a name="getParam" id="getParam"></a>
### `getParam()`

#### Signature

- It accepts the following parameter(s):
    - `$name`
- It does not return anything.

<a name="getcurrenttimestamp" id="getcurrenttimestamp"></a>
<a name="getCurrentTimestamp" id="getCurrentTimestamp"></a>
### `getCurrentTimestamp()`

#### Signature

- It does not return anything.

<a name="getidsite" id="getidsite"></a>
<a name="getIdSite" id="getIdSite"></a>
### `getIdSite()`

#### Signature

- It does not return anything.

<a name="getuseragent" id="getuseragent"></a>
<a name="getUserAgent" id="getUserAgent"></a>
### `getUserAgent()`

#### Signature

- It does not return anything.

<a name="getcustomvariables" id="getcustomvariables"></a>
<a name="getCustomVariables" id="getCustomVariables"></a>
### `getCustomVariables()`

#### Signature

- It accepts the following parameter(s):
    - `$scope`
- It does not return anything.

<a name="truncatecustomvariable" id="truncatecustomvariable"></a>
<a name="truncateCustomVariable" id="truncateCustomVariable"></a>
### `truncateCustomVariable()`

#### Signature

- It accepts the following parameter(s):
    - `$input`
- It does not return anything.

<a name="setthirdpartycookie" id="setthirdpartycookie"></a>
<a name="setThirdPartyCookie" id="setThirdPartyCookie"></a>
### `setThirdPartyCookie()`

Update the cookie information.

#### Signature

- It accepts the following parameter(s):
    - `$idVisitor`
- It does not return anything.

<a name="getvisitorid" id="getvisitorid"></a>
<a name="getVisitorId" id="getVisitorId"></a>
### `getVisitorId()`

Is the request for a known VisitorId, based on 1st party, 3rd party (optional) cookies or Tracking API forced Visitor ID

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getip" id="getip"></a>
<a name="getIp" id="getIp"></a>
### `getIp()`

#### Signature

- It does not return anything.

<a name="setforceip" id="setforceip"></a>
<a name="setForceIp" id="setForceIp"></a>
### `setForceIp()`

#### Signature

- It accepts the following parameter(s):
    - `$ip`
- It does not return anything.

<a name="setforcedatetime" id="setforcedatetime"></a>
<a name="setForceDateTime" id="setForceDateTime"></a>
### `setForceDateTime()`

#### Signature

- It accepts the following parameter(s):
    - `$dateTime`
- It does not return anything.

<a name="setforcedvisitorid" id="setforcedvisitorid"></a>
<a name="setForcedVisitorId" id="setForcedVisitorId"></a>
### `setForcedVisitorId()`

#### Signature

- It accepts the following parameter(s):
    - `$visitorId`
- It does not return anything.

<a name="getforcedvisitorid" id="getforcedvisitorid"></a>
<a name="getForcedVisitorId" id="getForcedVisitorId"></a>
### `getForcedVisitorId()`

#### Signature

- It does not return anything.

<a name="overridelocation" id="overridelocation"></a>
<a name="overrideLocation" id="overrideLocation"></a>
### `overrideLocation()`

#### Signature

- It accepts the following parameter(s):
    - `$visitorInfo`
- It does not return anything.

<a name="getplugins" id="getplugins"></a>
<a name="getPlugins" id="getPlugins"></a>
### `getPlugins()`

#### Signature

- It does not return anything.

<a name="getparamscount" id="getparamscount"></a>
<a name="getParamsCount" id="getParamsCount"></a>
### `getParamsCount()`

#### Signature

- It does not return anything.

<a name="getpagegenerationtime" id="getpagegenerationtime"></a>
<a name="getPageGenerationTime" id="getPageGenerationTime"></a>
### `getPageGenerationTime()`

#### Signature

- It does not return anything.


<small>Piwik\Tracker</small>

Request
=======

Piwik - Open source web analytics


Constants
---------

This class defines the following constants:

- [`UNKNOWN_RESOLUTION`](#UNKNOWN_RESOLUTION)
- [`GENERATION_TIME_MS_MAXIMUM`](#GENERATION_TIME_MS_MAXIMUM)

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`isAuthenticated()`](#isAuthenticated)
- [`authenticateSuperUserOrAdmin()`](#authenticateSuperUserOrAdmin)
- [`getDaysSinceFirstVisit()`](#getDaysSinceFirstVisit)
- [`getDaysSinceLastOrder()`](#getDaysSinceLastOrder)
- [`getDaysSinceLastVisit()`](#getDaysSinceLastVisit)
- [`getVisitCount()`](#getVisitCount)
- [`getBrowserLanguage()`](#getBrowserLanguage) &mdash; Returns the language the visitor is viewing.
- [`getLocalTime()`](#getLocalTime)
- [`getGoalRevenue()`](#getGoalRevenue)
- [`getParam()`](#getParam)
- [`getCurrentTimestamp()`](#getCurrentTimestamp)
- [`getIdSite()`](#getIdSite)
- [`getUserAgent()`](#getUserAgent)
- [`getCustomVariables()`](#getCustomVariables)
- [`truncateCustomVariable()`](#truncateCustomVariable)
- [`setThirdPartyCookie()`](#setThirdPartyCookie) &mdash; Update the cookie information.
- [`getVisitorId()`](#getVisitorId) &mdash; Is the request for a known VisitorId, based on 1st party, 3rd party (optional) cookies or Tracking API forced Visitor ID
- [`getIp()`](#getIp)
- [`setForceIp()`](#setForceIp)
- [`setForceDateTime()`](#setForceDateTime)
- [`setForcedVisitorId()`](#setForcedVisitorId)
- [`getForcedVisitorId()`](#getForcedVisitorId)
- [`overrideLocation()`](#overrideLocation)
- [`getPlugins()`](#getPlugins)
- [`getParamsCount()`](#getParamsCount)
- [`getPageGenerationTime()`](#getPageGenerationTime)

<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$params`
    - `$tokenAuth`
- It does not return anything.

<a name="isauthenticated" id="isauthenticated"></a>
### `isAuthenticated()`

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

<a name="authenticatesuperuseroradmin" id="authenticatesuperuseroradmin"></a>
### `authenticateSuperUserOrAdmin()`

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$tokenAuth`
    - `$idSite`
- It does not return anything.

<a name="getdayssincefirstvisit" id="getdayssincefirstvisit"></a>
### `getDaysSinceFirstVisit()`

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `float`
    - `int`

<a name="getdayssincelastorder" id="getdayssincelastorder"></a>
### `getDaysSinceLastOrder()`

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `bool`
    - `float`
    - `int`

<a name="getdayssincelastvisit" id="getdayssincelastvisit"></a>
### `getDaysSinceLastVisit()`

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `float`
    - `int`

<a name="getvisitcount" id="getvisitcount"></a>
### `getVisitCount()`

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `int`
    - `mixed`

<a name="getbrowserlanguage" id="getbrowserlanguage"></a>
### `getBrowserLanguage()`

Returns the language the visitor is viewing.

#### Signature

- It is a **public** method.
- _Returns:_ browser language code, eg. &quot;en-gb,en;q=0.5&quot;
    - `string`

<a name="getlocaltime" id="getlocaltime"></a>
### `getLocalTime()`

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="getgoalrevenue" id="getgoalrevenue"></a>
### `getGoalRevenue()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$defaultGoalRevenue`
- It does not return anything.

<a name="getparam" id="getparam"></a>
### `getParam()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It does not return anything.

<a name="getcurrenttimestamp" id="getcurrenttimestamp"></a>
### `getCurrentTimestamp()`

#### Signature

- It is a **public** method.
- It does not return anything.

<a name="getidsite" id="getidsite"></a>
### `getIdSite()`

#### Signature

- It is a **public** method.
- It does not return anything.

<a name="getuseragent" id="getuseragent"></a>
### `getUserAgent()`

#### Signature

- It is a **public** method.
- It does not return anything.

<a name="getcustomvariables" id="getcustomvariables"></a>
### `getCustomVariables()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$scope`
- It does not return anything.

<a name="truncatecustomvariable" id="truncatecustomvariable"></a>
### `truncateCustomVariable()`

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$input`
- It does not return anything.

<a name="setthirdpartycookie" id="setthirdpartycookie"></a>
### `setThirdPartyCookie()`

Update the cookie information.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$idVisitor`
- It does not return anything.

<a name="getvisitorid" id="getvisitorid"></a>
### `getVisitorId()`

Is the request for a known VisitorId, based on 1st party, 3rd party (optional) cookies or Tracking API forced Visitor ID

#### Signature

- It is a **public** method.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getip" id="getip"></a>
### `getIp()`

#### Signature

- It is a **public** method.
- It does not return anything.

<a name="setforceip" id="setforceip"></a>
### `setForceIp()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$ip`
- It does not return anything.

<a name="setforcedatetime" id="setforcedatetime"></a>
### `setForceDateTime()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dateTime`
- It does not return anything.

<a name="setforcedvisitorid" id="setforcedvisitorid"></a>
### `setForcedVisitorId()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$visitorId`
- It does not return anything.

<a name="getforcedvisitorid" id="getforcedvisitorid"></a>
### `getForcedVisitorId()`

#### Signature

- It is a **public** method.
- It does not return anything.

<a name="overridelocation" id="overridelocation"></a>
### `overrideLocation()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$visitorInfo`
- It does not return anything.

<a name="getplugins" id="getplugins"></a>
### `getPlugins()`

#### Signature

- It is a **public** method.
- It does not return anything.

<a name="getparamscount" id="getparamscount"></a>
### `getParamsCount()`

#### Signature

- It is a **public** method.
- It does not return anything.

<a name="getpagegenerationtime" id="getpagegenerationtime"></a>
### `getPageGenerationTime()`

#### Signature

- It is a **public** method.
- It does not return anything.


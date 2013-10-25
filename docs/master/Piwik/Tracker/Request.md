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

### `__construct()` <a name="__construct"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$params`
    - `$tokenAuth`
- It does not return anything.

### `isAuthenticated()` <a name="isAuthenticated"></a>

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

### `authenticateSuperUserOrAdmin()` <a name="authenticateSuperUserOrAdmin"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$tokenAuth`
    - `$idSite`
- It does not return anything.

### `getDaysSinceFirstVisit()` <a name="getDaysSinceFirstVisit"></a>

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `float`
    - `int`

### `getDaysSinceLastOrder()` <a name="getDaysSinceLastOrder"></a>

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `bool`
    - `float`
    - `int`

### `getDaysSinceLastVisit()` <a name="getDaysSinceLastVisit"></a>

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `float`
    - `int`

### `getVisitCount()` <a name="getVisitCount"></a>

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `int`
    - `mixed`

### `getBrowserLanguage()` <a name="getBrowserLanguage"></a>

Returns the language the visitor is viewing.

#### Signature

- It is a **public** method.
- _Returns:_ browser language code, eg. &quot;en-gb,en;q=0.5&quot;
    - `string`

### `getLocalTime()` <a name="getLocalTime"></a>

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getGoalRevenue()` <a name="getGoalRevenue"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$defaultGoalRevenue`
- It does not return anything.

### `getParam()` <a name="getParam"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It does not return anything.

### `getCurrentTimestamp()` <a name="getCurrentTimestamp"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getIdSite()` <a name="getIdSite"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getUserAgent()` <a name="getUserAgent"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getCustomVariables()` <a name="getCustomVariables"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$scope`
- It does not return anything.

### `truncateCustomVariable()` <a name="truncateCustomVariable"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$input`
- It does not return anything.

### `setThirdPartyCookie()` <a name="setThirdPartyCookie"></a>

Update the cookie information.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$idVisitor`
- It does not return anything.

### `getVisitorId()` <a name="getVisitorId"></a>

Is the request for a known VisitorId, based on 1st party, 3rd party (optional) cookies or Tracking API forced Visitor ID

#### Signature

- It is a **public** method.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `getIp()` <a name="getIp"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `setForceIp()` <a name="setForceIp"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$ip`
- It does not return anything.

### `setForceDateTime()` <a name="setForceDateTime"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dateTime`
- It does not return anything.

### `setForcedVisitorId()` <a name="setForcedVisitorId"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$visitorId`
- It does not return anything.

### `getForcedVisitorId()` <a name="getForcedVisitorId"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `overrideLocation()` <a name="overrideLocation"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$visitorInfo`
- It does not return anything.

### `getPlugins()` <a name="getPlugins"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getParamsCount()` <a name="getParamsCount"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getPageGenerationTime()` <a name="getPageGenerationTime"></a>

#### Signature

- It is a **public** method.
- It does not return anything.


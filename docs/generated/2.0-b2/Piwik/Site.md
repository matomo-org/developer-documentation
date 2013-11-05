<small>Piwik</small>

Site
====

Provides access to individual site data (such as name, URL, etc.).

Description
-----------

### Examples

**Basic usage**

    $site = new Site($idSite);
    $name = $site->getName();

**Without allocation**

    $name = Site::getNameFor($idSite);


Properties
----------

This class defines the following properties:

- [`$infoSites`](#$infoSites)

<a name="infosites" id="infosites"></a>
### `$infoSites`

#### Signature

- It is a **public static** property.
- It is a(n) `array` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setSites()`](#setSites) &mdash; Sets the cached site data with an array that associates site IDs with individual site data.
- [`setSitesFromArray()`](#setSitesFromArray) &mdash; Sets the cached Site data with a non-associated array of site data.
- [`__toString()`](#__toString) &mdash; Returns a string representation of the site this instance references.
- [`getName()`](#getName) &mdash; Returns the name of the site.
- [`getMainUrl()`](#getMainUrl) &mdash; Returns the main url of the site.
- [`getId()`](#getId) &mdash; Returns the id of the site.
- [`getCreationDate()`](#getCreationDate) &mdash; Returns the creation date of the site.
- [`getTimezone()`](#getTimezone) &mdash; Returns the timezone of the size.
- [`getCurrency()`](#getCurrency) &mdash; Returns the currency of the site.
- [`getExcludedIps()`](#getExcludedIps) &mdash; Returns the excluded ips of the site.
- [`getExcludedQueryParameters()`](#getExcludedQueryParameters) &mdash; Returns the excluded query parameters of the site.
- [`isEcommerceEnabled()`](#isEcommerceEnabled) &mdash; Returns whether ecommerce is enabled for the site.
- [`getSearchKeywordParameters()`](#getSearchKeywordParameters) &mdash; Returns the site search keyword query parameters for the site.
- [`getSearchCategoryParameters()`](#getSearchCategoryParameters) &mdash; Returns the site search category query parameters for the site.
- [`isSiteSearchEnabled()`](#isSiteSearchEnabled) &mdash; Returns whether Site Search Tracking is enabled for the site.
- [`getIdSitesFromIdSitesString()`](#getIdSitesFromIdSitesString) &mdash; Checks the given string for valid site ids and returns them as an array.
- [`clearCache()`](#clearCache) &mdash; Clears the site data cache.
- [`getNameFor()`](#getNameFor) &mdash; Returns the name of the site with the specified ID.
- [`getTimezoneFor()`](#getTimezoneFor) &mdash; Returns the timezone of the site with the specified ID.
- [`getCreationDateFor()`](#getCreationDateFor) &mdash; Returns the creation date of the site with the specified ID.
- [`getMainUrlFor()`](#getMainUrlFor) &mdash; Returns the url for the site with the specified ID.
- [`isEcommerceEnabledFor()`](#isEcommerceEnabledFor) &mdash; Returns whether the site with the specified ID is ecommerce enabled
- [`isSiteSearchEnabledFor()`](#isSiteSearchEnabledFor) &mdash; Returns whether the site with the specified ID is Site Search enabled
- [`getCurrencyFor()`](#getCurrencyFor) &mdash; Returns the currency of the site with the specified ID.
- [`getExcludedIpsFor()`](#getExcludedIpsFor) &mdash; Returns the excluded IP addresses of the site with the specified ID.
- [`getExcludedQueryParametersFor()`](#getExcludedQueryParametersFor) &mdash; Returns the excluded query parameters for the site with the specified ID.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$idsite`
- It does not return anything.

<a name="setsites" id="setsites"></a>
### `setSites()`

Sets the cached site data with an array that associates site IDs with individual site data.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sites`
- It does not return anything.

<a name="setsitesfromarray" id="setsitesfromarray"></a>
### `setSitesFromArray()`

Sets the cached Site data with a non-associated array of site data.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sites`
- It does not return anything.

<a name="__tostring" id="__tostring"></a>
### `__toString()`

Returns a string representation of the site this instance references.

#### Description

Useful for debugging.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="getname" id="getname"></a>
### `getName()`

Returns the name of the site.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getmainurl" id="getmainurl"></a>
### `getMainUrl()`

Returns the main url of the site.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getid" id="getid"></a>
### `getId()`

Returns the id of the site.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getcreationdate" id="getcreationdate"></a>
### `getCreationDate()`

Returns the creation date of the site.

#### Signature

- It is a **public** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="gettimezone" id="gettimezone"></a>
### `getTimezone()`

Returns the timezone of the size.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getcurrency" id="getcurrency"></a>
### `getCurrency()`

Returns the currency of the site.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getexcludedips" id="getexcludedips"></a>
### `getExcludedIps()`

Returns the excluded ips of the site.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getexcludedqueryparameters" id="getexcludedqueryparameters"></a>
### `getExcludedQueryParameters()`

Returns the excluded query parameters of the site.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="isecommerceenabled" id="isecommerceenabled"></a>
### `isEcommerceEnabled()`

Returns whether ecommerce is enabled for the site.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getsearchkeywordparameters" id="getsearchkeywordparameters"></a>
### `getSearchKeywordParameters()`

Returns the site search keyword query parameters for the site.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getsearchcategoryparameters" id="getsearchcategoryparameters"></a>
### `getSearchCategoryParameters()`

Returns the site search category query parameters for the site.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="issitesearchenabled" id="issitesearchenabled"></a>
### `isSiteSearchEnabled()`

Returns whether Site Search Tracking is enabled for the site.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getidsitesfromidsitesstring" id="getidsitesfromidsitesstring"></a>
### `getIdSitesFromIdSitesString()`

Checks the given string for valid site ids and returns them as an array.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ids`
    - `$_restrictSitesToLogin`
- _Returns:_ An array of valid, unique integers.
    - `array`

<a name="clearcache" id="clearcache"></a>
### `clearCache()`

Clears the site data cache.

#### Description

See also [setSites](#setSites) and [setSitesFromArray](#setSitesFromArray).

#### Signature

- It is a **public static** method.
- It does not return anything.

<a name="getnamefor" id="getnamefor"></a>
### `getNameFor()`

Returns the name of the site with the specified ID.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idsite`
- It returns a(n) `string` value.

<a name="gettimezonefor" id="gettimezonefor"></a>
### `getTimezoneFor()`

Returns the timezone of the site with the specified ID.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idsite`
- It returns a(n) `string` value.

<a name="getcreationdatefor" id="getcreationdatefor"></a>
### `getCreationDateFor()`

Returns the creation date of the site with the specified ID.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idsite`
- It returns a(n) `string` value.

<a name="getmainurlfor" id="getmainurlfor"></a>
### `getMainUrlFor()`

Returns the url for the site with the specified ID.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idsite`
- It returns a(n) `string` value.

<a name="isecommerceenabledfor" id="isecommerceenabledfor"></a>
### `isEcommerceEnabledFor()`

Returns whether the site with the specified ID is ecommerce enabled

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idsite`
- It returns a(n) `string` value.

<a name="issitesearchenabledfor" id="issitesearchenabledfor"></a>
### `isSiteSearchEnabledFor()`

Returns whether the site with the specified ID is Site Search enabled

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idsite`
- It returns a(n) `string` value.

<a name="getcurrencyfor" id="getcurrencyfor"></a>
### `getCurrencyFor()`

Returns the currency of the site with the specified ID.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idsite`
- It returns a(n) `string` value.

<a name="getexcludedipsfor" id="getexcludedipsfor"></a>
### `getExcludedIpsFor()`

Returns the excluded IP addresses of the site with the specified ID.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idsite`
- It returns a(n) `string` value.

<a name="getexcludedqueryparametersfor" id="getexcludedqueryparametersfor"></a>
### `getExcludedQueryParametersFor()`

Returns the excluded query parameters for the site with the specified ID.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idsite`
- It returns a(n) `string` value.


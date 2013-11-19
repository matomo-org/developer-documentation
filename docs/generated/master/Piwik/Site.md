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

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setSites()`](#setsites) &mdash; Sets the cached site data with an array that associates site IDs with individual site data.
- [`setSitesFromArray()`](#setsitesfromarray) &mdash; Sets the cached Site data with a non-associated array of site data.
- [`__toString()`](#__tostring) &mdash; Returns a string representation of the site this instance references.
- [`getName()`](#getname) &mdash; Returns the name of the site.
- [`getMainUrl()`](#getmainurl) &mdash; Returns the main url of the site.
- [`getId()`](#getid) &mdash; Returns the id of the site.
- [`getCreationDate()`](#getcreationdate) &mdash; Returns the creation date of the site.
- [`getTimezone()`](#gettimezone) &mdash; Returns the timezone of the size.
- [`getCurrency()`](#getcurrency) &mdash; Returns the currency of the site.
- [`getExcludedIps()`](#getexcludedips) &mdash; Returns the excluded ips of the site.
- [`getExcludedQueryParameters()`](#getexcludedqueryparameters) &mdash; Returns the excluded query parameters of the site.
- [`isEcommerceEnabled()`](#isecommerceenabled) &mdash; Returns whether ecommerce is enabled for the site.
- [`getSearchKeywordParameters()`](#getsearchkeywordparameters) &mdash; Returns the site search keyword query parameters for the site.
- [`getSearchCategoryParameters()`](#getsearchcategoryparameters) &mdash; Returns the site search category query parameters for the site.
- [`isSiteSearchEnabled()`](#issitesearchenabled) &mdash; Returns whether Site Search Tracking is enabled for the site.
- [`getIdSitesFromIdSitesString()`](#getidsitesfromidsitesstring) &mdash; Checks the given string for valid site ids and returns them as an array.
- [`clearCache()`](#clearcache) &mdash; Clears the site data cache.
- [`getNameFor()`](#getnamefor) &mdash; Returns the name of the site with the specified ID.
- [`getTimezoneFor()`](#gettimezonefor) &mdash; Returns the timezone of the site with the specified ID.
- [`getCreationDateFor()`](#getcreationdatefor) &mdash; Returns the creation date of the site with the specified ID.
- [`getMainUrlFor()`](#getmainurlfor) &mdash; Returns the url for the site with the specified ID.
- [`isEcommerceEnabledFor()`](#isecommerceenabledfor) &mdash; Returns whether the site with the specified ID is ecommerce enabled
- [`isSiteSearchEnabledFor()`](#issitesearchenabledfor) &mdash; Returns whether the site with the specified ID is Site Search enabled
- [`getCurrencyFor()`](#getcurrencyfor) &mdash; Returns the currency of the site with the specified ID.
- [`getExcludedIpsFor()`](#getexcludedipsfor) &mdash; Returns the excluded IP addresses of the site with the specified ID.
- [`getExcludedQueryParametersFor()`](#getexcludedqueryparametersfor) &mdash; Returns the excluded query parameters for the site with the specified ID.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The ID of the site we want data for.

<a name="setsites" id="setsites"></a>
<a name="setSites" id="setSites"></a>
### `setSites()`

Sets the cached site data with an array that associates site IDs with individual site data.

#### Signature

- It accepts the following parameter(s):
    - `$sites` (`array`) &mdash; The array of sites data. Indexed by site ID. eg, ``` array('1' => array('name' => 'Site 1', ...), '2' => array('name' => 'Site 2', ...))` ```
- It does not return anything.

<a name="setsitesfromarray" id="setsitesfromarray"></a>
<a name="setSitesFromArray" id="setSitesFromArray"></a>
### `setSitesFromArray()`

Sets the cached Site data with a non-associated array of site data.

#### Signature

- It accepts the following parameter(s):
    - `$sites` (`array`) &mdash; The array of sites data. eg, ``` array( array('idsite' => '1', 'name' => 'Site 1', ...), array('idsite' => '2', 'name' => 'Site 2', ...), ) ```
- It does not return anything.

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

Returns a string representation of the site this instance references.

#### Description

Useful for debugging.

#### Signature

- It returns a `string` value.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Returns the name of the site.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getmainurl" id="getmainurl"></a>
<a name="getMainUrl" id="getMainUrl"></a>
### `getMainUrl()`

Returns the main url of the site.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Returns the id of the site.

#### Signature

- It returns a `int` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getcreationdate" id="getcreationdate"></a>
<a name="getCreationDate" id="getCreationDate"></a>
### `getCreationDate()`

Returns the creation date of the site.

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="gettimezone" id="gettimezone"></a>
<a name="getTimezone" id="getTimezone"></a>
### `getTimezone()`

Returns the timezone of the size.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getcurrency" id="getcurrency"></a>
<a name="getCurrency" id="getCurrency"></a>
### `getCurrency()`

Returns the currency of the site.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getexcludedips" id="getexcludedips"></a>
<a name="getExcludedIps" id="getExcludedIps"></a>
### `getExcludedIps()`

Returns the excluded ips of the site.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getexcludedqueryparameters" id="getexcludedqueryparameters"></a>
<a name="getExcludedQueryParameters" id="getExcludedQueryParameters"></a>
### `getExcludedQueryParameters()`

Returns the excluded query parameters of the site.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="isecommerceenabled" id="isecommerceenabled"></a>
<a name="isEcommerceEnabled" id="isEcommerceEnabled"></a>
### `isEcommerceEnabled()`

Returns whether ecommerce is enabled for the site.

#### Signature

- It returns a `bool` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getsearchkeywordparameters" id="getsearchkeywordparameters"></a>
<a name="getSearchKeywordParameters" id="getSearchKeywordParameters"></a>
### `getSearchKeywordParameters()`

Returns the site search keyword query parameters for the site.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getsearchcategoryparameters" id="getsearchcategoryparameters"></a>
<a name="getSearchCategoryParameters" id="getSearchCategoryParameters"></a>
### `getSearchCategoryParameters()`

Returns the site search category query parameters for the site.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="issitesearchenabled" id="issitesearchenabled"></a>
<a name="isSiteSearchEnabled" id="isSiteSearchEnabled"></a>
### `isSiteSearchEnabled()`

Returns whether Site Search Tracking is enabled for the site.

#### Signature

- It returns a `bool` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if data for the site cannot be found.

<a name="getidsitesfromidsitesstring" id="getidsitesfromidsitesstring"></a>
<a name="getIdSitesFromIdSitesString" id="getIdSitesFromIdSitesString"></a>
### `getIdSitesFromIdSitesString()`

Checks the given string for valid site ids and returns them as an array.

#### Signature

- It accepts the following parameter(s):
    - `$ids` (`string`) &mdash; Comma separated idSite list, eg, `'1,2,3,4'`.
    - `$_restrictSitesToLogin` (`bool`|`string`) &mdash; Used only when running as a scheduled task.
- _Returns:_ An array of valid, unique integers.
    - `array`

<a name="clearcache" id="clearcache"></a>
<a name="clearCache" id="clearCache"></a>
### `clearCache()`

Clears the site data cache.

#### Description

See also [setSites](#setSites) and [setSitesFromArray](#setSitesFromArray).

#### Signature

- It does not return anything.

<a name="getnamefor" id="getnamefor"></a>
<a name="getNameFor" id="getNameFor"></a>
### `getNameFor()`

Returns the name of the site with the specified ID.

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The site ID.
- It returns a `string` value.

<a name="gettimezonefor" id="gettimezonefor"></a>
<a name="getTimezoneFor" id="getTimezoneFor"></a>
### `getTimezoneFor()`

Returns the timezone of the site with the specified ID.

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The site ID.
- It returns a `string` value.

<a name="getcreationdatefor" id="getcreationdatefor"></a>
<a name="getCreationDateFor" id="getCreationDateFor"></a>
### `getCreationDateFor()`

Returns the creation date of the site with the specified ID.

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The site ID.
- It returns a `string` value.

<a name="getmainurlfor" id="getmainurlfor"></a>
<a name="getMainUrlFor" id="getMainUrlFor"></a>
### `getMainUrlFor()`

Returns the url for the site with the specified ID.

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The site ID.
- It returns a `string` value.

<a name="isecommerceenabledfor" id="isecommerceenabledfor"></a>
<a name="isEcommerceEnabledFor" id="isEcommerceEnabledFor"></a>
### `isEcommerceEnabledFor()`

Returns whether the site with the specified ID is ecommerce enabled

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The site ID.
- It returns a `string` value.

<a name="issitesearchenabledfor" id="issitesearchenabledfor"></a>
<a name="isSiteSearchEnabledFor" id="isSiteSearchEnabledFor"></a>
### `isSiteSearchEnabledFor()`

Returns whether the site with the specified ID is Site Search enabled

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The site ID.
- It returns a `string` value.

<a name="getcurrencyfor" id="getcurrencyfor"></a>
<a name="getCurrencyFor" id="getCurrencyFor"></a>
### `getCurrencyFor()`

Returns the currency of the site with the specified ID.

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The site ID.
- It returns a `string` value.

<a name="getexcludedipsfor" id="getexcludedipsfor"></a>
<a name="getExcludedIpsFor" id="getExcludedIpsFor"></a>
### `getExcludedIpsFor()`

Returns the excluded IP addresses of the site with the specified ID.

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The site ID.
- It returns a `string` value.

<a name="getexcludedqueryparametersfor" id="getexcludedqueryparametersfor"></a>
<a name="getExcludedQueryParametersFor" id="getExcludedQueryParametersFor"></a>
### `getExcludedQueryParametersFor()`

Returns the excluded query parameters for the site with the specified ID.

#### Signature

- It accepts the following parameter(s):
    - `$idsite` (`int`) &mdash; The site ID.
- It returns a `string` value.


<small>Piwik\</small>

SiteContentDetector
===================

This class provides detection functions for specific content on a site.

Note: Calling the detect() method will create a HTTP request to the site to retrieve data, only the main site URL
will be checked

Usage:

$contentDetector = new SiteContentDetector();
$contentDetector->detectContent([SiteContentDetector::GA3]);
if ($contentDetector->ga3) {
     // site is using GA3
}

Properties
----------

This class defines the following properties:

- [`$consentManagerId`](#$consentmanagerid)
- [`$consentManagerName`](#$consentmanagername)
- [`$consentManagerUrl`](#$consentmanagerurl)
- [`$isConnected`](#$isconnected)
- [`$ga3`](#$ga3)
- [`$ga4`](#$ga4)
- [`$gtm`](#$gtm)
- [`$cms`](#$cms)

<a name="$consentmanagerid" id="$consentmanagerid"></a>
<a name="consentManagerId" id="consentManagerId"></a>
### `$consentManagerId`

#### Signature

- Its type is not specified.


<a name="$consentmanagername" id="$consentmanagername"></a>
<a name="consentManagerName" id="consentManagerName"></a>
### `$consentManagerName`

#### Signature

- Its type is not specified.


<a name="$consentmanagerurl" id="$consentmanagerurl"></a>
<a name="consentManagerUrl" id="consentManagerUrl"></a>
### `$consentManagerUrl`

#### Signature

- Its type is not specified.


<a name="$isconnected" id="$isconnected"></a>
<a name="isConnected" id="isConnected"></a>
### `$isConnected`

#### Signature

- Its type is not specified.


<a name="$ga3" id="$ga3"></a>
<a name="ga3" id="ga3"></a>
### `$ga3`

#### Signature

- Its type is not specified.


<a name="$ga4" id="$ga4"></a>
<a name="ga4" id="ga4"></a>
### `$ga4`

#### Signature

- Its type is not specified.


<a name="$gtm" id="$gtm"></a>
<a name="gtm" id="gtm"></a>
### `$gtm`

#### Signature

- Its type is not specified.


<a name="$cms" id="$cms"></a>
<a name="cms" id="cms"></a>
### `$cms`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`detectContent()`](#detectcontent) &mdash; This will query the site and populate the class properties with the details of the detected content
- [`getConsentManagerDefinitions()`](#getconsentmanagerdefinitions) &mdash; Return an array of consent manager definitions which can be used to detect their presence on the site and show the associated guide links

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$cache` (`Matomo\Cache\Lazy`|`null`) &mdash;
      

<a name="detectcontent" id="detectcontent"></a>
<a name="detectContent" id="detectContent"></a>
### `detectContent()`

This will query the site and populate the class properties with
the details of the detected content

#### Signature

-  It accepts the following parameter(s):
    - `$detectContent` (`array`) &mdash;
       Array of content type for which to check, defaults to all, limiting this list will speed up the detection check
    - `$idSite` (`int`|`null`) &mdash;
       Override the site ID, will use the site from the current request if null
    - `$siteResponse` (`array`|`null`) &mdash;
       String containing the site data to search, if blank then data will be retrieved from the current request site via an http request
    - `$timeOut` (`int`) &mdash;
       How long to wait for the site to response, defaults to 5 seconds
- It returns a `void` value.

<a name="getconsentmanagerdefinitions" id="getconsentmanagerdefinitions"></a>
<a name="getConsentManagerDefinitions" id="getConsentManagerDefinitions"></a>
### `getConsentManagerDefinitions()`

Return an array of consent manager definitions which can be used to detect their presence on the site and show
the associated guide links

#### Signature

- It returns a `array` value.


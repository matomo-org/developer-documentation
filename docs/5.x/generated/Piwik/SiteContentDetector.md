<small>Piwik\</small>

SiteContentDetector
===================

This class provides detection functions for specific content on a site.

Note: Calling the `detectContent()` method will create a HTTP request to the site to retrieve data, only the main site URL
will be checked

Usage:

$contentDetector = new SiteContentDetector();
$contentDetector->detectContent([GoogleAnalytics3::getId()]);
if ($contentDetector->ga3) {
     // site is using GA3
}

Properties
----------

This class defines the following properties:

- [`$detectedContent`](#$detectedcontent)
- [`$connectedConsentManagers`](#$connectedconsentmanagers)

<a name="$detectedcontent" id="$detectedcontent"></a>
<a name="detectedContent" id="detectedContent"></a>
### `$detectedContent`

#### Signature

- It is a `Piwik\array&lt;string,` value.

<a name="$connectedconsentmanagers" id="$connectedconsentmanagers"></a>
<a name="connectedConsentManagers" id="connectedConsentManagers"></a>
### `$connectedConsentManagers`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`getSiteContentDetectionsByType()`](#getsitecontentdetectionsbytype)
- [`getSiteContentDetectionById()`](#getsitecontentdetectionbyid) &mdash; Returns the site content detection object with the provided id, or null if it can't be found
- [`detectContent()`](#detectcontent) &mdash; This will query the site and populate the class properties with the details of the detected content
- [`wasDetected()`](#wasdetected) &mdash; Returns if the detection with the provided id was detected or not
- [`getDetectsByType()`](#getdetectsbytype) &mdash; Returns an array containing ids of all detected detections of the given type
- [`getKnownConsentManagers()`](#getknownconsentmanagers) &mdash; Return an array of consent manager definitions which can be used to detect their presence on the site and show the associated guide links

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$cache` (`Matomo\Cache\Lazy`|`null`) &mdash;
      

<a name="getsitecontentdetectionsbytype" id="getsitecontentdetectionsbytype"></a>
<a name="getSiteContentDetectionsByType" id="getSiteContentDetectionsByType"></a>
### `getSiteContentDetectionsByType()`

#### Signature


- *Returns:*  `array` &mdash;
    SiteContentDetectionAbstract[]>

<a name="getsitecontentdetectionbyid" id="getsitecontentdetectionbyid"></a>
<a name="getSiteContentDetectionById" id="getSiteContentDetectionById"></a>
### `getSiteContentDetectionById()`

Returns the site content detection object with the provided id, or null if it can't be found

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`string`) &mdash;
      

- *Returns:*  `Piwik\Piwik\Plugins\SitesManager\SiteContentDetection\SiteContentDetectionAbstract`|`null` &mdash;
    

<a name="detectcontent" id="detectcontent"></a>
<a name="detectContent" id="detectContent"></a>
### `detectContent()`

This will query the site and populate the class properties with
the details of the detected content

#### Signature

-  It accepts the following parameter(s):
    - `$detectContent` (`array`) &mdash;
       Array of content type for which to check, defaults to all, limiting this list will speed up the detection check. Allowed values are: * empty array - to run all detections * an array containing ids of detections, e.g. Wordpress::getId() or any of the type constants, e.g. SiteContentDetectionAbstract::TYPE_TRACKER
    - `$idSite` (`int`|`null`) &mdash;
       Override the site ID, will use the site from the current request if null
    - `$siteResponse` (`array`|`null`) &mdash;
       String containing the site data to search, if blank then data will be retrieved from the current request site via an http request
    - `$timeOut` (`int`) &mdash;
       How long to wait for the site to response, defaults to 5 seconds
- It returns a `void` value.

<a name="wasdetected" id="wasdetected"></a>
<a name="wasDetected" id="wasDetected"></a>
### `wasDetected()`

Returns if the detection with the provided id was detected or not

Note: self::detectContent needs to be called before.

#### Signature

-  It accepts the following parameter(s):
    - `$detectionClassId` (`string`) &mdash;
      
- It returns a `bool` value.

<a name="getdetectsbytype" id="getdetectsbytype"></a>
<a name="getDetectsByType" id="getDetectsByType"></a>
### `getDetectsByType()`

Returns an array containing ids of all detected detections of the given type

#### Signature

-  It accepts the following parameter(s):
    - `$type` (`string`) &mdash;
       One of the SiteContentDetectionAbstract::TYPE_* constants
- It returns a `array` value.

<a name="getknownconsentmanagers" id="getknownconsentmanagers"></a>
<a name="getKnownConsentManagers" id="getKnownConsentManagers"></a>
### `getKnownConsentManagers()`

Return an array of consent manager definitions which can be used to detect their presence on the site and show
the associated guide links

Note: This list is also used to display the known / supported consent managers on the "Ask for Consent" page
For adding a new consent manager to this page, it needs to be added here. If a consent manager can't be detected
automatically, simply leave the detections empty.

#### Signature

- It returns a `array` value.


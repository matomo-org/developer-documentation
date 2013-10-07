<small>Piwik</small>

SettingsPiwik
=============

Class SettingsPiwik


Properties
----------

This class defines the following properties:

- [`$cachedKnownSegmentsToArchive`](#$cachedKnownSegmentsToArchive)
- [`$piwikUrlCache`](#$piwikUrlCache) &mdash; Cache for result of getPiwikUrl.

### `$cachedKnownSegmentsToArchive` <a name="cachedKnownSegmentsToArchive"></a>

#### Signature

- It is a **public static** property.
- It is a(n) `array` value.

### `$piwikUrlCache` <a name="piwikUrlCache"></a>

Cache for result of getPiwikUrl.

#### Description

Can be overwritten for testing purposes only.

#### Signature

- It is a **public static** property.
- It is a(n) `string` value.

Methods
-------

The class defines the following methods:

- [`getSalt()`](#getSalt) &mdash; Get salt from [superuser] section
- [`isUserCredentialsSanityCheckEnabled()`](#isUserCredentialsSanityCheckEnabled) &mdash; Should Piwik check that the login &amp; password have minimum length and valid characters?
- [`getKnownSegmentsToArchive()`](#getKnownSegmentsToArchive) &mdash; Segments to pre-process
- [`getKnownSegmentsToArchiveForSite()`](#getKnownSegmentsToArchiveForSite)
- [`getWebsitesCountToDisplay()`](#getWebsitesCountToDisplay) &mdash; Number of websites to show in the Website selector
- [`getPiwikUrl()`](#getPiwikUrl) &mdash; Returns the cached the Piwik URL, eg.
- [`isSegmentationEnabled()`](#isSegmentationEnabled) &mdash; Returns true if Segmentation is allowed for this user
- [`isUniqueVisitorsEnabled()`](#isUniqueVisitorsEnabled) &mdash; Should we process and display Unique Visitors? -&gt; Always process for day/week/month periods For Year and Range, only process if it was enabled in the config file,
- [`rewriteTmpPathWithHostname()`](#rewriteTmpPathWithHostname) &mdash; If Piwik uses per-domain config file, also make tmp/ folder per-domain

### `getSalt()` <a name="getSalt"></a>

Get salt from [superuser] section

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `isUserCredentialsSanityCheckEnabled()` <a name="isUserCredentialsSanityCheckEnabled"></a>

Should Piwik check that the login &amp; password have minimum length and valid characters?

#### Signature

- It is a **public static** method.
- _Returns:_ True if checks enabled; false otherwise
    - `bool`

### `getKnownSegmentsToArchive()` <a name="getKnownSegmentsToArchive"></a>

Segments to pre-process

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `getKnownSegmentsToArchiveForSite()` <a name="getKnownSegmentsToArchiveForSite"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSite`
- It does not return anything.

### `getWebsitesCountToDisplay()` <a name="getWebsitesCountToDisplay"></a>

Number of websites to show in the Website selector

#### Signature

- It is a **public static** method.
- It returns a(n) `int` value.

### `getPiwikUrl()` <a name="getPiwikUrl"></a>

Returns the cached the Piwik URL, eg.

#### Description

http://demo.piwik.org/ or http://example.org/piwik/
If not found, then tries to cache it and returns the value.

If the Piwik URL changes (eg. Piwik moved to new server), the value will automatically be refreshed in the cache.

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `isSegmentationEnabled()` <a name="isSegmentationEnabled"></a>

Returns true if Segmentation is allowed for this user

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `isUniqueVisitorsEnabled()` <a name="isUniqueVisitorsEnabled"></a>

Should we process and display Unique Visitors? -&gt; Always process for day/week/month periods For Year and Range, only process if it was enabled in the config file,

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$periodLabel`
- It returns a(n) `bool` value.

### `rewriteTmpPathWithHostname()` <a name="rewriteTmpPathWithHostname"></a>

If Piwik uses per-domain config file, also make tmp/ folder per-domain

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$path`
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


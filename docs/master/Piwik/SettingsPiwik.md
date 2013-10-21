<small>Piwik</small>

SettingsPiwik
=============

Contains helper methods that can be used to get common Piwik settings.


Methods
-------

The class defines the following methods:

- [`getKnownSegmentsToArchive()`](#getKnownSegmentsToArchive) &mdash; Returns the list of stored segments to pre-process for all sites when executing cron archiving.
- [`getPiwikUrl()`](#getPiwikUrl) &mdash; Returns the URL to this Piwik instance, eg.
- [`isSegmentationEnabled()`](#isSegmentationEnabled) &mdash; Returns true if segmentation is allowed for this user, false if otherwise.
- [`isUniqueVisitorsEnabled()`](#isUniqueVisitorsEnabled) &mdash; Returns true if unique visitors should be processed for the given period type.

### `getKnownSegmentsToArchive()` <a name="getKnownSegmentsToArchive"></a>

Returns the list of stored segments to pre-process for all sites when executing cron archiving.

#### Signature

- It is a **public static** method.
- _Returns:_ The list of stored segments that apply to all sites.
    - `array`

### `getPiwikUrl()` <a name="getPiwikUrl"></a>

Returns the URL to this Piwik instance, eg.

#### Description

http://demo.piwik.org/ or http://example.org/piwik/.

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `isSegmentationEnabled()` <a name="isSegmentationEnabled"></a>

Returns true if segmentation is allowed for this user, false if otherwise.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `isUniqueVisitorsEnabled()` <a name="isUniqueVisitorsEnabled"></a>

Returns true if unique visitors should be processed for the given period type.

#### Description

Unique visitor processing is controlled by the **[General] enable_processing_unique_visitors_...**
INI config options. By default, day/week/month periods always process unique visitors and
year/range are not.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$periodLabel`
- It returns a(n) `bool` value.


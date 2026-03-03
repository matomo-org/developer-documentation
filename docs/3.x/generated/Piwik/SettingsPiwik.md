<small>Piwik\</small>

SettingsPiwik
=============

Contains helper methods that can be used to get common Piwik settings.

Methods
-------

The class defines the following methods:

- [`getPiwikUrl()`](#getpiwikurl) &mdash; Returns the URL to this Piwik instance, eg.
- [`isSegmentationEnabled()`](#issegmentationenabled) &mdash; Returns `true` if segmentation is allowed for this user, `false` if otherwise.
- [`isUniqueVisitorsEnabled()`](#isuniquevisitorsenabled) &mdash; Returns true if unique visitors should be processed for the given period type.

<a name="getpiwikurl" id="getpiwikurl"></a>
<a name="getPiwikUrl" id="getPiwikUrl"></a>
### `getPiwikUrl()`

Returns the URL to this Piwik instance, eg. **http://demo.piwik.org/** or **http://example.org/piwik/**.

#### Signature

- It returns a `string` value.

<a name="issegmentationenabled" id="issegmentationenabled"></a>
<a name="isSegmentationEnabled" id="isSegmentationEnabled"></a>
### `isSegmentationEnabled()`

Returns `true` if segmentation is allowed for this user, `false` if otherwise.

#### Signature

- It returns a `bool` value.

<a name="isuniquevisitorsenabled" id="isuniquevisitorsenabled"></a>
<a name="isUniqueVisitorsEnabled" id="isUniqueVisitorsEnabled"></a>
### `isUniqueVisitorsEnabled()`

Returns true if unique visitors should be processed for the given period type.

Unique visitor processing is controlled by the `[General] enable_processing_unique_visitors_...`
INI config options. By default, unique visitors are processed only for day/week/month periods.

#### Signature

-  It accepts the following parameter(s):
    - `$periodLabel` (`string`) &mdash;
       `"day"`, `"week"`, `"month"`, `"year"` or `"range"`
- It returns a `bool` value.


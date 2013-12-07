<small>Piwik</small>

SettingsPiwik
=============

Contains helper methods that can be used to get common Piwik settings.

Methods
-------

The class defines the following methods:

- [`getKnownSegmentsToArchive()`](#getknownsegmentstoarchive) &mdash; Returns the list of stored segments to pre-process for all sites when executing cron archiving.
- [`getPiwikUrl()`](#getpiwikurl) &mdash; Returns the URL to this Piwik instance, eg.
- [`isSegmentationEnabled()`](#issegmentationenabled) &mdash; Returns true if segmentation is allowed for this user, false if otherwise.
- [`isUniqueVisitorsEnabled()`](#isuniquevisitorsenabled) &mdash; Returns true if unique visitors should be processed for the given period type.

<a name="getknownsegmentstoarchive" id="getknownsegmentstoarchive"></a>
<a name="getKnownSegmentsToArchive" id="getKnownSegmentsToArchive"></a>
### `getKnownSegmentsToArchive()`

Returns the list of stored segments to pre-process for all sites when executing cron archiving.

#### Signature

- _Returns:_ The list of stored segments that apply to all sites.
    - `array`

<a name="getpiwikurl" id="getpiwikurl"></a>
<a name="getPiwikUrl" id="getPiwikUrl"></a>
### `getPiwikUrl()`

Returns the URL to this Piwik instance, eg.

#### Description

http://demo.piwik.org/ or http://example.org/piwik/.

#### Signature

- It returns a `string` value.

<a name="issegmentationenabled" id="issegmentationenabled"></a>
<a name="isSegmentationEnabled" id="isSegmentationEnabled"></a>
### `isSegmentationEnabled()`

Returns true if segmentation is allowed for this user, false if otherwise.

#### Signature

- It returns a `bool` value.

<a name="isuniquevisitorsenabled" id="isuniquevisitorsenabled"></a>
<a name="isUniqueVisitorsEnabled" id="isUniqueVisitorsEnabled"></a>
### `isUniqueVisitorsEnabled()`

Returns true if unique visitors should be processed for the given period type.

#### Description

Unique visitor processing is controlled by the **[General] enable_processing_unique_visitors_...**
INI config options. By default, day/week/month periods always process unique visitors and
year/range are not.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$periodLabel` (`string`) &mdash;

      <div markdown="1" class="param-desc"> `"day"`, `"week"`, `"month"`, `"year"` or `"range"`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.


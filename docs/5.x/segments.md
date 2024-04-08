---
category: DevelopInDepth
title: Segments
---
# Matomo core - Segments

This guide applies to core developers. Related documentation:

* [Segmentation user guide](https://matomo.org/docs/segmentation/) 
* [Segmentation API docs for developers](https://developer.matomo.org/api-reference/reporting-api-segmentation).

## Real time vs archived segments

When browser archiving for segments is enabled, then a segment can be configured to be "real time" or "archived in the background" when creating or editing a segment.

* `real time`: meaning the reports are being processed / generated / archived when viewing the report. This is usually slower but works well when there is not a lot of traffic or when you view the reports very rarely or when you have a lot of segments and otherwise it would cause too much load and storage on the server to regularly archive the reports.
* `archived in the background`: meaning the segment will be archived in the background by the cronjob. 

When browser archiving is disabled, then by default segments may still be processed in real time when viewing the reports unless you set below config setting: 

`[General] browser_archiving_disabled_enforce=1`

When this is set, all segments will be archived only in the background no matter how it is configured.

Whether a segment is being processed in real time or not is stored in the `auto_archive` column of the `segment` table. When the value is `0` then it is configured to be in real time. 

## Storage of segment archives and segment hash

Segment reports are stored in the archive tables just like any other report too. However, the `done` flag in the numeric or invalidation archive tables have a segment hash attached and looks for example like this: `donefea44bece172bc9696ae57c26888bf8a` or `donefea44bece172bc9696ae57c26888bf8a.VisitsSummary` for a specific plugin.

The segment hash is calculated as an MD5 hash on the segment definition. For example `$segmentHash = md5('actions>1')`. 

### How do I get the correct segment hash for a segment?

Execute the `SegmentEditor.getAll` API method as this should include the expected segment hash. 

## How are segments encoded in the API?

Segments are typically encoded three times:

* The [first decode is on the whole segment](https://github.com/matomo-org/matomo/blob/3.x-dev/core/Segment.php#L104). The corresponding encode was [added in 3.6.0 here](https://github.com/matomo-org/matomo/blob/3.x-dev/plugins/Live/javascripts/SegmentedVisitorLog.js#L123).
* The [second decode is on individual conditions](https://github.com/matomo-org/matomo/blob/3.x-dev/core/Segment/SegmentExpression.php#L91) (ie, pageUrl==...).
* The [third decode is on individual values](https://github.com/matomo-org/matomo/blob/3.x-dev/core/Segment/SegmentExpression.php#L112).

This means the value needs to be triple encoded for values like plus signs to be used properly in the segment. For more details see [#13481](https://github.com/matomo-org/matomo/pull/13481).

**Please note if you are a user of the API, read the Segment in Matomo API Reference [here](https://developer.matomo.org/api-reference/reporting-api-segmentation#segment-values-must-be-url-encoded) instead**

## How do I know if a segment is available for all sites?

A segment can be either available for one site (for example `enable_only_idsite=1`) or for all sites in which case the column value for `enable_only_idsite` is `0` (zero).

## Creating a segment instance

```php
$segment = new Piwik\Segment($definition, $idSites);
```

You need to use `urlencode($definition)`  if the segment is sourced from the `segment` table or from `SegmentEditor.getAll`. Then it should be encoded before being used in the `Segment` class. If there is a lot of passing the string around before creating a `Segment`, then it would be hard to figure out what to use. For reference see [#17029](https://github.com/matomo-org/matomo/pull/17029). 

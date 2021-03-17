---
category: DevelopInDepth
title: Segments
---
# Matomo core - Segments

## How are segments encoded?

Segments are typically encoded three times:

* The [first decode is on the whole segment](https://github.com/matomo-org/matomo/blob/3.x-dev/core/Segment.php#L104). The corresponding encode was [added in 3.6.0 here](https://github.com/matomo-org/matomo/blob/3.x-dev/plugins/Live/javascripts/SegmentedVisitorLog.js#L123).
* The [second decode is on individual conditions](https://github.com/matomo-org/matomo/blob/3.x-dev/core/Segment/SegmentExpression.php#L91) (ie, pageUrl==...).
* The [third decode is on individual values](https://github.com/matomo-org/matomo/blob/3.x-dev/core/Segment/SegmentExpression.php#L112).

This means the value needs to be triple encoded for values like plus signs to be used properly in the segment. For more details see [#13481](https://github.com/matomo-org/matomo/pull/13481).

## Creating a segment instance

```php
$segment = new Piwik\Segment($definition, $idSites);
```

You need to use `urlencode($definition)`  if the segment is sourced from the `segment` table or from `SegmentEditor.getAll`. Then it should be encoded before being used in the `Segment` class. If there is a lot of passing the string around before creating a `Segment`, then it would be hard to figure out what to use. For reference see [#17029](https://github.com/matomo-org/matomo/pull/17029). 

## How do I get the correct expected segment hash for a segment?

Execute the `SegmentEditor.getAll` API method as this should include the expected segment hash.

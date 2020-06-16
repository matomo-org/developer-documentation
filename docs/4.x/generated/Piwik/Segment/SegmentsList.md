<small>Piwik\Segment\</small>

SegmentsList
============

Manages the global list of segments that can be used.

Segments are added automatically by dimensions as well as through the [Segment.addSegments](/api-reference/events#segmentaddsegments) event.
Observers for this event should call the [addSegment()](/api-reference/Piwik/Segment/SegmentsList#addsegment) method to add segments or use any of the other
methods to remove segments.

Methods
-------

The class defines the following methods:

- [`addSegment()`](#addsegment)
- [`getSegments()`](#getsegments) &mdash; Get all available segments.
- [`remove()`](#remove) &mdash; Removes one or more segments from the segments list.
- [`getSegment()`](#getsegment)

<a name="addsegment" id="addsegment"></a>
<a name="addSegment" id="addSegment"></a>
### `addSegment()`

#### Signature

-  It accepts the following parameter(s):
    - `$segment` ([`Segment`](../../Piwik/Plugin/Segment.md)) &mdash;
      
- It does not return anything.

<a name="getsegments" id="getsegments"></a>
<a name="getSegments" id="getSegments"></a>
### `getSegments()`

Get all available segments.

#### Signature

- It returns a [`Segment[]`](../../Piwik/Plugin/Segment.md) value.

<a name="remove" id="remove"></a>
<a name="remove" id="remove"></a>
### `remove()`

Removes one or more segments from the segments list.

#### Signature

-  It accepts the following parameter(s):
    - `$segmentCategory` (`string`) &mdash;
       The segment category id. Can be a translation token eg 'General_Visits' see Segment::getCategoryId().
    - `$segmentExpression` (`string`|`Piwik\Segment\false`) &mdash;
       The segment expression name to remove eg 'pageUrl'. If not supplied, all segments within that category will be removed.
- It does not return anything.

<a name="getsegment" id="getsegment"></a>
<a name="getSegment" id="getSegment"></a>
### `getSegment()`

#### Signature

-  It accepts the following parameter(s):
    - `$segmentExpression` (`string`) &mdash;
       Name of the segment expression. eg `pageUrl`

- *Returns:*  [`Segment`](../../Piwik/Plugin/Segment.md)|`null` &mdash;
    


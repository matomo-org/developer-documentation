<small>Piwik\Columns\</small>

DimensionSegmentFactory
=======================

A factory to create segments from a dimension.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Generates a new dimension segment factory.
- [`createSegment()`](#createsegment) &mdash; Creates a segment based on the dimension properties

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Generates a new dimension segment factory.

#### Signature

-  It accepts the following parameter(s):
    - `$dimension` ([`Dimension`](../../Piwik/Columns/Dimension.md)) &mdash;
       A dimension instance the created segments should be based on.

<a name="createsegment" id="createsegment"></a>
<a name="createSegment" id="createSegment"></a>
### `createSegment()`

Creates a segment based on the dimension properties

#### Signature

-  It accepts the following parameter(s):
    - `$segment` ([`Segment`](../../Piwik/Plugin/Segment.md)|`null`) &mdash;
       optional Segment to enrich with dimension data (if properties not already set)
- It returns a [`Segment`](../../Piwik/Plugin/Segment.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


<small>Piwik\ArchiveProcessor\</small>

Parameters
==========

Contains the analytics parameters for the reports that are currently being archived.

The analytics
parameters include the **website** the reports describe, the **period** of time the reports describe
and the **segment** used to limit the visit set.

Methods
-------

The class defines the following methods:

- [`getPeriod()`](#getperiod) &mdash; Returns the period we are computing statistics for.
- [`getSite()`](#getsite) &mdash; Returns the site we are computing statistics for.
- [`getSegment()`](#getsegment) &mdash; The Segment used to limit the set of visits that are being aggregated.

<a name="getperiod" id="getperiod"></a>
<a name="getPeriod" id="getPeriod"></a>
### `getPeriod()`

Returns the period we are computing statistics for.

#### Signature

- It returns a [`Period`](../../Piwik/Period.md) value.

<a name="getsite" id="getsite"></a>
<a name="getSite" id="getSite"></a>
### `getSite()`

Returns the site we are computing statistics for.

#### Signature

- It returns a [`Site`](../../Piwik/Site.md) value.

<a name="getsegment" id="getsegment"></a>
<a name="getSegment" id="getSegment"></a>
### `getSegment()`

The Segment used to limit the set of visits that are being aggregated.

#### Signature

- It returns a [`Segment`](../../Piwik/Segment.md) value.


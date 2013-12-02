<small>Piwik\DataTable\Filter</small>

BeautifyTimeRangeLabels
=======================

A DataTable filter that replaces range labels whose values are in seconds with prettier, human-friendlier versions.

Description
-----------

This filter customizes the behavior of the [BeautifyRangeLabels](/api-reference/Piwik/DataTable/Filter/BeautifyRangeLabels) filter
so range values that are less than one minute are displayed in seconds but
other ranges are displayed in minutes.

**Basic usage**

    $dataTable->filter('BeautifyTimeRangeLabels', array("%1$s-%2$s min", "1 min", "%s min"));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getSingleUnitLabel()`](#getsingleunitlabel) &mdash; Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.
- [`getRangeLabel()`](#getrangelabel) &mdash; Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.
- [`getUnboundedLabel()`](#getunboundedlabel) &mdash; Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The DataTable this filter will run over.
    - `$labelSecondsPlural` (`string`) &mdash; A string to use when beautifying range labels whose lower bound is between 0 and 60. Must be a format string that takes two numeric params.
    - `$labelMinutesSingular` (`string`) &mdash; A string to use when replacing a range that equals 60-60 (or 1 minute - 1 minute).
    - `$labelMinutesPlural` (`string`) &mdash; A string to use when replacing a range that spans multiple minutes. This must be a format string that takes one string parameter.

<a name="getsingleunitlabel" id="getsingleunitlabel"></a>
<a name="getSingleUnitLabel" id="getSingleUnitLabel"></a>
### `getSingleUnitLabel()`

Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.

#### Description

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

- It accepts the following parameter(s):
    - `$oldLabel` (`string`) &mdash; The original label value.
    - `$lowerBound` (`int`) &mdash; The lower bound of the range.
- _Returns:_ The pretty range label.
    - `string`

<a name="getrangelabel" id="getrangelabel"></a>
<a name="getRangeLabel" id="getRangeLabel"></a>
### `getRangeLabel()`

Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.

#### Description

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

- It accepts the following parameter(s):
    - `$oldLabel` (`string`) &mdash; The original label value.
    - `$lowerBound` (`int`) &mdash; The lower bound of the range.
    - `$upperBound` (`int`) &mdash; The upper bound of the range.
- _Returns:_ The pretty range label.
    - `string`

<a name="getunboundedlabel" id="getunboundedlabel"></a>
<a name="getUnboundedLabel" id="getUnboundedLabel"></a>
### `getUnboundedLabel()`

Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

#### Description

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

- It accepts the following parameter(s):
    - `$oldLabel` (`string`) &mdash; The original label value.
    - `$lowerBound` (`int`) &mdash; The lower bound of the range.
- _Returns:_ The pretty range label.
    - `string`


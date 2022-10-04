<small>Piwik\DataTable\Filter\</small>

BeautifyTimeRangeLabels
=======================

A DataTable filter that replaces range labels whose values are in seconds with prettier, human-friendlier versions.

This filter customizes the behavior of the [BeautifyRangeLabels](/api-reference/Piwik/DataTable/Filter/BeautifyRangeLabels) filter
so range values that are less than one minute are displayed in seconds but
other ranges are displayed in minutes.

**Basic usage**

    $dataTable->filter('BeautifyTimeRangeLabels', array("%1$s-%2$s min", "1 min", "%s min"));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackReplace](/api-reference/Piwik/DataTable/Filter/ColumnCallbackReplace). Inherited from [`ColumnCallbackReplace`](../../../Piwik/DataTable/Filter/ColumnCallbackReplace.md)
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`beautify()`](#beautify) &mdash; Beautifies a range label and returns the pretty result. Inherited from [`BeautifyRangeLabels`](../../../Piwik/DataTable/Filter/BeautifyRangeLabels.md)
- [`getSingleUnitLabel()`](#getsingleunitlabel) &mdash; Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.
- [`getRangeLabel()`](#getrangelabel) &mdash; Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.
- [`getUnboundedLabel()`](#getunboundedlabel) &mdash; Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$labelSecondsPlural` (`string`) &mdash;
       A string to use when beautifying range labels whose lower bound is between 0 and 60. Must be a format string that takes two numeric params.
    - `$labelMinutesSingular` (`string`) &mdash;
       A string to use when replacing a range that equals 60-60 (or 1 minute - 1 minute).
    - `$labelMinutesPlural` (`string`) &mdash;
       A string to use when replacing a range that spans multiple minutes. This must be a format string that takes one string parameter.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackReplace](/api-reference/Piwik/DataTable/Filter/ColumnCallbackReplace).

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`Piwik\DataTable\DataTable`) &mdash;
      
- It does not return anything or a mixed result.

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering. Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything or a mixed result.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything or a mixed result.

<a name="beautify" id="beautify"></a>
<a name="beautify" id="beautify"></a>
### `beautify()`

Beautifies a range label and returns the pretty result. See [BeautifyRangeLabels](/api-reference/Piwik/DataTable/Filter/BeautifyRangeLabels).

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`string`) &mdash;
       The range string. This must be in either a '$min-$max' format a '$min+' format.

- *Returns:*  `string` &mdash;
    The pretty range label.

<a name="getsingleunitlabel" id="getsingleunitlabel"></a>
<a name="getSingleUnitLabel" id="getSingleUnitLabel"></a>
### `getSingleUnitLabel()`

Beautifies and returns a range label whose range spans over one unit, ie
1-1, 2-2 or 3-3.

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

-  It accepts the following parameter(s):
    - `$oldLabel` (`string`) &mdash;
       The original label value.
    - `$lowerBound` (`int`) &mdash;
       The lower bound of the range.

- *Returns:*  `string` &mdash;
    The pretty range label.

<a name="getrangelabel" id="getrangelabel"></a>
<a name="getRangeLabel" id="getRangeLabel"></a>
### `getRangeLabel()`

Beautifies and returns a range label whose range is bounded and spans over
more than one unit, ie 1-5, 5-10 but NOT 11+.

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

-  It accepts the following parameter(s):
    - `$oldLabel` (`string`) &mdash;
       The original label value.
    - `$lowerBound` (`int`) &mdash;
       The lower bound of the range.
    - `$upperBound` (`int`) &mdash;
       The upper bound of the range.

- *Returns:*  `string` &mdash;
    The pretty range label.

<a name="getunboundedlabel" id="getunboundedlabel"></a>
<a name="getUnboundedLabel" id="getUnboundedLabel"></a>
### `getUnboundedLabel()`

Beautifies and returns a range label whose range is unbounded, ie
5+, 10+, etc.

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

-  It accepts the following parameter(s):
    - `$oldLabel` (`string`) &mdash;
       The original label value.
    - `$lowerBound` (`int`) &mdash;
       The lower bound of the range.

- *Returns:*  `string` &mdash;
    The pretty range label.


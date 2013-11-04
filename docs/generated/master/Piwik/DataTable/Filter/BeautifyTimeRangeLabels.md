<small>Piwik\DataTable\Filter</small>

BeautifyTimeRangeLabels
=======================

A DataTable filter that replaces range labels whose values are in seconds with prettier, human-friendlier versions.

Description
-----------

This filter customizes the behavior of the [BeautifyRangeLabels](#) filter
so range values that are less than one minute are displayed in seconds but
other ranges are displayed in minutes.

**Basic usage**

    $dataTable->filter('BeautifyTimeRangeLabels', array("%1$s-%2$s min", "1 min", "%s min"));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getSingleUnitLabel()`](#getSingleUnitLabel) &mdash; Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.
- [`getRangeLabel()`](#getRangeLabel) &mdash; Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.
- [`getUnboundedLabel()`](#getUnboundedLabel) &mdash; Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
    - `$labelSecondsPlural`
    - `$labelMinutesSingular`
    - `$labelMinutesPlural`
- It does not return anything.

### `getSingleUnitLabel()` <a name="getSingleUnitLabel"></a>

Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.

#### Description

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldLabel`
    - `$lowerBound`
- _Returns:_ The pretty range label.
    - `string`

### `getRangeLabel()` <a name="getRangeLabel"></a>

Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.

#### Description

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldLabel`
    - `$lowerBound`
    - `$upperBound`
- _Returns:_ The pretty range label.
    - `string`

### `getUnboundedLabel()` <a name="getUnboundedLabel"></a>

Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

#### Description

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldLabel`
    - `$lowerBound`
- _Returns:_ The pretty range label.
    - `string`


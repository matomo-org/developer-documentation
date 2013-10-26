<small>Piwik</small>

Period
======

Date range representation.

Description
-----------

Piwik allows users to view aggregated statistics for each day and for date
ranges consisting of several days. When requesting data, a _date_ string and
a _period_ string must be used to specify the date range to view statistics
for. This is the class that Piwik uses to represent and manipulate those
date ranges.

There are five types of periods in Piwik: day, week, month, year and range,
where **range** is any date range. The reason the other periods exist instead
of just **range** is that Piwik will archive for days, weeks, months and years
periodically, while every other date range is archived on-demand.

### Examples

**Building a period from &#039;date&#039; and &#039;period&#039; query parameters**

    $date = Common::getRequestVar(&#039;date&#039;, null, &#039;string&#039;);
    $period = Common::getRequestVar(&#039;period&#039;, null, &#039;string&#039;);
    $periodObject = Period::advancedFactory($period, $date);


Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`factory()`](#factory) &mdash; Creates a new Period instance with a period ID and Date instance.
- [`isMultiplePeriod()`](#isMultiplePeriod) &mdash; Returns true $dateString and $period correspond to multiple periods.
- [`advancedFactory()`](#advancedFactory) &mdash; The advanced factory method is easier to use from the API than the factory method above.
- [`makePeriodFromQueryParams()`](#makePeriodFromQueryParams) &mdash; Creates a period instance using a Site instance and two strings describing the period &amp; date.
- [`getDateStart()`](#getDateStart) &mdash; Returns the first day of the period.
- [`getDateEnd()`](#getDateEnd) &mdash; Returns the last day of the period.
- [`getId()`](#getId) &mdash; Returns the period ID.
- [`getLabel()`](#getLabel) &mdash; Returns the label for the current period.
- [`getNumberOfSubperiods()`](#getNumberOfSubperiods) &mdash; Returns the number of available subperiods.
- [`getSubperiods()`](#getSubperiods) &mdash; Returns the set of Period instances that together make up this period.
- [`toString()`](#toString) &mdash; Returns a list of strings representing the current period.
- [`__toString()`](#__toString) &mdash; See [toString](#toString).
- [`get()`](#get)
- [`getPrettyString()`](#getPrettyString) &mdash; Returns a pretty string describing this period.
- [`getLocalizedShortString()`](#getLocalizedShortString) &mdash; Returns a short string description of this period that is localized with the currently used language.
- [`getLocalizedLongString()`](#getLocalizedLongString) &mdash; Returns a long string description of this period that is localized with the currently used language.
- [`getRangeString()`](#getRangeString) &mdash; Returns a succinct string describing this period.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- It does not return anything.

### `factory()` <a name="factory"></a>

Creates a new Period instance with a period ID and Date instance.

#### Description

Note: This method cannot create Range periods.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$strPeriod`
    - `$date` ([`Date`](../Piwik/Date.md))
- It returns a(n) [`Period`](../Piwik/Period.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If `$strPeriod` is invalid.

### `isMultiplePeriod()` <a name="isMultiplePeriod"></a>

Returns true $dateString and $period correspond to multiple periods.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$dateString`
    - `$period`
- It returns a(n) `boolean` value.

### `advancedFactory()` <a name="advancedFactory"></a>

The advanced factory method is easier to use from the API than the factory method above.

#### Description

It doesn&#039;t require an instance of Date and works for
period=range. Generally speaking, anything that can be passed as period
and range to the API methods can directly be forwarded to this factory
method in order to get a suitable instance of Period.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$strPeriod`
    - `$strDate`
- It returns a(n) [`Period`](../Piwik/Period.md) value.

### `makePeriodFromQueryParams()` <a name="makePeriodFromQueryParams"></a>

Creates a period instance using a Site instance and two strings describing the period &amp; date.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$timezone`
    - `$period`
    - `$date`
- It returns a(n) [`Period`](../Piwik/Period.md) value.

### `getDateStart()` <a name="getDateStart"></a>

Returns the first day of the period.

#### Signature

- It is a **public** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `getDateEnd()` <a name="getDateEnd"></a>

Returns the last day of the period.

#### Signature

- It is a **public** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `getId()` <a name="getId"></a>

Returns the period ID.

#### Signature

- It is a **public** method.
- _Returns:_ A integer unique to this type of period.
    - `int`

### `getLabel()` <a name="getLabel"></a>

Returns the label for the current period.

#### Signature

- It is a **public** method.
- _Returns:_ `&quot;day&quot;`, `&quot;week&quot;`, `&quot;month&quot;`, `&quot;year&quot;`, `&quot;range&quot;`
    - `string`

### `getNumberOfSubperiods()` <a name="getNumberOfSubperiods"></a>

Returns the number of available subperiods.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `getSubperiods()` <a name="getSubperiods"></a>

Returns the set of Period instances that together make up this period.

#### Description

For a year,
this would be 12 months. For a month this would be 28-31 days. Etc.

#### Signature

- It is a **public** method.
- It returns a(n) [`Period[]`](../Piwik/Period.md) value.

### `toString()` <a name="toString"></a>

Returns a list of strings representing the current period.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$format`
- _Returns:_ An array of string dates that this period consists of.
    - `array`

### `__toString()` <a name="__toString"></a>

See [toString](#toString).

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `get()` <a name="get"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$part`
- It does not return anything.

### `getPrettyString()` <a name="getPrettyString"></a>

Returns a pretty string describing this period.

#### Signature

- It is a **public abstract** method.
- It returns a(n) `string` value.

### `getLocalizedShortString()` <a name="getLocalizedShortString"></a>

Returns a short string description of this period that is localized with the currently used language.

#### Signature

- It is a **public abstract** method.
- It returns a(n) `string` value.

### `getLocalizedLongString()` <a name="getLocalizedLongString"></a>

Returns a long string description of this period that is localized with the currently used language.

#### Signature

- It is a **public abstract** method.
- It returns a(n) `string` value.

### `getRangeString()` <a name="getRangeString"></a>

Returns a succinct string describing this period.

#### Signature

- It is a **public** method.
- _Returns:_ eg, `&#039;2012-01-01,2012-01-31&#039;`.
    - `string`


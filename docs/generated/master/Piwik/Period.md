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

**Building a period from 'date' and 'period' query parameters**

    $date = Common::getRequestVar('date', null, 'string');
    $period = Common::getRequestVar('period', null, 'string');
    $periodObject = Period::advancedFactory($period, $date);


Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`factory()`](#factory) &mdash; Creates a new Period instance with a period ID and Date instance.
- [`isMultiplePeriod()`](#ismultipleperiod) &mdash; Returns true $dateString and $period correspond to multiple periods.
- [`makePeriodFromQueryParams()`](#makeperiodfromqueryparams) &mdash; Creates a period instance using a Site instance and two strings describing the period & date.
- [`getDateStart()`](#getdatestart) &mdash; Returns the first day of the period.
- [`getDateEnd()`](#getdateend) &mdash; Returns the last day of the period.
- [`getId()`](#getid) &mdash; Returns the period ID.
- [`getLabel()`](#getlabel) &mdash; Returns the label for the current period.
- [`getNumberOfSubperiods()`](#getnumberofsubperiods) &mdash; Returns the number of available subperiods.
- [`getSubperiods()`](#getsubperiods) &mdash; Returns the set of Period instances that together make up this period.
- [`toString()`](#tostring) &mdash; Returns a list of strings representing the current period.
- [`__toString()`](#__tostring) &mdash; See [toString](#toString).
- [`getPrettyString()`](#getprettystring) &mdash; Returns a pretty string describing this period.
- [`getLocalizedShortString()`](#getlocalizedshortstring) &mdash; Returns a short string description of this period that is localized with the currently used language.
- [`getLocalizedLongString()`](#getlocalizedlongstring) &mdash; Returns a long string description of this period that is localized with the currently used language.
- [`getRangeString()`](#getrangestring) &mdash; Returns a succinct string describing this period.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- It does not return anything.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Creates a new Period instance with a period ID and Date instance.

#### Description

Note: This method cannot create Range periods.

#### Signature

- It accepts the following parameter(s):
    - `$strPeriod`
    - `$date`
- It returns a [`Period`](../Piwik/Period.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If `$strPeriod` is invalid.

<a name="ismultipleperiod" id="ismultipleperiod"></a>
<a name="isMultiplePeriod" id="isMultiplePeriod"></a>
### `isMultiplePeriod()`

Returns true $dateString and $period correspond to multiple periods.

#### Signature

- It accepts the following parameter(s):
    - `$dateString`
    - `$period`
- It returns a `boolean` value.

<a name="makeperiodfromqueryparams" id="makeperiodfromqueryparams"></a>
<a name="makePeriodFromQueryParams" id="makePeriodFromQueryParams"></a>
### `makePeriodFromQueryParams()`

Creates a period instance using a Site instance and two strings describing the period & date.

#### Signature

- It accepts the following parameter(s):
    - `$timezone`
    - `$period`
    - `$date`
- It returns a [`Period`](../Piwik/Period.md) value.

<a name="getdatestart" id="getdatestart"></a>
<a name="getDateStart" id="getDateStart"></a>
### `getDateStart()`

Returns the first day of the period.

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.

<a name="getdateend" id="getdateend"></a>
<a name="getDateEnd" id="getDateEnd"></a>
### `getDateEnd()`

Returns the last day of the period.

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Returns the period ID.

#### Signature

- _Returns:_ A integer unique to this type of period.
    - `int`

<a name="getlabel" id="getlabel"></a>
<a name="getLabel" id="getLabel"></a>
### `getLabel()`

Returns the label for the current period.

#### Signature

- _Returns:_ `"day"`, `"week"`, `"month"`, `"year"`, `"range"`
    - `string`

<a name="getnumberofsubperiods" id="getnumberofsubperiods"></a>
<a name="getNumberOfSubperiods" id="getNumberOfSubperiods"></a>
### `getNumberOfSubperiods()`

Returns the number of available subperiods.

#### Signature

- It returns a `int` value.

<a name="getsubperiods" id="getsubperiods"></a>
<a name="getSubperiods" id="getSubperiods"></a>
### `getSubperiods()`

Returns the set of Period instances that together make up this period.

#### Description

For a year,
this would be 12 months. For a month this would be 28-31 days. Etc.

#### Signature

- It returns a [`Period[]`](../Piwik/Period.md) value.

<a name="tostring" id="tostring"></a>
<a name="toString" id="toString"></a>
### `toString()`

Returns a list of strings representing the current period.

#### Signature

- It accepts the following parameter(s):
    - `$format`
- _Returns:_ An array of string dates that this period consists of.
    - `array`

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

See [toString](#toString).

#### Signature

- It returns a `string` value.

<a name="getprettystring" id="getprettystring"></a>
<a name="getPrettyString" id="getPrettyString"></a>
### `getPrettyString()`

Returns a pretty string describing this period.

#### Signature

- It returns a `string` value.

<a name="getlocalizedshortstring" id="getlocalizedshortstring"></a>
<a name="getLocalizedShortString" id="getLocalizedShortString"></a>
### `getLocalizedShortString()`

Returns a short string description of this period that is localized with the currently used language.

#### Signature

- It returns a `string` value.

<a name="getlocalizedlongstring" id="getlocalizedlongstring"></a>
<a name="getLocalizedLongString" id="getLocalizedLongString"></a>
### `getLocalizedLongString()`

Returns a long string description of this period that is localized with the currently used language.

#### Signature

- It returns a `string` value.

<a name="getrangestring" id="getrangestring"></a>
<a name="getRangeString" id="getRangeString"></a>
### `getRangeString()`

Returns a succinct string describing this period.

#### Signature

- _Returns:_ eg, `'2012-01-01,2012-01-31'`.
    - `string`


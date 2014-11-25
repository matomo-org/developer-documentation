<small>Piwik\</small>

Period
======

Date range representation.

Piwik allows users to view aggregated statistics for single days and for date
ranges consisting of several days. When requesting data, a **date** string and
a **period** string must be used to specify the date range that the data regards.
This is the class Piwik uses to represent and manipulate those date ranges.

There are five types of periods in Piwik: day, week, month, year and range,
where **range** is any date range. The reason the other periods exist instead
of just **range** is that Piwik will pre-archive reports for days, weeks, months
and years, while every custom date range is archived on-demand.

Methods
-------

The abstract class defines the following methods:

- [`factory()`](#factory)
- [`isMultiplePeriod()`](#ismultipleperiod) &mdash; Returns true if `$dateString` and `$period` represent multiple periods.
- [`getDateStart()`](#getdatestart) &mdash; Returns the first day of the period.
- [`getDateEnd()`](#getdateend) &mdash; Returns the last day of the period.
- [`getId()`](#getid) &mdash; Returns the period ID.
- [`getLabel()`](#getlabel) &mdash; Returns the label for the current period.
- [`getNumberOfSubperiods()`](#getnumberofsubperiods) &mdash; Returns the number of available subperiods.
- [`getSubperiods()`](#getsubperiods) &mdash; Returns the set of Period instances that together make up this period.
- [`toString()`](#tostring) &mdash; Returns a list of strings representing the current period.
- [`__toString()`](#__tostring) &mdash; See [toString()](/api-reference/Piwik/Period#tostring).
- [`getPrettyString()`](#getprettystring) &mdash; Returns a pretty string describing this period.
- [`getLocalizedShortString()`](#getlocalizedshortstring) &mdash; Returns a short string description of this period that is localized with the currently used language.
- [`getLocalizedLongString()`](#getlocalizedlongstring) &mdash; Returns a long string description of this period that is localized with the currently used language.
- [`getRangeString()`](#getrangestring) &mdash; Returns the date range string comprising two dates

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

#### Signature

-  It accepts the following parameter(s):
    - `$period` (`Piwik\$period`) &mdash;
      
    - `$date` (`Piwik\$date`) &mdash;
      
- It returns a [`Period`](../Piwik/Period.md) value.

<a name="ismultipleperiod" id="ismultipleperiod"></a>
<a name="isMultiplePeriod" id="isMultiplePeriod"></a>
### `isMultiplePeriod()`

Returns true if `$dateString` and `$period` represent multiple periods.

Will return true for date/period combinations where date references multiple
dates and period is not `'range'`. For example, will return true for:

- **date** = `2012-01-01,2012-02-01` and **period** = `'day'`
- **date** = `2012-01-01,2012-02-01` and **period** = `'week'`
- **date** = `last7` and **period** = `'month'`

etc.

#### Signature

-  It accepts the following parameter(s):
    - `$dateString`
      
    - `$period`
      
- It returns a `boolean` value.

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


- *Returns:*  `int` &mdash;
    A unique integer for this type of period.

<a name="getlabel" id="getlabel"></a>
<a name="getLabel" id="getLabel"></a>
### `getLabel()`

Returns the label for the current period.

#### Signature


- *Returns:*  `string` &mdash;
    `"day"`, `"week"`, `"month"`, `"year"`, `"range"`

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

For a year,
this would be 12 months. For a month this would be 28-31 days. Etc.

#### Signature

- It returns a [`Period[]`](../Piwik/Period.md) value.

<a name="tostring" id="tostring"></a>
<a name="toString" id="toString"></a>
### `toString()`

Returns a list of strings representing the current period.

#### Signature

-  It accepts the following parameter(s):
    - `$format` (`string`) &mdash;
       The format of each individual day.

- *Returns:*  `array` &mdash;
    An array of string dates that this period consists of.

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

See [toString()](/api-reference/Piwik/Period#tostring).

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

Returns the date range string comprising two dates

#### Signature


- *Returns:*  `string` &mdash;
    eg, `'2012-01-01,2012-01-31'`.


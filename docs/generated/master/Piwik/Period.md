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
and years, while every other date range is archived on-demand.

### Examples

**Building a period from 'date' and 'period' query parameters**

    $date = Common::getRequestVar('date', null, 'string');
    $period = Common::getRequestVar('period', null, 'string');
    $periodObject = Period::advancedFactory($period, $date);

Methods
-------

The abstract class defines the following methods:

- [`factory()`](#factory) &mdash; Creates a new Period instance with a period ID and [Date](/api-reference/Piwik/Date) instance.
- [`isMultiplePeriod()`](#ismultipleperiod) &mdash; Returns true if `$dateString` and `$period` represent multiple periods.
- [`makePeriodFromQueryParams()`](#makeperiodfromqueryparams) &mdash; Creates a Period instance using a period, date and timezone.
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
- [`getRangeString()`](#getrangestring) &mdash; Returns a succinct string describing this period.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Creates a new Period instance with a period ID and [Date](/api-reference/Piwik/Date) instance.

_Note: This method cannot create [Period\Range](/api-reference/Piwik/Period/Range) periods._

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$strPeriod` (`string`) &mdash;

      <div markdown="1" class="param-desc"> `"day"`, `"week"`, `"month"`, `"year"`, `"range"`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$date` ([`Date`](../Piwik/Date.md)|`string`) &mdash;

      <div markdown="1" class="param-desc"> A date within the period or the range of dates.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a [`Period`](../Piwik/Period.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If `$strPeriod` is invalid.

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

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$dateString`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$period`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `boolean` value.

<a name="makeperiodfromqueryparams" id="makeperiodfromqueryparams"></a>
<a name="makePeriodFromQueryParams" id="makePeriodFromQueryParams"></a>
### `makePeriodFromQueryParams()`

Creates a Period instance using a period, date and timezone.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$timezone` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The timezone of the date. Only used if `$date` is `'now'`, `'today'`, `'yesterday'` or `'yesterdaySameTime'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$period` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The period string: `"day"`, `"week"`, `"month"`, `"year"`, `"range"`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$date` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The date or date range string. Can be a special value including `'now'`, `'today'`, `'yesterday'`, `'yesterdaySameTime'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
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


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`int`) &mdash;
    <div markdown="1" class="param-desc">A unique integer for this type of period.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getlabel" id="getlabel"></a>
<a name="getLabel" id="getLabel"></a>
### `getLabel()`

Returns the label for the current period.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">`"day"`, `"week"`, `"month"`, `"year"`, `"range"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

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

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$format` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The format of each individual day.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array of string dates that this period consists of.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

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

Returns a succinct string describing this period.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `'2012-01-01,2012-01-31'`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>


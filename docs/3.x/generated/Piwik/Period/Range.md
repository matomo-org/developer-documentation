<small>Piwik\Period\</small>

Range
=====

Arbitrary date range representation.

This class represents a period that contains a list of consecutive days as subperiods
It is created when the **period** query parameter is set to **range** and is used
to calculate the subperiods of multiple period requests (eg, when period=day and
date=2007-07-24,2013-11-15).

The range period differs from other periods mainly in that since it is arbitrary,
range periods are not pre-archived by the cron core:archive command.

Methods
-------

The class defines the following methods:

- [`__sleep()`](#__sleep)
- [`__wakeup()`](#__wakeup)
- [`isMultiplePeriod()`](#ismultipleperiod) &mdash; Returns true if `$dateString` and `$period` represent multiple periods. Inherited from [`Period`](../../Piwik/Period.md)
- [`checkDateFormat()`](#checkdateformat) &mdash; Checks the given date format whether it is a correct date format and if not, throw an exception. Inherited from [`Period`](../../Piwik/Period.md)
- [`getDateStart()`](#getdatestart) &mdash; Returns the start date of the period.
- [`getDateTimeStart()`](#getdatetimestart) &mdash; Returns the start date & time of this period. Inherited from [`Period`](../../Piwik/Period.md)
- [`getDateTimeEnd()`](#getdatetimeend) &mdash; Returns the end date & time of this period. Inherited from [`Period`](../../Piwik/Period.md)
- [`getDateEnd()`](#getdateend) &mdash; Returns the end date of the period.
- [`getId()`](#getid) &mdash; Returns the period ID. Inherited from [`Period`](../../Piwik/Period.md)
- [`getLabel()`](#getlabel) &mdash; Returns the label for the current period. Inherited from [`Period`](../../Piwik/Period.md)
- [`getNumberOfSubperiods()`](#getnumberofsubperiods) &mdash; Returns the number of available subperiods. Inherited from [`Period`](../../Piwik/Period.md)
- [`getSubperiods()`](#getsubperiods) &mdash; Returns the set of Period instances that together make up this period. Inherited from [`Period`](../../Piwik/Period.md)
- [`isDateInPeriod()`](#isdateinperiod) &mdash; Returns whether the date `$date` is within the current period or not. Inherited from [`Period`](../../Piwik/Period.md)
- [`toString()`](#tostring) &mdash; Returns a list of strings representing the current period. Inherited from [`Period`](../../Piwik/Period.md)
- [`__toString()`](#__tostring) &mdash; See [toString()](/api-reference/Piwik/Period/Range#tostring). Inherited from [`Period`](../../Piwik/Period.md)
- [`getPrettyString()`](#getprettystring) &mdash; Returns the current period as a string.
- [`getLocalizedShortString()`](#getlocalizedshortstring) &mdash; Returns the current period as a localized short string.
- [`getLocalizedLongString()`](#getlocalizedlongstring) &mdash; Returns the current period as a localized long string.
- [`getRangeString()`](#getrangestring) &mdash; Returns the date range string comprising two dates
- [`__construct()`](#__construct) &mdash; Constructor.
- [`setDefaultEndDate()`](#setdefaultenddate) &mdash; Sets the default end date of the period.
- [`parseDateRange()`](#parsedaterange) &mdash; Given a date string, returns `false` if not a date range, or returns the array containing start and end dates.
- [`getLastDate()`](#getlastdate) &mdash; Returns the date that is one period before the supplied date.
- [`getDateXPeriodsAgo()`](#getdatexperiodsago) &mdash; Returns the date that is X periods before the supplied date.
- [`getRelativeToEndDate()`](#getrelativetoenddate) &mdash; Returns a date range string given a period type, end date and number of periods the range spans over.
- [`getImmediateChildPeriodLabel()`](#getimmediatechildperiodlabel)
- [`getParentPeriodLabel()`](#getparentperiodlabel)

<a name="__sleep" id="__sleep"></a>
<a name="__sleep" id="__sleep"></a>
### `__sleep()`

#### Signature

- It does not return anything.

<a name="__wakeup" id="__wakeup"></a>
<a name="__wakeup" id="__wakeup"></a>
### `__wakeup()`

#### Signature

- It does not return anything.

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
       string The **date** query parameter value.
    - `$period`
       string The **period** query parameter value.
- It returns a `boolean` value.

<a name="checkdateformat" id="checkdateformat"></a>
<a name="checkDateFormat" id="checkDateFormat"></a>
### `checkDateFormat()`

Checks the given date format whether it is a correct date format and if not, throw an exception.

For valid date formats have a look at the [Date::factory()](/api-reference/Piwik/Date#factory) method and
[isMultiplePeriod()](/api-reference/Piwik/Period/Range#ismultipleperiod) method.

#### Signature

-  It accepts the following parameter(s):
    - `$dateString` (`string`) &mdash;
      
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If `$dateString` is in an invalid format or if the time is before
                  Tue, 06 Aug 1991.

<a name="getdatestart" id="getdatestart"></a>
<a name="getDateStart" id="getDateStart"></a>
### `getDateStart()`

Returns the start date of the period.

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getdatetimestart" id="getdatetimestart"></a>
<a name="getDateTimeStart" id="getDateTimeStart"></a>
### `getDateTimeStart()`

Returns the start date & time of this period.

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.

<a name="getdatetimeend" id="getdatetimeend"></a>
<a name="getDateTimeEnd" id="getDateTimeEnd"></a>
### `getDateTimeEnd()`

Returns the end date & time of this period.

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.

<a name="getdateend" id="getdateend"></a>
<a name="getDateEnd" id="getDateEnd"></a>
### `getDateEnd()`

Returns the end date of the period.

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.

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

Returns the set of Period instances that together make up this period. For a year,
this would be 12 months. For a month this would be 28-31 days. Etc.

#### Signature

- It returns a [`Period[]`](../../Piwik/Period.md) value.

<a name="isdateinperiod" id="isdateinperiod"></a>
<a name="isDateInPeriod" id="isDateInPeriod"></a>
### `isDateInPeriod()`

Returns whether the date `$date` is within the current period or not.

Note: the time component of the period's dates and `$date` is ignored.

#### Signature

-  It accepts the following parameter(s):
    - `$date` ([`Date`](../../Piwik/Date.md)) &mdash;
      
- It returns a `bool` value.

<a name="tostring" id="tostring"></a>
<a name="toString" id="toString"></a>
### `toString()`

Returns a list of strings representing the current period.

#### Signature

-  It accepts the following parameter(s):
    - `$format` (`string`) &mdash;
       The format of each individual day.

- *Returns:*  `array`|`string` &mdash;
    An array of string dates that this period consists of.

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

See [toString()](/api-reference/Piwik/Period/Range#tostring).

#### Signature

- It returns a `string` value.

<a name="getprettystring" id="getprettystring"></a>
<a name="getPrettyString" id="getPrettyString"></a>
### `getPrettyString()`

Returns the current period as a string.

#### Signature

- It returns a `string` value.

<a name="getlocalizedshortstring" id="getlocalizedshortstring"></a>
<a name="getLocalizedShortString" id="getLocalizedShortString"></a>
### `getLocalizedShortString()`

Returns the current period as a localized short string.

#### Signature

- It returns a `string` value.

<a name="getlocalizedlongstring" id="getlocalizedlongstring"></a>
<a name="getLocalizedLongString" id="getLocalizedLongString"></a>
### `getLocalizedLongString()`

Returns the current period as a localized long string.

#### Signature

- It returns a `string` value.

<a name="getrangestring" id="getrangestring"></a>
<a name="getRangeString" id="getRangeString"></a>
### `getRangeString()`

Returns the date range string comprising two dates

#### Signature


- *Returns:*  `string` &mdash;
    eg, `'2012-01-01,2012-01-31'`.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$strPeriod` (`string`) &mdash;
       The type of period each subperiod is. Either `'day'`, `'week'`, `'month'` or `'year'`.
    - `$strDate` (`string`) &mdash;
       The date range, eg, `'2007-07-24,2013-11-15'`.
    - `$timezone` (`string`) &mdash;
       The timezone to use, eg, `'UTC'`.
    - `$today` (`bool`|[`Date`](../../Piwik/Date.md)) &mdash;
       The date to use as _today_. Defaults to `Date::factory('today', $timzeone)`.

<a name="setdefaultenddate" id="setdefaultenddate"></a>
<a name="setDefaultEndDate" id="setDefaultEndDate"></a>
### `setDefaultEndDate()`

Sets the default end date of the period.

#### Signature

-  It accepts the following parameter(s):
    - `$oDate` ([`Date`](../../Piwik/Date.md)) &mdash;
      
- It does not return anything.

<a name="parsedaterange" id="parsedaterange"></a>
<a name="parseDateRange" id="parseDateRange"></a>
### `parseDateRange()`

Given a date string, returns `false` if not a date range,
or returns the array containing start and end dates.

#### Signature

-  It accepts the following parameter(s):
    - `$dateString` (`string`) &mdash;
      

- *Returns:*  `mixed` &mdash;
    array(1 => dateStartString, 2 => dateEndString) or `false` if the input was not a date range.

<a name="getlastdate" id="getlastdate"></a>
<a name="getLastDate" id="getLastDate"></a>
### `getLastDate()`

Returns the date that is one period before the supplied date.

#### Signature

-  It accepts the following parameter(s):
    - `$date` (`bool`|`string`) &mdash;
       The date to get the last date of.
    - `$period` (`bool`|`string`) &mdash;
       The period to use (either 'day', 'week', 'month', 'year');

- *Returns:*  `array` &mdash;
    An array with two elements, a string for the date before $date and
              a Period instance for the period before $date.

<a name="getdatexperiodsago" id="getdatexperiodsago"></a>
<a name="getDateXPeriodsAgo" id="getDateXPeriodsAgo"></a>
### `getDateXPeriodsAgo()`

Returns the date that is X periods before the supplied date.

#### Signature

-  It accepts the following parameter(s):
    - `$subXPeriods`
      
    - `$date`
      
    - `$period`
      

- *Returns:*  `array` &mdash;
    An array with two elements, a string for the date before $date and
              a Period instance for the period before $date.

<a name="getrelativetoenddate" id="getrelativetoenddate"></a>
<a name="getRelativeToEndDate" id="getRelativeToEndDate"></a>
### `getRelativeToEndDate()`

Returns a date range string given a period type, end date and number of periods
the range spans over.

#### Signature

-  It accepts the following parameter(s):
    - `$period` (`string`) &mdash;
       The sub period type, `'day'`, `'week'`, `'month'` and `'year'`.
    - `$lastN` (`int`) &mdash;
       The number of periods of type `$period` that the result range should span.
    - `$endDate` (`string`) &mdash;
       The desired end date of the range.
    - `$site` ([`Site`](../../Piwik/Site.md)) &mdash;
       The site whose timezone should be used.

- *Returns:*  `string` &mdash;
    The date range string, eg, `'2012-01-02,2013-01-02'`.

<a name="getimmediatechildperiodlabel" id="getimmediatechildperiodlabel"></a>
<a name="getImmediateChildPeriodLabel" id="getImmediateChildPeriodLabel"></a>
### `getImmediateChildPeriodLabel()`

#### Signature

- It does not return anything.

<a name="getparentperiodlabel" id="getparentperiodlabel"></a>
<a name="getParentPeriodLabel" id="getParentPeriodLabel"></a>
### `getParentPeriodLabel()`

#### Signature

- It does not return anything.


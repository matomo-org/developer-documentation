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

- [`factory()`](#factory) Inherited from [`Period`](../../Piwik/Period.md)
- [`isMultiplePeriod()`](#ismultipleperiod) &mdash; Returns true if `$dateString` and `$period` represent multiple periods. Inherited from [`Period`](../../Piwik/Period.md)
- [`getDateStart()`](#getdatestart) &mdash; Returns the start date of the period.
- [`getDateEnd()`](#getdateend) &mdash; Returns the end date of the period.
- [`getId()`](#getid) &mdash; Returns the period ID. Inherited from [`Period`](../../Piwik/Period.md)
- [`getLabel()`](#getlabel) &mdash; Returns the label for the current period. Inherited from [`Period`](../../Piwik/Period.md)
- [`getNumberOfSubperiods()`](#getnumberofsubperiods) &mdash; Returns the number of available subperiods. Inherited from [`Period`](../../Piwik/Period.md)
- [`getSubperiods()`](#getsubperiods) &mdash; Returns the set of Period instances that together make up this period. Inherited from [`Period`](../../Piwik/Period.md)
- [`toString()`](#tostring) &mdash; Returns a list of strings representing the current period. Inherited from [`Period`](../../Piwik/Period.md)
- [`__toString()`](#__tostring) &mdash; See [toString()](/api-reference/Piwik/Period/Range#tostring). Inherited from [`Period`](../../Piwik/Period.md)
- [`getPrettyString()`](#getprettystring) &mdash; Returns the current period as a string.
- [`getLocalizedShortString()`](#getlocalizedshortstring) &mdash; Returns the current period as a localized short string.
- [`getLocalizedLongString()`](#getlocalizedlongstring) &mdash; Returns the current period as a localized long string.
- [`getRangeString()`](#getrangestring) &mdash; Returns the date range string comprising two dates Inherited from [`Period`](../../Piwik/Period.md)
- [`__construct()`](#__construct) &mdash; Constructor.
- [`setDefaultEndDate()`](#setdefaultenddate) &mdash; Sets the default end date of the period.
- [`parseDateRange()`](#parsedaterange) &mdash; Given a date string, returns `false` if not a date range, or returns the array containing start and end dates.
- [`getLastDate()`](#getlastdate) &mdash; Returns the date that is one period before the supplied date.
- [`getDateXPeriodsAgo()`](#getdatexperiodsago) &mdash; Returns the date that is X periods before the supplied date.
- [`getRelativeToEndDate()`](#getrelativetoenddate) &mdash; Returns a date range string given a period type, end date and number of periods the range spans over.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$period` (`Piwik\$period`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$date` (`Piwik\$date`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a [`Period`](../../Piwik/Period.md) value.

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

<a name="getdatestart" id="getdatestart"></a>
<a name="getDateStart" id="getDateStart"></a>
### `getDateStart()`

Returns the start date of the period.

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getdateend" id="getdateend"></a>
<a name="getDateEnd" id="getDateEnd"></a>
### `getDateEnd()`

Returns the end date of the period.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`null`|[`Date`](../../Piwik/Date.md)) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

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

- It returns a [`Period[]`](../../Piwik/Period.md) value.

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


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `'2012-01-01,2012-01-31'`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$strPeriod` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The type of period each subperiod is. Either `'day'`, `'week'`, `'month'` or `'year'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$strDate` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The date range, eg, `'2007-07-24,2013-11-15'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$timezone` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The timezone to use, eg, `'UTC'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$today` (`bool`|[`Date`](../../Piwik/Date.md)) &mdash;

      <div markdown="1" class="param-desc"> The date to use as _today_. Defaults to `Date::factory('today', $timzeone)`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="setdefaultenddate" id="setdefaultenddate"></a>
<a name="setDefaultEndDate" id="setDefaultEndDate"></a>
### `setDefaultEndDate()`

Sets the default end date of the period.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$oDate` ([`Date`](../../Piwik/Date.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="parsedaterange" id="parsedaterange"></a>
<a name="parseDateRange" id="parseDateRange"></a>
### `parseDateRange()`

Given a date string, returns `false` if not a date range, or returns the array containing start and end dates.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$dateString` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`mixed`) &mdash;
    <div markdown="1" class="param-desc">array(1 => dateStartString, 2 => dateEndString) or `false` if the input was not a date range.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getlastdate" id="getlastdate"></a>
<a name="getLastDate" id="getLastDate"></a>
### `getLastDate()`

Returns the date that is one period before the supplied date.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$date` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"> The date to get the last date of.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$period` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"> The period to use (either 'day', 'week', 'month', 'year');</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array with two elements, a string for the date before $date and a Period instance for the period before $date.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getdatexperiodsago" id="getdatexperiodsago"></a>
<a name="getDateXPeriodsAgo" id="getDateXPeriodsAgo"></a>
### `getDateXPeriodsAgo()`

Returns the date that is X periods before the supplied date.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$subXPeriods`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$date`

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

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array with two elements, a string for the date before $date and a Period instance for the period before $date.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getrelativetoenddate" id="getrelativetoenddate"></a>
<a name="getRelativeToEndDate" id="getRelativeToEndDate"></a>
### `getRelativeToEndDate()`

Returns a date range string given a period type, end date and number of periods the range spans over.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$period` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The sub period type, `'day'`, `'week'`, `'month'` and `'year'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$lastN` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The number of periods of type `$period` that the result range should span.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$endDate` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The desired end date of the range.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$site` ([`Site`](../../Piwik/Site.md)) &mdash;

      <div markdown="1" class="param-desc"> The site whose timezone should be used.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The date range string, eg, `'2012-01-02,2013-01-02'`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>


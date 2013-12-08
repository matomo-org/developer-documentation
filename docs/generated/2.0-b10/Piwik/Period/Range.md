<small>Piwik\Period\</small>

Range
=====

Arbitrary date range representation.

This class represents a period that contains a list of consecutive days as subperiods
It is created when the **period** query parameter is set to **range** and is used
to calculate the subperiods of multiple period requests (eg, when period=day and
date=2007-07-24,2013-11-15).

The range period differs from other periods mainly in that since it is arbitrary,
range periods are not archived by the archive.php cron script.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getLocalizedShortString()`](#getlocalizedshortstring) &mdash; Returns the current period as a localized short string.
- [`getLocalizedLongString()`](#getlocalizedlongstring) &mdash; Returns the current period as a localized long string.
- [`getDateStart()`](#getdatestart) &mdash; Returns the start date of the period
- [`getPrettyString()`](#getprettystring) &mdash; Returns the current period as a string
- [`setDefaultEndDate()`](#setdefaultenddate) &mdash; Sets the default end date of the period
- [`parseDateRange()`](#parsedaterange) &mdash; Given a date string, returns false if not a date range, or returns the array containing date start, date end
- [`getDateEnd()`](#getdateend) &mdash; Returns the end date of the period
- [`getLastDate()`](#getlastdate) &mdash; Returns the date that is one period before the supplied date.
- [`getRelativeToEndDate()`](#getrelativetoenddate) &mdash; Returns a date ragne string given a period type, end date and number of periods the range spans over.

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

<a name="getdatestart" id="getdatestart"></a>
<a name="getDateStart" id="getDateStart"></a>
### `getDateStart()`

Returns the start date of the period

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getprettystring" id="getprettystring"></a>
<a name="getPrettyString" id="getPrettyString"></a>
### `getPrettyString()`

Returns the current period as a string

#### Signature

- It returns a `string` value.

<a name="setdefaultenddate" id="setdefaultenddate"></a>
<a name="setDefaultEndDate" id="setDefaultEndDate"></a>
### `setDefaultEndDate()`

Sets the default end date of the period

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

Given a date string, returns false if not a date range, or returns the array containing date start, date end

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
    <div markdown="1" class="param-desc">array(1 => dateStartString, 2 => dateEndString ) or false if the input was not a date range</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getdateend" id="getdateend"></a>
<a name="getDateEnd" id="getDateEnd"></a>
### `getDateEnd()`

Returns the end date of the period

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

<a name="getrelativetoenddate" id="getrelativetoenddate"></a>
<a name="getRelativeToEndDate" id="getRelativeToEndDate"></a>
### `getRelativeToEndDate()`

Returns a date ragne string given a period type, end date and number of periods the range spans over.

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
      `$site` (`Piwik\Period\Site`) &mdash;

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


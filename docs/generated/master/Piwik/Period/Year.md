<small>Piwik\Period\</small>

Year
====

Methods
-------

The class defines the following methods:

- [`factory()`](#factory) Inherited from [`Period`](../../Piwik/Period.md)
- [`isMultiplePeriod()`](#ismultipleperiod) &mdash; Returns true if `$dateString` and `$period` represent multiple periods. Inherited from [`Period`](../../Piwik/Period.md)
- [`getDateStart()`](#getdatestart) &mdash; Returns the first day of the period. Inherited from [`Period`](../../Piwik/Period.md)
- [`getDateEnd()`](#getdateend) &mdash; Returns the last day of the period. Inherited from [`Period`](../../Piwik/Period.md)
- [`getId()`](#getid) &mdash; Returns the period ID. Inherited from [`Period`](../../Piwik/Period.md)
- [`getLabel()`](#getlabel) &mdash; Returns the label for the current period. Inherited from [`Period`](../../Piwik/Period.md)
- [`getNumberOfSubperiods()`](#getnumberofsubperiods) &mdash; Returns the number of available subperiods. Inherited from [`Period`](../../Piwik/Period.md)
- [`getSubperiods()`](#getsubperiods) &mdash; Returns the set of Period instances that together make up this period. Inherited from [`Period`](../../Piwik/Period.md)
- [`toString()`](#tostring) &mdash; Returns a list of strings representing the current period. Inherited from [`Period`](../../Piwik/Period.md)
- [`__toString()`](#__tostring) &mdash; See [toString()](/api-reference/Piwik/Period/Year#tostring). Inherited from [`Period`](../../Piwik/Period.md)
- [`getPrettyString()`](#getprettystring) &mdash; Returns a pretty string describing this period. Inherited from [`Period`](../../Piwik/Period.md)
- [`getLocalizedShortString()`](#getlocalizedshortstring) &mdash; Returns a short string description of this period that is localized with the currently used language. Inherited from [`Period`](../../Piwik/Period.md)
- [`getLocalizedLongString()`](#getlocalizedlongstring) &mdash; Returns a long string description of this period that is localized with the currently used language. Inherited from [`Period`](../../Piwik/Period.md)
- [`getRangeString()`](#getrangestring) &mdash; Returns the date range string comprising two dates Inherited from [`Period`](../../Piwik/Period.md)

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

Returns the first day of the period.

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.

<a name="getdateend" id="getdateend"></a>
<a name="getDateEnd" id="getDateEnd"></a>
### `getDateEnd()`

Returns the last day of the period.

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.

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

See [toString()](/api-reference/Piwik/Period/Year#tostring).

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


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `'2012-01-01,2012-01-31'`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>


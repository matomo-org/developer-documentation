<small>Piwik\Period</small>

Range
=====

Arbitrary date range representation.

Description
-----------

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
- [`getLocalizedShortString()`](#getLocalizedShortString) &mdash; Returns the current period as a localized short string.
- [`getLocalizedLongString()`](#getLocalizedLongString) &mdash; Returns the current period as a localized long string.
- [`getDateStart()`](#getDateStart) &mdash; Returns the start date of the period
- [`getPrettyString()`](#getPrettyString) &mdash; Returns the current period as a string
- [`setDefaultEndDate()`](#setDefaultEndDate) &mdash; Sets the default end date of the period
- [`parseDateRange()`](#parseDateRange) &mdash; Given a date string, returns false if not a date range, or returns the array containing date start, date end
- [`getDateEnd()`](#getDateEnd) &mdash; Returns the end date of the period
- [`getLastDate()`](#getLastDate) &mdash; Returns the date that is one period before the supplied date.
- [`getRelativeToEndDate()`](#getRelativeToEndDate) &mdash; Returns a date ragne string given a period type, end date and number of periods the range spans over.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$strPeriod`
    - `$strDate`
    - `$timezone`
    - `$today`
- It does not return anything.

<a name="getlocalizedshortstring" id="getlocalizedshortstring"></a>
### `getLocalizedShortString()`

Returns the current period as a localized short string.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="getlocalizedlongstring" id="getlocalizedlongstring"></a>
### `getLocalizedLongString()`

Returns the current period as a localized long string.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="getdatestart" id="getdatestart"></a>
### `getDateStart()`

Returns the start date of the period

#### Signature

- It is a **public** method.
- It returns a(n) [`Date`](../../Piwik/Date.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getprettystring" id="getprettystring"></a>
### `getPrettyString()`

Returns the current period as a string

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="setdefaultenddate" id="setdefaultenddate"></a>
### `setDefaultEndDate()`

Sets the default end date of the period

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oDate` ([`Date`](../../Piwik/Date.md))
- It does not return anything.

<a name="parsedaterange" id="parsedaterange"></a>
### `parseDateRange()`

Given a date string, returns false if not a date range, or returns the array containing date start, date end

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$dateString`
- _Returns:_ array(1 =&gt; dateStartString, 2 =&gt; dateEndString ) or false if the input was not a date range
    - `mixed`

<a name="getdateend" id="getdateend"></a>
### `getDateEnd()`

Returns the end date of the period

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `null`
    - [`Date`](../../Piwik/Date.md)

<a name="getlastdate" id="getlastdate"></a>
### `getLastDate()`

Returns the date that is one period before the supplied date.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$date`
    - `$period`
- _Returns:_ An array with two elements, a string for the date before $date and a Period instance for the period before $date.
    - `array`

<a name="getrelativetoenddate" id="getrelativetoenddate"></a>
### `getRelativeToEndDate()`

Returns a date ragne string given a period type, end date and number of periods the range spans over.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$period`
    - `$lastN`
    - `$endDate`
    - `$site`
- _Returns:_ The date range string, eg, `&#039;2012-01-02,2013-01-02&#039;`.
    - `string`


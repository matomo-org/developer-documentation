<small>Piwik\</small>

Date
====

Utility class that wraps date/time related PHP functions.

### Performance concerns

The helper methods in this class are instance methods and thus `Date` instances
need to be constructed before they can be used. The memory allocation can result
in noticeable performance degradation if you construct thousands of Date instances,
say, in a loop.

### Examples

**Basic usage**

    $date = Date::factory('2007-07-24 14:04:24', 'EST');
    $date->addHour(5);
    echo $date->getLocalized("EEE, d. MMM y 'at' HH:mm:ss");

Properties
----------

This class defines the following properties:

- [`$now`](#$now)

<a name="$now" id="$now"></a>
<a name="now" id="now"></a>
### `$now`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`factory()`](#factory) &mdash; Creates a new Date instance using a string datetime value.
- [`getDatetime()`](#getdatetime) &mdash; Returns the current timestamp as a string with the following format: `'YYYY-MM-DD HH:MM:SS'`.
- [`getHourUTC()`](#gethourutc) &mdash; Returns the current hour in UTC timezone.
- [`getDateStartUTC()`](#getdatestartutc)
- [`getStartOfDay()`](#getstartofday) &mdash; Returns the start of the day of the current timestamp in UTC.
- [`getDateEndUTC()`](#getdateendutc)
- [`getEndOfDay()`](#getendofday) &mdash; Returns the end of the day of the current timestamp in UTC.
- [`setTimezone()`](#settimezone) &mdash; Returns a new date object with the same timestamp as `$this` but with a new timezone.
- [`getUtcOffset()`](#getutcoffset) &mdash; Returns the offset to UTC time for the given timezone
- [`adjustForTimezone()`](#adjustfortimezone) &mdash; Converts a timestamp from UTC to a timezone.
- [`getDatetimeFromTimestamp()`](#getdatetimefromtimestamp) &mdash; Returns the date in the "Y-m-d H:i:s" PHP format
- [`getTimestampUTC()`](#gettimestamputc) &mdash; Returns the Unix timestamp of the date in UTC.
- [`getTimestamp()`](#gettimestamp) &mdash; Returns the unix timestamp of the date in UTC, converted from the current timestamp timezone.
- [`isLater()`](#islater) &mdash; Returns `true` if the current date is older than the given `$date`.
- [`isEarlier()`](#isearlier) &mdash; Returns `true` if the current date is earlier than the given `$date`.
- [`isLeapYear()`](#isleapyear) &mdash; Returns `true` if the current year is a leap year, false otherwise.
- [`toString()`](#tostring) &mdash; Converts this date to the requested string format.
- [`__toString()`](#__tostring) &mdash; See [toString()](/api-reference/Piwik/Date#tostring).
- [`compareWeek()`](#compareweek) &mdash; Performs three-way comparison of the week of the current date against the given `$date`'s week.
- [`compareMonth()`](#comparemonth) &mdash; Performs three-way comparison of the month of the current date against the given `$date`'s month.
- [`compareYear()`](#compareyear) &mdash; Performs three-way comparison of the month of the current date against the given `$date`'s year.
- [`isToday()`](#istoday) &mdash; Returns `true` if current date is today.
- [`now()`](#now) &mdash; Returns a date object set to now in UTC (same as [today()](/api-reference/Piwik/Date#today), except that the time is also set).
- [`today()`](#today) &mdash; Returns a date object set to today at midnight in UTC.
- [`tomorrow()`](#tomorrow) &mdash; Returns a date object set to tomorrow at midnight in UTC.
- [`yesterday()`](#yesterday) &mdash; Returns a date object set to yesterday at midnight in UTC.
- [`yesterdaySameTime()`](#yesterdaysametime) &mdash; Returns a date object set to yesterday with the current time of day in UTC.
- [`setTime()`](#settime) &mdash; Returns a new Date instance with `$this` date's day and the specified new time of day.
- [`setDay()`](#setday) &mdash; Returns a new Date instance with `$this` date's time of day and the day specified by `$day`.
- [`setYear()`](#setyear) &mdash; Returns a new Date instance with `$this` date's time of day, month and day, but with a new year (specified by `$year`).
- [`subDay()`](#subday) &mdash; Subtracts `$n` number of days from `$this` date and returns a new Date object.
- [`subWeek()`](#subweek) &mdash; Subtracts `$n` weeks from `$this` date and returns a new Date object.
- [`subMonth()`](#submonth) &mdash; Subtracts `$n` months from `$this` date and returns the result as a new Date object.
- [`subYear()`](#subyear) &mdash; Subtracts `$n` years from `$this` date and returns the result as a new Date object.
- [`getLocalized()`](#getlocalized) &mdash; Returns a localized date string using the given template.
- [`addDay()`](#addday) &mdash; Adds `$n` days to `$this` date and returns the result in a new Date.
- [`addHour()`](#addhour) &mdash; Adds `$n` hours to `$this` date and returns the result in a new Date.
- [`addHourTo()`](#addhourto) &mdash; Adds N number of hours to a UNIX timestamp and returns the result.
- [`subHour()`](#subhour) &mdash; Subtracts `$n` hours from `$this` date and returns the result in a new Date.
- [`subSeconds()`](#subseconds) &mdash; Subtracts `$n` seconds from `$this` date and returns the result in a new Date.
- [`addPeriod()`](#addperiod) &mdash; Adds a period to `$this` date and returns the result in a new Date instance.
- [`subPeriod()`](#subperiod) &mdash; Subtracts a period from `$this` date and returns the result in a new Date instance.
- [`secondsToDays()`](#secondstodays) &mdash; Returns the number of days represented by a number of seconds.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Creates a new Date instance using a string datetime value. The timezone of the Date
result will be in UTC.

#### Signature

-  It accepts the following parameter(s):
    - `$dateString` (`string`|`int`) &mdash;
       `'today'`, `'yesterday'`, `'now'`, `'yesterdaySameTime'`, a string with `'YYYY-MM-DD HH:MM:SS'` format or a unix timestamp.
    - `$timezone` (`string`) &mdash;
       The timezone of the result. If specified, `$dateString` will be converted from UTC to this timezone before being used in the Date return value.
- It returns a [`Date`](../Piwik/Date.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If `$dateString` is in an invalid format or if the time is before
                  Tue, 06 Aug 1991.

<a name="getdatetime" id="getdatetime"></a>
<a name="getDatetime" id="getDatetime"></a>
### `getDatetime()`

Returns the current timestamp as a string with the following format: `'YYYY-MM-DD HH:MM:SS'`.

#### Signature

- It returns a `string` value.

<a name="gethourutc" id="gethourutc"></a>
<a name="getHourUTC" id="getHourUTC"></a>
### `getHourUTC()`

Returns the current hour in UTC timezone.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getdatestartutc" id="getdatestartutc"></a>
<a name="getDateStartUTC" id="getDateStartUTC"></a>
### `getDateStartUTC()`

#### Signature

- It returns a `string` value.

<a name="getstartofday" id="getstartofday"></a>
<a name="getStartOfDay" id="getStartOfDay"></a>
### `getStartOfDay()`

Returns the start of the day of the current timestamp in UTC. For example,
if the current timestamp is `'2007-07-24 14:04:24'` in UTC, the result will
be `'2007-07-24'` as a Date.

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.

<a name="getdateendutc" id="getdateendutc"></a>
<a name="getDateEndUTC" id="getDateEndUTC"></a>
### `getDateEndUTC()`

#### Signature

- It returns a `string` value.

<a name="getendofday" id="getendofday"></a>
<a name="getEndOfDay" id="getEndOfDay"></a>
### `getEndOfDay()`

Returns the end of the day of the current timestamp in UTC. For example,
if the current timestamp is `'2007-07-24 14:03:24'` in UTC, the result will
be `'2007-07-24 23:59:59'`.

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.

<a name="settimezone" id="settimezone"></a>
<a name="setTimezone" id="setTimezone"></a>
### `setTimezone()`

Returns a new date object with the same timestamp as `$this` but with a new
timezone.

See [getTimestamp()](/api-reference/Piwik/Date#gettimestamp) to see how the timezone is used.

#### Signature

-  It accepts the following parameter(s):
    - `$timezone` (`string`) &mdash;
       eg, `'UTC'`, `'Europe/London'`, etc.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="getutcoffset" id="getutcoffset"></a>
<a name="getUtcOffset" id="getUtcOffset"></a>
### `getUtcOffset()`

Returns the offset to UTC time for the given timezone

#### Signature

-  It accepts the following parameter(s):
    - `$timezone` (`string`) &mdash;
      

- *Returns:*  `int` &mdash;
    offset in seconds

<a name="adjustfortimezone" id="adjustfortimezone"></a>
<a name="adjustForTimezone" id="adjustForTimezone"></a>
### `adjustForTimezone()`

Converts a timestamp from UTC to a timezone.

#### Signature

-  It accepts the following parameter(s):
    - `$timestamp` (`int`) &mdash;
       The UNIX timestamp to adjust.
    - `$timezone` (`string`) &mdash;
       The timezone to adjust to.

- *Returns:*  `int` &mdash;
    The adjusted time as seconds from EPOCH.

<a name="getdatetimefromtimestamp" id="getdatetimefromtimestamp"></a>
<a name="getDatetimeFromTimestamp" id="getDatetimeFromTimestamp"></a>
### `getDatetimeFromTimestamp()`

Returns the date in the "Y-m-d H:i:s" PHP format

#### Signature

-  It accepts the following parameter(s):
    - `$timestamp` (`int`) &mdash;
      
- It returns a `string` value.

<a name="gettimestamputc" id="gettimestamputc"></a>
<a name="getTimestampUTC" id="getTimestampUTC"></a>
### `getTimestampUTC()`

Returns the Unix timestamp of the date in UTC.

#### Signature

- It returns a `int` value.

<a name="gettimestamp" id="gettimestamp"></a>
<a name="getTimestamp" id="getTimestamp"></a>
### `getTimestamp()`

Returns the unix timestamp of the date in UTC, converted from the current
timestamp timezone.

#### Signature

- It returns a `int` value.

<a name="islater" id="islater"></a>
<a name="isLater" id="isLater"></a>
### `isLater()`

Returns `true` if the current date is older than the given `$date`.

#### Signature

-  It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md)) &mdash;
      
- It returns a `bool` value.

<a name="isearlier" id="isearlier"></a>
<a name="isEarlier" id="isEarlier"></a>
### `isEarlier()`

Returns `true` if the current date is earlier than the given `$date`.

#### Signature

-  It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md)) &mdash;
      
- It returns a `bool` value.

<a name="isleapyear" id="isleapyear"></a>
<a name="isLeapYear" id="isLeapYear"></a>
### `isLeapYear()`

Returns `true` if the current year is a leap year, false otherwise.

#### Signature

- It returns a `bool` value.

<a name="tostring" id="tostring"></a>
<a name="toString" id="toString"></a>
### `toString()`

Converts this date to the requested string format. See [http://php.net/date](http://php.net/date)
for the list of format strings.

#### Signature

-  It accepts the following parameter(s):
    - `$format` (`string`) &mdash;
      
- It returns a `string` value.

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

See [toString()](/api-reference/Piwik/Date#tostring).

#### Signature


- *Returns:*  `string` &mdash;
    The current date in `'YYYY-MM-DD'` format.

<a name="compareweek" id="compareweek"></a>
<a name="compareWeek" id="compareWeek"></a>
### `compareWeek()`

Performs three-way comparison of the week of the current date against the given `$date`'s week.

#### Signature

-  It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md)) &mdash;
      

- *Returns:*  `int` &mdash;
    Returns `0` if the current week is equal to `$date`'s, `-1` if the current week is
            earlier or `1` if the current week is later.

<a name="comparemonth" id="comparemonth"></a>
<a name="compareMonth" id="compareMonth"></a>
### `compareMonth()`

Performs three-way comparison of the month of the current date against the given `$date`'s month.

#### Signature

-  It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md)) &mdash;
       Month to compare

- *Returns:*  `int` &mdash;
    Returns `0` if the current month is equal to `$date`'s, `-1` if the current month is
            earlier or `1` if the current month is later.

<a name="compareyear" id="compareyear"></a>
<a name="compareYear" id="compareYear"></a>
### `compareYear()`

Performs three-way comparison of the month of the current date against the given `$date`'s year.

#### Signature

-  It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md)) &mdash;
       Year to compare

- *Returns:*  `int` &mdash;
    Returns `0` if the current year is equal to `$date`'s, `-1` if the current year is
            earlier or `1` if the current year is later.

<a name="istoday" id="istoday"></a>
<a name="isToday" id="isToday"></a>
### `isToday()`

Returns `true` if current date is today.

#### Signature

- It returns a `bool` value.

<a name="now" id="now"></a>
<a name="now" id="now"></a>
### `now()`

Returns a date object set to now in UTC (same as [today()](/api-reference/Piwik/Date#today), except that the time is also set).

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.

<a name="today" id="today"></a>
<a name="today" id="today"></a>
### `today()`

Returns a date object set to today at midnight in UTC.

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.

<a name="tomorrow" id="tomorrow"></a>
<a name="tomorrow" id="tomorrow"></a>
### `tomorrow()`

Returns a date object set to tomorrow at midnight in UTC.

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.

<a name="yesterday" id="yesterday"></a>
<a name="yesterday" id="yesterday"></a>
### `yesterday()`

Returns a date object set to yesterday at midnight in UTC.

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.

<a name="yesterdaysametime" id="yesterdaysametime"></a>
<a name="yesterdaySameTime" id="yesterdaySameTime"></a>
### `yesterdaySameTime()`

Returns a date object set to yesterday with the current time of day in UTC.

#### Signature

- It returns a [`Date`](../Piwik/Date.md) value.

<a name="settime" id="settime"></a>
<a name="setTime" id="setTime"></a>
### `setTime()`

Returns a new Date instance with `$this` date's day and the specified new
time of day.

#### Signature

-  It accepts the following parameter(s):
    - `$time` (`string`) &mdash;
       String in the `'HH:MM:SS'` format.

- *Returns:*  [`Date`](../Piwik/Date.md) &mdash;
    The new date with the time of day changed.

<a name="setday" id="setday"></a>
<a name="setDay" id="setDay"></a>
### `setDay()`

Returns a new Date instance with `$this` date's time of day and the day specified
by `$day`.

#### Signature

-  It accepts the following parameter(s):
    - `$day` (`int`) &mdash;
       The day eg. `31`.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="setyear" id="setyear"></a>
<a name="setYear" id="setYear"></a>
### `setYear()`

Returns a new Date instance with `$this` date's time of day, month and day, but with
a new year (specified by `$year`).

#### Signature

-  It accepts the following parameter(s):
    - `$year` (`int`) &mdash;
       The year, eg. `2010`.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="subday" id="subday"></a>
<a name="subDay" id="subDay"></a>
### `subDay()`

Subtracts `$n` number of days from `$this` date and returns a new Date object.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       An integer > 0.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="subweek" id="subweek"></a>
<a name="subWeek" id="subWeek"></a>
### `subWeek()`

Subtracts `$n` weeks from `$this` date and returns a new Date object.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       An integer > 0.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="submonth" id="submonth"></a>
<a name="subMonth" id="subMonth"></a>
### `subMonth()`

Subtracts `$n` months from `$this` date and returns the result as a new Date object.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       An integer > 0.

- *Returns:*  [`Date`](../Piwik/Date.md) &mdash;
    new date

<a name="subyear" id="subyear"></a>
<a name="subYear" id="subYear"></a>
### `subYear()`

Subtracts `$n` years from `$this` date and returns the result as a new Date object.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       An integer > 0.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="getlocalized" id="getlocalized"></a>
<a name="getLocalized" id="getLocalized"></a>
### `getLocalized()`

Returns a localized date string using the given template.

The template should contain tags that will be replaced with localized date strings.

#### Signature

-  It accepts the following parameter(s):
    - `$template` (`string`) &mdash;
       eg. `"MMM y"`
    - `$ucfirst` (`bool`) &mdash;
       whether the first letter should be upper-cased

- *Returns:*  `string` &mdash;
    eg. `"Aug 2009"`

<a name="addday" id="addday"></a>
<a name="addDay" id="addDay"></a>
### `addDay()`

Adds `$n` days to `$this` date and returns the result in a new Date.

instance.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       Number of days to add, must be > 0.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="addhour" id="addhour"></a>
<a name="addHour" id="addHour"></a>
### `addHour()`

Adds `$n` hours to `$this` date and returns the result in a new Date.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       Number of hours to add. Can be less than 0.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="addhourto" id="addhourto"></a>
<a name="addHourTo" id="addHourTo"></a>
### `addHourTo()`

Adds N number of hours to a UNIX timestamp and returns the result. Using
this static function instead of [addHour()](/api-reference/Piwik/Date#addhour) will be faster since a
Date instance does not have to be created.

#### Signature

-  It accepts the following parameter(s):
    - `$timestamp` (`int`) &mdash;
       The timestamp to add to.
    - `$n` (`Piwik\number`) &mdash;
       Number of hours to add, must be > 0.

- *Returns:*  `int` &mdash;
    The result as a UNIX timestamp.

<a name="subhour" id="subhour"></a>
<a name="subHour" id="subHour"></a>
### `subHour()`

Subtracts `$n` hours from `$this` date and returns the result in a new Date.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       Number of hours to subtract. Can be less than 0.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="subseconds" id="subseconds"></a>
<a name="subSeconds" id="subSeconds"></a>
### `subSeconds()`

Subtracts `$n` seconds from `$this` date and returns the result in a new Date.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       Number of seconds to subtract. Can be less than 0.
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="addperiod" id="addperiod"></a>
<a name="addPeriod" id="addPeriod"></a>
### `addPeriod()`

Adds a period to `$this` date and returns the result in a new Date instance.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       The number of periods to add. Can be negative.
    - `$period` (`string`) &mdash;
       The type of period to add (YEAR, MONTH, WEEK, DAY, ...)
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="subperiod" id="subperiod"></a>
<a name="subPeriod" id="subPeriod"></a>
### `subPeriod()`

Subtracts a period from `$this` date and returns the result in a new Date instance.

#### Signature

-  It accepts the following parameter(s):
    - `$n` (`int`) &mdash;
       The number of periods to add. Can be negative.
    - `$period` (`string`) &mdash;
       The type of period to add (YEAR, MONTH, WEEK, DAY, ...)
- It returns a [`Date`](../Piwik/Date.md) value.

<a name="secondstodays" id="secondstodays"></a>
<a name="secondsToDays" id="secondsToDays"></a>
### `secondsToDays()`

Returns the number of days represented by a number of seconds.

#### Signature

-  It accepts the following parameter(s):
    - `$secs` (`int`) &mdash;
      
- It returns a `float` value.


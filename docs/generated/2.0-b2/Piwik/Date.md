<small>Piwik</small>

Date
====

Utility class that wraps date/time related PHP functions.

Description
-----------

Using this class can
be easier than using `date`, `time`, `date_default_timezone_set`, etc.

### Performance concerns

The helper methods in this class are instance methods and thus `Date` instances
need to be constructed before they can be used. The memory allocation can result
in noticeable performance degradation if you construct thousands of Date instances,
say, in a loop.

### Examples

**Basic usage**

    $date = Date::factory('2007-07-24 14:04:24', 'EST');
    $date->addHour(5);
    echo $date->getLocalized("%longDay% the %day% of %longMonth% at %time%");


Constants
---------

This class defines the following constants:

- [`NUM_SECONDS_IN_DAY`](#NUM_SECONDS_IN_DAY) &mdash; Number of seconds in a day.
- [`DATE_TIME_FORMAT`](#DATE_TIME_FORMAT) &mdash; The default date time string format.

Methods
-------

The class defines the following methods:

- [`factory()`](#factory) &mdash; Creates a new Date instance using a string datetime value.
- [`getDatetime()`](#getDatetime) &mdash; Returns the current timestamp as a string with the following format: `'YYYY-MM-DD HH:MM:SS'`.
- [`getDateStartUTC()`](#getDateStartUTC) &mdash; Returns the start of the day of the current timestamp in UTC.
- [`getDateEndUTC()`](#getDateEndUTC) &mdash; Returns the end of the day of the current timestamp in UTC.
- [`setTimezone()`](#setTimezone) &mdash; Returns a new date object with the same timestamp as `$this` but with a new timezone.
- [`adjustForTimezone()`](#adjustForTimezone) &mdash; Converts a timestamp in a timezone to UTC.
- [`getTimestampUTC()`](#getTimestampUTC) &mdash; Returns the Unix timestamp of the date in UTC.
- [`getTimestamp()`](#getTimestamp) &mdash; Returns the unix timestamp of the date in UTC, converted from the current timestamp timezone.
- [`isLater()`](#isLater) &mdash; Returns true if the current date is older than the given `$date`.
- [`isEarlier()`](#isEarlier) &mdash; Returns true if the current date is earlier than the given `$date`.
- [`toString()`](#toString) &mdash; Converts this date to the requested string format.
- [`__toString()`](#__toString) &mdash; See [toString](#toString).
- [`compareWeek()`](#compareWeek) &mdash; Performs three-way comparison of the week of the current date against the given `$date`'s week.
- [`compareMonth()`](#compareMonth) &mdash; Performs three-way comparison of the month of the current date against the given `$date`'s month.
- [`isToday()`](#isToday) &mdash; Returns true if current date is today.
- [`now()`](#now) &mdash; Returns a date object set to now in UTC (same as [today](#today), except that the time is also set).
- [`today()`](#today) &mdash; Returns a date object set to today at midnight in UTC.
- [`yesterday()`](#yesterday) &mdash; Returns a date object set to yesterday at midnight in UTC.
- [`yesterdaySameTime()`](#yesterdaySameTime) &mdash; Returns a date object set to yesterday with the current time of day in UTC.
- [`setTime()`](#setTime) &mdash; Returns a new Date instance with `$this` date's day and the specified new time of day.
- [`setDay()`](#setDay) &mdash; Returns a new Date instance with `$this` date's time of day and the day specified by `$day`.
- [`setYear()`](#setYear) &mdash; Returns a new Date instance with `$this` date's time of day, month and day, but with a new year (specified by `$year`).
- [`subDay()`](#subDay) &mdash; Subtracts `$n` number of days from `$this` date and returns a new Date object.
- [`subWeek()`](#subWeek) &mdash; Subtracts `$n` weeks from `$this` date and returns a new Date object.
- [`subMonth()`](#subMonth) &mdash; Subtracts `$n` months from `$this` date and returns the result as a new Date object.
- [`subYear()`](#subYear) &mdash; Subtracts `$n` years from `$this` date and returns the result as a new Date object.
- [`getLocalized()`](#getLocalized) &mdash; Returns a localized date string using the given template.
- [`addDay()`](#addDay) &mdash; Adds `$n` days to `$this` date and returns the result in a new Date.
- [`addHour()`](#addHour) &mdash; Adds `$n` hours to `$this` date and returns the result in a new Date.
- [`addHourTo()`](#addHourTo) &mdash; Adds N number of hours to a UNIX timestamp and returns the result.
- [`subHour()`](#subHour) &mdash; Subtracts `$n` hours from `$this` date and returns the result in a new Date.
- [`addPeriod()`](#addPeriod) &mdash; Adds a period to `$this` date and returns the result in a new Date instance.
- [`subPeriod()`](#subPeriod) &mdash; Subtracts a period from `$this` date and returns the result in a new Date instance.
- [`secondsToDays()`](#secondsToDays) &mdash; Returns the number of days represented by a number of seconds.

<a name="factory" id="factory"></a>
### `factory()`

Creates a new Date instance using a string datetime value.

#### Description

The timezone of the Date
result will be in UTC.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$dateString`
    - `$timezone`
- It returns a(n) [`Date`](../Piwik/Date.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If `$dateString` is in an invalid format or if the time is before Tue, 06 Aug 1991.

<a name="getdatetime" id="getdatetime"></a>
### `getDatetime()`

Returns the current timestamp as a string with the following format: `'YYYY-MM-DD HH:MM:SS'`.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="getdatestartutc" id="getdatestartutc"></a>
### `getDateStartUTC()`

Returns the start of the day of the current timestamp in UTC.

#### Description

For example,
if the current timestamp is `'2007-07-24 14:04:24'` in UTC, the result will
be `'2007-07-24'`.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="getdateendutc" id="getdateendutc"></a>
### `getDateEndUTC()`

Returns the end of the day of the current timestamp in UTC.

#### Description

For example,
if the current timestamp is `'2007-07-24 14:03:24'` in UTC, the result will
be `'2007-07-24 23:59:59'`.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="settimezone" id="settimezone"></a>
### `setTimezone()`

Returns a new date object with the same timestamp as `$this` but with a new timezone.

#### Description

See [getTimestamp](#getTimestamp) to see how the timezone is used.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$timezone`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="adjustfortimezone" id="adjustfortimezone"></a>
### `adjustForTimezone()`

Converts a timestamp in a timezone to UTC.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$timestamp`
    - `$timezone`
- _Returns:_ The adjusted time as seconds from EPOCH.
    - `int`

<a name="gettimestamputc" id="gettimestamputc"></a>
### `getTimestampUTC()`

Returns the Unix timestamp of the date in UTC.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

<a name="gettimestamp" id="gettimestamp"></a>
### `getTimestamp()`

Returns the unix timestamp of the date in UTC, converted from the current timestamp timezone.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

<a name="islater" id="islater"></a>
### `isLater()`

Returns true if the current date is older than the given `$date`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- It returns a(n) `bool` value.

<a name="isearlier" id="isearlier"></a>
### `isEarlier()`

Returns true if the current date is earlier than the given `$date`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- It returns a(n) `bool` value.

<a name="tostring" id="tostring"></a>
### `toString()`

Converts this date to the requested string format.

#### Description

See [http://php.net/date](http://php.net/date)
for the list of format strings.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$format`
- It returns a(n) `string` value.

<a name="__tostring" id="__tostring"></a>
### `__toString()`

See [toString](#toString).

#### Signature

- It is a **public** method.
- _Returns:_ The current date in `&#039;YYYY-MM-DD&#039;` format.
    - `string`

<a name="compareweek" id="compareweek"></a>
### `compareWeek()`

Performs three-way comparison of the week of the current date against the given `$date`'s week.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- _Returns:_ Returns `0` if the current week is equal to `$date`&#039;s, `-1` if the current week is earlier or `1` if the current week is later.
    - `int`

<a name="comparemonth" id="comparemonth"></a>
### `compareMonth()`

Performs three-way comparison of the month of the current date against the given `$date`'s month.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- _Returns:_ Returns `0` if the current month is equal to `$date`&#039;s, `-1` if the current month is earlier or `1` if the current month is later.
    - `int`

<a name="istoday" id="istoday"></a>
### `isToday()`

Returns true if current date is today.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

<a name="now" id="now"></a>
### `now()`

Returns a date object set to now in UTC (same as [today](#today), except that the time is also set).

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="today" id="today"></a>
### `today()`

Returns a date object set to today at midnight in UTC.

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="yesterday" id="yesterday"></a>
### `yesterday()`

Returns a date object set to yesterday at midnight in UTC.

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="yesterdaysametime" id="yesterdaysametime"></a>
### `yesterdaySameTime()`

Returns a date object set to yesterday with the current time of day in UTC.

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="settime" id="settime"></a>
### `setTime()`

Returns a new Date instance with `$this` date's day and the specified new time of day.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$time`
- _Returns:_ The new date with the time of day changed.
    - [`Date`](../Piwik/Date.md)

<a name="setday" id="setday"></a>
### `setDay()`

Returns a new Date instance with `$this` date's time of day and the day specified by `$day`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$day`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="setyear" id="setyear"></a>
### `setYear()`

Returns a new Date instance with `$this` date's time of day, month and day, but with a new year (specified by `$year`).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$year`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="subday" id="subday"></a>
### `subDay()`

Subtracts `$n` number of days from `$this` date and returns a new Date object.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="subweek" id="subweek"></a>
### `subWeek()`

Subtracts `$n` weeks from `$this` date and returns a new Date object.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="submonth" id="submonth"></a>
### `subMonth()`

Subtracts `$n` months from `$this` date and returns the result as a new Date object.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

<a name="subyear" id="subyear"></a>
### `subYear()`

Subtracts `$n` years from `$this` date and returns the result as a new Date object.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="getlocalized" id="getlocalized"></a>
### `getLocalized()`

Returns a localized date string using the given template.

#### Description

The template should contain tags that will be replaced with localized date strings.

Allowed tags include:

- **%day%**: replaced with the day of the month without leading zeros, eg, **1** or **20**.
- **%shortMonth%**: the short month in the current language, eg, **Jan**, **Feb**.
- **%longMonth%**: the whole month name in the current language, eg, **January**, **February**.
- **%shortDay%**: the short day name in the current language, eg, **Mon**, **Tue**.
- **%longDay%**: the long day name in the current language, eg, **Monday**, **Tuesday**.
- **%longYear%**: the four digit year, eg, **2007**, **2013**.
- **%shortYear%**: the two digit year, eg, **07**, **13**.
- **%time%**: the time of day, eg, **07:35:00**, or **15:45:00**.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$template`
- _Returns:_ eg. `&quot;Aug 2009&quot;`
    - `string`

<a name="addday" id="addday"></a>
### `addDay()`

Adds `$n` days to `$this` date and returns the result in a new Date.

#### Description

instance.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="addhour" id="addhour"></a>
### `addHour()`

Adds `$n` hours to `$this` date and returns the result in a new Date.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="addhourto" id="addhourto"></a>
### `addHourTo()`

Adds N number of hours to a UNIX timestamp and returns the result.

#### Description

Using
this static function instead of [addHour](#addHour) will be faster since a
Date instance does not have to be created.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$timestamp`
    - `$n`
- _Returns:_ The result as a UNIX timestamp.
    - `int`

<a name="subhour" id="subhour"></a>
### `subHour()`

Subtracts `$n` hours from `$this` date and returns the result in a new Date.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="addperiod" id="addperiod"></a>
### `addPeriod()`

Adds a period to `$this` date and returns the result in a new Date instance.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
    - `$period`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="subperiod" id="subperiod"></a>
### `subPeriod()`

Subtracts a period from `$this` date and returns the result in a new Date instance.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
    - `$period`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

<a name="secondstodays" id="secondstodays"></a>
### `secondsToDays()`

Returns the number of days represented by a number of seconds.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$secs`
- It returns a(n) `float` value.


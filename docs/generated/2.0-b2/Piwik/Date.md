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

    $date = Date::factory(&#039;2007-07-24 14:04:24&#039;, &#039;EST&#039;);
    $date-&gt;addHour(5);
    echo $date-&gt;getLocalized(&quot;%longDay% the %day% of %longMonth% at %time%&quot;);


Constants
---------

This class defines the following constants:

- [`NUM_SECONDS_IN_DAY`](#NUM_SECONDS_IN_DAY) &mdash; Number of seconds in a day.
- [`DATE_TIME_FORMAT`](#DATE_TIME_FORMAT) &mdash; The default date time string format.

Methods
-------

The class defines the following methods:

- [`factory()`](#factory) &mdash; Creates a new Date instance using a string datetime value.
- [`getDatetime()`](#getDatetime) &mdash; Returns the current timestamp as a string with the following format: `&#039;YYYY-MM-DD HH:MM:SS&#039;`.
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
- [`compareWeek()`](#compareWeek) &mdash; Performs three-way comparison of the week of the current date against the given `$date`&#039;s week.
- [`compareMonth()`](#compareMonth) &mdash; Performs three-way comparison of the month of the current date against the given `$date`&#039;s month.
- [`isToday()`](#isToday) &mdash; Returns true if current date is today.
- [`now()`](#now) &mdash; Returns a date object set to now in UTC (same as [today](#today), except that the time is also set).
- [`today()`](#today) &mdash; Returns a date object set to today at midnight in UTC.
- [`yesterday()`](#yesterday) &mdash; Returns a date object set to yesterday at midnight in UTC.
- [`yesterdaySameTime()`](#yesterdaySameTime) &mdash; Returns a date object set to yesterday with the current time of day in UTC.
- [`setTime()`](#setTime) &mdash; Returns a new Date instance with `$this` date&#039;s day and the specified new time of day.
- [`setDay()`](#setDay) &mdash; Returns a new Date instance with `$this` date&#039;s time of day and the day specified by `$day`.
- [`setYear()`](#setYear) &mdash; Returns a new Date instance with `$this` date&#039;s time of day, month and day, but with a new year (specified by `$year`).
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

### `factory()` <a name="factory"></a>

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

### `getDatetime()` <a name="getDatetime"></a>

Returns the current timestamp as a string with the following format: `&#039;YYYY-MM-DD HH:MM:SS&#039;`.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getDateStartUTC()` <a name="getDateStartUTC"></a>

Returns the start of the day of the current timestamp in UTC.

#### Description

For example,
if the current timestamp is `&#039;2007-07-24 14:04:24&#039;` in UTC, the result will
be `&#039;2007-07-24&#039;`.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getDateEndUTC()` <a name="getDateEndUTC"></a>

Returns the end of the day of the current timestamp in UTC.

#### Description

For example,
if the current timestamp is `&#039;2007-07-24 14:03:24&#039;` in UTC, the result will
be `&#039;2007-07-24 23:59:59&#039;`.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `setTimezone()` <a name="setTimezone"></a>

Returns a new date object with the same timestamp as `$this` but with a new timezone.

#### Description

See [getTimestamp](#getTimestamp) to see how the timezone is used.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$timezone`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `adjustForTimezone()` <a name="adjustForTimezone"></a>

Converts a timestamp in a timezone to UTC.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$timestamp`
    - `$timezone`
- _Returns:_ The adjusted time as seconds from EPOCH.
    - `int`

### `getTimestampUTC()` <a name="getTimestampUTC"></a>

Returns the Unix timestamp of the date in UTC.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `getTimestamp()` <a name="getTimestamp"></a>

Returns the unix timestamp of the date in UTC, converted from the current timestamp timezone.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `isLater()` <a name="isLater"></a>

Returns true if the current date is older than the given `$date`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- It returns a(n) `bool` value.

### `isEarlier()` <a name="isEarlier"></a>

Returns true if the current date is earlier than the given `$date`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- It returns a(n) `bool` value.

### `toString()` <a name="toString"></a>

Converts this date to the requested string format.

#### Description

See [http://php.net/date](http://php.net/date)
for the list of format strings.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$format`
- It returns a(n) `string` value.

### `__toString()` <a name="__toString"></a>

See [toString](#toString).

#### Signature

- It is a **public** method.
- _Returns:_ The current date in `&#039;YYYY-MM-DD&#039;` format.
    - `string`

### `compareWeek()` <a name="compareWeek"></a>

Performs three-way comparison of the week of the current date against the given `$date`&#039;s week.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- _Returns:_ Returns `0` if the current week is equal to `$date`&#039;s, `-1` if the current week is earlier or `1` if the current week is later.
    - `int`

### `compareMonth()` <a name="compareMonth"></a>

Performs three-way comparison of the month of the current date against the given `$date`&#039;s month.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- _Returns:_ Returns `0` if the current month is equal to `$date`&#039;s, `-1` if the current month is earlier or `1` if the current month is later.
    - `int`

### `isToday()` <a name="isToday"></a>

Returns true if current date is today.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

### `now()` <a name="now"></a>

Returns a date object set to now in UTC (same as [today](#today), except that the time is also set).

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `today()` <a name="today"></a>

Returns a date object set to today at midnight in UTC.

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `yesterday()` <a name="yesterday"></a>

Returns a date object set to yesterday at midnight in UTC.

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `yesterdaySameTime()` <a name="yesterdaySameTime"></a>

Returns a date object set to yesterday with the current time of day in UTC.

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `setTime()` <a name="setTime"></a>

Returns a new Date instance with `$this` date&#039;s day and the specified new time of day.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$time`
- _Returns:_ The new date with the time of day changed.
    - [`Date`](../Piwik/Date.md)

### `setDay()` <a name="setDay"></a>

Returns a new Date instance with `$this` date&#039;s time of day and the day specified by `$day`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$day`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `setYear()` <a name="setYear"></a>

Returns a new Date instance with `$this` date&#039;s time of day, month and day, but with a new year (specified by `$year`).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$year`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `subDay()` <a name="subDay"></a>

Subtracts `$n` number of days from `$this` date and returns a new Date object.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `subWeek()` <a name="subWeek"></a>

Subtracts `$n` weeks from `$this` date and returns a new Date object.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `subMonth()` <a name="subMonth"></a>

Subtracts `$n` months from `$this` date and returns the result as a new Date object.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `subYear()` <a name="subYear"></a>

Subtracts `$n` years from `$this` date and returns the result as a new Date object.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `getLocalized()` <a name="getLocalized"></a>

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

### `addDay()` <a name="addDay"></a>

Adds `$n` days to `$this` date and returns the result in a new Date.

#### Description

instance.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `addHour()` <a name="addHour"></a>

Adds `$n` hours to `$this` date and returns the result in a new Date.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `addHourTo()` <a name="addHourTo"></a>

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

### `subHour()` <a name="subHour"></a>

Subtracts `$n` hours from `$this` date and returns the result in a new Date.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `addPeriod()` <a name="addPeriod"></a>

Adds a period to `$this` date and returns the result in a new Date instance.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
    - `$period`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `subPeriod()` <a name="subPeriod"></a>

Subtracts a period from `$this` date and returns the result in a new Date instance.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
    - `$period`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `secondsToDays()` <a name="secondsToDays"></a>

Returns the number of days represented by a number of seconds.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$secs`
- It returns a(n) `float` value.


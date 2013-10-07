<small>Piwik</small>

Date
====

Date object widely used in Piwik.


Constants
---------

This class defines the following constants:

- [`NUM_SECONDS_IN_DAY`](#NUM_SECONDS_IN_DAY)
- [`DATE_TIME_FORMAT`](#DATE_TIME_FORMAT)

Methods
-------

The class defines the following methods:

- [`factory()`](#factory) &mdash; Returns a Date objects.
- [`getDatetime()`](#getDatetime) &mdash; Returns the datetime of the current timestamp
- [`getDateStartUTC()`](#getDateStartUTC) &mdash; Returns the datetime start in UTC
- [`getDateEndUTC()`](#getDateEndUTC) &mdash; Returns the datetime end in UTC
- [`setTimezone()`](#setTimezone) &mdash; Returns a new date object, copy of $this, with the timezone set This timezone is used to offset the UTC timestamp returned by @see getTimestamp() Doesn&#039;t modify $this
- [`adjustForTimezone()`](#adjustForTimezone) &mdash; Adjusts a UNIX timestamp in UTC to a specific timezone.
- [`getTimestampUTC()`](#getTimestampUTC) &mdash; Returns the Unix timestamp of the date in UTC
- [`getTimestamp()`](#getTimestamp) &mdash; Returns the unix timestamp of the date in UTC, converted from the date timezone
- [`isLater()`](#isLater) &mdash; Returns true if the current date is older than the given $date
- [`isEarlier()`](#isEarlier) &mdash; Returns true if the current date is earlier than the given $date
- [`toString()`](#toString) &mdash; Returns the Y-m-d representation of the string.
- [`__toString()`](#__toString)
- [`compareWeek()`](#compareWeek) &mdash; Compares the week of the current date against the given $date Returns 0 if equal, -1 if current week is earlier or 1 if current week is later Example: 09.Jan.2007 13:07:25 -&gt; compareWeek(2); -&gt; 0
- [`compareMonth()`](#compareMonth) &mdash; Compares the month of the current date against the given $date month Returns 0 if equal, -1 if current month is earlier or 1 if current month is later For example: 10.03.2000 -&gt; 15.03.1950 -&gt; 0
- [`isToday()`](#isToday) &mdash; Returns true if current date is today
- [`now()`](#now) &mdash; Returns a date object set to now (same as today, except that the time is also set)
- [`today()`](#today) &mdash; Returns a date object set to today midnight
- [`yesterday()`](#yesterday) &mdash; Returns a date object set to yesterday midnight
- [`yesterdaySameTime()`](#yesterdaySameTime) &mdash; Returns a date object set to yesterday same time of day
- [`setTime()`](#setTime) &mdash; Sets the time part of the date Doesn&#039;t modify $this
- [`setDay()`](#setDay) &mdash; Sets a new day Returned is the new date object Doesn&#039;t modify $this
- [`setYear()`](#setYear) &mdash; Sets a new year Returned is the new date object Doesn&#039;t modify $this
- [`subDay()`](#subDay) &mdash; Subtracts days from the existing date object and returns a new Date object Returned is the new date object Doesn&#039;t modify $this
- [`subWeek()`](#subWeek) &mdash; Subtracts weeks from the existing date object and returns a new Date object Returned is the new date object Doesn&#039;t modify $this
- [`subMonth()`](#subMonth) &mdash; Subtracts a month from the existing date object.
- [`subYear()`](#subYear) &mdash; Subtracts a year from the existing date object.
- [`getLocalized()`](#getLocalized) &mdash; Returns a localized date string, given a template.
- [`addDay()`](#addDay) &mdash; Adds days to the existing date object.
- [`addHour()`](#addHour) &mdash; Adds hours to the existing date object.
- [`addHourTo()`](#addHourTo) &mdash; Adds N number of hours to a UNIX timestamp and returns the result.
- [`subHour()`](#subHour) &mdash; Substract hour to the existing date object.
- [`addPeriod()`](#addPeriod) &mdash; Adds period to the existing date object.
- [`subPeriod()`](#subPeriod) &mdash; Subtracts period from the existing date object.
- [`secondsToDays()`](#secondsToDays) &mdash; Returns the number of days represented by a number of seconds.

### `factory()` <a name="factory"></a>

Returns a Date objects.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$dateString`
    - `$timezone`
- It returns a(n) [`Date`](../Piwik/Date.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `getDatetime()` <a name="getDatetime"></a>

Returns the datetime of the current timestamp

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getDateStartUTC()` <a name="getDateStartUTC"></a>

Returns the datetime start in UTC

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getDateEndUTC()` <a name="getDateEndUTC"></a>

Returns the datetime end in UTC

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `setTimezone()` <a name="setTimezone"></a>

Returns a new date object, copy of $this, with the timezone set This timezone is used to offset the UTC timestamp returned by @see getTimestamp() Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$timezone`
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `adjustForTimezone()` <a name="adjustForTimezone"></a>

Adjusts a UNIX timestamp in UTC to a specific timezone.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$timestamp`
    - `$timezone`
- _Returns:_ The adjusted time as seconds from EPOCH.
    - `int`

### `getTimestampUTC()` <a name="getTimestampUTC"></a>

Returns the Unix timestamp of the date in UTC

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `getTimestamp()` <a name="getTimestamp"></a>

Returns the unix timestamp of the date in UTC, converted from the date timezone

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `isLater()` <a name="isLater"></a>

Returns true if the current date is older than the given $date

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- It returns a(n) `bool` value.

### `isEarlier()` <a name="isEarlier"></a>

Returns true if the current date is earlier than the given $date

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- It returns a(n) `bool` value.

### `toString()` <a name="toString"></a>

Returns the Y-m-d representation of the string.

#### Description

You can specify the output, see the list on php.net/date

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$part`
- It returns a(n) `string` value.

### `__toString()` <a name="__toString"></a>

#### See Also

- `toString()`

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `compareWeek()` <a name="compareWeek"></a>

Compares the week of the current date against the given $date Returns 0 if equal, -1 if current week is earlier or 1 if current week is later Example: 09.Jan.2007 13:07:25 -&gt; compareWeek(2); -&gt; 0

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- _Returns:_ 0 = equal, 1 = later, -1 = earlier
    - `int`

### `compareMonth()` <a name="compareMonth"></a>

Compares the month of the current date against the given $date month Returns 0 if equal, -1 if current month is earlier or 1 if current month is later For example: 10.03.2000 -&gt; 15.03.1950 -&gt; 0

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date` ([`Date`](../Piwik/Date.md))
- _Returns:_ 0 = equal, 1 = later, -1 = earlier
    - `int`

### `isToday()` <a name="isToday"></a>

Returns true if current date is today

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

### `now()` <a name="now"></a>

Returns a date object set to now (same as today, except that the time is also set)

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `today()` <a name="today"></a>

Returns a date object set to today midnight

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `yesterday()` <a name="yesterday"></a>

Returns a date object set to yesterday midnight

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `yesterdaySameTime()` <a name="yesterdaySameTime"></a>

Returns a date object set to yesterday same time of day

#### Signature

- It is a **public static** method.
- It returns a(n) [`Date`](../Piwik/Date.md) value.

### `setTime()` <a name="setTime"></a>

Sets the time part of the date Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$time`
- _Returns:_ The new date with the time part set
    - [`Date`](../Piwik/Date.md)

### `setDay()` <a name="setDay"></a>

Sets a new day Returned is the new date object Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$day`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `setYear()` <a name="setYear"></a>

Sets a new year Returned is the new date object Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$year`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `subDay()` <a name="subDay"></a>

Subtracts days from the existing date object and returns a new Date object Returned is the new date object Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `subWeek()` <a name="subWeek"></a>

Subtracts weeks from the existing date object and returns a new Date object Returned is the new date object Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `subMonth()` <a name="subMonth"></a>

Subtracts a month from the existing date object.

#### Description

Returned is the new date object
Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `subYear()` <a name="subYear"></a>

Subtracts a year from the existing date object.

#### Description

Returned is the new date object
Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `getLocalized()` <a name="getLocalized"></a>

Returns a localized date string, given a template.

#### Description

Allowed tags are: %day%, %shortDay%, %longDay%, etc.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$template`
- _Returns:_ eg. &quot;Aug 2009&quot;
    - `string`

### `addDay()` <a name="addDay"></a>

Adds days to the existing date object.

#### Description

Returned is the new date object
Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `addHour()` <a name="addHour"></a>

Adds hours to the existing date object.

#### Description

Returned is the new date object
Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `addHourTo()` <a name="addHourTo"></a>

Adds N number of hours to a UNIX timestamp and returns the result.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$timestamp`
    - `$n`
- _Returns:_ The result as a UNIX timestamp.
    - `int`

### `subHour()` <a name="subHour"></a>

Substract hour to the existing date object.

#### Description

Returned is the new date object
Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `addPeriod()` <a name="addPeriod"></a>

Adds period to the existing date object.

#### Description

Returned is the new date object
Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
    - `$period`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `subPeriod()` <a name="subPeriod"></a>

Subtracts period from the existing date object.

#### Description

Returned is the new date object
Doesn&#039;t modify $this

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$n`
    - `$period`
- _Returns:_ new date
    - [`Date`](../Piwik/Date.md)

### `secondsToDays()` <a name="secondsToDays"></a>

Returns the number of days represented by a number of seconds.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$secs`
- It returns a(n) `float` value.


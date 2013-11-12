<small>Piwik</small>

ScheduledTime
=============

The ScheduledTime abstract class is used as a base class for different types of scheduling intervals.

Description
-----------

ScheduledTime::factory() is used to create a ScheduledTime object.

Methods
-------

The abstract class defines the following methods:

- [`setDay()`](#setday)
- [`setHour()`](#sethour)
- [`factory()`](#factory) &mdash; Returns a new ScheduledTime instance using a string description of the scheduled period type and a string description of the day within the period to execute the task on.

<a name="setday" id="setday"></a>
<a name="setDay" id="setDay"></a>
### `setDay()`

#### Signature

- It accepts the following parameter(s):
    - `$_day`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if method not supported by subclass or parameter _day is invalid

<a name="sethour" id="sethour"></a>
<a name="setHour" id="setHour"></a>
### `setHour()`

#### Signature

- It accepts the following parameter(s):
    - `$_hour` (`int`) &mdash; the hour to set, has to be >= 0 and < 24
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if method not supported by subclass or parameter _hour is invalid

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Returns a new ScheduledTime instance using a string description of the scheduled period type and a string description of the day within the period to execute the task on.

#### Signature

- It accepts the following parameter(s):
    - `$periodType` (`string`) &mdash; The scheduled period type. Can be `'hourly'`, `'daily'`, `'weekly'`, or `'monthly'`.
    - `$periodDay` (`string`|`int`|`Piwik\false`) &mdash; A string describing the day within the scheduled period to execute the task on. Only valid for week and month periods. If `'weekly'` is supplied for `$periodType`, this should be a day of the week, for example, `'monday'` or `'tuesday'`. If `'monthly'` is supplied for `$periodType`, this can be a numeric day in the month or a day in one week of the month. For example, `12`, `23`, `'first sunday'` or `'fourth tuesday'`.
- It does not return anything.


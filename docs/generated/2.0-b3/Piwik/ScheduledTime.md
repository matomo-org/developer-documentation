<small>Piwik</small>

ScheduledTime
=============

The ScheduledTime abstract class is used as a base class for different types of scheduling intervals.

Description
-----------

ScheduledTime::factory() is used to create a ScheduledTime object.


Constants
---------

This abstract class defines the following constants:

- `PERIOD_NEVER`
- `PERIOD_DAY`
- `PERIOD_WEEK`
- `PERIOD_MONTH`
- `PERIOD_HOUR`
- `PERIOD_YEAR`
- `PERIOD_RANGE`

Methods
-------

The abstract class defines the following methods:

- [`getScheduledTimeForPeriod()`](#getscheduledtimeforperiod)
- [`getRescheduledTime()`](#getrescheduledtime) &mdash; Computes the next scheduled time based on the system time at which the method has been called and the underlying scheduling interval.
- [`setDay()`](#setday)
- [`setHour()`](#sethour)
- [`factory()`](#factory) &mdash; Returns a new ScheduledTime instance using a string description of the scheduled period type and a string description of the day within the period to execute the task on.

<a name="getscheduledtimeforperiod" id="getscheduledtimeforperiod"></a>
<a name="getScheduledTimeForPeriod" id="getScheduledTimeForPeriod"></a>
### `getScheduledTimeForPeriod()`

#### Signature

- It accepts the following parameter(s):
    - `$period`
- It can return one of the following values:
    - `Piwik\ScheduledTime\Daily`
    - `Piwik\ScheduledTime\Monthly`
    - `Piwik\ScheduledTime\Weekly`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getrescheduledtime" id="getrescheduledtime"></a>
<a name="getRescheduledTime" id="getRescheduledTime"></a>
### `getRescheduledTime()`

Computes the next scheduled time based on the system time at which the method has been called and the underlying scheduling interval.

#### Signature

- It does not return anything.

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
    - `$_hour`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if method not supported by subclass or parameter _hour is invalid

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Returns a new ScheduledTime instance using a string description of the scheduled period type and a string description of the day within the period to execute the task on.

#### Signature

- It accepts the following parameter(s):
    - `$periodType`
    - `$periodDay`
- It does not return anything.


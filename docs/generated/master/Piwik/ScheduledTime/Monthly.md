<small>Piwik\ScheduledTime</small>

Monthly
=======

Monthly class is used to schedule tasks every month.


Methods
-------

The class defines the following methods:

- [`setDayOfWeekFromString()`](#setDayOfWeekFromString)
- [`getRescheduledTime()`](#getRescheduledTime)
- [`setDay()`](#setDay)
- [`setDayOfWeek()`](#setDayOfWeek) &mdash; Makes this scheduled time execute on a particular day of the week on each month.

<a name="setdayofweekfromstring" id="setdayofweekfromstring"></a>
### `setDayOfWeekFromString()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$day`
- It does not return anything.

<a name="getrescheduledtime" id="getrescheduledtime"></a>
### `getRescheduledTime()`

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

<a name="setday" id="setday"></a>
### `setDay()`

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$_day`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if parameter _day is invalid

<a name="setdayofweek" id="setdayofweek"></a>
### `setDayOfWeek()`

Makes this scheduled time execute on a particular day of the week on each month.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$_day`
    - `$_week`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if either parameter is invalid


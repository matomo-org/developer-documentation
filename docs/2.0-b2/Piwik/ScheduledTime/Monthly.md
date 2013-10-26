<small>Piwik\ScheduledTime</small>

Monthly
=======

Monthly class is used to schedule tasks every month.


Methods
-------

The class defines the following methods:

- [`getRescheduledTime()`](#getRescheduledTime)
- [`setDay()`](#setDay)
- [`setDayOfWeek()`](#setDayOfWeek) &mdash; Makes this scheduled time execute on a particular day of the week on each month.

### `getRescheduledTime()` <a name="getRescheduledTime"></a>

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `setDay()` <a name="setDay"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$_day`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if parameter _day is invalid

### `setDayOfWeek()` <a name="setDayOfWeek"></a>

Makes this scheduled time execute on a particular day of the week on each month.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$_day`
    - `$_week`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if either parameter is invalid


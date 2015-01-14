<small>Piwik\Scheduler\Schedule\</small>

Schedule
========

Describes the interval on which a scheduled task is executed.

Use the [factory()](/api-reference/Piwik/Scheduler/Schedule/Schedule#factory) method
to create Schedule instances.

Methods
-------

The abstract class defines the following methods:

- [`setHour()`](#sethour) &mdash; Sets the hour of the day on which the task should be executed.
- [`factory()`](#factory) &mdash; Returns a new Schedule instance using a string description of the scheduled period type and a string description of the day within the period to execute the task on.

<a name="sethour" id="sethour"></a>
<a name="setHour" id="setHour"></a>
### `setHour()`

Sets the hour of the day on which the task should be executed.

#### Signature

-  It accepts the following parameter(s):
    - `$hour` (`int`) &mdash;
       Must be `>= 0` and `< 24`.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the current scheduled period is **hourly** or if `$hour` is invalid.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Returns a new Schedule instance using a string description of the scheduled period type and a string description of the day within the period to execute the task on.

#### Signature

-  It accepts the following parameter(s):
    - `$periodType` (`string`) &mdash;
       The scheduled period type. Can be `'hourly'`, `'daily'`, `'weekly'`, or `'monthly'`.
    - `$periodDay` (`bool`|`Piwik\Scheduler\Schedule\false`|`int`|`string`) &mdash;
       A string describing the day within the scheduled period to execute the task on. Only valid for week and month periods. If `'weekly'` is supplied for `$periodType`, this should be a day of the week, for example, `'monday'` or `'tuesday'`. If `'monthly'` is supplied for `$periodType`, this can be a numeric day in the month or a day in one week of the month. For example, `12`, `23`, `'first sunday'` or `'fourth tuesday'`.

- *Returns:*  [`Hourly`](../../../Piwik/Scheduler/Schedule/Hourly.md)|[`Daily`](../../../Piwik/Scheduler/Schedule/Daily.md)|[`Weekly`](../../../Piwik/Scheduler/Schedule/Weekly.md)|[`Monthly`](../../../Piwik/Scheduler/Schedule/Monthly.md) &mdash;
    
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


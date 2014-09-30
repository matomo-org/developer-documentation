<small>Piwik\ScheduledTime\</small>

Weekly
======

Weekly class is used to schedule tasks every week.

Methods
-------

The class defines the following methods:

- [`setHour()`](#sethour) &mdash; Sets the hour of the day on which the task should be executed. Inherited from [`ScheduledTime`](../../Piwik/ScheduledTime.md)
- [`factory()`](#factory) &mdash; Returns a new ScheduledTime instance using a string description of the scheduled period type and a string description of the day within the period to execute the task on. Inherited from [`ScheduledTime`](../../Piwik/ScheduledTime.md)

<a name="sethour" id="sethour"></a>
<a name="setHour" id="setHour"></a>
### `setHour()`

Sets the hour of the day on which the task should be executed.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$hour` (`int`) &mdash;

      <div markdown="1" class="param-desc"> Must be `>= 0` and `< 24`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the current scheduled period is **hourly** or if `$hour` is invalid.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Returns a new ScheduledTime instance using a string description of the scheduled period type and a string description of the day within the period to execute the task on.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$periodType` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The scheduled period type. Can be `'hourly'`, `'daily'`, `'weekly'`, or `'monthly'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$periodDay` (`bool`|`Piwik\false`|`int`|`string`) &mdash;

      <div markdown="1" class="param-desc"> A string describing the day within the scheduled period to execute the task on. Only valid for week and month periods. If `'weekly'` is supplied for `$periodType`, this should be a day of the week, for example, `'monday'` or `'tuesday'`. If `'monthly'` is supplied for `$periodType`, this can be a numeric day in the month or a day in one week of the month. For example, `12`, `23`, `'first sunday'` or `'fourth tuesday'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


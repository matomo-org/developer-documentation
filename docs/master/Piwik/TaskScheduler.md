<small>Piwik</small>

TaskScheduler
=============

Manages scheduled task execution.

Description
-----------

A scheduled task is a callback that should be executed every so often (such as daily,
weekly, monthly, etc.). They are registered with **TaskScheduler** through the
[TaskScheduler.getScheduledTasks](#) event.

Tasks executed when the cron archive.php script is executed,


Constants
---------

This class defines the following constants:

- [`GET_TASKS_EVENT`](#GET_TASKS_EVENT)
- [`TIMETABLE_OPTION_STRING`](#TIMETABLE_OPTION_STRING)

Methods
-------

The class defines the following methods:

- [`runTasks()`](#runTasks) &mdash; Executes tasks that are scheduled to run, then reschedules them.
- [`isTaskBeingExecuted()`](#isTaskBeingExecuted) &mdash; Returns true if the TaskScheduler is currently running a scheduled task.
- [`getScheduledTimeForMethod()`](#getScheduledTimeForMethod) &mdash; Return the next scheduled time given the class and method names of a scheduled task.

### `runTasks()` <a name="runTasks"></a>

Executes tasks that are scheduled to run, then reschedules them.

#### Signature

- It is a **public static** method.
- _Returns:_ An array describing the results of scheduled task execution. Each element in the array will have the following format: ``` array( &#039;task&#039; =&gt; &#039;task name&#039;, &#039;output&#039; =&gt; &#039;... task output ...&#039; ) ```
    - `array`

### `isTaskBeingExecuted()` <a name="isTaskBeingExecuted"></a>

Returns true if the TaskScheduler is currently running a scheduled task.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `getScheduledTimeForMethod()` <a name="getScheduledTimeForMethod"></a>

Return the next scheduled time given the class and method names of a scheduled task.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$className`
    - `$methodName`
    - `$methodParameter`
- _Returns:_ int|bool The time in miliseconds when the scheduled task will be executed next or false if it is not scheduled to run.
    - `mixed`


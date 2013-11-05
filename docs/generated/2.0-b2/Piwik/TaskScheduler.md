<small>Piwik</small>

TaskScheduler
=============

Manages scheduled task execution.

Description
-----------

A scheduled task is a callback that should be executed every so often (such as daily,
weekly, monthly, etc.). They are registered with **TaskScheduler** through the
[TaskScheduler.getScheduledTasks](#) event.

Tasks are executed when the cron archive.php script is executed.


Constants
---------

This class defines the following constants:

- GET_TASKS_EVENT
- TIMETABLE_OPTION_STRING

Methods
-------

The class defines the following methods:

- [`runTasks()`](#runtasks) &mdash; Executes tasks that are scheduled to run, then reschedules them.
- [`isTaskBeingExecuted()`](#istaskbeingexecuted) &mdash; Returns true if the TaskScheduler is currently running a scheduled task.
- [`getScheduledTimeForMethod()`](#getscheduledtimeformethod) &mdash; Return the next scheduled time given the class and method names of a scheduled task.

<a name="runtasks" id="runtasks"></a>
### `runTasks()`

Executes tasks that are scheduled to run, then reschedules them.

#### Signature

- _Returns:_ An array describing the results of scheduled task execution. Each element in the array will have the following format: ``` array( 'task' => 'task name', 'output' => '... task output ...' ) ```
    - `array`

<a name="istaskbeingexecuted" id="istaskbeingexecuted"></a>
### `isTaskBeingExecuted()`

Returns true if the TaskScheduler is currently running a scheduled task.

#### Signature

- It returns a(n) `bool` value.

<a name="getscheduledtimeformethod" id="getscheduledtimeformethod"></a>
### `getScheduledTimeForMethod()`

Return the next scheduled time given the class and method names of a scheduled task.

#### Signature

- It accepts the following parameter(s):
    - `$className`
    - `$methodName`
    - `$methodParameter`
- _Returns:_ int|bool The time in miliseconds when the scheduled task will be executed next or false if it is not scheduled to run.
    - `mixed`


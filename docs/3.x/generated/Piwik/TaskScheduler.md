<small>Piwik\</small>

TaskScheduler
=============

Manages scheduled task execution.

A scheduled task is a callback that should be executed every so often (such as daily,
weekly, monthly, etc.). They are registered by extending [Tasks](/api-reference/Piwik/Plugin/Tasks).

Tasks are executed when the `core:archive` command is executed.

### Examples

**Scheduling a task**

    class Tasks extends \Piwik\Plugin\Tasks
    {
        public function schedule()
        {
            $this->hourly('myTask');  // myTask() will be executed once every hour
        }
        public function myTask()
        {
            // do something
        }
    }

**Executing all pending tasks**

    $results = TaskScheduler::runTasks();
    $task1Result = $results[0];
    $task1Name = $task1Result['task'];
    $task1Output = $task1Result['output'];

    echo "Executed task '$task1Name'. Task output:\n$task1Output";

Methods
-------

The class defines the following methods:

- [`rescheduleTask()`](#rescheduletask) &mdash; Determines a task's scheduled time and persists it, overwriting the previous scheduled time.

<a name="rescheduletask" id="rescheduletask"></a>
<a name="rescheduleTask" id="rescheduleTask"></a>
### `rescheduleTask()`

Determines a task's scheduled time and persists it, overwriting the previous scheduled time.

Call this method if your task's scheduled time has changed due to, for example, an option that
was changed.

#### Signature

-  It accepts the following parameter(s):
    - `$task` ([`Task`](../Piwik/Scheduler/Task.md)) &mdash;
       Describes the scheduled task being rescheduled.
- It does not return anything or a mixed result.


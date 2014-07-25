<small>Piwik\</small>

TaskScheduler
=============

Manages scheduled task execution.

A scheduled task is a callback that should be executed every so often (such as daily,
weekly, monthly, etc.). They are registered with **TaskScheduler** through the
[TaskScheduler.getScheduledTasks](/api-reference/events#taskschedulergetscheduledtasks) event.

Tasks are executed when the cron core:archive command is executed.

### Examples

**Scheduling a task**

    // event handler for TaskScheduler.getScheduledTasks event
    public function getScheduledTasks(&$tasks)
    {
        $tasks[] = new ScheduledTask(
            'Piwik\Plugins\CorePluginsAdmin\MarketplaceApiClient',
            'clearAllCacheEntries',
            null,
            ScheduledTime::factory('daily'),
            ScheduledTask::LOWEST_PRIORITY
        );
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

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class. Inherited from [`Singleton`](../Piwik/Singleton.md)
- [`rescheduleTask()`](#rescheduletask) &mdash; Determines a task's scheduled time and persists it, overwriting the previous scheduled time.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class.

If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`Singleton`](../Piwik/Singleton.md) value.

<a name="rescheduletask" id="rescheduletask"></a>
<a name="rescheduleTask" id="rescheduleTask"></a>
### `rescheduleTask()`

Determines a task's scheduled time and persists it, overwriting the previous scheduled time.

Call this method if your task's scheduled time has changed due to, for example, an option that
was changed.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$task` ([`ScheduledTask`](../Piwik/ScheduledTask.md)) &mdash;

      <div markdown="1" class="param-desc"> Describes the scheduled task being rescheduled.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.


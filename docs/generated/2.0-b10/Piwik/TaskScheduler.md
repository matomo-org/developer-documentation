<small>Piwik\</small>

TaskScheduler
=============

Manages scheduled task execution.

A scheduled task is a callback that should be executed every so often (such as daily,
weekly, monthly, etc.). They are registered with **TaskScheduler** through the
[TaskScheduler.getScheduledTasks](#) event.

Tasks are executed when the cron archive.php script is executed.

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

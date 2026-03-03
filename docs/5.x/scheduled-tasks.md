---
category: Develop
---
# Scheduled tasks

Scheduled tasks let you execute tasks regularly (hourly, weekly, …), for example:

- create and send custom reports or summaries
- sync users and websites with other systems
- clear any caches

## Adding a scheduled task to your plugin

You can add a scheduled task to your plugin by using the [console](/guides/piwik-on-the-command-line):

```
$ ./console generate:scheduledtask
```

The command will ask you to enter the name of your plugin and will create a `plugins/MyPlugin/Tasks.php` file. This file contains some examples to get you started:

```php
class Tasks extends \Piwik\Plugin\Tasks
{
    public function schedule()
    {
        $this->hourly('myTask');  // myTask() will be executed once every hour
        $this->daily('myTask');   // myTask() will be executed once every day
        $this->weekly('myTask');  // myTask() will be executed once every week
        $this->monthly('myTask'); // myTask() will be executed once every month

        // pass a parameter to the task
        $this->weekly('myTaskWithParam', 'anystring');

        // specify a different priority
        $this->monthly('myTask', null, self::LOWEST_PRIORITY);
        $this->monthly('myTaskWithParam', 'anystring', self::HIGH_PRIORITY);
    }

    public function myTask()
    {
        // do something
    }

    public function myTaskWithParam($param)
    {
        // do something
    }
}
```

### Simple example

As you can see in the generated template you can execute tasks hourly, daily, weekly and monthly by registering a method which represents the actual task:

```php
public function schedule()
{
    // register method remindMeToLogIn to be executed once every day
    $this->daily('remindMeToLogIn');
}

public function remindMeToLogIn()
{
    $mail = new \Piwik\Mail();
    $mail->addTo('me@example.com');
    $mail->setSubject('Check stats');
    $mail->setBodyText('Log into your Piwik instance and check your stats!');
    $mail->send();
}
```

This example sends you an email once a day to remind you to log into your Piwik daily. The Piwik platform makes sure to execute the method remindMeToLogIn exactly once every day.

### Passing a parameter to a task

Sometimes you want to pass a parameter to a task method. This is useful if you want to register for instance one task for each user or for each website. You can achieve this by specifying a second parameter when registering the method to execute.

```php
public function schedule()
{
    foreach (\Piwik\Site::getSites() as $site) {
        // create one task for each site and pass the URL of each site to the task
        $this->hourly('pingSite', $site['main_url']);
    }
}

public function pingSite($siteMainUrl)
{
    file_get_contents($siteMainUrl);
}
```
### Retrying tasks that fail

By default, a scheduled task that fails with an exception will not be run again until it's next normal execution time.
If your task fails in a way where it would be appropriate to retry, then you can throw a `Piwik\SchedulerRetryableException`. 
The task scheduler will reschedule any task that fails with a `RetryableException` to try the task again in one hour and the retry up to a maximum of three times.

```php
public function myTask()
{
    try {
        // do something
    } catch (Exception $e) {
        if ($e->getMessage() == "Some API: too many requests, please retry later") {
            throw new RetryableException($e->getMessage())           
        } else {
            throw $e;
        }
    }
}
```

### Testing scheduled tasks

To manually execute all scheduled tasks, you can run the following command:

```
$ ./console core:run-scheduled-tasks 
```

There is one problem with this though: Piwik makes sure the scheduled tasks are executed only once an hour, a day, etc. This means you can't simply run the command again and again as you would have to wait for the next hour or day.

To solve this, the `--force` option will force to execute all tasks, even those that are not due to run at this time.

```
$ ./console core:run-scheduled-tasks --force 
```

Remember that manually testing your scheduled task is just the first step: adding [unit or integration tests](/guides/tests-php) is the best way to avoid regressions.

## Which tasks are registered and when is the next execution time of my task?

The [TasksTimetable plugin](https://plugins.matomo.org/TasksTimetable) from the Marketplace can answer this question for you. Simply install and activate the plugin with one click by going to *Settings > Marketplace > Get new functionality*. It will add a new admin menu item under *Settings* named *Scheduled Tasks*.

## Read more

You can read more about scheduled tasks in the [Tasks class reference](/api-reference/Piwik/Plugin/Tasks).

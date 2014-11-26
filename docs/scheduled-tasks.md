---
category: Develop
---
# Scheduled tasks

Scheduled tasks let you execute tasks regularly (hourly, weekly, …), for example:

- create and send custom reports or summaries
- sync users and websites with other systems
- clear any caches

## About this guide

**Read this guide if**

* you'd like to know **how to add a scheduled task to your plugin**

**Guide assumptions**

This guide assumes that you:

* can code in PHP, JavaScript and SQL,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide).

## Adding a scheduled task to your plugin

You can add a scheduled task to your plugin by using the [console](/guides/piwik-on-the-command-line):

```bash
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

### Testing scheduled tasks

After you have created your task you are surely wondering how to test it. First, you should write [a unit or integration test](/guides/tests-php).

To manually execute all scheduled tasks you can execute the API method `CoreAdminHome.runScheduledTasks` by opening the following URL in your browser:

[http://piwik.example.com/index.php?module=API&method=CoreAdminHome.runScheduledTasks&token_auth=YOUR_API_TOKEN](http://piwik.example.com/index.php?module=API&method=CoreAdminHome.runScheduledTasks&token_auth=YOUR_API_TOKEN)

*(don't forget to replace the domain and the [token_auth](http://piwik.org/faq/general/#faq_114) URL parameter)*

There is one problem with executing the scheduled tasks: Piwik makes sure they will be executed only once an hour, a day, etc. This means you can't simply reload the URL and test the method again and again as you would have to wait for the next hour or day. The proper solution is to set the constant `DEBUG_FORCE_SCHEDULED_TASKS` to `true` within the file `Core/TaskScheduler.php`. Don't forget to set it back to false again once you have finished testing it.

Starting from Piwik 2.6.0 you can alternatively execute the following command:

```bash
$ ./console core:run-scheduled-tasks --force --token-auth=YOUR_TOKEN_AUTH
```

The option `–force` will force to execute all tasks, even those that are not due to run at this time. With this solution you don't need to edit `TaskScheduler.php`.

## Which tasks are registered and when is the next execution time of my task?

The [TasksTimetable plugin](http://plugins.piwik.org/TasksTimetable) from the Marketplace can answer this question for you. Simply install and activate the plugin with one click by going to *Settings > Marketplace > Get new functionality*. It'll add a new admin menu item under *Settings* named *Scheduled Tasks*.

## Read more

You can read more about scheduled tasks in the [Tasks class reference](/api-reference/Piwik/Plugin/Tasks).

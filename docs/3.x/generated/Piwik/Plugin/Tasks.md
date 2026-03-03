<small>Piwik\Plugin\</small>

Tasks
=====

Base class for all Tasks declarations.

Tasks are usually meant as scheduled tasks that are executed regularly by Piwik in the background. For instance
once every hour or every day. This could be for instance checking for updates, sending email reports, etc.
Please don't mix up tasks with console commands which can be executed on the CLI.

Methods
-------

The class defines the following methods:

- [`hourly()`](#hourly) &mdash; Schedule the given tasks/method to run once every hour.
- [`daily()`](#daily) &mdash; Schedule the given tasks/method to run once every day.
- [`weekly()`](#weekly) &mdash; Schedule the given tasks/method to run once every week.
- [`monthly()`](#monthly) &mdash; Schedule the given tasks/method to run once every month.
- [`custom()`](#custom) &mdash; Schedules the given tasks/method to run depending at the given scheduled time.

<a name="hourly" id="hourly"></a>
<a name="hourly" id="hourly"></a>
### `hourly()`

Schedule the given tasks/method to run once every hour.

#### Signature

-  It accepts the following parameter(s):
    - `$methodName` (`string`) &mdash;
       The name of the method that will be called when the task is being exectuted. To make it work you need to create a public method having the given method name in your Tasks class.
    - `$methodParameter` (`null`|`string`) &mdash;
       Can be null if the task does not need any parameter or a string. It is not possible to specify multiple parameters as an array etc. If you need to pass multiple parameters separate them via any characters such as '###'. For instance '$param1###$param2###$param3'
    - `$priority` (`int`) &mdash;
       Can be any constant such as self::LOW_PRIORITY
- It returns a [`Schedule`](../../Piwik/Scheduler/Schedule/Schedule.md) value.

<a name="daily" id="daily"></a>
<a name="daily" id="daily"></a>
### `daily()`

Schedule the given tasks/method to run once every day.

See [hourly()](/api-reference/Piwik/Plugin/Tasks#hourly)

#### Signature

-  It accepts the following parameter(s):
    - `$methodName`
      
    - `$methodParameter`
      
    - `$priority`
      
- It does not return anything or a mixed result.

<a name="weekly" id="weekly"></a>
<a name="weekly" id="weekly"></a>
### `weekly()`

Schedule the given tasks/method to run once every week.

See [hourly()](/api-reference/Piwik/Plugin/Tasks#hourly)

#### Signature

-  It accepts the following parameter(s):
    - `$methodName`
      
    - `$methodParameter`
      
    - `$priority`
      
- It does not return anything or a mixed result.

<a name="monthly" id="monthly"></a>
<a name="monthly" id="monthly"></a>
### `monthly()`

Schedule the given tasks/method to run once every month.

See [hourly()](/api-reference/Piwik/Plugin/Tasks#hourly)

#### Signature

-  It accepts the following parameter(s):
    - `$methodName`
      
    - `$methodParameter`
      
    - `$priority`
      
- It does not return anything or a mixed result.

<a name="custom" id="custom"></a>
<a name="custom" id="custom"></a>
### `custom()`

Schedules the given tasks/method to run depending at the given scheduled time. Unlike the convenient methods
such as [hourly()](/api-reference/Piwik/Plugin/Tasks#hourly) you need to specify the object on which the given method should be called. This can be
either an instance of a class or a class name. For more information about these parameters see [hourly()](/api-reference/Piwik/Plugin/Tasks#hourly)

#### Signature

-  It accepts the following parameter(s):
    - `$objectOrClassName` (`string`|`object`) &mdash;
      
    - `$methodName` (`string`) &mdash;
      
    - `$methodParameter` (`null`|`string`) &mdash;
      
    - `$time` (`string`|[`Schedule`](../../Piwik/Scheduler/Schedule/Schedule.md)) &mdash;
      
    - `$priority` (`int`) &mdash;
      
- It returns a [`Schedule`](../../Piwik/Scheduler/Schedule/Schedule.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a wrong time format is given. Needs to be either a string such as &#039;daily&#039;, &#039;weekly&#039;, ...
                   or an instance of {@link Piwik\Scheduler\Schedule\Schedule}


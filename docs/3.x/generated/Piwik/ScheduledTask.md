<small>Piwik\</small>

ScheduledTask
=============

Contains metadata referencing PHP code that should be executed at regular intervals.

See the [TaskScheduler](/api-reference/Piwik/TaskScheduler) docs to learn more about scheduled tasks.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) Inherited from [`Task`](../Piwik/Scheduler/Task.md)
- [`getObjectInstance()`](#getobjectinstance) &mdash; Returns the object instance that contains the method to execute. Inherited from [`Task`](../Piwik/Scheduler/Task.md)
- [`getClassName()`](#getclassname) &mdash; Returns the name of the class that contains the method to execute. Inherited from [`Task`](../Piwik/Scheduler/Task.md)
- [`getMethodName()`](#getmethodname) &mdash; Returns the name of the method that will be executed. Inherited from [`Task`](../Piwik/Scheduler/Task.md)
- [`getMethodParameter()`](#getmethodparameter) &mdash; Returns the value that will be passed to the method when executed, or `null` if no value will be supplied. Inherited from [`Task`](../Piwik/Scheduler/Task.md)
- [`getScheduledTime()`](#getscheduledtime) &mdash; Returns a Schedule instance that describes when the method should be executed and how long before the next execution. Inherited from [`Task`](../Piwik/Scheduler/Task.md)
- [`getRescheduledTime()`](#getrescheduledtime) &mdash; Returns the time in milliseconds when this task will be executed next. Inherited from [`Task`](../Piwik/Scheduler/Task.md)
- [`getPriority()`](#getpriority) &mdash; Returns the task priority. Inherited from [`Task`](../Piwik/Scheduler/Task.md)
- [`getName()`](#getname) &mdash; Returns a unique name for this scheduled task. Inherited from [`Task`](../Piwik/Scheduler/Task.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$objectInstance` (`mixed`) &mdash;
       The object or class that contains the method to execute regularly. Usually this will be a [Plugin](/api-reference/Piwik/Plugin) instance.
    - `$methodName` (`string`) &mdash;
       The name of the method that will be regularly executed.
    - `$methodParameter` (`mixed`|`null`) &mdash;
       An optional parameter to pass to the method when executed. Must be convertible to string.
    - `$scheduledTime` ([`Schedule`](../Piwik/Scheduler/Schedule/Schedule.md)|`null`) &mdash;
       A Schedule instance that describes when the method should be executed and how long before the next execution.
    - `$priority` (`int`) &mdash;
       The priority of the task. Tasks with a higher priority will be executed first. Tasks with low priority will be executed last.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getobjectinstance" id="getobjectinstance"></a>
<a name="getObjectInstance" id="getObjectInstance"></a>
### `getObjectInstance()`

Returns the object instance that contains the method to execute. Returns a class
name if the method is static.

#### Signature

- It returns a `mixed` value.

<a name="getclassname" id="getclassname"></a>
<a name="getClassName" id="getClassName"></a>
### `getClassName()`

Returns the name of the class that contains the method to execute.

#### Signature

- It returns a `string` value.

<a name="getmethodname" id="getmethodname"></a>
<a name="getMethodName" id="getMethodName"></a>
### `getMethodName()`

Returns the name of the method that will be executed.

#### Signature

- It returns a `string` value.

<a name="getmethodparameter" id="getmethodparameter"></a>
<a name="getMethodParameter" id="getMethodParameter"></a>
### `getMethodParameter()`

Returns the value that will be passed to the method when executed, or `null` if
no value will be supplied.

#### Signature


- *Returns:*  `string`|`null` &mdash;
    

<a name="getscheduledtime" id="getscheduledtime"></a>
<a name="getScheduledTime" id="getScheduledTime"></a>
### `getScheduledTime()`

Returns a Schedule instance that describes when the method should be executed
and how long before the next execution.

#### Signature

- It returns a [`Schedule`](../Piwik/Scheduler/Schedule/Schedule.md) value.

<a name="getrescheduledtime" id="getrescheduledtime"></a>
<a name="getRescheduledTime" id="getRescheduledTime"></a>
### `getRescheduledTime()`

Returns the time in milliseconds when this task will be executed next.

#### Signature

- It returns a `int` value.

<a name="getpriority" id="getpriority"></a>
<a name="getPriority" id="getPriority"></a>
### `getPriority()`

Returns the task priority. The priority will be an integer whose value is
between `HIGH_PRIORITY` and `LOW_PRIORITY`.

#### Signature

- It returns a `int` value.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Returns a unique name for this scheduled task. The name is stored in the DB and is used
to store a task's previous execution time. The name is created using:

- the name of the class that contains the method to execute,
- the name of the method to regularly execute,
- and the value that is passed to the executed task.

#### Signature

- It returns a `string` value.


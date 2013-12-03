<small>Piwik</small>

ScheduledTask
=============

Contains metadata describing a chunk of PHP code that should be executed at regular intervals.

Description
-----------

See the TaskScheduler docs to learn more about scheduled tasks.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getObjectInstance()`](#getobjectinstance) &mdash; Returns the object instance on which the method should be executed.
- [`getClassName()`](#getclassname) &mdash; Returns the class name that contains the method to execute regularly.
- [`getMethodName()`](#getmethodname) &mdash; Returns the method name that will be regularly executed.
- [`getMethodParameter()`](#getmethodparameter) &mdash; Returns the a value that will be passed to the method when executed, or `null` if no value will be supplied.
- [`getScheduledTime()`](#getscheduledtime) &mdash; Returns a [ScheduledTime](/api-reference/Piwik/ScheduledTime) instance that describes when the method should be executed and how long before the next execution.
- [`getRescheduledTime()`](#getrescheduledtime) &mdash; Returns the time in milliseconds when this task will be executed next.
- [`getPriority()`](#getpriority) &mdash; Returns the task priority.
- [`getName()`](#getname) &mdash; Returns a unique name for this scheduled task.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$objectInstance` (`mixed`) &mdash; The object or class name for the class that contains the method to regularly execute. Usually this will be a [Plugin](/api-reference/Piwik/Plugin) instance.
    - `$methodName` (`string`) &mdash; The name of the method of `$objectInstance` that will be regularly executed.
    - `$methodParameter` (`mixed`|`null`) &mdash; An optional parameter to pass to the method when executed. Must be convertible to string.
    - `$scheduledTime` ([`ScheduledTime`](../Piwik/ScheduledTime.md)|`null`) &mdash; A [ScheduledTime](/api-reference/Piwik/ScheduledTime) instance that describes when the method should be executed and how long before the next execution.
    - `$priority` (`int`) &mdash; The priority of the task. Tasks with a higher priority will be executed first. Tasks with low priority will be executed last.

<a name="getobjectinstance" id="getobjectinstance"></a>
<a name="getObjectInstance" id="getObjectInstance"></a>
### `getObjectInstance()`

Returns the object instance on which the method should be executed.

#### Description

Returns a class
name if the method is static.

#### Signature

- It returns a `mixed` value.

<a name="getclassname" id="getclassname"></a>
<a name="getClassName" id="getClassName"></a>
### `getClassName()`

Returns the class name that contains the method to execute regularly.

#### Signature

- It returns a `string` value.

<a name="getmethodname" id="getmethodname"></a>
<a name="getMethodName" id="getMethodName"></a>
### `getMethodName()`

Returns the method name that will be regularly executed.

#### Signature

- It returns a `string` value.

<a name="getmethodparameter" id="getmethodparameter"></a>
<a name="getMethodParameter" id="getMethodParameter"></a>
### `getMethodParameter()`

Returns the a value that will be passed to the method when executed, or `null` if no value will be supplied.

#### Signature

- It can return one of the following values:
    - `string`
    - `null`

<a name="getscheduledtime" id="getscheduledtime"></a>
<a name="getScheduledTime" id="getScheduledTime"></a>
### `getScheduledTime()`

Returns a [ScheduledTime](/api-reference/Piwik/ScheduledTime) instance that describes when the method should be executed and how long before the next execution.

#### Signature

- It returns a [`ScheduledTime`](../Piwik/ScheduledTime.md) value.

<a name="getrescheduledtime" id="getrescheduledtime"></a>
<a name="getRescheduledTime" id="getRescheduledTime"></a>
### `getRescheduledTime()`

Returns the time in milliseconds when this task will be executed next.

#### Signature

- It returns a `int` value.

<a name="getpriority" id="getpriority"></a>
<a name="getPriority" id="getPriority"></a>
### `getPriority()`

Returns the task priority.

#### Description

The priority will be an integer whose value is
between HIGH\_PRIORITY and LOW\_PRIORITY.

#### Signature

- It returns a `int` value.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Returns a unique name for this scheduled task.

#### Description

The name is stored in the DB and is used
to store when tasks were last executed. The name is created using:

- the class name that contains the method to execute,
- the name of the method to regularly execute,
- and the value that is passed to the executed task.

#### Signature

- It returns a `string` value.


<small>Piwik</small>

ScheduledTask
=============

Contains metadata describing and referencing a chunk of PHP code that should be executed regularly.

Description
-----------

See the [TaskScheduler](#) docs to learn more about scheduled tasks.


Constants
---------

This class defines the following constants:

- [`LOWEST_PRIORITY`](#LOWEST_PRIORITY)
- [`LOW_PRIORITY`](#LOW_PRIORITY)
- [`NORMAL_PRIORITY`](#NORMAL_PRIORITY)
- [`HIGH_PRIORITY`](#HIGH_PRIORITY)
- [`HIGHEST_PRIORITY`](#HIGHEST_PRIORITY)

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getObjectInstance()`](#getObjectInstance) &mdash; Return the object instance on which the method should be executed.
- [`getClassName()`](#getClassName) &mdash; Returns the class name that contains the method to execute regularly.
- [`getMethodName()`](#getMethodName) &mdash; Returns the method name that will be regularly executed.
- [`getMethodParameter()`](#getMethodParameter) &mdash; Returns the a value that will be passed to the method when executed, or `null` if no value will be supplied.
- [`getScheduledTime()`](#getScheduledTime) &mdash; Returns a [ScheduledTime](#) instance that describes when the method should be executed and how long before the next execution.
- [`getRescheduledTime()`](#getRescheduledTime) &mdash; Returns the time in milliseconds when this task will be executed next.
- [`getPriority()`](#getPriority) &mdash; Returns the task priority.
- [`getName()`](#getName) &mdash; Returns a unique name for this scheduled task.
- [`getTaskName()`](#getTaskName)

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$objectInstance`
    - `$methodName`
    - `$methodParameter`
    - `$scheduledTime`
    - `$priority`
- It does not return anything.

<a name="getobjectinstance" id="getobjectinstance"></a>
### `getObjectInstance()`

Return the object instance on which the method should be executed.

#### Description

Returns a class
name if the method is static.

#### Signature

- It is a **public** method.
- It returns a(n) `mixed` value.

<a name="getclassname" id="getclassname"></a>
### `getClassName()`

Returns the class name that contains the method to execute regularly.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="getmethodname" id="getmethodname"></a>
### `getMethodName()`

Returns the method name that will be regularly executed.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="getmethodparameter" id="getmethodparameter"></a>
### `getMethodParameter()`

Returns the a value that will be passed to the method when executed, or `null` if no value will be supplied.

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `string`
    - `null`

<a name="getscheduledtime" id="getscheduledtime"></a>
### `getScheduledTime()`

Returns a [ScheduledTime](#) instance that describes when the method should be executed and how long before the next execution.

#### Signature

- It is a **public** method.
- It returns a(n) `Piwik\ScheduledTime` value.

<a name="getrescheduledtime" id="getrescheduledtime"></a>
### `getRescheduledTime()`

Returns the time in milliseconds when this task will be executed next.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

<a name="getpriority" id="getpriority"></a>
### `getPriority()`

Returns the task priority.

#### Description

The priority will be an integer whose value is
between [ScheduledTask::HIGH_PRIORITY](#) and [ScheduledTask::LOW_PRIORITY](#).

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

<a name="getname" id="getname"></a>
### `getName()`

Returns a unique name for this scheduled task.

#### Description

The name is stored in the DB and is used
to store when tasks were last executed. The name is created using:

- the class name that contains the method to execute,
- the name of the method to regularly execute,
- and the value that is passed to the executed task.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

<a name="gettaskname" id="gettaskname"></a>
### `getTaskName()`

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$className`
    - `$methodName`
    - `$methodParameter`
- It does not return anything.


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

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$objectInstance`
    - `$methodName`
    - `$methodParameter`
    - `$scheduledTime` (`Piwik\ScheduledTime`)
    - `$priority`
- It does not return anything.

### `getObjectInstance()` <a name="getObjectInstance"></a>

Return the object instance on which the method should be executed.

#### Description

Returns a class
name if the method is static.

#### Signature

- It is a **public** method.
- It returns a(n) `mixed` value.

### `getClassName()` <a name="getClassName"></a>

Returns the class name that contains the method to execute regularly.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getMethodName()` <a name="getMethodName"></a>

Returns the method name that will be regularly executed.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getMethodParameter()` <a name="getMethodParameter"></a>

Returns the a value that will be passed to the method when executed, or `null` if no value will be supplied.

#### Signature

- It is a **public** method.
- It can return one of the following values:
    - `string`
    - `null`

### `getScheduledTime()` <a name="getScheduledTime"></a>

Returns a [ScheduledTime](#) instance that describes when the method should be executed and how long before the next execution.

#### Signature

- It is a **public** method.
- It returns a(n) `Piwik\ScheduledTime` value.

### `getRescheduledTime()` <a name="getRescheduledTime"></a>

Returns the time in milliseconds when this task will be executed next.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `getPriority()` <a name="getPriority"></a>

Returns the task priority.

#### Description

The priority will be an integer whose value is
between [ScheduledTask::HIGH_PRIORITY](#) and [ScheduledTask::LOW_PRIORITY](#).

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `getName()` <a name="getName"></a>

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

### `getTaskName()` <a name="getTaskName"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$className`
    - `$methodName`
    - `$methodParameter`
- It does not return anything.


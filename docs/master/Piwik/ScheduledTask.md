<small>Piwik</small>

ScheduledTask
=============

ScheduledTask is used by the task scheduler and by plugins to configure runnable tasks.


Constants
---------

This class defines the following constants:

- [`LOWEST_PRIORITY`](#LOWEST_PRIORITY)
- [`LOW_PRIORITY`](#LOW_PRIORITY)
- [`NORMAL_PRIORITY`](#NORMAL_PRIORITY)
- [`HIGH_PRIORITY`](#HIGH_PRIORITY)
- [`HIGHEST_PRIORITY`](#HIGHEST_PRIORITY)

Properties
----------

This class defines the following properties:

- [`$objectInstance`](#$objectInstance) &mdash; Object instance on which the method will be executed by the task scheduler
- [`$className`](#$className) &mdash; Class name where the specified method is located
- [`$methodName`](#$methodName) &mdash; Class method to run when task is scheduled
- [`$methodParameter`](#$methodParameter) &mdash; Parameter to pass to the executed method
- [`$scheduledTime`](#$scheduledTime) &mdash; The scheduled time policy
- [`$priority`](#$priority) &mdash; The priority of a task.

### `$objectInstance` <a name="objectInstance"></a>

Object instance on which the method will be executed by the task scheduler

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$className` <a name="className"></a>

Class name where the specified method is located

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$methodName` <a name="methodName"></a>

Class method to run when task is scheduled

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$methodParameter` <a name="methodParameter"></a>

Parameter to pass to the executed method

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$scheduledTime` <a name="scheduledTime"></a>

The scheduled time policy

#### Signature

- It is a **public** property.
- It is a(n) `Piwik\ScheduledTime` value.

### `$priority` <a name="priority"></a>

The priority of a task.

#### Description

Affects the order in which this task will be run.

#### Signature

- It is a **public** property.
- It is a(n) `int` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`getObjectInstance()`](#getObjectInstance) &mdash; Return the object instance on which the method should be executed
- [`getClassName()`](#getClassName) &mdash; Return class name
- [`getMethodName()`](#getMethodName) &mdash; Return method name
- [`getMethodParameter()`](#getMethodParameter) &mdash; Return method parameter
- [`getScheduledTime()`](#getScheduledTime) &mdash; Return scheduled time
- [`getRescheduledTime()`](#getRescheduledTime) &mdash; Return the rescheduled time in milliseconds
- [`getPriority()`](#getPriority) &mdash; Return the task priority.
- [`getName()`](#getName)
- [`getTaskName()`](#getTaskName)

### `__construct()` <a name="__construct"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$_objectInstance`
    - `$_methodName`
    - `$_methodParameter`
    - `$_scheduledTime`
    - `$_priority`
- It does not return anything.

### `getObjectInstance()` <a name="getObjectInstance"></a>

Return the object instance on which the method should be executed

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getClassName()` <a name="getClassName"></a>

Return class name

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getMethodName()` <a name="getMethodName"></a>

Return method name

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getMethodParameter()` <a name="getMethodParameter"></a>

Return method parameter

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getScheduledTime()` <a name="getScheduledTime"></a>

Return scheduled time

#### Signature

- It is a **public** method.
- It returns a(n) `Piwik\ScheduledTime` value.

### `getRescheduledTime()` <a name="getRescheduledTime"></a>

Return the rescheduled time in milliseconds

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `getPriority()` <a name="getPriority"></a>

Return the task priority.

#### Description

The priority will be an integer whose value is
between ScheduledTask::HIGH_PRIORITY and ScheduledTask::LOW_PRIORITY.

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `getName()` <a name="getName"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getTaskName()` <a name="getTaskName"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$className`
    - `$methodName`
    - `$methodParameter`
- It does not return anything.


<small>Piwik</small>

ScheduledTask
=============

ScheduledTask is used by the task scheduler and by plugins to configure runnable tasks.


Constants
---------

This class defines the following constants:

- [`LOWEST_PRIORITY`](#lowest_priority)
- [`LOW_PRIORITY`](#low_priority)
- [`NORMAL_PRIORITY`](#normal_priority)
- [`HIGH_PRIORITY`](#high_priority)
- [`HIGHEST_PRIORITY`](#highest_priority)

Properties
----------

This class defines the following properties:

- [`$objectInstance`](#$objectinstance) &mdash; Object instance on which the method will be executed by the task scheduler
- [`$className`](#$classname) &mdash; Class name where the specified method is located
- [`$methodName`](#$methodname) &mdash; Class method to run when task is scheduled
- [`$methodParameter`](#$methodparameter) &mdash; Parameter to pass to the executed method
- [`$scheduledTime`](#$scheduledtime) &mdash; The scheduled time policy
- [`$priority`](#$priority) &mdash; The priority of a task.

<a name="objectinstance" id="objectinstance"></a>
### `$objectInstance`

Object instance on which the method will be executed by the task scheduler

#### Signature

- It is a(n) `string` value.

<a name="classname" id="classname"></a>
### `$className`

Class name where the specified method is located

#### Signature

- It is a(n) `string` value.

<a name="methodname" id="methodname"></a>
### `$methodName`

Class method to run when task is scheduled

#### Signature

- It is a(n) `string` value.

<a name="methodparameter" id="methodparameter"></a>
### `$methodParameter`

Parameter to pass to the executed method

#### Signature

- It is a(n) `string` value.

<a name="scheduledtime" id="scheduledtime"></a>
### `$scheduledTime`

The scheduled time policy

#### Signature

- It is a(n) `Piwik\ScheduledTime` value.

<a name="priority" id="priority"></a>
### `$priority`

The priority of a task.

#### Description

Affects the order in which this task will be run.

#### Signature

- It is a(n) `int` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`getObjectInstance()`](#getobjectinstance) &mdash; Return the object instance on which the method should be executed
- [`getClassName()`](#getclassname) &mdash; Return class name
- [`getMethodName()`](#getmethodname) &mdash; Return method name
- [`getMethodParameter()`](#getmethodparameter) &mdash; Return method parameter
- [`getScheduledTime()`](#getscheduledtime) &mdash; Return scheduled time
- [`getRescheduledTime()`](#getrescheduledtime) &mdash; Return the rescheduled time in milliseconds
- [`getPriority()`](#getpriority) &mdash; Return the task priority.
- [`getName()`](#getname)
- [`getTaskName()`](#gettaskname)

<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

- It accepts the following parameter(s):
    - `$_objectInstance`
    - `$_methodName`
    - `$_methodParameter`
    - `$_scheduledTime`
    - `$_priority`
- It does not return anything.

<a name="getobjectinstance" id="getobjectinstance"></a>
### `getObjectInstance()`

Return the object instance on which the method should be executed

#### Signature

- It returns a(n) `string` value.

<a name="getclassname" id="getclassname"></a>
### `getClassName()`

Return class name

#### Signature

- It returns a(n) `string` value.

<a name="getmethodname" id="getmethodname"></a>
### `getMethodName()`

Return method name

#### Signature

- It returns a(n) `string` value.

<a name="getmethodparameter" id="getmethodparameter"></a>
### `getMethodParameter()`

Return method parameter

#### Signature

- It returns a(n) `string` value.

<a name="getscheduledtime" id="getscheduledtime"></a>
### `getScheduledTime()`

Return scheduled time

#### Signature

- It returns a(n) `Piwik\ScheduledTime` value.

<a name="getrescheduledtime" id="getrescheduledtime"></a>
### `getRescheduledTime()`

Return the rescheduled time in milliseconds

#### Signature

- It returns a(n) `int` value.

<a name="getpriority" id="getpriority"></a>
### `getPriority()`

Return the task priority.

#### Description

The priority will be an integer whose value is
between ScheduledTask::HIGH_PRIORITY and ScheduledTask::LOW_PRIORITY.

#### Signature

- It returns a(n) `int` value.

<a name="getname" id="getname"></a>
### `getName()`

#### Signature

- It does not return anything.

<a name="gettaskname" id="gettaskname"></a>
### `getTaskName()`

#### Signature

- It accepts the following parameter(s):
    - `$className`
    - `$methodName`
    - `$methodParameter`
- It does not return anything.


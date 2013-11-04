<small>Piwik</small>

Notification
============

Notification class.

Description
-----------

Example:
```
$notification = new \Piwik\Notification('My Error Message');
$notification->context = Notification::CONTEXT_ERROR;
\Piwik\Notification\Manager::notify('pluginname_id', $notification);
```


Constants
---------

This class defines the following constants:

- [`CONTEXT_SUCCESS`](#CONTEXT_SUCCESS)
- [`CONTEXT_ERROR`](#CONTEXT_ERROR)
- [`CONTEXT_INFO`](#CONTEXT_INFO)
- [`CONTEXT_WARNING`](#CONTEXT_WARNING)
- [`PRIORITY_MIN`](#PRIORITY_MIN) &mdash; Lowest priority
- [`PRIORITY_LOW`](#PRIORITY_LOW) &mdash; Lower priority
- [`PRIORITY_HIGH`](#PRIORITY_HIGH) &mdash; Higher priority
- [`PRIORITY_MAX`](#PRIORITY_MAX) &mdash; Highest priority
- [`FLAG_NO_CLEAR`](#FLAG_NO_CLEAR) &mdash; If flag applied, no close icon will be displayed.
- [`TYPE_TOAST`](#TYPE_TOAST) &mdash; Implies transient.
- [`TYPE_PERSISTENT`](#TYPE_PERSISTENT) &mdash; Notification will be displayed until the new user explicitly closes the notification
- [`TYPE_TRANSIENT`](#TYPE_TRANSIENT) &mdash; Notification will be displayed only once.

### `FLAG_NO_CLEAR` <a name="FLAG_NO_CLEAR"></a>

Please note that persistent notifications always have a close
icon

### `TYPE_TOAST` <a name="TYPE_TOAST"></a>

Notification will be displayed for a few seconds and then faded out

Properties
----------

This class defines the following properties:

- [`$title`](#$title) &mdash; The title of the notification.
- [`$message`](#$message) &mdash; The actual message that will be displayed.
- [`$flags`](#$flags)
- [`$type`](#$type) &mdash; The type of the notification.
- [`$context`](#$context) &mdash; Context of the notification.
- [`$priority`](#$priority) &mdash; The priority of the notification, the higher the priority, the higher the order.

### `$title` <a name="title"></a>

The title of the notification.

#### Description

For instance the plugin name. The title is optional.

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$message` <a name="message"></a>

The actual message that will be displayed.

#### Description

Must be set.

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$flags` <a name="flags"></a>

#### Signature

- It is a **public** property.
- It is a(n) `int` value.

### `$type` <a name="type"></a>

The type of the notification.

#### Description

See self::TYPE_*

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$context` <a name="context"></a>

Context of the notification.

#### Description

For instance info, warning, success or error.

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$priority` <a name="priority"></a>

The priority of the notification, the higher the priority, the higher the order.

#### Description

Notifications having the
highest priority will be displayed first and all other notifications below. See self::PRIORITY_*

#### Signature

- It is a **public** property.
- It is a(n) `int` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`hasNoClear()`](#hasNoClear)
- [`getPriority()`](#getPriority)

### `__construct()` <a name="__construct"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$message`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case the message is empty.

### `hasNoClear()` <a name="hasNoClear"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getPriority()` <a name="getPriority"></a>

#### Signature

- It is a **public** method.
- It does not return anything.


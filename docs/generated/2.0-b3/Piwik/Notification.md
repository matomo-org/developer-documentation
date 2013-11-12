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

- [`FLAG_NO_CLEAR`](#flag_no_clear) &mdash; If flag applied, no close icon will be displayed.
- [`TYPE_TOAST`](#type_toast) &mdash; Implies transient.

<a name="flag_no_clear" id="flag_no_clear"></a>
<a name="FLAG_NO_CLEAR" id="FLAG_NO_CLEAR"></a>
### `FLAG_NO_CLEAR`

Please note that persistent notifications always have a close
icon

<a name="type_toast" id="type_toast"></a>
<a name="TYPE_TOAST" id="TYPE_TOAST"></a>
### `TYPE_TOAST`

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

<a name="$title" id="$title"></a>
<a name="title" id="title"></a>
### `$title`

The title of the notification.

#### Description

For instance the plugin name. The title is optional.

#### Signature

- It is a `string` value.

<a name="$message" id="$message"></a>
<a name="message" id="message"></a>
### `$message`

The actual message that will be displayed.

#### Description

Must be set.

#### Signature

- It is a `string` value.

<a name="$flags" id="$flags"></a>
<a name="flags" id="flags"></a>
### `$flags`

#### Signature

- It is a `int` value.

<a name="$type" id="$type"></a>
<a name="type" id="type"></a>
### `$type`

The type of the notification.

#### Description

See self::TYPE_*

#### Signature

- It is a `string` value.

<a name="$context" id="$context"></a>
<a name="context" id="context"></a>
### `$context`

Context of the notification.

#### Description

For instance info, warning, success or error.

#### Signature

- It is a `string` value.

<a name="$priority" id="$priority"></a>
<a name="priority" id="priority"></a>
### `$priority`

The priority of the notification, the higher the priority, the higher the order.

#### Description

Notifications having the
highest priority will be displayed first and all other notifications below. See self::PRIORITY_*

#### Signature

- It is a `int` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`hasNoClear()`](#hasnoclear)
- [`getPriority()`](#getpriority)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

- It accepts the following parameter(s):
    - `$message` (`string`) &mdash; The notification message. Make sure to escape the message if needed.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case the message is empty.

<a name="hasnoclear" id="hasnoclear"></a>
<a name="hasNoClear" id="hasNoClear"></a>
### `hasNoClear()`

#### Signature

- It does not return anything.

<a name="getpriority" id="getpriority"></a>
<a name="getPriority" id="getPriority"></a>
### `getPriority()`

#### Signature

- It does not return anything.


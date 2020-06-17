<small>Piwik\</small>

Notification
============

Describes a UI notification.

UI notifications are messages displayed to the user near the top of the screen.
Notifications consist of a message, a context (the message type), a priority
and a display type.

**The context** affects the way the message looks, but not how it is displayed.

**The display type** determines how the message is displayed.

**The priority** determines where it is shown in the list of all displayed notifications.

### Examples

**Display an error message**

    $notification = new Notification('My Error Message');
    $notification->context = Notification::CONTEXT_ERROR;
    Notification\Manager::notify('myUniqueNotificationId', $notification);

**Display a temporary success message**

    $notification = new Notification('Success');
    $notification->context = Notification::CONTEXT_SUCCESS;
    $notification->type = Notification::TYPE_TOAST;
    Notification\Manager::notify('myUniqueNotificationId', $notification);

**Display a message near the top of the screen**

    $notification = new Notification('Urgent: Your password has expired!');
    $notification->context = Notification::CONTEXT_INFO;
    $notification->type = Notification::TYPE_PERSISTENT;
    $notification->priority = Notification::PRIORITY_MAX;

Constants
---------

This class defines the following constants:

- [`FLAG_NO_CLEAR`](#flag_no_clear) — If this flag is applied, no close icon will be displayed. _Note: persistent notifications always have a close
icon._- [`FLAG_CLEAR`](#flag_clear) — If this flag is applied, a close icon will be displayed.- [`TYPE_PERSISTENT`](#type_persistent) — Notifications of this type will be displayed until the new user explicitly closes the notification.
<a name="flag_no_clear" id="flag_no_clear"></a>
<a name="FLAG_NO_CLEAR" id="FLAG_NO_CLEAR"></a>
### `FLAG_NO_CLEAR`

See [$flags](/api-reference/Piwik/Notification#$flags).
<a name="flag_clear" id="flag_clear"></a>
<a name="FLAG_CLEAR" id="FLAG_CLEAR"></a>
### `FLAG_CLEAR`

See [$flags](/api-reference/Piwik/Notification#$flags).
<a name="type_persistent" id="type_persistent"></a>
<a name="TYPE_PERSISTENT" id="TYPE_PERSISTENT"></a>
### `TYPE_PERSISTENT`

The notifications will display even if the user reloads the page.

Properties
----------

This class defines the following properties:

- [`$title`](#$title) &mdash; The notification title.
- [`$message`](#$message) &mdash; The notification message.
- [`$flags`](#$flags) &mdash; Contains extra display options.
- [`$type`](#$type) &mdash; The notification's display type.
- [`$context`](#$context) &mdash; The notification's context (message type).
- [`$priority`](#$priority) &mdash; The notification's priority.
- [`$raw`](#$raw) &mdash; If true, the message will not be escaped before being outputted as HTML.

<a name="$title" id="$title"></a>
<a name="title" id="title"></a>
### `$title`

The notification title. The title is optional and is displayed directly before the message content.

#### Signature

- It is a `string` value.

<a name="$message" id="$message"></a>
<a name="message" id="message"></a>
### `$message`

The notification message. Must be set.

#### Signature

- It is a `string` value.

<a name="$flags" id="$flags"></a>
<a name="flags" id="flags"></a>
### `$flags`

Contains extra display options.

Usage: `$notification->flags = Notification::FLAG_BAR | Notification::FLAG_FOO`.

#### Signature

- It is a `int` value.

<a name="$type" id="$type"></a>
<a name="type" id="type"></a>
### `$type`

The notification's display type. See `TYPE_*` constants in [Notification](/api-reference/Piwik/Notification).

#### Signature

- It is a `string` value.

<a name="$context" id="$context"></a>
<a name="context" id="context"></a>
### `$context`

The notification's context (message type). See `CONTEXT_*` constants in [Notification](/api-reference/Piwik/Notification).

A notification's context determines how it will be styled.

#### Signature

- It is a `string` value.

<a name="$priority" id="$priority"></a>
<a name="priority" id="priority"></a>
### `$priority`

The notification's priority. The higher the priority, the higher the order. See `PRIORITY_*`
constants in [Notification](/api-reference/Piwik/Notification) to see possible priority values.

#### Signature

- It is a `int` value.

<a name="$raw" id="$raw"></a>
<a name="raw" id="raw"></a>
### `$raw`

If true, the message will not be escaped before being outputted as HTML. If you set this to
`true`, make sure you escape text yourself in order to avoid XSS vulnerabilities.

#### Signature

- It is a `bool` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`hasNoClear()`](#hasnoclear) &mdash; Returns `1` if the notification will be displayed without a close button, `0` if otherwise.
- [`getPriority()`](#getpriority) &mdash; Returns the notification's priority.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$message` (`string`) &mdash;
       The notification message.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the message is empty.

<a name="hasnoclear" id="hasnoclear"></a>
<a name="hasNoClear" id="hasNoClear"></a>
### `hasNoClear()`

Returns `1` if the notification will be displayed without a close button, `0` if otherwise.

#### Signature


- *Returns:*  `int` &mdash;
    `1` or `0`.

<a name="getpriority" id="getpriority"></a>
<a name="getPriority" id="getPriority"></a>
### `getPriority()`

Returns the notification's priority. If no priority has been set, a priority will be set based
on the notification's context.

#### Signature

- It returns a `int` value.


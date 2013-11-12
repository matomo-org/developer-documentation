<small>Piwik\Notification</small>

Manager
=======

Methods
-------

The class defines the following methods:

- [`notify()`](#notify) &mdash; Post a notification to be shown in the status bar.

<a name="notify" id="notify"></a>
<a name="notify" id="notify"></a>
### `notify()`

Post a notification to be shown in the status bar.

#### Description

If a notification with the same id has already been posted
by your application and has not yet been canceled, it will be replaced by the updated information.

#### Signature

- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; A unique identifier for this notification. Id must be a string and may contain only word characters (AlNum + underscore)
    - `$notification` ([`Notification`](../../Piwik/Notification.md))
- It does not return anything.


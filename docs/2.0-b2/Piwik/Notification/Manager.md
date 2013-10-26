<small>Piwik\Notification</small>

Manager
=======


Methods
-------

The class defines the following methods:

- [`notify()`](#notify) &mdash; Post a notification to be shown in the status bar.
- [`getAllNotificationsToDisplay()`](#getAllNotificationsToDisplay)
- [`cancel()`](#cancel) &mdash; Cancel a previously registered (or persistent) notification.

### `notify()` <a name="notify"></a>

Post a notification to be shown in the status bar.

#### Description

If a notification with the same id has already been posted
by your application and has not yet been canceled, it will be replaced by the updated information.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id`
    - `$notification` ([`Notification`](../../Piwik/Notification.md))
- It does not return anything.

### `getAllNotificationsToDisplay()` <a name="getAllNotificationsToDisplay"></a>

#### Signature

- It is a **public static** method.
- It does not return anything.

### `cancel()` <a name="cancel"></a>

Cancel a previously registered (or persistent) notification.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id`
- It does not return anything.


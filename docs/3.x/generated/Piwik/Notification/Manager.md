<small>Piwik\Notification\</small>

Manager
=======

Posts and removes UI notifications (see [Notification](/api-reference/Piwik/Notification) to learn more).

Methods
-------

The class defines the following methods:

- [`notify()`](#notify) &mdash; Posts a notification that will be shown in Piwik's status bar.

<a name="notify" id="notify"></a>
<a name="notify" id="notify"></a>
### `notify()`

Posts a notification that will be shown in Piwik's status bar. If a notification with the same ID
has been posted and has not been closed/removed, it will be replaced with `$notification`.

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`string`) &mdash;
       A unique identifier for this notification. The ID must be a valid HTML element ID. It can only contain alphanumeric characters (underscores can be used).
    - `$notification` ([`Notification`](../../Piwik/Notification.md)) &mdash;
       The notification to post.
- It does not return anything or a mixed result.


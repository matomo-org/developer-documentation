<small>Piwik\Notification\</small>

Manager
=======

Posts and removes UI notifications (see [Notification](#) to learn more).

Methods
-------

The class defines the following methods:

- [`notify()`](#notify) &mdash; Posts a notification that will be shown in Piwik's status bar.

<a name="notify" id="notify"></a>
<a name="notify" id="notify"></a>
### `notify()`

Posts a notification that will be shown in Piwik's status bar.

If a notification with the same id
has been posted and has not been closed/removed, it will be replaced with `$notification`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$id` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A unique identifier for this notification. The ID must be a valid HTML element ID. It can only contain alphanumeric characters (underscores can be used).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$notification` ([`Notification`](../../Piwik/Notification.md)) &mdash;

      <div markdown="1" class="param-desc"> The notification to post.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.


---
category: Develop
---
# Notifications

Notifications are typically used for when a taken action is successful or results in an error or warning. They can also be used to show informational messages.

## Examples of notifications

<img src="/img/plugin_notifications.png"/>

Above screenshot shows notifications of type error, warning, info and success. The last notifications uses a notification title ("Well done").

## Creating a notification using PHP

To trigger a notification, create an instance of a notification object and call the `notify` method to actually show the notification:

```php
$id = '$PluginName_$NotificationId'; // for example `MyPluginName_unsucessfulLogin`.
$notification = new \Piwik\Notification('My notification message');
\Piwik\Notification\Manager::notify($id, $notification);
```

This example triggers an info notification (default) with the message `My notification message` and is shown in the status bar of Matomo (below the update checker and site selector).

The notification ID should be a unique ID and ideally consist of your plugin name as well as some identifier that identifies this type of notification. The ID makes sure that the same notification won't be shown multiple times if it was triggered multiple times during the same request.

### Customising a notification

#### Setting a title

A set title will be displayed before the message content.

```php 
$notification->title = 'My notification title';
```

#### Setting a context

You can change the context (severity) of the notification by setting the `context` property and assigning a `Notification::CONTEXT_*` constant. For example:

```php
$notification->context = Notification::CONTEXT_SUCCESS;
$notification->context = Notification::CONTEXT_INFO;
$notification->context = Notification::CONTEXT_WARNING;
$notification->context = Notification::CONTEXT_ERROR;
```

#### Notification type

By default, a notification is shown only on the same page view as it was triggered. However, you can change this behaviour by setting a different type:

```php
$notification->type = Notification::TYPE_TOAST;
$notification->type = Notification::TYPE_PERSISTENT;
```

A notification of type toast is shown just like a regular notification but it will disappear after a few seconds.

A notification of type persistent will be displayed until the user explicitly closes the notification. The notifications will display even if the user reloads the page.

#### Using HTML in the message

If you need to use HTML as part of your notification message, for example to show a link, then you need to set the flag `$raw` to `true`. If you enable this flag, make sure the message does not contain any user input or only safely escaped user input for [security](/guides/security-in-piwik) reasons.

```php
$notification->raw = true;
```

#### More information and examples

[Learn more about the Notification class in the API reference](/api-reference/Piwik/Notification).

## Notifications using JavaScript

Client side notifications can be shown using the `Notification.show` method:

```javascript
var id = 'MyPluginName_unsucessfulLogin';
var context = 'info'; // or 'warning' or 'error' or 'success'
var UI = require('piwik/UI');
var notification = new UI.Notification();
notification.show(message, {context: context, id: id, title: 'Optional'});
setTimeout(function () {
    // optional
    notification.scrollToNotification();
}, 200);
```

The options are the same as for PHP notifications.

### Placing a notification

A unique feature that is available to JavaScript notifications is it's possibility to show the notification in a specific part of a page using the `placeat` property. Simply specify a CSS selector and Matomo will show the message as part of this element instead of the status bar.

```javascript
notification.show(message, {placeat: 'body .myElement', id: id});
```
---
category: DevelopInDepth
title: Users In Depth
---
# Users In Depth

## Storing user specific values

There are at least four different ways to store values / settings / preferences for a user.

### Option 1) Plugin settings

You can create [user specific plugin settings](/guides/plugin-settings). You can [find an example here](https://github.com/matomo-org/matomo/blob/4.1.2-rc1/plugins/ExampleSettingsPlugin/UserSettings.php).

When using this API, Matomo will automatically add a UI for the user to change the values for this setting. With very little work you can basically set up a setting and retrieve values for a specific user. Matomo will take care of most of the work for you as you only need to define the setting itself.

Some core logic uses the underlying backend API directly [see this example](https://github.com/matomo-org/matomo/blob/4.1.0/plugins/CorePluginsAdmin/Model/TagManagerTeaser.php#L44-L58). It's usually discouraged to use the plugin settings backend directly unless you really need a setting. The user preferences API might be a better fit though.

### Option 2) User Preference API

The [UsersManager.setUserPreference API](https://github.com/matomo-org/matomo/blob/4.1.0/plugins/UsersManager/API.php#L194) is kind of the predecessor of the above plugin settings API. It can still be used if there is a user preference where you don't want Matomo to build the UI for you. This might be the case if you want to have the user preference appear somewhere else instead of the regular "Admin -> Personal -> Settings" UI. 

To define a new preference, you might need to adjust the `plugins/MyPluginName/config/config.php` and define the name of the preference like this:

```
return array('usersmanager.user_preference_names' => Piwik\DI::add(array('preference_name_1', 'preference_name_2')))
```

This would allow you to call eg `UsersManager.(set|get)UserPreference($login, 'preference_name_1')`

### Option 3) Option API

User specific data can also be stored in the `option` table similar to [retrieving a value](https://github.com/matomo-org/matomo/blob/4.1.0/plugins/Feedback/Feedback.php#L80-L93) and storing a [user specific value](https://github.com/matomo-org/matomo/blob/4.1.0/plugins/Feedback/Controller.php#L37-L47). Basically, you define a meaningful key and append the username to the key `Option::get('MyPluginName.valueDescribeSetting.' . Piwik::getCurrentUserLogin());`. This way a different entry is created in the `option` table for every user. 

Similarly you can set a value using `Option:set('MyPluginName.valueDescribeSetting.' . Piwik::getCurrentUserLogin(), $value)` or get all values for all users like `Option.getLike('MyPluginName.valueDescribeSetting.%')`.

When a user is deleted, you would need to make sure to clean up any configured value using the `'UsersManager.deleteUser'` event where you can then do a `Option::delete($key)`.

It's very much recommended encapsulating all related logic to this in one class and not spread the `Option` calls across different classes.

Using the option table can be a good solution if you need to store a value that is not a setting/preference. Like you want to store when the user
last performed a specific action.

### Option 4) Custom API

If none of the above is a good fit you could also create a new DB table as it was done for example for `user_language` and `user_dashboard`. The prefix of the table would be `user_`.

---
category: Develop
---
# Triggers

A trigger in the context of a tag manager lets you define on which event a certain tag should be fired or blocked. For example when a specific element was clicked, or when a visitor reached a certain scroll position.

Matomo lets you easily create a new trigger. When you create a new trigger, please consider contributing this new trigger to the [official Tag Manager plugin](https://github.com/matomo-org/tag-manager) by creating a pull request.

<div markdown="1" class="alert alert-info">
Tags, triggers, and variables are all implemented in the same way except for a minor difference in the JavaScript part. Once you know how to develop a trigger, you will also be able to develop a tag and a variable.
</div>

## Adding a new trigger

We're going to create a new trigger that is fired whenever the online status changes from online to offline or the other way around. To show
an example with a trigger parameter, we are also offering a possibility to trigger an event only when the user goes online or offline.

To create a new trigger, you should use the CLI tool and execute the following command:

```bash
$ ./console generate:tagmanager-trigger
```

This command will guide you through the creation of a trigger and ask for several things such as the name of your plugin and the name of the trigger you want to create. When it asks you for a trigger name, enter "Online Change". The command creates these files:

* `plugins/$yourplugin/Template/Trigger/OnlineChangeTrigger.php` lets you define for example the category of the trigger and define parameters.
* `plugins/$yourplugin/Template/Trigger/OnlineChangeTrigger.web.js` lets you implement the JavaScript logic to detect the change of the online status.

### Defining the name, description, and help of your trigger

When you generate a trigger, the generator will automatically create some [translation keys](/guides/translations) in your `plugin/$yourplugin/lang/en.json` file.
You may want to adjust the translations for the created keys:

```json
"OnlineChangeTriggerName": "Online Change",
"OnlineChangeTriggerDescription": "This is the description for Online Change",
"OnlineChangeTriggerHelp": ""
```

Alternatively, you can also set the name, description, and the optional help text in your `OnlineChangeTrigger.php` but it is recommended
to use translation keys so other developers can translate it into different languages.

The description should be ideally kept quite short and in one sentence. A help text is usually not needed, but may be useful if you want to describe the trigger in more detail or want to give users further instructions on what the trigger actually does.

### Configuring the trigger category

In the generated `OnlineChangeTrigger.php`, you will find a method named `getCategory()`. There you can define the category this
trigger fits in best. You can choose from a set of predefined categories such as "Page view", "Click", and "User Engagements", or create your own category:

```php
public function getCategory()
{
    return self::CATEGORY_OTHERS;
}
```

In this example, we are using a pre-defined category "Others". To use a custom category, simply return the name of the category you want to choose:

```php
public function getCategory()
{
    return 'Network';
}
```

### Showing an icon for your trigger

You may optionally show an icon for your trigger. All you need to do is to return a path to the icon file in the method `getIcon()` like this:

```php
public function getIcon()
{
    return 'plugins/TagManager/images/MyIcon.png';
}
```

We recommend you put the image in the `images` folder of your plugin. The file itself may be for example a `jpg`, `png`,
or `svg` file with a size of ideally 64x64 pixels.

### Specifying parameters

In our case we want to let the user configure which events should be triggered. To do this, we can configure parameters.
Parameters have the same API as [Plugin settings](/guides/plugin-settings).

Here is an example on how to define a parameter which you can later access in the JavaScript part using `parameters.get('listenEvent')`.

```php
public function getParameters()
{
    return array(
        $this->makeSetting('listenEvent', 'all', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
            $field->title = 'Trigger when network status changes to';
            $field->uiControl = FieldConfig::UI_CONTROL_SELECT;
            $field->availableValues = array(
                'all' => 'Online or Offline',
                'online' => 'Online',
                'offline' => 'Offline',
            );
        }),
    );
}
```

Learn more about specifying parameters in our dedicated [Tag Manager - Parameters](/guides/tagmanager/parameters) guide.

### The JavaScript Part

Now we get to develop the JS part which will trigger an event as soon as the online status changes. This
is done in the file `OnlineChangeTrigger.web.js`. The basic structure looks like this:

```js
(function () {
    return function (parameters, TagManager) {

        this.setUp = function (triggerEvent) {
            // accessing a parameter
            var listenEvent = parameters.get('listenEvent');

            // ...
            // triggerEvent({event: '$MyPlugin.$eventName', 'OptionallyOtherVariables': 'variable value'});
            // ...
        };
    };
})();
```

The implemented trigger example could look like this:

```js
(function () {
    return function (parameters, TagManager) {

        this.setUp = function (triggerEvent) {
            var listenEvent = parameters.get('listenEvent');

            if (listenEvent === 'all' || listenEvent === 'offline') {
                TagManager.dom.addEventListener(parameters.window, 'offline', function (event) {
                    triggerEvent({event: 'MyPlugin.OnlineStatusChange', 'MyPlugin.OnlineStatus': 'offline'});
                });
            }

            if (listenEvent === 'all' || listenEvent === 'online') {
                TagManager.dom.addEventListener(parameters.window, 'online', function (event) {
                    triggerEvent({event: 'MyPlugin.OnlineStatusChange', 'MyPlugin.OnlineStatus': 'online'});
                });
            }
        };
    };
})();
```

In the above example, we define an anonymous JavaScript class which implements a method `setUp`. This method is executed as soon as the tag manager is being loaded. You can access any parameter you have defined using `parameters.get('$parameterName', optionalDefaultValueIfNoneConfigured)`. You may also notice that we use `TagManager.dom.addEventListener` instead of `window.addEventListener`. The reason is that `TagManager.dom.addEventListener` will work cross browser.

To trigger an event, simply call the method `triggerEvent(dataLayerObject)`. The `dataLayerObject` should typically contain a descriptive `event` property prefixed with your plugin name (for example `MyPlugin.OnlineStatusChange`), and optionally multiple properties that describes this event so it is possible to access these properties through the data layer.

Through the `parameters` variable you may access some special properties like `document` and `window`. For example
`parameters.document` or `parameters.window`. The access of `parameters.document` over `document` directly is recommended as it makes unit testing easier. You can find more information in the [TemplateParameters](/api-reference/tagmanager/javascript-api-reference) API reference.

You can also access the `TagManager` instance which provides a lot of helper utilities around the DOM, window, URLs, events, data layer, and much more. You can find more information about this in the [TagManager](/api-reference/tagmanager/javascript-api-reference#tagmanager) API reference.

## Advanced: Pre-configured Variable

As you may have noticed, we have specified a property `MyPlugin.OnlineStatus` in the triggered event. You may want to create a pre-configured variable for this so users can use this variable as a trigger condition (filter). This would even make the parameter `listenEvent` in the above example obsolete as they would be able to restrict the trigger through a condition to listen for example only to the `online` status.

To generate a pre-configured variable, execute the following command:

```bash
$ ./console generate:tagmanager-datalayer-variable
```

If you enter the variable name `Online Status`, a file named `plugins/$yourPlugin/Template/Variable/PreConfigured/OnlineStatusVariable.php` will be created.

### Configuring the category

You may notice that configuring the name, description, category, etc works the same way as for a trigger or a regular variable.

As a category, we recommend setting the name of the trigger to group all pre-configured variables for that trigger into one category:

```php
public function getCategory()
{
    return 'Online';
}
```

### Variable definition

To implement the variable, we have to return the name of the data layer property in the method `getDataLayerVariableName`. We could have created a file `plugins/$yourPlugin/Template/Variable/PreConfigured/OnlineStatusVariable.web.js` instead, but as this kind of variable is created quite often, we have created this shortcut for it:

```php
protected function getDataLayerVariableName()
{
    return 'MyPlugin.OnlineStatus';
}
```

This will automatically create a method for this variable which will return the value of `MyPlugin.OnlineStatus` from
the data layer.

When you reload, the newly created variable will be available to be selected as a condition in the trigger, and can
also be used in other places where a variable can be selected.

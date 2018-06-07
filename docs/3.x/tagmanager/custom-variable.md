---
category: Develop
---
# Variables

A variable in the context of a tag manager is a snippet of code which lets you retrieve data to use it by tags and triggers.

Matomo lets you easily create a new variable. When you create a new variable, please consider contributing this new variable to the [official Tag Manager plugin](https://github.com/matomo-org/tag-manager) by creating a pull request.

<div markdown="1" class="alert alert-info">
Tags, triggers, and variables are all implemented in the same way except for a minor difference in the JavaScript part. Once you know how to develop a variable, you will also be able to develop a tag and a trigger.
</div>

## Adding a new variable

We're going to create a new variable that returns a value from the [localStorage](https://html.spec.whatwg.org/multipage/webstorage.html#dom-localstorage).

To create a new variable, you should use the CLI tool and execute the following command:

```bash
$ ./console generate:tagmanager-variable
```

This command will guide you through the creation of a variable and ask for several things such as the name of your plugin and the name of the variable you want to create. When it asks you for a variable name, enter "Local Storage". The command will create these files:

* `plugins/$yourplugin/Template/Variable/LocalStorageVariable.php` lets you define for example the category of the variable and define parameters.
* `plugins/$yourplugin/Template/Variable/LocalStorageVariable.web.js` lets you implement the JavaScript logic to return the value of the local storage.

### Adding a pre-configured variable

A pre-configured variable is a special kind of variable that requires no configuration and can be used by a user straight away. The creation of a pre-configured variable works the same way, except the initial command you need to execute is different:

```bash
$ ./console generate:tagmanager-preconfigured-variable
```

### Defining the name, description, and help of your variable

When you generate a variable, the generator will automatically create some [translation keys](/guides/translations) in your `plugin/$yourplugin/lang/en.json` file.
You may want to adjust the translations for the created keys:

```json
"LocalStorageVariableName": "Local Storage",
"LocalStorageVariableDescription": "This is the description for Local Storage",
"LocalStorageVariableHelp": ""
```

Alternatively, you can also set the name, description, and the optional help text in your `LocalStorageVariable.php` but it is recommended to use translation keys so other developers can translate it into different languages.

The description should be ideally kept quite short. A help text is usually not needed for variables.

### Configuring the variable category

In the generated `LocalStorageVariable.php`, you will find a method named `getCategory()`. There you can define the category this variable fits in best. You can choose from a set of predefined categories such as "Page Variables", "Date", "Performance", "SEO", and "Device", or create your own category:

```php
public function getCategory()
{
    return self::CATEGORY_PAGE_VARIABLES;
}
```

In this example, we are using a pre-defined category "Page Variables". To use a custom category, simply return the name of the category you want to choose:

```php
public function getCategory()
{
    return 'My Category';
}
```

### Showing an icon for your variable

You may optionally show an icon for your variable. All you need to do is to return a path to the icon file in the method `getIcon()` like this:

```php
public function getIcon()
{
    return 'plugins/TagManager/images/MyIcon.png';
}
```

We recommend you put the image in the `images` folder of your plugin. The file itself may be for example a `jpg`, `png`,
or `svg` file with a size of ideally 64x64 pixels.

### Specifying parameters

In our case we want to let the user configure the name of the item that should be returned by this variable. To do this, we can configure parameters. Parameters have the same API as [Plugin settings](/guides/plugin-settings).

Here is an example on how to define a parameter which you can later access in the JavaScript part using `parameters.get('itemName')`.

```php
public function getParameters()
{
    return array(
        $this->makeSetting('itemName', 'This is the default value', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
            $field->title = 'Item name';
            $field->uiControl = FieldConfig::UI_CONTROL_TEXTAREA;
            $field->description = 'Please enter the name of the local storage item you want to access.';
            $field->validators[] = new CharacterLength($min = 1, $max = 300);
        }),
    );
}
```

Learn more about specifying parameters in our dedicated [Tag Manager - Parameters](/guides/tagmanager/parameters) guide.

### The JavaScript Part

Now we get to develop the JS part which will return the value from the local storage. This
is done in the file `LocalStorageVariable.web.js`. The basic structure looks like this:

```js
(function () {
    return function (parameters, TagManager) {

        this.get = function () {
            // accessing a parameter
            var itemName = parameters.get('itemName');

            // return variable value
        };
    };
})();
```

The implemented variable example could look like this:

```js
(function () {
    return function (parameters, TagManager) {

        this.get = function () {
            var itemName = parameters.get('itemName');
            if (itemName && localStorage) {
                return localStorage.getItem(itemName);
            }
        };
    };
})();
```

In the above example, we define an anonymous JavaScript class which implements the `get` method. This method is executed every time the value of the variable is requested. You can access any parameter you have defined using `parameters.get('$parameterName', optionalDefaultValueIfNoneConfigured)`.

You can also access some special variables like the `document` and `window` through the `parameters` object. For example
`parameters.document` or `parameters.window`. The access of `parameters.document` over `document` directly is recommended as it makes unit testing easier. You can find more information in the [TemplateParameters](/api-reference/tagmanager/javascript-api-reference) API reference.

You can also access the `TagManager` instance which provides a lot of helper utilities around the DOM, window, URLs, events, data layer, and much more. You can find more information about this in the [TagManager](/api-reference/tagmanager/javascript-api-reference#tagmanager) API reference.
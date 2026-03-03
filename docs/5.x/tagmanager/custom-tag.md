---
category: Develop
---
# Tags

A tag in the context of a tag manager is a snippet of code which can be executed on your site. Most of the time, a tag may be used to either send data to a third-party (for example tracking data) or to embed content from a third-party into your website (for example social widgets or surveys).

Matomo lets you easily create a new tag. When you create a new tag, please consider contributing this new tag to the [official Tag Manager plugin](https://github.com/matomo-org/tag-manager) by creating a pull request.

<div markdown="1" class="alert alert-info">
Tags, triggers, and variables are all implemented in the same way except for a minor difference in the JavaScript part. Once you know how to develop a tag, you will also be able to develop a trigger and a variable.
</div>

## Adding a new tag

We're going to create a new tag that shows a popup with a custom message on a page.

To create a new tag, you should use the CLI tool and execute the following command:

```bash
$ ./console generate:tagmanager-tag 
```

This command will guide you through the creation of a tag and ask for several things such as the name of your plugin and the name of the tag you want to create. When it asks you for a tag name, enter "Popup". The command creates these files:

* `plugins/$yourplugin/Template/Tag/PopupTag.php` lets you define for example the category of the tag and define parameters.
* `plugins/$yourplugin/Template/Tag/PopupTag.web.js` lets you implement the JavaScript logic to show the popup when the tag is fired.

### Defining the name, description, and help of your tag

When you generate a tag, the generator will automatically create some [translation keys](/guides/translations) in your `plugin/$yourplugin/lang/en.json` file.
You may want to adjust the translations for the created keys:

```json
"PopupTagName": "Popup",
"PopupTagDescription": "This is the description for Popup",
"PopupTagHelp": ""
```

Alternatively, you can also set the name, description, and the optional help text in your `PopupTag.php` but it is recommended
to use translation keys so other developers can translate it into different languages.

The description should be ideally kept quite short and in one sentence. A help text is usually not needed, but may be useful if you want to describe the tag in more detail or want to give users further instructions on what the tag actually does.

### Configuring the tag category

In the generated `PopupTag.php`, you will find a method named `getCategory()`. There you can define the category this
tag fits in best. You can choose from a set of predefined categories such as "Ads", "Affiliates", "Email", "Social", and "Analytics", or create your own category:

```php
public function getCategory()
{
    return self::CATEGORY_ANALYTICS;
}
```

In this example, we are using a pre-defined category "Analytics". To use a custom category, simply return the name of the category you want to choose:

```php
public function getCategory()
{
    return 'My Category';
}
```

### Showing an icon for your tag

You may optionally show an icon for your tag. All you need to do is to return a path to the icon file in the method `getIcon()` like this:

```php
public function getIcon()
{
    return 'plugins/TagManager/images/MyIcon.png';
}
```

We recommend you put the image in the `images` folder of your plugin. The file itself may be for example a `jpg`, `png`,
or `svg` file with a size of ideally 64x64 pixels.

### Specifying parameters

In our case we want to let the user configure the text that will be shown in the popup. To do this, we can configure parameters.
Parameters have the same API as [Plugin settings](/guides/plugin-settings).

Here is an example on how to define a parameter which you can later access in the JavaScript part using `parameters.get('popupText')`.

```php
public function getParameters()
{
    return array(
        $this->makeSetting('popupText', 'This is the default value', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
            $field->title = 'Popup Text';
            $field->uiControl = FieldConfig::UI_CONTROL_TEXTAREA;
            $field->description = 'Please Enter the text';
            $field->validators[] = new CharacterLength($min = 1, $max = 300);
        }),
    );
}
```

Learn more about specifying parameters in our dedicated [Tag Manager - Parameters](/guides/tagmanager/parameters) guide.

### The JavaScript Part

Now we get to develop the JS part which will show the popup in the bottom of the website as soon as the tag is fired. This
is done in the file `PopupTag.web.js`. The basic structure looks like this:

```js
(function () {
    return function (parameters, TagManager) {
        this.fire = function () {
            // accessing a parameter
            var popupText = parameters.get('popupText');

            // tag implementation
            // ...
        };
    };
})();
```

The implemented popup example could look like this:

```js
(function () {
    return function (parameters, TagManager) {
        this.fire = function () {
            var popupText = parameters.get('popupText');
            if (popupText) {
                var div = parameters.document.createElement('div');
                div.setAttribute('style', 'position: fixed;bottom: 10px;padding: 10px;background: #f00;left: 10px;color: #fff;');
                div.innerText = popupText;
                parameters.document.body.appendChild(div);
            }
        };
    };
})();
```

In the above example, we define an anonymous JavaScript class which implements a method `fire`. This method is executed as soon as the tag is fired. You can access any parameter you have defined using `parameters.get('$parameterName', optionalDefaultValueIfNoneConfigured)`.

You can also access some special variables like the `document` and `window` through the `parameters` object. For example
`parameters.document` or `parameters.window`. The access of `parameters.document` over `document` directly is recommended as it makes unit testing easier. You can find more information in the [TemplateParameters](/api-reference/tagmanager/javascript-api-reference) API reference.

You can also access the `TagManager` instance which provides a lot of helper utilities around the DOM, window, URLs, events, data layer, and much more. You can find more information about this in the [TagManager](/api-reference/tagmanager/javascript-api-reference#tagmanager) API reference.

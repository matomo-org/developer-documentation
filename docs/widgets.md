---
category: Develop
---
# Widgets

Widgets can be added to your dashboards or exported via a URL to embed it on any page. Most widgets in Piwik represent a report but a widget can display anything, for example a RSS feed of your corporate news.

## Creating a widget

To add a widget in your plugin, use the console:

```bash
$ ./console generate:widget
```

The command will ask for your plugin name and for a widget category. You can select any existing category, for example "Visitors", "Live!" or "Actions", but you can also give a new category (for example your company name). The command will create a `Widgets` class in `plugins/MyPlugin/Widgets.php`.

The widget category should be set in the `$category` property:

```php
    protected $category = 'ExampleCompany';
```

The `init()` method lets you add as many widgets as you want:

```php
    protected function init()
    {
        $this->addWidget('My widget name', $method = 'myExampleWidget');
    }
```

The widget defined above will be rendered by calling the `myExampleWidget()` method on the class. This method could look like this:

```php
    public function myExampleWidget()
    {
        return 'Hello world!';
    }
```

As you can see, **just like in controllers**, the widget method should return a string. That string can be constructed manually or using Twig views.

To render a Twig template, have a look how it's done in [Pages](/guides/pages).

### Permissions

If a widget should not be visible by everyone, you can check for permissions to restrict its access.

To do this, you can use all the methods starting with `\Piwik\Piwik::checkUser*`, for example:

```php
    public function myExampleWidget()
    {
        // Make sure the current user has super user access
        \Piwik\Piwik::checkUserHasSuperUserAccess();

        // Make sure the current user is logged in and not anonymous
        \Piwik\Piwik::checkUserIsNotAnonymous();

        return 'Hello world!';
    }
```

### Reusing a controller method

When adding a widget, you can give a method of the `Widgets` class but also a method of the `Controller` class, for example:

```php
$this->addWidget('My widget name', 'showSomething');
```

Here `showSomething` could be a method of your plugin's controller.

## What's next?

You can read the [Widgets API reference](/api-reference/Piwik/Plugin/Widgets) to learn everything that is possible with widgets.

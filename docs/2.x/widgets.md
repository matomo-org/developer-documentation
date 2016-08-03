---
category: Develop
---
# Widgets

All widgets can be added to your dashboards or exported via a URL to embed it on any page. Most widgets in Piwik
represent a report but a widget can display anything, for example a RSS feed of your corporate news. You can also use
widgets to add new content to an existing page in the reporting menu or to add a new menu item to the reporting menu.

## Creating a widget

To add a widget in your plugin, use the console:

```
$ ./console generate:widget
```

The command will ask for your plugin name, for a widget category and for the name of the widget you want to create.
You can select any existing category, for example "Visitors", "Live!" or "Actions", but you can also define a new category
(for example your company name). The command will create a file in the `plugins/MyPlugin/Widgets/` directory,
for example MyExampleWidget.php`.

```php
class MyExampleWidget extends Widget
{
     /**
      * @var Translator
      */
     private $translator;

     public function __construct(Translator $translator)
     {
         $this->translator = $translator;
     }

    public static function configure(WidgetConfig $config)
    {
        $config->setCategoryId('About Piwik');
        $config->setName('My Example Widget');
        $config->setOrder(5);
    }

    public function render()
    {
        $view = new View('@CoreHome/getDonateForm');
        $view->footerMessage = $this->translator->translate('CoreHome_OnlyForSuperUserAccess');
        return $view->render();
    }
}
```

### The constructor

In the constructor you can request any dependencies such as a translator or any other class.

### Configuration

The widget can be configured in the `configure` method. The method is `static` because the Piwik platform would otherwise
need to resolve all dependencies defined in the constructor for all widgets just to get a list of all existing widget
names etc. For a list of all options have a look at the The [WidgetConfig class reference](/api-reference/Piwik/Widget/WidgetConfig).

### Rendering the widget

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

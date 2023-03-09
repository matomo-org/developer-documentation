---
category: Develop
---
# Widgets

All widgets can be added to your dashboards or exported via a URL to embed it on any page. Most widgets in Piwik
represent a report but a widget can display anything, for example an RSS feed of your corporate news. You can also use
widgets to add new content to an existing report page and to create new report pages.

## Creating a widget

To add a widget in your plugin, use the console:

```
$ ./console generate:widget
```

The command will ask for your plugin name, a widget category and the name of the widget you want to create.
You can select any existing category such as "Visitors", "Live!" or "Actions", but you can also define a new category
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
        // will render template "plugins/MyPlugin/templates/getDonateForm.twig"
        return $this->renderTemplate('getDonateForm', array(
            'footerMessage' => $this->translator->translate('CoreHome_OnlyForSuperUserAccess')
        ));
    }
}
```

### The constructor

In the constructor you can request any dependencies such as a translator or any other class.

### Configuration

The widget can be configured in the `configure` method. The method is `static` because the Piwik platform would otherwise
need to resolve all dependencies defined in the constructor for all widgets just to get a list of all existing widget
names etc. For a list of all options have a look at the [WidgetConfig class reference](/api-reference/Piwik/Widget/WidgetConfig).

### Rendering the widget

The widget defined above will be rendered by calling the `render()` method on the class. This method could look like as simple as this:

```php
public function render()
{
    return 'Hello world!';
}
```

As you can see, **just like in controllers**, the `render` method should return a string.
Often the rendering will be a bit more complex and a [Twig View](https://twig.symfony.com) can be used to render the actual content,
see the example above. Template files need to be put into a `templates` directory within your plugin. To render a Twig template,
have a look how it's done in [Pages](/guides/pages).

### Permissions

If a widget should not be visible by everyone, you can check for permissions to restrict its access.

To do this, you can use all the methods starting with `\Piwik\Piwik::checkUser*`, `\Piwik\Piwik::hasUser*` and
`\Piwik\Piwik::isUser*`, for example:

```php
public static function configure(WidgetConfig $config)
{
    // only show widget if current user has super user access
    $config->setIsEnabled(\Piwik\Piwik::hasUserSuperUserAccess());
    // or $config->disable();
}

public function render()
{
    // it is not needed to check for permissions here again
    return 'Hello world!';
}
```

## Adding content to an existing reporting page

If you want to add your widget's content to an existing page in the reporting menu, all you need to do is to define
 the correct `category` and `subcategory`. As soon as a category and a subcategory is configured, the platform
 will either create a new menu item in the reporting menu or reuse an existing menu item. Say you wanted to add another
 widget to the existing "Visitors => Software" page, then you can do this as follows:

```php
public static function configure(WidgetConfig $config)
{
    $config->setCategoryId('General_Visitors');
    $config->setSubcategoryId('DevicesDetection_Software');
    $config->setOrder(10);
}
```

The order will define at which position of the page the widget will be shown. The lower the number, the higher up in the
page the widget will be visible.

### Identifying the right category and subcategory

Category and subcategory IDs are usually translation keys like `General_Visitors` and not the actual translation
("Visitors") because Piwik is available in many different languages. The best way to find the correct IDs is to
 navigate to the page you want to extend in the browser, and then look for a URL parameter `category` and `subcategory`.


## Creating a new page in the reporting menu

Creating a new page in the reporting menu works the same way as adding content to an existing reporting page. All you
need to do is to specify your own unique subcategory and / or category. If it makes sense, try to reuse one of the
existing main menu items such as "Visitors", "Actions" or "Referrers". However, sometimes you want to define a whole
new main menu category like this:


```php
public static function configure(WidgetConfig $config)
{
    $config->setCategoryId('Campaigns');
    // this will be a new menu category in the reporting menu
    $config->setSubcategoryId('AdWords');
    // this will be a submenu item of the 'Campaigns' menu
}
```

Now other plugins can enrich the "Campaigns" menu category, they can enrich your "Adwords" page, and you can define
yourself more widgets to add either more menu items and pages under "Campaigns" or more content under "Adwords".

## Removing the ability to add the widget to the dashboard or to export it

In some rare cases you might want to add content to a reporting page but not want users to export the widget as an iframe
and neither want them to add the content of this widget to a dashboard. A use case is for example a widget that lets you
manage something. The widget to "Manage Goals" should be available in the reporting menu but it should not be
 possible to add it to a dashboard. For example the widget might not work in such a context or it doesn't make much sense
  to the author. You can do this as follows:

```php
public static function configure(WidgetConfig $config)
{
    $config->setIsNotWidgetizable();
}
```

### Removing widgets and content from reporting pages.

By listening to the [Widget.filterWidgets event](/api-reference/events#widgetfilterwidgets) you can remove or change
existing widgets. If you haven't worked with events before, read the [Events guide](/guides/events). For example,
you can remove all widgets having the category `General_Actions` in the event callback like this:

```php
public function removeWidgetConfigs(Piwik\Widget\WidgetsList $list)
{
    $list->remove($category='General_Actions'); // remove all widgets having this category
    $list->remove($category='General_Actions', 'Actions_Pages'); // remove all widgets having this category and widget name
}
```

This allows you for example to create plugins that restrict access (ACL) to certain widgets / reports.

## What's next?

You can read the [Widgets API reference](/api-reference/Piwik/Widget/Widget) and [WidgetConfig API reference](/api-reference/Piwik/Widget/WidgetConfig) to learn everything that is possible with widgets.

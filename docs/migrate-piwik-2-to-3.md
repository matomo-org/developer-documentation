---
category: Develop
---
# Migrate Plugin from Piwik 2.X to Piwik 3


## Events

If your plugin is listening to events you should rename the method `getListHooksRegistered` to `registerEvents`

## Updates

If your plugin defines SQL updates like this:

```php
public function getMigrationQueries(Updater $updater)
{
    return array(
        // ignore existing column name error (1060)
        'ALTER TABLE ' . Common::prefixTable('custom_dimensions')
        . " ADD COLUMN case_sensitive TINYINT UNSIGNED NOT NULL DEFAULT 1 AFTER extractions" => 1060,
    );
}

public function doUpdate(Updater $updater)
{
    $updater->executeMigrationQueries(__FILE__, $this->getMigrationQueries($updater));
}
```

You should convert them to:

```php
use Piwik\Updater\Migration\Factory as MigrationFactory;

/**
 * @var MigrationFactory
 */
private $migration;

public function __construct(MigrationFactory $factory)
{
    $this->migration = $factory;
}

public function getMigrations(Updater $updater)
{
    return array(
        $this->migration->db->addColumn('custom_dimensions', 'case_sensitive', 'INYINT UNSIGNED NOT NULL DEFAULT 1', 'extractions')
    );
}

public function doUpdate(Updater $updater)
{
    $updater->executeMigrations(__FILE__, $this->getMigrations($updater));
}
```

[Learn more about the new database updates API.](/guides/extending-database#defining-database-updates)

## Plugin Settings

* System Settings and User Settings used to be defined in one `PluginSettings` class. We have splitted this into two new classes
 and to convert existing plugin settings we recommend to first generate new settings for different types, eg


```bash
$ ./console generate:settings --settingstype=system
$ ./console generate:settings --settingstype=user
```

Then it's time to convert each setting from this:

```php
$this->autoRefresh = new UserSetting('autoRefresh', 'Auto refresh');
$this->autoRefresh->type  = static::TYPE_BOOL;
$this->autoRefresh->uiControlType = static::CONTROL_CHECKBOX;
$this->autoRefresh->description   = 'If enabled, the value will be automatically refreshed depending on the specified interval';
$this->autoRefresh->defaultValue  = false;

$this->addSetting($this->autoRefresh);
```

to this:

```php
$defaultValue = false;
$phpType = FieldConfig::TYPE_BOOL;

$this->autoRefresh = $this->makeSetting('autoRefresh', $defaultValue, $phpType, function (FieldConfig $field) {
    $field->title = 'Auto refresh';
    $field->uiControl = FieldConfig::UI_CONTROL_CHECKBOX;
    $field->description = 'If enabled, the value will be automatically refreshed depending on the specified interval';
});
```

As you can see the API hasn't changed too much. [Learn more about the new plugin settings API.](/guides/plugin-settings)

## Reports

First you should rename the property `$category` to `$categoryId`. If you have defined a widget or if you have added your
report to a reporting page you need to follow the next steps:

### Creating a widget

In the past it was possible to create a widget like this:

```php
$this->widgetTitle = 'Live_RealTimeVisitorCount';
$this->widgetParameters = array();
```

Now a widget is configured in a separate method like this:

```php
public function configureWidgets(WidgetsList $widgetsList, ReportWidgetFactory $factory)
{
    $widget = $factory->createWidget();
    $widgetsList->addWidgetConfig($widget);
}
```

The advantage is that you now can create many widgets for just one report and change the widget in any way you want
by calling one of the [ReportWidgetConfig's](/api-reference/Piwik/Report/ReportWidgetConfig) methods.

### Making a page visible in the reporting menu

In the past all you needed to do was to define a `$menuTitle` property. This got a bit more complex. First you need to
define a widget as explained in the previous step. Then you need to remove the `$menuTitle` property and add a new property
`$subcategoryId`. The subcategory is the name of the page the report should be added to. This allows you to now add any
report any existing reporting page or to create a new reporting page by defining a new subcategoryId that has not been
used by any other page yet.

[Learn more about the new API in the Reports guide.](/guides/custom-reports#making-it-a-widget).

## Widgets

All plugin's widgets used to be define in just one class. This had it's limitation and a couple of drawbacks just as having
to require dependencies for all widgets even when just one widget was executed and the list of dependencies got quite long sometimes.
Also sometimes many different widgets were created in one file and it wasn't really clean. Now each widget is defined in it's
own file and can be configured in several ways.

We recommend to first create a new Widget via the console:

```bash
$ ./console generate:widget
```

In the next step it's time to migrate this structure:

```php
protected $category = 'ExampleCompany';
protected function init()
{
    $this->addWidget('My widget name', $method = 'myExampleWidget');
}
public function myExampleWidget()
{
    return 'Hello world!';
}
```

to the new structure which is defined like this:

```php
class MyExampleWidget extends Widget
{
    public static function configure(WidgetConfig $config)
    {
        $config->setCategoryId('ExampleCompany');
        $config->setName('My widget name');
        $config->setOrder(99);
    }

    public function render()
    {
        return 'Hello world!';
    }
}
```

As you might see the method to render the widget is now always called `render` and it used to be the name specified
when creating the widget. The configuration is now done in a static configure method that let's you eg configure the
category, the name, the order of the widget and more. [Learn more about the new API in the Widgets guide.](/guides/widgets).

## User menu

The user menu has been removed and such links should be now defined in the Admin menu. To do this move the code from
 the method `configureUserMenu(MenuUser $menu)` in your `Menu.php` plugin file to the method `configureAdminMenu(MenuAdmin $menu)`.

 Next you should update the related Twig template file (if there is any) and replace `{% extends 'user.twig' %}`
 with `{% extends 'admin.twig' %}`.
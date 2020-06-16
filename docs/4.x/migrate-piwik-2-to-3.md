---
category: Develop
---
# Migrate Plugin from Piwik 2.X to Matomo 3 (Piwik 3)

This migration guide covers explains how to do some migrations to make a plugin compatible with Piwik 3. A list of
all changes in Piwik 3 can be found in the [Changelog](/changelog#piwik-300).

## Making your plugin compatible with Piwik 3

After you test your Piwik plugin on Piwik 3, there are a few possible cases:

* your plugin works for both Piwik 2 and Piwik 3 at the same time,
* or: your plugin does not work for Piwik 3 yet,
* or: your plugin only works for Piwik 3.

### if your plugin is compatible with Piwik 2 and Piwik 3...

If you have a plugin that is compatible with both Piwik 2 and 3 we recommend specifying this explicitly in your `plugin.json`
as we otherwise assume your plugin will only be compatible with Piwik 2. In the `plugin.json`, change this:

```json
   "require": {
        "piwik": ">=2.16.0"
    },
```

to:

```json
   "require": {
        "piwik": ">=2.16.0,<4.0.0-b1"
    },
```

### if your plugin is not compatible with Piwik 3 yet...

If your plugin is not compatible with Piwik 3 yet, we recommend releasing one more version for your current plugin which specifically tells the Marketplace the plugin is
 not compatible with Piwik 3. The `plugin.json` would look like this:

```json
   "require": {
        "piwik": ">=2.16.0,<3.0.0-b1"
    },
```

The next step is for you to make your plugin compatible with Piwik 3: this guide will help you locate the changes to make to your plugin.


### once your plugin is compatible with Piwik 3, release a new major version of your plugin

Once your plugin is compatible with Piwik 3:

* specify that your plugin requires Piwik 3.
* we recommend to also increase your plugin's major version number eg from `1.2.3` to `2.0.0`.

The `plugin.json` would look like this:

```json
   "version": "2.0.0",
   "require": {
        "piwik": ">=3.0.0-b1,<4.0.0-b1"
    },
```

It is still possible to release updates for the branch that is compatible with Piwik 2.

## Marketplace

### Your plugin's Changelog

In the past the changelog used to be defined in the `README.md` file by specifying a `## Changelog` headline. This is now deprecated, and we recommend maintaining the changelog in a `CHANGELOG`, `CHANGELOG.txt` or `CHANGELOG.md` file instead.

### Your plugin's FAQ

The same applies to the FAQ which used to be defined in a `## FAQ` section within the readme and should now be specified in a `docs/faq.md` file.


### Your plugin's Support options

The support tab is no longer managed in the readme file either. Instead, the support tab on your plugin page is now generated from the ["support" section in your plugin.json](https://developer.piwik.org/guides/distributing-your-plugin#pluginjson-file).


### Your plugin's license

The Marketplace now also supports to show a license text if a `LICENSE`, `LICENSE.txt` or `LICENSE.md` is specified in the root directory of your plugin and it is possible to show documentation for your plugin by specifying a `docs/index.md` file.


## Events

If your plugin is listening to events you should rename the method `getListHooksRegistered` to `registerEvents`

## Updates and SQL schema migrations

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

If your plugin creates a custom [Report](https://developer.piwik.org/guides/custom-reports), you should rename the property `$category` to `$categoryId`.
(In your code, replace `$this->category` by `$this->categoryId`).

If you have defined a widget or if you have added your report to a reporting page you need to follow the next steps:

### Creating a widget

In the past it was possible to [create a widget](https://developer.piwik.org/guides/widgets) like this:

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
`$subcategoryId`. The subcategory is the name of the page the report should be added to. This allows you to either add any
report to any existing reporting page, or to create a new reporting page by defining a new subcategoryId that has not been
used by any other page yet.

[Learn more about the new API in the Reports guide.](/guides/custom-reports#making-it-a-widget).

## Widgets

All of a plugin's widgets used to be defined in just one class. This simple architecture had a couple of drawbacks such as having
to require dependencies for all widgets even when just one widget was executed (the list of dependencies got quite long sometimes).
Also sometimes many different widgets were created in one class and it wasn't really clean. Now each widget is defined in its
own file and can be configured in several ways.

We recommend to first create a new Widget via the console:

```bash
$ ./console generate:widget
```

In the next step it's time to migrate this old Piwik 2 widget structure:

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
when creating the widget. The configuration is now done in a static configure method that lets you eg configure the
category, the name, the order of the widget and more. [Learn more about the new API in the Widgets guide.](/guides/widgets).

## User menu

The user menu has been removed and such links should be now defined in the Admin menu. To do this, in your `Menu.php` plugin file,  move the code from the method `configureUserMenu(MenuUser $menu)`  to the method `configureAdminMenu(MenuAdmin $menu)`.

Next you should update the related Twig template file (if there is any) and replace `{% extends 'user.twig' %}` with `{% extends 'admin.twig' %}`.

## Summary

In this guide we have seen which steps to take to migrate your Piwik plugin to be compatible with our newest Piwik 3.
If you need further help for converting your plugin to Piwik 3, head over to the [Piwik developers community forums](https://forum.piwik.org/c/plugins-platform).

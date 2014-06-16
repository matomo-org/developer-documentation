<small>Piwik\Menu\</small>

MenuReporting
=============

Contains menu entries for the Reporting menu (the menu displayed under the Piwik logo).

Plugins can implement the `configureReportingMenu()` method of the `Menu` plugin class to add, rename of remove
items. If your plugin does not have a `Menu` class yet you can create one using `./console generate:menu`.

**Example**

    public function configureReportingMenu(MenuReporting $menu)
    {
        $menu->add(
            'MyPlugin_MyTranslatedMenuCategory',
            'MyPlugin_MyTranslatedMenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            Piwik::isUserHasSomeAdminAccess(),
            $order = 2
        );
    }

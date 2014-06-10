<small>Piwik\Menu\</small>

MenuAdmin
=========

Contains menu entries for the Admin menu.

Plugins can implement the `configureAdminMenu()` method of the `Menu` plugin class to add, rename of remove
items. If your plugin does not have a `Menu` class yet you can create one using `./console generate:menu`.

**Example**

    public function configureAdminMenu(MenuAdmin $menu)
    {
        $menu->add(
            'MyPlugin_MyTranslatedAdminMenuCategory',
            'MyPlugin_MyTranslatedAdminPageName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            Piwik::isUserHasSomeAdminAccess(),
            $order = 2
        );
    }

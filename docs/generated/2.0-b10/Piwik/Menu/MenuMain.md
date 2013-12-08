<small>Piwik\Menu\</small>

MenuMain
========

Contains menu entries for the Main menu (the menu displayed under the Piwik logo).

Plugins can subscribe to the [Menu.Reporting.addItems](#) event to add new pages to
the main menu.

**Example**

    // add a new page in an observer to Menu.Admin.addItems
    public function addMainMenuItem()
    {
        MenuMain::getInstance()->add(
            'MyPlugin_MyTranslatedMenuCategory',
            'MyPlugin_MyTranslatedMenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            Piwik::isUserHasSomeAdminAccess(),
            $order = 2
        );
    }

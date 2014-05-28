<small>Piwik\Menu\</small>

MenuAdmin
=========

Contains menu entries for the Admin menu.

Plugins can subscribe to the 
[Menu.Admin.addItems](/api-reference/hooks#menuadminadditems) event to add new pages to the admin menu.

**Example**

    // add a new page in an observer to Menu.Admin.addItems
    public function addAdminMenuItem()
    {
        MenuAdmin::getInstance()->add(
            'MyPlugin_MyTranslatedAdminMenuCategory',
            'MyPlugin_MyTranslatedAdminPageName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            Piwik::isUserHasSomeAdminAccess(),
            $order = 2
        );
    }

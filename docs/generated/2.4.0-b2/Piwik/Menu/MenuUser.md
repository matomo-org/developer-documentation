<small>Piwik\Menu\</small>

MenuUser
========

Contains menu entries for the User menu (the menu at the very top of the page).

Plugins can subscribe to the [Menu.User.addItems](/api-reference/hooks#menuuseradditems) event to add new pages to
the user menu.

**Example**

    // add a new page in an observer to Menu.User.addItems
    public function addUserMenuItem()
    {
        MenuUser::getInstance()->add(
            'MyPlugin_MyTranslatedMenuCategory',
            'MyPlugin_MyTranslatedMenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            Piwik::isUserHasSomeAdminAccess(),
            $order = 2
        );
    }

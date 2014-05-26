<small>Piwik\Menu\</small>

MenuReporting
=============

Contains menu entries for the Reporting menu (the menu displayed under the Piwik logo).

Plugins can subscribe to the [Menu.Reporting.addItems](/api-reference/hooks#menureportingadditems) event to add new pages to
the reporting menu.

**Example**

    // add a new page in an observer to Menu.Admin.addItems
    public function addReportingMenuItem()
    {
        MenuReporting::getInstance()->add(
            'MyPlugin_MyTranslatedMenuCategory',
            'MyPlugin_MyTranslatedMenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            Piwik::isUserHasSomeAdminAccess(),
            $order = 2
        );
    }

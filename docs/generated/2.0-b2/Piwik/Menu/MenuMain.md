<small>Piwik\Menu</small>

MenuMain
========

Contains menu entries for the Main menu (the menu displayed under the Piwik logo).

Description
-----------

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


Methods
-------

The class defines the following methods:

- [`isUrlFound()`](#isUrlFound) &mdash; Returns if the URL was found in the menu.
- [`getMenu()`](#getMenu) &mdash; Triggers the Menu.Reporting.addItems hook and returns the menu.

<a name="isurlfound" id="isurlfound"></a>
### `isUrlFound()`

Returns if the URL was found in the menu.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$url`
- It returns a(n) `boolean` value.

<a name="getmenu" id="getmenu"></a>
### `getMenu()`

Triggers the Menu.Reporting.addItems hook and returns the menu.

#### Signature

- It is a **public** method.
- It returns a(n) `Array` value.


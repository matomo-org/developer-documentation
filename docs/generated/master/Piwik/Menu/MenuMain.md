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

- [`isUrlFound()`](#isurlfound) &mdash; Returns if the URL was found in the menu.
- [`getMenu()`](#getmenu) &mdash; Triggers the Menu.Reporting.addItems hook and returns the menu.

<a name="isurlfound" id="isurlfound"></a>
<a name="isUrlFound" id="isUrlFound"></a>
### `isUrlFound()`

Returns if the URL was found in the menu.

#### Signature

- It accepts the following parameter(s):
    - `$url`
- It returns a `boolean` value.

<a name="getmenu" id="getmenu"></a>
<a name="getMenu" id="getMenu"></a>
### `getMenu()`

Triggers the Menu.Reporting.addItems hook and returns the menu.

#### Signature

- It returns a `Array` value.


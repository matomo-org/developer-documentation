<small>Piwik\Menu</small>

MenuAdmin
=========

Contains menu entries for the Admin menu.

Description
-----------

Plugins can subscribe to the 
[Menu.Admin.addItems](#) event to add new pages to the admin menu.

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


Methods
-------

The class defines the following methods:

- [`addEntry()`](#addentry) &mdash; Adds a new AdminMenu entry under the 'Settings' category.

<a name="addentry" id="addentry"></a>
### `addEntry()`

Adds a new AdminMenu entry under the 'Settings' category.

#### Signature

- It accepts the following parameter(s):
    - `$adminMenuName`
    - `$url`
    - `$displayedForCurrentUser`
    - `$order`
- It does not return anything.


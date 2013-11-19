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
<a name="addEntry" id="addEntry"></a>
### `addEntry()`

Adds a new AdminMenu entry under the 'Settings' category.

#### Signature

- It accepts the following parameter(s):
    - `$adminMenuName` (`string`) &mdash; The name of the admin menu entry. Can be a translation token.
    - `$url` (`string`|`array`) &mdash; The URL the admin menu entry should link to, or an array of query parameters that can be used to build the URL.
    - `$displayedForCurrentUser` (`boolean`) &mdash; Whether this menu entry should be displayed for the current user. If false, the entry will not be added.
    - `$order` (`int`) &mdash; The order hint.
- It does not return anything.


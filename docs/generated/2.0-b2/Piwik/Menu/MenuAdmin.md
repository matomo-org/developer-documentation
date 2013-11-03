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
        MenuAdmin::getInstance()-&gt;add(
            &#039;MyPlugin_MyTranslatedAdminMenuCategory&#039;,
            &#039;MyPlugin_MyTranslatedAdminPageName&#039;,
            array(&#039;module&#039; =&gt; &#039;MyPlugin&#039;, &#039;action&#039; =&gt; &#039;index&#039;),
            Piwik::isUserHasSomeAdminAccess(),
            $order = 2
        );
    }


Methods
-------

The class defines the following methods:

- [`addEntry()`](#addEntry) &mdash; Adds a new AdminMenu entry under the &#039;Settings&#039; category.

### `addEntry()` <a name="addEntry"></a>

Adds a new AdminMenu entry under the &#039;Settings&#039; category.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$adminMenuName`
    - `$url`
    - `$displayedForCurrentUser`
    - `$order`
- It does not return anything.


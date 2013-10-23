<small>Piwik\Menu</small>

MenuTop
=======

Contains menu entries for the Top menu (the menu at the very top of the page).

Description
-----------

Plugins can subscribe to the [Menu.Top.addItems](#) event to add new pages to
the top menu.

**Example**

    // add a new page in an observer to Menu.Admin.addItems
    public function addTopMenuItem()
    {
        MenuTop::getInstance()-&gt;add(
            &#039;MyPlugin_MyTranslatedMenuCategory&#039;,
            &#039;MyPlugin_MyTranslatedMenuName&#039;,
            array(&#039;module&#039; =&gt; &#039;MyPlugin&#039;, &#039;action&#039; =&gt; &#039;index&#039;),
            Piwik::isUserHasSomeAdminAccess(),
            $order = 2
        );
    }


Methods
-------

The class defines the following methods:

- [`addEntry()`](#addEntry) &mdash; Adds a new entry to the TopMenu.

### `addEntry()` <a name="addEntry"></a>

Adds a new entry to the TopMenu.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$topMenuName`
    - `$url`
    - `$displayedForCurrentUser`
    - `$order`
    - `$isHTML`
    - `$tooltip`
- It does not return anything.


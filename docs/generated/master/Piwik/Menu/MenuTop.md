<small>Piwik\Menu</small>

MenuTop
=======

Contains menu entries for the Top menu (the menu at the very top of the page).

Description
-----------

Plugins can subscribe to the [Menu.Top.addItems](/api-reference/hooks#menutopadditems) event to add new pages to
the top menu.

**Example**

    // add a new page in an observer to Menu.Admin.addItems
    public function addTopMenuItem()
    {
        MenuTop::getInstance()->add(
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

- [`addEntry()`](#addentry) &mdash; Adds a new entry to the TopMenu.

<a name="addentry" id="addentry"></a>
<a name="addEntry" id="addEntry"></a>
### `addEntry()`

Adds a new entry to the TopMenu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$topMenuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The menu item name. Can be a translation token.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> The URL the admin menu entry should link to, or an array of query parameters that can be used to build the URL. If `$isHTML` is true, this can be a string with HTML that is simply embedded.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$displayedForCurrentUser` (`boolean`) &mdash;

      <div markdown="1" class="param-desc"> Whether this menu entry should be displayed for the current user. If false, the entry will not be added.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The order hint.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$isHTML` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether `$url` is an HTML string or a URL that will be rendered as a link.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"> Optional tooltip to display.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.


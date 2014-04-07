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

Methods
-------

The class defines the following methods:

- [`addEntry()`](#addentry) &mdash; Adds a new AdminMenu entry under the 'Settings' category.

<a name="addentry" id="addentry"></a>
<a name="addEntry" id="addEntry"></a>
### `addEntry()`

Adds a new AdminMenu entry under the 'Settings' category.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$adminMenuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the admin menu entry. Can be a translation token.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> The URL the admin menu entry should link to, or an array of query parameters that can be used to build the URL.</div>

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
   </ul>
- It does not return anything.


<small>Piwik\Menu\</small>

MenuReporting
=============

Contains menu entries for the Reporting menu (the menu displayed under the Piwik logo).

Plugins can implement the `configureReportingMenu()` method of the `Menu` plugin class to add, rename of remove
items. If your plugin does not have a `Menu` class yet you can create one using `./console generate:menu`.

**Example**

    public function configureReportingMenu(MenuReporting $menu)
    {
        $menu->add(
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

- [`add()`](#add) &mdash; Adds a new entry to the menu.
- [`remove()`](#remove) &mdash; Removes an existing entry from the menu.
- [`rename()`](#rename) &mdash; Renames a single menu entry.
- [`editUrl()`](#editurl) &mdash; Edits a URL of an existing menu entry.
- [`addVisitorsItem()`](#addvisitorsitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuReporting#add).
- [`addActionsItem()`](#addactionsitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuReporting#add).
- [`addReferrersItem()`](#addreferrersitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuReporting#add).
- [`isUrlFound()`](#isurlfound) &mdash; Returns if the URL was found in the menu.
- [`getMenu()`](#getmenu) &mdash; Triggers the Menu.Reporting.addItems hook and returns the menu.

<a name="add" id="add"></a>
<a name="add" id="add"></a>
### `add() *inherited from*` [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
Adds a new entry to the menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The menu's category name. Can be a translation token.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$subMenuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The menu item's name. Can be a translation token.</div>

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
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"> An optional tooltip to display or false to display the tooltip.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="remove" id="remove"></a>
<a name="remove" id="remove"></a>
### `remove() *inherited from*` [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
Removes an existing entry from the menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The menu's category name. Can be a translation token.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$subMenuName` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"> The menu item's name. Can be a translation token.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="rename" id="rename"></a>
<a name="rename" id="rename"></a>
### `rename() *inherited from*` [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
Renames a single menu entry.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$mainMenuOriginal` (`Piwik\Menu\$mainMenuOriginal`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$subMenuOriginal` (`Piwik\Menu\$subMenuOriginal`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$mainMenuRenamed` (`Piwik\Menu\$mainMenuRenamed`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$subMenuRenamed` (`Piwik\Menu\$subMenuRenamed`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="editurl" id="editurl"></a>
<a name="editUrl" id="editUrl"></a>
### `editUrl() *inherited from*` [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
Edits a URL of an existing menu entry.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$mainMenuToEdit` (`Piwik\Menu\$mainMenuToEdit`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$subMenuToEdit` (`Piwik\Menu\$subMenuToEdit`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$newUrl` (`Piwik\Menu\$newUrl`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="addvisitorsitem" id="addvisitorsitem"></a>
<a name="addVisitorsItem" id="addVisitorsItem"></a>
### `addVisitorsItem() `
Since Piwik 2.5.0

See [add()](/api-reference/Piwik/Menu/MenuReporting#add).

Adds a new menu item to the visitors section of the reporting menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`array`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="addactionsitem" id="addactionsitem"></a>
<a name="addActionsItem" id="addActionsItem"></a>
### `addActionsItem() `
Since Piwik 2.5.0

See [add()](/api-reference/Piwik/Menu/MenuReporting#add).

Adds a new menu item to the actions section of the reporting menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`array`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="addreferrersitem" id="addreferrersitem"></a>
<a name="addReferrersItem" id="addReferrersItem"></a>
### `addReferrersItem() `
Since Piwik 2.5.0

See [add()](/api-reference/Piwik/Menu/MenuReporting#add).

Adds a new menu item to the referrers section of the reporting menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`array`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="isurlfound" id="isurlfound"></a>
<a name="isUrlFound" id="isUrlFound"></a>
### `isUrlFound() `
Returns if the URL was found in the menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `boolean` value.

<a name="getmenu" id="getmenu"></a>
<a name="getMenu" id="getMenu"></a>
### `getMenu() `
Triggers the Menu.Reporting.addItems hook and returns the menu.

#### Signature

- It returns a `Array` value.


<small>Piwik\Menu</small>

MenuAbstract
============

Base class for classes that manage one of Piwik's menus.

Description
-----------

There are three menus in Piwik, the main menu, the top menu and the admin menu.
Each menu has a class that manages the rendering of it. Each class invokes
a different event to allow plugins to add new menu items.

Methods
-------

The abstract class defines the following methods:

- [`add()`](#add) &mdash; Adds a new entry to the menu.

<a name="add" id="add"></a>
<a name="add" id="add"></a>
### `add()`

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
      `$tooltip` (`Piwik\Menu\false`|`string`) &mdash;

      <div markdown="1" class="param-desc"> An optional tooltip to display.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.


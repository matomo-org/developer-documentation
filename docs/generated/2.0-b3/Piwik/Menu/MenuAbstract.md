<small>Piwik\Menu</small>

MenuAbstract
============

Base class for classes that manage one of Piwik&#039;s menus.

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

- It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash; The menu's category name. Can be a translation token.
    - `$subMenuName` (`string`) &mdash; The menu item's name. Can be a translation token.
    - `$url` (`string`|`array`) &mdash; The URL the admin menu entry should link to, or an array of query parameters that can be used to build the URL.
    - `$displayedForCurrentUser` (`boolean`) &mdash; Whether this menu entry should be displayed for the current user. If false, the entry will not be added.
    - `$order` (`int`) &mdash; The order hint.
    - `$tooltip` (`Piwik\Menu\false`|`string`) &mdash; An optional tooltip to display.
- It does not return anything.


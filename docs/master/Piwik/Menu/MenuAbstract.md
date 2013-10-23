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

### `add()` <a name="add"></a>

Adds a new entry to the menu.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$menuName`
    - `$subMenuName`
    - `$url`
    - `$displayedForCurrentUser`
    - `$order`
    - `$tooltip`
- It does not return anything.


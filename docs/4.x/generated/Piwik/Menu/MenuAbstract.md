<small>Piwik\Menu\</small>

MenuAbstract
============

Base class for classes that manage one of Piwik's menus.

There are three menus in Piwik, the main menu, the top menu and the admin menu.
Each menu has a class that manages the menu's content. Each class invokes
a different event to allow plugins to add new menu items.

Methods
-------

The abstract class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class. Inherited from [`Singleton`](../../Piwik/Singleton.md)
- [`addItem()`](#additem) &mdash; Adds a new entry to the menu.
- [`remove()`](#remove) &mdash; Removes an existing entry from the menu.
- [`rename()`](#rename) &mdash; Renames a single menu entry.
- [`editUrl()`](#editurl) &mdash; Edits a URL of an existing menu entry.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class. If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`Singleton`](../../Piwik/Singleton.md) value.

<a name="additem" id="additem"></a>
<a name="addItem" id="addItem"></a>
### `addItem()`

Since Matomo 2.7.0

Adds a new entry to the menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
       The menu's category name. Can be a translation token.
    - `$subMenuName` (`string`) &mdash;
       The menu item's name. Can be a translation token.
    - `$url` (`string`|`array`) &mdash;
       The URL the admin menu entry should link to, or an array of query parameters that can be used to build the URL.
    - `$order` (`int`) &mdash;
       The order hint.
    - `$tooltip` (`bool`|`string`) &mdash;
       An optional tooltip to display or false to display the tooltip.
    - `$icon` (`bool`|`string`) &mdash;
       An icon classname, such as "icon-add". Only supported by admin menu
    - `$onclick` (`bool`|`string`) &mdash;
       Will execute the on click handler instead of executing the link. Only supported by admin menu.
- It does not return anything.

<a name="remove" id="remove"></a>
<a name="remove" id="remove"></a>
### `remove()`

Removes an existing entry from the menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
       The menu's category name. Can be a translation token.
    - `$subMenuName` (`bool`|`string`) &mdash;
       The menu item's name. Can be a translation token.
- It does not return anything.

<a name="rename" id="rename"></a>
<a name="rename" id="rename"></a>
### `rename()`

Renames a single menu entry.

#### Signature

-  It accepts the following parameter(s):
    - `$mainMenuOriginal`
      
    - `$subMenuOriginal`
      
    - `$mainMenuRenamed`
      
    - `$subMenuRenamed`
      
- It does not return anything.

<a name="editurl" id="editurl"></a>
<a name="editUrl" id="editUrl"></a>
### `editUrl()`

Edits a URL of an existing menu entry.

#### Signature

-  It accepts the following parameter(s):
    - `$mainMenuToEdit`
      
    - `$subMenuToEdit`
      
    - `$newUrl`
      
- It does not return anything.


<small>Piwik\Menu\</small>

MenuTop
=======

Contains menu entries for the Top menu (the menu at the very top of the page).

Plugins can implement the `configureTopMenu()` method of the `Menu` plugin class to add, rename of remove
items. If your plugin does not have a `Menu` class yet you can create one using `./console generate:menu`.

Methods
-------

The class defines the following methods:

- [`addItem()`](#additem) &mdash; Adds a new entry to the menu. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`remove()`](#remove) &mdash; Removes an existing entry from the menu. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`rename()`](#rename) &mdash; Renames a single menu entry. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`editUrl()`](#editurl) &mdash; Edits a URL of an existing menu entry. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`addHtml()`](#addhtml) &mdash; Directly adds a menu entry containing html.

<a name="additem" id="additem"></a>
<a name="addItem" id="addItem"></a>
### `addItem()`

Since Piwik 2.7.0

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
    - `$mainMenuOriginal` (`Piwik\Menu\$mainMenuOriginal`) &mdash;
      
    - `$subMenuOriginal` (`Piwik\Menu\$subMenuOriginal`) &mdash;
      
    - `$mainMenuRenamed` (`Piwik\Menu\$mainMenuRenamed`) &mdash;
      
    - `$subMenuRenamed` (`Piwik\Menu\$subMenuRenamed`) &mdash;
      
- It does not return anything.

<a name="editurl" id="editurl"></a>
<a name="editUrl" id="editUrl"></a>
### `editUrl()`

Edits a URL of an existing menu entry.

#### Signature

-  It accepts the following parameter(s):
    - `$mainMenuToEdit` (`Piwik\Menu\$mainMenuToEdit`) &mdash;
      
    - `$subMenuToEdit` (`Piwik\Menu\$subMenuToEdit`) &mdash;
      
    - `$newUrl` (`Piwik\Menu\$newUrl`) &mdash;
      
- It does not return anything.

<a name="addhtml" id="addhtml"></a>
<a name="addHtml" id="addHtml"></a>
### `addHtml()`

Directly adds a menu entry containing html.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$data` (`string`) &mdash;
      
    - `$displayedForCurrentUser` (`boolean`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`string`) &mdash;
       Tooltip to display.
- It does not return anything.


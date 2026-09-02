<small>Piwik\Plugins\TagManager\</small>

MenuTagManager
==============

Contains menu entries for the Tag Manager menu.

Plugins can implement the `configureTagManagerMenu()` method of the `Menu` plugin class to add, rename of remove
items. If your plugin does not have a `Menu` class yet you can create one using `./console generate:menu`.

Methods
-------

The class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class. Inherited from [`Singleton`](../../../Piwik/Singleton.md)
- [`addItem()`](#additem) &mdash; Adds a new entry to the menu. Inherited from [`MenuAbstract`](../../../Piwik/Menu/MenuAbstract.md)
- [`remove()`](#remove) &mdash; Removes an existing entry from the menu. Inherited from [`MenuAbstract`](../../../Piwik/Menu/MenuAbstract.md)
- [`rename()`](#rename) &mdash; Renames a single menu entry. Inherited from [`MenuAbstract`](../../../Piwik/Menu/MenuAbstract.md)
- [`editUrl()`](#editurl) &mdash; Edits a URL of an existing menu entry. Inherited from [`MenuAbstract`](../../../Piwik/Menu/MenuAbstract.md)

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class. If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`Singleton`](../../../Piwik/Singleton.md) value.

<a name="additem" id="additem"></a>
<a name="addItem" id="addItem"></a>
### `addItem()`

Since Matomo 2.7.0

Adds a new entry to the menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
       The menu's category name. Can be a translation token.
    - `$subMenuName` (`string`|`null`) &mdash;
       The menu item's name. Can be a translation token.
    - `$url` (`string`|`Piwik\Menu\array&lt;string,`) &mdash;
       scalar> $url The URL the admin menu entry should link to, or an array of query parameters that can be used to build the URL.
    - `$order` (`int`) &mdash;
       The order hint.
    - `$tooltip` (`string`|`null`|`false`) &mdash;
       An optional tooltip to display or false to display the tooltip.
    - `$icon` (`string`|`null`|`false`) &mdash;
       An icon classname, such as "icon-add". Only supported by admin menu
    - `$onclick` (`string`|`null`|`false`) &mdash;
       Will execute the on click handler instead of executing the link. Only supported by admin menu.
    - `$attribute` (`string`|`null`|`false`) &mdash;
       Will add this string as a link attribute.
    - `$help` (`string`|`null`|`false`) &mdash;
       Will display a help icon that will pop a notification with help information.
    - `$badgeCount` (`int`) &mdash;
       If non-zero then a badge will be overlaid on the icon showing the provided count
    - `$cssClass` (`string`) &mdash;
       If a string is provided, it will be added as an extra CSS class to the menu item
- It returns a `void` value.

<a name="remove" id="remove"></a>
<a name="remove" id="remove"></a>
### `remove()`

Removes an existing entry from the menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
       The menu's category name. Can be a translation token.
    - `$subMenuName` (`string`|`null`|`false`) &mdash;
       The menu item's name. Can be a translation token.
- It returns a `void` value.

<a name="rename" id="rename"></a>
<a name="rename" id="rename"></a>
### `rename()`

Renames a single menu entry.

#### Signature

-  It accepts the following parameter(s):
    - `$mainMenuOriginal` (`string`) &mdash;
      
    - `$subMenuOriginal` (`string`|`null`) &mdash;
      
    - `$mainMenuRenamed` (`string`) &mdash;
      
    - `$subMenuRenamed` (`string`|`null`) &mdash;
      
- It returns a `void` value.

<a name="editurl" id="editurl"></a>
<a name="editUrl" id="editUrl"></a>
### `editUrl()`

Edits a URL of an existing menu entry.

#### Signature

-  It accepts the following parameter(s):
    - `$mainMenuToEdit` (`string`) &mdash;
      
    - `$subMenuToEdit` (`string`|`null`) &mdash;
      
    - `$newUrl` (`string`|`Piwik\Menu\array&lt;string,`) &mdash;
       scalar> $newUrl
- It returns a `void` value.


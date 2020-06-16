<small>Piwik\Menu\</small>

MenuAdmin
=========

Contains menu entries for the Admin menu.

Plugins can implement the `configureAdminMenu()` method of the `Menu` plugin class to add, rename of remove
items. If your plugin does not have a `Menu` class yet you can create one using `./console generate:menu`.

Methods
-------

The class defines the following methods:

- [`addItem()`](#additem) &mdash; Adds a new entry to the menu. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`remove()`](#remove) &mdash; Removes an existing entry from the menu. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`rename()`](#rename) &mdash; Renames a single menu entry. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`editUrl()`](#editurl) &mdash; Edits a URL of an existing menu entry. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`addPersonalItem()`](#addpersonalitem) &mdash; See add().
- [`addDevelopmentItem()`](#adddevelopmentitem) &mdash; See add().
- [`addDiagnosticItem()`](#adddiagnosticitem) &mdash; See add().
- [`addPlatformItem()`](#addplatformitem) &mdash; See add().
- [`addMeasurableItem()`](#addmeasurableitem) &mdash; See add().
- [`addSystemItem()`](#addsystemitem) &mdash; See add().

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

<a name="addpersonalitem" id="addpersonalitem"></a>
<a name="addPersonalItem" id="addPersonalItem"></a>
### `addPersonalItem()`

Since Piwik 2.5.0

See add().

Adds a new menu item to the manage section of the user menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything.

<a name="adddevelopmentitem" id="adddevelopmentitem"></a>
<a name="addDevelopmentItem" id="addDevelopmentItem"></a>
### `addDevelopmentItem()`

Since Piwik 2.5.0

See add().

Adds a new menu item to the development section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything.

<a name="adddiagnosticitem" id="adddiagnosticitem"></a>
<a name="addDiagnosticItem" id="addDiagnosticItem"></a>
### `addDiagnosticItem()`

Since Piwik 2.5.0

See add().

Adds a new menu item to the diagnostic section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything.

<a name="addplatformitem" id="addplatformitem"></a>
<a name="addPlatformItem" id="addPlatformItem"></a>
### `addPlatformItem()`

Since Piwik 2.5.0

See add().

Adds a new menu item to the platform section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything.

<a name="addmeasurableitem" id="addmeasurableitem"></a>
<a name="addMeasurableItem" id="addMeasurableItem"></a>
### `addMeasurableItem()`

Since Piwik 3.0.0

See add().

Adds a new menu item to the measurable section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything.

<a name="addsystemitem" id="addsystemitem"></a>
<a name="addSystemItem" id="addSystemItem"></a>
### `addSystemItem()`

Since Piwik 3.0.0

See add().

Adds a new menu item to the manage section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything.


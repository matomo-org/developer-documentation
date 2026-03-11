<small>Piwik\Menu\</small>

MenuAdmin
=========

Contains menu entries for the Admin menu.

Plugins can implement the `configureAdminMenu()` method of the `Menu` plugin class to add, rename of remove
items. If your plugin does not have a `Menu` class yet you can create one using `./console generate:menu`.

Methods
-------

The class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class. Inherited from [`Singleton`](../../Piwik/Singleton.md)
- [`addItem()`](#additem) &mdash; Adds a new entry to the menu. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`remove()`](#remove) &mdash; Removes an existing entry from the menu. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`rename()`](#rename) &mdash; Renames a single menu entry. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`editUrl()`](#editurl) &mdash; Edits a URL of an existing menu entry. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`addPersonalItem()`](#addpersonalitem) &mdash; See add().
- [`addDevelopmentItem()`](#adddevelopmentitem) &mdash; See add().
- [`addDiagnosticItem()`](#adddiagnosticitem) &mdash; See add().
- [`addPlatformItem()`](#addplatformitem) &mdash; See add().
- [`addPluginItem()`](#addpluginitem) &mdash; See add().
- [`addMeasurableItem()`](#addmeasurableitem) &mdash; See add().
- [`addSystemItem()`](#addsystemitem) &mdash; See add().

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

<a name="addpersonalitem" id="addpersonalitem"></a>
<a name="addPersonalItem" id="addPersonalItem"></a>
### `addPersonalItem()`

Since Matomo 2.5.0

See add(). Adds a new menu item to the manage section of the user menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="adddevelopmentitem" id="adddevelopmentitem"></a>
<a name="addDevelopmentItem" id="addDevelopmentItem"></a>
### `addDevelopmentItem()`

Since Matomo 2.5.0

See add(). Adds a new menu item to the development section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="adddiagnosticitem" id="adddiagnosticitem"></a>
<a name="addDiagnosticItem" id="addDiagnosticItem"></a>
### `addDiagnosticItem()`

Since Matomo 2.5.0

See add(). Adds a new menu item to the diagnostic section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="addplatformitem" id="addplatformitem"></a>
<a name="addPlatformItem" id="addPlatformItem"></a>
### `addPlatformItem()`

Since Matomo 2.5.0

See add(). Adds a new menu item to the platform section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="addpluginitem" id="addpluginitem"></a>
<a name="addPluginItem" id="addPluginItem"></a>
### `addPluginItem()`

Since Matomo 5.0.0

See add(). Adds a new menu item to the plugins section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip`
      
    - `$cssClass` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="addmeasurableitem" id="addmeasurableitem"></a>
<a name="addMeasurableItem" id="addMeasurableItem"></a>
### `addMeasurableItem()`

Since Matomo 3.0.0

See add(). Adds a new menu item to the measurable section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`false`|`string`) &mdash;
      
    - `$icon` (`false`|`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="addsystemitem" id="addsystemitem"></a>
<a name="addSystemItem" id="addSystemItem"></a>
### `addSystemItem()`

Since Matomo 3.0.0

See add(). Adds a new menu item to the manage section of the admin menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything or a mixed result.


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

- [`addItem()`](#additem) &mdash; Adds a new entry to the menu. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`remove()`](#remove) &mdash; Removes an existing entry from the menu. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`rename()`](#rename) &mdash; Renames a single menu entry. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`editUrl()`](#editurl) &mdash; Edits a URL of an existing menu entry. Inherited from [`MenuAbstract`](../../Piwik/Menu/MenuAbstract.md)
- [`addVisitorsItem()`](#addvisitorsitem) &mdash; See add().
- [`addActionsItem()`](#addactionsitem) &mdash; See add().
- [`addReferrersItem()`](#addreferrersitem) &mdash; See add().
- [`isUrlFound()`](#isurlfound) &mdash; Returns if the URL was found in the menu.
- [`getMenu()`](#getmenu) &mdash; Triggers the Menu.Reporting.addItems hook and returns the menu.

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

<a name="addvisitorsitem" id="addvisitorsitem"></a>
<a name="addVisitorsItem" id="addVisitorsItem"></a>
### `addVisitorsItem()`

Since Piwik 2.5.0

See add().

Adds a new menu item to the visitors section of the reporting menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything.

<a name="addactionsitem" id="addactionsitem"></a>
<a name="addActionsItem" id="addActionsItem"></a>
### `addActionsItem()`

Since Piwik 2.5.0

See add().

Adds a new menu item to the actions section of the reporting menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything.

<a name="addreferrersitem" id="addreferrersitem"></a>
<a name="addReferrersItem" id="addReferrersItem"></a>
### `addReferrersItem()`

Since Piwik 2.5.0

See add().

Adds a new menu item to the referrers section of the reporting menu.

#### Signature

-  It accepts the following parameter(s):
    - `$menuName` (`string`) &mdash;
      
    - `$url` (`array`) &mdash;
      
    - `$order` (`int`) &mdash;
      
    - `$tooltip` (`bool`|`string`) &mdash;
      
- It does not return anything.

<a name="isurlfound" id="isurlfound"></a>
<a name="isUrlFound" id="isUrlFound"></a>
### `isUrlFound()`

Returns if the URL was found in the menu.

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
      
- It returns a `boolean` value.

<a name="getmenu" id="getmenu"></a>
<a name="getMenu" id="getMenu"></a>
### `getMenu()`

Triggers the Menu.Reporting.addItems hook and returns the menu.

#### Signature

- It returns a `Array` value.


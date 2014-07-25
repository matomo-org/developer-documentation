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

- [`isUrlFound()`](#isurlfound) &mdash; Returns if the URL was found in the menu.
- [`getMenu()`](#getmenu) &mdash; Triggers the Menu.Reporting.addItems hook and returns the menu.

<a name="isurlfound" id="isurlfound"></a>
<a name="isUrlFound" id="isUrlFound"></a>
### `isUrlFound()`

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
### `getMenu()`

Triggers the Menu.Reporting.addItems hook and returns the menu.

#### Signature

- It returns a `Array` value.


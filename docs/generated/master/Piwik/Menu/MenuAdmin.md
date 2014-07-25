<small>Piwik\Menu\</small>

MenuAdmin
=========

Contains menu entries for the Admin menu.

Plugins can implement the `configureAdminMenu()` method of the `Menu` plugin class to add, rename of remove
items. If your plugin does not have a `Menu` class yet you can create one using `./console generate:menu`.

**Example**

    public function configureAdminMenu(MenuAdmin $menu)
    {
        $menu->add(
            'MyPlugin_MyTranslatedAdminMenuCategory',
            'MyPlugin_MyTranslatedAdminPageName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            Piwik::isUserHasSomeAdminAccess(),
            $order = 2
        );
    }

Methods
-------

The class defines the following methods:

- [`addDevelopmentItem()`](#adddevelopmentitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).
- [`addDiagnosticItem()`](#adddiagnosticitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).
- [`addPlatformItem()`](#addplatformitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).
- [`addSettingsItem()`](#addsettingsitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).
- [`addManageItem()`](#addmanageitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).

<a name="adddevelopmentitem" id="adddevelopmentitem"></a>
<a name="addDevelopmentItem" id="addDevelopmentItem"></a>
### `addDevelopmentItem()`

Since Piwik 2.5.0

See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).

Adds a new menu item to the development section of the admin menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`array`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="adddiagnosticitem" id="adddiagnosticitem"></a>
<a name="addDiagnosticItem" id="addDiagnosticItem"></a>
### `addDiagnosticItem()`

Since Piwik 2.5.0

See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).

Adds a new menu item to the diagnostic section of the admin menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`array`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="addplatformitem" id="addplatformitem"></a>
<a name="addPlatformItem" id="addPlatformItem"></a>
### `addPlatformItem()`

Since Piwik 2.5.0

See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).

Adds a new menu item to the platform section of the admin menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`array`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="addsettingsitem" id="addsettingsitem"></a>
<a name="addSettingsItem" id="addSettingsItem"></a>
### `addSettingsItem()`

Since Piwik 2.5.0

See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).

Adds a new menu item to the settings section of the admin menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`array`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="addmanageitem" id="addmanageitem"></a>
<a name="addManageItem" id="addManageItem"></a>
### `addManageItem()`

Since Piwik 2.5.0

See [add()](/api-reference/Piwik/Menu/MenuAdmin#add).

Adds a new menu item to the manage section of the admin menu.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menuName` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`array`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`int`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tooltip` (`bool`|`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.


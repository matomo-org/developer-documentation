<small>Piwik\Menu\</small>

MenuUser
========

Contains menu entries for the User menu (the menu at the very top of the page).

Plugins can implement the `configureUserMenu()` method of the `Menu` plugin class to add, rename of remove
items. If your plugin does not have a `Menu` class yet you can create one using `./console generate:menu`.

**Example**

    public function configureUserMenu(MenuUser $menu)
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

- [`addManageItem()`](#addmanageitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuUser#add).
- [`addPlatformItem()`](#addplatformitem) &mdash; See [add()](/api-reference/Piwik/Menu/MenuUser#add).

<a name="addmanageitem" id="addmanageitem"></a>
<a name="addManageItem" id="addManageItem"></a>
### `addManageItem()`

Since Piwik 2.5.0

See [add()](/api-reference/Piwik/Menu/MenuUser#add).

Adds a new menu item to the manage section of the user menu.

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

See [add()](/api-reference/Piwik/Menu/MenuUser#add).

Adds a new menu item to the platform section of the user menu.

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


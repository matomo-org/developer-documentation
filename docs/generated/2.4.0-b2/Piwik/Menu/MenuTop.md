<small>Piwik\Menu\</small>

MenuTop
=======

Contains menu entries for the Top menu (the menu at the very top of the page).

Plugins can subscribe to the [Menu.Top.addItems](/api-reference/hooks#menutopadditems) event to add new pages to
the top menu.

**Example**

    // add a new page in an observer to Menu.Admin.addItems
    public function addTopMenuItem()
    {
        MenuTop::getInstance()->add(
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

- [`addHtml()`](#addhtml) &mdash; Directly adds a menu entry containing html.

<a name="addhtml" id="addhtml"></a>
<a name="addHtml" id="addHtml"></a>
### `addHtml()`

Directly adds a menu entry containing html.

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
      `$data` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$displayedForCurrentUser` (`boolean`) &mdash;

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
      `$tooltip` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Tooltip to display.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.


---
category: Develop
---
# Menus

Matomo contains 3 menus:

- the **top menu** (top-right of the page)

    ![](/img/menu-top.png)

- the **reporting menu** (which includes all the reports like "Actions" and "Visitors")

    ![](/img/menu-reporting.png)

- the **admin menu** (shown in the admin panel)

    ![](/img/menu-admin.png)

Plugins can add items to these menus by implementing a `Menu` class. To add new items to the reporting menu you need
to create a new [Widget](/guides/widgets).

## Adding a menu item

To add a menu class to your plugin, use the console:

```
$ ./console generate:menu
```

It will create a `plugins/MyPlugin/Menu.php` file:

```php
class Menu extends \Piwik\Plugin\Menu
{
    public function configureTopMenu(MenuTop $menu)
    {
        // ...
    }

    public function configureAdminMenu(MenuAdmin $menu)
    {
        // ...
    }
}
```

Note: URLs can be built using the controller methods:

- `$this->urlForDefaultAction()` returns the default action (index) for the controller of this plugin
- `$this->urlForAction('foo')` returns the URL for the action `foo` for the controller of this plugin

### Top menu item

```php
    public function configureTopMenu(MenuTop $menu)
    {
        $menu->addItem('My top item', null, $this->urlForDefaultAction());
    }
```

### Admin menu item

```php
    public function configureAdminMenu(MenuAdmin $menu)
    {
        // add items to an existing category
        $menu->addSettingsItem('My admin item', $this->urlForDefaultAction());
        $menu->addPlatformItem('My admin item', $this->urlForDefaultAction());

        // or create a custom category
        $menu->addItem('MyPlugin admin settings', 'My admin item', $this->urlForDefaultAction());
    }
```

### Reporting menu item

To add or change items in the reporting menu you need to create a new [Widget](/guides/widgets).

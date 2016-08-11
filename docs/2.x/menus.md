---
category: Develop
---
# Menus

Piwik contains 4 menus:

- the **top menu** (top-right of the page)

    ![](/img/menu-top.png)

- the **user menu** (which is accessible when clicking on the username in the top menu)

    ![](/img/menu-user.png)

- the **reporting menu** (which includes all the reports like "Actions" and "Visitors")

    ![](/img/menu-reporting.png)

- the **admin menu** (shown in the admin panel)

    ![](/img/menu-admin.png)

Plugins can add items to these menus by implementing a `Menu` class.

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

    public function configureUserMenu(MenuUser $menu)
    {
        // ...
    }

    public function configureReportingMenu(MenuReporting $menu)
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

### User menu item

```php
    public function configureUserMenu(MenuUser $menu)
    {
        // add items to an existing category
        $menu->addManageItem('My item', $this->urlForDefaultAction());
        $menu->addPlatformItem('My item', $this->urlForDefaultAction());

        // or create a custom category
        $menu->addItem('My category', 'My item', $this->urlForDefaultAction());
    }
```

### Reporting menu item

```php
    public function configureReportingMenu(MenuReporting $menu)
    {
        // add items to an existing category
        $menu->addVisitorsItem('Coffee report', $this->urlForAction('showReport'));
        $menu->addActionsItem('Coffee report', $this->urlForAction('showReport'));

        // or create a custom category named 'Coffee'
        $menu->addItem('Coffee', '', $this->urlForDefaultAction());
        $menu->addItem('Coffee', 'Coffee report', $this->urlForAction('showReport'));
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
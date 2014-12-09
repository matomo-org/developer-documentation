---
category: Develop
---
# Permissions

Permissions define what a user can see or do in Piwik.

## Users and permissions

Piwik defines 3 types of permissions:

- [**view permission**](http://piwik.org/faq/general/faq_70/#faq_70): applies to a specific site

    With that permission, a user can view the reports for a given site.

- [**admin permission**](http://piwik.org/faq/general/faq_69/#faq_69): applies to a specific site

    With that permission, a user can view and configure a given site (name, URLs, timezone, etc.). They can also grant other users the "view" or "admin" permission.

- [**super user permission**](http://piwik.org/faq/general/faq_35/#faq_35): applies to **whole Piwik** (all sites)

    With that permission, a user can view and configure all sites. They can also perform all administrative tasks such as add new sites, add users, change user permissions, activate and deactivate plugins or install new ones from the Marketplace.

## Checking permissions

Usually plugins should check permissions before:

- executing an action, such as deleting or fetching data
- rendering any sensitive information that should not be accessible to everyone

Sometimes you may also need to verify permissions before registering menu items or widgets.

To check for permissions, you need to use the [`Piwik\Piwik`](http://developer.piwik.org/api-reference/Piwik/Piwik) class:

- methods starting with `check` throw an exception in case a condition is not met

    Use methods that throw an exception if you want to stop any further execution in case a user does not have an appropriate role. The platform will catch the exception and display an error message or ask the user to log in.

    ```php
    public function deleteAllMessages()
    {
        // delete messages only if user has super user access, otherwise show an error message
        Piwik::checkUserSuperUserAccess();

        $this->getModel()->deleteAllMessages();
    }
    ```

- methods starting with `is` and `has` test for permissions and return a `boolean`

    Use methods that return a boolean for instance when registering menu items or widgets.

    ```php
    public function configureAdminMenu(MenuAdmin $menu)
    {
        if (Piwik::hasUserSuperUserAccess()) {
            $menu->addPlatformItem('Plugins', $this->urlForDefaultAction());
        }
    }
    ```

<div markdown="1" class="alert alert-warning">
**Warning:** It is important to be aware that just because the menu item won’t be displayed in the UI a user can still open the registered URL manually. Therefore you have to check for permissions in the actual controller action as well.
</div>

### View permission

A user having a view permission should be only able to view reports but not make any changes apart from his personal settings. The methods that end with `UserHasSomeViewAccess` make sure a user has at least view permission for one website whereas the methods `*UserHasViewAccess($idSites = array(1,2,3))` check whether a user has view access for all of the given websites.

```php
Piwik::checkUserHasSomeViewAccess();

Piwik::checkUserHasViewAccess($idSites = array(1,2,3));
```

As a plugin developer you would usually use the latter example to verify the permissions for specific websites. Use the first example in case you develop something like an *All Websites Dashboard* where you only want to make sure the user has a view permission for at least one website.

### Admin permission

A user having an admin permission cannot only view reports but also change website related settings. The methods to check for this role are similar to the ones before, just swap the term `View` with `Admin`.

```
Piwik::checkUserHasSomeAdminAccess();

Piwik::checkUserHasAdminAccess($idSites = array(1,2,3));
```

### Super user permission

A user having the super user permission is allowed to access all of the data stored in Piwik and change any settings. To check if a user has this role use one of the methods that end with `UserSuperUserAccess`.

```
Piwik::checkUserHasSuperUserAccess();
```

As a plugin developer you would check for this permission for instance in places where your plugin shows an activity log over all users or where it offers the possibility to change any system wide settings.

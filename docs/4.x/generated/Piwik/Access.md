<small>Piwik\</small>

Access
======

Singleton that manages user access to Piwik resources.

To check whether a user has access to a resource, use one of the [Piwik::checkUser...](/api-reference/Piwik/Piwik)
methods.

In Piwik there are four different access levels:

- **no access**: Users with this access level cannot view the resource.
- **view access**: Users with this access level can view the resource, but cannot modify it.
- **admin access**: Users with this access level can view and modify the resource.
- **Super User access**: Only the Super User has this access level. It means the user can do
                         whatever they want.

                         Super user access is required to set some configuration options.
                         All other options are specific to the user or to a website.

Access is granted per website. Uses with access for a website can view all
data associated with that website.

Methods
-------

The class defines the following methods:

- [`doAsSuperUser()`](#doassuperuser) &mdash; Executes a callback with superuser privileges, making sure those privileges are rescinded before this method exits.

<a name="doassuperuser" id="doassuperuser"></a>
<a name="doAsSuperUser" id="doAsSuperUser"></a>
### `doAsSuperUser()`

Executes a callback with superuser privileges, making sure those privileges are rescinded before this method exits.

Privileges will be rescinded even if an exception is thrown.

#### Signature

-  It accepts the following parameter(s):
    - `$function` (`Piwik\callback`) &mdash;
       The callback to execute. Should accept no arguments.

- *Returns:*  `mixed` &mdash;
    The result of `$function`.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; rethrows any exceptions thrown by `$function`.


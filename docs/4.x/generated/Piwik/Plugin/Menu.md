<small>Piwik\Plugin\</small>

Menu
====

Since Matomo 2.4.0

Base class of all plugin menu providers.

Descendants of this class can overwrite any of these methods. Each method will be executed only once per request
and cached for any further menu requests.

For an example, see the [https://github.com/piwik/piwik/blob/master/plugins/ExampleUI/Menu.php](https://github.com/piwik/piwik/blob/master/plugins/ExampleUI/Menu.php) plugin.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`urlForDefaultAction()`](#urlfordefaultaction) &mdash; Generates a URL for the default action of the plugin controller.
- [`urlForAction()`](#urlforaction) &mdash; Generates a URL for the given action.
- [`urlForDefaultUserParams()`](#urlfordefaultuserparams) &mdash; Returns the &idSite=X&period=Y&date=Z query string fragment, fetched from current logged-in user's preferences.
- [`configureTopMenu()`](#configuretopmenu) &mdash; Configures the top menu which is supposed to contain analytics related items such as the "All Websites Dashboard".
- [`configureAdminMenu()`](#configureadminmenu) &mdash; Configures the admin menu which is supposed to contain only administration related items such as "Websites", "Users" or "Settings".

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature


<a name="urlfordefaultaction" id="urlfordefaultaction"></a>
<a name="urlForDefaultAction" id="urlForDefaultAction"></a>
### `urlForDefaultAction()`

Since Matomo 2.7.0

Generates a URL for the default action of the plugin controller.

Example:
```
$menu->addItem('MyPlugin_MyPlugin', '', $this->urlForDefaultAction(), $orderId = 30);
// will add a menu item that leads to the default action of the plugin controller when a user clicks on it.
// The default action is usually the `index` action - meaning the `index()` method the controller -
// but the default action can be customized within a controller
```

#### Signature

-  It accepts the following parameter(s):
    - `$additionalParams` (`array`) &mdash;
       Optional URL parameters that will be appended to the URL
- It returns a `array` value.

<a name="urlforaction" id="urlforaction"></a>
<a name="urlForAction" id="urlForAction"></a>
### `urlForAction()`

Since Matomo 2.7.0

Generates a URL for the given action. In your plugin controller you have to create a method with the same name
as this method will be executed when a user clicks on the menu item. If you want to generate a URL for the
action of another module, meaning not your plugin, you should use the method urlForModuleAction().

#### Signature

-  It accepts the following parameter(s):
    - `$controllerAction` (`string`) &mdash;
       The name of the action that should be executed within your controller
    - `$additionalParams` (`array`) &mdash;
       Optional URL parameters that will be appended to the URL
- It returns a `array` value.

<a name="urlfordefaultuserparams" id="urlfordefaultuserparams"></a>
<a name="urlForDefaultUserParams" id="urlForDefaultUserParams"></a>
### `urlForDefaultUserParams()`

Returns the &idSite=X&period=Y&date=Z query string fragment,
fetched from current logged-in user's preferences.

#### Signature

-  It accepts the following parameter(s):
    - `$websiteId` (`bool`) &mdash;
      
    - `$defaultPeriod` (`bool`) &mdash;
      
    - `$defaultDate` (`bool`) &mdash;
      

- *Returns:*  `array` &mdash;
    eg ['idSite' => 1, 'period' => 'day', 'date' => '2012-02-03']
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; in case a website was not specified and a default website id could not be found

<a name="configuretopmenu" id="configuretopmenu"></a>
<a name="configureTopMenu" id="configureTopMenu"></a>
### `configureTopMenu()`

Configures the top menu which is supposed to contain analytics related items such as the
"All Websites Dashboard".

#### Signature

-  It accepts the following parameter(s):
    - `$menu` ([`MenuTop`](../../Piwik/Menu/MenuTop.md)) &mdash;
      
- It does not return anything or a mixed result.

<a name="configureadminmenu" id="configureadminmenu"></a>
<a name="configureAdminMenu" id="configureAdminMenu"></a>
### `configureAdminMenu()`

Configures the admin menu which is supposed to contain only administration related items such as
"Websites", "Users" or "Settings".

#### Signature

-  It accepts the following parameter(s):
    - `$menu` ([`MenuAdmin`](../../Piwik/Menu/MenuAdmin.md)) &mdash;
      
- It does not return anything or a mixed result.


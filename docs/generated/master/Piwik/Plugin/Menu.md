<small>Piwik\Plugin\</small>

Menu
====

Since Piwik 2.4.0

Base class of all plugin menu providers.

Plugins that define their own menu items can extend this class to easily
add new items, to remove or to rename existing items.

Descendants of this class can overwrite any of these methods. Each method will be executed only once per request
and cached for any further menu requests.

For an example, see the [https://github.com/piwik/piwik/blob/master/plugins/ExampleUI/Menu.php](https://github.com/piwik/piwik/blob/master/plugins/ExampleUI/Menu.php) plugin.

Methods
-------

The class defines the following methods:

- [`configureReportingMenu()`](#configurereportingmenu) &mdash; Configures the reporting menu which should only contain links to reports of a specific site such as "Search Engines", "Page Titles" or "Locations & Provider".
- [`configureTopMenu()`](#configuretopmenu) &mdash; Configures the top menu which is supposed to contain analytics related items such as the "All Websites Dashboard".
- [`configureUserMenu()`](#configureusermenu) &mdash; Configures the user menu which is supposed to contain user and help related items such as "User settings", "Alerts" or "Email Reports".
- [`configureAdminMenu()`](#configureadminmenu) &mdash; Configures the admin menu which is supposed to contain only administration related items such as "Websites", "Users" or "Plugin settings".

<a name="configurereportingmenu" id="configurereportingmenu"></a>
<a name="configureReportingMenu" id="configureReportingMenu"></a>
### `configureReportingMenu()`

Configures the reporting menu which should only contain links to reports of a specific site such as "Search Engines", "Page Titles" or "Locations & Provider".

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menu` ([`MenuReporting`](../../Piwik/Menu/MenuReporting.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="configuretopmenu" id="configuretopmenu"></a>
<a name="configureTopMenu" id="configureTopMenu"></a>
### `configureTopMenu()`

Configures the top menu which is supposed to contain analytics related items such as the "All Websites Dashboard".

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menu` ([`MenuTop`](../../Piwik/Menu/MenuTop.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="configureusermenu" id="configureusermenu"></a>
<a name="configureUserMenu" id="configureUserMenu"></a>
### `configureUserMenu()`

Configures the user menu which is supposed to contain user and help related items such as "User settings", "Alerts" or "Email Reports".

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menu` ([`MenuUser`](../../Piwik/Menu/MenuUser.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="configureadminmenu" id="configureadminmenu"></a>
<a name="configureAdminMenu" id="configureAdminMenu"></a>
### `configureAdminMenu()`

Configures the admin menu which is supposed to contain only administration related items such as "Websites", "Users" or "Plugin settings".

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menu` ([`MenuAdmin`](../../Piwik/Menu/MenuAdmin.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.


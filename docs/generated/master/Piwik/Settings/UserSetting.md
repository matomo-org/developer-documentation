<small>Piwik\Settings\</small>

UserSetting
===========

Describes a per user setting.

Each user will be able to change this setting for themselves,
but not for other users.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getOrder()`](#getorder) &mdash; Returns the display order.
- [`setUserLogin()`](#setuserlogin) &mdash; Sets the name of the user this setting will be set for.
- [`removeAllUserSettingsForUser()`](#removeallusersettingsforuser) &mdash; Unsets all settings for a user.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The setting's persisted name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$title` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The setting's display name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$userLogin` (`null`|`string`) &mdash;

      <div markdown="1" class="param-desc"> The user this setting applies to. Will default to the current user login.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

Returns the display order.

User settings are displayed after system settings.

#### Signature

- It returns a `int` value.

<a name="setuserlogin" id="setuserlogin"></a>
<a name="setUserLogin" id="setUserLogin"></a>
### `setUserLogin()`

Sets the name of the user this setting will be set for.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$userLogin` (`Piwik\Settings\$userLogin`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the current user does not have permission to set the setting value of `$userLogin`.

<a name="removeallusersettingsforuser" id="removeallusersettingsforuser"></a>
<a name="removeAllUserSettingsForUser" id="removeAllUserSettingsForUser"></a>
### `removeAllUserSettingsForUser()`

Unsets all settings for a user.

The settings will be removed from the database. Used when
a user is deleted.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$userLogin` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the `$userLogin` is empty.


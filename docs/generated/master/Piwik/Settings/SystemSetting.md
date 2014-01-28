<small>Piwik\Settings\</small>

SystemSetting
=============

Describes a system wide setting.

Only the Super User can change this type of setting and
the value of this setting will affect all users.

See [Settings](/api-reference/Piwik/Plugin/Settings).

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getOrder()`](#getorder) &mdash; Returns the display order.

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

      <div markdown="1" class="param-desc"> The persisted name of the setting.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$title` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The display name of the setting.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

Returns the display order.

System settings are displayed before user settings.

#### Signature

- It returns a `int` value.


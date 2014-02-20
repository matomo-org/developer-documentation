<small>Piwik\View\</small>

UIControl
=========

Base type of UI controls.

The JavaScript companion class can be found in plugins/CoreHome/javascripts/uiControl.js.

Constants
---------

This class defines the following constants:

- [`TEMPLATE`](#template) &mdash; The Twig template file that generates the control's HTML.

<a name="template" id="template"></a>
<a name="TEMPLATE" id="TEMPLATE"></a>
### `TEMPLATE`

Derived classes must set this constant.

Properties
----------

This class defines the following properties:

- [`$clientSideProperties`](#$clientsideproperties) &mdash; Holds the array of values that are passed to the UIControl JavaScript class.
- [`$clientSideParameters`](#$clientsideparameters) &mdash; Holds an array of values that are passed to the UIControl JavaScript class.
- [`$cssIdentifier`](#$cssidentifier) &mdash; The CSS class that is used to map the root element of this control with the JavaScript class.
- [`$jsClass`](#$jsclass) &mdash; The name of the JavaScript class that handles the behavior of this control.
- [`$cssClass`](#$cssclass) &mdash; Extra CSS class(es) for the root element.

<a name="$clientsideproperties" id="$clientsideproperties"></a>
<a name="clientSideProperties" id="clientSideProperties"></a>
### `$clientSideProperties`

Holds the array of values that are passed to the UIControl JavaScript class.

#### Signature

- It is a `array` value.

<a name="$clientsideparameters" id="$clientsideparameters"></a>
<a name="clientSideParameters" id="clientSideParameters"></a>
### `$clientSideParameters`

Holds an array of values that are passed to the UIControl JavaScript class.

These values
differ from those in [$clientSideProperties](/api-reference/Piwik/View/UIControl#$clientsideproperties) in that they are meant to passed as
request parameters when the JavaScript code makes an AJAX request.

#### Signature

- It is a `array` value.

<a name="$cssidentifier" id="$cssidentifier"></a>
<a name="cssIdentifier" id="cssIdentifier"></a>
### `$cssIdentifier`

The CSS class that is used to map the root element of this control with the JavaScript class.

This field must be set prior to rendering.

#### Signature

- It is a `string` value.

<a name="$jsclass" id="$jsclass"></a>
<a name="jsClass" id="jsClass"></a>
### `$jsClass`

The name of the JavaScript class that handles the behavior of this control.

The JavaScript class must exist in the **piwik/UI** JavaScript module (so it will exist in
`window.piwik.UI`).

This field must be set prior to rendering.

#### Signature

- It is a `string` value.

<a name="$cssclass" id="$cssclass"></a>
<a name="cssClass" id="cssClass"></a>
### `$cssClass`

Extra CSS class(es) for the root element.

#### Signature

- It is a `string` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`__set()`](#__set) &mdash; Sets a variable.
- [`__get()`](#__get) &mdash; Gets a view variable.
- [`__isset()`](#__isset)
- [`render()`](#render) &mdash; Renders the control view within a containing <div> that is used by the UIControl JavaScript class.
- [`getTemplateVars()`](#gettemplatevars) &mdash; See View::getTemplateVars().

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature


<a name="__set" id="__set"></a>
<a name="__set" id="__set"></a>
### `__set()`

Sets a variable.

See View::\_\_set().

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$key` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The variable name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$val` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"> The variable value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="__get" id="__get"></a>
<a name="__get" id="__get"></a>
### `__get()`

Gets a view variable.

See View::\_\_get().

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$key` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The variable name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`mixed`) &mdash;
    <div markdown="1" class="param-desc">The variable value.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="__isset" id="__isset"></a>
<a name="__isset" id="__isset"></a>
### `__isset()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$key`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Renders the control view within a containing <div> that is used by the UIControl JavaScript class.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">Generated template.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="gettemplatevars" id="gettemplatevars"></a>
<a name="getTemplateVars" id="getTemplateVars"></a>
### `getTemplateVars()`

See View::getTemplateVars().

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$override` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Template variable override values. Mainly useful when including View templates in other templates.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `array` value.


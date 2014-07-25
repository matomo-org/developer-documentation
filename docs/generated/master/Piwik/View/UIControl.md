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

- [`$cssIdentifier`](#$cssidentifier) &mdash; The CSS class that is used to map the root element of this control with the JavaScript class.
- [`$jsClass`](#$jsclass) &mdash; The name of the JavaScript class that handles the behavior of this control.
- [`$jsNamespace`](#$jsnamespace) &mdash; The JavaScript module that contains the JavaScript class.
- [`$cssClass`](#$cssclass) &mdash; Extra CSS class(es) for the root element.

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

This field must be set prior to rendering.

#### Signature

- It is a `string` value.

<a name="$jsnamespace" id="$jsnamespace"></a>
<a name="jsNamespace" id="jsNamespace"></a>
### `$jsNamespace`

The JavaScript module that contains the JavaScript class.

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
- [`getTemplateFile()`](#gettemplatefile) &mdash; Returns the template filename.
- [`getTemplateVars()`](#gettemplatevars) &mdash; See View::getTemplateVars().
- [`__set()`](#__set) &mdash; Sets a variable.
- [`__get()`](#__get) &mdash; Gets a view variable.
- [`render()`](#render) &mdash; Renders the control view within a containing <div> that is used by the UIControl JavaScript class.
- [`setContentType()`](#setcontenttype) &mdash; Set stored value used in the Content-Type HTTP header field.
- [`setXFrameOptions()`](#setxframeoptions) &mdash; Set X-Frame-Options field in the HTTP response.
- [`singleReport()`](#singlereport) &mdash; Creates a View for and then renders the single report template.
- [`__isset()`](#__isset)
- [`getClientSideProperties()`](#getclientsideproperties) &mdash; Returns the array of property names whose values are passed to the UIControl JavaScript class.
- [`getClientSideParameters()`](#getclientsideparameters) &mdash; Returns an array of property names whose values are passed to the UIControl JavaScript class.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature


<a name="gettemplatefile" id="gettemplatefile"></a>
<a name="getTemplateFile" id="getTemplateFile"></a>
### `getTemplateFile()`

Returns the template filename.

#### Signature

- It returns a `string` value.

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

<a name="setcontenttype" id="setcontenttype"></a>
<a name="setContentType" id="setContentType"></a>
### `setContentType()`

Set stored value used in the Content-Type HTTP header field.

The header is
set just before rendering.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$contentType` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setxframeoptions" id="setxframeoptions"></a>
<a name="setXFrameOptions" id="setXFrameOptions"></a>
### `setXFrameOptions()`

Set X-Frame-Options field in the HTTP response.

The header is set just
before rendering.

_Note: setting this allows you to make sure the View **cannot** be
embedded in iframes. Learn more [here](https://developer.mozilla.org/en-US/docs/HTTP/X-Frame-Options)._

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$option` (`string`) &mdash;

      <div markdown="1" class="param-desc"> ('deny' or 'sameorigin')</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="singlereport" id="singlereport"></a>
<a name="singleReport" id="singleReport"></a>
### `singleReport()`

Creates a View for and then renders the single report template.

Can be used for pages that display only one report to avoid having to create
a new template.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$title` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The report title.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$reportHtml` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The report body HTML.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`|`void`) &mdash;
    <div markdown="1" class="param-desc">The report contents if `$fetch` is true.</div>

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

<a name="getclientsideproperties" id="getclientsideproperties"></a>
<a name="getClientSideProperties" id="getClientSideProperties"></a>
### `getClientSideProperties()`

Returns the array of property names whose values are passed to the UIControl JavaScript class.

Should be overriden by descendants.

#### Signature

- It returns a `array` value.

<a name="getclientsideparameters" id="getclientsideparameters"></a>
<a name="getClientSideParameters" id="getClientSideParameters"></a>
### `getClientSideParameters()`

Returns an array of property names whose values are passed to the UIControl JavaScript class.

These values differ from those in $clientSideProperties in that they are meant to passed as
request parameters when the JavaScript code makes an AJAX request.

Should be overriden by descendants.

#### Signature

- It returns a `array` value.


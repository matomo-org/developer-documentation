<small>Piwik\View\</small>

UIControl
=========

Base type of UI controls.

The JavaScript companion class can be found in plugins/CoreHome/javascripts/uiControl.js.

Constants
---------

This class defines the following constants:

- [`TEMPLATE`](#template) — The Twig template file that generates the control's HTML.
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
- [`$htmlAttributes`](#$htmlattributes) &mdash; HTML Attributes for the root element

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

<a name="$htmlattributes" id="$htmlattributes"></a>
<a name="htmlAttributes" id="htmlAttributes"></a>
### `$htmlAttributes`

HTML Attributes for the root element

#### Signature

- It is a `string` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`disableCacheBuster()`](#disablecachebuster) &mdash; Disables the cache buster (adding of ?cb=. Inherited from [`View`](../../Piwik/View.md)
- [`getTemplateFile()`](#gettemplatefile) &mdash; Returns the template filename. Inherited from [`View`](../../Piwik/View.md)
- [`getTemplateVars()`](#gettemplatevars) &mdash; See View::getTemplateVars().
- [`__set()`](#__set) &mdash; Sets a variable.
- [`__get()`](#__get) &mdash; Gets a view variable.
- [`__isset()`](#__isset) &mdash; Returns true if a template variable has been set or not.
- [`__unset()`](#__unset) &mdash; Unsets a template variable. Inherited from [`View`](../../Piwik/View.md)
- [`render()`](#render) &mdash; Renders the control view within a containing <div> that is used by the UIControl JavaScript class.
- [`setContentType()`](#setcontenttype) &mdash; Set stored value used in the Content-Type HTTP header field. Inherited from [`View`](../../Piwik/View.md)
- [`setXFrameOptions()`](#setxframeoptions) &mdash; Set X-Frame-Options field in the HTTP response. Inherited from [`View`](../../Piwik/View.md)
- [`singleReport()`](#singlereport) &mdash; Creates a View for and then renders the single report template. Inherited from [`View`](../../Piwik/View.md)
- [`getUseStrictReferrerPolicy()`](#getusestrictreferrerpolicy) &mdash; Returns whether a strict Referrer-Policy header will be sent. Inherited from [`View`](../../Piwik/View.md)
- [`setUseStrictReferrerPolicy()`](#setusestrictreferrerpolicy) &mdash; Sets whether a strict Referrer-Policy header will be sent (if not, nothing is sent). Inherited from [`View`](../../Piwik/View.md)
- [`getClientSideProperties()`](#getclientsideproperties) &mdash; Returns the array of property names whose values are passed to the UIControl JavaScript class.
- [`getClientSideParameters()`](#getclientsideparameters) &mdash; Returns an array of property names whose values are passed to the UIControl JavaScript class.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature


<a name="disablecachebuster" id="disablecachebuster"></a>
<a name="disableCacheBuster" id="disableCacheBuster"></a>
### `disableCacheBuster()`

Disables the cache buster (adding of ?cb=.

..) to JavaScript and stylesheet files

#### Signature

- It does not return anything or a mixed result.

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
    - `$override` (`array`) &mdash;
       Template variable override values. Mainly useful when including View templates in other templates.
- It returns a `array` value.

<a name="__set" id="__set"></a>
<a name="__set" id="__set"></a>
### `__set()`

Sets a variable. See View::\_\_set().

#### Signature

-  It accepts the following parameter(s):
    - `$key` (`string`) &mdash;
       The variable name.
    - `$val` (`mixed`) &mdash;
       The variable value.
- It does not return anything or a mixed result.

<a name="__get" id="__get"></a>
<a name="__get" id="__get"></a>
### `__get()`

Gets a view variable. See View::\_\_get().

#### Signature

-  It accepts the following parameter(s):
    - `$key` (`string`) &mdash;
       The variable name.

- *Returns:*  `mixed` &mdash;
    The variable value.

<a name="__isset" id="__isset"></a>
<a name="__isset" id="__isset"></a>
### `__isset()`

Returns true if a template variable has been set or not.

#### Signature

-  It accepts the following parameter(s):
    - `$key`
      
- It returns a `bool` value.

<a name="__unset" id="__unset"></a>
<a name="__unset" id="__unset"></a>
### `__unset()`

Unsets a template variable.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The name of the template variable.
- It does not return anything or a mixed result.

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Renders the control view within a containing <div> that is used by the UIControl JavaScript
class.

#### Signature


- *Returns:*  `string` &mdash;
    Serialized data, eg, (image, array, html...).

<a name="setcontenttype" id="setcontenttype"></a>
<a name="setContentType" id="setContentType"></a>
### `setContentType()`

Set stored value used in the Content-Type HTTP header field. The header is
set just before rendering.

#### Signature

-  It accepts the following parameter(s):
    - `$contentType` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="setxframeoptions" id="setxframeoptions"></a>
<a name="setXFrameOptions" id="setXFrameOptions"></a>
### `setXFrameOptions()`

Set X-Frame-Options field in the HTTP response. The header is set just
before rendering.

_Note: setting this allows you to make sure the View **cannot** be
embedded in iframes. Learn more [here](https://developer.mozilla.org/en-US/docs/HTTP/X-Frame-Options)._

#### Signature

-  It accepts the following parameter(s):
    - `$option` (`string`) &mdash;
       ('deny' or 'sameorigin')
- It does not return anything or a mixed result.

<a name="singlereport" id="singlereport"></a>
<a name="singleReport" id="singleReport"></a>
### `singleReport()`

Creates a View for and then renders the single report template.

Can be used for pages that display only one report to avoid having to create
a new template.

#### Signature

-  It accepts the following parameter(s):
    - `$title` (`string`) &mdash;
       The report title.
    - `$reportHtml` (`string`) &mdash;
       The report body HTML.

- *Returns:*  `string`|`void` &mdash;
    The report contents if `$fetch` is true.

<a name="getusestrictreferrerpolicy" id="getusestrictreferrerpolicy"></a>
<a name="getUseStrictReferrerPolicy" id="getUseStrictReferrerPolicy"></a>
### `getUseStrictReferrerPolicy()`

Returns whether a strict Referrer-Policy header will be sent. Generally this should be set to 'true'.

#### Signature

- It returns a `bool` value.

<a name="setusestrictreferrerpolicy" id="setusestrictreferrerpolicy"></a>
<a name="setUseStrictReferrerPolicy" id="setUseStrictReferrerPolicy"></a>
### `setUseStrictReferrerPolicy()`

Sets whether a strict Referrer-Policy header will be sent (if not, nothing is sent).

#### Signature

-  It accepts the following parameter(s):
    - `$useStrictReferrerPolicy` (`bool`) &mdash;
      
- It does not return anything or a mixed result.

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


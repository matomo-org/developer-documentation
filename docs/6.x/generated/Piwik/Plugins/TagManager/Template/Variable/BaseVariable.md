<small>Piwik\Plugins\TagManager\Template\Variable\</small>

BaseVariable
============

Properties
----------

This abstract class defines the following properties:

- [`$RESERVED_SETTING_NAMES`](#$reserved_setting_names) Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)

<a name="$reserved_setting_names" id="$reserved_setting_names"></a>
<a name="RESERVED_SETTING_NAMES" id="RESERVED_SETTING_NAMES"></a>
### `$RESERVED_SETTING_NAMES`

#### Signature

- Its type is not specified.


Methods
-------

The abstract class defines the following methods:

- [`getId()`](#getid) &mdash; Get the ID of this template. Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)
- [`getParameters()`](#getparameters) &mdash; Get the list of parameters that can be configured for this template. Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)
- [`getCategory()`](#getcategory)
- [`getSupportedContexts()`](#getsupportedcontexts)
- [`getName()`](#getname) &mdash; Get the translated name of this template. Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)
- [`getDescription()`](#getdescription) &mdash; Get the translated description of this template. Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)
- [`getHelp()`](#gethelp) &mdash; Get the translated help text for this template. Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)
- [`getOrder()`](#getorder) &mdash; Get the order for this template. Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)
- [`getIcon()`](#geticon) &mdash; Get the image icon url. Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)
- [`hasAdvancedSettings()`](#hasadvancedsettings) &mdash; Lets you hide the advanced settings tab in the UI. Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)
- [`isCustomTemplate()`](#iscustomtemplate) &mdash; If your template allows a user to add js/html code to the site for example, you should be overwriting this method and return `true`. Inherited from [`BaseTemplate`](../../../../../Piwik/Plugins/TagManager/Template/BaseTemplate.md)
- [`isPreConfigured()`](#ispreconfigured) &mdash; Defines whether this variable is a preconfigured variable which cannot be configured and is ready to use.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Get the ID of this template.

The ID is by default automatically generated from the class name, but can be customized by returning a string.

#### Signature

- It returns a `string` value.

<a name="getparameters" id="getparameters"></a>
<a name="getParameters" id="getParameters"></a>
### `getParameters()`

Get the list of parameters that can be configured for this template.

#### Signature

- It returns a [`Setting[]`](../../../../../Piwik/Settings/Setting.md) value.

<a name="getcategory" id="getcategory"></a>
<a name="getCategory" id="getCategory"></a>
### `getCategory()`

#### Signature

- It returns a `string` value.

<a name="getsupportedcontexts" id="getsupportedcontexts"></a>
<a name="getSupportedContexts" id="getSupportedContexts"></a>
### `getSupportedContexts()`

#### Signature

- It returns a `string[]` value.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Get the translated name of this template.

#### Signature

- It returns a `string` value.

<a name="getdescription" id="getdescription"></a>
<a name="getDescription" id="getDescription"></a>
### `getDescription()`

Get the translated description of this template.

#### Signature

- It returns a `string` value.

<a name="gethelp" id="gethelp"></a>
<a name="getHelp" id="getHelp"></a>
### `getHelp()`

Get the translated help text for this template.

#### Signature

- It returns a `string` value.

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

Get the order for this template. The lower the order is, the higher in the list the template will be shown.

#### Signature

- It returns a `int` value.

<a name="geticon" id="geticon"></a>
<a name="getIcon" id="getIcon"></a>
### `getIcon()`

Get the image icon url. We could also use data:uris to return the amount of requests to load a page like this:
return 'data:image/svg+xml;base64,' . base64_encode('<svg.

..</svg>');
However, we prefer the files since we can better define them in the legal notice.

#### Signature

- It returns a `string` value.

<a name="hasadvancedsettings" id="hasadvancedsettings"></a>
<a name="hasAdvancedSettings" id="hasAdvancedSettings"></a>
### `hasAdvancedSettings()`

Lets you hide the advanced settings tab in the UI.

#### Signature

- It returns a `bool` value.

<a name="iscustomtemplate" id="iscustomtemplate"></a>
<a name="isCustomTemplate" id="isCustomTemplate"></a>
### `isCustomTemplate()`

If your template allows a user to add js/html code to the site for example, you should be overwriting this
method and return `true`.

#### Signature

- It returns a `bool` value.

<a name="ispreconfigured" id="ispreconfigured"></a>
<a name="isPreConfigured" id="isPreConfigured"></a>
### `isPreConfigured()`

Defines whether this variable is a preconfigured variable which cannot be configured and is ready to use.

#### Signature

- It returns a `bool` value.


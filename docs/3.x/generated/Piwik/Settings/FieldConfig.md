<small>Piwik\Settings\</small>

FieldConfig
===========

Lets you configure a form field.

Constants
---------

This class defines the following constants:

- [`UI_CONTROL_RADIO`](#ui_control_radio) — Shows a radio field.- [`UI_CONTROL_TEXT`](#ui_control_text) — Shows a text field.- [`UI_CONTROL_EMAIL`](#ui_control_email) — Shows an email text field.- [`UI_CONTROL_URL`](#ui_control_url) — Shows a URL text field.- [`UI_CONTROL_TEXTAREA`](#ui_control_textarea) — Shows a text area.- [`UI_CONTROL_CHECKBOX`](#ui_control_checkbox) — Shows a checkbox.- [`UI_CONTROL_PASSWORD`](#ui_control_password) — Shows a password field.- [`UI_CONTROL_MULTI_SELECT`](#ui_control_multi_select) — Shows a select field where a user can select multiple values.- [`UI_CONTROL_SINGLE_SELECT`](#ui_control_single_select) — Shows a select field.- [`UI_CONTROL_SINGLE_EXPANDABLE_SELECT`](#ui_control_single_expandable_select) — Shows an expandable select field which is useful when each selectable value belongs to a group.- [`UI_CONTROL_HIDDEN`](#ui_control_hidden) — Generates a hidden form field.- [`TYPE_INT`](#type_int) — Expects an integer value.- [`TYPE_FLOAT`](#type_float) — Expects a float value.- [`TYPE_STRING`](#type_string) — Expects a string.- [`TYPE_BOOL`](#type_bool) — Expects a boolean.
<a name="ui_control_radio" id="ui_control_radio"></a>
<a name="UI_CONTROL_RADIO" id="UI_CONTROL_RADIO"></a>
### `UI_CONTROL_RADIO`

To use this field assign it to the `$uiControl` property.
<a name="ui_control_text" id="ui_control_text"></a>
<a name="UI_CONTROL_TEXT" id="UI_CONTROL_TEXT"></a>
### `UI_CONTROL_TEXT`

To use this field assign it to the `$uiControl` property.
<a name="ui_control_email" id="ui_control_email"></a>
<a name="UI_CONTROL_EMAIL" id="UI_CONTROL_EMAIL"></a>
### `UI_CONTROL_EMAIL`

To use this field assign it to the `$uiControl` property.
<a name="ui_control_url" id="ui_control_url"></a>
<a name="UI_CONTROL_URL" id="UI_CONTROL_URL"></a>
### `UI_CONTROL_URL`

To use this field assign it to the `$uiControl` property.
<a name="ui_control_textarea" id="ui_control_textarea"></a>
<a name="UI_CONTROL_TEXTAREA" id="UI_CONTROL_TEXTAREA"></a>
### `UI_CONTROL_TEXTAREA`

To use this field assign it to the `$uiControl` property.
<a name="ui_control_checkbox" id="ui_control_checkbox"></a>
<a name="UI_CONTROL_CHECKBOX" id="UI_CONTROL_CHECKBOX"></a>
### `UI_CONTROL_CHECKBOX`

To use this field assign it to the `$uiControl` property.
<a name="ui_control_password" id="ui_control_password"></a>
<a name="UI_CONTROL_PASSWORD" id="UI_CONTROL_PASSWORD"></a>
### `UI_CONTROL_PASSWORD`

To use this field assign it to the `$uiControl` property.
<a name="ui_control_multi_select" id="ui_control_multi_select"></a>
<a name="UI_CONTROL_MULTI_SELECT" id="UI_CONTROL_MULTI_SELECT"></a>
### `UI_CONTROL_MULTI_SELECT`

The type "Array" is required for this ui control. To use this field assign it to the `$uiControl` property.
<a name="ui_control_single_select" id="ui_control_single_select"></a>
<a name="UI_CONTROL_SINGLE_SELECT" id="UI_CONTROL_SINGLE_SELECT"></a>
### `UI_CONTROL_SINGLE_SELECT`

To use this field assign it to the `$uiControl` property.
<a name="ui_control_single_expandable_select" id="ui_control_single_expandable_select"></a>
<a name="UI_CONTROL_SINGLE_EXPANDABLE_SELECT" id="UI_CONTROL_SINGLE_EXPANDABLE_SELECT"></a>
### `UI_CONTROL_SINGLE_EXPANDABLE_SELECT`

To use this field assign it to the `$uiControl` property.
<a name="ui_control_hidden" id="ui_control_hidden"></a>
<a name="UI_CONTROL_HIDDEN" id="UI_CONTROL_HIDDEN"></a>
### `UI_CONTROL_HIDDEN`

To use this field assign it to the `$uiControl` property.
<a name="type_int" id="type_int"></a>
<a name="TYPE_INT" id="TYPE_INT"></a>
### `TYPE_INT`

Is usually used when creating a setting.
<a name="type_float" id="type_float"></a>
<a name="TYPE_FLOAT" id="TYPE_FLOAT"></a>
### `TYPE_FLOAT`

Is usually used when creating a setting.
<a name="type_string" id="type_string"></a>
<a name="TYPE_STRING" id="TYPE_STRING"></a>
### `TYPE_STRING`

Is usually used when creating a setting.
<a name="type_bool" id="type_bool"></a>
<a name="TYPE_BOOL" id="TYPE_BOOL"></a>
### `TYPE_BOOL`

Is usually used when creating a setting.

Properties
----------

This class defines the following properties:

- [`$uiControl`](#$uicontrol) &mdash; Describes what HTML element should be used to manipulate the setting through Piwik's UI.
- [`$customUiControlTemplateFile`](#$customuicontroltemplatefile) &mdash; Defines a custom template file for a UI control.
- [`$uiControlAttributes`](#$uicontrolattributes) &mdash; Name-value mapping of HTML attributes that will be added HTML form control, eg, `array('size' => 3)`.
- [`$availableValues`](#$availablevalues) &mdash; The list of all available values for this setting.
- [`$introduction`](#$introduction) &mdash; Text that will appear above this setting's section in the _Plugin Settings_ admin page.
- [`$description`](#$description) &mdash; Text that will appear directly underneath the setting title in the _Plugin Settings_ admin page.
- [`$inlineHelp`](#$inlinehelp) &mdash; Text that will appear next to the setting's section in the _Plugin Settings_ admin page.
- [`$validate`](#$validate) &mdash; A closure that does some custom validation on the setting before the setting is persisted.
- [`$transform`](#$transform) &mdash; A closure that transforms the setting value.
- [`$title`](#$title) &mdash; This setting's display name, for example, `'Refresh Interval'`.
- [`$condition`](#$condition) &mdash; Here you can define conditions so that certain form fields will be only shown when a certain condition is true.
- [`$validators`](#$validators) &mdash; Here you can add one or multiple instances of `Piwik\Validators\BaseValidator` to avoid having to write the same validators over and over again in [$validate](/api-reference/Piwik/Settings/FieldConfig#$validate).

<a name="$uicontrol" id="$uicontrol"></a>
<a name="uiControl" id="uiControl"></a>
### `$uiControl`

Describes what HTML element should be used to manipulate the setting through Piwik's UI.

See Piwik\Plugin\Settings for a list of supported control types.

#### Signature

- It is a `string` value.

<a name="$customuicontroltemplatefile" id="$customuicontroltemplatefile"></a>
<a name="customUiControlTemplateFile" id="customUiControlTemplateFile"></a>
### `$customUiControlTemplateFile`

Defines a custom template file for a UI control.

This file should render a UI control and expose the value in a
"formField.value" angular model. For an example see "plugins/CorePluginsAdmin/angularjs/form-field/field-text.html"

#### Signature

- It is a `string` value.

<a name="$uicontrolattributes" id="$uicontrolattributes"></a>
<a name="uiControlAttributes" id="uiControlAttributes"></a>
### `$uiControlAttributes`

Name-value mapping of HTML attributes that will be added HTML form control, eg, `array('size' => 3)`.

Attributes will be escaped before outputting.

#### Signature

- It is a `array` value.

<a name="$availablevalues" id="$availablevalues"></a>
<a name="availableValues" id="availableValues"></a>
### `$availableValues`

The list of all available values for this setting.

If null, the setting can have any value.

If supplied, this field should be an array mapping available values with their prettified
display value. Eg, if set to `array('nb_visits' => 'Visits', 'nb_actions' => 'Actions')`,
the UI will display **Visits** and **Actions**, and when the user selects one, Piwik will
set the setting to **nb_visits** or **nb_actions** respectively.

The setting value will be validated if this field is set. If the value is not one of the
available values, an error will be triggered.

_Note: If a custom validator is supplied (see [$validate](/api-reference/Piwik/Settings/FieldConfig#$validate)), the setting value will
not be validated._

#### Signature

- It can be one of the following types:
    - `null`
    - `array`

<a name="$introduction" id="$introduction"></a>
<a name="introduction" id="introduction"></a>
### `$introduction`

Text that will appear above this setting's section in the _Plugin Settings_ admin page.

#### Signature

- It can be one of the following types:
    - `null`
    - `string`

<a name="$description" id="$description"></a>
<a name="description" id="description"></a>
### `$description`

Text that will appear directly underneath the setting title in the _Plugin Settings_ admin page.

If set, should be a short description of the setting.

#### Signature

- It can be one of the following types:
    - `null`
    - `string`

<a name="$inlinehelp" id="$inlinehelp"></a>
<a name="inlineHelp" id="inlineHelp"></a>
### `$inlineHelp`

Text that will appear next to the setting's section in the _Plugin Settings_ admin page.

If set,
it should contain information about the setting that is more specific than a general description,
such as the format of the setting value if it has a special format.

Be sure to escape any user input as HTML can be used here.

#### Signature

- It can be one of the following types:
    - `null`
    - `string`

<a name="$validate" id="$validate"></a>
<a name="validate" id="validate"></a>
### `$validate`

A closure that does some custom validation on the setting before the setting is persisted.

The closure should take two arguments: the setting value and the [Setting](/api-reference/Piwik/Settings/Setting) instance being
validated. If the value is found to be invalid, the closure should throw an exception with
a message that describes the error.

**Example**

    $setting->validate = function ($value, Setting $setting) {
        if ($value > 60) {
            throw new \Exception('The time limit is not allowed to be greater than 60 minutes.');
        }
    }

#### Signature

- It can be one of the following types:
    - `null`
    - [`Closure`](http://php.net/class.Closure)

<a name="$transform" id="$transform"></a>
<a name="transform" id="transform"></a>
### `$transform`

A closure that transforms the setting value.

If supplied, this closure will be executed after
the setting has been validated.

_Note: If a transform is supplied, the setting's $type has no effect. This means the
transformation function will be responsible for casting the setting value to the appropriate
data type._

**Example**

    $setting->transform = function ($value, Setting $setting) {
        if ($value > 30) {
            $value = 30;
        }

        return (int) $value;
    }

#### Signature

- It can be one of the following types:
    - `null`
    - [`Closure`](http://php.net/class.Closure)

<a name="$title" id="$title"></a>
<a name="title" id="title"></a>
### `$title`

This setting's display name, for example, `'Refresh Interval'`.

Be sure to escape any user input as HTML can be used here.

#### Signature

- It is a `string` value.

<a name="$condition" id="$condition"></a>
<a name="condition" id="condition"></a>
### `$condition`

Here you can define conditions so that certain form fields will be only shown when a certain condition is true.

This condition is supposed to be evaluated on the client side dynamically. This way you can hide
for example some fields depending on another field. For example if SiteSearch is disabled, fields to enter
site search keywords is not needed anymore and can be disabled.

For example 'sitesearch', or 'sitesearch && !use_sitesearch_default' where 'sitesearch' and 'use_sitesearch_default'
are both values of fields.

#### Signature

- It is a `string` value.

<a name="$validators" id="$validators"></a>
<a name="validators" id="validators"></a>
### `$validators`

Here you can add one or multiple instances of `Piwik\Validators\BaseValidator` to avoid having to write the same validators over and over again in [$validate](/api-reference/Piwik/Settings/FieldConfig#$validate).

Examples
Want to require a value to be set?
$fieldConfig->validators[] = new Piwik\Validators\NotEmpty();

Want to require an email?
$fieldConfig->validators[] = new Piwik\Validators\NotEmpty();
$fieldConfig->validators[] = new Piwik\Validators\Email();

The core comes with a set of various validators that can be used.

#### Signature

- It is a `Piwik\Validators\BaseValidator` value.

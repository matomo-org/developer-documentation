<small>Piwik\Settings\FieldConfig\</small>

ArrayField
==========

Lets you configure a field for a field array.

Usage:

$field->uiControl = FieldConfig::UI_CONTROL_FIELD_ARRAY;
$arrayField = new FieldConfig\ArrayField('Index', FieldConfig::UI_CONTROL_TEXT);
$field->uiControlAttributes['field'] = $field->toArray();

Properties
----------

This class defines the following properties:

- [`$uiControl`](#$uicontrol) &mdash; Describes what HTML element should be used to manipulate the setting through Piwik's UI.
- [`$customUiControlTemplateFile`](#$customuicontroltemplatefile) &mdash; Defines a custom template file for a UI control.
- [`$title`](#$title) &mdash; This setting's display name, for example, `'Refresh Interval'`.
- [`$availableValues`](#$availablevalues) &mdash; The list of all available values for this setting.

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

<a name="$title" id="$title"></a>
<a name="title" id="title"></a>
### `$title`

This setting's display name, for example, `'Refresh Interval'`.

Be sure to escape any user input as HTML can be used here.

#### Signature

- It is a `string` value.

<a name="$availablevalues" id="$availablevalues"></a>
<a name="availableValues" id="availableValues"></a>
### `$availableValues`

The list of all available values for this setting.

If null, the setting can have any value.

If supplied, this field should be an array mapping available values with their prettified
display value. Eg, if set to `array('nb_visits' => 'Visits', 'nb_actions' => 'Actions')`,
the UI will display **Visits** and **Actions**, and when the user selects one, Piwik will
set the setting to **nb_visits** or **nb_actions** respectively.

#### Signature

- It can be one of the following types:
    - `null`
    - `array`

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`toArray()`](#toarray)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$title`
      
    - `$uiControl`
      

<a name="toarray" id="toarray"></a>
<a name="toArray" id="toArray"></a>
### `toArray()`

#### Signature

- It does not return anything.


<small>Piwik\Settings\FieldConfig\</small>

MultiPair
=========

Lets you configure a multi pair field.

Usage:

$field->uiControl = FieldConfig::UI_CONTROL_MULTI_PAIR;
$field1 = new FieldConfig\MultiPair('Index', 'index', FieldConfig::UI_CONTROL_TEXT);
$field2 = new FieldConfig\MultiPair('Value', 'value', FieldConfig::UI_CONTROL_TEXT);
$field->uiControlAttributes['field1'] = $field1->toArray();
$field->uiControlAttributes['field2'] = $field2->toArray();

Properties
----------

This class defines the following properties:

- [`$key`](#$key) &mdash; The name of the key the index should have eg "dimension" will make an index array(array('dimension' => '...'))
- [`$uiControl`](#$uicontrol) &mdash; Describes what HTML element should be used to manipulate the setting through Piwik's UI.
- [`$customUiControlTemplateFile`](#$customuicontroltemplatefile) &mdash; Defines a custom template file for a UI control.
- [`$title`](#$title) &mdash; This setting's display name, for example, `'Refresh Interval'`.
- [`$availableValues`](#$availablevalues) &mdash; The list of all available values for this setting.

<a name="$key" id="$key"></a>
<a name="key" id="key"></a>
### `$key`

The name of the key the index should have eg "dimension" will make an index array(array('dimension' => '...'))

#### Signature

- It is a `string` value.

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
      
    - `$key`
      
    - `$uiControl`
      

<a name="toarray" id="toarray"></a>
<a name="toArray" id="toArray"></a>
### `toArray()`

#### Signature

- It does not return anything.


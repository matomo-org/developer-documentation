<small>Piwik\Plugins\Events\Widgets\</small>

EventsByDimension
=================

Methods
-------

The class defines the following methods:

- [`setId()`](#setid) &mdash; Sets (overwrites) the id of the widget container. Inherited from [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md)
- [`getId()`](#getid) &mdash; Get the id of the widget. Inherited from [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md)
- [`setLayout()`](#setlayout) &mdash; Sets the layout of the container widget. Inherited from [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md)
- [`getLayout()`](#getlayout) &mdash; Gets the currently set layout. Inherited from [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md)
- [`addWidgetConfig()`](#addwidgetconfig) &mdash; Adds a new widget to the container widget. Inherited from [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md)
- [`getWidgetConfigs()`](#getwidgetconfigs) &mdash; Get all added widget configs. Inherited from [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md)
- [`getUniqueId()`](#getuniqueid) Inherited from [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md)
- [`getParameters()`](#getparameters) Inherited from [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md)

<a name="setid" id="setid"></a>
<a name="setId" id="setId"></a>
### `setId()`

Sets (overwrites) the id of the widget container.

The id can be used by any plugins to add more widgets to this container and it will be also used for the unique
widget id and in the URL to render this widget.

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`string`) &mdash;
       eg 'Products' or 'Contents'
- It returns a [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md) value.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Get the id of the widget.

#### Signature

- It returns a `string` value.

<a name="setlayout" id="setlayout"></a>
<a name="setLayout" id="setLayout"></a>
### `setLayout()`

Sets the layout of the container widget.

By default widgets within a container are displayed one after another. In case you want to change this
behaviour you can specify a layout that will be recognized by the UI. It is not yet possible to define
custom layouts.

#### Signature

-  It accepts the following parameter(s):
    - `$layout` (`string`) &mdash;
       eg 'ByDimension' see Piwik\Plugins\CoreHome\CoreHome::WIDGET\_CONTAINER\_LAYOUT\_BY\_DIMENSION
- It returns a [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md) value.

<a name="getlayout" id="getlayout"></a>
<a name="getLayout" id="getLayout"></a>
### `getLayout()`

Gets the currently set layout.

#### Signature

- It returns a `string` value.

<a name="addwidgetconfig" id="addwidgetconfig"></a>
<a name="addWidgetConfig" id="addWidgetConfig"></a>
### `addWidgetConfig()`

Adds a new widget to the container widget.

#### Signature

-  It accepts the following parameter(s):
    - `$widget` ([`WidgetConfig`](../../../../Piwik/Widget/WidgetConfig.md)) &mdash;
      
- It returns a [`WidgetContainerConfig`](../../../../Piwik/Widget/WidgetContainerConfig.md) value.

<a name="getwidgetconfigs" id="getwidgetconfigs"></a>
<a name="getWidgetConfigs" id="getWidgetConfigs"></a>
### `getWidgetConfigs()`

Get all added widget configs.

#### Signature

- It returns a [`WidgetConfig[]`](../../../../Piwik/Widget/WidgetConfig.md) value.

<a name="getuniqueid" id="getuniqueid"></a>
<a name="getUniqueId" id="getUniqueId"></a>
### `getUniqueId()`

#### Signature

- It returns a `string` value.

<a name="getparameters" id="getparameters"></a>
<a name="getParameters" id="getParameters"></a>
### `getParameters()`

#### Signature


- *Returns:*  `array` &mdash;
    Eg ('urlparam' => 'urlvalue').


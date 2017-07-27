<small>Piwik\Widget\</small>

WidgetsList
===========

Manages the global list of reports that can be displayed as dashboard widgets.

Widgets are added through the [WidgetsList.addWidgets](/api-reference/events#widgetslistaddwidgets) and filtered through the [Widgets.filterWidgets](/api-reference/events#widgetsfilterwidgets)
event. Observers for this event should call the addWidget() method to add widgets or use any of the other
methods to remove widgets.

Methods
-------

The class defines the following methods:

- [`addWidgetConfig()`](#addwidgetconfig) &mdash; Adds a new widget to the widget config.
- [`addWidgetConfigs()`](#addwidgetconfigs) &mdash; Add multiple widget configs at once.
- [`getWidgetConfigs()`](#getwidgetconfigs) &mdash; Get all added widget configs.
- [`addToContainerWidget()`](#addtocontainerwidget) &mdash; Add a widget to a widget container.
- [`remove()`](#remove) &mdash; Removes one or more widgets from the widget list.
- [`isDefined()`](#isdefined) &mdash; Returns `true` if a widget exists in the widget list, `false` if otherwise.
- [`getWidgetUniqueId()`](#getwidgetuniqueid) &mdash; CAUTION! If you ever change this method, existing updates will fail as they currently use that method! If you change the output the uniqueId for existing widgets would not be found anymore

<a name="addwidgetconfig" id="addwidgetconfig"></a>
<a name="addWidgetConfig" id="addWidgetConfig"></a>
### `addWidgetConfig()`

Adds a new widget to the widget config.

Please make sure the widget is enabled before adding a widget as
no such checks will be performed.

#### Signature

-  It accepts the following parameter(s):
    - `$widget` ([`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md)) &mdash;
      
- It does not return anything.

<a name="addwidgetconfigs" id="addwidgetconfigs"></a>
<a name="addWidgetConfigs" id="addWidgetConfigs"></a>
### `addWidgetConfigs()`

Add multiple widget configs at once.

See [addWidgetConfig()](/api-reference/Piwik/Widget/WidgetsList#addwidgetconfig).

#### Signature

-  It accepts the following parameter(s):
    - `$widgets` ([`WidgetConfig[]`](../../Piwik/Widget/WidgetConfig.md)) &mdash;
      
- It does not return anything.

<a name="getwidgetconfigs" id="getwidgetconfigs"></a>
<a name="getWidgetConfigs" id="getWidgetConfigs"></a>
### `getWidgetConfigs()`

Get all added widget configs.

#### Signature

- It returns a [`WidgetConfig[]`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="addtocontainerwidget" id="addtocontainerwidget"></a>
<a name="addToContainerWidget" id="addToContainerWidget"></a>
### `addToContainerWidget()`

Add a widget to a widget container.

It doesn't matter whether the container was added to this list already
or whether the container is added later. As long as a container having the same containerId is added at
some point the widget will be added to that container. If no container having this id is added the widget
will not be recognized.

#### Signature

-  It accepts the following parameter(s):
    - `$containerId` (`string`) &mdash;
       eg 'Products' or 'Contents'. See WidgetContainerConfig::setId
    - `$widget` ([`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md)) &mdash;
      
- It does not return anything.

<a name="remove" id="remove"></a>
<a name="remove" id="remove"></a>
### `remove()`

Removes one or more widgets from the widget list.

#### Signature

-  It accepts the following parameter(s):
    - `$widgetCategoryId` (`string`) &mdash;
       The widget category id. Can be a translation token eg 'General_Visits' see [WidgetConfig::setCategoryId()](/api-reference/Piwik/Widget/WidgetConfig#setcategoryid).
    - `$widgetName` (`string`|`Piwik\Widget\false`) &mdash;
       The name of the widget to remove eg 'VisitTime_ByServerTimeWidgetName'. If not supplied, all widgets within that category will be removed.
- It does not return anything.

<a name="isdefined" id="isdefined"></a>
<a name="isDefined" id="isDefined"></a>
### `isDefined()`

Returns `true` if a widget exists in the widget list, `false` if otherwise.

#### Signature

-  It accepts the following parameter(s):
    - `$module` (`string`) &mdash;
       The controller name of the widget.
    - `$action` (`string`) &mdash;
       The controller action of the widget.
- It returns a `bool` value.

<a name="getwidgetuniqueid" id="getwidgetuniqueid"></a>
<a name="getWidgetUniqueId" id="getWidgetUniqueId"></a>
### `getWidgetUniqueId()`

CAUTION! If you ever change this method, existing updates will fail as they currently use that method! If you change the output the uniqueId for existing widgets would not be found anymore

Returns the unique id of an widget with the given parameters

#### Signature

-  It accepts the following parameter(s):
    - `$controllerName` (`Piwik\Widget\$controllerName`) &mdash;
      
    - `$controllerAction` (`Piwik\Widget\$controllerAction`) &mdash;
      
    - `$customParameters` (`array`) &mdash;
      
- It returns a `string` value.


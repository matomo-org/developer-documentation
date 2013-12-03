<small>Piwik</small>

WidgetsList
===========

Manages the global list of reports that can be displayed as dashboard widgets.

Description
-----------

Reports are added as dashboard widgets through the [WidgetsList.addWidgets](/api-reference/hooks#widgetslistaddwidgets)
event. Plugins should call [add()](/api-reference/Piwik/WidgetsList#add) in event observers for this event.

Methods
-------

The class defines the following methods:

- [`get()`](#get) &mdash; Returns all available widgets.
- [`add()`](#add) &mdash; Adds a report to the list of dashboard widgets.
- [`remove()`](#remove) &mdash; Removes one more widgets from the widget list.
- [`isDefined()`](#isdefined) &mdash; Returns true if the widget with the given parameters exists in the widget list, false if otherwise.

<a name="get" id="get"></a>
<a name="get" id="get"></a>
### `get()`

Returns all available widgets.

#### Signature

- _Returns:_ Maps widget categories with an array of widget information, eg, ``` array( 'Visitors' => array( array(...), array(...) ), 'Visits' => array( array(...), array(...) ), ) ```
    - `array`

<a name="add" id="add"></a>
<a name="add" id="add"></a>
### `add()`

Adds a report to the list of dashboard widgets.

#### Signature

- It accepts the following parameter(s):
    - `$widgetCategory` (`string`) &mdash; The widget category. This can be a translation token.
    - `$widgetName` (`string`) &mdash; The name of the widget. This can be a translation token.
    - `$controllerName` (`string`) &mdash; The report's controller name (same as the plugin name).
    - `$controllerAction` (`string`) &mdash; The report's controller action method name.
    - `$customParameters` (`array`) &mdash; Extra query parameters that should be sent while getting this report.
- It does not return anything.

<a name="remove" id="remove"></a>
<a name="remove" id="remove"></a>
### `remove()`

Removes one more widgets from the widget list.

#### Signature

- It accepts the following parameter(s):
    - `$widgetCategory` (`string`) &mdash; The widget category. Can be a translation token.
    - `$widgetName` (`string`|`Piwik\false`) &mdash; The name of the widget to remove. Cannot be a translation token. If not supplied, entire category will be removed.
- It does not return anything.

<a name="isdefined" id="isdefined"></a>
<a name="isDefined" id="isDefined"></a>
### `isDefined()`

Returns true if the widget with the given parameters exists in the widget list, false if otherwise.

#### Signature

- It accepts the following parameter(s):
    - `$controllerName` (`string`) &mdash; The controller name of the widget's report.
    - `$controllerAction` (`string`) &mdash; The controller action of the widget's report.
- It returns a `bool` value.


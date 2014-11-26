<small>Piwik\</small>

WidgetsList
===========

Manages the global list of reports that can be displayed as dashboard widgets.

Reports are added as dashboard widgets through the [WidgetsList.addWidgets](/api-reference/events#widgetslistaddwidgets)
event. Observers for this event should call the [add()](/api-reference/Piwik/WidgetsList#add) method to add reports.

Methods
-------

The class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class. Inherited from [`Singleton`](../Piwik/Singleton.md)
- [`get()`](#get) &mdash; Returns all available widgets.
- [`add()`](#add) &mdash; Adds a report to the list of dashboard widgets.
- [`remove()`](#remove) &mdash; Removes one or more widgets from the widget list.
- [`isDefined()`](#isdefined) &mdash; Returns `true` if a report exists in the widget list, `false` if otherwise.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class.

If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`Singleton`](../Piwik/Singleton.md) value.

<a name="get" id="get"></a>
<a name="get" id="get"></a>
### `get()`

Returns all available widgets.

#### Signature


- *Returns:*  `array` &mdash;
    Array Mapping widget categories with an array of widget information, eg, ``` array( 'Visitors' => array( array(...), // info about first widget in this category array(...) // info about second widget in this category, etc. ), 'Visits' => array( array(...), array(...) ), ) ```

<a name="add" id="add"></a>
<a name="add" id="add"></a>
### `add()`

Adds a report to the list of dashboard widgets.

#### Signature

-  It accepts the following parameter(s):
    - `$widgetCategory` (`string`) &mdash;
       The widget category. This can be a translation token.
    - `$widgetName` (`string`) &mdash;
       The name of the widget. This can be a translation token.
    - `$controllerName` (`string`) &mdash;
       The report's controller name (same as the plugin name).
    - `$controllerAction` (`string`) &mdash;
       The report's controller action method name.
    - `$customParameters` (`array`) &mdash;
       Extra query parameters that should be sent while getting this report.
- It does not return anything.

<a name="remove" id="remove"></a>
<a name="remove" id="remove"></a>
### `remove()`

Removes one or more widgets from the widget list.

#### Signature

-  It accepts the following parameter(s):
    - `$widgetCategory` (`string`) &mdash;
       The widget category. Can be a translation token.
    - `$widgetName` (`string`|`Piwik\false`) &mdash;
       The name of the widget to remove. Cannot be a translation token. If not supplied, the entire category will be removed.
- It does not return anything.

<a name="isdefined" id="isdefined"></a>
<a name="isDefined" id="isDefined"></a>
### `isDefined()`

Returns `true` if a report exists in the widget list, `false` if otherwise.

#### Signature

-  It accepts the following parameter(s):
    - `$controllerName` (`string`) &mdash;
       The controller name of the report.
    - `$controllerAction` (`string`) &mdash;
       The controller action of the report.
- It returns a `bool` value.


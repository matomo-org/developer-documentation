<small>Piwik</small>

WidgetsList
===========

Manages the global list of reports that can be displayed as dashboard widgets.

Description
-----------

Reports are added as dashboard widgets through the [WidgetsList.addWidgets](#)
event. Plugins should call [add](#add) in event observers for this event.


Methods
-------

The class defines the following methods:

- [`get()`](#get) &mdash; Returns all available widgets.
- [`add()`](#add) &mdash; Adds a report to the list of dashboard widgets.
- [`remove()`](#remove) &mdash; Removes one more widgets from the widget list.
- [`isDefined()`](#isDefined) &mdash; Returns true if the widget with the given parameters exists in the widget list, false if otherwise.
- [`_reset()`](#_reset) &mdash; Method to reset the widget list For testing only

<a name="get" id="get"></a>
### `get()`

Returns all available widgets.

#### Signature

- It is a **public static** method.
- _Returns:_ Maps widget categories with an array of widget information, eg, ``` array( &#039;Visitors&#039; =&gt; array( array(...), array(...) ), &#039;Visits&#039; =&gt; array( array(...), array(...) ), ) ```
    - `array`

<a name="add" id="add"></a>
### `add()`

Adds a report to the list of dashboard widgets.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$widgetCategory`
    - `$widgetName`
    - `$controllerName`
    - `$controllerAction`
    - `$customParameters`
- It does not return anything.

<a name="remove" id="remove"></a>
### `remove()`

Removes one more widgets from the widget list.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$widgetCategory`
    - `$widgetName`
- It does not return anything.

<a name="isdefined" id="isdefined"></a>
### `isDefined()`

Returns true if the widget with the given parameters exists in the widget list, false if otherwise.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$controllerName`
    - `$controllerAction`
- It returns a(n) `bool` value.

<a name="_reset" id="_reset"></a>
### `_reset()`

Method to reset the widget list For testing only

#### Signature

- It is a **public static** method.
- It does not return anything.


<small>Piwik\Plugin\</small>

Widgets
=======

Base class of all plugin widget providers.

Plugins that define their own widgets can extend this class to easily
add new widgets or to remove widgets defined by other plugins.

For an example, see the [https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/Widgets.php](https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/Widgets.php) plugin.

Methods
-------

The class defines the following methods:

- [`addWidget()`](#addwidget) &mdash; Adds a widget.
- [`addWidgetWithCustomCategory()`](#addwidgetwithcustomcategory) &mdash; Adds a widget with a custom category.
- [`init()`](#init) &mdash; Here you can add one or multiple widgets.
- [`configureWidgetsList()`](#configurewidgetslist) &mdash; Allows you to configure previously added widgets.

<a name="addwidget" id="addwidget"></a>
<a name="addWidget" id="addWidget"></a>
### `addWidget()`

Adds a widget.

You can add a widget by calling this method and passing the name of the widget as well as a method
name that will be executed to render the widget. The method can be defined either directly here in this widget
class or in the controller in case you want to reuse the same action for instance in the menu etc.

#### Signature

-  It accepts the following parameter(s):
    - `$name`
      
    - `$method`
      
    - `$parameters`
      
- It does not return anything.

<a name="addwidgetwithcustomcategory" id="addwidgetwithcustomcategory"></a>
<a name="addWidgetWithCustomCategory" id="addWidgetWithCustomCategory"></a>
### `addWidgetWithCustomCategory()`

Adds a widget with a custom category.

By default all widgets that you define in your class will be added under
the same category which is defined in the $category property. Sometimes you may have a widget that
belongs to a different category where this method comes handy. It does the same as [addWidget()](/api-reference/Piwik/Plugin/Widgets#addwidget) but
allows you to define the category name as well.

#### Signature

-  It accepts the following parameter(s):
    - `$category`
      
    - `$name`
      
    - `$method`
      
    - `$parameters`
      
- It does not return anything.

<a name="init" id="init"></a>
<a name="init" id="init"></a>
### `init()`

Here you can add one or multiple widgets.

To do so call the method [addWidget()](/api-reference/Piwik/Plugin/Widgets#addwidget) or
[addWidgetWithCustomCategory()](/api-reference/Piwik/Plugin/Widgets#addwidgetwithcustomcategory).

#### Signature

- It does not return anything.

<a name="configurewidgetslist" id="configurewidgetslist"></a>
<a name="configureWidgetsList" id="configureWidgetsList"></a>
### `configureWidgetsList()`

Allows you to configure previously added widgets.

For instance you can remove any widgets defined by any plugin by calling the
[WidgetsList::remove()](/api-reference/Piwik/WidgetsList#remove) method.

#### Signature

-  It accepts the following parameter(s):
    - `$widgetsList` ([`WidgetsList`](../../Piwik/WidgetsList.md)) &mdash;
      
- It does not return anything.


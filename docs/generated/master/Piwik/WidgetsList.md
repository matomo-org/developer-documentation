<small>Piwik\</small>

WidgetsList
===========

Manages the global list of reports that can be displayed as dashboard widgets.

Reports are added as dashboard widgets through the [WidgetsList.addWidgets](/api-reference/events#widgetslistaddwidgets)
event. Observers for this event should call the [add()](/api-reference/Piwik/WidgetsList#add) method to add reports.

Methods
-------

The class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class.
- [`get()`](#get) &mdash; Returns all available widgets.
- [`add()`](#add) &mdash; Adds a report to the list of dashboard widgets.
- [`remove()`](#remove) &mdash; Removes one or more widgets from the widget list.
- [`isDefined()`](#isdefined) &mdash; Returns `true` if a report exists in the widget list, `false` if otherwise.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()` *inherited from [`Singleton`](../Piwik/Singleton.md)*
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


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">Array Mapping widget categories with an array of widget information, eg, ``` array( 'Visitors' => array( array(...), // info about first widget in this category array(...) // info about second widget in this category, etc. ), 'Visits' => array( array(...), array(...) ), ) ```</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="add" id="add"></a>
<a name="add" id="add"></a>
### `add()` 
Adds a report to the list of dashboard widgets.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$widgetCategory` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The widget category. This can be a translation token.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$widgetName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the widget. This can be a translation token.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$controllerName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The report's controller name (same as the plugin name).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$controllerAction` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The report's controller action method name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$customParameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Extra query parameters that should be sent while getting this report.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="remove" id="remove"></a>
<a name="remove" id="remove"></a>
### `remove()` 
Removes one or more widgets from the widget list.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$widgetCategory` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The widget category. Can be a translation token.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$widgetName` (`string`|`Piwik\false`) &mdash;

      <div markdown="1" class="param-desc"> The name of the widget to remove. Cannot be a translation token. If not supplied, the entire category will be removed.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="isdefined" id="isdefined"></a>
<a name="isDefined" id="isDefined"></a>
### `isDefined()` 
Returns `true` if a report exists in the widget list, `false` if otherwise.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$controllerName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The controller name of the report.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$controllerAction` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The controller action of the report.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.


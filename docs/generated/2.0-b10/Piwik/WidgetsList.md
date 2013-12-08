<small>Piwik\</small>

WidgetsList
===========

Manages the global list of reports that can be displayed as dashboard widgets.

Reports are added as dashboard widgets through the [WidgetsList.addWidgets](#)
event. Plugins should call [add](#add) in event observers for this event.

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


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">Maps widget categories with an array of widget information, eg, ``` array( 'Visitors' => array( array(...), array(...) ), 'Visits' => array( array(...), array(...) ), ) ```</div>

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

Removes one more widgets from the widget list.

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

      <div markdown="1" class="param-desc"> The name of the widget to remove. Cannot be a translation token. If not supplied, entire category will be removed.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="isdefined" id="isdefined"></a>
<a name="isDefined" id="isDefined"></a>
### `isDefined()`

Returns true if the widget with the given parameters exists in the widget list, false if otherwise.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$controllerName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The controller name of the widget's report.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$controllerAction` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The controller action of the widget's report.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.


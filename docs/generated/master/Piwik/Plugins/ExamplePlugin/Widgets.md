<small>Piwik\Plugins\ExamplePlugin\</small>

Widgets
=======

This class allows you to add your own widgets to the Piwik platform.

In case you want to remove widgets from another
plugin please have a look at the "configureWidgetsList()" method.
To configure a widget simply call the corresponding methods as described in the API-Reference:
http://developer.piwik.org/api-reference/Piwik/Plugin\Widgets

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`getCategory()`](#getcategory)
- [`addWidget()`](#addwidget)
- [`init()`](#init)
- [`getWidgets()`](#getwidgets)
- [`configureWidgetsList()`](#configurewidgetslist) &mdash; Configures the widgets.
- [`getAllWidgets()`](#getallwidgets)
- [`factory()`](#factory)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()` *inherited from [`Widgets`](../../../Piwik/Plugin/Widgets.md)*
#### Signature


<a name="getcategory" id="getcategory"></a>
<a name="getCategory" id="getCategory"></a>
### `getCategory()` *inherited from [`Widgets`](../../../Piwik/Plugin/Widgets.md)*
#### Signature

- It does not return anything.

<a name="addwidget" id="addwidget"></a>
<a name="addWidget" id="addWidget"></a>
### `addWidget()` *inherited from [`Widgets`](../../../Piwik/Plugin/Widgets.md)*
#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$method`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="init" id="init"></a>
<a name="init" id="init"></a>
### `init()` *inherited from [`Widgets`](../../../Piwik/Plugin/Widgets.md)*
#### Signature

- It does not return anything.

<a name="getwidgets" id="getwidgets"></a>
<a name="getWidgets" id="getWidgets"></a>
### `getWidgets()` *inherited from [`Widgets`](../../../Piwik/Plugin/Widgets.md)*
#### Signature

- It does not return anything.

<a name="configurewidgetslist" id="configurewidgetslist"></a>
<a name="configureWidgetsList" id="configureWidgetsList"></a>
### `configureWidgetsList()` *inherited from [`Widgets`](../../../Piwik/Plugin/Widgets.md)*
Configures the widgets.

Here you can for instance remove widgets.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$widgetsList` ([`WidgetsList`](../../../Piwik/WidgetsList.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getallwidgets" id="getallwidgets"></a>
<a name="getAllWidgets" id="getAllWidgets"></a>
### `getAllWidgets()` *inherited from [`Widgets`](../../../Piwik/Plugin/Widgets.md)*
#### Signature

- It returns a [`Widgets[]`](../../../Piwik/Plugin/Widgets.md) value.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()` *inherited from [`Widgets`](../../../Piwik/Plugin/Widgets.md)*
#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$module`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$action`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.


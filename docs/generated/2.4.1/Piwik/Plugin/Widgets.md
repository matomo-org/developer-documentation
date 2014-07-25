<small>Piwik\Plugin\</small>

Widgets
=======

Base class of all plugin widget providers.

Plugins that define their own widgets can extend this class to easily
add new widgets, to remove or to rename existing items.

For an example, see the [https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/Widget.php](https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/Widget.php) plugin.

Methods
-------

The class defines the following methods:

- [`configure()`](#configure) &mdash; Configures the widgets.

<a name="configure" id="configure"></a>
<a name="configure" id="configure"></a>
### `configure()` 
Configures the widgets.

Here you can for instance add or remove widgets.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$widgetsList` ([`WidgetsList`](../../Piwik/WidgetsList.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.


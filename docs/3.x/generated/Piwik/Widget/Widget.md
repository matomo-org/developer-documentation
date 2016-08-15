<small>Piwik\Widget\</small>

Widget
======

Defines a new widget.

You can create a new widget using the console command `./console generate:widget`.
The generated widget will guide you through the creation of a widget.

For an example, see [https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/Widgets/MyExampleWidget.php](https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/Widgets/MyExampleWidget.php)

Methods
-------

The class defines the following methods:

- [`configure()`](#configure)
- [`render()`](#render)

<a name="configure" id="configure"></a>
<a name="configure" id="configure"></a>
### `configure()`

#### Signature

-  It accepts the following parameter(s):
    - `$config` ([`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md)) &mdash;
      
- It does not return anything.

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

#### Signature

- It returns a `string` value.


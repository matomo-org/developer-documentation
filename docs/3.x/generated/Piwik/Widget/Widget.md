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
- [`renderTemplate()`](#rendertemplate) &mdash; Assigns the given variables to the template and renders it.

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

<a name="rendertemplate" id="rendertemplate"></a>
<a name="renderTemplate" id="renderTemplate"></a>
### `renderTemplate()`

Assigns the given variables to the template and renders it.

Example:

    public function myControllerAction () {
       return $this->renderTemplate('index', array(
           'answerToLife' => '42'
       ));
    }

This will render the 'index.twig' file within the plugin templates folder and assign the view variable
`answerToLife` to `42`.

#### Signature

-  It accepts the following parameter(s):
    - `$template` (`string`) &mdash;
       The name of the template file. If only a name is given it will automatically use the template within the plugin folder. For instance 'myTemplate' will result in '@$pluginName/myTemplate.twig'. Alternatively you can include the full path: '@anyOtherFolder/otherTemplate'. The trailing '.twig' is not needed.
    - `$variables` (`array`) &mdash;
       For instance array('myViewVar' => 'myValue'). In template you can use {{ myViewVar }}
- It returns a `string` value.


<small>Piwik\Widget\</small>

WidgetContainerConfig
=====================

Defines a new widget container.

Widget containers are useful when you want to combine several widgets
into one unique widgets. For example you could combine an evolution graph widget with a sparklines widget
and combine them to a single "overview widget". It also allows you to specify layouts meaning you can
define a layout that will group multiple widgets into one widget displaying a menu on the left side for each
widget and the actual widget on the right side. By default widgets within a container are displayed vertically
one after another.

To define a widget container just place a subclass within the `Widgets` folder of your plugin.

Methods
-------

The class defines the following methods:

- [`isEnabled()`](#isenabled) &mdash; Defines whether a widget is enabled or not. Inherited from [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md)
- [`checkIsEnabled()`](#checkisenabled) &mdash; This method checks whether the widget is available, see [isEnabled()](/api-reference/Piwik/Widget/WidgetContainerConfig#isenabled). Inherited from [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md)

<a name="isenabled" id="isenabled"></a>
<a name="isEnabled" id="isEnabled"></a>
### `isEnabled()`

Defines whether a widget is enabled or not.

For instance some widgets might not be available to every user or
might depend on a setting (such as Ecommerce) of a site. In such a case you can perform any checks and then
return `true` or `false`. If your report is only available to users having super user access you can do the
following: `return Piwik::hasUserSuperUserAccess();`

#### Signature

- It returns a `bool` value.

<a name="checkisenabled" id="checkisenabled"></a>
<a name="checkIsEnabled" id="checkIsEnabled"></a>
### `checkIsEnabled()`

This method checks whether the widget is available, see [isEnabled()](/api-reference/Piwik/Widget/WidgetContainerConfig#isenabled).

If not, it triggers an exception
containing a message that will be displayed to the user. You can overwrite this message in case you want to
customize the error message. Eg.
```
if (!$this->isEnabled()) {
    throw new Exception('Setting XYZ is not enabled or the user has not enough permission');
}
```

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


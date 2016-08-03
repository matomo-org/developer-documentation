<small>Piwik\Widget\</small>

WidgetConfig
============

Configures a widget.

Use this class to configure a Piwik\Widget\Widget` or to
add a widget to the WidgetsList via WidgetsList::addWidget.

Methods
-------

The class defines the following methods:

- [`isEnabled()`](#isenabled) &mdash; Defines whether a widget is enabled or not.
- [`checkIsEnabled()`](#checkisenabled) &mdash; This method checks whether the widget is available, see [isEnabled()](/api-reference/Piwik/Widget/WidgetConfig#isenabled).

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

This method checks whether the widget is available, see [isEnabled()](/api-reference/Piwik/Widget/WidgetConfig#isenabled).

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


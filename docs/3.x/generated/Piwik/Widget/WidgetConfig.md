<small>Piwik\Widget\</small>

WidgetConfig
============

Configures a widget.

Methods
-------

The class defines the following methods:

- [`setCategoryId()`](#setcategoryid) &mdash; Set the id of the category the widget belongs to.
- [`getCategoryId()`](#getcategoryid) &mdash; Get the id of the category the widget belongs to.
- [`setSubcategoryId()`](#setsubcategoryid) &mdash; Set the id of the subcategory the widget belongs to.
- [`getSubcategoryId()`](#getsubcategoryid) &mdash; Get the currently set category ID.
- [`setModule()`](#setmodule) &mdash; Set the module (aka plugin name) of the widget.
- [`getModule()`](#getmodule)
- [`setAction()`](#setaction) &mdash; Set the action of the widget that shall be used in the URL to render the widget.
- [`getAction()`](#getaction) &mdash; Get the currently set action.
- [`setParameters()`](#setparameters) &mdash; Sets (overwrites) the parameters of the widget.
- [`addParameters()`](#addparameters) &mdash; Add new parameters and only overwrite parameters that have the same name.
- [`getParameters()`](#getparameters) &mdash; Get all URL parameters needed to render this widget.
- [`setName()`](#setname) &mdash; Set the name of the widget.
- [`getName()`](#getname) &mdash; Get the name of the widget.
- [`setOrder()`](#setorder) &mdash; Set the order of the widget.
- [`getOrder()`](#getorder) &mdash; Returns the order of the widget.
- [`isEnabled()`](#isenabled) &mdash; Defines whether a widget is enabled or not.
- [`setIsEnabled()`](#setisenabled) &mdash; Enable / disable the widget.
- [`enable()`](#enable) &mdash; Enables the widget.
- [`disable()`](#disable) &mdash; Disables the widget.
- [`checkIsEnabled()`](#checkisenabled) &mdash; This method checks whether the widget is available, see [isEnabled()](/api-reference/Piwik/Widget/WidgetConfig#isenabled).
- [`getUniqueId()`](#getuniqueid) &mdash; Returns the unique id of an widget based on module, action and the set parameters.
- [`setIsNotWidgetizable()`](#setisnotwidgetizable) &mdash; Sets the widget as not widgetizable [isWidgetizeable()](/api-reference/Piwik/Widget/WidgetConfig#iswidgetizeable).
- [`setIsWidgetizable()`](#setiswidgetizable) &mdash; Sets the widget as widgetizable [isWidgetizeable()](/api-reference/Piwik/Widget/WidgetConfig#iswidgetizeable).
- [`isWidgetizeable()`](#iswidgetizeable) &mdash; Detect whether the widget is widgetizable meaning it won't be able to add it to the dashboard and it won't be possible to export the widget via an iframe if it is not widgetizable.
- [`setMiddlewareParameters()`](#setmiddlewareparameters) &mdash; If middleware parameters are specified, the corresponding action will be executed before showing the actual widget in the UI.
- [`getMiddlewareParameters()`](#getmiddlewareparameters) &mdash; Get defined middleware parameters (if any).
- [`setIsWide()`](#setiswide) &mdash; Marks this widget as a "wide" widget that requires the full width.
- [`isWide()`](#iswide) &mdash; Detect whether the widget should be shown wide or not.

<a name="setcategoryid" id="setcategoryid"></a>
<a name="setCategoryId" id="setCategoryId"></a>
### `setCategoryId()`

Set the id of the category the widget belongs to.

#### Signature

-  It accepts the following parameter(s):
    - `$categoryId` (`string`) &mdash;
       Usually a translation key, eg 'General_Visits', 'Goals_Goals', ...
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="getcategoryid" id="getcategoryid"></a>
<a name="getCategoryId" id="getCategoryId"></a>
### `getCategoryId()`

Get the id of the category the widget belongs to.

#### Signature

- It returns a `string` value.

<a name="setsubcategoryid" id="setsubcategoryid"></a>
<a name="setSubcategoryId" id="setSubcategoryId"></a>
### `setSubcategoryId()`

Set the id of the subcategory the widget belongs to. If a subcategory is specified, the widget
will be shown in the Piwik reporting UI. The subcategoryId will be used as a translation key for
the submenu item.

#### Signature

-  It accepts the following parameter(s):
    - `$subcategoryId` (`string`) &mdash;
       Usually a translation key, eg 'General_Overview', 'Actions_Pages', ...
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="getsubcategoryid" id="getsubcategoryid"></a>
<a name="getSubcategoryId" id="getSubcategoryId"></a>
### `getSubcategoryId()`

Get the currently set category ID.

#### Signature

- It returns a `string` value.

<a name="setmodule" id="setmodule"></a>
<a name="setModule" id="setModule"></a>
### `setModule()`

Set the module (aka plugin name) of the widget. The correct module is usually detected automatically and
not needed to be configured manually.

#### Signature

-  It accepts the following parameter(s):
    - `$module` (`string`) &mdash;
       eg 'CoreHome'
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="getmodule" id="getmodule"></a>
<a name="getModule" id="getModule"></a>
### `getModule()`

#### Signature

- It does not return anything or a mixed result.

<a name="setaction" id="setaction"></a>
<a name="setAction" id="setAction"></a>
### `setAction()`

Set the action of the widget that shall be used in the URL to render the widget.

The correct action is usually detected automatically and not needed to be configured manually.

#### Signature

-  It accepts the following parameter(s):
    - `$action` (`string`) &mdash;
       eg 'renderMyWidget'
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="getaction" id="getaction"></a>
<a name="getAction" id="getAction"></a>
### `getAction()`

Get the currently set action.

#### Signature

- It returns a `string` value.

<a name="setparameters" id="setparameters"></a>
<a name="setParameters" id="setParameters"></a>
### `setParameters()`

Sets (overwrites) the parameters of the widget. These parameters will be added to the URL when rendering the
widget. You can access these parameters via `Piwik\Common::getRequestVar(.

..)`.

#### Signature

-  It accepts the following parameter(s):
    - `$parameters` (`array`) &mdash;
       eg. ('urlparam' => 'urlvalue')
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="addparameters" id="addparameters"></a>
<a name="addParameters" id="addParameters"></a>
### `addParameters()`

Add new parameters and only overwrite parameters that have the same name. See [setParameters()](/api-reference/Piwik/Widget/WidgetConfig#setparameters)

#### Signature

-  It accepts the following parameter(s):
    - `$parameters` (`array`) &mdash;
       eg. ('urlparam' => 'urlvalue')
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="getparameters" id="getparameters"></a>
<a name="getParameters" id="getParameters"></a>
### `getParameters()`

Get all URL parameters needed to render this widget.

#### Signature


- *Returns:*  `array` &mdash;
    Eg ('urlparam' => 'urlvalue').

<a name="setname" id="setname"></a>
<a name="setName" id="setName"></a>
### `setName()`

Set the name of the widget.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       Usually a translation key, eg 'VisitTime_ByServerTimeWidgetName'
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Get the name of the widget.

#### Signature

- It returns a `string` value.

<a name="setorder" id="setorder"></a>
<a name="setOrder" id="setOrder"></a>
### `setOrder()`

Set the order of the widget.

#### Signature

-  It accepts the following parameter(s):
    - `$order` (`int`) &mdash;
       eg. 5
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

Returns the order of the widget.

#### Signature

- It returns a `int` value.

<a name="isenabled" id="isenabled"></a>
<a name="isEnabled" id="isEnabled"></a>
### `isEnabled()`

Defines whether a widget is enabled or not. For instance some widgets might not be available to every user or
might depend on a setting (such as Ecommerce) of a site. In such a case you can perform any checks and then
return `true` or `false`. If your report is only available to users having super user access you can do the
following: `return Piwik::hasUserSuperUserAccess();`

#### Signature

- It returns a `bool` value.

<a name="setisenabled" id="setisenabled"></a>
<a name="setIsEnabled" id="setIsEnabled"></a>
### `setIsEnabled()`

Enable / disable the widget. See [isEnabled()](/api-reference/Piwik/Widget/WidgetConfig#isenabled)

#### Signature

-  It accepts the following parameter(s):
    - `$isEnabled` (`bool`) &mdash;
      
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="enable" id="enable"></a>
<a name="enable" id="enable"></a>
### `enable()`

Enables the widget. See [isEnabled()](/api-reference/Piwik/Widget/WidgetConfig#isenabled)

#### Signature

- It does not return anything or a mixed result.

<a name="disable" id="disable"></a>
<a name="disable" id="disable"></a>
### `disable()`

Disables the widget. See [isEnabled()](/api-reference/Piwik/Widget/WidgetConfig#isenabled)

#### Signature

- It does not return anything or a mixed result.

<a name="checkisenabled" id="checkisenabled"></a>
<a name="checkIsEnabled" id="checkIsEnabled"></a>
### `checkIsEnabled()`

This method checks whether the widget is available, see [isEnabled()](/api-reference/Piwik/Widget/WidgetConfig#isenabled). If not, it triggers an exception
containing a message that will be displayed to the user. You can overwrite this message in case you want to
customize the error message. Eg.

```
if (!$this->isEnabled()) {
    throw new Exception('Setting XYZ is not enabled or the user has not enough permission');
}
```

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getuniqueid" id="getuniqueid"></a>
<a name="getUniqueId" id="getUniqueId"></a>
### `getUniqueId()`

Returns the unique id of an widget based on module, action and the set parameters.

#### Signature

- It returns a `string` value.

<a name="setisnotwidgetizable" id="setisnotwidgetizable"></a>
<a name="setIsNotWidgetizable" id="setIsNotWidgetizable"></a>
### `setIsNotWidgetizable()`

Sets the widget as not widgetizable [isWidgetizeable()](/api-reference/Piwik/Widget/WidgetConfig#iswidgetizeable).

#### Signature

- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="setiswidgetizable" id="setiswidgetizable"></a>
<a name="setIsWidgetizable" id="setIsWidgetizable"></a>
### `setIsWidgetizable()`

Sets the widget as widgetizable [isWidgetizeable()](/api-reference/Piwik/Widget/WidgetConfig#iswidgetizeable).

#### Signature

- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="iswidgetizeable" id="iswidgetizeable"></a>
<a name="isWidgetizeable" id="isWidgetizeable"></a>
### `isWidgetizeable()`

Detect whether the widget is widgetizable meaning it won't be able to add it to the dashboard and it won't
be possible to export the widget via an iframe if it is not widgetizable. This is usually not needed but useful
when you eg want to display a widget within the Piwik UI but not want to have it widgetizable.

#### Signature

- It returns a `bool` value.

<a name="setmiddlewareparameters" id="setmiddlewareparameters"></a>
<a name="setMiddlewareParameters" id="setMiddlewareParameters"></a>
### `setMiddlewareParameters()`

If middleware parameters are specified, the corresponding action will be executed before showing the
actual widget in the UI. Only if this action (can be a controller method or API method) returns JSON `true`
the widget will be actually shown. It is similar to `isEnabled()` but the specified action is performed each
time the widget is requested in the UI whereas `isEnabled` is only checked once on the inital page load when
we load the inital list of widgets. So if your widget's visibility depends on archived data
(aka idSite/period/date) you should specify middle parameters. This has mainly two reasons:

- This way the inital page load time is faster as we won't have to request archived data on the initial page
load for widgets that are potentially never shown.
- We execute that action every time before showing it. As the initial list of widgets is loaded on page load
it is possible that some archives have no data yet, but at a later time there might be actually archived data.
As we never reload the initial list of widgets we would still not show the widget even there we should. Example:
On page load there are no conversions, a few minutes later there might be conversions. As the middleware is
executed before showing it, we detect correctly that there are now conversions whereas `isEnabled` is only
checked once on the initial Piwik page load.

#### Signature

-  It accepts the following parameter(s):
    - `$parameters` (`array`) &mdash;
       URL parameters eg array('module' => 'Goals', 'action' => 'Conversions')
- It returns a [`WidgetConfig`](../../Piwik/Widget/WidgetConfig.md) value.

<a name="getmiddlewareparameters" id="getmiddlewareparameters"></a>
<a name="getMiddlewareParameters" id="getMiddlewareParameters"></a>
### `getMiddlewareParameters()`

Get defined middleware parameters (if any).

#### Signature

- It returns a `array` value.

<a name="setiswide" id="setiswide"></a>
<a name="setIsWide" id="setIsWide"></a>
### `setIsWide()`

Marks this widget as a "wide" widget that requires the full width.

#### Signature

- It returns a `$this` value.

<a name="iswide" id="iswide"></a>
<a name="isWide" id="isWide"></a>
### `isWide()`

Detect whether the widget should be shown wide or not.

#### Signature

- It returns a `bool` value.


<small>Piwik\Report\</small>

ReportWidgetFactory
===================

Report widget factory.

.. When creating a widget from a report
these values will be automatically specified so that ideally `$factory->createWidget()` is all one has to do in
order to create a new widget.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Generates a new report widget factory.
- [`createWidget()`](#createwidget) &mdash; Creates a widget based on the specified report in construct().
- [`createContainerWidget()`](#createcontainerwidget) &mdash; Creates a new container widget based on the specified report in construct().
- [`createCustomWidget()`](#createcustomwidget) &mdash; Creates a custom widget that doesn't use a viewDataTable to render the report but instead a custom controller action.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Generates a new report widget factory.

#### Signature

-  It accepts the following parameter(s):
    - `$report` ([`Report`](../../Piwik/Plugin/Report.md)) &mdash;
       A report instance, widgets will be created based on the data provided by this report.

<a name="createwidget" id="createwidget"></a>
<a name="createWidget" id="createWidget"></a>
### `createWidget()`

Creates a widget based on the specified report in construct().

It will automatically use the report's name, categoryId, subcategoryId (if specified),
defaultViewDataTable, module, action, order and parameters in order to create the widget.

#### Signature

- It returns a `Stmt_Namespace\ReportWidgetConfig` value.

<a name="createcontainerwidget" id="createcontainerwidget"></a>
<a name="createContainerWidget" id="createContainerWidget"></a>
### `createContainerWidget()`

Creates a new container widget based on the specified report in construct().

It will automatically use the report's categoryId, subcategoryId (if specified) and order in order to
create the container.

#### Signature

-  It accepts the following parameter(s):
    - `$containerId` (`string`) &mdash;
       eg 'Products' or 'Contents' see {Piwik\Widget\WidgetContainerConfig::setId()}. Other reports or widgets will be able to add more widgets to this container. This is useful when you want to show for example multiple related widgets together.
- It returns a `Stmt_Namespace\WidgetContainerConfig` value.

<a name="createcustomwidget" id="createcustomwidget"></a>
<a name="createCustomWidget" id="createCustomWidget"></a>
### `createCustomWidget()`

Creates a custom widget that doesn't use a viewDataTable to render the report but instead a custom
controller action. Make sure the specified `$action` exists in the plugin's controller. Otherwise
behaves as [createWidget()](/api-reference/Piwik/Report/ReportWidgetFactory#createwidget).

#### Signature

-  It accepts the following parameter(s):
    - `$action` (`string`) &mdash;
       eg 'conversionReports' (requires a method `public function conversionReports()` in the plugin's controller).
- It returns a `Stmt_Namespace\ReportWidgetConfig` value.


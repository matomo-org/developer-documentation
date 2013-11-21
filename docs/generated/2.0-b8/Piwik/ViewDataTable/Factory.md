<small>Piwik\ViewDataTable</small>

Factory
=======

Provides a means of creating [ViewDataTable](#) instances by ID.

Description
-----------

### Examples

**Creating a ViewDataTable for a report**

    // method in MyPlugin\Controller
    public function myReport()
    {
        $view = Factory::build('table', 'MyPlugin.myReport');
        $view->config->show_limit_control = true;
        $view->config->translations['myFancyMetric'] = "My Fancy Metric";
        echo $view->render();
    }

**Displaying a report in another way**

    // method in MyPlugin\Controller
    // use the same data that's used in myReport() above, but transform it in some way before
    // displaying.
    public function myReportShownDifferently()
    {
        $view = Factory::build('table', 'MyPlugin.myReport', 'MyPlugin.myReportShownDifferently');
        $view->config->filters[] = array('MyMagicFilter', array('an arg', 'another arg'));
        echo $view->render();
    }

**Force a report to be shown as a bar graph**

    // method in MyPlugin\Controller
    // force the myReport report to show as a bar graph if there is no viewDataTable query param,
    // even though it is configured to show as a table.
    public function myReportShownAsABarGraph()
    {
        $view = Factory::build('graphVerticalBar', 'MyPlugin.myReport', 'MyPlugin.myReportShownAsABarGraph',
                               $forceDefault = true);
        echo $view->render();
    }

Methods
-------

The class defines the following methods:

- [`build()`](#build) &mdash; Creates a [ViewDataTable](#) instance by ID.

<a name="build" id="build"></a>
<a name="build" id="build"></a>
### `build()`

Creates a [ViewDataTable](#) instance by ID.

#### Description

If the **viewDataTable** query parameter is set,
this parameter's value is used as the ID.

See [ViewDataTable docs](#) to read about the ViewDataTable implementations that are packaged with Piwik.

#### Signature

- It accepts the following parameter(s):
    - `$defaultType` (`string`|`null`) &mdash; A ViewDataTable ID representing the default ViewDataTable type to use. If the **viewDataTable** query parameter is not found, this value is used as the ID of the ViewDataTable to create. If a visualization type is configured for the report being displayed, it is used instead of the default type. (See [ViewDataTable.getDefaultType](#)). If nothing is configured for the report and `null` is supplied for this argument, **table** is used.
    - `$apiAction` (`string`|`Piwik\ViewDataTable\false`) &mdash; The API method for the report that will be displayed, eg, `'UserSettings.getBrowser'`.
    - `$controllerAction` (`string`|`Piwik\ViewDataTable\false`) &mdash; The controller name and action dedicated to displaying the report. This action is used when reloading reports or changing the report visualization. Defaulted to `$apiAction` if `false` is supplied.
    - `$forceDefault` (`bool`) &mdash; If true, then the visualization type that was configured for the report will be ignored and `$defaultType` will be used as the default.
- It returns a [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


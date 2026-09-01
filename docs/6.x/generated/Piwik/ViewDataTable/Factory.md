<small>Piwik\ViewDataTable\</small>

Factory
=======

Provides a means of creating [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instances by ID.

### Examples

**Creating a ViewDataTable for a report**

    // method in MyPlugin\Controller
    public function myReport()
    {
        $view = Factory::build('table', 'MyPlugin.myReport');
        $view->config->show_limit_control = true;
        $view->config->translations['myFancyMetric'] = "My Fancy Metric";
        return $view->render();
    }

**Displaying a report in another way**

    // method in MyPlugin\Controller
    // use the same data that's used in myReport() above, but transform it in some way before
    // displaying.
    public function myReportShownDifferently()
    {
        $view = Factory::build('table', 'MyPlugin.myReport', 'MyPlugin.myReportShownDifferently');
        $view->config->filters[] = array('MyMagicFilter', array('an arg', 'another arg'));
        return $view->render();
    }

**Force a report to be shown as a bar graph**

    // method in MyPlugin\Controller
    // force the myReport report to show as a bar graph if there is no viewDataTable query param,
    // even though it is configured to show as a table.
    public function myReportShownAsABarGraph()
    {
        $view = Factory::build('graphVerticalBar', 'MyPlugin.myReport', 'MyPlugin.myReportShownAsABarGraph',
                               $forceDefault = true);
        return $view->render();
    }

Methods
-------

The class defines the following methods:

- [`build()`](#build) &mdash; Creates a [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instance by ID.

<a name="build" id="build"></a>
<a name="build" id="build"></a>
### `build()`

Creates a [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instance by ID. If the **viewDataTable** query parameter is set,
this parameter's value is used as the ID.

See [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) to read about the visualizations that are packaged with Piwik.

#### Signature

-  It accepts the following parameter(s):
    - `$defaultType` (`string`|`null`) &mdash;
       A ViewDataTable ID representing the default ViewDataTable type to use. If the **viewDataTable** query parameter is not found, this value is used as the ID of the ViewDataTable to create. If a visualization type is configured for the report being displayed, it is used instead of the default type. (See [ViewDataTable.getDefaultType](/api-reference/events#viewdatatablegetdefaulttype)). If nothing is configured for the report and `null` is supplied for this argument, **table** is used.
    - `$apiAction` (`bool`|`false`|`string`) &mdash;
       The API method for the report that will be displayed, eg, `'DevicesDetection.getBrowsers'`.
    - `$controllerAction` (`bool`|`false`|`string`) &mdash;
       The controller name and action dedicated to displaying the report. This action is used when reloading reports or changing the report visualization. Defaulted to `$apiAction` if `false` is supplied.
    - `$forceDefault` (`bool`) &mdash;
       If true, then the visualization type that was configured for the report will be ignored and `$defaultType` will be used as the default.
    - `$loadViewDataTableParametersForUser` (`bool`) &mdash;
       Whether the per-user parameters for this user, this ViewDataTable and this Api action should be loaded from the user preferences and override the default params values.
- It returns a [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


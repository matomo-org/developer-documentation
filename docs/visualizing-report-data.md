# Visualizing Report Data

<!-- Meta (to be deleted)
Purpose: - explain how to display report data (explain how to use ViewDataTable)
- explain how visualizations work (& what visualizations are available)
- explain how new visualizations are created
- explain how to make widgets that are displayed embeddable in the dashboard

Audience: plugin developers who want to display new reports or want to create new visualizations

Expected Result: plugin developers who understand how ViewDataTable can be used and fits in w/ Piwik. who know what types of visualizations are available. and devs who know how to make new visualizations.

Notes: should introduce concept of creating new visualization? or perhaps the heading will be enough.

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
- feel like i'm not imparting general understanding of visualization archictecture
-->

## About this guide

**Read this guide if**

* you'd like to know **how to display your reports the way existing reports are displayed**
* you'd like to know **the different ways your reports can be displayed**
* you'd like to know **how to get your report to display in the dashboard**
* you'd like to know **how to create new visualizations**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide),
* and understand the purpose of [Piwik controllers](/guides/mvc-in-piwik) and [Piwik APIs](/guides/piwiks-reporting-api).

## Displaying Analytics Reports

In Piwik, an analytics report is just a set of two-dimensional data (stored internally in [DataTable](/api-reference/Piwik/DataTable) instances). They are returned by API methods. Controller methods can output visualizations of these reports by using the [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) class.

Report visualizations can be in any format. The **sparkline** visualization for example outputs an image. Most visualizations, however, will output an HTML display that allows users to switch between different visualizations. You've very likely seen this display before:

<!-- TODO: image of datatable view -->

### About visualizations

A report visualization is a class that extends from [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable). Every visualization has a unique ID that is specified by a class constant named **ID**. They are referred to by this ID, not their class name, because they must be able to be specified in the **viewDataTable** query parameter. Using a fully qualified class name would be too verbose.

The **viewDataTable** query parameter is set by [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable)'s associated JavaScript code. It represents the user's choice of view (made by clicking on a visualization's footer icon) and thus will override any visualization type specified in code.

Users can switch visualizations by clicking on one of the icons displayed below the visualization itself:

<!-- TODO: image -->

These icons are called **footer icons**. Not all visualizations have to be available in this manner. For example, the [Visitor Log](http://piwik.org/docs/real-time/) uses its own visualization, but since it can only use data from one report (**Live.getLastVisitsDetails**) it is not available in the footer of other reports.

To learn more about the controls that surround a visualization in most report displays, [read the user docs for report visualizations](http://piwik.org/docs/piwik-tour/#a-look-at-a-piwik-report).

### Using ViewDataTable

There are two ways to output a visualization for a report. The most succinct way is to call the [Controller::renderReport](/api-reference/Piwik/Plugin/Controller#renderreport) method:

    // controller method for the MyPlugin.myReport report
    public function myReport()
    {
        return $this->renderReport(__FUNCTION__);
    }

[renderReport](/api-reference/Piwik/Plugin/Controller#renderreport) will create a new [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instance and render it. The report can be configured via the [ViewDataTable.configure](/api-reference/events#viewdatatableconfigure) event.

The other way to output the display is to manually create and configure a [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instance:

    // controller method for the MyPlugin.myReport report
    public function myReport()
    {
        $view = \Piwik\ViewDataTable\Factory::build(
            $defaultType = 'table',
            $apiAction = 'MyPlugin.myReport',
            $controllerMethod = 'MyPlugin.myReport',
        );
        $view->config->show_limit_control = false;
        $view->config->show_search = false;
        $view->config->show_goals = true;

        // ... do some more configuration ...

        return $view->render();
    }

The visualization type is specified in the first argument to [\Piwik\ViewDataTable\Factory::build](/api-reference/Piwik/ViewDataTable/Factory#build).

When [ViewDataTable::render](/api-reference/Piwik/Plugin/ViewDataTable#render) is called, the [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instance will load a report through the reporting API (using the [Piwik\API\Request](/api-reference/Piwik/API/Request) class) and output an HTML display using Twig templates.

_Note: The display generated by ViewDataTable will reload the report using AJAX, which means there must be a way to get the display for just the report in question. **Therefore, you must create a dedicated controller method for each of your reports.** You can use a ViewDataTable instance outside of a controller method, but it must still reference such a controller method._

**Configuring [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instances**

[ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instances are configured by setting properties of a [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable)'s [Config](/api-reference/Piwik/ViewDataTable/Config) or [RequestConfig](/api-reference/Piwik/ViewDataTable/RequestConfig) object.

Properties in the [Config](/api-reference/Piwik/ViewDataTable/Config) object affect the way the report is displayed. Properties in the [RequestConfig](/api-reference/Piwik/ViewDataTable/RequestConfig) object affect how the data is obtained and, in part, what is displayed.

### Displaying reports on a page

Once there exists a controller method for a report, displaying it on a page in Piwik is straightforward. Assuming you've [exposed a controller method as a menu item](/guides/mvc-in-piwik#using-controller-methods-in-the-piwik-ui), you can then reuse your report's controller method to include the report in the menu item page:

    // controller method exposed as a menu item
    public function index()
    {
        $view = new View("@MyPlugin/index.twig");
        $view->myReport = $this->myReport();
        echo $view->render();
    }

    // report method
    public function myReport()
    {
        return $this->renderReport(__FUNCTION__);
    }

The **index.twig** template will look like this:

    <h1>My Report</h1>

    {{ myReport }}

### Displaying reports in the Dashboard

After a controller method is created for a report, the report can be made available to the dashboard by using the [WidgetsList.addWidgets](/api-reference/events#widgetslistaddwidgets) event:

    // event handler for the WidgetsList.addWidgets event in the MyPlugin/MyPlugin.php file
    public function addWidgets()
    {
        WidgetsList::add('My Category Name', 'My Report Title', 'MyPlugin', 'myReport');
    }

Piwik users will then be able to see and select **myReport** in the widget selector.

_Note: Any controller method can be embedded in the dashboard, not just reports. So if you have a popup that you'd like to make available as a dashboard widget, you can use [WidgetsList.addWidgets](/api-reference/events#widgetslistaddwidgets) to do so. This is exactly how we made the [Visitor Profile](http://piwik.org/docs/user-profile/) available in the dashboard._

### Core Visualizations

The following are a set of visualizations, called **Core Visualizations**, that come pre-packaged with Piwik (visualizations are listed by their **viewDataTable** ID:

<!-- TODO: IDs should link to images? -->

* **table**: This is the main visualization used to view report data. It is essentially a table of rows and columns.
* **tableAllColumns**: The same as **table** except a couple extra processed metrics are calculated and displayed using the report data.
* **tableGoals**: The same as **table** except goal metrics are processed and displayed for the report and each goal of the website the report is for.
* **graphVerticalBar**: Displays report data as a vertical bar graph. _Uses jqPlot._
* **graphPie**: Displays report data as a pie graph. _Uses jqPlot._
* **graphEvolution**: Displays a set of reports over time as a line graph. Metrics are displayed as different series.
* **cloud**: Displays report labels in a tag cloud using the values of a specified metric as significance.
* **sparkline**: Displays the values of one metric over time as a line graph. Outputs an image as opposed to HTML.

You can use these visualizations when creating [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instances without having to install third-party plugins.

## Creating new Visualizations

Plugins can provide their own visualizations, either for use just within the plugin or as a new visualization that can be applied to any report. The [Treemap Visualization](http://plugins.piwik.org/TreemapVisualization) plugin is an example of this:

<!-- TODO: treemap image -->

This section will explain how [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) works and everything you can do when extending it.

### Extending ViewDataTable

The first step in creating a new visualization is to create a class that descends from [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable). If you are creating a visualization that will not output HTML, then extend directly from [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable). If your visualization will be in HTML, extend from [Visualization](/api-reference/Piwik/Plugin/Visualization).

[Visualization](/api-reference/Piwik/Plugin/Visualization) is a direct descendant of [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) that provides common behavior you see in all core visualizations. That is, it shows the footer icons, the limit selector, the report documentation, the search box and more.

<a name="setting-viewdatatable-metadata"/>
**Setting ViewDataTable metadata**

In your new class that derives from [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) or [Visualization](/api-reference/Piwik/Plugin/Visualization) the first thing you'll want to do is set the necessary visualization metadata. All visualization metadata are stored as class constants. You can set the following constants:

* **ID**: _(required)_ The unique ID for this visualization. This is what gets supplied in the **viewDataTable** query paremeter.
* **TEMPLATE\_FILE**: _(required)_ A reference to a Twig template file, eg, `"@MyPlugin/_myDataTableViz.twig"`.
* **FOOTER\_ICON**: A path from Piwik's root directory to an icon to display in the footer of the visualization.
* **FOOTER\_ICON\_TITLE**: The tooltip to use when the user hovers over the footer icon. Can be a [translation token](/guides/internationalization).

An example:

    class MyVisualization extends Visualization
    {
        const ID = 'myvisualization';
        const TEMPLATE_FILE = '@MyPlugin/_myVisualization.twig';
        const FOOTER_ICON = 'plugins/MyPlugin/images/myvisualization.png';
        const FOOTER_ICON_TITLE = 'My Visualization';
    }

**Adding new display properties**

Visualizations can define their own display properties (in addition to what is available in [Config](/api-reference/Piwik/ViewDataTable/Config)) by creating their own [Config](/api-reference/Piwik/ViewDataTable/Config) class. This new class must derive from [Config](/api-reference/Piwik/ViewDataTable/Config) and the visualization must provide an override for the [ViewDataTable::getDefaultConfig](/api-reference/Piwik/Plugin/ViewDataTable#getdefaultconfig) method that creates an instance of this new class. For example:

    class MyVisualizationConfig extends Config
    {
        public $show_magic_widget = true;

        public $show_disclaimer = false;
    }

    class MyVisualization extends Visualization
    {
        // ... 

        public static function getDefaultConfig()
        {
            return new MyVisualizationConfig();
        }

        // ... 
    }

    // method in MyPlugin's controller
    public function myReport($fetch = false)
    {
        $view = \Piwik\ViewDataTable\Factory::build(
            $defaultType = MyVisualization::ID,
            $apiAction = 'MyPlugin.myReport',
            $controllerMethod = 'MyPlugin.myReport',
        );

        // in a controller method somewhere
        $view = Factory::
        $view->config->show_limit_control = false;

        // set a new property
        $view->config->show_magic_widget = false;

        return $view->render();
    }

Visualizations can also create their own [RequestConfig](/api-reference/Piwik/ViewDataTable/RequestConfig) class for properties that affect the request. The process is the same as creating a custom [Config](/api-reference/Piwik/ViewDataTable/Config) class.

**Changing what data is loaded**

Visualizations can alter exactly what data is loaded by the base [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) class if desired. The evolution graph visualization does this to get reports for the last N periods so it can display data over time. The [treemap visualization](http://plugins.piwik.org/TreemapVisualization) does this to get data for last period so the percent change of each row can be displayed.

To change exactly what data is loaded, visualizations should alter the request by setting the [request_parameters_to_modify](/api-reference/Piwik/ViewDataTable/RequestConfig#request_parameters_to_modify) request config property within the [Visualization::beforeLoadDataTable](/api-reference/Piwik/Plugin/Visualization#beforeloaddatatable) method. For example:

    class MyVisualization extends Visualization
    {
        // ... 

        public function beforeLoadDataTable()
        {
            $date = Common::getRequestVar('date');

            $this->config->request_parameters_to_modify['date'] = Date::factory($date)->subDay(1)->toString();
        }

        // ... 
    }

_Note: If you change what data is loaded, you may also need to override the [Visualization::isThereDataToDisplay](/api-reference/Piwik/Plugin/Visualization#istheredatatodisplay) method. Otherwise the 'no data' message may not appear even if there is no data for the report you are displaying._

**Manipulating report data before displaying**

Visualizations can modify report data after it is loaded by overriding one of the following methods:

* [Visualization::beforeGenericFiltersAreAppliedToLoadedDataTable](/api-reference/Piwik/Plugin/Visualization#beforeGenericFiltersAreAppliedToLoadedDataTable): Called by [Visualization](/api-reference/Piwik/Plugin/Visualization) after report data is loaded and after priority filters in the [filters](/api-reference/Piwik/ViewDataTable/Config#$filters) display property are executed. Called before [generic filters](/guides/piwiks-reporting-api#extra-report-processing) are executed.

  _Override this method if you need to use the report's full data (ie, before it has been limited/truncated/sorted/etc.)._

* [Visualization::afterGenericFiltersAreAppliedToLoadedDataTable](/api-reference/Piwik/Plugin/Visualization#afterGenericFiltersAreAppliedToLoadedDataTable): Called by [Visualization](/api-reference/Piwik/Plugin/Visualization) after report data is loaded, after priority filters are executed and after [generic filters](/guides/piwiks-reporting-api#extra-report-processing) are executed.

  _Override this method if you need to use the report data after it has been sorted/filtered/limited/etc., but before presentation filters have been applied._

* [Visualization::afterAllFiltersAreApplied](/api-reference/Piwik/Plugin/Visualization#afterAllFiltersAreApplied): Called by [Visualization](/api-reference/Piwik/Plugin/Visualization) after all filters (priority, generic and queued) are executed.

  _Override this method if you need to use the report data after it is ready to be displayed._

_Note: Report data can also be manipulated by setting the [filters](/api-reference/Piwik/ViewDataTable/Config#$filters) display property._

**Making your visualization available to Piwik users**

If you want to allow Piwik users to use your visualization on any report (by clicking the appropriate footer icon), add it to the global list of available visualizations in the [ViewDataTable.addViewDataTable](/api-reference/events#viewdatatableaddviewdatatable) event:

    // event handler for ViewDataTable.addViewDataTable in MyPlugin plugin
    public function addViewDataTable(&$visualizations)
    {
        $visualizations[] = 'Piwik\\Plugins\\MyPlugin\\Visualizations\\MyVisualization';
    }

Visualizations that are exposed this way must have the **FOOTER\_ICON** and **FOOTER\_ICON\_TITLE** [ViewDataTable metadata](#setting-viewdatatable-metadata) set.

### Extending ViewDataTable's JavaScript

Extending [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) is only half the battle. Unless your visualization is very simple or builds on another visualization (such as the **tableAllColumns** and **tableGoals** visualizations) you will probably need to extend ViewDataTable's client-side logic.

All of [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable)'s client side logic is encapsulated within the **DataTable** JavaScript class (located in the [dataTable.js](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/javascripts/dataTable.js) file). If you are extending [Visualization](/api-reference/Piwik/Plugin/Visualization) directly, you should extend **DataTable** to add your own client-side logic. If you're extending another visualization, you will have to extend that visualization's JavaScript class. For example:

    (function ($, require) {

        var exports = require('piwik/UI'),
            DataTable = exports.DataTable,
            dataTablePrototype = DataTable.prototype;

        /**
         * Class that handles UI behavior for the MyVisualization visualization.
         */
        exports.MyVisualization = function (element) {
            DataTable.call(this, element);
        };

        $.extend(exports.MyVisualization.prototype, dataTablePrototype, {
            // ...
        });

    }(jQuery, require));

When extending **DataTable** the only method you are required to override is the **init** method. Here, you should place your visualization's initialization code:

    $.extend(exports.MyVisualization.prototype, dataTablePrototype, {

        init: function () {
            dataTablePrototype.init.call(this);

            this._bindEventCallbacks(this.$element);
            this._addSeriesPicker(this.$element);

            // ... etc. ...
        }
    })

After you extend the class, you must notify [Visualization](/api-reference/Piwik/Plugin/Visualization) of the new class by setting the [datatable_js_type](/api-reference/Piwik/ViewDataTable/Config#datatable_js_type) display property in your visualization. For example:

    class MyVisualization extends Visualization
    {
        // ...

        public function beforeRender()
        {
            $this->config->datatable_js_type = 'MyVisualization';
        }

        // ...
    }

**Adding new UI controls**

Some visualizations will require UI controls that are not in the base report display. The graph visualizations included with Piwik, for example, add a widget called the **series picker** to the UI:

<!-- TODO: image of all three graphs w/ metric picker -->

New controls can be added one of two ways. They can be added entirely through JavaScript (as is done with the **series picker**) or the HTML for a control can be rendered with a visualization and the visualization's JavaScript class can attach some logic to the HTML.

**To add controls entirely in JavaScript,** create HTML elements dynamically within your visualization's JavaScript class' **init** method. See [the series picker source code](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/javascripts/seriesPicker.js) for an example.

**To add controls without having to create HTML elements in JavaScript,** add HTML to your visualization's twig template then bind logic to the HTML in your visualization's JavaScript. See [the treemap plugin](https://github.com/piwik/plugin-TreemapVisualization/blob/master/javascripts/treemapViz.js) for an example (the zoom-out button is an extra control).

### Styling your visualization

The root `<div>` of every report visualization will have the **dataTable** CSS class. They will also have a CSS class based on the visualization used. It will look like **dataTableVizMyVisualization** where **MyVisualization** will be the unnamespaced class name of the visualization (for example **dataTableVizHtmlTable**).

You can select all report visualizations with the `.dataTable` CSS selector. You can select report visualizations of a specific type using the visualization specific CSS class, for example, `.dataTableVizHtmlTable` or `.dataTableVizHtmlTable > .dataTableWrapper`.

You can also use the [datatable_css_class](/api-reference/Piwik/ViewDataTable/Config#datatable_css_class) property to add more CSS classes if you need to. This property can be useful if you need to customize a visualization's appearance, but only for specific reports.

### Making your visualization theme-able

To make sure your visualization can be themed, make sure any color value you use in your JavaScript is obtained from CSS. Read about how we accomplish this [here](/guides/theming#theming-colors-used-in-javascript-amp-php).

## Learn more

* To learn **how reports are stored and created**, read our [All About Analytics](/guides/all-about-analytics-data) guide.
* To see a **full example of creating a new visualization**, see the source for the [Treemap Visualization](https://github.com/piwik/plugin-TreemapVisualization) plugin.
* To learn more about **Piwik Controllers and outputting HTML**, read our [MVC in Piwik](/guides/mvc-in-piwik) guide.
* To learn more about **interacting with Piwik's client side JavaScript**, read our [Working with Piwik's UI](/guides/working-with-piwiks-ui) guide.
---
category: Develop
---
# Custom Report

In our [Setting up](/guides/getting-started-part-1) guide you set up your development environment and created a new plugin. In this guide, we'll make that plugin do something and in the process, you'll learn about different Piwik concepts.

This guide will show you:

- **how to define new reports and expose them through Piwik's [Reporting API](/api-reference/reporting-api)**
- **how to use JavaScript in a plugin**

## Adding a new report

We're going to create a new report that shows the browsers used for the most recent visits. We'll be using data returned by the [Live!](http://piwik.org/docs/real-time/#the-real-time-live-widget) plugin so we won't have to do much processing ourselves.

<div markdown="1" class="alert alert-warning">
**On reports and metrics**

Reports and metrics are the two types of analytics data Piwik calculates and stores:

- *metrics* are just single values, like **visits**
- *reports* are two dimensional arrays of values, usually metric values, and are stored using the [DataTable](/api-reference/Piwik/DataTable) class.

Additionally, each row of a report can link to another DataTable. These linked DataTables are called **subtables**.
</div>

To add a new report you should use the CLI tool and execute the following command:

    ./console generate:report

This command will guide you through the creation of a report and ask for several things such as the name of your plugin and the name of the report you want to create. When it asks you for a report name, enter "Last Visits By Browser", choose the category "Visitors" by moving the arrow keys up or down and leave the dimension empty.

### Adding a menu item

The CLI tool has created a new file `Reports/GetLastVisitsByBrowser.php` within your plugin folder. We recommend to take the time to have a look at all the methods and comments to get an idea how a report is defined.

Links to Piwik's reporting pages are displayed on the main page under the logo:

<img src="/img/reporting_menu.png"/>

Making your report visible in the menu is as easy as opening the report class and defining a menu title in the `init()` method:

    $this->menuTitle = 'Real-time Reports';

Sometimes the title of the menu item is the same as the report name. In this case you can simplify the menu title definition as follows:

    $this->menuTitle = $this->name;

<img src="/img/myplugin_visitors_menu_item.png"/>

If you click on it, the page will be loaded below the period selector:

<img src="/img/myplugin_index_embed.png"/>

### Making it a widget

A widget allows users to add your report to the dashboard. It also lets them embed the report on other websites, for example using an iframe.

Making a widget is also very easy. Just define a property named `widgetTitle` and you are done.

    $this->widgetTitle = 'Real-time Reports';

## Adding a API method

Reports and metrics are served by API class methods.

The report generator automatically creates this method for you so you just have to fill it. In your plugin's API class (stored in `API.php`), look for the following method:

    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        ...
    }

<div markdown="1" class="alert alert-warning">
**API parameters**

Every API method that serves a report or a metric will have the parameters listed above. This is because all analytics data describes log data that is tracked for a certain website and during a certain period. A [segment](http://piwik.org/docs/segmentation/) can be provided to further reduce the data that is analyzed, but it's optional (which is why the parameter defaults to `false`).

The website is determined by the `$idSite` parameter and the period by both the `$period` and `$date` parameters. The segment is determined by the value in the `$segment` parameter.
</div>

You can see the output of this method if you visit this URL: [http://localhost/index.php?module=API&method=MyPlugin.getLastVisitsByBrowser&idSite=1&date=today&period=week](http://localhost/index.php?module=API&method=MyPlugin.getLastVisitsByBrowser&idSite=1&date=today&period=week).

### Implementing the API method

Our new report will use realtime visit data. To get it, our API method will use the `Live.getLastVisitsDetails` method:

    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        $data = \Piwik\Plugins\Live\API::getInstance()->getLastVisitsDetails(
            $idSite,
            $period,
            $date,
            $segment,
            $numLastVisitorsToFetch = 100,
            $minTimestamp = false,
            $flat = false,
            $doNotFetchActions = true
        );
        $data->applyQueuedFilters();

        // TODO

        return false;
    }

`$data` will be a [DataTable](/api-reference/Piwik/DataTable) instance that stores information about visits; each visit being a DataTable row.

Now that we've got a list of visits, let's think about what our report will look like. Our report will count the number of visits for each browser. So each row will have the browser name and the number of visits. It might look something like this:

    label   | nb_visits
    -------------------
    Chrome  | 24
    Firefox | 32
    Safari  | 28

<div markdown="1" class="alert alert-warning">
**DataTable Column Names**

It might look odd that we use `label` and `nb_visits` for our report's column names instead of just `Browser` and `Visits`. That's because reports served through the API should be easy to process by other applications. Using `label`, which is common to all Piwik reports, means apps that use the API can easily tell which column describes the row without having to know the details of the report.

Eventually, before we display the report, these column names will be replaced with names that are more informative to human viewers.
</div>

To create the report, we'll go through every visit and increment the counter for the browser. The counter will be the `nb_visits` column.

Change the method to the following:

    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        $data = \Piwik\Plugins\Live\API::getInstance()->getLastVisitsDetails(
            $idSite,
            $period,
            $date,
            $segment,
            $numLastVisitorsToFetch = 100,
            $minTimestamp = false,
            $flat = false,
            $doNotFetchActions = true
        );
        $data->applyQueuedFilters();

        // we could create a new instance by using new DataTable(),
        // but we would loose DataTable metadata, which can be useful.
        $result = $data->getEmptyClone($keepFilters = false);

        foreach ($data->getRows() as $visitRow) {
            $browserName = $visitRow->getColumn('browserName');

            // try and get the row in the result DataTable for the browser
            $browserRow = $result->getRowFromLabel($browserName);

            // if there is no row for this browser, create it
            if ($browserRow === false) {
                $result->addRowFromSimpleArray(array(
                    'label'     => $browserName,
                    'nb_visits' => 1
                ));
            } else { // if there is a row, increment the counter
                $counter = $browserRow->getColumn('nb_visits');
                $browserRow->setColumn('nb_visits', $counter + 1);
            }
        }

        return $result;
    }

If you visit [http://localhost/index.php?module=API&method=MyPlugin.getLastVisitsByBrowser&idSite=1&date=today&period=week](http://localhost/index.php?module=API&method=MyPlugin.getLastVisitsByBrowser&idSite=1&date=today&period=week) you should see the new report!

<div markdown="1" class="alert alert-warning">
**Realtime Reports vs Archived Reports**

This new API method directly accesses visit data. That is because the report is a real-time report. Most reports aren't in real-time because the amount of time it would take to process visit data would make the interface unusable.

Archived reports are calculated and **cached** during the [Archiving Process](/guides/archiving). To learn more, read about Piwik's [Data Model](/guides/data-model) guide.
</div>

### Displaying the report

Now that we've defined a new report, we need to define how the report should be displayed. We'll do this by going back to the `GetLastVisitsByBrowser` class and modify the `configureView()` method:

    public function configureView(ViewDataTable $view)
    {
        // The ViewDataTable must be configured so the display is perfect for the report.
        // This is done by setting properties of the ViewDataTable::$config object.

        // Disable the 'Show All Columns' footer icon
        $view->config->show_table_all_columns = false;
        // The 'label' column will have 'Browser' as a title
        $view->config->addTranslation('label', 'Browser');

        $view->config->columns_to_display = array_merge(array('label'), $this->metrics);
    }

As we will only display the number of visitors and not the number of unique visitors or actions which Piwik assumes by default we need to modify the supported metrics in the `init()` method of the report as follows:

    $this->metrics = array('nb_visits');

The report should now look like this:

<img src="/img/myplugin_index_embed_2.png"/>

<div markdown="1" class="alert alert-warning">
**Report Visualizations**

The [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) class outputs a **report visualization**. Report visualizations display an analytics report in some way. They can be in any format, for example HTML with JavaScript (like the default **table** visualization, or one of the graphs) or an image (like the **sparkline** visualization).

It is possible for plugins to create their own visualizations. To find out how, read our [Visualizing Report Data](/guides/visualizing-report-data) guide (after you're done with this guide, of course).
</div>

## Updating the report in realtime

So now there's a page with a report that displays the browsers of the latest visitors. It uses realtime data, but it's not truly realtime since after a couple minutes, the report will be out of date. To make the report more realtime we'll update the report every 10 seconds automatically.

### Adding JavaScript files to Piwik

To make the report reload itself, we'll have to write some JavaScript code. This means we'll need a JavaScript file.

Create an empty `javascripts/plugin.js` file in your plugin directory. Then register to the [AssetManager.getJavaScriptFiles](/api-reference/events#assetmanagergetjavascriptfiles) event to have this javascript file included by Piwik:

    class MyPlugin extends \Piwik\Plugin
    {
        public function getListHooksRegistered()
        {
            return array(
                'AssetManager.getJavaScriptFiles' => 'getJavaScriptFiles',
            );
        }
    
        public function getJavaScriptFiles(&$files)
        {
            $files[] = 'plugins/MyPlugin/javascripts/plugin.js';
        }
    }

Remember that Piwik will include this file directly only when `disable_merged_assets` is enabled in your ini config:

    [Development]
    disable_merged_assets = 1

If this option is disabled, Piwik will merge all Javascript files into one to optimize the page loading time, but that means that any change to `plugin.js` will be ignored.

### Reloading the report

In your `plugin.js` file, add the following code:

    $(document).ready(function () {

        setInterval(function () {

            // get the root element for our report
            var $dataTableRoot = $('.dataTable[data-report="MyPlugin.getLastVisitsByBrowser"]');

            // in the UI, the root element of a report has a JavaScript object associated to it.
            // we can use this object to reload the report.
            var dataTableInstance = $dataTableRoot.data('uiControlObject');

            // we want the table to be completely reset, so we'll reset some
            // query parameters then reload the report
            dataTableInstance.resetAllFilters();
            dataTableInstance.reloadAjaxDataTable();

        }, 10 * 1000);
        
    });
    
As you can see, all our javascript code is inside the `$(document).ready` callback. This is because we want the Javascript code to be executed when the page is fully loaded.

Now if you open the report in your browser, you'll see the report being reloaded every 10 seconds.

Well, our simple plugin is done! It defines a new report, displays it and makes sure the data it displays is fresh. 

<div markdown="1" class="alert alert-warning">
**Security in Piwik**

If you believe you're ready to start developing your plugin, please take the time to read our guide about [Security in Piwik](/guides/security-in-piwik). We have very high security standards that your plugin **must** respect.
</div>

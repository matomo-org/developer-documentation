# Getting Started Part II: Tour of Piwik Internals

## About this guide

In [Part I](/guides/getting-started-part-1) you set up your development environment and created a new plugin. In this guide, we'll make that plugin do something and in the process, you'll learn about different Piwik concepts.

This guide will show you:

- **how to define controllers to add new pages to Piwik**
- **how to define new reports and expose them through Piwik's [Reporting API](/api-reference/reporting-api)**
- **how to use JavaScript in a plugin**

**Guide Assumptions**

This guide assumes that you've completed [Part I](/guides/getting-started-part-1) of this guide.

## Make your plugin do something

For this guide we don't want to do anything really complicated, so we'll just define a new analytics report that uses raw log data (so we don't have to process it) and add a new page to Piwik that displays the report.

### Adding a new report

Now let's make it show something useful. We're going to create a new report that shows the browsers used by the most recent visits to a website. We'll be using data returned by the [Live!](http://piwik.org/docs/real-time/#the-real-time-live-widget) plugin so we won't have to do much processing ourselves.

<div markdown="1" class="alert alert-warning">
**On reports and metrics**

Reports and metrics are the two types of analytics data Piwik calculates and stores. Metrics are just single values, like **visits**. Reports are two dimensional arrays of values, usually metric values, and are stored using the [DataTable](/api-reference/Piwik/DataTable) class.

Additionally, each row of a report can link to another DataTable. These linked DataTables are called **subtables**.
</div>

To add a new report you should use the CLI tool and execute the following command:

`./console generate:report`

This command will guide you through the creation of a report and ask you several things such as the name of your plugin and the name of the report you want to create. When it asks you for a report name enter "Last Visits By Browser", choose the category "Visitors" by moving the arrow keys up or down and leave the dimension empty.

#### Adding a menu item

First, let's add a new reporting page to Piwik. Links to Piwik's reporting pages are displayed on the main page under the logo:

<img src="/img/reporting_menu.png"/>

The CLI tool has created a new file **Reports/GetLastVisitsByBrowser.php** within your plugin folder. We recommend to take the time to have a look at all those methods and comments to get an idea how a report is defined. Making your report visible in the menu is as easy as opening the previously created report file and defining a menu title in the **init()** method:

    $this->menuTitle = 'Real-time Reports'

Sometimes the title of the menu item is the same as the report name. In this case you can simplify the menu title definition as follows:

    $this->menuTitle = $this->name;

<img src="/img/myplugin_visitors_menu_item.png"/>

If you click on it, the page will be loaded below the period selector:

<img src="/img/myplugin_index_embed.png"/>

#### Making it a widget

Making a widget is as easy as adding the report to the menu. Just define a property named **widgetTitle** instead of **menuTitle** and you are done.

    $this->widgetTitle = 'Real-time Reports'

A widget allows users to add your report to the dashboard and they can embed the report for instance using an iframe on any page.

### Adding a API method

Reports and metrics should always be served through API class methods. The report generator automatically creates this method for you so we only have to implement it. In your plugin's API class (stored in **API.php**), look for the following method:

    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        ...
    }

<div markdown="1" class="alert alert-warning">
**Analytics Parameters**

Every API method that serves a report or metric will have the parameters listed above. This is because all analytics data describes log data that is tracked for a certain website and during a certain period. A [segment](http://piwik.org/docs/segmentation/) can be supplied to further reduce the data that is analyzed, but it is optional (which is why the parameter defaults to `false`).

The website is determined by the `$idSite` parameter and the period by both the `$period` and `$date` parameters. The segment is determined by the value in the `$segment` parameter.
</div>

You can see the output of this method if you visit this URL: **http://localhost/index.php?module=API&method=MyPlugin.getLastVisitsByBrowser&idSite=1&date=today&period=week**.

#### Implementing the API method

Our new report will use realtime visit data, so the first thing our API method must do is get it. We'll use the **Live.getLastVisitsDetails** method:

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

This will return a [DataTable](/api-reference/Piwik/DataTable) instance that stores information about a visit in each DataTable row.

Now that we've got a list of visits, we can write the code that builds our report. Before we do that, however, let's think about what our report will look like. Our report will count the number of visits for each browser used, so each row will have the name of the browser and the number of visits. It might look something like this:

    label   | nb_visits
    ----------------
    Chrome  | 24
    Firefox | 32
    Safari  | 28

<div markdown="1" class="alert alert-warning">
**DataTable Column Names**

It might look odd that we use **label** and **nb_visits** for our report's column names instead of just **Browser** and **Visits**. That's because reports served through the API should be easy to process by other machines. Using **label**, which is common to all Piwik reports, means apps that use the API can easily tell which column of a row describes the row without having to know the exact report.

Eventually, before we display the report to the user, these column names will be replaced with names that are more informative to human viewers.
</div>

To create this report, we'll go through every visit in the data returned by **Live.getLastVisitsDetails**, get a counter based on the visit's browser and increment it. Since our result report will contain a numeric value for each browser, we can use the **Visits** column values in the report as our counters. Change the method to the following:

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

        $result = $data->getEmptyClone($keepFilters = false); // we could create a new instance by using new DataTable(),
                                                              // but that wouldn't copy DataTable metadata, which can be
                                                              // useful.

        foreach ($data->getRows() as $visitRow) {
            $browserName = $visitRow->getColumn('browserName');

            // try and get the row in the result DataTable for the browser used in this visit
            $resultRowForBrowser = $result->getRowFromLabel($browserName);

            // if there is no row for this browser, create it
            if ($resultRowForBrowser === false) {
                $result->addRowFromSimpleArray(array(
                    'label' => $browserName,
                    'nb_visits' => 1
                ));
            } else { // if there is a row, increment the visit count
                $resultRowForBrowser->setColumn('nb_visits', $resultRowForBrowser->getColumn('nb_visits') + 1);
            }
        }

        return $result;
    }

If you visit **http://localhost/index.php?module=API&method=MyPlugin.getLastVisitsByBrowser&idSite=1&date=today&period=week** you should see the new report!

<div markdown="1" class="alert alert-warning">
**Realtime Reports vs Archived Reports**

This new API method directly accesses visit data. That is because the report is a real-time report. Most reports aren't in real-time because the amount of time it would take to process visit data would make the UI unusable. These reports are calculated and **cached** during the [Archiving Process](http://piwik.org/docs/setup-auto-archiving/). To learn more, read our [All About Analytics Data](/guides/all-about-analytics-data) guide.
</div>

#### Displaying the report

Now that we've defined a new report, we need to define how the report should be displayed. We'll do this by going back to the **GetLastVisitsByBrowser** class and modify the **configureView** method:

    public function configureView(ViewDataTable $view)
    {
        // The ViewDataTable must be configured so the display is perfect for the report.
        // This is done by setting properties of the ViewDataTable::$config object.

        // here, we disable the 'Show All Columns' footer icon and we also make sure the 'label' column has the
        // 'Browser' title, so users will know what is shown in that column.

        $view->config->show_table_all_columns = false;
        $view->config->addTranslation('label', 'Browser');

        $view->config->columns_to_display = array_merge(array('label'), $this->metrics);
    }

As we will only display the number of visitors and not the number of unique visitors or actions which Piwik assumes by default we need to modify the supported metrics in the **init** method of the report as follows:

    $this->metrics('nb_visits');

If everything worked the report will look like this:

<img src="/img/myplugin_index_embed_2.png"/>

<div markdown="1" class="alert alert-warning">
**Report Visualizations**

The [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) class outputs a **report visualization**. Report visualizations display an analytics report in some way. They can be in any format, including HTML with JavaScript (like the default **table** visualization or one of the graphs) or an image (like the **sparkline** visualization).

It is possible for plugins to create their own visualizations. To find out how, read our [Visualizing Report Data](/guides/visualizing-report-data) guide (after you're done with this guide, of course).
</div>

### Updating the report in realtime

So now there's a page with a report that displays the browsers of the latest visitors. It uses realtime data, but it's not truly realtime since after a couple minutes, the report will be out of date. To make the report more realtime we'll update the report every 10 seconds automatically.

#### Adding JavaScript files to Piwik

To make the report reload itself, we'll have to write some JavaScript code. This means we'll need a JavaScript file.

The `console` command line tool will automatically generate a JavaScript file called **plugin.js** which we'll use. If it didn't exist, though, we'd have to create a new file in the **javascripts** subdirectory and let Piwik know about it through the [AssetManager.getJavaScriptFiles](/api-reference/events#assetmanagergetjavascriptfiles) event.

#### Reloading the report

In your **plugin.js** file, add the following code in the `$(document).ready` callback:

    setInterval(function () {

        // get the root element for our report
        var $dataTableRoot = $('div.dataTable[data-report="MyPlugin.getLastVisitsByBrowser"]');

        // in the UI, the root element of a displayed report has a JavaScript object associated with it.
        // we can use this object to reload the report.
        var dataTableInstance = $dataTableRoot.data('uiControlObject');

        // we want the table to be completely reset, so we'll reset some query parameters then reload
        // the report
        dataTableInstance.resetAllFilters();
        dataTableInstance.reloadAjaxDataTable();

    }, 10 * 1000);

If you click on the menu item for your report, you'll see the report being reloaded.

Well, our simple plugin is done! It defines a new report, displays it and makes sure the data it displays is fresh. But we can do better! [The next guide](/guides/getting-started-part-3) will show you how.

<div markdown="1" class="alert alert-warning">
**If you believe you're ready to start developing your plugin,** please take the time to read our security guide [Security in Piwik](/guides/security-in-piwik). We have very high security standards that your plugin or contribution **must** respect.
</div>

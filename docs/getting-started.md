# Getting started extending Piwik

<!-- Meta (to be deleted)
Purpose:
 - tell people what's possible by extending Piwik
 - tell people we don't really know what isn't possible so feel free to try everything!
 - get people setup and ready to create a plugin
   - mention phpstorm (it appears to be important)
   - mention command line tool
   - get people to install piwik locally
   - create a site or two
   - add some test data
 - show people how to create a plugin
   - don't use command line tool until the end
 - point people in the right direction for whatever they are trying to do (tell them what to read)

Audience: someone who uses Piwik or knows Piwik is an analytics tool and wants to extend it. He/she might be a user that knows what Piwik can do and wants it to do more, or a user of another piece of software that wants it to work w/ Piwik.

Expected Result: the reader must both know how to get Piwik running locally, have a new, empty plugin ready and know where to go to figure out exactly what it is they want to do.

Notes: This guide is a cross between a tutorial & a guide. It should be linked to as introductory material in the tutorials (in other words, there shouldn't be another 'getting started' tutorial).

TODO: (stuff that needs to go in SOME guide)
- DataTable row actions

TODO: removed scheduled reports guide. should be replaced w/ two tutorials (new output format + new transport medium)
-->

So you're a Piwik user and you need Piwik to do something it doesn't do. Or maybe you're a user of another web app and you want to integrate it with this amazing analytics software you've heard so much about (Piwik, naturally). Well, you've come to the right place!

This guide will show you:

- **how to get your development environment setup,**
- **how to create a new Piwik Plugin,**
- **and where to go next to continue building your extension.**

## Piwik Plugins

Pretty much all the functionality you see when you use Piwik is provided through **_Piwik Plugins_**. The core of Piwik (unsurprisingly termed _**Piwik Core**_) contains the tools that the plugins use to provide this functionality. If you wanted to add more functionality to Piwik you'd create your own plugin and distribute it on the [Piwik Marketplace](#) so other users could use it.

_Note: If you want to integrate another piece of software with Piwik and you only need to know how to track visits or how to retrieve reports, read more about the [Tracking API](#) and the [Reporting API](#)._

### What's possible with Piwik plugins?

Here are some of the things you could accomplish through your own plugin:

- track new visitor data and create new reports that aggregate the new data
- track third party data and display it in new reports
- show existing reports in novel new ways
- send scheduled reports through new mediums or in new formats

These are only a few of the possibilities. Many of the existing plugins do things that cannot be categorized in such a way. For example, the [Annotations](#) plugin lets users create save notes for dates without needing any modifications to **Piwik Core**. The [DBStats](#) plugin will show users statistics about their MySQL database. The [Dashboard](#) plugin provides a configurable way to view multiple reports at once.

**Whatever ideas your imagination cooks up, we think it's highly probable you can implement them with Piwik.**

### What's not possible with Piwik plugins?

Well, we're not really sure. It might be hard to get your idea to scale, or maybe your idea involves creating some hardware that you have to distribute, but these problems can all be overcome in some way.

**Right now, we think _anything_ is possible with Piwik, and we want YOU to prove us right!**

## Guide Assumptions

This guide assumes that you, the reader, can code in PHP and can setup your own local webserver. If you do not have these skills, you will not be able to successfully understand this guide.

TODO: resources for learning PHP and setting up a localhost server

## Getting setup to extend Piwik

### Get the appropriate tools

Before we start extending Piwik, let's make sure you have the tools you'll need to do so. Make sure you have the following installed:

- **A PHP IDE or a text editor.** We who work on Piwik reccommend you use [PHPStorm](#), a very powerful IDE built specifically for developing in PHP.
- **A webserver,** such as [Apache](#) or [Nginx](#).
- **[git](#)** so you can work with the latest Piwik source code.
- **[composer](http://getcomposer.org/) so you can install the PHP libraries Piwik uses.
- **A browser,** such as [Firefox](#) or [Chrome](#). Ok, so this you've probably got.

The following tools aren't required for this guide, but you may find them useful when you continue writing your plugin:

- **[PHPUnit](#)** Necessary if you want to write or run automated tests.
- **[xhprof](#)** If you'd like to profile your code and debug any inefficiencies. See also [our guide for installing xhprof](#).
- **[python](#)** If you're going to be doing something with the log importer.

### Get & Install Piwik

Now that you've got the necessary tools, you can install Piwik. First, we'll get the very latest version of Piwik's source code using git.

Open a terminal and `cd` into the directory where you want to install Piwik. Then run the following command:

    git clone https://github.com/piwik/piwik piwik

Then run the following command to install some third party libraries:

    composer.phar install

Now that you've got a copy of Piwik, you'll need to point your webserver to it. The specific instructions for configuring your webserver depends on the webserver itself. You can see instructions for Apache [here](#) and instructions for Nginx [here](#).

Once your webserver is configured, load Piwik in your browser by going to the URL `http://localhost/`. Complete the installation process by following the instructions presented to you.

### Add some test data

You've got the necessary tools and Piwik itself. You're ready to create your first plugin now, but before we do that, let's add some test data for you to play with.

In your browser load Piwik and navigate to _Settings > Plugins > Manage_. Look for the _Visitor Generator_ plugin and enable it. Then on the admin menu to the left, click on _Visitor Generator_ (under _Diagnostic_).

On this page you'll see a form where you can select a site and enter a number of days to generate data for:

TODO: image goes here

Let's generate data for three days. Enter **3** in the **Days to compute** field, check the **Yes, I am sure!** checkbox and click **Submit**.

Now click on the **Dashboard** link at the top of the screen. You should see that reports that were previously empty now display some statistics:

TODO: image goes here

## Create a plugin

You're development environment is setup, and you are now ready to create a plugin! Creating a plugin consists primarily of creating a couple files. Piwik comes with a handy command-line tool that will do this legwork for you. In the root directory of your Piwik install, run the following command:

    ./console generate:plugin --name="MyPlugin"

Replace **MyPlugin** with the name of your plugin (for example, **UserSettings** or **DevicesDetection**). When the tool asks if it should create an API & Controller, enter `'y'`.

In your browser load Piwik and navigate to _Settings > Plugins > Manage_. Look for your plugin in the list of plugins, you should see it disabled:

TODO: image goes here (use disabled MyPlugin image)

<a name="plugin-directory-structure"></a>
**Plugin directory structure**

The command-line tool will create a new directory for your plugin (in the **plugins** sub-directory) and fill it with some files and folders. Here's what these files and folders are for:

* **API.php**: Contains your plugin's API class. This class defines methods that serve data and will be accessible through Piwik's [Reporting API](#).
* **Controller.php**: Contains your plugin's Controller class. This class defines methods that generate HTML output.
* **MyPlugin.php**: Contains your plugin's Plugin Descriptor class. This class contains metadata about your plugin and a list of event handlers for Piwik events.
* **plugin.json**: Contains plugin metadata such as the name, description, version, etc.
* **README.md**: A dummy README file for your plugin.
* **javascripts**: This folder is where you'll put all your new JavaScript files.
* **screenshots**: TODO: ???
* **templates**: This folder is where you'll put all your [Twig](http://twig.sensiolabs.org/) templates.

## Make your plugin do something

For this guide we don't want to do anything really complicated, so we'll just define a new analytics report that uses realtime data and add a new page to Piwik that displays the report. We'll also add some settings so the data the report displays will change.

### Adding a new reporting page

First, let's add a new reporting page to Piwik. Links to Piwik's reporting pages are displayed on the main page under the logo:

TODO image

What gets put there is determined by plugins that add menu items through the [MenuMain](#) class.

#### Adding a controller method

To add a new page, we'll start by creating the page itself. In Piwik, HTML is generated and served by [Controller](#) methods, so we'll add a new method to your plugin's controller. Since the HTML generated by this method will be the main page for this plugin, we'll call the method **index**.

    class Controller extends \Piwik\Plugin\Controller
    {
        // the output of this method will be accessible via a URL like index.php?module=MyPlugin&action=index
        public function index()
        {

        }
    }

#### Using a View

Inside the Controller method we'll generate HTML by using a [View](#). View objects manage Twig templates; they define some basic properties, [filters](#) and [Twig functions](#) for templates to use, and allow you to set other template properties.

Right now, we don't have much to display, so we won't be setting any properties. In your controller method, add the following code (replacing `'MyPlugin'` with the name of your plugin):

    $view = new View("@MyPlugin/index.twig");
    echo $view->render();

TODO: the following paragraph is a note.

Our template will be named **index.twig** since the method it's in is named `'index'`. This is the naming convention used in Piwik. If a template doesn't correspond to a controller method, its name should describe what it outputs and be prefixed with an underscore (for example, **_dataTable.twig**).

#### Adding a Twig template

Now we'll create our Twig template. In the **templates** subdirectory of your plugin's root directory, add a file named **index.twig**. In the file, add the following code:

    <h1>Real Time Analytics</h1>

    <strong>Hello world!</strong>

If you open a browser and open the URL **http://localhost/index.php?module=MyPlugin&action=index&idSite=1&date=today&period=day** after replacing **MyPlugin** with the name of your plugin, you should see the page you just created!

TODO: image

#### Adding a menu item

Now that there's a page, we need to add it to the reporting menu so users can get to it. The [MenuMain](#) class (and other menu managing classes) allows plugins to add menu items through an **event** named [Menu.Reporting.addItems](#).

TODO: below paragraph is another sidenote

**Events** are one of the main ways Piwik allows plugins to add new functionality. At certain points during execution, Piwik will post an event to the **EventDispatcher**. Plugins can register callbacks with events so those callbacks will be called when events are posted.

Our plugin has to handle this event, so we'll associate a method with the event. In the **getListHooksRegistered** method of your plugin descriptor class (the class that extends [Piwik\Plugin](#) and has the same name as your plugin), add the following code:

    return array(
        'AssetManager.getJavaScriptFiles' => 'getJsFiles',
        'Menu.Reporting.addItems' => 'getReportingMenuItems'
    );

Then add this method to the class:

    public function getReportingMenuItems()
    {
        Piwik\Menu\MenuMain::getInstance()->add(
            $category = 'General_Visitors',                       // this is a 'translation token'. it will be replaced by
                                                                  // a translated string based on the user's language preference.
                                                                  // read about internationalization below to learn more.
            $title = 'Real-time Reports',
            $urlParams = array('module' => $this->getPluginName(), 'action' => 'index')
        );
    }

Now, if you load Piwik in a browser, you'll see the menu item:

TODO image

If you click on it, the page will be loaded below the period selector:

TODO image

### Adding a new report

We've created a plugin and got it to display something in Piwik's UI. Now let's make it show something useful. We're going to create a new report that uses the real time visit data returned by the [Live!](#) plugin and reports on the browsers used.

TODO: another Note below

**On reports and metrics:** Reports and metrics are the two types of analytics data Piwik calculates and stores. Metrics are just single values, like **visits**. Reports are two dimensional arrays of values, usually metric values and are stored using the [DataTable](#) class.

#### Adding an API method

Reports and metrics are all served through API class methods, so we'll add a new one for our report. In your plugin's API class (stored in **API.php**), add the following method:

    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        return array();
    }

TODO: another Note below (2 paragraphs)

Every API method that serves a report or metric will have the parameters listed above. This is because all analytics data describes data that is tracked for a certain website and during a certain period. A [segment](#) can be supplied to further reduce the data that is analyzed, but it is optional (which is why the parameter defaults to `false`).

The website is determined by the `$idSite` parameter and the period by both the `$period` and `$date` parameters. The segment is determined by the value in the `$segment` parameter.

You can see the output of this method if you visit this URL: **http://localhost/index.php?module=API&method=MyPlugin.getLastVisitsByBrowser&idSite=1&date=today&period=week** (remember to replace **MyPlugin** with the name of your plugin).

#### Implementing the API method

Our new report will use real time visit data, so the first thing our API method must do is get it. We'll use the **Live.getLastVisitsDetails** method:

    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        $data = Piwik\Plugins\Live\API::getInstance()->getLastVisitsDetails(
            $idSite,
            $period,
            $date,
            $segment,
            $numLastVisitorsToFetch = 100,
            $minTimestamp = false,
            $flat = false,
            $doNotFetchActions = true
        );

        return array();
    }

This will return a [DataTable](#) instance that holds information for each visit in its rows.

TODO: another note below

As stated above [DataTable](#)s store report data. They are essentially just an array of rows, where each row is an array of columns.

Now that we've got a list of visits, we need to count the number of visits for each browser used. We'll do this by manually iterating through each row to create a new [DataTable](#) instance:

    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        $data = Piwik\Plugins\Live\API::getInstance()->getLastVisitsDetails(
            $idSite,
            $period,
            $date,
            $segment,
            $numLastVisitorsToFetch = 100,
            $minTimestamp = false,
            $flat = false,
            $doNotFetchActions = true
        );

        $result = $data->getEmptyClone($keepFilters = false); // we could create a new instance by using new DataTable(),
                                                              // but that wouldn't copy DataTable metadata, which can be
                                                              // useful.

        foreach ($data->getRows() as $visitRow) {
            $browserName = $visitRow->getColumn('browserName');

            $resultRowForBrowser = $result->getRowFromLabel($browserName);

            // if there is no row for this browser, create it
            if ($resultRowForBrowser === false) {
                $result->addRowFromSimpleArray(array(
                    'label' => $browserName,
                    'nb_visits' => 1
                ));
            } else { // if there is a row, increment the visit count
                $resultRowForBrowser->setColumn('nb_visits', $resultRowFromBrowser->getColumn('nb_visits') + 1);
            }
        }

        return $result;
    }

If you visit **http://localhost/index.php?module=API&method=MyPlugin.getLastVisitsByBrowser&idSite=1&date=today&period=week** you should see the new report!

TODO: need to test the tutorial

TODO: another note below

This new API method directly accesses visit data. That is because the report is a real-time report. Most reports aren't in real-time because the amount of time it would take to process the visits they report on would make the UI unusable. These reports are calculated and **cached** during the [Archiving Process](#). To learn more, read our [All About Analytics Data](#) guide.

### Displaying the report

Now that we've defined a new report, we need to display it. We'll do this be adding a new method to our controller:

    public function getLastVisitsByBrowser()
    {
        // ...
    }

We add a new method because we'll be using a special view class that will sometimes use AJAX to reload the report, so there has to be a way to get **just** the HTML for the display.

The special view class we'll use is called [ViewDataTable](#), and here's how we'll use it:

    public function getLastVisitsByBrowser()
    {
        // ViewDataTable instances are created by the Factory, not through the new operator
        $view = Piwik\ViewDataTable\Factory::build(
            $defaultVisualization = 'table',
            $apiAction = 'MyPlugin.getLastVisitsByBrowser' // remember to replace MyPlugin with the name of your plugin
        );

        // after a ViewDataTable instance is created, it must be configured so the display is perfect
        // for the report. this is done by setting properties of the ViewDataTable::$config object.
        $view->config->show_table_all_columns = false;
        $view->config->show_goals = false;
        $view->config->translations['label'] = 'Browser';

        return $view->render();
    }

Now that we have a method that outputs a display for the report, we need to embed it in the plugin's main page. Change the `index()` controller method to look like this:

    public function index()
    {
        $view = new View("@MyPlugin/index.twig");
        $view->getLastVisitsByBrowserReport = $this->getLastVisitsByBrowser();
        echo $view->render();
    }

And change the **index.twig** template to look like this:

    <h1>Real Time Analytics</h1>

    {{ getLastVisitsByBrowserReport|raw }}

Now if you view the page in Piwik, you'll see something like this:

TODO image

### Updating the report in realtime

So now there's a page with a report that displays the browsers of the latest visitors. It uses realtime data, but it's not truly realtime since after a couple minutes, the report will be out of date. To make the report more realtime we'll make sure it updates itself every 30 seconds.

#### Adding JavaScript files to Piwik

To make the report reload itself, we'll have to write some JavaScript code. This means we'll need a JavaScript file.

The `console` command line tool will automatically generate a JavaScript file called **plugin.js** which we'll use. If it didn't exist, though, we'd have to create a new file in the **javascripts** subdirectory and let Piwik know about it by handling the [AssetManager.getJavaScriptFiles](#) event.

#### Reloading the report

In your **plugin.js** file, add the following code in the `$(document).ready` callback:

    // we select each report so we only create intervals if there are relevant reports on the page
    $('div.dataTable[data-report=MyPlugin.getLastVisitsByBrowser]').each(function () { // remember to replace MyPlugin w/ your plugin's name!
        var domElement = this;

        // in the UI, the root element of a displayed report has a JavaScript object associated with it.
        // we can use this object to reload the report.
        var dataTableInstance = $(domElement).data('uiControlObject');

        setInterval(function () {
            dataTableInstance.reloadAjaxDataTable();
        }, 1000 * 30);
    });

If you view the report now and open the console ([Firebug](#) for Firefox, developer tools for Chrome), you should see the new AJAX requests being sent:

TODO: images

Well, our simple plugin is done! It defines a new report, displays it and makes sure the data it displays is fresh. But we can do better! The next two sections will show you how.

### Making the report configurable

The report we've defined is interesting, but we could easily aggregate on another visit property. For example, the report could be **getLastVisitsByScreenType** or **getLastVisitsByCity**. In this section, we're going to make it possible for users to change what the report displays.

#### Creating a plugin setting

We'll create a **plugin setting** which will control which visit property the plugin uses to generate our report. The first step is to create a **Settings** class:

    namespace Piwik\Plugins\MyPlugin; // remember to rename MyPlugin with the name of your plugin

    class Settings extends \Piwik\Plugin\Settings
    {
        protected function init()
        {
            // ...
        }
    }

Put this class in a file called **Settings.php** in your plugin's root directory.

The **Settings** class is a special class that is automatically detected by Piwik. Piwik uses the information it sets to add a new section for your plugin in the _Plugins > Settings_ admin page.

We're going to create one setting that can be set differently by each user. First, let's think about our new setting. It's going to determine the column of the **Live.getLastVisitsDetails** that we'll aggregate by. So it's a string and has a limited number of valid values. We'll use a single select dropdown (just a normal `<select>`) for it.

Now, let's add an attribute and new method for this setting:

    class Settings extends \Piwik\Plugin\Settings
    {
        public $realtimeReportDimension;

        protected function init()
        {
            $this->realtimeReportDimension = $this->createRealtimeReportDimensionSetting();
        }

        private function createRealtimeReportDimensionSetting()
        {
            // ...
        }
    }

Then we'll implement the `createRealtimeReportDimensionSetting` method:

    private function createRealtimeReportDimensionSetting()
    {
        $setting = new \Piwik\Settings\UserSetting();
        $setting->type = self::TYPE_STRING;
        $setting->uiControlType = self::CONTROL_SINGLE_SELECT;
        $setting->description   = 'Choose the dimension to aggregate by';
        $setting->availableValues = MyPlugin::$availableDimensionsForAggregation; // replace 'MyPlugin'!
        $setting->defaultValue = 'browser';
        return $setting;
    }

Notice how `$settings->availableValues` is set to `MyPlugin::$availableDimensionsForAggregation`. The **availableValues** property should be set to an array mapping column values with their appropriate display text. This array will probably come in handy later, so we'll stash it in our plugin descriptor class.

In your plugin descriptor class add the following code:

    public static $availableDimensionsForAggregation = array(
        'browser' => 'Browser',
        'visitIp' => 'IP Address',
        'visitorId' => 'Visitor ID',
        'searches' => 'Number of Site Searches',
        'events' => 'Number of Events',
        'actions' => 'Number of Actions',
        'visitDurationPretty' => 'Visit Duration',
        'country' => 'Country',
        'region' => 'Region',
        'city' => 'City',
        'operatingSystem' => 'Operating System',
        'screenType' => 'Screen Type',
        'resolution' => 'Resolution'

        // we could add more, but let's not waste time.
    );

If you go to the _Plugins > Settings_ admin page you should see this new setting:

TODO: image

#### Using the new setting

To use the setting, first we need to get the setting value in our API method and then aggregate using it. Change your API method to look like this:

    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        // get realtime visit data
        $data = Piwik\Plugins\Live\API::getInstance()->getLastVisitsDetails(
            $idSite,
            $period,
            $date,
            $segment,
            $numLastVisitorsToFetch = 100,
            $minTimestamp = false,
            $flat = false,
            $doNotFetchActions = true
        );

        // read the setting value that contains the column value to aggregate on
        $settings = new Settings();
        $columnValue = $settings->realtimeReportDimension->getValue();

        // count visits to create our result
        $result = $data->getEmptyClone($keepFilters = false); // we could create a new instance by using new DataTable(),
                                                              // but that wouldn't copy DataTable metadata, which can be
                                                              // useful.

        foreach ($data->getRows() as $visitRow) {
            $columnValue = $visitRow->getColumn($columnName);

            $resultRowForBrowser = $result->getRowFromLabel($columnValue);

            // if there is no row for this browser, create it
            if ($resultRowForBrowser === false) {
                $result->addRowFromSimpleArray(array(
                    'label' => $columnValue,
                    'nb_visits' => 1
                ));
            } else { // if there is a row, increment the visit count
                $resultRowForBrowser->setColumn('nb_visits', $resultRowFromBrowser->getColumn('nb_visits') + 1);
            }
        }

        return $result;
    }

Now we'll want to make sure the column heading in the report display has the correct text. Right now, it will display **Browser** no matter what the setting value is:

TODO: image

Change the **getLastVisitsByBrowser** controller method to the following:

    public function getLastVisitsByBrowser()
    {
        // ViewDataTable instances are created by the Factory, not through the new operator
        $view = Piwik\ViewDataTable\Factory::build(
            $defaultVisualization = 'table',
            $apiAction = 'MyPlugin.getLastVisitsByBrowser' // remember to replace MyPlugin with the name of your plugin
        );

        // after a ViewDataTable instance is created, it must be configured so the display is perfect
        // for the report. this is done by setting properties of the ViewDataTable::$config object.
        $view->config->show_table_all_columns = false;
        $view->config->show_goals = false;

        $settings = new Settings();
        $columnToAggregate = $settings->realtimeReportDimension->getValue();
        $columnLabel = MyPlugin::$availableDimensionsForAggregation[$columnToAggregate]; // remember to replace MyPlugin with the name of your plugin

        $view->config->translations['label'] = $columnLabel;

        return $view->render();
    }

### Internationalizing your plugin

TODO: possible to internationalize a plugin?

### Conclusion

## What to read next

Ok! You've set up your development environment and created your plugin! Now all you have to do is make it do what you want. The bad news is that this is the hard part. The good news is that we've written a bunch of other guides to help you shorten the learning curve.

**_Note: Our guides are great, but if you learn better through examples or just don't want to do a lot of reading, why not check out our [tutorials](#)? We've written one for everything we think you might want to do._**

Based on what you want your plugin to accomplish, here's what you might want to read next:

* **If **


TODO: make sure the below are in the list directly above this.
**The Console Tool**

The **console** tool we just used can do more than create a new plugin. If you'd like to know more about what it can do, you can read about it [here](#).

### Plugin Debugging Tools (FIXME: Tools is a bad word...)

**Test Data Generation**

**Logging**

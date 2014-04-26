# Getting Started Part III: Extras

## About this guide

In [Part II](/guides/getting-started-part-2) you created a plugin that defines and displays a new report. In this guide, we'll enhance that plugin by making it configurable and internationalized. You'll learn:

* **how to add settings to your plugin**
* **how to make your plugin available in multiple languages**

**Guide Assumptions**

This guide assumes that you've completed [Part II](/guides/getting-started-part-2) of this guide.

### Making the report configurable

The report we've defined is interesting, but we could easily aggregate on another visit property. For example, the report could be **getLastVisitsByScreenType** or **getLastVisitsByCity**. In this section, we're going to make it possible for users to change what the report displays.

#### Creating a plugin setting

We'll create a **plugin setting** which will control which visit property the plugin uses to generate our report. The first step is to create a **Settings** class:

    <?php

    namespace Piwik\Plugins\MyPlugin;

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
            $this->addSetting($this->realtimeReportDimension);
        }

        private function createRealtimeReportDimensionSetting()
        {
            // ...
        }
    }

Then we'll implement the `createRealtimeReportDimensionSetting` method:

    private function createRealtimeReportDimensionSetting()
    {
        $setting = new \Piwik\Settings\UserSetting('reportDimension', 'Report Dimension');
        $setting->type = self::TYPE_STRING;
        $setting->uiControlType = self::CONTROL_SINGLE_SELECT;
        $setting->description   = 'Choose the dimension to aggregate by';
        $setting->availableValues = MyPlugin::$availableDimensionsForAggregation;
        $setting->defaultValue = 'browserName';
        return $setting;
    }

Notice how `$settings->availableValues` is set to `MyPlugin::$availableDimensionsForAggregation`. The **availableValues** property should be set to an array mapping column values with their appropriate display text. This array will probably come in handy later, so we'll stash it in our plugin descriptor class.

In your plugin descriptor class add the following code:

    public static $availableDimensionsForAggregation = array(
        'browserName' => 'Browser',
        'visitIp' => 'IP',
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

<img src="/img/myplugin_settings_page.png"/>

#### Using the new setting

To use the setting, first we need to get the setting value in our API method and then aggregate using it. Change your API method to look like this:

    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        // get realtime visit data
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

        // read the setting value that contains the column value to aggregate by
        $settings = new Settings('MyPlugin');
        $columnName = $settings->realtimeReportDimension->getValue();

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
                $resultRowForBrowser->setColumn('nb_visits', $resultRowForBrowser->getColumn('nb_visits') + 1);
            }
        }

        return $result;
    }

Now we'll want to make sure the column heading in the report display has the correct text. Right now, it will display **Browser** no matter what the setting value is:

<img src="/img/myplugin_incorrect_browser_header.png"/>

Change the **getLastVisitsByBrowser** controller method to the following:

    public function getLastVisitsByBrowser()
    {
        // ViewDataTable instances are created by the Factory, not through the new operator
        $view = \Piwik\ViewDataTable\Factory::build(
            $defaultVisualization = 'table',
            $apiAction = 'MyPlugin.getLastVisitsByBrowser'
        );

        // after a ViewDataTable instance is created, it must be configured so the display is perfect
        // for the report. this is done by setting properties of the ViewDataTable::$config object.
        $view->config->show_table_all_columns = false;
        $view->config->show_goals = false;

        $settings = new Settings('MyPlugin');
        $columnToAggregate = $settings->realtimeReportDimension->getValue();
        $columnLabel = MyPlugin::$availableDimensionsForAggregation[$columnToAggregate];

        $view->config->translations['label'] = $columnLabel;

        return $view->render();
    }

View the report now and you'll see:

<img src="/img/myplugin_correct_browser_header.png"/>

#### Rename the report

Finally, we'll rename the report. After all, it can do more than just aggregate the last 100 visits by browser now. Rename all occurances of **getLastVisitsByBrowser** with **getLastVisitsByDimension**. Make sure you replace it in the following files:

* API.php
* Controller.php
* plugin.js
* index.twig

### Internationalizing your plugin

The other improvement we'll make to our plugin is to use Piwik's [internationalization](http://en.wikipedia.org/wiki/Internationalization) system so our plugin can be made available in multiple languages.

Internationalization is achieved in Piwik by replacing translated text, like `"Realtime Analytics"`, with unique identifiers, like `"MyPlugin_RealtimeAnalytics"` called **translation tokens**.

Translation tokens are associated with translated text in multiple JSON files, one for each supported language. In code, the translation tokens are converted into translated text based on the user's selected language.

#### Creating a language file

To internationalize our plugin, first, we'll create an english language file to hold our translated text. In your plugin's root directory, create a subdirectory named **lang**. In that folder, create a file named **en.json** and put the following in it:

    {
        "MyPlugin": {

        }
    }

We're going to move all of the translated text in our plugin to this file.

#### Internationalizing our Twig Template

Translation tokens are translated in templates via the [translate](http://developer.piwik.org/api-reference/Piwik/View) Twig filter. We use two pieces of translated text in our template: `"Realtime Analytics"` and `"Reload"`. First, we'll add entries for them in the **en.json** file we just created. We'll use the **RealtimeAnalytics** and "Reload" translation tokens:

    {
        "MyPlugin": {
            "RealtimeAnalytics": "Realtime Analytics",
            "Reload": "Reload"
        }
    }

Then replace the text in your template with the following:

    <h1>{{ 'MyPlugin_RealtimeAnalytics'|translate }}</h1>

    {{ getLastVisitsByDimensionReport|raw }}

    <a id="realtime-reports-reload" href="#">{{ 'MyPlugin_Reload'|translate }}</a>

#### Internationalizing our setting

Now, let's internationalize the text we use in our **Settings** class. First, we'll add entries for the text we use:

    {
        "MyPlugin": {
            "RealtimeAnalytics": "Realtime Analytics",
            "Reload": "Reload",
            "ReportDimensionSettingDescription" : "Choose the dimension to aggregate by"
        }
    }

Then we'll use the new translation token in the **createRealtimeReportDimensionSetting** method:

    $setting->description   = \Piwik::translate('MyPlugin_ReportDimensionSettingDescription');

We also need to internationalize the names of each possible setting value. We'll do this by using translated text in the `MyPlugin::$availableDimensionsForAggregation` static variable. Of course, we can't call [Piwik::translate](/api-reference/Piwik/Piwik#translate) when setting a static field, so we'll have to add a new method that returns the array.

We're not going to add any translation tokens to our **en.json** file this time. This is because the translations already exist for core plugins. Replace the `MyPlugin::$availableDimensionsForAggregation` field with this:

    public static $availableDimensionsForAggregation = array(
        'browser' => 'UserSettings_ColumnBrowser',
        'visitIp' => 'General_IP',
        'visitorId' => 'General_VisitorID',
        'searches' => 'General_NbSearches',
        'events' => 'Events_NbEvents',
        'actions' => 'General_NbActions',
        'visitDurationPretty' => 'VisitorInterest_ColumnVisitDuration',
        'country' => 'UserCountry_Country',
        'region' => 'UserCountry_Region',
        'city' => 'UserCountry_City',
        'operatingSystem' => 'UserSettings_ColumnOperatingSystem',
        'screenType' => 'UserSettings_ColumnTypeOfScreen',
        'resolution' => 'UserSettings_ColumnResolution'

        // we could add more, but let's not waste time.
    );

Then, add this method to your plugin's plugin descriptor class:

    public static function getAvailableDimensionsForAggregation()
    {
        return array_map(array('Piwik', 'translate'), self::$availableDimensionsForAggregation);
    }

Finally in the **createRealtimeReportDimensionSetting** method, replace `MyPlugin::$availableDimensionsForAggregation` with `MyPlugin::getAvailableDimensionsForAggregation()`.

#### Internationalizing report column headers

Since we already use translation tokens in the `MyPlugin::$availableDimensionsForAggregation` field, and the column headers are set using the same data, all we have to do is use `MyPlugin::getAvailableDimensionsForAggregation` in the **getLastVisitsByDimension** controller method:

    $columnTranslations = MyPlugin::getAvailableDimensionsForAggregation();
    $columnLabel = $columnTranslations[$columnToAggregate];

<div markdown="1" class="alert alert-warning">
**If you believe you're ready to start developing your plugin,** please take the time to read our security guide [Security in Piwik](/guides/security-in-piwik). We have very high security standards that your plugin or contribution **must** respect.
</div>

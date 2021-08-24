---
category: Develop
title: Plugin Directory Structure
---
# Matomo Plugin Directory Structure

Each plugin has its own directory within the root `plugins/` directory. Generally, plugins have a similar [structure as the Matomo core](/guides/how-piwik-works) for most things. Most plugins have only few files, while some others have more files. Below is a list of some files and directories that may exist in a plugin.


| File / Directory      | Description |
| ----------- | ----------- |
| plugin.json      | Contains [metadata about the plugin](/guides/distributing-your-plugin#prepare-your-plugin) such as contact information, a description, and more. Mostly needed for plugins on the Marketplace.      |
|  $PluginName.php  |    `$PluginName` needs to be replaced with the name of the plugin. This file is the plugin file which allows plugins to listen to [events](/guides/events) and method hooks such as `install()`, `activate` and `uninstall()`.      |
|  Activity/  |    This directory includes activities that should be logged for the [Matomo Activity / Audit Log](https://plugins.matomo.org/ActivityLog)  premium feature.     |
|  API.php  |    Defines [API methods](/guides/expose-api-methods) for this plugin.     |
|  Archiver.php  |    This file includes logic on how to create archive reports from log raw data.     |
|  Categories/  |     This directory includes menu categories and subcategories that are used to build the reporting menu. They define for example the order in which they are shown in the menu.    |
|  Columns/ |     This directory includes [dimensions](/guides/dimensions) and metrics.    |
|  Commands/ |     This directory includes [console commands](/guides/piwik-on-the-command-line).    |
|  config/ |     This directory can include various files like "config.php" and "test.php" to change Matomo using [dependency injection](/guides/dependency-injection).    |
|  Controller.php  |     Defines [controller actions](/guides/pages) for this plugin.    |
|  Dao/  |     This directory includes data access objects that connect mostly to the database and execute queries. It doesn't contain much logic usually.    |
|  DataTable/Filter  |     This directory may include [custom plugin data table filters](/guides/datatable#custom-filter).    |
|  Diagnostic/  |     This directory typically includes [system checks](/guides/system-check).    |
|  docs/index.md  |     The markdown content of this file will be shown in a Documentation tab on the Marketplace.    |
|  docs/faq.md  |     The markdown content of this file will be shown in a FAQ tab on the Marketplace.    |
|  images/ |     This directory includes images and icons that are shown in the user interface.    |
|  lang/ |     This directory includes [language files for translations](/guides/translations).    |
|  libs/ |     This directory may include third party libraries. Alternatively a `node_modules` directory can be used.    |
|  javascripts/ |     This directory includes JS files.    |
|  MeasurableSettings.php  |    Defines custom [settings](/guides/plugin-settings) for a measurable / site in Matomo.     |
|  Menu.php  |    This file is used to add, remove or change [menu entries](/guides/menus).     |
|  Model/  |    This directory includes Models. These typically use `Dao` classes and have more logic.     |
|  Reports/  |     This directory includes [reports](/guides/custom-reports). One PHP file for each report.      |
|  screenshots/ |     This directory includes screenshots of the plugin, which are then shown on our Matomo Marketplace.    |
|  Updates/  |     This directory includes [migration update](/guides/updates-aka-migrations) files.      |
|  UserSettings.php  |     Defines [user settings](/guides/plugin-settings) which are shown in the personal settings page and can be edited by each user. The setting is stored differently for each user, meaning a change here doesn't affect other users' settings.    |
|  stylesheets/ |     This directory includes CSS or less stylesheet files.    |
|  SystemSettings.php  |    Defines [system settings](/guides/plugin-settings) which are shown in Matomo's general settings and can be edited by a superuser.     |
|  Tasks.php  |    Defines [scheduled tasks](/guides/scheduled-tasks) that are executed periodically similar to a cron.     |
|  templates/ |     This directory includes twig template files.    |
|  tests/Fixtures/  |     This directory includes all kind of fixtures for our automated tests.       |
|  tests/Framework/Mock  |     This directory may include PHP mocks used in PHP tests.      |
|  tests/Integration/  |     This directory includes integration [PHP tests](/guides/tests-php).       |
|  tests/javascript/index.php  |     This file includes [JavaScript tests](/guides/jstracker-core#tests) for our JS tracker and Tag Manager.      |
|  tests/javascript/head.php  |     This file can be used to load additional JS files in JavaScript tests for our JS tracker and Tag Manager.      |
|  tests/UI/  |     This directory includes [UI screenshot tests](/guides/tests-ui). Each test file ends with `_spec.js`.       |
|  tests/Unit/  |     This directory includes unit [PHP tests](/guides/tests-php).       |
|  tests/System/  |     This directory includes system [PHP tests](/guides/tests-php).       |
|  tracker.js  |     If such a file is present, then this code will be added to the [Matomo JavaScript tracking code](/guides/enrich-js-tracker). If a `tracker.min.js` exists then the minified version will be used.   |
|  Tracker/RequestProcessor.php  |     This file is typically used to [hook into various events during a tracking request](/guides/tracking-requests).      |
|  Tracker/LogTable/  |     This directory can include log tables if the plugin creates custom log tables for tracking data.      |
|  vendor/  |     Libraries installed by Composer.      |
|  VisitorDetails.php  |    This file is used to add [additional information to the visitor log or visitor profile](/guides/visitor-log-and-profile).     |
|  Visualizations/  |     This directory includes [visualizations](/guides/visualizing-report-data) that show report data differently.      |
|  Widgets/  |     This directory includes [widgets](/guides/widgets). One PHP file for each widget.    |

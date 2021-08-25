---
category: DevelopInDepth
---
# How Matomo Works

## About this guide

Read this guide if

- you'd like **to have an overview on how Matomo works**
- you'd like **to contribute to Matomo and want to understand its architecture**

This guide assumes that you:

- have a **general understanding of web technologies** like web applications, servers, HTTP, PHP...

## Introduction

Matomo is an application that does mainly two things:

- **collect and store** analytics data
- provide **reports** of the stored data

To achieve that result, several parts of Matomo come into play:

- the [JavaScript tracker](/api-reference/tracking-javascript) is served by Matomo via HTTP so that websites can include it in their pages
- the tracker collects data on the web page it's included in and sends it to Matomo by calling the [HTTP tracking API](/api-reference/tracking-api)
- the **archiving** task runs and pre-processes data (either on the fly or via a cron task)
- data is exposed in **reports**, which are accessible through the web interface or the [HTTP reporting API](/api-reference/reporting-api)

## The plugin architecture

Matomo's codebase is composed of:

- **Matomo Core**, which provides the base of the application along with extension points
- **Plugins**, which use the extension points to add behaviour and content to the application

Plugins are not just targeted at 3rd party developers who want to customize Matomo: most of Matomo is implemented through plugins. Matomo Core is meant to be as small as possible.

As a result, there are two kinds of plugins:

- **default plugins** provide Matomo's base features: they are included in the repository and in the distribution
- **optional plugins** can be installed manually (by copying them in the `plugins/` folder) or through [Matomo's Marketplace](https://plugins.matomo.org/) in the web interface

## The codebase

Here are the main files and folders composing Matomo's codebase:

```bash
config/
core/           # Matomo Core classes
lang/           # Translations
plugins/        # Plugin classes along with their assets
tests/
vendor/         # Libraries installed by Composer
node_modules/   # UI libraries installed by npm
console         # Entry point for the CLI interface
index.php       # Entry point for the web application and the HTTP reporting API
matomo.php      # Entry point for the HTTP tracking API
piwik.php       # Entry point for the HTTP tracking API - for backwards compatibility
piwik.js        # JavaScript tracker to be included in websites - for backwards compatibility
matomo.js       # JavaScript tracker to be included in websites
js/             # Includes the unminified JS tracker and the PHP files allows users to use JS tracking code without having the matomo or piwik in the name.
```

Matomo uses [Composer](https://getcomposer.org/) to install its dependencies (PHP libraries) into the `vendor/` directory and npm to install node JavaScript libraries into the `node_modules` directory. The files from the `node_modules` directory are committed to the Git repository, so users won't need to run any npm commands to keep packages up to date and this way we guarantee they use the right versions.

### Plugin structure

[Click here to learn more about the plugin directory structure](/guides/plugin-directory-structure).

## Installation and configuration

Matomo detects whether it has been installed by checking if the `config/config.ini.php` file exists. During the installation this file will be created and Matomo knows whether the installation is in progress through a `[General]installation_in_progress=1` setting in the config file.

Matomo has a lot of [configurations](/guides/piwiks-ini-configuration) to change default behaviour. This configuration is meant to be edited by Matomo administrators.

Plugin developers may also use [dependency injection](/guides/dependency-injection) to change the way Matomo works.

## Interfaces

### The Matomo user interface

The entry point for the web application is `index.php` in the root. This file initializes everything and calls the `FrontController` class.

Matomo's user interface is built upon HTML and JavaScript. While some pages are HTML documents served by PHP controllers (built using the [Twig templating engine](https://twig.sensiolabs.org/)), some parts of the Matomo UI are built with AngularJS (currently being migrated to Vue.js).

AngularJS and Vue.js are front-end JavaScript frameworks. This means that the user interface is built on the client side and the data is fetched from the HTTP Reporting API (described in the next section) as JSON. That also means a better user experience, as it lets Matomo developers build a more dynamic and reactive application.

A part of Matomo's long-term roadmap is to move more and more parts of Matomo's UI to Vue.js.

Read more about this in the ["Working with Matomo's UI" guide](/guides/working-with-piwiks-ui).

#### Controllers 

The front controller will route an incoming HTTP request to a plugin **controller** based on URL parameters:

    /index.php?module=CoreHome&action=index&…

In this example, the front controller will call the action `index` on the controller of the `CoreHome` plugin. In the file `plugins/CoreHome/Controller.php` the `index()` method will be called.

Plugin controllers return a **string** (usually HTML content) which is sent in the HTTP response.

#### Widgets and reports

If the specified controller action cannot be found, then Matomo checks if there is a matching widget or report having this name.

If one is found, it will call the `render()` method of the widget or alternatively the report. This is done in the `CoreHome.renderWidget` and `CoreHome.renderReportWidget` controller action and the matching widget or report is found in the [ControllerResolver](https://github.com/matomo-org/matomo/blob/4.4.1/core/Http/ControllerResolver.php#L47-L65).

### The HTTP Reporting API

The [HTTP reporting API](/api-reference/reporting-api) works similarly to the web application. Its role is to serve **reports** in machine-readable formats (XML, JSON, …). It also serves information about various entities such as sites, users, goals, and more.

It has the same entry point and is also dispatched by the front controller.

    /index.php?module=API&method=SEO.getRank&…

This HTTP request will be processed like any other call to a controller: the plugin name is `API` and no `action` is given, which will fall back to `index`.

The `Piwik\Plugin\API\Controller` class will be called, and it will dispatch the call to the targeted API, acting as a second front controller for API calls. In our example, the method `SEO.getRank ` means that the `Piwik\Plugin\SEO\API::getRank()` method will be called.

API requests are authenticated using a `token_auth` URL parameter and usually don't have a session loaded unless the `force_api_session=1` parameter is present. Learn more about [Authentication in Matomo](/guides/authentication-in-depth).

### The HTTP Tracking API

This [HTTP tracking API](/api-reference/tracking-api) lets the JavaScript tracker **submit analytics data** to be saved in Piwik.

Its entry point is different from Matomo's web application and HTTP reporting API: it is through the `matomo.php` file. Some older Matomo installations might still use `piwik.php`.

There are also various other [Tracking Clients](/guides/tracking-api-clients).

During tracking not all plugins are loaded. For performance reasons only the plugins that are identified as being needed during tracking will be loaded.

Any tracked data is stored in `log_*` tables. These tables store all the raw data which is then later aggregated to report archives, see below. For each new visit and for each action a visitor takes a new row is created in their respective log tables. Some log tables such as `log_visit` are also updated during a tracking request.  

### The command line

Matomo offers a command line API through the `./console` script. This script uses the [Symfony Console component](https://symfony.com/doc/current/components/console/introduction.html).

Plugins can expose CLI commands that can be invoked like this:

    ./console visitorgenerator:generate-visits

Command classes are located in `plugins/*/Commands` and are auto-detected by Piwik.

Read more about this in the ["Matomo on the Command Line" guide](/guides/piwik-on-the-command-line).

## Data model, processing and storage

Matomo lets you collect analytics data to then later retrieve as reports. Let's see what happens in-between and how Matomo models, processes and stores data.

### Log data: raw analytics data

The HTTP tracking API (i.e. the `Piwik\Tracker` component) receives **raw** analytics data, which we call "**Log data**".

Log data is represented in PHP as `Piwik\Tracker\Visit` objects, and is stored into the following tables:

- `log_visit` contains one entry per visit (returning visitor)
- `log_action` contains all the type of actions possible on the website (e.g. unique URLs, page titles, download URLs…)
- `log_link_visit_action` contains one entry per action of a visitor (page view, …)
- `log_conversion` contains conversions (actions that match goals) that happen during a visit
- `log_conversion_item` contains e-commerce conversion items

Those tables are designed and optimized for fast insertions, as the tracking API needs to be as fast as possible in order to handle websites with heavy traffic.

The content of those tables (and their related PHP entities) is explained in more details in the ["Matomo database schema" guide](/guides/database-schema#log-data-persistence).

### The archiving process

The log tables above are not designed or optimized for extracting high-level reports: aggregating the log entries to the day, week or month can become too intensive when there is a lot of data.

The **archiving process** will read log data (also known as raw data) and aggregate this data to produce "**Archive data**" (also known as reports). This is done for reports for a specific day. An example query that would count the number of visits for a specific day would look like `select count(*) as nb_visits from log_visit where idsite = 1 and visit_last_action_time >= '2021-08-04 00:00:00' and visit_last_action_time < '2021-08-05 00:00:00'`. 

All other periods (`week`, `month`, `year`, and custom date `range`) are generated by aggregating the reporting data from each sub period. This means for these periods we don't query the log data, but instead generate the reporting data for a week by aggregating the reports of each day within that week. To aggregate the data for a month it will aggregate the reports of various weeks and days within that month. To aggregate the data for the year, it will aggregate the reporting data of each month within the year. We don't generate these reports from the log data for these periods, as it would take too long to generate these reports for such a long period. The only exception are a few metrics like [unique visitors and unique users which may be generated from raw data for these periods](https://matomo.org/faq/how-to/faq_113/).

Archive data can be:

- **numeric metric records**: simple numeric values (like the number of page views or the number of visists)

    These are stored in the `archive_numeric_*` tables. Values are stored as float.

- **table records**: bidimensional data (can be numeric values as well as anything else), represented as [`DataTable`](/guides/datatable) objects

    These are stored in the `archive_blob_*` tables. `DataTable` objects are serialized to a string and compressed to be stored as `BLOB` in the table.

Both numeric and table record objects stored in the database are named *records* to differentiate them from `DataTable` objects manipulated and returned by Matomo's API that we name *reports*.

Every numeric metric or table record is processed and stored at each aggregation level: day, week and month. For example, that means that the "Entry pages" report is processed and stored for every day of the month as well as for every week, month, year and custom date range. Such data is redundant, but that is essential to guarantee fast performance when requesting a specific period.

Because Archive data must be fast to query, it is divided in separate tables per month. We will then have:

- `archive_numeric_2021_10`: metrics for October 2021
- `archive_blob_2021_10`: reports for October 2021
- `archive_numeric_2021_11`: metrics for November 2021
- `archive_blob_2021_11`: reports for November 2021
- …

The contents of the archive tables are explained in detail in the ["Matomo database schema" guide](/guides/database-schema#archive-tables). The archiving process is explained in detail in the ["Archiving" guide](/guides/archiving).

#### Auto archiving versus browser archiving

By default, Matomo generates these reports "on demand" every time they are requested in the browser or through the API. This can slow down Matomo, and therefore it is possible to configure [auto archiving](https://matomo.org/docs/setup-auto-archiving/) (sometimes also referred to as pre-archiving) which will instead generate these reports in the background periodically through a cron.

To learn more about archiving read our [archiving process guide](/guides/archiving) and our [Archiving Behavior Specification](/guides/archiving-behavior-specification).

### From Archive data to reports

As shown above, data is stored either as numeric metrics or table records.

Reports are [`DataTable`](/guides/datatable) objects and are served by the [API classes defined by plugins](/guides/expose-api-methods). API classes access persisted metrics or records and transform them into presentable reports.

Sometimes, one persisted archive record can be used by different API reports.

You can read more details on how reports are created and served in the ["Reports" guide](/guides/reports).

## Matomo's extensibility points

Matomo Core only defines the main processes and behaviours. Plugins can extend and customize them through several *extensibility points*:

- registering to [**events**](/guides/events), or triggering events
- implementing **special classes** that are recognized by Piwik
- extending certain abstract **base classes**

You can read more about this topic in the ["Matomo's Extensibility Points" guide](/guides/piwiks-extensibility-points).


## Other valuable resources

As a developer or system administrator you might also want to understand:

* [How to conifgure Matomo for security](https://matomo.org/docs/security-how-to/)
* [How to conifgure Matomo for speed](https://matomo.org/docs/optimize-how-to/)


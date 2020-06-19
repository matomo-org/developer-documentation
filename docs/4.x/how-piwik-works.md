---
category: DevelopInDepth
---
# How Piwik Works

## About this guide

Read this guide if

- you'd like **to have an overview on how Piwik works**
- you'd like **to contribute to Piwik and want to understand its architecture**

This guide assumes that you:

- have a **general understanding of web technologies** like web applications, servers, HTTP, PHP...

## Introduction

Piwik is an application that does mainly two things:

- **collect and store** analytics data
- provide **reports** of the stored data

To achieve that result, several parts of Piwik come into play:

- the [JavaScript tracker](/api-reference/tracking-javascript) is served by Piwik via HTTP so that websites can include it in their pages
- the tracker collects data on the web page it's included in and sends it to Piwik by calling the [HTTP tracking API](/api-reference/tracking-api)
- the **archiving** task runs and pre-processes data (either on the fly or via a cron task)
- data is exposed in **reports**, which are accessible through the web interface or the [HTTP reporting API](/api-reference/reporting-api)

## The plugin architecture

Piwik's codebase is composed of:

- **Piwik Core**, which provides the base of the application along with extension points
- **Plugins**, which use the extension points to add behavior and content to the application

Plugins are not just targeted at 3rd party developers who want to customize Piwik: most of Piwik is implemented through plugins. Piwik Core is meant to be as small as possible.

As a result, there are two kinds of plugins:

- **default plugins** provide Piwik's base features: they are included in the repository and in the distribution
- **optional plugins** can be installed manually (by copying them in the `plugins/` folder) or through [Matomo's MarketPlace](https://plugins.matomo.org/) in the web interface

## The codebase

Here are the main files and folders composing Piwik's codebase:

```bash
config/
core/           # Piwik Core classes
lang/           # Translations
plugins/        # Plugin classes along with their assets
tests/
vendor/         # Libraries installed by Composer
console         # Entry point for the CLI interface
index.php       # Entry point for the web application and the HTTP reporting API
matomo.php      # Entry point for the HTTP tracking API
piwik.php       # Entry point for the HTTP tracking API
piwik.js        # JavaScript tracker to be included in websites
matomo.js       # JavaScript tracker to be included in websites
```

Piwik uses [Composer](https://getcomposer.org/) to install its dependencies (PHP libraries) into the `vendor/` directory.

## Interfaces

### The web application

The entry point for the web application is `index.php` in the root. This file initializes everything and calls the `FrontController` class.

The front controller will route an incoming HTTP request to a plugin **controller** based on URL parameters:

    /index.php?module=CoreHome&action=index&…

In this example, the front controller will call the action `index` on the controller of the `CoreHome` plugin.

Plugin controllers return a **view** (usually HTML content) which is sent in the HTTP response.

#### User interface

Piwik's user interface is built upon HTML and JavaScript. While some pages are HTML documents served by PHP controllers (built using the [Twig templating engine](https://twig.sensiolabs.org/)), some parts of the Piwik UI are built with AngularJS.

AngularJS is a front-end JavaScript framework, which means that the user interface is built on the client side and the data is fetched from the HTTP Reporting API (described in the next section) as JSON. That also means a better user experience as it lets Piwik developers build a more dynamic and reactive application.

A part of Piwik's long-term roadmap is to move more and more parts of Piwik's UI to AngularJS.

Read more about this in the ["Working with Piwik's UI" guide](/guides/working-with-piwiks-ui).

### The HTTP Reporting API

The HTTP reporting API works similarly to the web application. Its role is to serve **reports** in machine-readable formats (XML, JSON, …).

It has the same entry point and is also dispatched by the front controller.

    /index.php?module=API&method=SEO.getRank&…

This HTTP request will be processed like any other call to a controller: the plugin name is `API` and no `action` is given, which will fall back to `index`.

The `Piwik\Plugin\API\Controller` class will be called, and it will dispatch the call to the targeted API, acting as a second front controller for API calls. In our example, `SEO.getRank ` means that the `Piwik\Plugin\SEO\API::getRank()` method will be called.

### The HTTP Tracking API

This HTTP API lets the JavaScript tracker **submit analytics data** to be saved in Piwik.

Its entry point is different from Piwik's web application and HTTP reporting API: it is through the `matomo.php` file.

Read more about this in the ["The Tracking HTTP API" reference](/api-reference/tracking-api).

### The command line

Piwik offers a command line API through the `./console` script. This script uses the [Symfony Console component](https://symfony.com/doc/current/components/console/introduction.html).

Plugins can expose CLI commands that can be invoked like this:

    ./console visitorgenerator:generate-visits

Command classes are located in `plugins/*/Commands` and are auto-detected by Piwik.

Read more about this in the ["Piwik on the Command Line" guide](/guides/piwik-on-the-command-line).

## Data model, processing and storage

Piwik lets you collect analytics data to then later retrieve as reports. Let's see what happens in-between and how Piwik models, processes and stores data.

### Log data: raw analytics data

The HTTP tracking API (i.e. the `Piwik\Tracker` component) receives **raw** analytics data, which we call "**Log data**".

Log data is represented in PHP as `Piwik\Tracker\Visit` objects, and is stored into the following tables:

- `log_visit` contains one entry per visit (returning visitor)
- `log_action` contains all the type of actions possible on the website (e.g. unique URLs, page titles, download URLs…)
- `log_link_visit_action` contains one entry per action of a visitor (page view, …)
- `log_conversion` contains conversions (actions that match goals) that happen during a visit
- `log_conversion_item` contains e-commerce conversion items

Those tables are designed and optimized for fast insertions, as the tracking API needs to be as fast as possible in order to handle websites with heavy traffic.

The content of those tables (and their related PHP entities) is explained in more details in the ["Piwik database schema" guide](/guides/database-schema#log-data-persistence).

### The archiving process

The tables above are not designed or optimized for extracting high-level reports: aggregating the log entries to the day, week or month can become too intensive when there is a lot of data.

The **archiving process** will read Log data and aggregate it to produce "**Archive data**". Data is aggregated and stored for each:

- day
- week
- month
- year
- custom date range

Archive data can be:

- **numeric metrics**: simple numeric values (like the number of page views)

    These are stored in the `archive_numeric_*` tables. Values are stored as float.

- **table records**: bidimensional data (can be numeric values as well as anything else), represented as [`Piwik\DataTable`](/api-reference/Piwik/DataTable) objects

    These are stored in the `archive_blob_*` tables. `DataTable` objects are serialized to string and compressed to be stored as `BLOB` in the table.

    `DataTable` objects stored in the database are named *records* to differentiate them from `DataTable` objects manipulated and returned by Piwik's API that we name *reports*.

Every numeric metric or table record is processed and stored at each aggregation level: day, week and month. For example, that means that the "Entry pages" report is processed and stored for every day of the month as well as for every week, month, year and custom date range. Such data is redundant, but that is essential to guarantee fast performances.

Because Archive data must be fast to query, it is splitted in separate tables per month. We will then have:

- `archive_numeric_2014_10`: metrics for October 2014
- `archive_blob_2014_10`: reports for October 2014
- `archive_numeric_2014_11`: metrics for November 2014
- `archive_blob_2014_11`: reports for November 2014
- …

The contents of the archive tables are explained in detail in the ["Piwik database schema" guide](/guides/database-schema#archive-tables). The archiving process is explained in detail in the ["Archiving" guide](/guides/archiving).

### From Archive data to reports

As shown above, data is stored either as numeric metrics or table records.

Reports are [`DataTable`](/api-reference/Piwik/DataTable) objects and are served by the API classes defined by plugins. API classes access persisted metrics or records and transform them into presentable reports.

Sometimes, one persisted record can be the source of several API reports.

You can read more details on how reports are created and served in the ["Reports" guide](/guides/reports).

## Piwik's extensibility points

Piwik Core only defines the main processes and behaviors. Plugins can extend and customize them through several *extensibility points*:

- registering to **events**, or triggering events
- implementing **special classes** that are recognized by Piwik
- extending certain abstract **base classes**

You can read more about this topic in the ["Piwik's Extensibility Points" guide](/guides/piwiks-extensibility-points).

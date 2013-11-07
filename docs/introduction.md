# Introduction
### Why you should build a plugin
### What can be done with the platform

## Understanding the Piwik Platform
### Plugin framework

### Database Schema

**<span style="color: #003300">The DB schema changes regularly due to added functionality and performance improvements. We havent got an up to date DB schema, if you generate one please let us know so we can include it here</span>**

The image was generated using [DBDesigner][1] and the XML source schema can be found in the [ Piwik repository][2]

#### Introduction

The database has been designed with emphasis on simplicity, efficiency and data modularity. The database contains different sections

*   Statistics logger
*   Users &amp; Permissions
*   Site
*   Archived data
*   Debug/Info log
*   SQL query profiling

#### Database Sections

##### Tracking Data

Piwik tracks visitors, page views (ie 'actions'), conversions and Ecommerce products. Tracking is implemented in the most efficient way possible, each SQL query should use an INDEX or do minimal work on the DB. However, tracking in Piwik issues many UPDATE and INSERT statements.

Some of the tracking data comes from the [Piwik JavaScript snippet][3] (screen resolution, plugin support) and some data points from PHP (IP address, user agent). Each unique visitor is assigned a unique id that is saved in a first party cookie. Each new visit creates a row in *log_visit*. If the visitor visits the website twice in the day with more than 30 minutes in between the two visits, there will be two rows in the table *log_visit* for this visitor. On each page view, the table log_visit is updated (since it keeps a count of page views, last page view, etc.).

###### Actions

An action (page view) is defined by a **name** ("homepage", "/blog/hello-world") and a **type** (an integer that defines page/download/etc) (see the class [Piwik_Tracker_Action][4] for more information).

A new action by a visitor creates a record in *log_link_visit_action* containing the **idaction** and the **idvisit**. This table also contains a field **idaction_ref** and **time_spent_ref_action** used to process the "time on page" metric, among others.

###### URLs

URLs are recorded in a "lookup table" piwik_action. Using a hash matching algorithm, URLs are uniquely identified with an integer instead of duplicating the URL for each page view.

###### Goals

When [tracking Goals][5], each conversion is recorded in the table piwik_log_conversion.

###### Ecommerce

When [tracking Ecommerce orders and abandoned carts][6], the visitor cart is kept as a row in piwik_log_conversion.

Individual items (products) are recorded in piwik_log_conversion_items. When a cart is updated, the actual row for this visit's cart in piwik_log_conversion is updated. Items in piwik_log_conversion_items can be set to deleted=1

Related classes: [Piwik_Visit][7], [Piwik_Tracker][8] and the files located in [core/Tracker/][9]. The tracker entry point called by the javascript tag is the file [piwik.php][10].

##### Users &amp; Permissions

A user is defined by:

*   a **login**
*   a **password**
*   an **email**

A **token_auth** is generated and is used to sign API calls.

A user has an **access** level ('view' or 'admin' or 'no access' or the user is 'super admin' and has admin access by default) on a given **idsite**.

Related classes: [Piwik_Access][11], [Piwik_Login][12]

##### Site

A website is defined by an **idsite**, a **main_url** and is linked to *site_url* so it can have several alias **url**.

Related classes: [Piwik_Site][13], and the API for websites [Piwik_SitesManager_API][14]

##### Archived Data

An archive in Piwik is the aggregate of data for a given period. It's the result of the logs being processed into meaningful data (see the section
[Statistics Logger][15]).

A row in this *archive_** table contains some data for a given date/period on a website. For example, a record could contain the list of countries on the website idsite = 3 for the week of the January, 7th 2008.

There are two different tables because there are two data types possible in Piwik archives:

*   float
*   blob

The table *archive_numeric_** is used to store plain numbers. The **value** field has a FLOAT type which means you can save integers and floats. For example, it is used to record the number of visitors over a given period and the number of distinct search engines keywords used.

**The table *archive_blob_** stores anything that is not a number.** A BLOB is a binary data type that can contain anything from strings and compressed strings to serialized arrays and serialized objects. For example, it is used to store the search engine keywords that the visitors used over a given period and the visitors' browsers.

Both tables have exactly the same structure except the type of the **value** field ([BLOB][16] in one case, [ FLOAT][17] in the other). The structure has the following fields:

*   **idarchive** defines a unique archive. All data for a specific website over a specific period (day/week/etc.) for a specific date will have the same **idarchive**. In other words this **idarchive** is the same as if (**idsite**,**period**,**date1**,**date2**) was the primary key.
*   **name** is the description of the **value** of the record. For example, if you store the number of distinct keywords used a pertinent **name** could be 'Referers_distinctKeywords'
*   **idsite** is the website that the record refers to
*   **date1** and **date2** are the starting and ending dates that the record refers to. If the archive refers to a single day, **date1** = **date2**. The class handling the date logic is [Piwik_Date][18].
*   **period** defines the period type: day/week/month/year. All period-related logic is located in the classes [Piwik_Period*][19]
*   **ts_archived** is the timestamp when the archive was built. This is useful if you want to know whether an archive is still valid or not; for example, today's archive could be valid for 1 hour or 1 minute depending on the cache lifetime value
*   **value** contains the data which description is **name**

A record (row) in these archive tables is automatically handled by the classes [Piwik_ArchiveProcessing_Record*][20]. There are different classes in this file:

*   the record manager Piwik_ArchiveProcessing_Record_Manager
*   the numeric record Piwik_ArchiveProcessing_Record_Numeric
*   the blob record Piwik_ArchiveProcessing_Record_Blob
*   the array of blob records Piwik_ArchiveProcessing_Record_Blob_Array

The **archiving logic** can be found in the class [Piwik_ArchiveProcessing][21]:

*   **day archiving** is [Piwik_ArchiveProcessing_Day][22]
*   **period archiving** is [Piwik_ArchiveProcessing_Period][23]

It is important to note that most of the real archiving processing is actually done within plugins that hook on special events (see such hooks in
[ArchiveProcessing_Day][22] search for the call `Piwik_PostEvent()`).

Loading an archive (and launching the archive processing, if necessary) is done via [Piwik_Archive][24].

For performance reasons, the tables are partitioned by month. This means that new tables will be created for each month to ensure that the data is evenly partitioned. If there was only one table containing all the data, it would become huge and lookups would be very slow. Partitioning is done by the class [Piwik_TablePartitioning][25].

See also the monthly partitioning class used for this table: [Piwik_TablePartitioning_Monthly][25].

A different table structure is used for FLOAT and BLOB because it makes it very fast to look up the integer/float values. SQL SELECT is very fast because the tables are light (and the rows of *archive_numeric_** have a fixed length). For example, we need to select the number of visitors for the last 30 days very quickly.

##### Debug/Info Log

The tables *logger_error*, *logger_message*, *logger_api_call* and *logger_exception* are used to log miscellaneous information.

*   *logger_error* is used to log error **messages** along with their information (**line**, PHP file **errfile**, **backtrace**, etc.) raised using [Piwik_Log_Error][26] (see also the [specific error handler function][27] used)
*   *logger_message* is used to log any debug/info **message** raised using [Piwik_Log_Message][28]
*   *logger_api_call* is used to log all the information related to API calls. It will log all the parameter values passed (**parameter_values**), the result of the call (**returned_value**), the **execution_time**, the IP of the user calling the API (**caller_ip**), etc. This information is useful for profiling the API calls, debugging (when the **returned_value** was not right for example) and monitoring the API usage. See the class [Piwik_Log_APICall][29]
*   *logger_exception* is used to log all exceptions that are raised using [Piwik_Log_Exception][30] (see also the [specific exception handler function][31] used).

The general log logic is done in [Piwik_Log][32] (it's using the library [ Zend_Log][33]).

##### SQL Query Profiling

The table log_profiling is used to store profiling information about the SQL queries. You can enable profiling using [Piwik_Tracker_Db::enableProfiling()][34] and output the profiling analysis using [Piwik::printSqlProfilingReportTracker()][35].

#### Notes

*   All of the timestamps in the database are generated by PHP and not using the Mysql functions such as NOW(), CURRENT_DATE(), etc. This is to make sure that the system works well if the MySQL server is on a different box with a different time. The algorithms are not dependant of the MySQL server time.

 [1]: http://fabforce.net/dbdesigner4/
 [2]: https://github.com/piwik/piwik/blob/master/misc/others/db-schema.xml
 [3]: /?page_id=17
 [4]: https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php
 [5]: /?page_id=2023
 [6]: /?page_id=6393
 [7]: https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php
 [8]: https://github.com/piwik/piwik/blob/master/core/Tracker.php
 [9]: https://github.com/piwik/piwik/blob/master/core/Tracker
 [10]: https://github.com/piwik/piwik/blob/master/piwik.php
 [11]: https://github.com/piwik/piwik/blob/master/core/Access.php
 [12]: https://github.com/piwik/piwik/blob/master/plugins/Login.php
 [13]: https://github.com/piwik/piwik/blob/master/core/Site.php
 [14]: https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php
 [15]: http://dev.piwik.org/trac/wiki/DatabaseSchema#Statisticslogger
 [16]: http://dev.mysql.com/doc/refman/5.0/en/blob.html
 [17]: http://dev.mysql.com/doc/refman/5.0/en/numeric-types.html
 [18]: https://github.com/piwik/piwik/blob/master/core/Date.php
 [19]: https://github.com/piwik/piwik/blob/master/core/Period.php
 [20]: https://github.com/piwik/piwik/blob/master/core/ArchiveProcessing/Record.php
 [21]: https://github.com/piwik/piwik/blob/master/core/ArchiveProcessing.php
 [22]: https://github.com/piwik/piwik/blob/master/core/ArchiveProcessing/Day.php
 [23]: https://github.com/piwik/piwik/blob/master/core/ArchiveProcessing/Period.php
 [24]: https://github.com/piwik/piwik/blob/master/core/Archive.php
 [25]: https://github.com/piwik/piwik/blob/master/core/TablePartitioning.php
 [26]: https://github.com/piwik/piwik/blob/master/core/Log/Error.php
 [27]: https://github.com/piwik/piwik/blob/master/core/ErrorHandler.php
 [28]: https://github.com/piwik/piwik/blob/master/core/Log/Message.php
 [29]: https://github.com/piwik/piwik/blob/master/core/Log/APICall.php
 [30]: https://github.com/piwik/piwik/blob/master/core/Log/Exception.php
 [31]: https://github.com/piwik/piwik/blob/master/core/ExceptionHandler.php
 [32]: https://github.com/piwik/piwik/blob/master/core/Log.php
 [33]: http://framework.zend.com/manual/en/zend.log.html
 [34]: https://github.com/piwik/piwik/blob/master/core/Tracker/Db.php
 [35]: https://github.com/piwik/piwik/blob/master/core/Piwik.php

### How tracking works
### How archiving works
### Folder structure
### How to install Piwik (link to doc)
### User roles

## Get started / bootstrap
### What you need in order to create a plugin
Text editor/IDE (mention phpstorm)
### General structure
### Skeleton --> commandline tool
### Naming your plugin
### Version naming
### Defining metadata (plugin.json)
All available fields, why it's important, where it is used (Settings pages + Marketplace)
### Create a readme
#### Make your plugin shine
#### Test your readme...
### Screenshots
### How to setup test data

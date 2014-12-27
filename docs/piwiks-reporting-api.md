---
category: Develop
---
# Reporting HTTP API

<!-- Meta (to be deleted)
Purpose:
- describe how reporting API is exposed,
- describe reporting API formats,
- describe how data is processed before outputted through API,
- describe generic filter query parameters,
- describe how API handles exceptions
- bulk API requests

Audience: 

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how Piwik's Reporting API works and how your plugin can extend it**
* you'd like to know **what Piwik's Reporting API does to data before it is served**
* you'd like to know **what output formats can be used to view data that is returned from the Reporting API**
* you'd like to know **about query parameters that are used by the Reporting API to transform analytics data**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* understand how reports are stored in memory (if not, read this section of our [All About Analytics Data](/guides/all-about-analytics-data) guide),
* and have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide).

## The Reporting API

Piwik's **Reporting API** allows third party applications to access analytics data and manipulate miscellaneous data (anything other than reports or tracked data) through HTTP requests.

### API Requests

Every HTTP request to the **API.index** controller method will be handled by the Reporting API. Valid requests **must** have a query parameter named **method** that references the API method to invoke, for example, **UserSettings.getBrowser**.

API requests are processed in the following way:

1. The **API.index** controller method creates a [Piwik\API\Request](/api-reference/Piwik/API/Request) instance and uses it to dispatch the API request.
2. The [Piwik\API\Request](/api-reference/Piwik/API/Request) instance uses the **method** query parameter to determine which plugin and API method to use.
3. The [Piwik\API\Request](/api-reference/Piwik/API/Request) instance invokes the plugin's API method using query parameters as arguments. Query parameters with the same name as method parameters will be passed to the method. For example, **idSite** query parameter will be passed as the `$idSite` method parameter.
4. The [Piwik\API\Request](/api-reference/Piwik/API/Request) instance uses a **ResponseBuilder** instance to process the result of the API method and convert it into the desired output format.
5. The output is returned to the **API.index** controller method and is eventually `echo`'d.

### API methods

The Reporting API invokes methods that are found in each plugin's **API** class. Every public method in these classes is included as part of the Reporting API except for those whose documentation contains the **@ignore** annotation.

Query parameters are passed as method parameters. So API methods must assume method parameters will be string or array values. Objects are not allowed as parameters.

Methods are only allowed to return **numeric** values, **string** values, **arrays**, **[DataTable](/api-reference/Piwik/DataTable)** instances or **[DataTable\Map](/api-reference/Piwik/DataTable/Map)** instances. Piwik will not know how to format anything else.

_**Note: When returning [DataTable](/api-reference/Piwik/DataTable) or [DataTable\Map](/api-reference/Piwik/DataTable/Map) instances, filters will need to applied. Make sure to queue filters that are used for presentation purposes and directly apply other ones.**_

If a method throws an exception its message will appear in the output. The stack trace can be displayed during debugging by changing **ResponseBuilder::DISPLAY\_BACKTRACE\_DEBUG** to true.

**To see the list of API methods your Piwik install supports, click the _API_ link at the very top of every Piwik page. See the demo's list [here](http://demo.piwik.org/index.php?module=API&action=listAllAPI&idSite=7&period=day&date=yesterday).**

## Extra report processing

Reports that are returned by API methods, either in the form of a [DataTable](/api-reference/Piwik/DataTable) instance or [DataTable\Map](/api-reference/Piwik/DataTable/Map) instance, are manipulated before they are outputted. A set of [DataTable\BaseFilter](/api-reference/Piwik/DataTable/BaseFilter)s are executed on the reports based on the values of certain query parameters.

The following is the list of filters that are applied, what they do and what query parameters control whether they will run or not. The order in which they appear in this list is also the order in which they are applied:

1. **Flattener**: This filter will merge an entire [DataTable](/api-reference/Piwik/DataTable) hierarchy into one [DataTable](/api-reference/Piwik/DataTable), adding rows of subtables to their parent rows. It will only be applied if the **flat** query parameter is set to `1`.
2. **[Pattern](/api-reference/Piwik/DataTable/Filter/Pattern)**: Removes rows of a [DataTable](/api-reference/Piwik/DataTable) that do not match a regex pattern. Will be applied if the **filter\_pattern** query parameter is set to a regex. The **filter\_column** query parameter dictates which column to apply the regex pattern to (defaults to **label**).
3. **[PatternRecursive](/api-reference/Piwik/DataTable/Filter/PatternRecursive)**: Removes rows of a [DataTable](/api-reference/Piwik/DataTable) for which the row and all subtables of the row do not match a regex pattern. Will be applied if the **filter\_pattern\_recursive** query parameter is set to a regex. The **filter\_column\_recursive** query parameter dictates which column to apply the regex pattern to (defaults to **label**).
4. **[ExcludeLowPopulation](/api-reference/Piwik/DataTable/Filter/ExcludeLowPopulation)**: Deletes all rows that contain a specific column whose value is lower than a minimum threshold value. Will be applied if the **filter\_excludelowpop** query parameter is set. It should be set to the column to check. The **filter\_excludelowpop\_value** query parameter specifies the minimum threshold value (defaults to `0`).
5. **[AddColumnsProcessedMetrics](/api-reference/Piwik/DataTable/Filter/AddColumnsProcessedMetrics)**: Adds some universal processed metrics to each row of the report. Will be applied if the **filter\_add\_columns\_when\_show\_all\_columns** query parameter is set to `1`.
6. **[AddColumnsProcessedMetricsGoal](/api-reference/Piwik/DataTable/Filter/AddColumnsProcessedMetricsGoal)**: Adds processed metrics to each row for each goal of a site. Will be applied if the **filter\_update\_columns\_when\_show\_all\_goals** query parameter is set to `1`. The **idGoal** query parameter controls which goal to use. It can be the ID of a goal or one of these special values:

  * **AddColumnsProcessedMetricsGoal::GOALS\_OVERVIEW**: if used, the filter will add metrics for the goals overview and not individual goals.
  * **AddColumnsProcessedMetricsGoal::GOALS\_MINIMAL\_REPORT**: if used, no per-goal metrics will be added, just one metric, **revenue\_per\_visit**.
  * **AddColumnsProcessedMetricsGoal::GOALS\_FULL\_TABLE**: if used, will display per-goal metrics for every goal of the site including the ecommerce goal.

  **idGoal** defaults to **AddColumnsProcessedMetricsGoal::GOALS\_OVERVIEW**.
7. **[Sort](/api-reference/Piwik/DataTable/Filter/Sort)**: Sorts a [DataTable](/api-reference/Piwik/DataTable). Will be applied if the **filter\_sort\_column** query parameter is set to the column that should be sorted by. The **filter\_sort\_order** query parameter determines in what order the table is sorted. Can be either `'desc'` or `'asc'`.
8. **[Truncate](/api-reference/Piwik/DataTable/Filter/Truncate)**: Removes all rows after a certain row index. Will be applied if the **filter\_truncate** query parameter is present. The parameter should be set to the row number after which rows should be removed.
9. **[Limit](/api-reference/Piwik/DataTable/Filter/Limit)**: Removes rows not within a certain row index range. Will be applied if the **filter\_limit** query parameter is supplied and set to an integer. This is the size of the range. The **filter\_offset** query parameter determines the starting row index of the range. The **keep\_summary\_row** query parameter will make sure the summary row stays in the report if the parameter is set to `1`.
10. **SafeDecodeLabel**: Urldecodes and then sanitizes **label** column values. This filter is always applied.
11. **Queued Filters**: All of a [DataTable](/api-reference/Piwik/DataTable)'s queued filters are applied at this point. They will not be applied if the **disable\_queued\_filters** query parameter is present and set to `1`.
12. **[ColumnDelete](/api-reference/Piwik/DataTable/Filter/ColumnDelete)**: Removes columns from every row based on a query parameter that lists what to delete or a query parameter that lists what to keep. Will be applied if either the **hideColumns** query parameter or the **showColumns** query parameter are defined. Both should be a comma separated list of column names.
13. **LabelFilter**: This filter will remove all rows except the one (or ones) specified by the **label** query parameter. Only applied if the **label** query parameter is set. The **label** query parameter can be a single value or a path to a row in a subtable. To descend into subtables, the value should contain the `>` character, for example, `urldir>urlsubdir>index`. **label** can also be an array of values, for example, `label[]=arg1&label[]=arg2`.

### Other special query parameters

There are some other special query parameters that affect the way reports are processed:

* **disable\_generic\_filters**: If set to `1`, the filters numbered 2 - 9 above will not be applied. Defaults to `0` so if this parameter is absent, the filters will be applied.
* **format**: Determines the [output format](#output-formats) of the return value. This affects all return values regardless of whether it is a report (ie, stored within a [DataTable](/api-reference/Piwik/DataTable) or [DataTable\Map](/api-reference/Piwik/DataTable/Map) or not.

<a name="output-formats"></a>
## Output formats

The output of a Reporting API request is a serialized string of the API method's return value. The format of this string is determined by the value of the **format** query parameter. Currently Piwik supports the following output formats:

* **[xml](http://demo.piwik.org/index.php?module=API&method=UserCountry.getCity&format=xml&idSite=7&period=day&date=yesterday&expanded=1)**
* **[json](http://demo.piwik.org/index.php?module=API&method=UserCountry.getCity&format=json&idSite=7&period=day&date=yesterday&expanded=1)**
* **[csv](http://demo.piwik.org/index.php?module=API&method=UserCountry.getCity&format=csv&idSite=7&period=day&date=yesterday&expanded=1)**
* **[tsv](http://demo.piwik.org/index.php?module=API&method=UserCountry.getCity&format=tsv&idSite=7&period=day&date=yesterday&expanded=1)** _(Excel)_
* **[html](http://demo.piwik.org/index.php?module=API&method=UserCountry.getCity&format=html&idSite=7&period=day&date=yesterday&expanded=1)** _(A simple HTML representation, does not use [report visualizations](/guides/visualizing-report-data).)_
* **[php](http://demo.piwik.org/index.php?module=API&method=UserCountry.getCity&format=php&idSite=7&period=day&date=yesterday&expanded=1)** _(A serialized PHP array.)_

There is a special output format value, **original**, that can be used when requesting data from within Piwik using [Piwik\API\Request](/api-reference/Piwik/API/Request). This format will force the result to be returned as unprocessed and unserialized data. It should only be used when calling the API within Piwik in PHP.

_Note: The [Request::processRequest](/api-reference/Piwik/API/Request#processrequest) method automatically uses the **original** format, so in most cases you won't need to specify `format=original`._

## Special API Methods

Some of the API methods in the API plugin have special meaning and uses:

### Report Metadata

The **API.getMetadata**, **API.getReportMetadata** and **API.getProcessedReport** API methods can be used to get information about one or all reports. The information includes the metrics contained in the report, documentation for those metrics and [more](http://demo.piwik.org/index.php?module=API&method=API.getMetadata&apiModule=UserCountry&apiAction=getCountry&format=xml&idSite=7&period=day&date=yesterday&expanded=1).

These methods can be used by third party applications that provide an interface to the analytics stored by Piwik. **API.getReportMetadata**, which returns metadata for every report, can be used to get a list of all available reports for a website. **API.getMetadata** can be used to get more information about a single report. **API.getProcessedReport** can be used to get the metadata of a single report along with the report's data.

Report metadata can also be used within Piwik for features that operate on report(s) specified by the user. For example, the **ImageGraph** plugin, which outputs an image of a graph using report data, uses report metadata values as hints for how to draw the output graph. The **ScheduledReports** plugin also uses report metadata in a similar way. 

<!-- TODO: is there an official set of properties for report metadata? -->

### Row Evolution

Piwik's [row evolution feature](http://demo.piwik.org/index.php?module=CoreHome&action=index&idSite=7&period=day&date=yesterday#module=UserSettings&action=index&idSite=7&period=day&date=yesterday&popover=RowAction$3ARowEvolution$3AUserSettings.getConfiguration$3A0$3AWindows$25207$2520$252F$2520Chrome$2520$252F$25201920x1080) that is available through the UI is also available through the Reporting API. Third party applications can use the **API.getRowEvolution** method to get both [single row evolution data](http://demo.piwik.org/index.php?module=API&method=API.getRowEvolution&idSite=7&period=day&date=2013-11-01,2013-11-25&apiModule=UserSettings&apiAction=getOS&label=Windows+7) or [multi-row evolution data](http://demo.piwik.org/index.php?module=API&method=API.getRowEvolution&idSite=7&period=day&date=2013-11-01,2013-11-25&apiModule=UserSettings&apiAction=getOS).

<!-- TODO: should we describe the query parameters necessary? -->

### Bulk API Requests (API.getBulkRequest)

[Like the Tracking API](/api-reference/tracking-api), the Reporting API supports bulk requests. A bulk request allows applications to invoke and retrieve the results for multiple API methods with one HTTP request. This can be used to save time in applications that query the Piwik HTTP API.

To send a bulk request, send an HTTP request to the **API.getBulkRequest** API method. The only required query parameter is named **urls**. It should be an array of individual API request URLs. For example:

    http://demo.piwik.org/?module=API&method=API.getBulkRequest&format=xml&urls[]=module%3DAPI%26method%3DVisitorInterest.getNumberOfVisitsPerVisitDuration%26format%3DXML%26idSite%3D7%26period%3Dday%26date%3D2013-11-24%26expanded%3D1&urls[]=module%3DAPI%26method%3DUserSettings.getBrowser%26format%3DXML%26idSite%3D7%26period%3Dday%26date%3D2013-11-24%26expanded%3D1

This example uses the following API requests:

* module=API&method=UserSettings.getBrowser&format=XML&idSite=7&period=day&date=2013-11-24&expanded=1
* module=API&method=VisitorInterest.getNumberOfVisitsPerVisitDuration&format=XML&idSite=7&period=day&date=2013-11-24&expanded=1

**_Note: The separate API methods are executed synchronously, so for long running API methods, using a bulk request may be a bad idea._**

### Other Methods

* **API.get**: Calls the `get` API method of all loaded plugins that support it and merges the result. The `get` methods all output the metrics that the plugin archives, so the result of **API.get** is the set of values for every metric your Piwik install supports (for the specified website & period).

* **API.getSegmentDimensionMetadata**: Returns metadata for every supported [segment dimension](/api-reference/segmentation). The following information is returned for each segment dimension:
  
  * `'type'`: The type of segment dimension.
  * `'category'`: A translated string that describes the segment dimension's category.
  * `'name'`: A translated string or a translation token that describes the segment dimension itself.
  * `'segment'`: The segment dimension's ID. This is what gets used in segment expressions.
  * `'acceptedValues'`: A string that describes what values should be used with the segment dimension.
  * `'sqlSegment'`: The table column the segment dimension operates on, for example, `'log_visit.idvisitor'`.
  * `'sqlFilterValue'`: An optional PHP callback that transforms the value supplied in a segment expression before it is used in an SQL expression.
  * `'permission'`: Whether the current user can use this segment dimension.

* **API.getSuggestedValuesForSegment**: Returns a list of values that can be used with a specified segment dimension.

* **API.getLogoUrl**: Returns a URL to the Piwik logo.

* **API.getHeaderLogoUrl**: Returns a URL to a smaller version of the Piwik logo.

## Learn more

* To learn **how API classes are used internally** read our [Piwik APIs](/guides/apis) guide.
* To learn **about how to calculate a report** read our guide [All About Analytics Data](/guides/all-about-analytics-data).

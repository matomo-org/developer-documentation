---
category: API Reference
title: Metadata
---
# Report Metadata API Methods

The standard Piwik Analytics APIs return raw data, for example: visits, page views, revenue, conversions.

The Metadata API is the service that calls other APIs, then add more metadata around it, for example, it will:

*   return the report category, name, but also name of all the columns (in a specific language), or the translated date label (eg. "Thursday 10 February 2011")
*   return the data units as well, including the % sign, money symbols like $ or €, or time format "00:04:17"
*   return the processed metrics (ratios, averages) that are not returned in the normal API response, for example: bounce rate and time on site.
The Piwik Metadata API provides a simple entry point to get this additional information for most Piwik API functions returning analytics data.

## Fetch the Analytics Data and Metadata for a report

The method **API.getProcessedReport** can be called to request the full data set (metadata, column names, report data) of a given Piwik report. The response contains:

*   'metadata' - report name, category, list of metrics
*   'columns' - the list of translated column names in the report
*   'reportData' - the actual data: dimension and list of metrics
*   'reportMetadata' - (optional) contains the metadata for each row, for example: logo URLs, country codes, search engine URLs, etc.
For example, if you want to display the top five countries that visitors come from you would build the API Request as follows:

*   User countries report: `&apiModule=UserCountry&apiAction=getCountry`
*   Truncated to 5 rows: `&filter_truncate=5`
*   Labels can be translated into a specific language. As with other API calls, you can use the parameter `&language=xx` (replacing xx with the translation code).
The URL would be [https://demo.matomo.org/?module=API&method=API.getProcessedReport&idSite=3&date=yesterday&period=day&apiModule=UserCountry&apiAction=getCountry&language=en&format=xml&token_auth=anonymous&filter_truncate=5](https://demo.matomo.org/?module=API&method=API.getProcessedReport&idSite=3&date=yesterday&period=day&apiModule=UserCountry&apiAction=getCountry&format=xml&token_auth=anonymous&filter_truncate=5&language=en)

The returned XML is:

```xml
{@include escape https://demo.matomo.org/?module=API&method=API.getProcessedReport&idSite=3&date=yesterday&period=day&apiModule=UserCountry&apiAction=getCountry&format=xml&token_auth=anonymous&filter_truncate=5&language=en}
```

## List and Definition of 'metadata' Response Attributes

*   **category** -  category under which the report appears
*   **name** -  the report name
*   **module** and 'action' - used to build the standard API request to fetch the data for this report, `?module=API&method=$module.$action` (replace $module by the 'module' attribute, replace $action by the 'action' attribute)
*   **metrics** - list of basic metrics in the report
*   **processedMetrics** - list of processed metrics in the report. Processed metrics are usually ratios (conversion rates, average actions per visit, etc.). Processed metrics don't appear in standard non-metadata API responses.
*   **metricsGoal** and 'processedMetricsGoal' -  list of goal metrics available for this report.
*   **uniqueId** - the report unique ID.
*   **constantRowsCount** - if set to 1, this means that the report always has the same number of rows. For example, "visits per hour" always has 24 hours, "visits per number of pages" has 10 rows. This attribute is set only when there is a 'dimension' attribute. If this attribute is not set, it means that the returned data set could have 0 row, 1 row, or N rows.

## Listing all the Metadata API Functions

The API method **API.getReportMetadata** can be called to request the full list of API functions returning web analytics reports - [see the example output on the Piwik demo](https://demo.matomo.org/?module=API&method=API.getReportMetadata&format=xml&idSite=3&token_auth=anonymous).

There are two types of reports in Piwik, and each have a slightly different format.

*   **Simple metrics reports**

    Simple Metrics reports simply contain a list of metrics and their values. For example, VisitsSummary.get returns the main metrics (visits, pages, unique visitors) for the specified website ([example URL](https://demo.matomo.org/?module=API&method=API.getMetadata&idSite=3&apiModule=VisitsSummary&apiAction=get&format=xml&token_auth=anonymous)).

    ```xml
    {@include escape https://demo.matomo.org/?module=API&method=API.getMetadata&idSite=3&apiModule=VisitsSummary&apiAction=get&format=xml&token_auth=anonymous}
    ```

*   **Reports with dimensions**

    Most reports, however, will have a 'dimension' entry in the returned array. Reports with dimensions will display a list of metrics for each 'dimension'. For example, the list of visits, pages, time on site will be output for each keyword.

    Example of a report with dimensions metadata ([example URL](https://demo.matomo.org/?module=API&method=API.getMetadata&idSite=3&apiModule=Referrers&apiAction=getKeywords&format=xml&token_auth=anonymous)):

    ```xml
    {@include escape https://demo.matomo.org/?module=API&method=API.getMetadata&idSite=3&apiModule=Referrers&apiAction=getKeywords&format=xml&token_auth=anonymous}
    ```

## Static Image Graphs

In the metadata output, the field &lt;imageGraphUrl&gt; is a URL that will generate a static PNG graph plotting data for the requested report. Static PNG graphs are used, for example, in the [Piwik mobile app](https://matomo.org/mobile/) and in [email reports](https://matomo.org/docs/email-reports/). These static image graphs can also be used in any custom dashboard, web page, monitoring page, email, etc. As opposed to the [Piwik Widgets](https://matomo.org/docs/embed-piwik-report/), static image graphs do not require JavaScript or HTML, since the URL returns a PNG image.

In the following examples, to see the URL used to generate the image, right-click on the image and select "view image" to see the full URL.

*   Example: Graph Plotting Visits over the Last 30 Days

    ![](https://demo.matomo.org/index.php?module=API&method=ImageGraph.get&idSite=3&apiModule=VisitsSummary&apiAction=get&token_auth=anonymous&graphType=evolution&period=day&date=previous30&width=500&height=250)

URL: `index.php?module=API&method=ImageGraph.get&idSite=3&apiModule=VisitsSummary&apiAction=get&token_auth=anonymous&graphType=evolution&period=day&date=previous30&width=500&height=250`

*   Example: Horizontal Bar Graph Plotting Browsers for the Current Month

    ![](https://demo.matomo.org/index.php?module=API&method=ImageGraph.get&idSite=3&apiModule=DevicesDetection&apiAction=getBrowsers&token_auth=anonymous&graphType=horizontalBar&period=month&date=today&width=500&height=250)

URL: `index.php?module=API&method=ImageGraph.get&idSite=3&apiModule=DevicesDetection&apiAction=getBrowsers&token_auth=anonymous&graphType=horizontalBar&period=month&date=today&width=500&height=250`

*   Example: Horizontal Bar Graph Plotting Countries for the Current Week

    ![](https://demo.matomo.org/index.php?module=API&method=ImageGraph.get&idSite=3&apiModule=UserCountry&apiAction=getCountry&token_auth=anonymous&graphType=horizontalBar&period=month&date=today&width=500&height=250)

URL: `index.php?module=API&method=ImageGraph.get&idSite=3&apiModule=UserCountry&apiAction=getCountry&token_auth=anonymous&graphType=horizontalBar&period=month&date=today&width=500&height=250`

*   Example: Graph Plotting User Screen Resolutions for the Current Month

    ![](https://demo.matomo.org/index.php?module=API&method=ImageGraph.get&idSite=3&apiModule=Resolution&apiAction=getResolution&token_auth=anonymous&graphType=verticalBar&period=month&date=today&width=500&height=250)

URL: `index.php?module=API&method=ImageGraph.get&idSite=3&apiModule=Resolution&apiAction=getResolution&token_auth=anonymous&graphType=verticalBar&period=month&date=today&width=500&height=250`

*   Example: Pie Chart with Custom Colors

    ![](https://demo.matomo.org/index.php?module=API&method=ImageGraph.get&idSite=62&apiModule=DevicesDetection&apiAction=getOsVersions&token_auth=anonymous&graphType=pie&period=month&date=today&width=500&height=250&columns=nb_visits&colors=FFFF00,00FF00,FF0000,0000FF,555555,C3590D)

URL: `index.php?module=API&method=ImageGraph.get&idSite=62&apiModule=DevicesDetection&apiAction=getOsVersions&token_auth=anonymous&graphType=pie&period=month&date=today&width=500&height=250&columns=nb_visits&colors=FFFF00,00FF00,FF0000,0000FF,555555,C3590D`

*   Example: Line chart of Custom Variables names and values, filtered to show only custom variable containing the string "logged"

    ![](https://demo.matomo.org/?module=API&method=ImageGraph.get&idSite=62&apiModule=CustomVariables&apiAction=getCustomVariables&token_auth=anonymous&period=day&date=2013-11-11,2013-11-18&flat=1&filter_pattern_recursive=.*logged.*)

URL: `index.php?module=API&method=ImageGraph.get&idSite=62&apiModule=CustomVariables&apiAction=getCustomVariables&token_auth=anonymous&period=day&date=2013-11-11,2013-11-18&flat=1&filter_pattern_recursive=.*logged.*`


The static Graphs API requires the standard Piwik parameters (idSite, date, period, etc.) but also accepts the following parameters:

*   **graphType** - defines the type of graph to draw. Accepted values are: '**evolution**' (line graph), '**horizontalBar**' (horizontal bar graph), 'verticalBar' (vertical bar graph) and 'pie' (2D Pie chart)
*   **width** and **height** - define the width and height in pixels of the generated image
*   **columns** - by default, the graph will plot the number of visits (nb_visits). You can specify another metric such as: nb_actions, nb_visits_converted, nb_uniq_visitors, etc.
*   **colors** - you can specify a comma separated list of hexadecimal colors to use in the graph instead of the default colors, eg. _&colors=FFFF00,00FF00,FF0000_
*   **aliasedGraph** - by default, graphs are "smooth" (anti-aliased). If you are generating hundreds of graphs and are concerned with performance, you can set aliasedGraph=0. This will disable anti-aliasing and graphs will be generated faster, but won't look so pretty.

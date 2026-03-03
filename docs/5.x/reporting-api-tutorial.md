---
category: Integrate
previous: reporting-introduction
next: querying-the-reporting-api
---
# Tutorial: Get your top 10 popular pages

This tutorial will show you how easy it is to request the **yesterday's top 10 popular pages** in XML format.

## Build the URL

To build the URL of the API call, you need:

- your Matomo base URL (replace demo.matomo.cloud with the URL and path of your Matomo server

    **https://demo.matomo.cloud/?module=API**

- the name of the method you want to call. It has the format _moduleName.methodToCall_ (see the list on [API Methods](/api-reference/reporting-api#api-method-list)). In this example, let's request the most viewed Pages' titles with `Actions.getPageTitles`:

    **method=Actions.getPageTitles**

- the website id

    **idSite=1**

- the date parameter. This can be _today_, _yesterday_, or any date with the format _YYYY-MM-DD_

    **date=yesterday**

- the period parameter. This can be _day_, _week_, _month_ or _year_

    **period=day**

    Alternatively, if you wanted to request all pages from a given date, you could use a date range parameter. For example, to request all pages since January 1st 2021:`period=range&date=2011-01-21,yesterday`

- the format parameter. Defines the output format of the data: XML, JSON, CSV, PHP (serialized PHP), HTML (simple html)

    **format=xml**

- (optional) to keep the example simple, we ask only for the Visits & Unique visitors metrics to be returned:

    **showColumns=nb_visits,nb_uniq_visitors**

- (optional) the filter_limit parameter that defines the number of rows returned

    **filter_limit=10**

The final url is **[demo.matomo.cloud/?module=API&method=Actions.getPageTitles&idSite=1&date=yesterday&period=day&format=xml&filter_limit=10&showColumns=nb_visits,nb_uniq_visitors](https://demo.matomo.cloud/?module=API&method=Actions.getPageTitles&idSite=1&date=yesterday&period=day&format=xml&filter_limit=10&showColumns=nb_visits,nb_uniq_visitors)**

## XML Output

Here is the output of this request:

```xml
{@include escape https://demo.matomo.cloud/?module=API&method=Actions.getPageTitles&idSite=1&date=yesterday&period=day&format=xml&filter_limit=10&showColumns=nb_visits,nb_uniq_visitors}
```

## Other examples

*   XML of the visits of the last 10 days, one entry per day
[https://demo.matomo.cloud/?module=API&method=VisitsSummary.getVisits&idSite=1&period=day&date=last10&format=xml](https://demo.matomo.cloud/?module=API&method=VisitsSummary.getVisits&idSite=1&period=day&date=last10&format=xml)

*   XML of the visits by Aquisition Channel 
[https://demo.matomo.cloud/?module=API&method=Referrers.getReferrerType&idSite=1&period=day&date=last10&format=xml](https://demo.matomo.cloud/?module=API&method=Referrers.getReferrerType&idSite=1&period=day&date=last10&format=xml)


*   RSS feed containing the top 30 pages for the last 3 weeks
[https://demo.matomo.cloud/?module=API&method=Referrers.getKeywords&idSite=1&period=week&date=last3&format=rss&filter_limit=30](https://demo.matomo.cloud/?module=API&method=Referrers.getKeywords&idSite=1&period=week&date=last3&format=rss&filter_limit=30)


*   XML containing the page titles from the last 3 days which match the pattern "store"
[https://demo.matomo.cloud/?module=API&method=Actions.getPageTitles&idSite=1&period=day&date=last3&format=xml&filter_column=label&filter_pattern=store](https://demo.matomo.cloud/?module=API&method=Actions.getPageTitles&idSite=1&period=day&date=last3&format=xml&filter_column=label&filter_pattern=store)

*   XML containing search engine keywords from the last 3 weeks, one entry per week
[https://demo.matomo.cloud/?module=API&method=Referrers.getKeywords&idSite=1&period=week&date=last3&translateColumnNames=1&format=xml](https://demo.matomo.cloud/?module=API&method=Referrers.getKeywords&idSite=1&period=week&date=last3&translateColumnNames=1format=xml)


You can get the data in one of these formats: XML, JSON, HTML, CSV, TSV, etc. See the [API Reference](/api-reference/reporting-api) for the documentation.

There are also functions for Websites, Users, Goals, PDF Reports (create, update, delete operations) and a lot more, such as: adding Annotations, creating custom Segments,

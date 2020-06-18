---
category: Integrate
previous: reporting-introduction
next: querying-the-reporting-api
---
# Tutorial: Get your top 10 keywords

This tutorial will show you how easy it is to request the **yesterday's top 10 keywords** in XML format.

## Build the URL

To build the URL of the API call, you need:

- your Piwik base URL (replace demo.matomo.org with the URL and path of your Piwik server

    **https://demo.matomo.org/?module=API**

- the name of the method you want to call. It has the format _moduleName.methodToCall_ (see the list on [API Methods](/api-reference/reporting-api#api-method-list)). You need to request the last keywords from the plugin Referrers:

    **method=Referrers.getKeywords**

- the website id

    **idSite=1**

- the date parameter. This can be _today_, _yesterday_, or any date with the format _YYYY-MM-DD_

    **date=yesterday**

- the period parameter. This can be _day_, _week_, _month_ or _year_

    **period=day**

    Alternatively, if you wanted to request all keywords from a given date, you could use a date range parameter. For example, to request all keywords since January 1st 2011:`period=range&date=2011-01-01,yesterday`

- the format parameter. Defines the output format of the data: XML, JSON, CSV, PHP (serialized PHP), HTML (simple html)

    **format=xml**

- (optional) the filter_limit parameter that defines the number of rows returned

    **filter_limit=10**

The final url is **[https://demo.matomo.org/?module=API&method=Referrers.getKeywords&idSite=3&date=yesterday&period=day&format=xml&filter_limit=10](https://demo.matomo.org/?module=API&method=Referrers.getKeywords&idSite=3&date=yesterday&period=day&format=xml&filter_limit=10)**

## XML Output

Here is the output of this request:

```xml
{@include escape https://demo.matomo.org/?module=API&method=Referrers.getKeywords&idSite=3&date=yesterday&period=day&format=xml&filter_limit=10}
```

## Other examples

*   XML of the visits of the last 10 days, one entry per day
[https://demo.matomo.org/?module=API&method=VisitsSummary.getVisits&idSite=3&period=day&date=last10&format=xml](https://demo.matomo.org/?module=API&method=VisitsSummary.getVisits&idSite=3&period=day&date=last10&format=xml)

*   XML containing keywords from the last 3 weeks, one entry per week
[https://demo.matomo.org/?module=API&method=Referrers.getKeywords&idSite=3&period=week&date=last3&format=xml](https://demo.matomo.org/?module=API&method=Referrers.getKeywords&idSite=3&period=week&date=last3&format=xml)

*   XML containing the keywords from the last 3 days which match the pattern "piwik"
[https://demo.matomo.org/?module=API&method=Referrers.getKeywords&idSite=3&period=day&date=last3&format=xml&filter_column=label&filter_pattern=piwik](https://demo.matomo.org/?module=API&method=Referrers.getKeywords&idSite=3&period=day&date=last3&format=xml&filter_column=label&filter_pattern=piwik)

*   RSS feed containing the top 30 keywords for the last 3 weeks,  ordered by the number of actions people did when coming from these  keywords
[https://demo.matomo.org/?module=API&method=Referrers.getKeywords&idSite=3&period=week&date=last3&format=rss&filter_limit=30&filter_sort_column=3](https://demo.matomo.org/?module=API&method=Referrers.getKeywords&idSite=3&period=week&date=last3&format=rss&filter_limit=30&filter_sort_column=3)
You can get the data in one of these formats: XML, JSON, HTML, CSV, TSV, etc. See the [API Reference](/api-reference/reporting-api) for the documentation.

There are also functions for Websites, Users, Goals, PDF Reports (create, update, delete operations) and a lot more, such as: adding Annotations, creating custom Segments,

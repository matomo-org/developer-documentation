---
category: DevelopInDepth
previous: archive-data
---
# Reports

**Archive data** is generated and stored as records. Records are then loaded and transformed to create **reports** that can be exposed to users.

## From records to reports

Records [are not the same as reports](/guides/archiving#reports-vs-records). Records are structured and optimized to be stored, not be read by either humans or other software.

API methods cannot simply access archive data and return it. They must format it to make it presentable.

### DataTable filters

Reports are stored in [DataTable](/api-reference/Piwik/DataTable) objects. Those objects are manipulated by either:

- iterating rows and manually changing them
- using [DataTable **filters**](/api-reference/Piwik/DataTable/BaseFilter)

DataTable filters manipulate DataTable instances in some way. There are several predefined ones that allow you to do common things without having to write a lot of code.

Making a report presentable involves undoing the [changes that made it more efficient to store](/guides/archiving#record-storage-guidelines). For example, column names can be changed from integer IDs to string metric names via the [ReplaceColumnNames](/api-reference/Piwik/DataTable/Filter/ReplaceColumnNames)  filter:

```php
$dataTable->filter('ReplaceColumnNames');
```

## Exposing reports

Reports are served by the `API` classes defined by plugins. These classes load records, transform them into presentable reports and serve them through the [**Reporting API**](/guides/piwiks-reporting-api).

The Reporting API can be called either through HTTP requests or directly by PHP code (e.g. in [Controller](/api-reference/Piwik/Plugin/Controller) methods).

## Learn more

- read about the [Reporting API](/guides/piwiks-reporting-api)
- to learn **how reports are displayed** read about [Visualizing Report Data](/guides/visualizing-report-data)

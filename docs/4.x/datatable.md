---
category: DevelopInDepth
title: Data Table
---
# Data Tables

Data tables are used to store reporting data. [Visualisation](/guides/visualizing-report-data) decide how these tables are displayed in the UI and they can be requested in different formats using the [HTTP Reporting API](/api-reference/reporting-api) (json, xml, csv, ...).

Data tables look just like a regular table:

* A table has a set of rows (which can be empty)
* Each row has multiple columns where the name and value of the column are both stored in the row
* Each row can store a reference to a subtable for nested tables / reports
* Each table and each row can store metadata

A basic example looks like this:

```php
$table = new DataTable();
$table->addRowsFromSimpleArray(array(
    array('label' => 'thing1', 'nb_visits' => 1, 'nb_actions' => 1),
    array('label' => 'thing2', 'nb_visits' => 2, 'nb_actions' => 2)
));
foreach ($table->getRows() as $row) {
    foreach ($row->getColumns() as $column => $value) {
        echo $column . ': ' . $value; // would print eg label:1 nb_visits:1
    }
}
// Tables also implement the ArrayAccess interface and therefore this works too:
foreach ($table as $row) {
    foreach ($row as $column => $value) {
        echo $column . ': ' . $value; 
    }
}
```

## Different types of data tables

There are three different types of data tables:

* [DataTable](https://developer.matomo.org/api-reference/Piwik/DataTable) - Regular data table for reports that have a dimension. In that case, each row has typically a "label" column for the row's associated dimension value. 
* [DataTable\Simple](https://developer.matomo.org/api-reference/Piwik/DataTable/Simple) - Used for reports that don't have a dimension. In that case, there is no "label" column and it only stores data for metrics. Such a table typically has only one row.
* [DataTable\Map](https://developer.matomo.org/api-reference/Piwik/DataTable/Map) - Stores a set of regular or simple data tables when multiple periods are requested (think of `&period=day&date=last7`). In that case you can iterate over each table within the map using the `getDataTables()` method. The array key for each table stores the date which the subtable represents.

Each table may store multiple [rows](https://developer.matomo.org/api-reference/Piwik/DataTable/Row).

## Manipulating data tables

You can manipulate data tables in any kind of way by using filters:

* `$table->filter()` - Executes the filter right away. Depending on what the filter does, it may or may not be also applied to subtables. 
* `$table->filterSubtables()` - Executes the filter right away. The filter won't be executed on the rows within this data table but only on subtables.
* `$table->queueFilter()` - Similar to `filter()` but will be executed only after all the not needed rows have been removed.
* `$table->queueFilterSubtables()` - Similar to `filterSubtables()` but will be executed only after all the not needed rows have been removed.
  
Queued filters can be useful to speed up the filter and make Matomo faster. For example, if only 10 rows are requested, then the filter will only be executed on 10 rows instead of potentially hundreds or thousands of rows.
Whenever possible we try to use queued filters but it's not always possible as sometimes certain filters need to be executed before other filters run.

### Built-in filters

You can find a list of built-in examples in the [API classes reference](/api-reference/classes) when you search for "DataTable\Filter". 
To apply a built-in filter either specify the full class name including namespace or only the class name itself:

```php
$table->filter('Truncate'); 
$table->filter('Piwik\DataTable\Filter\Truncate'); 
$table->filter(Piwik\DataTable\Filter\Truncate::class); 
```

Some filters require additional parameters which can be provided as arguments:

```php
$table->filter('Limit', [5, 10]);
// group URLs by host
$table->filter('GroupBy', ['label', function ($labelUrl) {
    return parse_url($labelUrl, PHP_URL_HOST);
}]);
```
There are many built-in filters for all kind of possible actions. If you need to manipulate a data table to for example add, remove or change columns or metadata or other actions I suggest you have a look through these in the [reference](https://developer.matomo/api-reference/classes). Most of them have documentation on what parameters are needed and show examples.

### Custom filter

You can also create your own filter by creating a class that extends the `BaseFilter` class:

```php
namespace Piwik\Plugins\MyPlugin\DataTable\Filter;
use Piwik\DataTable\BaseFilter;
use Piwik\DataTable;

class ShortenUrl extends BaseFilter
{
    public function filter($table)
    {
        foreach ($table->getRows() as $row) {
            $label = $row->getColumn('label');
            $row->setColumn('label', str_replace('https://', '', $label));
            $row->setMetadata('url', $label);
        }
    }
}
```

You can then execute this filter using the class name: `$table->filter(Piwik\Plugins\MyPlugin\DataTable\Filter\ShortenUrl::class)`.

If you are wanting to accept parameters you can require them in the constructor like this:

```
class ShortenUrl extends BaseFilter
{
    private $protocolToRemove;
    
    public function __construct($table, $protocolToRemove)
    {
        parent::__construct($table);
        $this->protocolToRemove = $protocolToRemove;
    }

    public function filter($table)
    {
        foreach ($table->getRows() as $row) {
            $label = $row->getColumn('label');
            $row->setColumn('label', str_replace($this->protocolToRemove, '', $label));
            $row->setMetadata('url', $label);
        }
    }
}
```

The first argument is always the table which will be passed to the class automatically. All other parameters need to be provided when calling the `filter` method: `$table->filter(Piwik\Plugins\MyPlugin\DataTable\Filter\ShortenUrl::class, ['https://'])`.

## Special rows

There are two special rows within a data table that can exist:

* `SummaryRow` - When a report is truncated, then all other removed rows are usually aggregated into the "summary row" and shown using a "Others" label. For example, you are viewing the top 500 page urls, then all the other URLs that didn't make it into the top 500 rows will be aggregated into the summary row.
* `TotalsRow` - This row includes the aggregated value of all rows within the data table. In the Matomo UI you can view the totals row using the cog icon.

## Subtables

Each row can optionally store a subtable to represent a tree like structure. For example a Page URL report could look like this:

* /shop
  * /product1
  * /product2
* /blog

In this case the "shop" row would have a subtable which includes two rows. You can access these subtables using the `$row->getSubtable()` method.

## Other data table methods

I suggest you check out the [DataTable API reference](https://developer.matomo.org/api-reference/Piwik/DataTable) for a list of all methods that exist.

There are plenty of methods to sort, delete, add rows and metadata. There are also more advanced methods to merge multiple data tables into one and more.

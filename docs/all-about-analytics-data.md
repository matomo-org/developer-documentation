# All About Analytics Data

<!-- Meta (to be deleted)
Purpose:
- describe the archiving process & how it is started,
- what 'archive data' is and how it is stored (how DataTables are stored)
- how analytics data is calculated (aggregated)
- how analytics data is queried, what data structures are used to store analytics data (DataTable, DataTable/Map)
- analytics parameters (site, period, segment),
- segments,
- manipulating analytics data (filters),
- exposing reports through API,
- how reports are processed when returned through the API,
- difference between metrics + reports,
- how plugins can do their own archiving,
- archive cron stuff 

Audience: - plugin developers who want to create their own reports
- developers who want to understand more about how Piwik creates analytics reports

Expected Result: - developers who understand exactly how Piwik analyzes log data and creates reports that are available for viewing

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how to aggregate, store and serve new analytics data for your plugin**
* you'd like to know **what the Archiving Process is and how it is used to automatically aggregate and cache analytics data**
* you'd like to know **how analytics data is stored and manipulated in PHP**
* you'd like to know **what segments are and how you can define your own**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](#) guide).

## Analytics Reports & Metrics

<!-- what is a report vs. metric,  -->

### Reports and DataTables

### Analytics Parameters

## Report & Metric Persistence (Archive Data)

## Report Aggregation

### Aggregating Log Data

### Aggregating Archive Data

### Segments

## Serving Reports

<!-- APIs and serving reports -->

### Transforming Archive Data into a human readable report

### API processing of reports

## The Archiving Process

### Process initiation

### The cron script

## Learn more

* 

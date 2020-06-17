---
category: DevelopInDepth
subGuides:
  - log-data
  - archiving
  - archive-data
  - reports
---
# Data Model

## About this guide

Read this guide if

- you'd like to know **how to aggregate, store and serve new analytics data with your plugin**
- you'd like to know **what the Archiving Process is and how it is used to automatically aggregate and cache analytics data**
- you'd like to know **how analytics data is stored and manipulated in PHP**
- you'd like to know **what segments are and how you can define your own**

## About analytics

Analyzing data means searching for patterns in a set of _**things**_. In Piwik those **_things_** are visits, web actions and goal conversions.

We search for patterns by [**reducing**](https://en.wikipedia.org/wiki/Data_reduction) the set of things. Or in other words, we search for patterns by grouping individual things together to create subsets that are both recognizable and meaningful.

In Piwik the result of that grouping is the **analytics data**. Analytics data is stored, displayed and exposed through an API. Read on to learn what this data contains, how Piwik calculates and stores it, and how it is made available to Piwik users.

## Data workflow

Here is the workflow that data follows in Piwik:

- **raw data** is collected from trackers and stored as [**log data**](/guides/log-data)
- the [**archiving process**](/guides/archiving) aggregates log data into [**archive data**](/guides/archive-data)
- **archive data** is loaded and presented into [**reports**](/guides/reports)

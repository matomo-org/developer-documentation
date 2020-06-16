<small>Piwik\Plugins\PagePerformance\Columns\Metrics\</small>

AverageTimeDomCompletion
========================

The average amount of time the browser needs to load media any Javascript listening for the DOMContentLoaded event.

Calculated as

    sum_time_dom_completion / nb_hits_with_time_dom_completion

The above metrics are calculated during archiving. This metric is calculated before
serving a report.

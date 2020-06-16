<small>Piwik\Plugins\PagePerformance\Columns\Metrics\</small>

AverageTimeOnLoad
=================

The average amount of time browser needs to execute javascript waiting for window.load event.

Calculated as

    sum_time_on_load / nb_hits_with_time_on_load

The above metrics are calculated during archiving. This metric is calculated before
serving a report.

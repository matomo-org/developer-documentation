<small>Piwik\DataTable\Filter</small>

ColumnCallbackAddColumnPercentage
=================================

Calculates a percentage value for each row of a DataTable and adds the result to each row.

Description
-----------

See [ColumnCallbackAddColumnQuotient](#) for more information.

**Basic usage example**

    $nbVisits = // ... get the visits for a period ...
    $dataTable-&gt;queueFilter(&#039;ColumnCallbackAddColumnPercentage&#039;, array(&#039;nb_visits&#039;, &#039;nb_visits_percentage&#039;, $nbVisits, 1));


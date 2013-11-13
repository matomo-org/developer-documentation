<small>Piwik\DataTable\Filter</small>

ColumnCallbackAddColumnPercentage
=================================

Calculates a percentage value for each row of a DataTable and adds the result to each row.

Description
-----------

See [ColumnCallbackAddColumnQuotient](#) for more information.

**Basic usage example**

    $nbVisits = // ... get the visits for a period ...
    $dataTable->queueFilter('ColumnCallbackAddColumnPercentage', array('nb_visits', 'nb_visits_percentage', $nbVisits, 1));

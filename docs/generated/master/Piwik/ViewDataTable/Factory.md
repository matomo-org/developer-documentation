<small>Piwik\ViewDataTable</small>

Factory
=======

TODO

Methods
-------

The class defines the following methods:

- [`build()`](#build) &mdash; Returns a Piwik_ViewDataTable_* object.

<a name="build" id="build"></a>
<a name="build" id="build"></a>
### `build()`

Returns a Piwik_ViewDataTable_* object.

#### Description

By default it will return a ViewDataTable_Html
If there is a viewDataTable parameter in the URL, a ViewDataTable of this 'viewDataTable' type will be returned.
If defaultType is specified and if there is no 'viewDataTable' in the URL, a ViewDataTable of this $defaultType will be returned.
If force is set to true, a ViewDataTable of the $defaultType will be returned in all cases.

#### Signature

- It accepts the following parameter(s):
    - `$defaultType` (`string`) &mdash; Any of these: table, cloud, graphPie, graphVerticalBar, graphEvolution, sparkline, generateDataChart*
    - `$apiAction` (`string`|`bool`)
    - `$controllerAction` (`string`|`bool`)
    - `$forceDefault` (`bool`)
- It can return one of the following values:
    - [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
    - [`Visualization`](../../Piwik/Plugin/Visualization.md)
    - `Piwik\Plugins\CoreVisualizations\Visualizations\Sparkline;`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


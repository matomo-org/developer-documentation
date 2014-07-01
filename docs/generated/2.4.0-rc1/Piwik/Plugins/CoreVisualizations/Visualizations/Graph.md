<small>Piwik\Plugins\CoreVisualizations\Visualizations\</small>

Graph
=====

This is an abstract visualization that should be the base of any 'graph' visualization.

This class defines certain visualization properties that are specific to all graph types.
Derived visualizations can decide for themselves whether they should support individual
properties.

Properties
----------

This abstract class defines the following properties:

- [`$config`](#$config) &mdash; Graph\Config$config

<a name="$config" id="$config"></a>
<a name="config" id="config"></a>
### `$config`

Graph\Config$config

#### Signature

- It is a `Graph\Config` value.

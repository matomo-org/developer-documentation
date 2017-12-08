<small>Piwik\Plugins\CoreHome\SystemSummary\</small>

Item
====

This class can be used to add a new entry / item to the system summary widget.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Item constructor.
- [`getKey()`](#getkey)
- [`getLabel()`](#getlabel)
- [`getValue()`](#getvalue)
- [`getUrlParams()`](#geturlparams)
- [`getIcon()`](#geticon)
- [`getOrder()`](#getorder)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Item constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$key` (`string`) &mdash;
       The key or ID for this item. The entry in the widget will have this class so it is possible to style it individually and other plugins can use this key to for example remove this item from the list of system summary items.
    - `$label` (`string`) &mdash;
       The label that will be displayed for this item. The label may already include the value such as "5 segments"
    - `$value` (`string`|`null`) &mdash;
       Optional label. If given, the value will be displayed after the label separated by a colon, eg: "Segments: 5"
    - `$urlParams` (`array`|`null`) &mdash;
       Optional URL to make the item clickable. Accepts an array of URL parameters that need to be modfified.
    - `$icon` (`string`) &mdash;
       Optional icon css class, eg "icon-user".
    - `$order` (`int`) &mdash;
       Optional sort order. The lower the value, the higher up the entry will be shown

<a name="getkey" id="getkey"></a>
<a name="getKey" id="getKey"></a>
### `getKey()`

#### Signature

- It returns a `string` value.

<a name="getlabel" id="getlabel"></a>
<a name="getLabel" id="getLabel"></a>
### `getLabel()`

#### Signature

- It returns a `string` value.

<a name="getvalue" id="getvalue"></a>
<a name="getValue" id="getValue"></a>
### `getValue()`

#### Signature

- It returns a `mixed` value.

<a name="geturlparams" id="geturlparams"></a>
<a name="getUrlParams" id="getUrlParams"></a>
### `getUrlParams()`

#### Signature


- *Returns:*  `array`|`null` &mdash;
    

<a name="geticon" id="geticon"></a>
<a name="getIcon" id="getIcon"></a>
### `getIcon()`

#### Signature

- It returns a `string` value.

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

#### Signature

- It returns a `int` value.


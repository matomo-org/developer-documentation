<small>Piwik\Plugins\Diagnostics\Diagnostic\</small>

DiagnosticResult
================

The result of a diagnostic.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`singleResult()`](#singleresult)
- [`getLabel()`](#getlabel)
- [`getItems()`](#getitems)
- [`addItem()`](#additem)
- [`setItems()`](#setitems)
- [`getLongErrorMessage()`](#getlongerrormessage)
- [`setLongErrorMessage()`](#setlongerrormessage)
- [`getStatus()`](#getstatus) &mdash; Returns the worst status of the items.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$label`
      

<a name="singleresult" id="singleresult"></a>
<a name="singleResult" id="singleResult"></a>
### `singleResult()`

#### Signature

-  It accepts the following parameter(s):
    - `$label` (`string`) &mdash;
      
    - `$status` (`string`) &mdash;
      
    - `$comment` (`string`) &mdash;
      
- It returns a [`DiagnosticResult`](../../../../Piwik/Plugins/Diagnostics/Diagnostic/DiagnosticResult.md) value.

<a name="getlabel" id="getlabel"></a>
<a name="getLabel" id="getLabel"></a>
### `getLabel()`

#### Signature

- It returns a `string` value.

<a name="getitems" id="getitems"></a>
<a name="getItems" id="getItems"></a>
### `getItems()`

#### Signature

- It returns a [`DiagnosticResultItem[]`](../../../../Piwik/Plugins/Diagnostics/Diagnostic/DiagnosticResultItem.md) value.

<a name="additem" id="additem"></a>
<a name="addItem" id="addItem"></a>
### `addItem()`

#### Signature

-  It accepts the following parameter(s):
    - `$item` ([`DiagnosticResultItem`](../../../../Piwik/Plugins/Diagnostics/Diagnostic/DiagnosticResultItem.md)) &mdash;
      
- It does not return anything or a mixed result.

<a name="setitems" id="setitems"></a>
<a name="setItems" id="setItems"></a>
### `setItems()`

#### Signature

-  It accepts the following parameter(s):
    - `$items` (`array`) &mdash;
      
- It does not return anything or a mixed result.

<a name="getlongerrormessage" id="getlongerrormessage"></a>
<a name="getLongErrorMessage" id="getLongErrorMessage"></a>
### `getLongErrorMessage()`

#### Signature

- It returns a `string` value.

<a name="setlongerrormessage" id="setlongerrormessage"></a>
<a name="setLongErrorMessage" id="setLongErrorMessage"></a>
### `setLongErrorMessage()`

#### Signature

-  It accepts the following parameter(s):
    - `$longErrorMessage` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="getstatus" id="getstatus"></a>
<a name="getStatus" id="getStatus"></a>
### `getStatus()`

Returns the worst status of the items.

#### Signature


- *Returns:*  `string` &mdash;
    One of the `STATUS_*` constants.


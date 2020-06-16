<small>Piwik\Category\</small>

Subcategory
===========

Base type for subcategories.

All widgets within a subcategory will be rendered in the Piwik reporting UI under the same page. By default
you do not have to specify any subcategory as they are created automatically. Only create a subcategory if you
want to change the name for a specific subcategoryId or if you want to specify a different order so the subcategory
appears eg at a different order in the reporting menu. It also affects the order of reports in
`API.getReportMetadata` and wherever we display any reports.

To define a subcategory just place a subclass within the `Categories` folder of your plugin.

Subcategories can also be added through the [Subcategory.addSubcategories](/api-reference/events#subcategoryaddsubcategories) event.

Methods
-------

The class defines the following methods:

- [`setId()`](#setid) &mdash; Sets (overwrites) the id of the subcategory see $id.
- [`getId()`](#getid) &mdash; Get the id of the subcategory.
- [`getCategoryId()`](#getcategoryid) &mdash; Get the specified categoryId see $categoryId.
- [`setCategoryId()`](#setcategoryid) &mdash; Sets (overwrites) the categoryId see $categoryId.
- [`setName()`](#setname) &mdash; Sets (overwrites) the name see $name and $id.
- [`getName()`](#getname) &mdash; Get the name of the subcategory.
- [`setOrder()`](#setorder) &mdash; Sets (overwrites) the order see $order.
- [`getOrder()`](#getorder) &mdash; Get the order of the subcategory.

<a name="setid" id="setid"></a>
<a name="setId" id="setId"></a>
### `setId()`

Sets (overwrites) the id of the subcategory see $id.

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`string`) &mdash;
       A translation key eg 'General_Overview'.
- It returns a [`Subcategory`](../../Piwik/Category/Subcategory.md) value.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Get the id of the subcategory.

#### Signature

- It returns a `string` value.

<a name="getcategoryid" id="getcategoryid"></a>
<a name="getCategoryId" id="getCategoryId"></a>
### `getCategoryId()`

Get the specified categoryId see $categoryId.

#### Signature

- It returns a `string` value.

<a name="setcategoryid" id="setcategoryid"></a>
<a name="setCategoryId" id="setCategoryId"></a>
### `setCategoryId()`

Sets (overwrites) the categoryId see $categoryId.

#### Signature

-  It accepts the following parameter(s):
    - `$categoryId` (`string`) &mdash;
      
- It returns a [`Subcategory`](../../Piwik/Category/Subcategory.md) value.

<a name="setname" id="setname"></a>
<a name="setName" id="setName"></a>
### `setName()`

Sets (overwrites) the name see $name and $id.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       A translation key eg 'General_Overview'.
- It returns a [`Subcategory`](../../Piwik/Category/Subcategory.md) value.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Get the name of the subcategory.

#### Signature

- It returns a `string` value.

<a name="setorder" id="setorder"></a>
<a name="setOrder" id="setOrder"></a>
### `setOrder()`

Sets (overwrites) the order see $order.

#### Signature

-  It accepts the following parameter(s):
    - `$order` (`int`) &mdash;
      
- It returns a [`Subcategory`](../../Piwik/Category/Subcategory.md) value.

<a name="getorder" id="getorder"></a>
<a name="getOrder" id="getOrder"></a>
### `getOrder()`

Get the order of the subcategory.

#### Signature

- It returns a `int` value.


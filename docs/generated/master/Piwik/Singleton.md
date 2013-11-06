<small>Piwik</small>

Singleton
=========

The singleton class restricts the instantiation of a class to one object only.

Description
-----------

All plugin APIs are singletons and thus extend this class.


Properties
----------

This class defines the following properties:

- [`$instances`](#$instances)

<a name="instances" id="instances"></a>
### `$instances`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class.
- [`unsetInstance()`](#unsetinstance) &mdash; Used in tests only
- [`setSingletonInstance()`](#setsingletoninstance) &mdash; Sets the singleton instance.

<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

- It does not return anything.

<a name="getinstance" id="getinstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class.

#### Description

If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a(n) [`Singleton`](../Piwik/Singleton.md) value.

<a name="unsetinstance" id="unsetinstance"></a>
### `unsetInstance()`

Used in tests only

#### Signature

- It does not return anything.

<a name="setsingletoninstance" id="setsingletoninstance"></a>
### `setSingletonInstance()`

Sets the singleton instance.

#### Description

For testing purposes.

#### Signature

- It accepts the following parameter(s):
    - `$instance`
- It does not return anything.


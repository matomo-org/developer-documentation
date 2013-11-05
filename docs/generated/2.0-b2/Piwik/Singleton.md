<small>Piwik</small>

Singleton
=========

The singleton class restricts the instantiation of a class to one object only.

Description
-----------

All plugin APIs are singletons and thus extend this class.


Methods
-------

The class defines the following methods:

- [`getInstance()`](#getInstance) &mdash; Returns the singleton instance for the derived class.
- [`unsetInstance()`](#unsetInstance) &mdash; Used in tests only
- [`setSingletonInstance()`](#setSingletonInstance) &mdash; Sets the singleton instance.

<a name="getinstance" id="getinstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class.

#### Description

If the singleton instance
has not been created, this method will create it.

#### Signature

- It is a **public static** method.
- It returns a(n) [`Singleton`](../Piwik/Singleton.md) value.

<a name="unsetinstance" id="unsetinstance"></a>
### `unsetInstance()`

Used in tests only

#### Signature

- It is a **public static** method.
- It does not return anything.

<a name="setsingletoninstance" id="setsingletoninstance"></a>
### `setSingletonInstance()`

Sets the singleton instance.

#### Description

For testing purposes.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$instance`
- It does not return anything.


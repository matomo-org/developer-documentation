<small>Piwik</small>

Cookie
======

Simple class to handle the cookies: - read a cookie values - edit an existing cookie and save it - create a new cookie, set values, expiration date, etc.

Description
-----------

and save it

Signature
---------

- It is a(n) **class**.

Constants
---------

This class defines the following constants:

- [`MAX_COOKIE_SIZE`](#MAX_COOKIE_SIZE) &mdash; Don&#039;t create a cookie bigger than 1k
- [`VALUE_SEPARATOR`](#VALUE_SEPARATOR) &mdash; The character used to separate the tuple name=value in the cookie

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Instantiate a new Cookie object and tries to load the cookie content if the cookie exists already.
- [`isCookieFound()`](#isCookieFound) &mdash; Returns true if the visitor already has the cookie.
- [`delete()`](#delete) &mdash; Delete the cookie
- [`save()`](#save) &mdash; Saves the cookie (set the Cookie header).
- [`setDomain()`](#setDomain) &mdash; Set cookie domain
- [`setSecure()`](#setSecure) &mdash; Set secure flag
- [`setHttpOnly()`](#setHttpOnly) &mdash; Set HTTP only
- [`set()`](#set) &mdash; Registers a new name =&gt; value association in the cookie.
- [`get()`](#get) &mdash; Returns the value defined by $name from the cookie.
- [`__toString()`](#__toString) &mdash; Returns an easy to read cookie dump

### `__construct()` <a name="__construct"></a>

Instantiate a new Cookie object and tries to load the cookie content if the cookie exists already.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$cookieName`
    - `$expire`
    - `$path`
    - `$keyStore`
- It does not return anything.

### `isCookieFound()` <a name="isCookieFound"></a>

Returns true if the visitor already has the cookie.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

### `delete()` <a name="delete"></a>

Delete the cookie

#### Signature

- It is a **public** method.
- It does not return anything.

### `save()` <a name="save"></a>

Saves the cookie (set the Cookie header).

#### Description

You have to call this method before sending any text to the browser or you would get the
&quot;Header already sent&quot; error.

#### Signature

- It is a **public** method.
- It does not return anything.

### `setDomain()` <a name="setDomain"></a>

Set cookie domain

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$domain`
- It does not return anything.

### `setSecure()` <a name="setSecure"></a>

Set secure flag

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$secure`
- It does not return anything.

### `setHttpOnly()` <a name="setHttpOnly"></a>

Set HTTP only

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$httponly`
- It does not return anything.

### `set()` <a name="set"></a>

Registers a new name =&gt; value association in the cookie.

#### Description

Registering new values is optimal if the value is a numeric value.
If the value is a string, it will be saved as a base64 encoded string.
If the value is an array, it will be saved as a serialized and base64 encoded
string which is not very good in terms of bytes usage.
You should save arrays only when you are sure about their maximum data size.
A cookie has to stay small and its size shouldn&#039;t increase over time!

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `get()` <a name="get"></a>

Returns the value defined by $name from the cookie.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- _Returns:_ The value if found, false if the value is not found
    - `mixed`

### `__toString()` <a name="__toString"></a>

Returns an easy to read cookie dump

#### Signature

- It is a **public** method.
- _Returns:_ The cookie dump
    - `string`


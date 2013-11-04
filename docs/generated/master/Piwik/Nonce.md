<small>Piwik</small>

Nonce
=====

Nonce class.

Description
-----------

A cryptographic nonce -- "number used only once" -- is often recommended as
part of a robust defense against cross-site request forgery (CSRF/XSRF). This
class provides static methods that create and manage nonce values.

Nonces in Piwik are stored as a session variable and have a configurable expiration:

Learn more about nonces [here](http://en.wikipedia.org/wiki/Cryptographic_nonce).


Methods
-------

The class defines the following methods:

- [`getNonce()`](#getNonce) &mdash; Returns the existing nonce.
- [`verifyNonce()`](#verifyNonce) &mdash; Returns if a nonce is valid and comes from a valid request.
- [`discardNonce()`](#discardNonce) &mdash; Force expiration of the current nonce.
- [`getOrigin()`](#getOrigin) &mdash; Returns Origin HTTP header or false if not found.
- [`getAcceptableOrigins()`](#getAcceptableOrigins) &mdash; Returns a list acceptable values for the HTTP Origin header.

### `getNonce()` <a name="getNonce"></a>

Returns the existing nonce.

#### Description

If none exists, a new nonce will be generated.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id`
    - `$ttl`
- It returns a(n) `string` value.

### `verifyNonce()` <a name="verifyNonce"></a>

Returns if a nonce is valid and comes from a valid request.

#### Description

A nonce is valid if it matches the current nonce and if the current nonce
has not expired.

The request is valid if the referrer is a local URL (see [Url::isLocalUrl](#))
and if the HTTP origin is valid (see [getAcceptableOrigins](#getAcceptableOrigins)).

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id`
    - `$cnonce`
- _Returns:_ true if valid; false otherwise
    - `bool`

### `discardNonce()` <a name="discardNonce"></a>

Force expiration of the current nonce.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id`
- It does not return anything.

### `getOrigin()` <a name="getOrigin"></a>

Returns Origin HTTP header or false if not found.

#### Signature

- It is a **public static** method.
- It can return one of the following values:
    - `string`
    - `bool`

### `getAcceptableOrigins()` <a name="getAcceptableOrigins"></a>

Returns a list acceptable values for the HTTP Origin header.

#### Signature

- It is a **public static** method.
- It returns a(n) `array` value.


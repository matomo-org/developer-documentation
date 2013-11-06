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

- [`getNonce()`](#getnonce) &mdash; Returns the existing nonce.
- [`verifyNonce()`](#verifynonce) &mdash; Returns if a nonce is valid and comes from a valid request.
- [`discardNonce()`](#discardnonce) &mdash; Force expiration of the current nonce.
- [`getOrigin()`](#getorigin) &mdash; Returns Origin HTTP header or false if not found.
- [`getAcceptableOrigins()`](#getacceptableorigins) &mdash; Returns a list acceptable values for the HTTP Origin header.

<a name="getnonce" id="getnonce"></a>
<a name="getNonce" id="getNonce"></a>
### `getNonce()`

Returns the existing nonce.

#### Description

If none exists, a new nonce will be generated.

#### Signature

- It accepts the following parameter(s):
    - `$id`
    - `$ttl`
- It returns a `string` value.

<a name="verifynonce" id="verifynonce"></a>
<a name="verifyNonce" id="verifyNonce"></a>
### `verifyNonce()`

Returns if a nonce is valid and comes from a valid request.

#### Description

A nonce is valid if it matches the current nonce and if the current nonce
has not expired.

The request is valid if the referrer is a local URL (see [Url::isLocalUrl](#))
and if the HTTP origin is valid (see [getAcceptableOrigins](#getAcceptableOrigins)).

#### Signature

- It accepts the following parameter(s):
    - `$id`
    - `$cnonce`
- _Returns:_ true if valid; false otherwise
    - `bool`

<a name="discardnonce" id="discardnonce"></a>
<a name="discardNonce" id="discardNonce"></a>
### `discardNonce()`

Force expiration of the current nonce.

#### Signature

- It accepts the following parameter(s):
    - `$id`
- It does not return anything.

<a name="getorigin" id="getorigin"></a>
<a name="getOrigin" id="getOrigin"></a>
### `getOrigin()`

Returns Origin HTTP header or false if not found.

#### Signature

- It can return one of the following values:
    - `string`
    - `bool`

<a name="getacceptableorigins" id="getacceptableorigins"></a>
<a name="getAcceptableOrigins" id="getAcceptableOrigins"></a>
### `getAcceptableOrigins()`

Returns a list acceptable values for the HTTP Origin header.

#### Signature

- It returns a `array` value.


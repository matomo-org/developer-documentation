<small>Piwik\</small>

Nonce
=====

Nonce class.

A cryptographic nonce -- "number used only once" -- is often recommended as
part of a robust defense against cross-site request forgery (CSRF/XSRF). This
class provides static methods that create and manage nonce values.

Nonces in Piwik are stored as a session variable and have a configurable expiration.

Learn more about nonces [here](http://en.wikipedia.org/wiki/Cryptographic_nonce).

Methods
-------

The class defines the following methods:

- [`getNonce()`](#getnonce) &mdash; Returns an existing nonce by ID.
- [`verifyNonce()`](#verifynonce) &mdash; Returns if a nonce is valid and comes from a valid request.
- [`discardNonce()`](#discardnonce) &mdash; Force expiration of the current nonce.
- [`getOrigin()`](#getorigin) &mdash; Returns the **Origin** HTTP header or `false` if not found.
- [`getAcceptableOrigins()`](#getacceptableorigins) &mdash; Returns a list acceptable values for the HTTP **Origin** header.
- [`checkNonce()`](#checknonce) &mdash; Verifies and discards a nonce.

<a name="getnonce" id="getnonce"></a>
<a name="getNonce" id="getNonce"></a>
### `getNonce()`

Returns an existing nonce by ID. If none exists, a new nonce will be generated.

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`string`) &mdash;
       Unique id to avoid namespace conflicts, e.g., `'ModuleName.ActionName'`.
    - `$ttl` (`int`) &mdash;
       Optional time-to-live in seconds; default is 5 minutes. (ie, in 5 minutes, the nonce will no longer be valid).
- It returns a `string` value.

<a name="verifynonce" id="verifynonce"></a>
<a name="verifyNonce" id="verifyNonce"></a>
### `verifyNonce()`

Returns if a nonce is valid and comes from a valid request.

A nonce is valid if it matches the current nonce and if the current nonce
has not expired.

The request is valid if the referrer is a local URL (see [Url::isLocalUrl()](/api-reference/Piwik/Url#islocalurl))
and if the HTTP origin is valid (see [getAcceptableOrigins()](/api-reference/Piwik/Nonce#getacceptableorigins)).

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`string`) &mdash;
       The nonce's unique ID. See [getNonce()](/api-reference/Piwik/Nonce#getnonce).
    - `$cnonce` (`string`) &mdash;
       Nonce sent from client.

- *Returns:*  `bool` &mdash;
    `true` if valid; `false` otherwise.

<a name="discardnonce" id="discardnonce"></a>
<a name="discardNonce" id="discardNonce"></a>
### `discardNonce()`

Force expiration of the current nonce.

#### Signature

-  It accepts the following parameter(s):
    - `$id` (`string`) &mdash;
       The unique nonce ID.
- It does not return anything.

<a name="getorigin" id="getorigin"></a>
<a name="getOrigin" id="getOrigin"></a>
### `getOrigin()`

Returns the **Origin** HTTP header or `false` if not found.

#### Signature


- *Returns:*  `string`|`bool` &mdash;
    

<a name="getacceptableorigins" id="getacceptableorigins"></a>
<a name="getAcceptableOrigins" id="getAcceptableOrigins"></a>
### `getAcceptableOrigins()`

Returns a list acceptable values for the HTTP **Origin** header.

#### Signature

- It returns a `array` value.

<a name="checknonce" id="checknonce"></a>
<a name="checkNonce" id="checkNonce"></a>
### `checkNonce()`

Verifies and discards a nonce.

#### Signature

-  It accepts the following parameter(s):
    - `$nonceName` (`string`) &mdash;
       The nonce's unique ID. See [getNonce()](/api-reference/Piwik/Nonce#getnonce).
    - `$nonce` (`string`|`null`) &mdash;
       The nonce from the client. If `null`, the value from the **nonce** query parameter is used.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the nonce is invalid. See {@link verifyNonce()}.


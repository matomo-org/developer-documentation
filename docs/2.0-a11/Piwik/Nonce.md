<small>Piwik</small>

Nonce
=====

Nonce class.

Description
-----------

A cryptographic nonce -- &quot;number used only once&quot; -- is often recommended as part of a robust defense against cross-site request forgery (CSRF/XSRF).
Desrable characteristics: limited lifetime, uniqueness, unpredictability (pseudo-randomness).

We use a session-dependent nonce with a configurable expiration that combines and hashes:
- a private salt because it&#039;s non-public
- time() because it&#039;s unique
- a mix of PRNGs (pseudo-random number generators) to increase entropy and make it less predictable


Methods
-------

The class defines the following methods:

- [`getNonce()`](#getNonce) &mdash; Generate nonce
- [`verifyNonce()`](#verifyNonce) &mdash; Verify nonce and check referrer (if present, i.e., it may be suppressed by the browser or a proxy/network).
- [`discardNonce()`](#discardNonce) &mdash; Discard nonce (&quot;now&quot; as opposed to waiting for garbage collection)
- [`getOrigin()`](#getOrigin) &mdash; Get ORIGIN header, false if not found
- [`getAcceptableOrigins()`](#getAcceptableOrigins) &mdash; Returns acceptable origins (not simply scheme://host) that should handle a variety of proxy and web server (mis)configurations,.

### `getNonce()` <a name="getNonce"></a>

Generate nonce

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id`
    - `$ttl`
- _Returns:_ Nonce
    - `string`

### `verifyNonce()` <a name="verifyNonce"></a>

Verify nonce and check referrer (if present, i.e., it may be suppressed by the browser or a proxy/network).

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id`
    - `$cnonce`
- _Returns:_ true if valid; false otherwise
    - `bool`

### `discardNonce()` <a name="discardNonce"></a>

Discard nonce (&quot;now&quot; as opposed to waiting for garbage collection)

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id`
- It does not return anything.

### `getOrigin()` <a name="getOrigin"></a>

Get ORIGIN header, false if not found

#### Signature

- It is a **public static** method.
- It can return one of the following values:
    - `string`
    - `bool`

### `getAcceptableOrigins()` <a name="getAcceptableOrigins"></a>

Returns acceptable origins (not simply scheme://host) that should handle a variety of proxy and web server (mis)configurations,.

#### Signature

- It is a **public static** method.
- It returns a(n) `array` value.


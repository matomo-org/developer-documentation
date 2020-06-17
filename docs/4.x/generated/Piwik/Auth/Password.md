<small>Piwik\Auth\</small>

Password
========

Main class to handle actions related to password hashing and verification.

Methods
-------

The class defines the following methods:

- [`hash()`](#hash) &mdash; Hashes a password with the configured algorithm.
- [`info()`](#info) &mdash; Returns information about a hashed password (algo, options, .
- [`needsRehash()`](#needsrehash) &mdash; Rehashes a user's password if necessary.
- [`verify()`](#verify) &mdash; Verifies a user's password against the provided hash.

<a name="hash" id="hash"></a>
<a name="hash" id="hash"></a>
### `hash()`

Hashes a password with the configured algorithm.

#### Signature

-  It accepts the following parameter(s):
    - `$password` (`string`) &mdash;
      
- It returns a `string` value.

<a name="info" id="info"></a>
<a name="info" id="info"></a>
### `info()`

Returns information about a hashed password (algo, options, .

..).

Can be used to verify whether a string is compatible with password_hash().

#### Signature

-  It accepts the following parameter(s):
    - `$hash` (`string`) &mdash;
      
- It returns a `array` value.

<a name="needsrehash" id="needsrehash"></a>
<a name="needsRehash" id="needsRehash"></a>
### `needsRehash()`

Rehashes a user's password if necessary.

This method expects the password to be pre-hashed by
\Piwik\Plugins\UsersManager\UsersManager::getPasswordHash().

#### Signature

-  It accepts the following parameter(s):
    - `$hash` (`string`) &mdash;
      
- It returns a `boolean` value.

<a name="verify" id="verify"></a>
<a name="verify" id="verify"></a>
### `verify()`

Verifies a user's password against the provided hash.

This method expects the password to be pre-hashed by
\Piwik\Plugins\UsersManager\UsersManager::getPasswordHash().

#### Signature

-  It accepts the following parameter(s):
    - `$password` (`string`) &mdash;
      
    - `$hash` (`string`) &mdash;
      
- It returns a `boolean` value.


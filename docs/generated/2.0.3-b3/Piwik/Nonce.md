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

<a name="getnonce" id="getnonce"></a>
<a name="getNonce" id="getNonce"></a>
### `getNonce()`

Returns an existing nonce by ID.

If none exists, a new nonce will be generated.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$id` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Unique id to avoid namespace conflicts, e.g., `'ModuleName.ActionName'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$ttl` (`int`) &mdash;

      <div markdown="1" class="param-desc"> Optional time-to-live in seconds; default is 5 minutes. (ie, in 5 minutes, the nonce will no longer be valid).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
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

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$id` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The nonce's unique ID. See [getNonce()](/api-reference/Piwik/Nonce#getnonce).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$cnonce` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Nonce sent from client.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`) &mdash;
    <div markdown="1" class="param-desc">`true` if valid; `false` otherwise.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="discardnonce" id="discardnonce"></a>
<a name="discardNonce" id="discardNonce"></a>
### `discardNonce()`

Force expiration of the current nonce.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$id` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The unique nonce ID.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getorigin" id="getorigin"></a>
<a name="getOrigin" id="getOrigin"></a>
### `getOrigin()`

Returns the **Origin** HTTP header or `false` if not found.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`|`bool`) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getacceptableorigins" id="getacceptableorigins"></a>
<a name="getAcceptableOrigins" id="getAcceptableOrigins"></a>
### `getAcceptableOrigins()`

Returns a list acceptable values for the HTTP **Origin** header.

#### Signature

- It returns a `array` value.


<small>Piwik\Http\</small>

SecurityHeaders
===============

Sends the response headers for a data response: one that carries data rather than application UI.

Methods
-------

The class defines the following methods:

- [`sendForDataResponse()`](#sendfordataresponse) &mdash; Sends the header set for a response that must never be treated as application UI, such as API output, report exports and generated report bodies.

<a name="sendfordataresponse" id="sendfordataresponse"></a>
<a name="sendForDataResponse" id="sendForDataResponse"></a>
### `sendForDataResponse()`

Sends the header set for a response that must never be treated as application UI, such as
API output, report exports and generated report bodies. Such a response can never be sniffed
into another content type, cannot be framed unless `[General] enable_framed_pages` allows it,
and while the policy is enabled it also cannot run scripts, submit forms or override its base URI.

Must be called before any output is written.

#### Signature

- It returns a `void` value.


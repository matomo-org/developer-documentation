<small>Piwik\Exceptions\</small>

HtmlMessageException
====================

An exception whose message has HTML content.

When these exceptions are caught
the message will not be sanitized before being displayed to the user.

Methods
-------

The class defines the following methods:

- [`getHtmlMessage()`](#gethtmlmessage) &mdash; Returns the exception message.

<a name="gethtmlmessage" id="gethtmlmessage"></a>
<a name="getHtmlMessage" id="getHtmlMessage"></a>
### `getHtmlMessage()`

Returns the exception message.

#### Signature

- It returns a `string` value.


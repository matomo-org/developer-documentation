<small>Piwik</small>

Http
====

Server-side http client to retrieve content from remote servers, and optionally save to a local file.

Description
-----------

Used to check for the latest Piwik version and download updates.

Signature
---------

- It is a(n) **class**.

Methods
-------

The class defines the following methods:

- [`getTransportMethod()`](#getTransportMethod) &mdash; Get &quot;best&quot; available transport method for sendHttpRequest() calls.
- [`sendHttpRequest()`](#sendHttpRequest) &mdash; Sends http request ensuring the request will fail before $timeout seconds If no $destinationPath is specified, the trimmed response (without header) is returned as a string.
- [`sendHttpRequestBy()`](#sendHttpRequestBy) &mdash; Sends http request using the specified transport method
- [`downloadChunk()`](#downloadChunk) &mdash; Downloads the next chunk of a specific file.
- [`configCurlCertificate()`](#configCurlCertificate) &mdash; Will configure CURL handle $ch to use local list of Certificate Authorities,
- [`getUserAgent()`](#getUserAgent)
- [`fetchRemoteFile()`](#fetchRemoteFile) &mdash; Fetch the file at $url in the destination $destinationPath

### `getTransportMethod()` <a name="getTransportMethod"></a>

Get &quot;best&quot; available transport method for sendHttpRequest() calls.

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `sendHttpRequest()` <a name="sendHttpRequest"></a>

Sends http request ensuring the request will fail before $timeout seconds If no $destinationPath is specified, the trimmed response (without header) is returned as a string.

#### Description

If a $destinationPath is specified, the response (without header) is saved to a file.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$aUrl`
    - `$timeout`
    - `$userAgent`
    - `$destinationPath`
    - `$followDepth`
    - `$acceptLanguage`
    - `$byteRange`
    - `$getExtendedInfo`
    - `$httpMethod`
- _Returns:_ true (or string) on success; false on HTTP response error code (1xx or 4xx)
    - `bool`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `sendHttpRequestBy()` <a name="sendHttpRequestBy"></a>

Sends http request using the specified transport method

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$method`
    - `$aUrl`
    - `$timeout`
    - `$userAgent`
    - `$destinationPath`
    - `$file`
    - `$followDepth`
    - `$acceptLanguage`
    - `$acceptInvalidSslCertificate`
    - `$byteRange`
    - `$getExtendedInfo`
    - `$httpMethod`
- _Returns:_ true (or string/array) on success; false on HTTP response error code (1xx or 4xx)
    - `bool`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `downloadChunk()` <a name="downloadChunk"></a>

Downloads the next chunk of a specific file.

#### Description

The next chunk&#039;s byte range
is determined by the existing file&#039;s size and the expected file size, which
is stored in the piwik_option table before starting a download.
Note this function uses the Range HTTP header to accomplish downloading in
parts.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$url`
    - `$outputPath`
    - `$isContinuation`
- It returns a(n) `array` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `configCurlCertificate()` <a name="configCurlCertificate"></a>

Will configure CURL handle $ch to use local list of Certificate Authorities,

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ch`
- It does not return anything.

### `getUserAgent()` <a name="getUserAgent"></a>

#### Signature

- It is a **public static** method.
- It does not return anything.

### `fetchRemoteFile()` <a name="fetchRemoteFile"></a>

Fetch the file at $url in the destination $destinationPath

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$url`
    - `$destinationPath`
    - `$tries`
    - `$timeout`
- _Returns:_ true on success, throws Exception on failure
    - `bool`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)


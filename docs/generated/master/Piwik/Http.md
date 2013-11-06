<small>Piwik</small>

Http
====

Server-side http client to retrieve content from remote servers, and optionally save to a local file.

Description
-----------

Used to check for the latest Piwik version and download updates.


Methods
-------

The class defines the following methods:

- [`getTransportMethod()`](#gettransportmethod) &mdash; Returns the "best" available transport method for [sendHttpRequest()](#sendHttpRequest) calls.
- [`sendHttpRequest()`](#sendhttprequest) &mdash; Sends an HTTP request using best available transport method.
- [`downloadChunk()`](#downloadchunk) &mdash; Downloads the next chunk of a specific file.
- [`fetchRemoteFile()`](#fetchremotefile) &mdash; Fetches a file located at `$url` and saves it to `$destinationPath`.

<a name="gettransportmethod" id="gettransportmethod"></a>
<a name="getTransportMethod" id="getTransportMethod"></a>
### `getTransportMethod()`

Returns the "best" available transport method for [sendHttpRequest()](#sendHttpRequest) calls.

#### Signature

- _Returns:_ Either `'curl'`, `'fopen'` or `'socket'`.
    - `string`

<a name="sendhttprequest" id="sendhttprequest"></a>
<a name="sendHttpRequest" id="sendHttpRequest"></a>
### `sendHttpRequest()`

Sends an HTTP request using best available transport method.

#### Signature

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
- _Returns:_ If `$destinationPath` is not specified the HTTP response is returned on success. `false` is returned on failure. If `$getExtendedInfo` is `true` and `$destinationPath` is not specified an array with the following information is returned on success: - status => the HTTP status code - headers => the HTTP headers - data => the HTTP response data `false` is still returned on failure.
    - `bool`
    - `string`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the response cannot be saved to `$destinationPath`, if the HTTP response cannot be sent, if there are more than 5 redirects or if the request times out.

<a name="downloadchunk" id="downloadchunk"></a>
<a name="downloadChunk" id="downloadChunk"></a>
### `downloadChunk()`

Downloads the next chunk of a specific file.

#### Description

The next chunk's byte range
is determined by the existing file's size and the expected file size, which
is stored in the piwik_option table before starting a download. The expected
file size is obtained through a `HEAD` HTTP request.

Note: this function uses the `Range` HTTP header to accomplish downloading in
parts.

The proper use of this function is to call it once per request. The browser
should continue to send requests to Piwik which will in turn call this method
until the file has completely downloaded. In this way, the user can be informed
of a download's progress.

**Example Usage**

    ```
    // browser JavaScript
    var downloadFile = function (isStart) {
        var ajax = new ajaxHelper();
        ajax.addParams({
            module: 'MyPlugin',
            action: 'myAction',
            isStart: isStart ? 1 : 0
        }, 'post');
        ajax.setCallback(function (response) {
            var progress = response.progress
            // ...update progress...

            downloadFile(false);
        });
        ajax.send();
    }

    downloadFile(true);
    ```

    ```
    // PHP controller action
    public function myAction()
    {
        $outputPath = PIWIK_INCLUDE_PATH . '/tmp/averybigfile.zip';
        $isStart = Common::getRequestVar('isStart', 1, 'int');
        Http::downloadChunk("http://bigfiles.com/averybigfile.zip", $outputPath, $isStart == 1);
    }
    ```

#### Signature

- It accepts the following parameter(s):
    - `$url`
    - `$outputPath`
    - `$isContinuation`
- It returns a `array` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the file already exists and we&#039;re starting a new download, if we&#039;re trying to continue a download that never started

<a name="fetchremotefile" id="fetchremotefile"></a>
<a name="fetchRemoteFile" id="fetchRemoteFile"></a>
### `fetchRemoteFile()`

Fetches a file located at `$url` and saves it to `$destinationPath`.

#### Signature

- It accepts the following parameter(s):
    - `$url`
    - `$destinationPath`
    - `$tries`
    - `$timeout`
- _Returns:_ true on success, throws Exception on failure
    - `bool`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the response cannot be saved to `$destinationPath`, if the HTTP response cannot be sent, if there are more than 5 redirects or if the request times out.


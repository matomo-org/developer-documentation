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

- [`getTransportMethod()`](#getTransportMethod) &mdash; Returns the &quot;best&quot; available transport method for [sendHttpRequest()](#sendHttpRequest) calls.
- [`sendHttpRequest()`](#sendHttpRequest) &mdash; Sends an HTTP request using best available transport method.
- [`downloadChunk()`](#downloadChunk) &mdash; Downloads the next chunk of a specific file.
- [`fetchRemoteFile()`](#fetchRemoteFile) &mdash; Fetches a file located at `$url` and saves it to `$destinationPath`.

### `getTransportMethod()` <a name="getTransportMethod"></a>

Returns the &quot;best&quot; available transport method for [sendHttpRequest()](#sendHttpRequest) calls.

#### Signature

- It is a **public static** method.
- _Returns:_ Either `&#039;curl&#039;`, `&#039;fopen&#039;` or `&#039;socket&#039;`.
    - `string`

### `sendHttpRequest()` <a name="sendHttpRequest"></a>

Sends an HTTP request using best available transport method.

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
- _Returns:_ If `$destinationPath` is not specified the HTTP response is returned on success. `false` is returned on failure. If `$getExtendedInfo` is `true` and `$destinationPath` is not specified an array with the following information is returned on success: - status =&gt; the HTTP status code - headers =&gt; the HTTP headers - data =&gt; the HTTP response data `false` is still returned on failure.
    - `bool`
    - `string`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the response cannot be saved to `$destinationPath`, if the HTTP response cannot be sent, if there are more than 5 redirects or if the request times out.

### `downloadChunk()` <a name="downloadChunk"></a>

Downloads the next chunk of a specific file.

#### Description

The next chunk&#039;s byte range
is determined by the existing file&#039;s size and the expected file size, which
is stored in the piwik_option table before starting a download. The expected
file size is obtained through a `HEAD` HTTP request.

Note: this function uses the `Range` HTTP header to accomplish downloading in
parts.

The proper use of this function is to call it once per request. The browser
should continue to send requests to Piwik which will in turn call this method
until the file has completely downloaded. In this way, the user can be informed
of a download&#039;s progress.

**Example Usage**

    ```
    // browser JavaScript
    var downloadFile = function (isStart) {
        var ajax = new ajaxHelper();
        ajax.addParams({
            module: &#039;MyPlugin&#039;,
            action: &#039;myAction&#039;,
            isStart: isStart ? 1 : 0
        }, &#039;post&#039;);
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
        $outputPath = PIWIK_INCLUDE_PATH . &#039;/tmp/averybigfile.zip&#039;;
        $isStart = Common::getRequestVar(&#039;isStart&#039;, 1, &#039;int&#039;);
        Http::downloadChunk(&quot;http://bigfiles.com/averybigfile.zip&quot;, $outputPath, $isStart == 1);
    }
    ```

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$url`
    - `$outputPath`
    - `$isContinuation`
- It returns a(n) `array` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the file already exists and we&#039;re starting a new download, if we&#039;re trying to continue a download that never started

### `fetchRemoteFile()` <a name="fetchRemoteFile"></a>

Fetches a file located at `$url` and saves it to `$destinationPath`.

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
    - [`Exception`](http://php.net/class.Exception) &mdash; if the response cannot be saved to `$destinationPath`, if the HTTP response cannot be sent, if there are more than 5 redirects or if the request times out.


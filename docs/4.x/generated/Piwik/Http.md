<small>Piwik\</small>

Http
====

Contains HTTP client related helper methods that can retrieve content from remote servers and optionally save to a local file.

Used to check for the latest Piwik version and download updates.

Methods
-------

The class defines the following methods:

- [`getTransportMethod()`](#gettransportmethod) &mdash; Returns the "best" available transport method for [sendHttpRequest()](/api-reference/Piwik/Http#sendhttprequest) calls.
- [`sendHttpRequest()`](#sendhttprequest) &mdash; Sends an HTTP request using best available transport method.
- [`downloadChunk()`](#downloadchunk) &mdash; Downloads the next chunk of a specific file.
- [`fetchRemoteFile()`](#fetchremotefile) &mdash; Fetches a file located at `$url` and saves it to `$destinationPath`.

<a name="gettransportmethod" id="gettransportmethod"></a>
<a name="getTransportMethod" id="getTransportMethod"></a>
### `getTransportMethod()`

Returns the "best" available transport method for [sendHttpRequest()](/api-reference/Piwik/Http#sendhttprequest) calls.

#### Signature


- *Returns:*  `string`|`null` &mdash;
    Either curl, fopen, socket or null if no method is supported.

<a name="sendhttprequest" id="sendhttprequest"></a>
<a name="sendHttpRequest" id="sendHttpRequest"></a>
### `sendHttpRequest()`

Sends an HTTP request using best available transport method.

#### Signature

-  It accepts the following parameter(s):
    - `$aUrl` (`string`) &mdash;
       The target URL.
    - `$timeout` (`int`) &mdash;
       The number of seconds to wait before aborting the HTTP request.
    - `$userAgent` (`string`|`null`) &mdash;
       The user agent to use.
    - `$destinationPath` (`string`|`null`) &mdash;
       If supplied, the HTTP response will be saved to the file specified by this path.
    - `$followDepth` (`int`|`null`) &mdash;
       Internal redirect count. Should always pass `null` for this parameter.
    - `$acceptLanguage` (`bool`) &mdash;
       The value to use for the `'Accept-Language'` HTTP request header.
    - `$byteRange` (`array`|`bool`) &mdash;
       For `Range:` header. Should be two element array of bytes, eg, `array(0, 1024)` Doesn't work w/ `fopen` transport method.
    - `$getExtendedInfo` (`bool`) &mdash;
       If true returns the status code, headers & response, if false just the response.
    - `$httpMethod` (`string`) &mdash;
       The HTTP method to use. Defaults to `'GET'`.
    - `$httpUsername` (`string`) &mdash;
       HTTP Auth username
    - `$httpPassword` (`string`) &mdash;
       HTTP Auth password

- *Returns:*  `bool`|`string` &mdash;
    If `$destinationPath` is not specified the HTTP response is returned on success. `false`
                    is returned on failure.
                    If `$getExtendedInfo` is `true` and `$destinationPath` is not specified an array with
                    the following information is returned on success:

                    - **status**: the HTTP status code
                    - **headers**: the HTTP headers
                    - **data**: the HTTP response data

                    `false` is still returned on failure.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the response cannot be saved to `$destinationPath`, if the HTTP response cannot be sent,
                  if there are more than 5 redirects or if the request times out.

<a name="downloadchunk" id="downloadchunk"></a>
<a name="downloadChunk" id="downloadChunk"></a>
### `downloadChunk()`

Downloads the next chunk of a specific file. The next chunk's byte range
is determined by the existing file's size and the expected file size, which
is stored in the option table before starting a download. The expected
file size is obtained through a `HEAD` HTTP request.

_Note: this function uses the **Range** HTTP header to accomplish downloading in
parts. Not every server supports this header._

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

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
       The url to download from.
    - `$outputPath` (`string`) &mdash;
       The path to the file to save/append to.
    - `$isContinuation` (`bool`) &mdash;
       `true` if this is the continuation of a download, or if we're starting a fresh one.
- It returns a `array` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the file already exists and we&#039;re starting a new download,
                  if we&#039;re trying to continue a download that never started

<a name="fetchremotefile" id="fetchremotefile"></a>
<a name="fetchRemoteFile" id="fetchRemoteFile"></a>
### `fetchRemoteFile()`

Fetches a file located at `$url` and saves it to `$destinationPath`.

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
       The URL of the file to download.
    - `$destinationPath` (`string`) &mdash;
       The path to download the file to.
    - `$tries` (`int`) &mdash;
       (deprecated)
    - `$timeout` (`int`) &mdash;
       The amount of seconds to wait before aborting the HTTP request.

- *Returns:*  `bool` &mdash;
    `true` on success, throws Exception on failure
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the response cannot be saved to `$destinationPath`, if the HTTP response cannot be sent,
                  if there are more than 5 redirects or if the request times out.


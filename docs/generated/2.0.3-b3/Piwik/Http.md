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


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">Either `'curl'`, `'fopen'` or `'socket'`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="sendhttprequest" id="sendhttprequest"></a>
<a name="sendHttpRequest" id="sendHttpRequest"></a>
### `sendHttpRequest()`

Sends an HTTP request using best available transport method.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$aUrl` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The target URL.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$timeout` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The number of seconds to wait before aborting the HTTP request.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$userAgent` (`string`|`null`) &mdash;

      <div markdown="1" class="param-desc"> The user agent to use.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$destinationPath` (`string`|`null`) &mdash;

      <div markdown="1" class="param-desc"> If supplied, the HTTP response will be saved to the file specified by this path.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$followDepth` (`int`|`null`) &mdash;

      <div markdown="1" class="param-desc"> Internal redirect count. Should always pass `null` for this parameter.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$acceptLanguage` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> The value to use for the `'Accept-Language'` HTTP request header.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$byteRange` (`array`|`bool`) &mdash;

      <div markdown="1" class="param-desc"> For `Range:` header. Should be two element array of bytes, eg, `array(0, 1024)` Doesn't work w/ `fopen` transport method.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$getExtendedInfo` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If true returns the status code, headers & response, if false just the response.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$httpMethod` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The HTTP method to use. Defaults to `'GET'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`|`string`) &mdash;
    <div markdown="1" class="param-desc">If `$destinationPath` is not specified the HTTP response is returned on success. `false` is returned on failure. If `$getExtendedInfo` is `true` and `$destinationPath` is not specified an array with the following information is returned on success:  - **status**: the HTTP status code - **headers**: the HTTP headers - **data**: the HTTP response data  `false` is still returned on failure.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the response cannot be saved to `$destinationPath`, if the HTTP response cannot be sent, if there are more than 5 redirects or if the request times out.

<a name="downloadchunk" id="downloadchunk"></a>
<a name="downloadChunk" id="downloadChunk"></a>
### `downloadChunk()`

Downloads the next chunk of a specific file.

The next chunk's byte range
is determined by the existing file's size and the expected file size, which
is stored in the piwik_option table before starting a download. The expected
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

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The url to download from.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$outputPath` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The path to the file to save/append to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$isContinuation` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> `true` if this is the continuation of a download, or if we're starting a fresh one.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `array` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the file already exists and we&#039;re starting a new download, if we&#039;re trying to continue a download that never started

<a name="fetchremotefile" id="fetchremotefile"></a>
<a name="fetchRemoteFile" id="fetchRemoteFile"></a>
### `fetchRemoteFile()`

Fetches a file located at `$url` and saves it to `$destinationPath`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The URL of the file to download.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$destinationPath` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The path to download the file to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$tries` (`int`) &mdash;

      <div markdown="1" class="param-desc"> (deprecated)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$timeout` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The amount of seconds to wait before aborting the HTTP request.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`) &mdash;
    <div markdown="1" class="param-desc">`true` on success, throws Exception on failure</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the response cannot be saved to `$destinationPath`, if the HTTP response cannot be sent, if there are more than 5 redirects or if the request times out.


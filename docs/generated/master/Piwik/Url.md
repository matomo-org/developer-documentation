<small>Piwik\</small>

Url
===

Provides URL related helper methods.

This class provides simple methods that can be used to parse and modify
the current URL. It is most useful when plugins need to redirect the current
request to a URL and when they need to link to other parts of Piwik in
HTML.

### Examples

**Redirect to a different controller action**

    public function myControllerAction()
    {
        $url = Url::getCurrentQueryStringWithParametersModified(array(
            'module' => 'UserSettings',
            'action' => 'index'
        ));
        Url::redirectToUrl($url);
    }

**Link to a different controller action in a template**

    public function myControllerAction()
    {
        $url = Url::getCurrentQueryStringWithParametersModified(array(
            'module' => 'UserCountryMap',
            'action' => 'realtimeMap',
            'changeVisitAlpha' => 0,
            'removeOldVisits' => 0
        ));
        $view = new View("@MyPlugin/myPopup");
        $view->realtimeMapUrl = $url;
        return $view->render();
    }

Methods
-------

The class defines the following methods:

- [`getCurrentUrl()`](#getcurrenturl) &mdash; Returns the current URL.
- [`getCurrentUrlWithoutQueryString()`](#getcurrenturlwithoutquerystring) &mdash; Returns the current URL without the query string.
- [`getCurrentUrlWithoutFileName()`](#getcurrenturlwithoutfilename) &mdash; Returns the current URL without the query string and without the name of the file being executed.
- [`getCurrentScriptPath()`](#getcurrentscriptpath) &mdash; Returns the path to the script being executed.
- [`getCurrentScriptName()`](#getcurrentscriptname) &mdash; Returns the path to the script being executed.
- [`getCurrentScheme()`](#getcurrentscheme) &mdash; Returns the current URL's protocol.
- [`getCurrentHost()`](#getcurrenthost) &mdash; Returns the current host.
- [`getCurrentQueryString()`](#getcurrentquerystring) &mdash; Returns the query string of the current URL.
- [`getArrayFromCurrentQueryString()`](#getarrayfromcurrentquerystring) &mdash; Returns an array mapping query paramater names with query parameter values for the current URL.
- [`getCurrentQueryStringWithParametersModified()`](#getcurrentquerystringwithparametersmodified) &mdash; Modifies the current query string with the supplied parameters and returns the result.
- [`getQueryStringFromParameters()`](#getquerystringfromparameters) &mdash; Converts an array of parameters name => value mappings to a query string.
- [`redirectToReferrer()`](#redirecttoreferrer) &mdash; Redirects the user to the referrer.
- [`redirectToUrl()`](#redirecttourl) &mdash; Redirects the user to the specified URL.
- [`getReferrer()`](#getreferrer) &mdash; Returns the **HTTP_REFERER** `$_SERVER` variable, or `false` if not found.
- [`isLocalUrl()`](#islocalurl) &mdash; Returns `true` if the URL points to something on the same host, `false` if otherwise.

<a name="getcurrenturl" id="getcurrenturl"></a>
<a name="getCurrentUrl" id="getCurrentUrl"></a>
### `getCurrentUrl()`

Returns the current URL.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcurrenturlwithoutquerystring" id="getcurrenturlwithoutquerystring"></a>
<a name="getCurrentUrlWithoutQueryString" id="getCurrentUrlWithoutQueryString"></a>
### `getCurrentUrlWithoutQueryString()`

Returns the current URL without the query string.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$checkTrustedHost` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to do trusted host check. Should ALWAYS be true, except in [Controller](/api-reference/Piwik/Plugin/Controller).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `"http://example.org/dir1/dir2/index.php"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcurrenturlwithoutfilename" id="getcurrenturlwithoutfilename"></a>
<a name="getCurrentUrlWithoutFileName" id="getCurrentUrlWithoutFileName"></a>
### `getCurrentUrlWithoutFileName()`

Returns the current URL without the query string and without the name of the file being executed.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `"http://example.org/dir1/dir2/"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcurrentscriptpath" id="getcurrentscriptpath"></a>
<a name="getCurrentScriptPath" id="getCurrentScriptPath"></a>
### `getCurrentScriptPath()`

Returns the path to the script being executed.

The script file name is not included.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `"/dir1/dir2/"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcurrentscriptname" id="getcurrentscriptname"></a>
<a name="getCurrentScriptName" id="getCurrentScriptName"></a>
### `getCurrentScriptName()`

Returns the path to the script being executed.

Includes the script file name.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$removePathInfo` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If true (default value) then the PATH_INFO will be stripped.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `"/dir1/dir2/index.php"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcurrentscheme" id="getcurrentscheme"></a>
<a name="getCurrentScheme" id="getCurrentScheme"></a>
### `getCurrentScheme()`

Returns the current URL's protocol.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">`'https'` or `'http'`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcurrenthost" id="getcurrenthost"></a>
<a name="getCurrentHost" id="getCurrentHost"></a>
### `getCurrentHost()`

Returns the current host.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$default` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Default value to return if host unknown</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$checkTrustedHost` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to do trusted host check. Should ALWAYS be true, except in Controller.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `"example.org"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcurrentquerystring" id="getcurrentquerystring"></a>
<a name="getCurrentQueryString" id="getCurrentQueryString"></a>
### `getCurrentQueryString()`

Returns the query string of the current URL.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `"?param1=value1&param2=value2"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getarrayfromcurrentquerystring" id="getarrayfromcurrentquerystring"></a>
<a name="getArrayFromCurrentQueryString" id="getArrayFromCurrentQueryString"></a>
### `getArrayFromCurrentQueryString()`

Returns an array mapping query paramater names with query parameter values for the current URL.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">If current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"` this will return: array( 'param1' => string 'value1', 'param2' => string 'value2' )</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcurrentquerystringwithparametersmodified" id="getcurrentquerystringwithparametersmodified"></a>
<a name="getCurrentQueryStringWithParametersModified" id="getCurrentQueryStringWithParametersModified"></a>
### `getCurrentQueryStringWithParametersModified()`

Modifies the current query string with the supplied parameters and returns the result.

Parameters in the current URL will be overwritten with values
in `$params` and parameters absent from the current URL but present in `$params`
will be added to the result.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$params` (`array`) &mdash;

      <div markdown="1" class="param-desc"> set of parameters to modify/add in the current URL eg, `array('param3' => 'value3')`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `"?param2=value2&param3=value3"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getquerystringfromparameters" id="getquerystringfromparameters"></a>
<a name="getQueryStringFromParameters" id="getQueryStringFromParameters"></a>
### `getQueryStringFromParameters()`

Converts an array of parameters name => value mappings to a query string.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> eg. `array('param1' => 10, 'param2' => array(1,2))`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg. `"param1=10&param2[]=1&param2[]=2"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="redirecttoreferrer" id="redirecttoreferrer"></a>
<a name="redirectToReferrer" id="redirectToReferrer"></a>
### `redirectToReferrer()`

Redirects the user to the referrer.

If no referrer exists, the user is redirected
to the current URL without query string.

#### Signature

- It does not return anything.

<a name="redirecttourl" id="redirecttourl"></a>
<a name="redirectToUrl" id="redirectToUrl"></a>
### `redirectToUrl()`

Redirects the user to the specified URL.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getreferrer" id="getreferrer"></a>
<a name="getReferrer" id="getReferrer"></a>
### `getReferrer()`

Returns the **HTTP_REFERER** `$_SERVER` variable, or `false` if not found.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`|`Piwik\false`) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="islocalurl" id="islocalurl"></a>
<a name="isLocalUrl" id="isLocalUrl"></a>
### `isLocalUrl()`

Returns `true` if the URL points to something on the same host, `false` if otherwise.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`) &mdash;
    <div markdown="1" class="param-desc">True if local; false otherwise.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>


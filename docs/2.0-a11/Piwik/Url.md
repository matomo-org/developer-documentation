<small>Piwik</small>

Url
===

Class to retrieve absolute URL or URI components of the current URL, and handle URL redirection.


Methods
-------

The class defines the following methods:

- [`getCurrentUrl()`](#getCurrentUrl) &mdash; If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot;
- [`getCurrentUrlWithoutQueryString()`](#getCurrentUrlWithoutQueryString) &mdash; If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;http://example.org/dir1/dir2/index.php&quot;
- [`getCurrentUrlWithoutFileName()`](#getCurrentUrlWithoutFileName) &mdash; If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;http://example.org/dir1/dir2/&quot;
- [`getCurrentScriptPath()`](#getCurrentScriptPath) &mdash; If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;/dir1/dir2/&quot;
- [`getCurrentScriptName()`](#getCurrentScriptName) &mdash; If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;/dir1/dir2/index.php&quot;
- [`getCurrentScheme()`](#getCurrentScheme) &mdash; If the current URL is &#039;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &#039;http&#039;
- [`isValidHost()`](#isValidHost) &mdash; Validate &quot;Host&quot; (untrusted user input)
- [`saveTrustedHostnameInConfig()`](#saveTrustedHostnameInConfig) &mdash; Records one host, or an array of hosts in the config file, if user is super user
- [`getHost()`](#getHost) &mdash; Get host
- [`setHost()`](#setHost) &mdash; Sets the host.
- [`getCurrentHost()`](#getCurrentHost) &mdash; If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;example.org&quot;
- [`getCurrentQueryString()`](#getCurrentQueryString) &mdash; If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;?param1=value1&amp;param2=value2&quot;
- [`getQueryStringFromParameters()`](#getQueryStringFromParameters) &mdash; Given an array of parameters name-&gt;value, returns the query string.
- [`redirectToReferrer()`](#redirectToReferrer) &mdash; Redirects the user to the referrer if found.
- [`redirectToUrl()`](#redirectToUrl) &mdash; Redirects the user to the specified URL
- [`getReferrer()`](#getReferrer) &mdash; Returns the HTTP_REFERER header, false if not found.
- [`isLocalUrl()`](#isLocalUrl) &mdash; Is the URL on the same host?

### `getCurrentUrl()` <a name="getCurrentUrl"></a>

If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot;

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `getCurrentUrlWithoutQueryString()` <a name="getCurrentUrlWithoutQueryString"></a>

If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;http://example.org/dir1/dir2/index.php&quot;

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$checkTrustedHost`
- It returns a(n) `string` value.

### `getCurrentUrlWithoutFileName()` <a name="getCurrentUrlWithoutFileName"></a>

If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;http://example.org/dir1/dir2/&quot;

#### Signature

- It is a **public static** method.
- _Returns:_ with trailing slash
    - `string`

### `getCurrentScriptPath()` <a name="getCurrentScriptPath"></a>

If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;/dir1/dir2/&quot;

#### Signature

- It is a **public static** method.
- _Returns:_ with trailing slash
    - `string`

### `getCurrentScriptName()` <a name="getCurrentScriptName"></a>

If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;/dir1/dir2/index.php&quot;

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `getCurrentScheme()` <a name="getCurrentScheme"></a>

If the current URL is &#039;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &#039;http&#039;

#### Signature

- It is a **public static** method.
- _Returns:_ &#039;https&#039; or &#039;http&#039;
    - `string`

### `isValidHost()` <a name="isValidHost"></a>

Validate &quot;Host&quot; (untrusted user input)

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$host`
- _Returns:_ True if valid; false otherwise
    - `bool`

### `saveTrustedHostnameInConfig()` <a name="saveTrustedHostnameInConfig"></a>

Records one host, or an array of hosts in the config file, if user is super user

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$host`
- It returns a(n) `bool` value.

### `getHost()` <a name="getHost"></a>

Get host

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$checkIfTrusted`
- _Returns:_ false if no host found
    - `string`
    - `bool`

### `setHost()` <a name="setHost"></a>

Sets the host.

#### Description

Useful for CLI scripts, eg. archive.php

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$host`
- It does not return anything.

### `getCurrentHost()` <a name="getCurrentHost"></a>

If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;example.org&quot;

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$default`
    - `$checkTrustedHost`
- It returns a(n) `string` value.

### `getCurrentQueryString()` <a name="getCurrentQueryString"></a>

If current URL is &quot;http://example.org/dir1/dir2/index.php?param1=value1&amp;param2=value2&quot; will return &quot;?param1=value1&amp;param2=value2&quot;

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `getQueryStringFromParameters()` <a name="getQueryStringFromParameters"></a>

Given an array of parameters name-&gt;value, returns the query string.

#### Description

Also works with array values using the php array syntax for GET parameters.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$parameters`
- _Returns:_ eg. &quot;param1=10&amp;param2[]=1&amp;param2[]=2&quot;
    - `string`

### `redirectToReferrer()` <a name="redirectToReferrer"></a>

Redirects the user to the referrer if found.

#### Description

If the user doesn&#039;t have a referrer set, it redirects to the current URL without query string.

#### Signature

- It is a **public static** method.
- It does not return anything.

### `redirectToUrl()` <a name="redirectToUrl"></a>

Redirects the user to the specified URL

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$url`
- It does not return anything.

### `getReferrer()` <a name="getReferrer"></a>

Returns the HTTP_REFERER header, false if not found.

#### Signature

- It is a **public static** method.
- It can return one of the following values:
    - `string`
    - `bool`

### `isLocalUrl()` <a name="isLocalUrl"></a>

Is the URL on the same host?

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$url`
- _Returns:_ True if local; false otherwise.
    - `bool`


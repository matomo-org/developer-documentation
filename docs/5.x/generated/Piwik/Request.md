<small>Piwik\</small>

Request
=======

Provides (type safe) access methods for request parameters.

Ensure to handle parameters received with this class with care.
Especially parameters received as string, array or json might contain malicious content. Those should never be used
raw in templates or other output.

Note: For security reasons this class will automatically remove null byte sequences from string values.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`fromRequest()`](#fromrequest) &mdash; Creates a request object using GET and POST parameters of the current request
- [`fromGet()`](#fromget) &mdash; Creates a request object using only GET parameters of the current request
- [`fromPost()`](#frompost) &mdash; Creates a request object using only POST parameters of the current request
- [`fromQueryString()`](#fromquerystring) &mdash; Creates a request object using the parameters that can be extracted from the provided query string
- [`getParameter()`](#getparameter) &mdash; Returns the requested parameter from the request object.
- [`getIntegerParameter()`](#getintegerparameter) &mdash; Returns the requested parameter from the request object.
- [`getFloatParameter()`](#getfloatparameter) &mdash; Returns the requested parameter from the request object.
- [`getStringParameter()`](#getstringparameter) &mdash; Returns the requested parameter from the request object.
- [`getBoolParameter()`](#getboolparameter) &mdash; Returns the requested parameter from the request object.
- [`getArrayParameter()`](#getarrayparameter) &mdash; Returns the requested parameter from the request object.
- [`getJsonParameter()`](#getjsonparameter) &mdash; Returns the requested parameter from the request object.
- [`getParameters()`](#getparameters) &mdash; Returns an array containing all parameters of the request object

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$requestParameters` (`array`) &mdash;
      

<a name="fromrequest" id="fromrequest"></a>
<a name="fromRequest" id="fromRequest"></a>
### `fromRequest()`

Creates a request object using GET and POST parameters of the current request

#### Signature

- It returns a [`Request`](../Piwik/Request.md) value.

<a name="fromget" id="fromget"></a>
<a name="fromGet" id="fromGet"></a>
### `fromGet()`

Creates a request object using only GET parameters of the current request

#### Signature

- It returns a [`Request`](../Piwik/Request.md) value.

<a name="frompost" id="frompost"></a>
<a name="fromPost" id="fromPost"></a>
### `fromPost()`

Creates a request object using only POST parameters of the current request

#### Signature

- It returns a [`Request`](../Piwik/Request.md) value.

<a name="fromquerystring" id="fromquerystring"></a>
<a name="fromQueryString" id="fromQueryString"></a>
### `fromQueryString()`

Creates a request object using the parameters that can be extracted from the provided query string

#### Signature

-  It accepts the following parameter(s):
    - `$queryString` (`string`) &mdash;
      
- It returns a [`Request`](../Piwik/Request.md) value.

<a name="getparameter" id="getparameter"></a>
<a name="getParameter" id="getParameter"></a>
### `getParameter()`

Returns the requested parameter from the request object.

If the requested parameter can't be found and no default is provided an exception will be thrown

Note: It's recommend to use one of type-safe methods instead, if a certain type is expected:

#### See Also

- `getIntegerParameter`
- `getFloatParameter`
- `getStringParameter`
- `getArrayParameter`
- `getJSONParameter`

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
    - `$default` (`mixed`) &mdash;
      
- It returns a `mixed` value.
- It throws one of the following exceptions:
    - [`InvalidArgumentException`](http://php.net/class.InvalidArgumentException)

<a name="getintegerparameter" id="getintegerparameter"></a>
<a name="getIntegerParameter" id="getIntegerParameter"></a>
### `getIntegerParameter()`

Returns the requested parameter from the request object.

If no default is provided and the requested parameter either can't be found or is not of type integer an
exception will be thrown

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
    - `$default` (`int`|`null`) &mdash;
      
- It returns a `int` value.
- It throws one of the following exceptions:
    - [`InvalidArgumentException`](http://php.net/class.InvalidArgumentException)

<a name="getfloatparameter" id="getfloatparameter"></a>
<a name="getFloatParameter" id="getFloatParameter"></a>
### `getFloatParameter()`

Returns the requested parameter from the request object.

If no default is provided and the requested parameter either can't be found or is not of type float an
exception will be thrown

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
    - `$default` (`float`|`null`) &mdash;
      
- It returns a `float` value.
- It throws one of the following exceptions:
    - [`InvalidArgumentException`](http://php.net/class.InvalidArgumentException)

<a name="getstringparameter" id="getstringparameter"></a>
<a name="getStringParameter" id="getStringParameter"></a>
### `getStringParameter()`

Returns the requested parameter from the request object.

If no default is provided and the requested parameter either can't be found or is not of type string an
exception will be thrown

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
    - `$default` (`string`|`null`) &mdash;
      
- It returns a `string` value.
- It throws one of the following exceptions:
    - [`InvalidArgumentException`](http://php.net/class.InvalidArgumentException)

<a name="getboolparameter" id="getboolparameter"></a>
<a name="getBoolParameter" id="getBoolParameter"></a>
### `getBoolParameter()`

Returns the requested parameter from the request object.

If no default is provided and the requested parameter either can't be found or can't be converted to boolean
exception will be thrown

Values accepted as bool-ish:
true: true, 'true', '1', 1
false: false, 'false', '0', 0

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
    - `$default` (`bool`|`null`) &mdash;
      
- It returns a `bool` value.
- It throws one of the following exceptions:
    - [`InvalidArgumentException`](http://php.net/class.InvalidArgumentException)

<a name="getarrayparameter" id="getarrayparameter"></a>
<a name="getArrayParameter" id="getArrayParameter"></a>
### `getArrayParameter()`

Returns the requested parameter from the request object.

If no default is provided and the requested parameter either can't be found or is not of type array an
exception will be thrown

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
    - `$default` (`array`|`null`) &mdash;
      
- It returns a `array` value.
- It throws one of the following exceptions:
    - [`InvalidArgumentException`](http://php.net/class.InvalidArgumentException)

<a name="getjsonparameter" id="getjsonparameter"></a>
<a name="getJsonParameter" id="getJsonParameter"></a>
### `getJsonParameter()`

Returns the requested parameter from the request object.

If no default is provided and the requested parameter either can't be found or can't be json_decode'd an
exception will be thrown

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
    - `$default` (`mixed`) &mdash;
      
- It returns a `mixed` value.
- It throws one of the following exceptions:
    - [`InvalidArgumentException`](http://php.net/class.InvalidArgumentException)

<a name="getparameters" id="getparameters"></a>
<a name="getParameters" id="getParameters"></a>
### `getParameters()`

Returns an array containing all parameters of the request object

#### Signature

- It returns a `array` value.


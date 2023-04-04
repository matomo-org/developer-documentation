---
category: Develop
title: Handling Request Parameters
---
# Handling Request Parameters

Matomo currently serves two ways of accessing request variables. While using a `Request` object is recommended, there is still a global method `Common::getRequestVar` that can be used to access request parameters.

Both methods basically have one big difference. 

The old way `Common::getRequestVar`, was designed in a way, that all values returned by that method are automatically sanitized for security reasons. Having that was kind of useful, as it automatically protected Matomo against certain security vulnerabilities like XSS.
Having a requirement of unsaitizing values on purpose to work with it's original data prevented an acidental output of unsafe data.

However, this automatic sanitization can sometimes cause issues, where unsanitizing a value doesn't fully bring back it's original value. To address this, we have introduced a new `Request` object in Matomo 5. It allows a direct access to request parameters without any sanitization (only null byte characters are removed). So when using values returned by this object, you need to handle them with care. Make sure to sanitize the values, e.g. with `Common::sanitizeInputValue()`, where ever they might be directly used in any output.
In Templates and API responses this might already happen automatically, but we recommend to always double check this with potential XSS content.

## Using a `Request` object (recommended)

With Matomo 5 we introduced a new `Request` class that can be used to easily access any type of request parameters and then provides various methods to access request values type safe (if possible).

The class can be used for accessing different type of request parameters:

**All request paramters ($_GET + $_POST)**

```php
$request = \Piwik\Request::fromRequest();
```

**GET request paramters only ($_GET)**

```php
$request = \Piwik\Request::fromGet();
```

**POST request paramters only ($_POST)**

```php
$request = \Piwik\Request::fromPost();
```

**Parameters from a query string**

```php
$request = \Piwik\Request::fromQueryString('param=value&arr[]=1');
```

**Custom paramters**

```php
$request = new \Piwik\Request(['param1' => 'val1', 'param2' => 'val2']);
```

### Accessing parameters

To access the parameters in the `Request` object, there are various methods. 

#### Handling of missing parameters & default values

All methods provide the possibility to define a default value. 
If no default value is provided and the parameter is missing in the request object an `InvalidArgumentException` will be thrown.

#### Accessing parameters with an expected type

If you are expecting a certain type your request variable should contain, you should use one of the type safe methods. This methods will automatically check if the request parameter has a certain type (or can be lossless converted to it). If this is not the case, the default value will be used or an `InvalidArgumentException` will be thrown if non was provided.

* **Integer values** / **getIntegerParameter()**

  Use this method if you expect the parameter to contain an integer value. Only fully valid integeres will be accepted by this method. Strings like `12string` or floating values like `4.5` will be fully discarded and not converted.

  ```php
  $request->getIntegerParameter(string $name, int $default = null): int
  ```

* **Floating values** / **getFloatParameter()**

  Use this method if you expect the parameter to contain a floating value. Only fully valid floats or integers will be accepted by this method. Strings like `12.7string` will be discarded and not converted.

  ```php
  $request->getFloatParameter(string $name, float $default = null): float
  ```

* **String values** / **getStringParameter()**

  Use this method if you expect the parameter to contain a string value. Numeric values will be returned as strings. Other incompatible types like arrays or booleans will be discarded.

  ```php
  $request->getStringParameter(string $name, string $default = null): string
  ```

* **Boolean values** / **getBoolParameter()**

  Use this method if you want to use the parameter as a boolean flag. Accepted boolish values are 
  * true: true, 'true', '1', 1 
  * false: false, 'false', '0', 0
  All other values will be discarded.

  ```php
  $request->getBoolParameter(string $name, bool $default = null): bool
  ```

#### Accessing parameters with special or unknown types

If your parameters does not have a specific type you may use the following methods. But always keep in mind, that the returned values might of any type, so you need to use them with care to avoid type related problems.

* **Array values** / **getArrayParameter()**

  Use this method if your parameter should be provided as array. If the parameter is provided with another type it will be discarded. The values within the array might be of any type, so take care to validate / cast them if needed.

  ```php
  $request->getArrayParameter(string $name, array $default = null): array
  ```

* **JSON encoded data** / **getJSONParameter()**

  If the data of your parameter should contain a json encoded string, you can use this method, to directly receive the parameters values decoded. The returned type though might contain any type of data, so handle it with care.

  ```php
  $request->getJSONParameter(string $name, mixed $default = null): mixed
  ```

* **Unspecific type** / **getParameter()**

  Use this method if your parameter might contain different types. The value if available will simply be returned as is. Keep in mind to properly check for acceptable values before working with them.

  ```php
  $request->getParameter(string $name, mixed $default = null): mixed
  ```

## Using `Common::getRequestVar` (deprecated)

Before Matomo 5 we provided another possibility only, that is still available and can be used. We nevertheless recommend to use the Request class instead.

If you need to access a query or post parameter value, use the [`Common::getRequestVar($varName, $varDefault = null, $varType = null, $requestArrayToUse = null)`](/api-reference/Piwik/Common#getrequestvar) method.

**To avoid XSS vulnerabilities, never access `$_GET`/`$_POST` directly, always go through [Common::getRequestVar](/api-reference/Piwik/Common#getrequestvar).**

Using `Common::getRequestVar` will automatically sanitize the request variables using [Common#sanitizeInputValues](/api-reference/Piwik/Common#sanitizeinputvalues). For arrays and parsed json data this is done recursively. Internally this will escape e.g. special html characters. If you need to work with unescaped values, you may need to apply [Common#unsanitizeInputValues](/api-reference/Piwik/Common#unsanitizeinputvalues).

### Type handling

When working with request variables you should be aware that your variables might not be provided with the type you expect.
Someone could for example provide `&var[]=x` in the URL instead of `&var=x`, causing a variable to be of type `array` instead of `string`.

When using `$_GET` or `$_POST` directly your variables can actually only have the two types: `string` or `array`.
`Common::getRequestVar()` is able to validate your variables for some other types as well. Internally this is done by checking if casting the variable changes it's value.

To force type validation you can pass one of the following types as third parameter:
- `string`
- `array`
- `int` / `integer`
- `float`
- `json` (this tries to perform a `json_decode` on the provided value)

When providing a default value (other than `null`) together with a specific type, please ensure the default value has the same type. The default will be cast to the expected type, which might cause unexpected results. This doesn't apply for the special type `json`.

It's recommended to use the method with three parameters where ever a certain type is expected. This will prevent PHP warnings or errors if an unexpected type was provided.

### Distinguish between GET and POST

In some cases it might be needed to ensure a parameter was provided by either GET or POST. You can achieve that by passing `$_GET` or `$_POST` as fourth parameter.
By default, a combination of `$_GET` and `$_POST` will be used, while GET parameters will overwrite POST parameters.

To receive a variable from POST only you can e.g. use:

```php
$var = Common::getRequestVar('var', null, 'string', $_POST);
```

### Usage Examples

#### Request parameter in a certain type required:

```php
$var = Common::getRequestVar('var', null, 'string');
```

This throws an exception if the request parameter is not provided or has another type than String

#### Request parameter can be provided in a certain type, but a default should be used if not:

```php
$var = Common::getRequestVar('var', $default, 'string');
```

This uses $default if the request parameter is not provided or has another type than String

#### Request parameter is required but might have any type:

```php
$var = Common::getRequestVar('var');
```

This throws an exception if the request parameter is not provided, otherwise the variable can have any type.
If you use this please ensure to do the type handling within your code, so the code won't break if an Array might be provided instead of a String.

#### Request parameter can be provided, but a default should be used if not:

```php
$var = Common::getRequestVar('var', $default);
```

This won't throw an exception in any case. But you can't expect the variable to have a certain type.
If you use this please ensure to do the type handling within your code, so the code won't break if an Array might be provided instead of a String.

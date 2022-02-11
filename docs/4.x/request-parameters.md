---
category: Develop
title: Handling Request Parameters
---
# Handling Request Parameters

If you need to access a query or post parameter value, use the [`Common::getRequestVar($varName, $varDefault = null, $varType = null, $requestArrayToUse = null)`](/api-reference/Piwik/Common#getrequestvar) method.

**To avoid XSS vulnerabilities, never access `$_GET`/`$_POST` directly, always go through [Common::getRequestVar](/api-reference/Piwik/Common#getrequestvar).**

## Type handling

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

It's recommended to use the method with three parameters where ever a certain type is expected. This will prevent PHP warnings or errors if an unexpected type was provided.

## Distinguish between GET and POST

In some cases it might be needed to ensure a parameter was provided by either GET or POST. You can achieve that by passing `$_GET` or `$_POST` as fourth parameter.
By default, a combination of `$_GET` and `$_POST` will be used, while GET parameters will overwrite POST parameters.

To receive a variable from POST only you can e.g. use:

```php
$var = Common::getRequestVar('var', null, 'string', $_POST);
```

## Usage Examples

### Request parameter in a certain type required:

```php
$var = Common::getRequestVar('var', null, 'string');
```

This throws an exception if the request parameter is not provided or has another type than String

### Request parameter can be provided in a certain type, but a default should be used if not:

```php
$var = Common::getRequestVar('var', $default, 'string');
```

This uses $default if the request parameter is not provided or has another type than String

### Request parameter is required but might have any type:

```php
$var = Common::getRequestVar('var');
```

This throws an exception if the request parameter is not provided, otherwise the variable can have any type.
If you use this please ensure to do the type handling within your code, so the code won't break if an Array might be provided instead of a String.

### Request parameter can be provided, but a default should be used if not:

```php
$var = Common::getRequestVar('var', $default);
```

This won't throw an exception in any case. But you can't expect the variable to have a certain type.
If you use this please ensure to do the type handling within your code, so the code won't break if an Array might be provided instead of a String.

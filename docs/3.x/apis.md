---
category: DevelopInDepth
---
# Piwik APIs

Piwik APIs serve two purposes: they serve the data used in controller methods, and they [automatically expose plugin functionality through an HTTP API](/guides/piwiks-reporting-api).

In this guide, we discuss the first purpose.

## About API Classes

Plugins provide APIs by defining a class named API that derives from [`Piwik\Plugins\API`](/api-reference/Piwik/Plugin/API). Every public method that does not have the `@ignore` annotation is exposed as part of Piwik's [Reporting HTTP API](/guides/piwiks-reporting-api).

All APIs are singletons. To access API methods programatically the [`getInstance()`](/api-reference/Piwik/Singleton#getinstance) method can be used:

```php
MyAPI::getInstance()->doSomething();
```

### API methods

API methods can take any number of parameters. Since they can be called through HTTP, methods must assume that parameters will be passed as strings. This also means that method parameters can only be simple values, such as `string`, `bool`, `numeric`, etc. or an array with simple values.

API methods can return only one of four types of data:

- a simple value (`string`, `bool`, `numeric`, etc.)
- a [DataTable](/api-reference/Piwik/DataTable) instance
- a [DataTable\Map](/api-reference/Piwik/DataTable/Map) instance
- an array of any of the values above

This is so Piwik will always be able to convert the result into the desired output format in the reporting API.

If an API method encounters an error, it should throw an exception. Piwik will be able to convert exceptions to the desired output format in the reporting API.

### API method security

All API methods should check whether the current user is allowed to invoke the method. If the API method is read-only, this means checking that the user has view access to the resources the method returns. If the API method performs an action, this normally means checking that the user has either 'write' or 'admin' access to the functionality (or alternatively checking that the user is the super user). For example,

```php
public function getAllForSite($idSite)
{
    Piwik::checkUserHasViewAccess($idSite);

    return // ...
}
```

Look at the `check...` methods in the [Piwik](/api-reference/Piwik/Piwik) class to see what types of checks can be made. Or [learn more about permissions](https://developer.matomo.org/guides/permissions).

### Calling API methods

API methods can be called in two ways. They can be called directly after getting the API singleton instance:

```php
MyAPI::getInstance()->doSomething(
    Common::getRequestVar('idSite'),
    Common::getRequestVar('date'),
    Common::getRequestVar('period')
);
```

or they can be called using the [Piwik\API\Request](/api-reference/Piwik/API/Request) class:

```php
Request::processRequest("MyAPI.doSomething");
```

Note how in the second method, the [Common::getRequestVar](/api-reference/Piwik/Common#getrequestvar) method (which safely retrieves query parameter values) does not have to be called. The [Piwik\API\Request](/api-reference/Piwik/API/Request) class will forward the current request parameters to the API method which makes using it the better choice in some situations.

Also note, that when [Piwik\API\Request](/api-reference/Piwik/API/Request) is used, [extra processing is applied to report data](/guides/piwiks-reporting-api#extra-report-processing).

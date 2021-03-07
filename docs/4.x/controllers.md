---
category: DevelopInDepth
---
# Controllers

In Piwik, Controllers are the objects responsible for outputting HTML. Every plugin that wants to output HTML should define its own Controller that extends [Piwik\Plugin\Controller](/api-reference/Piwik/Plugin/Controller).

Every public method in a controller is exposed and can be called through an HTTP request. **When creating your controller, care should be taken to avoid exposing methods that don't need to be. It may be possible for an attacker to use these methods.**

## Controller output

Controller methods should `return` their output (as opposed to `echo`ing it). Piwik will assume the output is HTML and will automatically take care of the appropriate HTTP response headers. If you want to output something other than HTML you will have to use the `Content-Type` HTTP response header. For example:

```php
@header('Content-Type: application/json; charset=utf-8');
```

## Using controller methods in the Piwik UI

Adding a controller method to a plugin's controller will allow it to be executed via an HTTP request, but it won't automatically show it in the Piwik UI somewhere. There are two ways to make the result of a controller method appear in the Piwik UI:

* add a new menu item that links to the controller method
* use AJAX to invoke the controller method and then display the result

Here's how you do both:

### Adding controller methods as menu items

To add menu items in Piwik, read [the following guide](https://matomo.org/blog/2014/09/add-new-page-menu-item-piwik-introducing-piwik-platform/).

### Invoking controller methods via AJAX

If you have your own custom JavaScript running on Piwik you can use AJAX to dynamically invoke controller methods and display the result.

For example:

```javascript
// invoke MyPlugin.myPage and append the result to the end of the #root element
var ajax = new ajaxHelper();
ajax.addParams({
    module: 'MyPlugin',
    action: 'myPage'
}, 'get');
ajax.setCallback(function (response) {
    $('#root').append(response);
});
ajax.setFormat('html');
ajax.send(false);
```

The **`ajaxHelper`** JavaScript class is stored in the [piwik/plugins/Morpheus/javascripts/ajaxHelper.js](https://github.com/matomo-org/matomo/blob/master/plugins/Morpheus/javascripts/ajaxHelper.js) file.

## Controller method conventions

### Getting query parameters

Unlike API methods, controller methods do not take query parameters as input. If you need to access a query parameter value, use the [`Common::getRequestVar()`](/api-reference/Piwik/Common#getrequestvar) method.

**To avoid XSS vulnerabilities, never access `$_GET`/`$_POST` directly, always go through [Common::getRequestVar](/api-reference/Piwik/Common#getrequestvar).**

### Generating Output

As a plugin developer you are welcome to generate your output in any way you'd like (as long as it's secure), there is nothing in Piwik that will force you to code a certain way. That being said, most Piwik controller methods will have the following convention:

```php
public function myControllerAction()
{
    // Step 1: if this controller action is supposed to execute some logic, do that first
    $idSite = Common::getRequestVar('idSite');
    $period = Common::getRequestVar('period');

    $somethingResult = MyDoer::doSomething($idSite, $period);

    // Step 2: create a view to render the output
    $view = new View("@MyPlugin/myControllerAction.twig");

    // Step 3: set properties of the view, getting data from APIs when necessary
    $view->somethingResult = $somethingResult;
    $view->neededData = API::getInstance()->getNeededData();

    // Step 4: render the view
    return $view->render();
}
```

### Calling API methods

Since controller methods do not take query parameter values as method parameters it can sometimes be a pain to invoke API methods within controller methods. In this case, controllers make use of the [Piwik\API\Request](/api-reference/Piwik/API/Request) class which will forward all query parameters to an API method. For example, let's look at some of the code in the `save()` method in the [Annotations](https://github.com/matomo-org/matomo/blob/master/plugins/Annotations/Controller.php) plugin controller:

```php
$view = new View('@Annotations/saveAnnotation');

// NOTE: permissions checked in API method
// save the annotation
$view->annotation = Request::processRequest("Annotations.save");

return $view->render();
```

The code invokes the Annotations API's `save()` method forwarding all query parameters so the controller method doesn't have to call [Common::getRequestVar](/api-reference/Piwik/Common#getrequestvar) several times.

### Reusing Controller methods

Sometimes you may want to use a controller method that belongs to another controller (to, say, embed a control provided by another controller). You can use the [`FrontController::dispatch()`](/api-reference/Piwik/FrontController#dispatch) method to accomplish this:

```php
// controller method in our plugin's controller
public function index()
{
    $view = new View("@MyPlugin/index.twig");
    $view->realtimeMap = FrontController::getInstance()->dispatch($module = "UserCountryMap", $method = "realtimeMap");
    return $view->render();
}
```

### Checking for correct HTTP methods

To maintain correct HTTP semantics, some controller methods should check whether the correct HTTP request method was used to invoke them. For example, non-read-only actions are normally executed via a **POST** rather than a **GET**. Controller methods that handle these tasks should check whether a POST was used:

```php
public function myAdminTask()
{
    // ... do some stuff ...

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        return;
    }

    // ... do some stuff ...
}
```

### Using Controller Methods as API Methods

In general, most functionality in Matomo controllers will render some HTML and return it. Sometimes, however you will have some logic that's
meant to return JSON, but is something you don't want exposed in an API method (as in, callable outside of a session). In this case, we create
controller methods that return JSON. Whenever possible, an API method should be created though instead of a controller method unless it requires for example access to the session or if there is a different reason why an API method wouldn't work. 

Unfortunately, they're not exactly built for it, so instead you have to do some extra work. In addition to sending the `Content-Type` header,
you must echo the `json_encode`d data:

```php
public function myControllerMethod()
{
    // ... check access ...
    // ... do something useful ...

    $result = ...; // get our response

    \Piwik\DataTable\Renderer\Json::sendHeaderJSON();
    return json_encode($result);
}
```

Note: if your method does not actually return anything, an error will result in the UI since Matomo's frontend won't know what to
do with an empty response. So if you're calling a controller method like this, you do need to return something (or make sure Matomo
doesn't treat the response like JSON).

## Controller Security

Like API methods, controller methods should make sure the current user is both valid and authorized to perform the requested action or view the requested data. This means calling the [access checking methods](/api-reference/Piwik/Piwik) that should also be called in API methods and checking that the supplied **token_auth** is valid (via [`Controller::checkTokenInUrl()`](/api-reference/Piwik/Plugin/Controller#checktokeninurl)).

Here's an example of a secure controller method:

```php
public function myAdminTask()
{
    Piwik::checkUserHasSuperUserAccess();
    $this->checkTokenInUrl();

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        return;
    }

    // ... do some stuff ...
}
```

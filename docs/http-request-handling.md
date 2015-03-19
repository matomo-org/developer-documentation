---
category: DevelopInDepth
---
# How Piwik Handles HTTP Requests

Every request that is sent to Piwik's reporting side (as opposed to Piwik's tracking side) is sent to the `index.php` file in Piwik's root directory. This file creates an instance of the [FrontController](/api-reference/Piwik/FrontController) and uses it to dispatch the current request.

The FrontController looks for the `module` and `action` query parameters. If `action` is missing, it takes the default value `"index"`. Piwik then invokes the matching controller method:

```
Piwik\Plugins\<module>\Controller::<action>
```

Examples:

- `module=MyPlugin&action=hello` will invoke:

    ```php
    Piwik\Plugins\MyPlugin\Controller::hello()
    ```

- `module=MyPlugin` will invoke:

    ```php
    Piwik\Plugins\MyPlugin\Controller::index()
    ```

Controller methods have one thing to do: **return a string response** (or anything that can be cast to a string). Such string could contain HTML, JSON, …

As a plugin developer you can do this in any way you'd like, Piwik won't stop you, but the convention used by the rest of Piwik is to create a Piwik [View](/api-reference/Piwik/View), query APIs to request any needed data and then render the view. For example:

```php
class Controller extends \Piwik\Plugin\Controller
{
    public function index()
    {
        $view = new View("@MyPlugin\index.twig");
        $view->data = \Piwik\Plugins\MyPlugin\API::getInstance()->getData();
        return $view->render();
    }
}
```

Read on to learn more about the individual components in this workflow.

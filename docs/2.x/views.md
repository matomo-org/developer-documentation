---
category: DevelopInDepth
---
# Views

Views are classes that implement `ViewInterface`. The main view class [Piwik\View](/api-reference/Piwik/View) will use a [Twig](https://twig.symfony.com) template that is specified upon construction to generate output. There is also another class called [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) that is used specifically to visualize analytics data.

Using a view is straightforward. First, it is configured. The meaning of this is different based on the View type. For [Piwik\View](/api-reference/Piwik/View) instances, it simply means setting properties. For example:

```php
$view = new View("@MyPlugin/myTemplate.twig");

// set properties
$view->property1 = 'property1';
$view->property2 = 'here is another property';
```

For [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable), [it's a bit more complicated](/guides/visualizing-report-data).

Once a view is configured, it is rendered via the [View::render](/api-reference/Piwik/View#render) method:

```php
return $view->render();
```

This is the same for all view types.

## Twig Templates

The preferred way to generate anything text-based (like HTML) using data is to define Twig templates and use a [View](/api-reference/Piwik/View). Plugin developers should not accomplish this task with new view types unless they need to output something that is not text-based (such as an image).

*If you don't know how to create Twig templates, read [Twig's documentation](https://twig.symfony.com/doc/).*

### Template storage and referencing

Templates are stored in the `templates/` subdirectory of a plugin's root directory. When you create a [View](/api-reference/Piwik/View) instance you must tell it what template it should use using a string with the following format: `"@PluginName/TemplateFileName"`. Piwik will look for a file named `TemplateFileName.twig` in the **PluginName** plugin's `templates/` subdirectory.

Template files in Piwik have a very specific naming convention. If the file contains the output for a specific controller method, the file should be named after the method. For example, `myControllerMethod.twig`. In all other cases, the file should be named after what it contains and be prefixed with an underscore. For example, `_myEmbeddedWidget.twig`.

### Twig functions and filters

The [View](/api-reference/Piwik/View) class adds several filters and functions before rendering a template. It will also define properties that the template can use. To learn exactly what's defined, read the [View class docs](/api-reference/Piwik/View).

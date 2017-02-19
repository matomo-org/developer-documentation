---
category: Develop
---
# Pages

A page can contain any corporate related content, key metrics, news, help pages, custom reports, contact details, information about your server, forms to manage any data and anything else.

## Creating a page

Creating a page means creating [a controller](/guides/controllers) and [a Twig template](/guides/views).

You can use the console for this:

```
$ ./console generate:controller
```

The command will ask you to enter the name of your plugin and will create two files:

- a **Controller** (`plugins/MyPlugin/Controller.php`)

    ```php
    class Controller extends \Piwik\Plugin\Controller
    {
        public function index()
        {
            return $this->renderTemplate('index', array(
                 'answerToLife' => 42
            ));
        }
    }
    ```

    The controller defines the view variable `answerToLife` and renders the Twig template.

- a **Twig template** (`plugins/MyPlugin/templates/index.twig`)

    ```twig
    {% extends 'dashboard.twig' %}

    {% block content %}
        <strong>Hello world!</strong>
        <br/>

        The answer to life is {{ answerToLife }}
    {% endblock %}
    ```

    Variables passed by controllers can be used in views, like for example here: `{{ answerToLife }}`.

    The template above is extending the dashboard template: the logo and the top menu will be included in your page.

Using a Twig template to generate your page is optional: you can also generate any content by returning a string in your controller action.

Now that your page is created, you can access it at the following URL: [/index.php?module=MyPlugin&action=index&…](http://localhost:8000/index.php?module=MyPlugin&action=index&idSite=1&period=day&date=yesterday). It should look like this:

![](https://piwik.org/wp-content/uploads/2014/09/action_example.png)

## Creating an admin page

If you would like to add the admin menu on the left you have to modify the following parts:

- extend `\Piwik\Plugin\ControllerAdmin` instead of `\Piwik\Plugin\Controller`
- extend the template `admin.twig` instead of `dashboard.twig`
- define a headline using a `<h2>` element

```twig
{% extends 'admin.twig' %}

{% block content %}
    <h2>Hello world!</h2>
    <br/>

    The answer to life is {{ answerToLife }}
{% endblock %}
```

The result should look like this:

![](https://piwik.org/wp-content/uploads/2014/09/action_admin_example.png)

Note: if you just want **to make your plugin configurable** you should [use the Plugin Settings instead](/guides/plugin-settings).

## What's next?

So far you have created a page but you can still not access it. To add it to one of the menus, keep on reading the [Menus guide](/guides/menus.md).

You can also read the following guides:

- [Controllers](/guides/controllers.md)
- [Views](/guides/views.md)
- [Security in Piwik](/guides/security-in-piwik.md)

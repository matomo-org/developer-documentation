---
category: DevelopInDepth
---
# JavaScript: Extended

## Important JavaScript classes

### Piwik_Popover


#### Creating popovers

To create a popover, use the `createPopupAndLoadUrl()` method:

```javascript
(function (require) {

    var Piwik_Popover = require('Piwik_Popover');
    Piwik_Popover.createPopupAndLoadUrl("?module=MyPlugin&action=getMyPopover", "The Popover Title", 'my-custom-dialog-css-class');

})(require);
```

Creating a popover will close any popover that is currently displayed. Only one popover can be displayed at a time.

#### Closing popovers

To close the currently displayed popover, call the **close** method:

```javascript
(function (require) {

    var Piwik_Popover = require('Piwik_Popover');
    Piwik_Popover.close();

})(require);
```

Note that the **Piwik_Popover** object is stored directly in the `window` object and contains popover creation and management functions. Popovers created directly through this object are not persistent. To create persistent popovers, see the next section.

#### Loading Persistent Popovers

To load a popover that will be displayed even if the page is reloaded, you'll need to call two functions. Piwik makes a popover _persistent_ by adding a **popover** query parameter. The parameter value will contain a popover ID and another string (separated by a `':'`). Piwik will see this ID and execute a function that displays the popover.

The first method you need to call is named `addPopoverHandler()`. It associates a function with the popover ID. The function will be passed the rest of the popover query parameter. For example:

```javascript
(function (require) {

    var broadcast = require('broadcast');
    broadcast.addPopoverHandler('myPopoverType', function (arg) {
        Piwik_Popover.createPopupAndLoadUrl("?module=MyPlugin&action=getPopup&arg=" + arg, _pk_translate('MyPlugin_MyPopoverTitle'));
    });

})(require);
```

Then, when you want to launch a popover call the `propagateNewPopoverParameter()` method:

```javascript
(function (require, $) {

    var broadcast = require('broadcast');

    $('#myLink').click(function (e) {
        e.preventDefault();

        broadcast.propagateNewPopoverParameter('myPopoverType', 'myarg');

        return false;
    });

})(require, jQuery);
```


To learn more about the object, see the documentation in the source code (located in [`plugins/CoreHome/javascripts/popover.js`](https://github.com/matomo-org/matomo/blob/master/plugins/CoreHome/javascripts/popover.js)).

### ColorManager

If your control uses color values to, for example, draw in canvas elements, and you want to make those colors [theme-able](/guides/theming), you must use the **ColorManager** singleton.

JavaScript colors are stored in CSS like this:

```css
.my-color-namespace[data-name=my-color-name] {
    color: red;
}
```

In your JavaScript, you can use **ColorManager** to access these colors:

```javascript
(function (require) {

    var ColorManager = require('piwik').ColorManager;

    // get one color
    var myColorToUse = ColorManager.getColor('my-color-namespace', 'my-color-name');

    // get multiple colors all at once
    var myColorsToUse = ColorManager.getColor('my-color-namespace', ['my-first-color', 'my-second-color']);

})(require);
```

To learn more about the singleton, read the source code documentation (located in [`plugins/CoreHome/javascripts/color_manager.js`](https://github.com/matomo-org/matomo/blob/master/plugins/CoreHome/javascripts/color_manager.js)).

_Learn more about theming in our [Theming](/guides/theming) guide._

<a name="classes-DataTable"></a>
### DataTable

The **DataTable** class is the base of all JavaScript classes that manage [report visualizations](/guides/visualizing-report-data#about-visualizations). If you are creating your own report visualization, you may have to extend it.

To learn more about extending the class, see our [Visualizing Report Data](https://github.com/matomo-org/developer-documentation/blob/master/docs/visualizing-report-data.md) guide.

### Server Rendered HTML with AJAX

Most of the widgets loading by AJAX are generated on server side which means the AJAX response is HTML, sometimes it contains javascript code as well. This is a very powerful yet simple pattern to load dynamic contents.

There is an angularjs component that makes this possible easily, not only with widgets, but everytime, when we'd like to load the page before a time consuming process finished or we need a user interaction. The component shows a loading animation until it finishes the request.

#### How does it work?

1. create a method in your plugin's controller file
1. return a rendered template (the template can contain javascript in script tag)
1. include the `piwik-widget-loader` component in the main twig file that loads when the user opens the page

```php
// MyPlugin/Controller.php
public function myWidget() {
    return $this->renderTemplateAs('_mywidget.twig', [], 'basic');
}
```

```twig
// MyPlugin/templages/_mywidget.twig
<p>Hello world!</p>
```

```twig
// add this to your main template file
// the loading message is optional
<div piwik-widget-loader='{"module":"MyPlugin","action":"myWidget"}' loading-message="Widget loading..."></div>
```

For the angularjs component, see [widgetloader.directive.js](https://github.com/matomo-org/matomo/blob/master/plugins/CoreHome/angularjs/widget-loader/widgetloader.directive.js).

## Learn more

* To learn **about creating new report visualizations** read our [Visualizing Report Data](/guides/visualizing-report-data) guide.
* To learn **more about the asset merging system** read this [blog post](https://matomo.org/blog/2010/07/making-piwik-ui-faster/) by the system's author.
* To learn **more about theming** read our [Theming](/guides/theming) guide.

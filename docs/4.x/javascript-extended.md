---
category: DevelopInDepth
---
# JavaScript: Extended

## Important JavaScript classes

### UIControl

`UIControl` is meant to be the base type for all JavaScript widget classes. These classes manage and attach behavior to an element. Examples of classes that extend from UIControl include **[DataTable](#classes-DataTable)** (the base of all [report visualization](/guides/visualizing-report-data) JavaScript classes) and **VisitorProfileControl** (used to manage the [visitor profile](https://matomo.org/docs/user-profile/)).

`UIControl` allows descendants to clean up resources, provides a mechanism for server side code to send information to the UI and provides a method for listening to dashboard widget resize events.

#### Extending UIControl

The actual extending is straightforward:

```javascript
(function (require, $) {

    var UIControl = require('piwik/UI').UIControl;

    var MyControl = function (element) {
        UIControl.call(this, element);

        // ... setup control ...
    };

    $.extend(MyControl.prototype, UIControl.prototype, {
        // ...
    });

    var exports = require('MyPlugin');
    exports.MyControl = MyControl;
})(require, $);
```

`UIControl`'s constructor takes one argument: the HTML element that is the root element of the widget.

#### Creating controls that extend UIControl

Control instances should be created through the `initElements()` static method:

```javascript
MyControl.initMyControlElements = function () {
    UIControl.initElements(this, '.my-control');
};
```

This will find all elements with the **my-control** class, and if they do not already have a **MyControl** instance associated with them, it will create an instance with that element. `MyControl.initMyControlElements` should be called when your control's HTML is added to the DOM. This is often done in Piwik by including a `<script>` element in HTML returned by AJAX, for example:

```html
<div class="my-control">
</div>
<script type="text/javascript">require('MyPlugin').MyControl.initMyControlElements();</script>
```

#### Cleaning up after your control

When the selected page changes or when a popover is closed, Piwik will call the `UIControl.cleanupUnusedControls()` static method. This method will automatically collect all control instances that are attached to elements that are not part of the DOM and call the controls' `_destroy()` method.

When creating your own control, if you need to do some extra cleanup, you can override this method:

```javascript
$.extend(MyControl.prototype, UIControl.prototype, {

    _destroy: function () {
        UIControl.prototype._destroy.call(this);

        this.myThirdPartyLibWidget.destroy();
    }

});
```

#### Sending information from PHP to UIControl

If you need to pass information from PHP code to `UIControl` instance, you can set the `data-props` HTML attribute of the root element of your control to a JSON string. This data will automatically be loaded and stored in the **props** attribute of a `UIControl` instance.

So if you create HTML like the following:

```html
<div class="my-control" data-props="{&quot;title&quot;: &quot;My Control&quot;}">
</div>
<script type="text/javascript">require('MyPlugin').MyControl.initMyControlElements();</script>
```

then `this.props.title` will be set to `'My Control'`:

```javascript
var MyControl = function (element) {
    UIControl.call(this, element);

    alert(this.props.title); // will say 'My Control'
};
```

#### Listening to dashboard widget resize

To redraw or resize elements in your control when a widget is resized, call the `onWidgetResize()` method when setting up your control:

```javascript
var MyControl = function (element) {
    UIControl.call(this, element);

    var self = this;
    this.onWidgetResize(function () {
        self._resizeControl(); // private method not shown
    });
};
```

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
1. return a rendered template (the template can contains javascript in script tag)
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

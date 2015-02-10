---
category: Develop
---
# JavaScript and CSS

## About this guide

This guide describes how plugins should create JavaScript and describes all of the JavaScript classes provided by Piwik for use by plugins.

Read this guide if

* you'd like to know **how to write JavaScript for your Piwik plugin**
* you'd like to know **how to work with Piwik Core's JavaScript code**
* you'd like to know **how to add popovers to Piwik's UI**
* you'd like to know **what JavaScript libraries are used by Piwik**

This guide assumes that you:

* know about JavaScript and [jQuery](http://jquery.com/),
* know about CSS and [LESS](http://lesscss.org/),
* and have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide).

## JavaScript libraries

Piwik uses the following JavaScript libraries:

* [jQuery](http://jquery.com/)
* [jqPlot](http://www.jqplot.com/)

### New Library Policy

We do not like to include new dependencies in Piwik, so if possible do not include new third party libraries in your contribution or plugin.

This suggestion is especially important for plugins. Imagine what would happen if almost every plugin decides they need to use a library that Piwik Core does not use. Users might install a couple plugins in the marketplace and end up loading several different new libraries on page load, slowing down the UI.

**Include new JS libraries only if they are vital to your plugin.**

## Assets inclusion

JavaScript, CSS and LESS assets only exist in plugins. Piwik's Core code (everything in the `core/` subdirectory) does not contain or define any asset files.

Plugins tell Piwik about their asset files through the [`AssetManager.getStylesheetFiles`](/api-reference/events#assetmanagergetstylesheetfiles) and [`AssetManager.getJavaScriptFiles`](/api-reference/events#assetmanagergetjavascriptfiles) events. Event handlers should append paths to assets to the given array:

```php
// event handler for AssetManager.getStylesheetFiles
public function getStylesheetFiles(&$files)
{
    $files[] = "plugins/MyPlugin/stylesheets/myStylesheet.less";
    $files[] = "plugins/MyPlugin/stylesheets/myCssStylesheet.css";
}

// event handler for AssetManager.getJavaScriptFiles
public function getJavaScriptFiles(&$files)
{
    $files[] = "plugins/MyPlugin/javascripts/myJavaScript.js";
}
```

### Asset merging and compiling

In production environments, Piwik will concatenate all JavaScript files into one and minify it. LESS files will also be compiled into CSS and merged into one CSS file. Piwik does this so the UI loads quickly. Learn more about asset merging in [this blog post](http://piwik.org/blog/2010/07/making-piwik-ui-faster/).

JavaScript is merged only when enabling or disabling a plugin or theme. LESS compilation and merging is done whenever a LESS file changes (does not include LESS files that are included by others).

If the `disable_merged_assets` INI config option (in the `[Development]` section) is set to `1`, assets will not be merged. It can be useful to disable merged assets while developing a contribution or plugin since changes to JavaScript will then appear immediately.

## JavaScript modularization

Piwik attempts to modularize all JavaScript code through the use of Piwik's `require` function. This function (inspired by [node.js' require function](http://nodejs.org/api/modules.html)) will create nested objects in the `window` object based on a namespace string (for example, `'MyPlugin/Widgets/FancySchmancyThing'`).

Here's how it should be used:

```javascript
(function (require, $) {

    // get a class that we're going to extend
    var classToExtend = require('AnotherPlugin/Widgets').TheirWidget;

    // extend it
    function MySpecialWidget() {
        classToExtend.call(this);
    }

    $.extend(MySpecialWidget.prototype, classToExtend.prototype, {
        // ...
    });

    // export the class so it is available to other JavaScript files
    var exports = require('MyPlugin/NamespaceForThisFile');
    exports.MySpecialWidget = MySpecialWidget;

})(require, jQuery);
```

**All new JavaScript should modularize their code with the `require` function. The `window` object should be accessed sparingly, if ever.**

## Special HTML Elements

The following is a list of special elements that you should be aware of as you develop your plugin or contribution:

- `#root`: The root element of everything that is displayed and visible to the user.

- `#content`: The root element that contains everything displayed under the main reporting menu and the row of 'selector' controls (ie, the period selector, the segment selector, etc.).

- `.top_controls`: The element that contains the 'selector' controls. Only one of these elements.

- `.widgetContent`: The root element of each widget. Events are posted to this specific element.

## Important JavaScript classes

Piwik Core defines many classes that should be reused by new plugins and contributions. These classes can be used to, among other things, change the page the UI shows, load a popover and get themed color values from CSS.

### Broadcast

The `broadcast` object is stored directly in the `window` object and should be used to parse the current URL, load a page in the area below the menu and load persistent popovers.

_Note: Though the object is stored in `window` and not a JS namespace, it can still be accessed using `require` by calling `require('broadcast')`._

#### Parsing the URL

`broadcast` contains several methods for parsing the Piwik URL. Piwik's main UI stores secondary set of query parameters in a URL's hash value. This is the URL that is loaded below the menu. `broadcast`'s URL parsing functions will look for query parameter values in the hash as well as the main query string, so it is important to use them instead of directly accessing `window.location.href`.

`broadcast` provides the following functions:

- `isHashExists()`: Returns the hash of the URL if it exists, `false` if otherwise.
- `getHashFromUrl()`: Returns the hash of the URL. Can be an empty string.
- `getSearchFromUrl()`: Returns the query string.
- `extractKeyValuePairsFromQueryString()`: Converts a query string to an object mapping query parameter names with query parameter values.
- `getValuesFromUrl()`: Returns an object mapping query parameter names with query parameter values for the current URL.
- `getValueFromUrl()`: Returns one query parameter value for the current URL by name.
- `getValueFromHash()`: Returns one query parameter value in the hash of the current URL by name.
- `getHash()`: Returns the hash of the URL.

To learn more about an individual function, see the method documentation in the `plugins/CoreHome/javascripts/broadcast.js` file.

#### Loading new Piwik pages

To load a new page below the main Piwik menu, use the `propagateNewPage()` function with a URL to the controller method whose output should be displayed:

```javascript
(function (require) {

    var broadcast = require('broadcast');
    broadcast.propagateNewPage('index.php?module=MyPlugin&action=mySpecialPage', true);

})(require);
```

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

        return false;getPageUrls
    });

})(require, jQuery);
```

### ajaxHelper

The `ajaxHelper` class should be used whenever you need to create an AJAX request. **Plugins should not use `$.ajax` directly.** `ajaxHelper` does some extra things that make it harder to write insecure code. It also keeps track of the current ongoing AJAX requests which is vital to the [UI tests](/guides/tests-ui).

To use the `ajaxHelper`, create an instance, configure it, and then call the `send()` method. To learn more, read the documentation in the source code (located in [`plugins/Morpheus/javascripts/ajaxHelper.js`](https://github.com/piwik/piwik/blob/master/plugins/Morpheus/javascripts/ajaxHelper.js)).

For example:

```javascript
(function (require, $) {

    var ajaxHelper = require('ajaxHelper');

    var ajax = new ajaxHelper();
    ajax.setUrl('index.php?module=Actions&action=getPageUrls&idSite=1&date=today&period=day');
    ajax.setCallback(function (response) {
        $('#myReportContainer').html(response);
    });
    ajax.setFormat('html'); // the expected response format
    ajax.setLoadingElement('#myReportContainerLoading');
    ajax.send();

})(require, jQuery);
```

### UIControl

`UIControl` is meant to be the base type of all JavaScript widget classes. These classes manage and attach behavior to an element. Examples of classes that extend from UIControl include **[DataTable](#classes-DataTable)** (the base of all [report visualization](/guides/visualizing-report-data) JavaScript classes) and **VisitorProfileControl** (used to manage the [visitor profile](http://piwik.org/docs/user-profile/)).

`UIControl` allows descendants to clean up resources, provides a mechanism for server side code to send information to the UI and provides a method of listening to dashboard widget resize events.

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

`UIControl`'s constructor takes one argument, the HTML element that is the root element of the widget.

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

The **Piwik_Popover** object is stored directly in the `window` object and contains popover creation and management functions. Popovers created directly through this object are not persistent. To create persistent popovers, use the `broadcast` global object.

To learn more about the object, see the documentation in the source code (located in [`plugins/CoreHome/javascripts/popover.js`](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/javascripts/popover.js)).

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

To learn more about the singleton, read the source code documentation (located in [`plugins/CoreHome/javascripts/color_manager.js`](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/javascripts/color_manager.js)).

_Learn more about theming in our [Theming](/guides/theming) guide._

<a name="classes-DataTable"></a>
### DataTable

The **DataTable** class is the base of all JavaScript classes that manage [report visualizations](/guides/visualizing-report-data#about-visualizations). If your creating your own report visualization, you may have to extend it.

To learn more about extending the class, see our [Visualizing Report Data](https://github.com/piwik/developer-documentation/blob/master/docs/visualizing-report-data.md) guide.

## Global variables defined by Piwik

Piwik defines several global variables (held in `window.piwik`) regarding the current request. Here is what they are and how you should use them:

* `piwik.token_auth`: The **token_auth** of the current user. Should be used in AJAX requests, but should never appear in the URL.
* `piwik.piwik_url`: The URL to this Piwik instance.
* `piwik.userLogin`: The current user's login handle (if there is a current user).
* `piwik.idSite`: The ID of the currently selected website.
* `piwik.siteName`: The name of the currently selected website.
* `piwik.siteMainUrl`: The URL of the currently selected website.
* `piwik.language`: The currently selected language's code (for example, `en`).
* `piwik.config.action_url_category_delimiter`: The value of the `[General] action_url_category_delimiter` INI config option.

## Coding conventions

When writing JavaScript for your contribution or plugin, be sure to follow the following coding conventions.

### Self-executing anonymous function wrapper

Every JavaScript file you create should surround its code in a self-executing anonymous function:

```javascript
/**
 * My JS file.
 */
(function (require, $) {

    // ... your code goes here ...

})(require, jQuery);
```

If you need to use global objects, they should be passed in to the anonymous function as is done above. Anything that should be made available to other files should be exposed via [require](#javascript-modularization).

### Private methods

Prefix all private and protected methods in classes with a `_`:

```javascript
MyClass.prototype = {

    myPublicFunction: function () {
        // ...
    },

    _myPrivateFunction: function () {
        // ..
    }
};
```

## Learn more

* To learn **about creating new report visualizations** read our [Visualizing Report Data](/guides/visualizing-report-data) guide.
* To learn **more about the asset merging system** read this [blog post](http://piwik.org/blog/2010/07/making-piwik-ui-faster/) by the system's author.
* To learn **more about theming** read our [Theming](/guides/theming) guide.

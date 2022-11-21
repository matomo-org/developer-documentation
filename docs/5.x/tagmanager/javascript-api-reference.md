---
category: API Reference
---
# Tag Manager JavaScript API

This is the API Reference for developers who want to create a custom [tag](/guides/tagmanager/custom-tag), [trigger](/guides/tagmanager/custom-trigger), or [variable](/guides/tagmanager/custom-variable). Please note that sometimes we may mention the word `template` which refers to either a tag, a trigger, or a variable.

In case you are new to the tag manager, you may also read the **[Tag Manager user guide](/guides/tagmanager/settingup)** to get familiar with the tag manager itself and the [Tag Manager developer guides](/guides/tagmanager/settingup) to get familiar on how to extend the tag manager.

## `TemplateParameters`

When you develop a custom tag, trigger, or variable, the first argument will always be `parameters` which is an instance of this `TemplateParameters` class. This object allows you to access any parameter you have defined in your template, as well as some other properties.

* `parameters.get(parameterName, optionalDefaultValue)` - Retrieve the value of a parameter which you defined in your tag, trigger, or variable. You may optionally define a default value which will be returned in case no value was defined.
* `parameters.window` - Lets you access the `window` object. It is recommended to not access the `window` variable directly for easier [testing](/guides/tagmanager/testing) but instead use `parameters.window`.
* `parameters.document` - Lets you access the `document` object. It is recommended to not access the `document` variable directly for easier [testing](/guides/tagmanager/testing) but instead use `parameters.document`.
* `parameters.container` - Lets you access an instance of the container this template belongs to. This is an instance of [TagManager.Container](#tagmanagercontainer). You can use it to access for example the ID of the container, the current version number, and more.

## `TagManager`

When you develop a custom template, the second argument will always be `TagManager` which is the same as the global `window.MatomoTagManager` variable. This object comes with a variety of utilities that will enable you to develop templates faster without having to worry about making them work cross browser.

* `TagManager.containers[]` - An array which holds a list of all available container instances.
* `TagManager.enableDebugMode()` - Enables the debug mode which will log messages to the developer console.
* `TagManager.THROW_ERRORS` - A boolean which defines whether errors should be thrown or only logged.
* `TagManager.throwError(message)` - A function which will log an error to the console and throw an error if `TagManager.THROW_ERRORS` is enabled. Throwing an error may stop the execution of the container so it should be only thrown when really needed. Most of the times, you may instead want to call `Debug.error()` which only logs an error to the console.
* `TagManager.addContainer(container)` - Adds an entire new container and runs it. This is usually only needed by the core platform itself.

### `TagManager.dataLayer`

* `TagManager.dataLayer.get(name)` - Retrieve a value from the data layer.
* `TagManager.dataLayer.push(valueObject)` - Push one or multiple values to the data layer.
* `TagManager.dataLayer.on(callback)` - Subscribe to updates whenever a data layer value is set. Returns a `callbackIndex` which can be used to unsubscribe from data layer updates.
* `TagManager.dataLayer.off(callbackIndex)` - Unsubscribes a previously subscribed callback method.
* `TagManager.dataLayer.reset()` - For tests only, completely reset the data layer.

### `TagManager.url`

* `TagManager.url.parseUrl(urlToParse, urlPart)` - Parses the given URL and returns a specific part of it. `urlPart` can be any property of the `window.location` object such as `port`, `href`, `origin`, `pathname`, or `search`. You may also use it for example to convert a relative URL to an absolute URL by calling for example `parseUrl('relativeurl/foo', 'href')`.
* `TagManager.url.decodeSafe(text)` - Decodes a URI encoded value safely.
* `TagManager.url.getQueryParameter(parameter, locationSearch)` - Get the value of a URL parameter. If `locationSearch` is not defined, the current location will be used (`window.location.search`). You may optionally specify a custom search location, for example `getQueryParameter('module', 'module=foo&action=bar')`. `locationSearch` may optionally start with a `?`, a `&`, or neither of them.

### `TagManager.utils`

* `TagManager.utils.trim(text)` - Remove all whitespace from the beginning and the end of a string.
* `TagManager.utils.isDefined(property)` - Test if the property is defined (not undefined).
* `TagManager.utils.isFunction(property)` - Test if the property is a function.
* `TagManager.utils.isObject(property)` - Test if the property is an object (note an array is an object as well).
* `TagManager.utils.isString(property)` - Test if the property is of type string.
* `TagManager.utils.isArray(property)` - Test if the given property is an array.
* `TagManager.utils.hasProperty(object, key)` - Test if the given object has the key as its own property.
* `TagManager.utils.indexOfArray(anArray, element)` - Tests if an array contains the element and if so, returns the index of the position of the element within the array or `-1` if the element is not within the array.
* `TagManager.utils.setMethodWrapIfNeeded(contextObject, methodNameToReplace, callback)` - Executes the callback method when the method on the contextObject is executed. If a website was already set such a method, the original method will be wrapped and the callback as well as the original method will be executed when the method is called. Note: A website may still overwrite this method after it has been set.

### `TagManager.debug`

* `TagManager.debug.log(msg1, [msg2, msg3, ...])` - Logs a message to the console using the `log` level if debugging is enabled.
* `TagManager.debug.error(msg1, [msg2, msg3, ...])` - Logs a message to the console using the `error` level if debugging is
enabled. It will not throw an error. An error will be only thrown if `TagManager.throwError()` is called.

### `TagManager.dom`

* `TagManager.dom.getScrollLeft()` - Get the number of pixels the window is scrolled horizontally.
* `TagManager.dom.getScrollTop()` - Get the number of pixels the window is scrolled vertically.
* `TagManager.dom.getDocumentHeight()` - Get the full height of the entire webpage in pixels.
* `TagManager.dom.getDocumentWidth()` - Get the full width of the entire webpage in pixels.
* `TagManager.dom.addEventListener(element, eventType, eventHandler, useCapture = false)` - Attach an event listener for the given event type to the given element and executes the event handler once the event occurs.
* `TagManager.dom.getElementClassNames(element)` - Get a string containing all class names this element has defined. Please note that multiple whitespaces will be removed and each class name will be separated by one whitespace.
* `TagManager.dom.getElementText(element)` - Get a string containing the text of the element. Returns `null` if the element doesn't exist. All whitespace character groups are replaced with a single space. Since Matomo 4.12, this method will mask the value if the `data-matomo-mask` attribute is set on the element or its parent element. 
* `TagManager.dom.getElementAttribute(element, attributeName)` - Get the attribute of an element. Returns `null` if the attribute does not exist, an empty string if the attribute exists but has no value, or the value of the attribute. Since Matomo 4.12, this method will mask the value of certain attributes if the `data-matomo-mask` attribute is set on the element or its parent element.
* `TagManager.dom.shouldElementBeMasked(element)` - Returns a boolean value indicating whether or not the specified element should be masked. If the element doesn't exist, `false` will be returned (Available since Matomo 4.12).
* `TagManager.dom.elementHasMaskedChild(element)` - Returns a boolean value indicating whether or not the specified element has child elements that need to be masked due to the `data-matomo-mask` attribute. If the element doesn't exist, `false` will be returned (Available since Matomo 4.12).
* `TagManager.dom.getElementTextWithMaskedChildren(element)` - Returns the text of the specified element taking into account whether its child elements should be masked due to the `data-matomo-mask` attribute or children of masked elements can be shown if they have the `data-matomo-unmask`attribute set. `TagManager.dom.getElementText(element)` should be called instead of this unless you know the element has child elements, especially since that method uses this one when necessary (Available since Matomo 4.12).
* `TagManager.dom.byId(id)` - Returns an element whose id attribute matches the specified string. You may or may not prefix the ID with a hash.
* `TagManager.dom.byClassName(classNames)` - Returns an array of all elements which have all of the given class name(s) (if `document.getElementsByClassName` is supported by the current browser, if not returns an empty array). For performance reasons, you should always use the method `TagManager.dom.bySelector()` if possible.
* `TagManager.dom.byTagName(tagNames)` - Returns an array of elements with the given tag name(s).
* `TagManager.dom.bySelector(selectors)` - Returns an array of the elements that match the specified CSS selector (if `document.querySelectorAll()` is supported by the browser, if not returns an empty array).
* `TagManager.dom.onLoad(callback)` - Triggers the callback function as soon as the page is fully loaded, including all stylesheets, images, JavaScript, etc.
* `TagManager.dom.onReady(callback)` - Triggers the callback function as soon as the DOM is ready. This means the HTML is loaded but doesn't mean that any JavaScript, images or stylesheets have been loaded or executed.
* `TagManager.dom.loadScriptUrl(url, options)` - Loads a JavaScript remote file by inserting a script element into the DOM. Possible options with its defaults are `{async:true,defer:true,type:'text/javascript',id:null,charset:null,onload:null,onerror:null}`.
* `TagManager.dom.onClick(callback, element = document.body)` - Attaches a click event listener for left,middle and right click events on the element specified(default is on body). The callback has 2 arguments `event` and `clickButton` eg: `callback(event, clickButton='left/right/middle')`.

### `TagManager.window`

* `TagManager.window.getScreenHeight()` - Get the full height of the screen in pixel, not the height of the browser window.
* `TagManager.window.getScreenWidth()` - Get the full width of the screen in pixel, not the width of the browser window.
* `TagManager.window.getViewportHeight()` - Get the viewport height of the browser window in pixel. This is basically the size of the browser window minus any occupied space like the address toolbar etc.
* `TagManager.window.getViewportWidth()` - Get the viewport width of the browser window in pixel. This is basically the size of the browser window minus any occupied space like the address toolbar etc.
* `TagManager.window.getPerformanceTiming(property)` - Get the value of a property of the [NavigationTiming API](https://www.w3.org/TR/navigation-timing/#sec-navigation-timing-interface) if the browser supports it. If the browser does not support the API, `0` will be returned.
* `TagManager.window.onScroll(callback)` - Attach a callback function which will be executed whenever the user scrolls the window (not when the user scrolls within an element). Because the browsers' `scroll` event is executed on every pixel that a user is scrolling, we have implemented a logic that calls your callback only with a delay to not slow down a users' browsing experience. You should avoid listening to the windows' `scroll` event manually and instead use this feature. Returns an ID which allows you to unsubscribe from this event again.
* `TagManager.window.offScroll(scrollIndex)` - Unsubscribes a previously subscribed scroll callback method.

### `TagManager.storage.local`

Lets you access the [localStorage](https://html.spec.whatwg.org/multipage/webstorage.html#dom-localstorage) if the browser supports it. It is recommended to use this API instead of accessing the `localStorage` directly to avoid possible problems if the API is not supported. This API also makes sure to prefix all items within the storage to not overwrite any items on the website and it comes with additional features such as an optional expiry time (TTL).

Please note that the localStorage caches items indefinitely unless an expiry time is set. Also, the storage is limited in size so ideally you should only store what is needed for as long as it is needed.

* `TagManager.storage.local.get(group, key)` - Get the value of the key which was stored within the given group. `group` should be ideally the name of your plugin for example.
* `TagManager.storage.local.set(group, key, value, optionalTtlInSeconds)` - Set a key for the given value. `group` should be ideally the name of your plugin for example. You may optionally specify a TTL in seconds to automatically expire the set key after a certain time.
* `TagManager.storage.local.clearAll()` - For tests only, removes all values that were set by the tag manager.

### `TagManager.storage.session`

Lets you access the [sessionStorage](https://html.spec.whatwg.org/multipage/webstorage.html#dom-sessionstorage) if the browser supports it. It is recommended to use this API instead of accessing the `sessionStorage` directly to avoid possible problems if the API is not supported. This API also makes sure to prefix all items within the storage to not overwrite any items on the website and it comes with additional features such as an optional expiry time (TTL).

Please note that the API stores the data only for one session and the data is deleted as soon as the browser tab is closed. This also means that you cannot assume that a value is set if a user is navigating through a webpage in two different tabs at the same time.

* `TagManager.storage.session.get(group, key)` - Get the value of the key which was stored within the given group. `group` should be ideally the name of your plugin for example.
* `TagManager.storage.session.set(group, key, value, optionalTtlInSeconds)` - Set a key for the given value. `group` should be ideally the name of your plugin for example. You may optionally specify a TTL in seconds to automatically expire the set key after a certain time.
* `TagManager.storage.session.clearAll()` - For tests only, removes all values that were set by the tag manager.

### `TagManager.Container`

This is a class which represents a container. You can access an instance of this class through the `TemplateParameters (parameters.container)` within your tag, trigger, or variable or through `TagManager.containers` which holds an instance of all running containers.

* `id` - The id of this container, for example `6OMh6taM`.
* `versionName` - The name of the current version that is deployed.
* `revision` - An integer representing the current revision. This revision is incremented by 1 every time a new version is released for this container.
* `environment` - The name of the current environment
* `dataLayer` - This is an instance of a `dataLayer`. The container specific data layer has usually the same content as `TagManager.dataLayer`. However, if multiple containers are loaded within one page, and you want to write the data only to one specific container instead of all of them, you may directly push a value to this container. For example by calling `parameters.container.dataLayer.push({...})`






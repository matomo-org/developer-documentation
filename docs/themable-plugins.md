---
category: DevelopInDepth
---
# Writing themable plugins

Plugins that define their own UI widgets or new [report visualizations](/guides/visualizing-report-data) are, for the most part, already themable. As long as they rely entirely on CSS for the look and feel, they can be easily themed.

If these new widgets or visualizations use colors in JavaScript or PHP, more work must be done to make them themable.

## Using CSS colors in JavaScript

To use colors defined in CSS within JavaScript, the [ColorManager](/guides/working-with-piwiks-ui#colormanager) class must be used. Using it is straightforward. After you define some named colors in CSS like this:

```css
.my-color-namespace[data-name=my-color-name] {
    color: red;
}

.my-color-namespace[data-name=my-second-color] {
    color: blue;
}
```

You access them through [ColorManager](/guides/working-with-piwiks-ui#colormanager) like this:

```javascript
var ColorManager = require('piwik').ColorManager;

// get one color
var myColorToUse = ColorManager.getColor('my-color-namespace', 'my-color-name');

// get multiple colors all at once
var myColorsToUse = ColorManager.getColor('my-color-namespace', ['my-first-color', 'my-second-color']);
```

## Using CSS colors in PHP

Using CSS colors in PHP is more complicated, in fact, so much so that **using color values in PHP is discouraged**. The only way to use them is to access them in JavaScript, and then pass them to PHP via query parameters:

```javascript
// get the colors
var ColorManager = require('piwik').ColorManager;
var myColorsToUse = ColorManager.getColor('my-color-namespace', ['my-first-color', 'my-second-color']);

// set the source of an <img> to use those colors
var jsonColors = JSON.stringify(myColorsToUse);
$('img#myImage').attr('src', '?module=MyPlugin&action=generateImage&colors=' + encodeURIComponent(jsonColors))
```

Then use those colors in PHP:

```php
// controller method in MyPlugin
public function generateImage()
{
    $colors = Common::getRequestVar('colors', null, $dataType = 'json');

    $myFirstColor = $colors['my-first-color'];
    $mySecondColor = $colors['my-second-color'];

    // ... generate the image ...
}
```

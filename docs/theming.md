# Theming

<!-- Meta (to be deleted)
Purpose: describe how themes can change look and feel, how to create a theme, and how colors in JavaScript/server-side are themed.

Audience: 

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

In Piwik, **themes** are special types of plugins that change the look and feel of Piwik's UI. They use CSS and LESS to override the default styles defined by other Piwik plugins. This guide will explain how to create a new theme.

**Read this guide if**

* you'd like to know **how to create your own themes for Piwik**

**Guide assumptions**

This guide assumes that you:

* can code in PHP and JavaScript,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide).

## Creating a theme

To create an empty theme, run the following command from Piwik's root directory:

    ./console generate:theme

After you enter the appropriate information, a theme will be created for you in the **plugins** directory.

### Adding styles

Every theme has one main file that contains all of your theme's styling overrides. The location of this file is determined by the **stylesheet** property in your theme's **plugin.json** file. The property's value is a path relative to the plugin's root directory:

    {
        "name": "MyTheme",
        "description": "A new theme.",
        "theme": true,
        "stylesheet": "stylesheets/theme.less"
    }

The generated theme will already have a file for your new styles, so you don't need to set this property. The file is called **theme.less** and is located in the **stylesheets** directory of your theme.

You can put your entire theme into this one file if you want, but this will not result in easy to read and easy to maintain code. Instead, you should group your theme's styles based on the part of Piwik they modify and place them in separate LESS files. In **theme.less** you can [@import](/features/#import-directives-feature) them.

### Adding JavaScript files

Themes can also add new JavaScript files. These files can be used to style things that can't be styled through CSS or LESS.

To add JavaScript files, add them as an array to to the **javascript** property in your theme's **plugin.json** file:

    {
        "name": "MyTheme",
        "description": "A new theme.",
        "theme": true,
        "stylesheet": "stylesheets/theme.less",
        "javascript": ["javascripts/myJavaScriptFile.js", "javascripts/myOtherJavaScriptFile.js"]
    }

### Simple theming


#### Colors and fonts

Colors that are used in CSS are simple to override. Usually it is enough to just change the value of less variables. For example to change the background from white to black you can simply define the following variable:

    @theme-color-background-base: #000;
    
To change the link color to red you override the link variable:

    @theme-color-link: #f00;
    
To change the font you override the font variable:

    @theme-fontFamily-base: Verdana, sans-serif;
    
You get the point. It is a common convention among themes to put all color values in a **_colors.less** file. This is already done for you if you have created your theme using the above mentioned console command. Just uncomment the variables you want to change. For a list of available variables have a look at the [Example Theme plugin](https://github.com/piwik/piwik/tree/master/plugins/ExampleTheme/stylesheets).

Although we do not recommend to do so you can change the colors of a specific element directly, for example:

    #login {
        background-color: red;
    }

Please use this method only if needed as elements, id's or class names might change in the future and break your theme.

#### Icons 

Overriding icons is fairly easy. Just create a folder named `images` and place an icon having the same file name as the origin icon. For a complete list of icons you can override have a look at the [Zeitgeist theme](https://github.com/piwik/piwik/tree/master/plugins/Zeitgeist/images). It is not possible yet to override icons used in reports such as browser or search engine icons.

#### Logo and favicon

As Piwik users can upload their own logo and favicon using the admin interface a theme is not supposed to change any of those. 

### Advanced theming 

#### Theming colors used in JavaScript & PHP

Some colors are only used in JavaScript and in PHP. We've made it possible for those colors to be specified through CSS, but the process is a bit different than setting colors of normal HTML elements.

Each color used in JavaScript is given a name and grouped in a _color namespace_. You can set these colors like this:

    .color-namespace-name[data-name=color-name] {
        color: red;
    }

For example,

    .bar-graph-colors[data-name=grid-background] {
        color: @background-color-base;
    }

    .bar-graph-colors[data-name=grid-border] {
        color: @basic-grid-border-color;
    }

**Named colors**

Here is a list of all named colors in Piwik:

* _Namespace_: **sparkline-colors** &mdash; contains colors for sparkline images.

  * **backgroundColor**: The background color of sparkline images.
  * **lineColor**: The color of the line in the sparkline.
  * **minPointColor**: The color of the point that marks the minimum value observed in the data set.
  * **lastPointColor**: The color of the point that marks the last value of the data set.
  * **maxPointColo**: The color of the point that marks the maximum value observed in the data set.

* _Namespace_: **bar-graph-colors**: contains colors for bar graph [report visualizations](/guides/visualizing-report-data).

  * **grid-background**: The background color of the graph.
  <!-- TODO: This color has no effect since borderWidth is set to 0. Should it be removed? (same for other jqplot visualizations) * **grid-border**:  -->
  * **series1**: The color of the bars representing the first series of data.
  * **series2**: The color of the bars representing the second series of data.
  * **series3**: The color of the bars representing the third series of data.
  * **series4**: The color of the bars representing the fourth series of data.
  * **series5**: The color of the bars representing the fifth series of data.
  * **series6**: The color of the bars representing the sixth series of data.
  * **series7**: The color of the bars representing the seventh series of data.
  * **series8**: The color of the bars representing the eighth series of data.
  * **series9**: The color of the bars representing the ninth series of data.
  * **series10**: The color of the bars representing the tenth series of data.
  * **ticks**: The color of x-axis gridlines and x-axis ticks.
  * **single-metric-label**: The color of the series name label if only **one** series is displayed. If you don't care about whether there's one series displayed or not, set this color to the one you used in **series1**.

* _Namespace_: **pie-graph-colors**: contains colors for pie graph [report visualizations](/guides/visualizing-report-data).

  * **grid-background**: The background color of the graph.
  <!-- * **grid-border**:  -->
  * **series1**: The color of the pie graph segment representing the first value in the data displayed.
  * **series2**: The color of the pie graph segment representing the second value in the data displayed.
  * **series3**: The color of the pie graph segment representing the third value in the data displayed.
  * **series4**: The color of the pie graph segment representing the fourth value in the data displayed.
  * **series5**: The color of the pie graph segment representing the fifth value in the data displayed.
  * **series6**: The color of the pie graph segment representing the sixth value in the data displayed.
  * **series7**: The color of the pie graph segment representing the seventh value in the data displayed.
  * **series8**: The color of the pie graph segment representing the eigth value in the data displayed.
  * **series9**: The color of the pie graph segment representing the ninth value in the data displayed.
  * **series10**: The color of the pie graph segment representing the tenth value in the data displayed.
  * **single-metric-label**: The color of the series name label if only **one** series is displayed. If you don't care about whether there's one series displayed or not, set this color to the one you used in **series1**.

* _Namespace_: **evolution-graph-colors**: contains colors for evolution graph [report visualizations](/guides/visualizing-report-data) (the big line graphs that display data over time).

  * **grid-background**: The background color of the graph.
  <!-- * **grid-border**: -->
  * **series1**: The color of the line representing the first series of data displayed.
  * **series2**: The color of the line representing the second series of data displayed.
  * **series3**: The color of the line representing the third series of data displayed.
  * **series4**: The color of the line representing the fourth series of data displayed.
  * **series5**: The color of the line representing the fifth series of data displayed.
  * **series6**: The color of the line representing the sixth series of data displayed.
  * **series7**: The color of the line representing the seventh series of data displayed.
  * **series8**: The color of the line representing the eighth series of data displayed.
  * **series9**: The color of the line representing the ninth series of data displayed.
  * **series10**: The color of the line representing the tenth series of data displayed.
  * **ticks**: The color of x-axis gridlines and x-axis ticks.
  * **single-metric-label**: The color of the series name label if only **one** series is displayed. If you don't care about whether there's one series displayed or not, set this color to the one you used in **series1**.

* _Namespace_: **realtime-map**: contains colors for the [Realtime Visitors Map](http://piwik.org/docs/real-time-visitor-world-map/).

  * **white-bg**: The background color for the map when using the _light theme_. 
  * **white-fill**: The country/region fill color for the map when using the _light theme_.
  * **black-bg**: The background color for the map when using the _dark theme_.
  * **black-fill**: The country/region fill color for the map when using the _dark theme_.
  * **visit-stroke**: The border color for each visit.
  <!-- TODO switching to referrer mode doesn't seem to work -->
  * **website-referrer-color**: The fill color of a visit whose referrer was a website _(only used if the Referrer Type color mode is used)_.
  * **direct-referrer-color**: The fill color of a visit that has no referrer _(only used if the Referrer Type color mode is used)_.
  * **search-referrer-color**: The fill color of a visit whose referrer was a search engine _(only used if the Referrer Type color mode is used)_.
  * **live-widget-highlight**: The color to use when highlighting a visit in the live widget _(only used when embedding both the realtime map and the Live widget in the dashboard)_.
  * **live-widget-unhighlight**: The color to use when unhighlighting a visit in the live widget _(only used when embedding both the realtime map and the Live widget in the dashboard)_.
  * **symbol-animate-fill**: The starting fill color to use when animating the appearance of a new visit. The ending fill color is always the visit's normal color.
  <!-- TODO: hue of visit color is not themable still -->

* _Namespace_: **visitor-map**: contains colors for the [Visitors Map](http://piwik.org/docs/visitors-map/).

<!-- TODO: should probably rename some of these colors -->

  * **no-data-color**: The fill color for countries that have no visits.
  * **one-country-color**: The fill color for countries that have visits, if only one country received visits.
  * **color-range-start-choropleth**: The start of the color range used to color countries and regions based on the number of visits.
  * **color-range-end-choropleth**: The end of the color range used to color countries and regions based on the number of visits.
  * **color-range-start-normal**: The start of the color range used to color cities based on the number of visits.
  * **color-range-end-normal**: The end of the color range used to color cities based on the number of visits.
  * **country-highlight-color**: The fill color to use when a country is _highlighted_ (a country is highlighted when the mouse enters it while the shift key is pressed).
  * **country-selected-color**: The fill color to use when a country is _selected_ (ie, when a country is being used in a row evolution popup).
  * **unknown-region-fill-color**: The fill color to use for regions that have no visits (or 0 of whatever metric is displayed).
  * **unknown-region-stroke-color**: The stroke color to use for regions that have no visits (or 0 of whatever metric is displayed).
  * **region-stroke-color**: The stroke color for regions with visits.
  * **region-selected-color**: The fill color to use when a region is _selected_ (ie, when a region is being used in a row evolution popup).
  * **region-highlight-color**: The fill color to use when a region is _highlighted_ (a region is highlighted when the mouse enters it while the shift key is pressed). Only regions with visits can be highlighted.
  * **invisible-region-background**: The fill color to use for regions when displaying cities. This color should make the city data more visible.
  * **region-layer-stroke-color**: The stroke color of each region.
  * **city-label-color**: The color of city labels.
  * **city-stroke-color**: The stroke color to use for cities.
  * **city-highlight-stroke-color**: The stroke color to use when a city is _highlighted_ (a city is highlighted when the mouse enters it).
  * **city-highlight-fill-color**: The fill color to use when a city is _highlighted_ and the shift key is pressed (a city is highlighted when the mouse enters it).
  * **city-highlight-label-color**: The label color to use while the shift key is pressed for a city that is _highlighted_.
  * **city-label-fill-color**: The fill color for a city label. <!-- TODO: the city label fill color is never set initially only when unhighlighting. Will cause bugs for themes.)
  * **city-selected-color**: The fill color to use for a city when it is _selected_ (ie, when a city is being used in a row evolution popup).
  * **city-selected-label-color**: The label color to use for a city when it is _selected_ (ie, when a city is being used in a row evolution popup).
  * **special-metrics-color-scale-1**: The start of the color scale used to color countries and regions for _special metrics_. [[1]](#named-colors-footnote-1)
  * **special-metrics-color-scale-2**: The second color in the color scale used to color countries and regions for _special metrics_.
  * **special-metrics-color-scale-3**: The third color in the color scale used to color countries and regions for _special metrics_.
  * **special-metrics-color-scale-4**: The end of the color scale used to color countries and regions for _special metrics_.

<a name="named-colors-footnote-1"></a>
[1] Metrics that use the _special metrics_ color scale are the following: **avg\_time\_on\_site**, **nb\_actions\_per\_visit** and **bounce\_rate**

## Making a plugin themable

Plugins that define their own UI widgets or new [report visualizations](/guides/visualizing-report-data) are, for the most part, already themable. As long as they rely entirely on CSS for the look and feel, they can be easily themed.

If these new widgets or visualizations use colors in JavaScript or PHP, more work must be done to make them themable.

### Using CSS colors in JavaScript

To use colors defined in CSS within JavaScript, the [ColorManager](/guides/working-with-piwiks-ui#colormanager) class must be used. Using it is straightforward. After you define some named colors in CSS like this:

    .my-color-namespace[data-name=my-color-name] {
        color: red;
    }

    .my-color-namespace[data-name=my-second-color] {
        color: blue;
    }

You access them through [ColorManager](/guides/working-with-piwiks-ui#colormanager) like this:

    var ColorManager = require('piwik').ColorManager;

    // get one color
    var myColorToUse = ColorManager.getColor('my-color-namespace', 'my-color-name');

    // get multiple colors all at once
    var myColorsToUse = ColorManager.getColor('my-color-namespace', ['my-first-color', 'my-second-color']);

### Using CSS colors in PHP

Using CSS colors in PHP is more complicated, in fact, so much so that **using color values in PHP is discouraged**. The only way to use them is to access them in JavaScript, and then pass them to PHP via query parameters:

    // get the colors
    var ColorManager = require('piwik').ColorManager;
    var myColorsToUse = ColorManager.getColor('my-color-namespace', ['my-first-color', 'my-second-color']);

    // set the source of an <img> to use those colors
    var jsonColors = JSON.stringify(myColorsToUse);
    $('img#myImage').attr('src', '?module=MyPlugin&action=generateImage&colors=' + encodeURIComponent(jsonColors))

Then use those colors in PHP:

    // controller method in MyPlugin
    public function generateImage()
    {
        $colors = Common::getRequestVar('colors', null, $dataType = 'json');

        $myFirstColor = $colors['my-first-color'];
        $mySecondColor = $colors['my-second-color'];

        // ... generate the image ...
    }

## Learn more

* To learn **more about creating new report visualizations** read our [Visualizing Report Data](/guides/visualizing-report-data) guide.
* To learn **more about writing JavaScript for Piwik plugins and themes** read our [Working with Piwik's UI](/guides/working-with-piwiks-ui) guide.

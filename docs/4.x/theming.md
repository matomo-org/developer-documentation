---
category: Develop
title: Themes
---
# Writing a theme

**Themes** are special types of plugins that change the look and feel of Piwik's UI. They use CSS and LESS to override the default styles defined by other Piwik plugins.

This guide will explain how to create a new theme. This guide assumes that you:

- can code in HTML, PHP, CSS and JavaScript,
- and have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide).

## Creating a new theme

To create an empty theme, run the following command from Piwik's root directory:

    ./console generate:theme

After you enter the appropriate information, a theme will be created for you in the `plugins/` directory. Now you need to activate this theme by going to "Administration => Plugins => Manage Themes" and activate your created theme.

## Simple theming

### Colors and fonts

Colors used in CSS are simple to override because they are defined as variables. These variables are defined in PHP because we also need to apply them to emails, PDF reports, exported images, etc.

For example to change the background from white to black you can simply change the following variable in your `$YourPluginName.php` file. 

```php
public function configureThemeVariables(Plugin\ThemeStyles $vars)
{
    $vars->colorBackgroundBase = '#000';
}
```

To change the link color to red you override the link variable:

```php
public function configureThemeVariables(Plugin\ThemeStyles $vars)
{
    $vars->colorLink = '#f00';
}
```

To change the font you override the font variable:

```php
public function configureThemeVariables(Plugin\ThemeStyles $vars)
{
    $vars->fontFamilyBase = 'Verdana, sans-serif';
}
```

You get the point. The list of all variables that you can override is defined in the Morpheus plugin:

- [ThemeStyles](https://github.com/matomo-org/matomo/blob/3.x-dev/core/Plugin/ThemeStyles.php)

Although we do not recommend doing so, you can change the colors of a specific element directly, for example:

```css
#login {
    background-color: red;
}
```

Please use this method only if needed. Element ids or classes might change in the future and break your theme.

### Icons override

Overriding icons is fairly easy: create a folder named `images` in your theme's directory and place an icon having the same file name as the icon you want to override.

For a complete list of icons you can override have a look at the [Morpheus theme](https://github.com/matomo-org/matomo/tree/master/plugins/Morpheus/images). It is not yet possible to override icons used in reports such as browser or search engine icons, but if you have suggestions, you can [open an issue in the piwik-icon repository](https://github.com/matomo-org/matomo-icons).

### Logo and favicon

As Piwik users can upload their own logo and favicon using the admin interface a theme is not supposed to change any of those.

## Advanced theming

### Adding styles

Every theme has one main file that contains all of your theme's styling overrides. The location of this file is determined by the **stylesheet** property in your theme's `plugin.json` file. The property's value is a path relative to the plugin's root directory:

```json
{
    "name": "MyTheme",
    "description": "A new theme.",
    "theme": true,
    "stylesheet": "stylesheets/theme.less"
}
```

Generated themes will already have a file configured, so you don't need to set this property. The file is called `theme.less` and is located in the `stylesheets/` directory of your theme.

You can put your entire theme into this one file if you want, but the result might not be easy to read and to maintain. Instead, you should group the styles based on the part of Piwik they modify and place them in separate LESS files. You can then [`@import`](http://lesscss.org/features/#import-directives-feature) them in `theme.less`.

### Adding JavaScript files

Themes can also add new JavaScript files. These files can be used to style things that can't be styled through CSS or LESS.

To add JavaScript files, add them as an array to the **javascript** property in your theme's `plugin.json` file:

```json
{
    "name": "MyTheme",
    "description": "A new theme.",
    "theme": true,
    "stylesheet": "stylesheets/theme.less",
    "javascript": ["javascripts/myJavaScriptFile.js", "javascripts/myOtherJavaScriptFile.js"]
}
```

### Theming colors used in JavaScript & PHP

Some colors are only used in JavaScript and in PHP. We've made it possible for those colors to be specified through CSS, but the process is a bit different from setting colors of normal HTML elements.

Each color used in JavaScript is given a name and grouped in a _color namespace_. You can set these colors like this:

```css
.color-namespace-name[data-name=color-name] {
    color: red;
}
```

For example,

```css
.bar-graph-colors[data-name=grid-background] {
    color: @background-color-base;
}

.bar-graph-colors[data-name=grid-border] {
    color: @basic-grid-border-color;
}
```

#### Named colors

Here is a list of all named colors in Piwik:

* _Namespace_: **sparkline-colors**: contains colors for sparkline images.

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

* _Namespace_: **realtime-map**: contains colors for the [Realtime Visitors Map](https://piwik.org/docs/real-time-visitor-world-map/).

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

* _Namespace_: **visitor-map**: contains colors for the [Visitors Map](https://piwik.org/docs/visitors-map/).

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
  * **city-label-fill-color**: The fill color for a city label. <!-- TODO: the city label fill color is never set initially only when unhighlighting. Will cause bugs for themes.) -->
  * **city-selected-color**: The fill color to use for a city when it is _selected_ (ie, when a city is being used in a row evolution popup).
  * **city-selected-label-color**: The label color to use for a city when it is _selected_ (ie, when a city is being used in a row evolution popup).
  * **special-metrics-color-scale-1**: The start of the color scale used to color countries and regions for _special metrics_. [[1]](#named-colors-footnote-1)
  * **special-metrics-color-scale-2**: The second color in the color scale used to color countries and regions for _special metrics_.
  * **special-metrics-color-scale-3**: The third color in the color scale used to color countries and regions for _special metrics_.
  * **special-metrics-color-scale-4**: The end of the color scale used to color countries and regions for _special metrics_.

<a name="named-colors-footnote-1"></a>
[1] Metrics that use the _special metrics_ color scale are the following: `avg_time_on_site`, `nb_actions_per_visit` and `bounce_rate`.

## Twig, the template engine

Piwik uses the [Twig templating engine](https://twig.sensiolabs.org/) to create HTML pages from PHP.

When creating a theme, you do not need to create or change any template as the recommended way is to only use Less (CSS) and JavaScript. However, in some rare cases where advanced customisation is necessary, you may need to customise Twig templates.

Please note that this is not recommended, so use at your own risk.

To override a twig templates from the default `Morpheus` theme, place a `.twig` template file with the same name in your `templates/` directory as follows:

```
plugins/[MyThemePlugin]/templates/dashboard.twig
```

To override twig templates used in a plugin, place a `.twig` template file with the same name in your plugin's `templates/` directory as follows:

```
plugins/[MyThemePlugin]/templates/plugins/[OverriddenPlugin]/[overriddenTemplate].twig
```

## Learn more

* To learn **more about creating new report visualizations** read our [Visualizing Report Data](/guides/visualizing-report-data) guide.
* To learn **more about writing JavaScript for Piwik plugins and themes** read our [Working with Piwik's UI](/guides/working-with-piwiks-ui) guide.
* To learn **more about UI components and styles** read our [Views](/guides/views) guide.

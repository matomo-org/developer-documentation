# Designing a custom theme

## Activate the development mode
If you change your theme.less file, you will not see the difference on your Piwik instance.
The stylesheets have a cache mode to prevent from compiling them on every page call.
To disable it, you have to modify the "config/config.ini.php" file:

<pre>[Debug]
disable_merged_assets = 1
</pre>

## Images
You can stock your images in the folder "plugins/YourPluginName/images".
To use images in CSS, you have to use a relative path that start at the root folder.

Example:

<pre>background-image: url(plugins/YourPluginName/images/dropDown.jpg);
</pre>

## Stylesheets (less)
### Multiple stylesheet files

You can submit only one stylesheets file for theme.
But you can import other Less files from the main theme file:

Example:

<pre>@import "../../plugins/YourPluginName/stylesheets/_yourSubStylesheetName.less"
</pre>

It's important to use this complex path to prevent compilation bugs.
It is better to prefix your sub stylesheet file name with an '_'.

## Graphs

You can style some graph elements.
You should see [plugins/CoreHome/stylesheets/jqplotColors.less](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/stylesheets/jqplotColors.less) for more information.

## Sparklines

You can style some sparklines elements.
You should see "[plugins/CoreHome/stylesheets/sparklineColors.less](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/stylesheets/sparklineColors.less)" for more information.

## Transitions

You can style some transitions elements.
You should see "[plugins/Transition/stylesheets/_transitionColors.less](https://github.com/piwik/piwik/blob/master/plugins/Transitions/stylesheets/_transitionColors.less)" for more information.

## Testing
## Limitations

You just can not theme:

* Installation plugin pages
* CoreUpdater plugin pages

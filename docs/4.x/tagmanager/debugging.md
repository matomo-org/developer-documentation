---
category: Integrate
---
# Debugging

As part of configuring your container or writing a custom tag, trigger, or variable, you may want to preview or debug your container to see if everything is working as expected.

The debug mode lets you see for example which triggers and tags have been fired, the value of each variable when an event is triggered, the content of the data layer, and more.

## Activating the debug mode

To activate this mode, simply follow these steps:

* Open the container in Matomo's Tag Manager and click on "Preview / Debug" in the top toolbar.
* Enter the URL or domain you want to start debugging(Applicable only for Matomo version >= 4.6).
* The debug toolbar will appear at the bottom of the website.

<div markdown="1" class="alert alert-info">
If the toolbar does not appear, you might have to clear your browser cache either in the developer console, or by using one of these shortcuts (please check the shortcut for your operating system and browser combination):

* Mac: `⌘ + shift + r`
* Windows / Linux: `shift + f5` or `ctrl + shift + r`
</div>

## Sharing a preview / debug mode

The debug toolbar only appears by default for the person that enabled the debug / preview mode in the Tag Manager (a cookie is set when you enable the debug mode). If you want to share this mode with someone else, please ask that person to append the URL parameter `?mtmPreviewMode=$containerId` (or `&mtmPreviewMode=$containerId`) to activate the toolbar. You need to replace `$containerId` with the actual ID of the container, the correct value for the URL parameter will be shown to you within the Tag Manager UI. This URL parameter may also helpful you in case the toolbar doesn't appear.

## Ignoring a preview / debug mode

When you activate the preview mode, a cookie will be set in your browser that activates this mode for all environments. However, you may not want to preview or debug all environments, or you simply want to load the container without the preview mode for a quick test. Instead of having to deactivate and activate this mode through the Matomo UI you can simply append a URL parameter `?mtmPreviewMode=0` or `&mtmPreviewMode=0`;

## Developer console log messages

You may also enable debug messages without enabling the debug mode on the container by calling the following JavaScript code:

```js
window._mtm = window._mtm || [];
window._mtm.push(['enableDebugMode']);
```

This will log various debug messages to the developer console and is targeted to developers only. It is recommended calling this code as early as possible.

### Debugging multiple containers at once

If you share a debug mode and want to debug multiple containers at once, make sure to enable the preview mode for all containers that you want to debug like this:

```
?mtmPreviewMode=6OMh6taM&mtmPreviewMode=lJZXWNmI
```

---
category: DevelopInDepth
title: Matomo Icon Font
---
# Matomo Icon Font

We use a custom Matomo font in our UI to show icons. You can [find the font in the repository as part of the Morpheus](https://github.com/matomo-org/matomo/tree/5.x-dev/plugins/Morpheus/fonts) theme.

## How to find the list of all available icons

You can find a list of all available icons by accessing your Matomo using below URL. Make sure to replace `{REPLACE WITH YOUR MATOMO DOMAIN}` with the domain/path to your Matomo. For the URL to work you need to have the development mode enabled and have at least admin access.

```
https://{REPLACE WITH YOUR MATOMO DOMAIN}/index.php?module=Morpheus&action=demo#icons
```

The available icons will be shown in the bottom of the page. Each icon has a CSS class name which starts with `icon-`. To enable the development mode you can run this command (don't do this in a production environment):

```bash
./console development:enable
```

## How to show / use an icon in the UI

To use an icon, simply add the name of class for the icon to an element like this:

```html
<span class="icon-add"></span>
```


## Adding, changing or removing icons to the Matomo font

Follow below steps to add, change or remove an icon.

* Download this file (use "File -> Save" in the browser): [selection.json](https://raw.githubusercontent.com/matomo-org/matomo/5.x-dev/plugins/Morpheus/fonts/selection.json).
* Go to [https://icomoon.io/app/](https://icomoon.io/app/).
* Upload the downloaded file in icomoon by clicking on "Import Icons".
* Confirm the question "Would you like to use all settings from the selected file" with "Yes".
* Now you can make changes to the font such as removing an icon by unselecting it.
* To add a new icon enter a name and search for the icon. We only use icons from these three fonts if any possible:
  * Material Icons (preferred if a matching icon can be found here)
  * `IcoMoon - Free` or `Font Awesome` (depending on which one looks better in the app)
  * To add an icon simply select it.
* Once you've made all needed changes, click in the bottom on "Generate Font".
  * If needed, you could change the position of the icon here and make further tweaks such as rotate it, but this is usually not needed.
* Click on "Download".
* Extract the downloaded zip file.
* Copy the files from the `font` directory and the `selection.json` to `plugins/Morpheus/font`.
* Generate the `woff2` version of the font as it is not included automatically.
  * get `woff2_compress` e.g. via the woff2 debian package or similar packages for other distributions or compile it yourself as explained on [https://github.com/google/woff2](https://github.com/google/woff2).
  * convert the .ttf file using `woff2_compress matomo.ttf`
  * there should now be a `matomo.woff2`
* Update [plugins/Morpheus/stylesheets/base/icons.css](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Morpheus/stylesheets/base/icons.css) 
  * Add a new CSS class for this icon. The style content in this class needs to mention the font character, for example `\e609`. You can find the correct value for this from the `style.css` file of the extracted zip file. Simply search for the icon name there to find the correct value.
  * Update cachebuster parameter of the four font URLs at the top of the file, for example `url('plugins/Morpheus/fonts/matomo.woff2?rzeu9j')` could become `url('plugins/Morpheus/fonts/matomo.woff2?gt43xz')`. The cache buster string can be any six digit random alphanumeric string as long as it's different from the previous one. Providing a new cache buster value will invalidate any old versions of the font in browser caches and force the new font to be used.  
* Update [plugins/Morpheus/Controller.php](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Morpheus/Controller.php#L632) by adding or removing the name of the changed icon in one of the available categories. If the icon is not appearing on the page, try clearing the cache `./console cache:clear`.
* Open `https://{REPLACE WITH YOUR MATOMO DOMAIN}/index.php?module=Morpheus&action=demo#icons` and check if the icon shows up correctly.
* Update our [LEGALNOTICE](https://github.com/matomo-org/matomo/blob/5.x-dev/LEGALNOTICE) and mention or remove the name of the icon we added, changed or removed. You already find a list of icons we've been using so far in this file.

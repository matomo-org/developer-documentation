---
category: Develop
---
# Distributing Your Plugin

<!-- Meta (to be deleted)
Purpose:
- describe how to put plugin on the marketplace,
- how to get the most out of the marketplace,
- any future plans for the marketplace

Audience: plugin developers who have finished creating a plugin

Expected Result: plugin developers who know all about the marketplace

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you've **created a plugin and want to share it with other Piwik users**
* you'd like to know **how you can take advantage of the Piwik marketplace**

**Guide assumptions**

This guide assumes that you:

* know how to use [git](http://git-scm.com)
* and have already created a Piwik plugin (if not, start by reading our [Getting Started Extending Piwik](/guides/getting-started-part-1) guide).

## The Marketplace

Piwik's [plugin marketplace](http://plugins.piwik.org) is the main way to download and install third-party plugins. Every instance of Piwik running version 2.0 or greater is able to directly download and install plugins from the marketplace. **Making your plugin available on the marketplace is the best way for you to get your plugin out into the hands of Piwik users.**

It's also a great way for you to:

* see how many people use your plugin
* allow people to donate money
* get exposure for your skills and work
* get feedback in the form of comments and ratings _(coming soon)_

## Adding your plugin to the marketplace

Getting your completed plugin on the marketplace takes a couple steps, all listed below.

### Make sure your plugin has a unique name

Every plugin on the marketplace has a unique name. If your plugin's name is already taken, you won't be able to put it on the marketplace.

Make sure the name you chose is currently available, and if it's not, pick another one.

<!-- TODO: problem w/ prefixing project names w/ github user names so projects can have the same name? -->

### Getting your plugin ready to publish

Two files are required to be present in your plugin before you can publish: the **README.md** file and the **[plugin.json](https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/plugin.json)** file.

#### README.md file
The **README.md** file should contain a description of your plugin and some documentation.
Sections in this file are used to build the plugin page on the Marketplace.

Let's take a look at the CustomAlerts plugin [README file](https://raw.githubusercontent.com/piwik/plugin-CustomAlerts/master/README.md).
This file is written in Markdown format. It includes the following sections: `Description`, `FAQ`, `Changelog` and `Support`.
The sections in your README are then directly displayed on your plugin page in the Marketplace! Checkout the [CustomAlerts plugin](http://plugins.piwik.org/CustomAlerts) page created from the README file.

#### Screenshots

To make your plugin shine on the Piwik marketplace: include screenshots in your Git repository!

Prepare a few screenshots of your plugin in action.
Place them in a directory `screenshots/` in your plugin folder.
Give them a descriptive name: filenames will be used as the legend below each screenshot.

See the result for the [CustomAlerts plugin screenshots](http://plugins.piwik.org/CustomAlerts) (click on the Screenshots link).
These screenshots are stored [in git: CustomAlerts/screenshots](https://github.com/piwik/plugin-CustomAlerts/tree/master/screenshots).

#### plugin.json file
<a name="plugin-json-required-fields"></a>
The **plugin.json** file must contain the following information:

* **name** - The plugin's name. It can only contain letters, numbers and the `'-'` and `'_'` characters. The name cannot contain the words `"Piwik"`, `"Core"` or `"Analytics"`.
* **version** - The plugin's version. It must be a valid semantic version number. If [node-semver](https://github.com/isaacs/node-semver) can't parse it, it won't be considered valid.
* **description** - A short description of your plugin (up to 150 characters). This will be displayed below the plugin's name in search results and below the top-level heading on your plugin's page. It can include any character.
* **keywords** - An array of words or short phrases that describes your plugins. The keywords are listed on the Marketplace, which helps users discover your plugin. Keywords can only contain letters, numbers, hyphens, and dots.
* **license** - The name of the license your plugin uses. The license must be compatible with the [GPLv3](http://www.gnu.org/licenses/gpl.html) or later. We recommend using [GPLv2](http://www.gnu.org/licenses/gpl-2.0.html) or later.
* **homepage** - The url to the plugin's homepage.
* **authors** - An array of objects, each describing someone who helped create this plugin. The objects must contain a **name** field and can optionally contain an email and homepage field, for example:

      "authors": [
        {
          "name": "Hacker",
          "email": "marketplace@piwik.org",
          "homepage": "http://piwik.org"
        }
      ]

  You must define at least one author.

The following fields are not required for publishing a plugin, but you may want to add them:

* **require** - Defines packages required by this plugin. The plugin will not be installed unless those requirements can be met. Two packages are supported at the moment: `piwik` and `php`. 

  For example:

  ```
  "require": {
    "piwik": "2.0.3", // requires at least Piwik 2.0.3 
    "php": "5.3.20" // requires at least PHP 5.3.20
  }
  ```

  By default the specified version defines the miniumum version but you can define another comparison by prefixing the version with one of the following values: `<>`, `!=`, `>`, `>=`, `<`, `<=`, `==`.

  For example:

  ```
  "require": {
    "piwik": "<=2.2.0", // requires Piwik 2.2.0 or lower but at least Piwik 2.0.0
    "php": ">=5.4.0" // requires at least PHP 5.4.0
  }
  ```
  
  You can define multiple ranges, separated by a comma, which will be treated as a logical `AND`. This can be useful in case you know your plugin is only compatible with a limited number of Piwik versions.
  
  For example:

  ```
  "require": {
    "piwik": ">=2.0.0,<=2.2.0", // requires a Piwik version 2.0.0 up to 2.2.0
  }
  ```
  
  
* **donate** - An object containing information on how to donate to the plugin author (you!). The object can contain any of the following fields:

  * **paypal** - Your paypal email address.
  * **flattr** - The URL to your [Flattr](https://flattr.com/) page.
  * **bitcoin** - Your Bitcoin address.

  For example:

  ```
  "donate": {
    "paypal": "supporters@piwik.org",
    "flattr": "https://flattr.com/thing/131552/Piwik-Web-Analytics-Open-Source",
    "bitcoin": "http://piwik.org"
  }
  ```

### Put your plugin on Github

The marketplace uses [Github](https://github.com) webhooks to learn about your plugin and serve it to Piwik users that want it. This means you don't manually upload any files to the marketplace. Instead, you put your code into a Github repository and let the marketplace know about it.

Creating and initializing a [git](http://git-scm.com) repo on Github is out of scope for this guide. If you need to learn how to create a Github repo, [read this article](https://help.github.com/articles/create-a-repo).

### Activating the Piwik Plugins webhook

Once you have a Github repo for your plugin, you need to let the marketplace know about it. This is done by activating the Piwik Plugins webhook.

To activate this webhook, follow these steps:

1. Go to your plugin's Github repo in a browser.
2. Click on **Service Hooks**.
3. Scroll down until you see the **Piwik Plugins** option and then click on it.
4. Click the **Active** checkbox.
5. Click the **Update Settings** button.

The marketplace will now be notified every time you push a commit or a tag to your repository.

### Publish the first version of your plugin

Now that the marketplace will know of any changes to your plugin, you can publish the first version. First, make sure the version in your **plugin.json** file is `0.1.0`. Then, we'll run two git commands to publish a version of your plugin:

    $ git tag 0.1.0
    $ git push origin --tags

Everytime you push a new tag to your Github repository, a new version of your plugin will become available in the marketplace. The name of the tag doesn't matter, the marketplace will always use the version in your **plugin.json** file.

**Assuming all goes well, your plugin should now be visible on the marketplace!**

##### Troubleshooting

If your plugin is not on the marketplace, then there was an error validating your **plugin.json** file and you will receive an email describing what the problem was.

Here are some common errors:

* The **plugin.json** manifest file was not found.
* Some of **plugin.json**'s [required fields](#plugin-json-required-fields) are not set.
* The version in **plugin.json** has already been published for this plugin.
* The **plugin.json** file does not contain valid JSON.
* The **README.md** file is missing.
* A plugin with your plugin's name already exists on the marketplace.
* There is a PHP syntax error in your plugin.

If you still encounter trouble while publishing your plugin, please join the IRC channel **#piwik** on [freenode](http://freenode.net/). If you can't find anyone in the IRC channel, please ask for help [on the forums](http://forum.piwik.org/).

##### Rules for Plugins

There are some restrictions regarding what can be published on the marketplace. Chances are your plugin is fine, but if we find a plugin that violates one of the following rules, it will be immediately removed:

* Your plugin must not do anything illegal, or be morally offensive.
* Your plugin's license must be compatible with the [GNU General Public License v3](https://www.gnu.org/copyleft/gpl.html) or any later version. We strongly recommend using the same license as Piwik _(GPLv3 or later)_."
  * **Note:** If you don't specify a license anywhere in your plugin, it is assumed your plugin uses GPLv3 or later.
* Your plugin must not contain obfuscated code. We believe that obfuscated code violates the spirit, if not the letter, of the GPL license under which we operate.
* No **[phoning home](http://en.wikipedia.org/wiki/Phoning_home)** without user's informed consent. For the purposes of a Piwik plugin, **phoning home** includes:
  * No unauthorized collection of user data. For example, sending the admin's email address back to your own servers without the user'a permission is not allowed; but asking the user for an email address and collecting if they choose to submit it is fine. All actions taken in this respect MUST be of the user's doing, not automatically done by the plugin.
  * All images and scripts shown should be part of the plugin. These should be loaded locally. If the plugin requires data that is loaded from an external website (such as [blocklists](http://en.wikipedia.org/wiki/Blacklist_%28computing%29)) this should be made clear in the plugin's admin screens or it's description. The user must be informed of what information is being sent where.
* The plugin page, contents of the **readme.md** file and all translation files may not have "sponsored" links on it. This applies to all content that will be displayed on [plugins.piwik.org](http://plugins.piwik.org) and [themes.piwik.org](http://themes.piwik.org)
* The plugin cannot violate our [trademarks](http://piwik.org/trademark/). Do not use **piwik** in your domain name, instead come up with your own original branding! People remember names.

## Using the marketplace

Now that you've gotten your plugin on the marketplace, it's time to learn how to use it. This section will explain how you can the most out of the marketplace.

### Your plugin's page

Every plugin gets its own page on the marketplace. On the left is the name and a short description of your plugin followed by a set of tabs.

<!-- TODO: image -->

The content of the tabs is determined by the headings in your **README.md** file. See this [README.md](https://raw.github.com/tsteur/piwik-livetab-plugin/master/README.md) for an example.

On the right side is the download link, information about your plugin and some relevant links.

<!-- TODO: image -->

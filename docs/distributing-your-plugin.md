---
category: Develop
---
# Distributing Your Plugin

[**Piwik's Plugin Marketplace**](http://plugins.piwik.org) is the main way to download and install third-party plugins.

Every instance of Piwik running version 2.0 or greater is able to directly download and install plugins from the marketplace. **Making your plugin available on the marketplace is the best way for you to get your plugin out into the hands of Piwik users.**

It's also a great way for you to:

* get user feedback via email or the Github issue tracker
* see how many people use your plugin
* allow people to donate money
* allow people to get in touch with you to get help or to report bugs and features
* get exposure for your skills and work

## Preparing your plugin for the marketplace

Getting your completed plugin on the marketplace takes a couple steps, all listed below.

### Make sure your plugin has a unique name

Every plugin on the marketplace has a unique name. Make sure the name you chose is currently available, and if it's not, pick another one.

### Prepare your plugin

Two files are required to be present in your plugin before you can publish: the **README.md** file and the **[plugin.json](https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/plugin.json)** file.

#### README.md file

The `README.md` file should contain a description of your plugin. 
Let's take a look at the CustomAlerts plugin's [README file](https://raw.githubusercontent.com/piwik/plugin-CustomAlerts/3.x-dev/README.md).
The file is written in Markdown format and has the following section: `Description`.
The content between `## Description` and the next `## ...` headline will be directly displayed on your plugin's page in the Marketplace! Checkout the [CustomAlerts plugin's](http://plugins.piwik.org/CustomAlerts) page created from the README file.

#### Screenshots

To make your plugin shine on the Piwik marketplace, include screenshots in your Git repository!

Prepare a few screenshots of your plugin in action and place them in a `screenshots/` directory in your plugin's folder.
Give them descriptive names because the file names will be used as the legends shown below each screenshot. Only alphanumeric characters, underscores and dashes are allowed in the file name. The file name must end with `.png`, `.jpg` or `.jpeg`.

See the result for the [CustomAlerts plugin's screenshots](http://plugins.piwik.org/CustomAlerts) (click on the Screenshots link).
These screenshots are stored [in git: CustomAlerts/screenshots](https://github.com/piwik/plugin-CustomAlerts/tree/master/screenshots).

#### plugin.json file

<a name="plugin-json-required-fields"></a>
The `plugin.json` file must contain the following information:

- `name`: The plugin's name. It can only contain letters (a-z), numbers (0-9) and must start with a capital letter. The name cannot contain the words `"Piwik"`, `"Core"` or `"Analytics"`. A maximum of 40 characters are allowed.
- `version`: The plugin's version. It must be a valid [semantic version number](http://semver.org/). If [node-semver](https://github.com/isaacs/node-semver) can't parse it, it won't be considered valid.
- `description`: A short description of your plugin (up to 150 characters). This will be displayed below the plugin's name in search results and below the top-level heading on your plugin's page. It can include any character.
- `keywords`: An array of words or short phrases that describe your plugin. The keywords are listed on the Marketplace, which helps users discover your plugin. Keywords can only contain letters, numbers, hyphens, and dots.
- `license`: The name of the license your plugin uses. The license must be compatible with the [GPLv3](http://www.gnu.org/licenses/gpl.html) or later. We recommend using [GPLv3](http://www.gnu.org/licenses/gpl-2.0.html) or later.
- `homepage`: The URL to the plugin's homepage.
- `authors`: An array of objects, each describing someone who helped create the plugin. The objects must contain a **name** field and can optionally contain an email and homepage field. You must define at least one author.
- `require` - Defines packages required by this plugin. The plugin will not be installed unless those requirements can be met. Two packages are supported at the moment: `piwik` and `php`.

    For example:

    ```json
    "require": {
        "piwik": ">=2.0.3", // requires at least Piwik 2.0.3
        "php": ">=5.3.20" // requires at least PHP 5.3.20
    }
    ```

    You can define any another comparison by changing the prefix of the version with one of the following values: `<>`, `!=`, `>`, `>=`, `<`, `<=`, `==`.

    For example:

    ```json
    "require": {
        "piwik": "<=2.2.0", // requires Piwik 2.2.0 or lower but at least Piwik 2.0.0
        "php": ">5.4.0" // requires at least PHP 5.4.1
    }
    ```
  
    You can define multiple ranges, separated by a comma, which will be treated as a logical `AND`. This can be useful in case you know your plugin is only compatible with a limited number of Piwik versions.
  
    For example:

    ```json
    "require": {
        "piwik": ">=2.0.0,<=2.2.0", // requires a Piwik version 2.0.0 up to 2.2.0
    }
    ```
    
    For plugins that target Piwik 3 or newer read the [Composer Versions documentation](https://getcomposer.org/doc/articles/versions.md) for more information.
  

The following fields are not required for publishing a plugin, but you may want to add them:
  
- `donate` - An object containing information on how to donate to the plugin author (you!). The object can contain any of the following fields:
    - `paypal` - Your paypal email address.
    - `flattr` - The URL to your [Flattr](https://flattr.com/) page.
    - `bitcoin` - Your Bitcoin address.

    For example:

    ```json
    "donate": {
        "paypal": "supporters@piwik.org",
        "flattr": "https://flattr.com/thing/131552/Piwik-Web-Analytics-Open-Source",
        "bitcoin": "1NdftZmgb8V9PgbFDYjC5PRJ2QDLyyzCU9"
    }
    ```
  
  
- `support` - An object containing information on how to get in touch with you. Any specified resource will be visible in a "Support" tab on the plugin page. The object can contain any of the following fields:
    - `email` - A contact or support email address.
    - `issues` - An URL to the issue / bug / feature tracker for this plugin.
    - `forum` - An URL to a forum.
    - `docs` - An URL to docs or guides for this plugin.
    - `irc` - IRC information.
    - `wiki` - An URL to a wiki.
    - `source` - An URL to the source code.
    - `rss` - An URL where they can subscribe to news or updates.

    For example:

    ```json
    "support": {
            "email": "support@example.com",
            "issues": "https://github.com/piwik/piwik/issues",
            "forum": "https://forum.piwik.org",
            "irc": "irc://freenode/piwik",
            "source": "https://github.com/piwik/piwik/",
            "wiki": "https://github.com/piwik/piwik/wiki",
            "docs": "https://piwik.org/docs/",
            "rss": "https://piwik.org/feed/"
    }
    ```
    
    
- `preview` - Preview lets you define a demo link and a video. If defined, they will be visible in the "Preview" tab of your plugin. The object can contain any of the following fields:
    - `demo_url` - A URL to a demo of your plugin
    - `video_url` - A Vimeo or YouTube URL to showcase your plugin. The URL has to be as in the example below. This means a Vimeo URL has to start with `https://player.vimeo.com/video/` and a YouTube URL has to start with `https://www.youtube.com/embed/`.
    
    
    ```json
    "preview": {
        "demo_url": "https://demo.piwik.org",
        "video_url": "https://player.vimeo.com/video/1223232323 or https://www.youtube.com/embed/Aaa_111HHH"
    }
    ```
    
    
- `archive` - Lets you define some options for creating Piwik Plugin archives.
    - `exclude` - Allows you to configure which files or directories should be removed from the ZIP file when a user downloads or installs a plugin. It is not possible to use any wildcards and the path must start with a leading slash `/`. By default a few directories and files are always removed from the ZIP archive: the directories `tests`, `Test` and `screenshots` as well as the files `.travis.yml` and `.gitignore` found in your plugin's root directory.
    
    ```json
    "archive": {
        "exclude": ["/builds", "/test.log"]
    }
    ```
    
Here is a complete example to get you started:

```json
{
    "name": "MyPlugin",
    "description": "This is a short description that will be displayed on the Marketplace.",
    "version": "0.1.0",
    "license": "GPL v3+",
    "keywords": ["myplugin"],
    "homepage": "http://piwik.org",
    "authors": [
        {
            "name": "Piwik",
            "email": "hello@piwik.org",
            "homepage": "http://piwik.org"
        }
    ],
    "preview": {
        "demo_url": "https://demo.piwik.org",
        "video_url": "https://www.youtube.com/embed/Aaa_111HHH"
    },
    "archive": {
        "exclude": ["/builds", "/test.log"]
    },
    "support": {
        "email": "support@example.com",
        "issues": "https://github.com/piwik/piwik/issues",
        "forum": "https://forum.piwik.org",
        "irc": "irc://freenode/piwik",
        "source": "https://github.com/piwik/piwik/",
        "wiki": "https://github.com/piwik/piwik/wiki",
        "docs": "https://piwik.org/docs/",
        "rss": "https://piwik.org/feed/"
    },
    "require": {
        "piwik": ">=2.9.0"
    }
}
```

#### License

In the `plugin.json` file you can define the name of your license. 

You can also put a `LICENSE`, `LICENSE.txt` or `LICENSE.md` file within the root directory of your plugin. If present, the license name on your plugin page will be clickable and users will be able to see the full license text. 

#### Changelog

It is recommended to create and maintain a `CHANGELOG`, `CHANGELOG.txt` or `CHANGELOG.md` file within the root directory of your plugin. If present, a tab "Changelog" will appear on your plugin page showing the content of this file.

#### Documentation

It is recommended to put documentation for your plugin directly into a `/docs/index.md` file. If the file is present, its content will be displayed within a "Documentation" tab on your plugin page.

#### FAQ

It is recommended to put an FAQ for your plugin directly into a `/docs/faq.md` file. If the file is present, its content will be displayed within a "FAQ" tab on your plugin page.

## Publishing your plugin on the marketplace

### Put your plugin on GitHub

The marketplace uses [GitHub](https://github.com) webhooks to learn about your plugin and serve it to Piwik users that want it. This means you don't manually upload any files to the marketplace. Instead, you put your code into a Github repository and let the marketplace know about it.

Creating and initializing a [git](http://git-scm.com) repository on Github is out of the scope of this guide. If you need to learn how to create a Github repository, [read this article](https://help.github.com/articles/create-a-repo).

### Activate the Piwik Plugins webhook

Once your plugin is in a Github repository, you need to let the marketplace know about it. This is done by activating the Piwik Plugins webhook.

To activate this webhook, follow these steps:

1. Go to your plugin's Github repo in a browser.
2. Click on **Settings**
3. Click on **Webhooks & services**
4. Click on **Add service**
5. Search for `piwik` and click the option **Piwik Plugins**.
6. Click the **Active** checkbox.
7. Click the **Add service** button.

The marketplace will now be notified every time you push a commit or a tag to your repository.

### Publish the first version of your plugin

You can now publish the first version of your plugin. First, make sure the version in your `plugin.json` is `0.1.0`. Then, we'll run two git commands to publish a version of your plugin:

```
$ git tag 0.1.0
$ git push origin --tags
```

Everytime you push a new tag to your Github repository, a new version of your plugin will become available in the marketplace. Alternatively you can also create the tag by [creating a release](https://help.github.com/articles/creating-releases/) on Github. The name of the tag doesn't matter, the marketplace will always use the version in your `plugin.json` file.

**Assuming all goes well, your plugin should be visible on the marketplace within a couple minutes. Congratulations!**

### Troubleshooting

If your plugin is not on the marketplace, then there was an error validating your `plugin.json` file and you will receive an email describing what the problem was.

Here are some common errors:

- The `plugin.json` file was not found.
- Some of `plugin.json` [required fields](#plugin-json-required-fields) are not set.
- The version in `plugin.json` has already been published for this plugin.
- The `plugin.json` file does not contain valid JSON.
- The `README.md` file is missing.
- A plugin with your plugin's name already exists on the marketplace.
- There is a PHP syntax error in your plugin.

If you did not receive an email, then the webhook might not be configured (or you may have created the tag before setting up the webhook).

If you still encounter trouble while publishing your plugin, please join the IRC channel **#piwik** on [freenode](http://freenode.net/). If you can't find anyone in the IRC channel, please ask for help [on the forums](http://forum.piwik.org/).

## Rules for Plugins

There are some restrictions regarding what can be published on the marketplace. Chances are your plugin is fine, but if we find a plugin that violates one of the following rules, it will be immediately removed:

- Your plugin must not do anything illegal, or be morally offensive.
- Your plugin's license must be compatible with the [GNU General Public License v3](https://www.gnu.org/copyleft/gpl.html) or any later version. We strongly recommend using the same license as Piwik (*GPLv3 or later*).
  - **Note:** If you don't specify a license anywhere in your plugin, it is assumed your plugin uses *GPLv3 or later*.
- Your plugin must not contain obfuscated code. We believe that obfuscated code violates the spirit, if not the letter, of the GPL license under which we operate.
- No **[phoning home](http://en.wikipedia.org/wiki/Phoning_home)** without the user's informed consent. For the purposes of a Piwik plugin, **phoning home** includes:
  - Unauthorized collection of user data. For example, sending the admin's email address back to your own servers without the user's permission is not allowed; but asking the user for an email address and collecting if they choose to submit it is fine. All actions taken in this respect MUST be of the user's doing, not automatically done by the plugin.
  - All images and scripts shown should be part of the plugin. These should be loaded locally. If the plugin requires data that is loaded from an external website (such as [blocklists](http://en.wikipedia.org/wiki/Blacklist_%28computing%29)) this should be made clear in the plugin's admin screens or its description. The user must be informed of what information is being sent where.
- The plugin page, contents of the `README.md` file and all translation files may not have "sponsored" links in them. This applies to all content that will be displayed on [plugins.piwik.org](http://plugins.piwik.org) and [themes.piwik.org](http://themes.piwik.org).
- The plugin cannot violate our [trademarks](http://piwik.org/trademark/). Do not use **piwik** in your domain name, instead come up with your own original branding! People remember names.

## Using the marketplace

Now that you've gotten your plugin on the marketplace, it's time to learn how to use it. This section will explain how you can the most out of the marketplace.

### Your plugin's page

Every plugin gets its own page on the marketplace. On the top is the name and a short description of your plugin followed by a set of tabs.

![](/img/marketplace-plugin.png)

The contents of the tabs are determined by the description section in the `README.md` file, the `CHANGELOG.md`, `docs/index.md` and `docs/faq.md` file. See this [plugin](https://github.com/tsteur/piwik-livetab-plugin) for an example.

---
category: Develop
---
# Distributing Your Plugin

[**Piwik's Plugin Marketplace**](https://plugins.piwik.org) is the main way to download and install third-party plugins.

Every instance of Piwik running version 2.0 or greater is able to directly download and install plugins from the marketplace. **Making your plugin available on the marketplace is the best way for you to get your plugin out into the hands of Piwik users.**

It's also a great way for you to:

* get user feedback via email or the GitHub issue tracker
* see how many people use your plugin
* allow people to donate money
* allow people to buy your plugin ([get in touch](https://piwik.org/contact/marketplace/))
* allow people to get in touch with you to get help or to report bugs and features
* get exposure for your skills and work

## Preparing your plugin for the marketplace

Getting your completed plugin on the marketplace takes a couple of steps, all listed below.

### Make sure your plugin has a unique name

Every plugin on the marketplace has a unique name. Make sure the name you chose is currently available, and if it's not, pick another one. Also your plugin name must start with a letter, only contains letters and numbers, and not contain the words "Matomo" or "Piwik", "Analytics", "Core" or "Plugin".

### Prepare your plugin

Two files are required to be present in your plugin before you can publish: the **README.md** file and the **[plugin.json](https://github.com/matomo-org/matomo/blob/master/plugins/ExamplePlugin/plugin.json)** file.

#### README.md file

The `README.md` file should contain a description of your plugin.
Let's take a look at the CustomAlerts plugin's [README file](https://raw.githubusercontent.com/piwik/plugin-CustomAlerts/master/README.md).
The file is written in Markdown format and has the following section: `Description`.
The content between `## Description` and the next `## ...` headline will be directly displayed on your plugin's page in the Marketplace! Checkout the [CustomAlerts plugin's](https://plugins.piwik.org/CustomAlerts) page created from the README file.

#### Screenshots

To make your plugin shine on the Piwik marketplace, include screenshots in your Git repository!

Prepare a few screenshots of your plugin in action and place them in a `screenshots/` directory in your plugin's folder.
Give them descriptive names because the file names will be used as the legends shown below each screenshot. Only alphanumeric characters, underscores and dashes are allowed in the file name. The file name must end with `.png`, `.jpg` or `.jpeg`.

To add a cover image, it must be **880x480** pixels and named `_cover.png`. It can then be added to the `screenshots/` directory with the rest of the plugin screenshots. If the cover image does not fit the recommended dimensions, it may not display correctly.

See the result for the [CustomAlerts plugin's screenshots](https://plugins.piwik.org/CustomAlerts) (click on the Screenshots link).
These screenshots are stored [in git: CustomAlerts/screenshots](https://github.com/matomo-org/plugin-CustomAlerts/tree/master/screenshots).

#### plugin.json file

<a name="plugin-json-required-fields"></a>
The `plugin.json` file must contain the following information:

- `name`: The plugin's name. It can only contain letters (a-z), numbers (0-9) and must start with a capital letter. The name cannot contain the words `"Piwik"`, `"Core"` or `"Analytics"`. A maximum of 60 characters are allowed.
- `version`: The plugin's version. It must be a valid [semantic version number](http://semver.org/). If [node-semver](https://github.com/isaacs/node-semver) can't parse it, it won't be considered valid.
- `description`: A short description of your plugin (up to 150 characters). This will be displayed below the plugin's name in search results and below the top-level heading on your plugin's page. It can include any character.
- `keywords`: An array of words or short phrases that describe your plugin. The keywords are listed on the Marketplace, which helps users discover your plugin. Keywords can only contain letters, numbers, hyphens, and dots.
- `license`: The name of the license your plugin uses. The license must be compatible with the [GPL-3.0](https://www.gnu.org/licenses/gpl.html) or later. We recommend using [GPL-3.0+](https://www.gnu.org/licenses/gpl-3.0.html) or later. Supported values are currently: "GPL-3.0+","GPL-3.0", "BSD AND GPL-3.0+", "GPL-2.0-only", "GPL-2.0+", "MIT". Please get in touch with us in case you want to release a plugin under a different license.
- `homepage`: The URL to the plugin's homepage.
- `authors`: An array of objects, each describing someone who helped create the plugin. The objects must contain a **name** field and can optionally contain an email and homepage field. You must define at least one author.
- `require` - Defines packages required by this plugin. The plugin will not be installed unless those requirements can be met. Two packages are supported at the moment: `matomo` and `php`. Plugins that support Matomo 3.X or older, should use `piwik` instead of `matomo`.

    For example:

    ```json
    "require": {
        "matomo": ">=4.0.3,<5.0.0-b1", // requires at least Matomo 4.0.3 but lower than Matomo 5.0.0
        "php": ">=7.3.5" // requires at least PHP 7.3.5
    }
    ```

    You can define any another comparison by changing the prefix of the version with one of the following values: `<>`, `!=`, `>`, `>=`, `<`, `<=`, `==`.

    For example:

    ```json
    "require": {
        "matomo": ">=4.0.3,<5.0.0-b1", // requires at least Matomo 4.0.3 but lower than Matomo 5.0.0
        "php": ">7.3.5" // requires at least PHP 7.3.6
    }
    ```

    For `matomo` requirement it is required to define a lower and upper limit. For example would it be recommended to use `>=4.0.0-b1,<5.0.0-b1` for a plugin that is compatible with Matomo 4.
    For plugins that target Matomo 3 or newer read the [Composer Versions documentation](https://getcomposer.org/doc/articles/versions.md) for more information.


The following fields are not required for publishing a plugin, but you may want to add them:

- `donate` - An object containing information on how to donate to the plugin author (you!). The object can contain any of the following fields:
    - `paypal` - Your paypal email address.
    - `flattr` - The URL to your [Flattr](https://flattr.com/) page.
    - `bitcoin` - Your Bitcoin address.

    For example:

    ```json
    "donate": {
        "paypal": "supporters@matomo.org",
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
            "issues": "https://github.com/matomo-org/matomo/issues",
            "forum": "https://forum.piwik.org",
            "irc": "irc://freenode/piwik",
            "source": "https://github.com/matomo-org/matomo/",
            "wiki": "https://github.com/matomo-org/matomo/wiki",
            "docs": "https://piwik.org/docs/",
            "rss": "https://piwik.org/feed/"
    }
    ```


- `preview` - Preview lets you define a demo link and a video. If defined, they will be visible in the "Preview" tab of your plugin. The object can contain any of the following fields:
    - `demo_url` - A URL to a demo of your plugin
    - `video_url` - A YouTube URL to showcase your plugin. The URL has to be as in the example below. This means a YouTube URL has to start with `https://www.youtube-nocookie.com/embed/`.


    ```json
    "preview": {
        "demo_url": "https://demo.piwik.org",
        "video_url": "https://www.youtube-nocookie.com/embed/Aaa_111HHH"
    }
    ```


- `archive` - Lets you define some options for creating Piwik Plugin archives.
    - `exclude` - Allows you to configure which files or directories should be removed from the ZIP file when a user downloads or installs a plugin. It is not possible to use any wildcards and the path must start with a leading slash `/`. By default, a few directories and files are always removed from the ZIP archive: the directories `.github`, `tests`, `Test` and `screenshots` as well as the files `.gitattributes` and `.gitignore` found in your plugin's root directory.

    ```json
    "archive": {
        "exclude": ["/builds", "/test.log"]
    }
    ```

- `wordpress-compatible`: A boolean value defining whether this plugin works in Matomo for WordPress. By default it is enabled and the Marketplace makes your plugin automatically compatible with WordPress.
- `onpremise-compatible`: A boolean value defining whether this plugin works in Matomo On-Premise. It should usually not be needed to set this flag to disable it. If the plugin works only with WordPress, we recommend publishing it on the WordPress Marketplace instead.

- `category`: A category to help group the plugin with similar plugins on the Marketplace. The available options are:
  - `customisation` 
  - `database` 
  - `development` 
  - `insights` 
  - `integration` 
  - `security`

    For example:

    ```json
    "category": "customisation"
    ```

Here is a complete example to get you started:

```json
{
    "name": "MyPlugin",
    "description": "This is a short description that will be displayed on the Marketplace.",
    "version": "0.1.0",
    "license": "GPL-3.0+",
    "keywords": ["myplugin"],
    "homepage": "https://piwik.org",
    "authors": [
        {
            "name": "Piwik",
            "email": "hello@matomo.org",
            "homepage": "https://piwik.org"
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
        "issues": "https://github.com/matomo-org/matomo/issues",
        "forum": "https://forum.piwik.org",
        "irc": "irc://freenode/piwik",
        "source": "https://github.com/matomo-org/matomo/",
        "wiki": "https://github.com/matomo-org/matomo/wiki",
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

The marketplace uses [GitHub](https://github.com) webhooks to learn about your plugin and serve it to Piwik users that want it. This means you don't manually upload any files to the marketplace. Instead, you put your code into a GitHub repository and let the marketplace know about it.

Creating and initializing a [git](https://git-scm.com) repository on GitHub is out of the scope of this guide. If you need to learn how to create a GitHub repository, [read this article](https://help.github.com/articles/create-a-repo).

### Activate the Piwik Plugins webhook

Once your plugin is in a GitHub repository, you need to let the marketplace know about it. This is done by activating the Piwik Plugins webhook.

To activate this webhook, follow these steps:

1. Go to your plugin's GitHub repo in a browser.
2. Click on **Settings**
3. Click on **Webhooks**
4. Click on **Add webhook**
5. Enter "https://plugins.matomo.org/postreceive-hook" as Payload URL.
6. Any content type will work (JSON or URL encoded)
7. Ensure "Just the push event" and the "active" checkbox is selected (default)
8. Click the **Add webhook** button.

The marketplace will now be notified every time you push a commit or a tag to your repository.

![](/img/github_webhook.png)

### Publish the first version of your plugin

You can now publish the first version of your plugin. First, make sure the version in your `plugin.json` is `0.1.0`. Then, we'll run two git commands to publish a version of your plugin:

```
$ git tag 0.1.0
$ git push origin --tags
```

Every time you push a new tag to your GitHub repository, a new version of your plugin will become available in the marketplace. Alternatively you can also create the tag by [creating a release](https://help.github.com/articles/creating-releases/) on GitHub. The name of the tag doesn't matter, the marketplace will always use the version in your `plugin.json` file.

**Assuming all goes well, your plugin should be visible on the marketplace within a couple of minutes. Congratulations!**

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

If you still encounter trouble while publishing your plugin, please join the IRC channel **#piwik** on [freenode](https://freenode.net/). If you can't find anyone in the IRC channel, please ask for help [on the forums](http://forum.piwik.org/).

## Rules for Plugins

There are some restrictions regarding what can be published on the marketplace. Chances are your plugin is fine, but if we find a plugin that violates one of the following rules, it will be immediately removed:

- Your plugin must not do anything illegal, or be morally offensive.
- Free plugins must have their license compatible with the [GNU General Public License v3](https://www.gnu.org/copyleft/gpl.html) or any later version. We strongly recommend using the same license as Piwik (*GPL-v3.0 or later*). Your free plugin should not contain obfuscated code. We believe that obfuscated code violates the spirit, if not the letter, of the GPL license under which we operate. If you don't specify a license anywhere in your plugin, it is assumed your plugin uses *GPL-3.0+ or later*.
- No **[phoning home](https://en.wikipedia.org/wiki/Phoning_home)** without the user's informed consent. For the purposes of a Piwik plugin, **phoning home** includes:
  - Unauthorized collection of user data. For example, sending the admin's email address back to your own servers without the user's permission is not allowed; but asking the user for an email address and collecting if they choose to submit it is fine. All actions taken in this respect MUST be of the user's doing, not automatically done by the plugin.
  - All images and scripts shown should be part of the plugin. These should be loaded locally. If the plugin requires data that is loaded from an external website (such as [blocklists](https://en.wikipedia.org/wiki/Blacklist_%28computing%29)) this should be made clear in the plugin's admin screens or its description. The user must be informed of what information is being sent where.
- Matomo comes with various useful libraries, such as jQuery, Vue.js, PHP-DI, Monolog, and more. For security and stability reasons, plugins may not include any library that is already included with Matomo. Instead, plugins must use the versions of the libraries that are packaged with Matomo. As Matomo comes with various APIs for example for sending mails, you should use these APIs and not include your own mailer library.
- The plugin page, contents of the `README.md` file and all translation files may not have "sponsored" links in them. This applies to all content that will be displayed on [plugins.matomo.org](https://plugins.matomo.org) and [themes.matomo.org](https://themes.matomo.org).
- The plugin cannot violate our [trademarks](https://matomo.org/trademark/). Do not use **piwik** or **matomo** in your domain name, instead come up with your own original branding! People remember names.
- 6 months after a major Matomo version is no longer supported, we will remove any plugin version from the Marketplace that supports only this no longer supported Matomo version. For example when Matomo 2.X reaches its end of life in December 2017 (receives no longer any updates nor security fixes), we will remove all plugin versions that target only Matomo 2.X in June 2018. This may cause a plugin to disappear from the Marketplace when there is no longer any up to date version. Please note it is always recommended to update to a supported Matomo version in order to still receive updates and security fixes.

## Using the marketplace

Now that you've gotten your plugin on the marketplace, it's time to learn how to use it. This section will explain how you can the most out of the marketplace.

### Your plugin's page

Every plugin gets its own page on the marketplace. On the top is the name and a short description of your plugin followed by a set of tabs.

![](/img/marketplace-plugin.png)

The contents of the tabs are determined by the description section in the `README.md` file, the `CHANGELOG.md`, `docs/index.md` and `docs/faq.md` file. See this [plugin](https://github.com/tsteur/piwik-livetab-plugin) for an example.

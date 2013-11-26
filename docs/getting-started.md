# Getting started extending Piwik

<!-- Meta (to be deleted)
Purpose:
 - tell people what's possible by extending Piwik
 - tell people we don't really know what isn't possible so feel free to try everything!
 - get people setup and ready to create a plugin
   - mention phpstorm (it appears to be important)
   - mention command line tool
   - get people to install piwik locally
   - create a site or two
   - add some test data
 - show people how to create a plugin
   - don't use command line tool until the end
 - point people in the right direction for whatever they are trying to do (tell them what to read)

Audience: someone who uses Piwik or knows Piwik is an analytics tool and wants to extend it. He/she might be a user that knows what Piwik can do and wants it to do more, or a user of another piece of software that wants it to work w/ Piwik.

Expected Result: the reader must both know how to get Piwik running locally, have a new, empty plugin ready and know where to go to figure out exactly what it is they want to do.

Notes: This guide is a cross between a tutorial & a guide. It should be linked to as introductory material in the tutorials (in other words, there shouldn't be another 'getting started' tutorial).

TODO: (stuff that needs to go in SOME guide)
- DataTable row actions

TODO: removed scheduled reports guide. should be replaced w/ two tutorials (new output format + new transport medium)
-->

So you're a Piwik user and you need Piwik to do something it doesn't do. Or maybe you're a user of another web app and you want to integrate it with this amazing analytics software you've heard so much about (Piwik, naturally). Well, you've come to the right place!

This guide will show you:

- **how to get your development environment setup,**
- **how to create a new Piwik Plugin,**
- **and where to go next to continue building your extension.**

## Piwik Plugins

Pretty much all the functionality you see when you use Piwik is provided through **_Piwik Plugins_**. The core of Piwik (unsurprisingly termed _**Piwik Core**_) contains the tools that the plugins use to provide this functionality. If you wanted to add more functionality to Piwik you'd create your own plugin and distribute it on the [Piwik Marketplace](#) so other users could use it.

_Note: If you want to integrate another piece of software with Piwik and you only need to know how to track visits or how to retrieve reports, read more about the [Tracking API](#) and the [Reporting API](#)._

### What's possible with Piwik plugins?

Here are some of the things you could accomplish through your own plugin:

- track new visitor data and create new reports that aggregate the new data
- track third party data and display it in new reports
- show existing reports in novel new ways
- send scheduled reports through new mediums or in new formats

These are only a few of the possibilities. Many of the existing plugins do things that cannot be categorized in such a way. For example, the [Annotations](#) plugin lets users create save notes for dates without needing any modifications to **Piwik Core**. The [DBStats](#) plugin will show users statistics about their MySQL database. The [Dashboard](#) plugin provides a configurable way to view multiple reports at once.

**Whatever ideas your imagination cooks up, we think it's highly probable you can implement them with Piwik.**

### What's not possible with Piwik plugins?

Well, we're not really sure. It might be hard to get your idea to scale, or maybe your idea involves creating some hardware that you have to distribute, but these problems can all be overcome in some way.

**Right now, we think _anything_ is possible with Piwik, and we want YOU to prove us right!**

## Guide Assumptions

This guide assumes that you, the reader, can code in PHP and can setup your own local webserver. If you do not have these skills, you will not be able to successfully understand this guide.

TODO: resources for learning PHP and setting up a localhost server

## Getting setup to extend Piwik

### Get the appropriate tools

Before we start extending Piwik, let's make sure you have the tools you'll need to do so. Make sure you have the following installed:

- **A PHP IDE or a text editor.** We who work on Piwik reccommend you use one of the following tools:
  - [PHPStorm](#) &mdash; a very powerful IDE built specifically for developing in PHP. Lets you debug PHP code.
  - [Sublime Text](#) &mdash; a powerful and attractive text editor that can be used to program in almost any language, but it might not help you debug your PHP code.
  - ??? TODO
- **A webserver,** such as [Apache](#) or [Nginx](#).
- **[git](#)** so you can work with the latest Piwik source code.
- **[composer](http://getcomposer.org/) so you can install the PHP libraries Piwik uses.
- **A browser,** such as [Firefox](#) or [Chrome](#). Ok, so this you've probably got.

The following tools aren't required for this guide, but you may find them useful when you continue writing your plugin:

- **[PHPUnit](#)** Necessary if you want to write or run automated tests.
- **[xhprof](#)** If you'd like to profile your code and debug any inefficiencies. See also [our guide for installing xhprof](#).
- **[python](#)** If you're going to be doing something with the log importer.

### Get & Install Piwik

Now that you've got the necessary tools, you can install Piwik. First, we'll get the very latest version of Piwik's source code using git.

Open a terminal and `cd` into the directory where you want to install Piwik. Then run the following command:

    git clone https://github.com/piwik/piwik piwik

Then run the following command to install some third party libraries:

    composer.phar install

Now that you've got a copy of Piwik, you'll need to point your webserver to it. The specific instructions for configuring your webserver depends on the webserver itself. You can see instructions for Apache [here](#) and instructions for Nginx [here](#).

Once your webserver is configured, load Piwik in your browser by going to the URL `http://localhost/`. Complete the installation process by following the instructions presented to you.

### Add some test data

You've got the necessary tools and Piwik itself. You're ready to create your first plugin now, but before we do that, let's add some test data for you to play with.

In your browser load Piwik and navigate to _Settings > Plugins > Manage_. Look for the _Visitor Generator_ plugin and enable it. Then on the admin menu to the left, click on _Visitor Generator_ (under _Diagnostic_).

On this page you'll see a form where you can select a site and enter a number of days to generate data for:

TODO: image goes here

Let's generate data for three days. Enter **3** in the **Days to compute** field, check the **Yes, I am sure!** checkbox and click **Submit**.

Now click on the **Dashboard** link at the top of the screen. You should see that reports that were previously empty now display some statistics:

TODO: image goes here

## Create a plugin

You're development environment is setup, and you are now ready to create a plugin! Creating a plugin consists primarily of creating a couple files. Piwik comes with a handy command-line tool that will do this legwork for you. In the root directory of your Piwik install, run the following command:

    ./console generate:plugin --name="MyPlugin"

Replace **MyPlugin** with the name of your plugin (for example, **UserSettings** or **DevicesDetection**).

In your browser load Piwik and navigate to _Settings > Plugins > Manage_. Look for your plugin in the list of plugins, you should see it disabled:

TODO: image goes here (use disabled MyPlugin image)

<a name="plugin-directory-structure"></a>
**Plugin directory structure**

The command-line tool will create a new directory for your plugin (in the **plugins** sub-directory) and fill it with some files and folders. Here's what these files and folders are for:

* **API.php**: Contains your plugin's API class. This class defines methods that serve data and will be accessible through Piwik's [Reporting API](#).
* **Controller.php**: Contains your plugin's Controller class. This class defines methods that generate HTML output.
* **MyPlugin.php**: Contains your plugin's Plugin Descriptor class. This class contains metadata about your plugin and a list of event handlers for Piwik events.
* **plugin.json**: Contains plugin metadata such as the name, description, version, etc.
* **README.md**: A dummy README file for your plugin.
* **javascripts**: This folder is where you'll put all your new JavaScript files.
* **screenshots**: TODO: ???
* **templates**: This folder is where you'll put all your [Twig](http://twig.sensiolabs.org/) templates.

## Make your plugin do something

For this guide we don't really want to do anything complicated, so we'll just add a new page to Piwik that executes some JavaScript. In the plugin descriptor class ()
TODO (quickly explain the following:
- events
- idSite/period/date query parameters
- report basics (two-dimensional array w/ label as a column (usually))
)

## What to read next

Ok! You've set up your development environment and created your plugin! Now all you have to do is make do what you want. The bad news is that this is the hard part. The good news is that we've written a bunch of other guides to help you shorten the learning curve.

**_Note: Our guides are great, but if you learn better through examples or just don't want to do a lot of reading, why not check out our [tutorials](#)? We've written one for everything we think you might want to do._**

Based on what you want your plugin to accomplish, here's what you might want to read next:

* **If **


TODO: make sure the below are in the list directly above this.
**The Console Tool**

The **console** tool we just used can do more than create a new plugin. If you'd like to know more about what it can do, you can read about it [here](#).

### Plugin Debugging Tools (FIXME: Tools is a bad word...)

**Test Data Generation**

**Logging**

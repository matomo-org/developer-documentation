---
category: DevelopInDepth
title: Maintaining Plugins
---
# Matomo core - Maintaining Plugins

This guide applies to Matomo core developers. If you develop a plugin and want to share it as a contributor please check out the guide for [distributing plugins](https://developer.matomo.org/guides/distributing-your-plugin).

## How to add a new plugin

* Follow the internal process `Creating a new GitHub repository` to create a new GitHub repository under `matomo-org`. The name for the plugin usually starts with `plugin-` followed by the plugin name. You can for example ping us in our slack. We use `*.x-dev` as the main branch where `*` would be replaced by the latest major version of Matomo.
  * After creating the repository, we should also configure it for translation in [Weblate](https://hosted.weblate.org/projects/matomo/). To do this,
  * go to Repository Settings -> Webhooks 
  * create a webhook with `https://hosted.weblate.org/hooks/github/` as the Payload URL
  * create a component on Weblate with this plugin's repository as source
* Push the code
* Add the plugin's repository as a submodule to our main matomo repository `git submodule add {http-plugin-github-address} plugins/{pluginname}`
* Edit `.gitmodules` and move the entry for this submodule before the comment at the bottom (see description of that comment)
* It's expected that some core screenshots will fail and maybe also some integration or system tests as the plugin will be activated and the tests for this plugin run during core tests too. This is because we consider the plugins bundled w/ core to be tested this often (testing compatibility on every matomo change). Otherwise the tests would only run when the plugin changes, even though a change in core could cause problems.
* In Manage -> Access give the "core team" and the "plugin reviewers" team write access. Add the "product management" them and give it triage access.
* In Manage -> Branches protect the branch `*.x-dev` and only allow the "plugin reviewers" team to merge into these branches.

### GitHub tests

Go to [Matomo-org secrets](https://github.com/organizations/matomo-org/settings/secrets/actions) and change the `ARTIFACTS_PASS` secret to allow the repository to access this secret. To do this, follow below steps for each secret:

* Click on Edit icon
* Click on the cog icon
* Find the repository for this plugin / feature and enable it
* Click on “Update selection”
* Click on “Save changes”

### New plugin checklist

* The new plugin has a `LICENSE` file similar to https://github.com/matomo-org/plugin-QueuedTracking/blob/5.x-dev/LICENSE
* The same license is also defined in `plugin.json`
* A descriptive description and useful keywords are configured in `plugin.json`. Same for other values in the plugin JSON file.
* If any possible screenshots are defined in the `screenshots` folder.
* If `docs/index.md` or `docs/faq.md` are not needed then delete them

## Work on a premium plugin

* Clone the plugin you want to work on into the _plugins_ folder. Use the plugin name as the folder: `plugin_SomeName` -> `SomeName`
* Create (or update if you already have it) a `.gitignore` file in your _plugins_ folder and add the new folder. This `.gitignore` file is already ignored in the main `.gitignore`
* Activate the plugin on the Administration dashboard, _System > Plugins_ page
* You can create branches, PRs inside this plugin folder
* To configure the plugin for GitHub action tests and more please see the steps described in the internal doc `Build and launch a new Premium Plugin`.

---
category: DevelopInDepth
---

# Release Management

## Versioning

We follow [semantic versioning](https://semver.org/) where a version number looks like this: `MAJOR.MINOR.PATCH`. 

## New release (patch, minor or major)

* We first release one or multiple beta versions while working on a release.
* Once all features and fixes have been implemented we release an RC (release candidate). 
* Along with the RC we create a new branch called `next_release`.
  * Any regression fix or very important bug fixes that have a low risk for side effects can be merged into the `next_release` branch if this needs to be included in the next release. We then release another RC (which depends on things like time left to the release, whether other changes will be merged into `next_release` as well etc). The release manager should be notified to trigger a new release. It's not needed to create another PR for `*.x-dev` for the same change, as we merge the changes from `next_release` into `*.x-dev` after the release.
  * Any other change can be merged into `*.x-dev` as usual and won't be included in the upcoming release.
* We usually run the RC for a minor release for at least a week, for major releases multiple weeks and for patch releases at least one day but better multiple days.
* Once a new release has been released, we create a PR to merge the `next_release` branch into `*.x-dev` [see changes](https://github.com/matomo-org/matomo/compare/4.x-dev...next_release). The release manager will do this.
* Should a patch release be needed, then we repeat this process. We create a branch `next_release` off the branch of the last release (not off `*.x-dev`). Any patch fix will need to be made against the `next_release` branch.

## New patch releases

We aim to only merge changes that either:

* fix a regression 
* or they fix an important bug and there is basically no risk of introducing new regressions

The goal is to not introduce new regressions in a patch release. These releases should also be released fairly soon after a minor or patch release depending on the severity of the regressions.

If there are any other changes or even new features then we instead release a new minor version.

## New major releases

Short guide on what to do when working on a new major release

### Moving core plugins to the Marketplace

For any plugin that will be moved to the marketplace make sure the plugin has a `plugin.json` file and a fixed version number set. We would set the version number to the current core version and it should not be needed to increase that version number. This should ensure Matomo will find the plugin on the marketplace.

Users that upgrade from a version older than Matomo 3.14.1 that plugin will be deactivated after the upgrade. However, even after updating the plugin it will stay deactivated and we cannot automatically activate it because we can't know whether it was activated previously. If still too many people are on a version pre 3.14.1 then would maybe need to ship the plugin that was moved to the marketplace for a few months with core: https://github.com/matomo-org/matomo-package/pull/112 and only later remove it. In that case we should maybe also add an update/migration similar to this for the plugin: https://github.com/matomo-org/matomo/pull/16323/files (could refactor code to make it reusable by passing plugin names as an array). However, all this is really only needed for users upgrading from 3.14.1 or earlier. Because we now update plugins in a second step, any newly added plugin.json will be automatically found and everything should work as expected from 3.14.1.

For CustomVariables and Provider plugin the approach we went with is to include the plugins in core for say 6 months so most people will for sure not have any problem when upgrading (many users upgrade to next major version in 6 months). Then we stop and no longer include these plugins in core and people will start receiving the updates from Marketplace. If we include the plugins in the Matomo build script for say 6 months, then we also need to make sure these plugins cannot be uninstalled similar to https://github.com/matomo-org/matomo/pull/16734 see also https://github.com/matomo-org/matomo/issues/16517

### When starting to work on the next major release

#### The previous version becomes LTS and we take it seriously

As soon as we start working on the next major version of Matomo, we must STOP making any change to the current LTS version except critical security fixes and major data loss bugs.

If we don't stop making any change to LTS when we start working on the next major version, then we have a lot of merge pain and we cannot afford this.

Also, as soon as we start working on the next major version, we need to require every contributor to create a pull request against both branches, so we don't need to merge branches together which is too painful.

#### Preparation (before releasing the last minor version of the currently active major Matomo version)

* Define which PHP version the new major version of Matomo will require. To make this decision, we consider:
  * PHP versions that still receive security updates. Any PHP version that still receives security updates we would typically also support in the new major version.
  * Percent usage of our user base that use a given PHP version. See internal process `Find PHP usage statistics for Matomo` on how to get this data.
  * Important: The PHP version usage above does not include any information from our WordPress users. While on On-Premise we can offer security updates for older Matomo versions for users that cannot easily update to a newer PHP version, this is not the case for Matomo for WordPress. WordPress users often use older PHP versions, meaning we can quickly lose and disappoint 40% of the user base even if we only require a currently supported PHP version. This means we might even need to still support "not supported PHP versions". Ideally we find statistics on PHP versions used by WordPress installs to help make this decision.  
  * What PHP versions current Linux LTS versions support. Some LTS versions only support older PHP version.
  * Whether specific library versions that we absolutely need require a newer PHP version.
  * Are there any new features in a newer PHP version that would give us a competitive advantage to solve a specific problem we can't solve otherwise currently. Eg between PHP 7.2 and PHP 7.3 there weren't all that many useful new features, so it was an easy decision to rather still support PHP 7.2 and cause less problems for users.
  * If in doubt, we typically rather still support an older PHP version mainly for Matomo for WordPress reasons.
* In the last minor release of the currently active major release, make below changes:
  * Update the `getNextRequiredMinimumPHP` so that users not on the minimum required PHP version for the next major Matomo will see a warning in the admin pages 
  * Update the `notifyWhenPhpVersionIsEOL` method, so the notification pushes users to upgrade their PHP version to the latest. Refs https://github.com/matomo-org/matomo/issues/8847
* Release the last minor release of the currently active major release. The release should include the above changes regarding the min required PHP version.

#### Starting to work on the new major version

* Create a new branch in core that follows our standard, eg `5.x-dev` if next new major release will be `5`.
* Update the version in core in `Version.php` to `5.0.0-b1`
* For every plugin and premium feature that we maintain:
  * Create this new branch `5.x-dev`
  * Increase the required Matomo version to eg `"matomo": ">=5.0.0-b1,<6.0.0-b1"`
  * Set the version number to `5.0.0`
* Adjust the min required PHP version in tests yml, so we no longer execute the tests on the previously required min PHP version.
* Travis CI, see what we did for Matomo 3 in https://github.com/matomo-org/matomo/pull/8452#discussion-diff-35731015L93 and https://github.com/matomo-org/travis-scripts/pull/53 
  * Other changes may be needed for github tests
* Once the builds for `5.x-dev` branch succeeds, make it the default branch for Matomo core and all plugins
* Update the [submodule github action](https://github.com/matomo-org/matomo/blob/4.x-dev/.github/workflows/submodules.yml), [composer update action](https://github.com/matomo-org/matomo/blob/4.x-dev/.github/workflows/composer-update.yml), and the [CLDR action](https://github.com/matomo-org/matomo/blob/4.x-dev/.github/workflows/update-intl.yml) to use the new main branch.
* We can now start working and merging PRs for the next major release
  * We first start working on the big issues that take a very long to make sure they are finished by the time we want to release the first RC, and so they won't delay the release
  * We then start working on the issues that cause BC breaks, so we have plenty of time to adjust all the plugins, and also we indirectly test these changes sooner
  * The core team makes sure to communicate breaking changes to the plugins team so the plugins team can make the plugins compatible whenever there's a change. Sometimes the core team might also directly suggest PRs/changes to make a plugin compatible 
  * As always, we maintain the changelog for any breaking change

#### api.matomo.org

* In `config.ini.php` add two new release channels for this version. For example, when new major release is `5` as in `5.0.0` we need to add `path_latest_5x_stable` and `path_latest_5x_beta` release channels. We only need to add them for now, they can point to the same files as `latest_beta` (`LATEST_BETA`) and `latest_stable` (`LATEST`) for now. The Marketplace will use these release channels to check for latest available versions.
* In the `getLatestVersion` API method, request the required PHP version for the new major version similar to how it's done for the PHP version `7.2.5` to then serve the content of the version for the `latest_3x`.

#### demo2.matomo.org

* Get a DevOps to change the PHP version to the newly required minimum PHP version for this account
* If new major release will be `5`, make sure we check out the newly created `5.x-dev` branch regularly (ssh onto server, then `cd ~/www/demo2.piwik.org && git fetch --all && git checkout 5.x-dev` might make this work) 

#### plugins.matomo.org

* In `app/helpers` and `app/routes` search for `7.2.5` (this is the PHP version that Matomo 4 required) in the codebase and make adjustments similar to the existing code.

### At least 2 weeks before the first beta (at the earliest when all breaking changes are done)

Conditions:
* All breaking changes have been made in core. After this point, we wouldn't want to break any more changes unless we absolutely have to. This ensures that people who upgrade to the beta won't run into unexpected problems.

To be ready for the next step, the first beta release of core, we need to:

* Have every plugin made compatible with core (including premium features) 
* Have released a new version for every plugin (including premium features)
* We need to have the migration guide ready on developer.matomo.org. This is needed for writing the blog post in the next step. For further instructions see the next section.
* We publish a blog in the category `Development` on matomo.org for the developers we won't reach via email and also for people that don't publish the plugins on the Marketplace. We can reuse the content of https://matomo.org/blog/2020/08/matomo4-make-your-plugin-compatible-now/ .
* Email plugin developers this first beta is coming and that we're working on a new major release. (see internal process `How to notify plugin developers about an upcoming new Matomo major release`)

#### developer.matomo.org

* Follow steps as described in [README.md](https://github.com/matomo-org/developer-documentation/#how-to-add-docs-for-a-new-matomo-version)
* Replace all mentions of eg. `4.x-dev` by `5.x-dev` in the docs in  `docs/*.md` and `docs/5.x-dev/*.md` (for example [this page](https://github.com/matomo-org/developer-documentation/pull/233/files)). The files in `docs/4.x-dev` should remain unchanged.
* Document new APIs if there are any
* Create the new migration guide for plugins similar to [this migration guide](https://developer.matomo.org/guides/migrate-matomo-3-to-4). We create this guide even if there are no breaking changes for plugins.

### When releasing a first beta

Now that we have made all our plugins (including premium features) compatible with this version and have released a new version, we can release the first beta for core. This allows most people to upgrade smoothly. Users will run into problems though when they use third party plugins that aren't compatible with this new major version yet. This means features/plugins will be disabled for them, which can cause them issues. So we rather release a first beta bit later in the process in the hope that some plugins are already compatible.

Typically, at this stage the RC phase isn't far away and a first RC will follow within a couple weeks. Again, this is because we want to have ideally a few third party plugins compatible with this new version.

#### api.matomo.org

* After triggering the first beta release, edit `config.ini.php` and point the path of the latest release beta channel to the correct latest beta file. For example, if Matomo 5 beta is released, then change  `'path_latest_5x_beta' => __DIR__ . '/../LATEST_BETA'` to `'path_latest_5x_beta' => __DIR__ . '/../LATEST_5X_BETA'`.

#### Marketing

* Inform marketing team we're working on a new major release and that it is coming and in case they want to plan a blog and a newsletter just so they are aware of we will ping them at some point

### When releasing a first RC

We can release an RC as soon as we have implemented all features (and all breaking changes were already completed before the first beta).

The RC phase will be at least 4 weeks, so plugin developers have some time to make the plugins compatible. This way the RC will be also tested for longer.

Now the teams can already start working on the next minor release because we would only fix regressions and security issues etc in the `5.0` release. This means the team would then start working on the 5.1 release. Typically, this minor release will be  released shortly after the 5.0 release as the team would have had a month to work on this release while the RC is out.

#### demo.matomo.org

We update the demo to run this release candidate version (we could optionally also update to a beta version if we wanted/needed).

#### plugins.matomo.org

* In `app.default.php` config adjust `OLDEST_MAJOR_PIWIK_VERSION` and `LATEST_MAJOR_PIWIK_VERSION` as needed. For example increase `LATEST_MAJOR_PIWIK_VERSION`.
* Send an email to all plugins developers (see internal process `How to notify plugin developers about an upcoming new Matomo major release`)
* Check every plugin on plugins.matomo.org that hasn't been made compatible yet with the new release, and create an issue in their GitHub repository to make the plugin compatible.
  * Title: `Make plugin compatible with Matomo 5` (adjust version number)
  * Description:  (adjust version number and link to blog and date if needed)

```
Hi,

Thank you for contributing to Matomo by creating this plugin.

We wanted to let you know that we will release Matomo 5 in about one month.

For making it easy for Matomo users to be able to upgrade to this new Matomo version, it would be great if you could make this plugin compatible with Matomo 5. If your plugin is not compatible with Matomo 5, your plugin will be automatically deactivated when someone upgrades to this new Matomo version. 

Learn more about how to get your plugin ready: $linkToOurBlog

Please let us know if you have any question or if we can help in any way. We're happy to help.
```

#### Marketing

* Inform marketing team the release is coming and when in case they want to plan a blog and a newsletter

#### Communication of breaking changes

* If there are any unexpected breaking changes that could cause many people problems, then we consider creating dedicated blog posts for these to inform people upfront. These could be short posts.

### 1.5 weeks before the release

* Send an email to all plugin developers again as a reminder (see internal process `How to notify plugin developers about an upcoming new Matomo major release`)
* Look out for popular plugins on our Marketplace that aren't compatible yet and consider creating pull requests for these so the developer can merge and release it causing people less upgrade pain and causing users to lose less features and a better experience.

### When releasing

* Release the new core version and go through the regular process
* Marketing to release a blog post if there is one

#### api.matomo.org

* After triggering the first stable release of a new major version, edit `config.ini.php` and point the path of the latest release channel to the correct latest file. For example, if Matomo 5.0 is released, then change `'path_latest_5x_stable' => __DIR__ . '/../LATEST',` to `'path_latest_5x_stable' => __DIR__ . '/../LATEST_5X',`.

### Once a LTS version expires, we remove old plugins from the Marketplace

From the Marketplace, we will remove all plugins incompatible with the LTS version or latest stable. So around 12 months after the release of a stable version (for example Matomo 5), when the LTS for Matomo 4 period ends, we start removing plugins that are no compatible with Matomo 4 or Matomo 5.

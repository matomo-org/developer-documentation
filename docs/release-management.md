---
category: DevelopInDepth
---

# Release Management

## Versioning

We follow [semantic versioning](https://semver.org/) where a version number looks like this: `MAJOR.MINOR.PATCH`. 

## New release (patch, minor or major)

We first release one or multiple beta versions while working on a release.

Before releasing a new version we release an RC. As soon as an RC has been released we only merge important bug fixes but no other changes anymore. We usually run the RC for a minor release for at least a week, for major releases multiple weeks and for patch releases at least one day but better multiple days.

Once a new release has been released we wait for three days with merging PRs in case we have to do a patch release. Should a patch release be needed after the three days then we can create a branch eg `4.3.1` and merge patches into the branch and the main branch (eg `4.x-dev`).

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

as soon as we start working on the next major version of Matomo, we must STOP making any change to the current LTS version except critical security fixes and major data loss bugs.

If we don't stop making any change to LTS when we start working on the next major version, then we have a lot of merge pain and we cannot afford this.

Also, as soon as we start working on the next major version, we need to require every contributor to create a pull request against both branches, so we don't need to merge branches together which is too painful.

#### Matomo

* Create a new branch that follows our standard, eg `4.x-dev` if next new major release will be `4`.
* Create this new branch also for every plugin, increase the required Matomo version to eg `"matomo": ">=4.0.0-b1,<5.0.0-b1"` and set the version number to `4.0.0`
* Create new release channels to give users the options to stay on Matomo 4 or Matomo 4 beta in `plugins/CoreUpdater/ReleaseChannel/`. Remove the previous release channel eg Matomo 3 in this case.
* Update the `notifyWhenPhpVersionIsEOL` method so the notification pushes users to upgrade their PHP version to the latest. Refs https://github.com/matomo-org/matomo/issues/8847
* Update the `getNextRequiredMinimumPHP` so that users not on the minimum required PHP version for the next major Matomo will see a warning in the admin pages
* Adjust required PHP version in travis tests yml
* Travis CI, see what we did for Matomo 3 in https://github.com/matomo-org/matomo/pull/8452#discussion-diff-35731015L93 and https://github.com/matomo-org/travis-scripts/pull/53
* Create the `PULL_REQUEST_TEMPLATE` similar to https://github.com/matomo-org/matomo/pull/12412/files
* Once the build for 4.x-dev succeeds, make it the default branch for Matomo and all plugins

#### api.matomo.org

* In config add new release channels for this version. For example when new major release is `4` as in `4.0.0` we need to add `latest_4x` and `latest_4x_beta` release channels. We only need to add them for now, they can point to the same files as `latest_beta` and `latest_stable` for now. The Marketplace will use these release channels to check for latest available versions.
* In the getLatestVersion API method request the required PHP version for the new major version

#### demo.matomo.org

* If new major release will be `4`, create demo4.matomo.org and make it checkout the newly created `4.x-dev` branch regularly

#### plugins.matomo.org

* Search for `5.` or `7.` in the codebase
* for example in `app/helpers/Api.php` we have `5.3.3`

See https://github.com/matomo-org/matomo-marketplace/wiki/New-Piwik-version

### When releasing a first beta

#### matomo-package build script

* [in `scripts/build.sh`](https://github.com/matomo-org/matomo-package/blob/master/scripts/build-package.sh), edit `CURRENT_LATEST_MAJOR_VERSION` and set it to the new major release eg. `4`

#### developer.matomo.org

* Follow steps as described in README.md: https://github.com/matomo-org/developer-documentation/#how-to-add-docs-for-a-new-matomo-version
* Replace all mentions of eg. `3.x-dev` by `4.x-dev` in the docs (for example [this page](https://github.com/matomo-org/developer-documentation/pull/233/files))
* Start documenting new APIs and migration guide

#### plugins.piwik.org

* Increase latest major version in config

### When releasing a first RC
* Merge `3.x-dev` into master??

### When releasing

### Once a LTS version expires, we remove old plugins from the Marketplace

From the Marketplace, we will remove all plugins incompatible with the LTS version or latest stable. So around 12 months after the release of a stable version (for example Matomo 5), when the LTS for Matomo 4 period ends, we start removing plugins that are no compatible with Matomo 4 or Matomo 5.

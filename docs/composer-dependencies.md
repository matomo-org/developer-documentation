---
category: DevelopInDepth
---
# Composer dependencies

Matomo requires various packages to run. Those requirements are managed using [Composer](https://getcomposer.org/).

## Adding new requirements

If for some reason a new requirement would be needed, we need to require it using composer.

```bash
composer require package/name ^1.2.3
```

If the required package is used for development only, it should be excluded for other environments using:

```bash
composer require-dev package/name ^1.2.3
```

## Update workflow

### Minor or patch release update

Almost all requirements in our `composer.json` are defined in a way that allow minor and/or patch release updates without any adjustments in `composer.json`.
As there are normally no problems expected for those updates there is an [automatic GitHub action](https://github.com/matomo-org/matomo/blob/4.x-dev/.github/workflows/composer-update.yml) that automatically checks for updates and creates a Pull Request if any are available.

### Major updates

Every 6 months we should check for possible major updates of our requirements. These can only be upgraded if:

* There is a severe security fix that's exploitable for that component
* It still supports the same minmimum PHP version

In other cases we usually cannot upgrade to a major update and need to wait for the next Matomo major release. This is to keep backwards compatibility with Matomo for WordPress, the Cloud, and also all the third party plugins on the Marketplace and the many more that aren't on the Marketplace. 

There are no breaking changes is usually not a reason to be able to upgrade since there is usually always a breaking change, even if it's just a method definition that changes and then causes issues for Matomo for WordPress.

For Matomo for WordPress major component updates cannot only cause issues with code that we manage, but also cause compatibility issues with the over 50,000 WordPress plugins that may use a different version of that component. Most WordPress plugins use older versions of these components where they have different classes and different method definitions and from past experience this will cause Matomo for WordPress to break suddenly, sometimes even their entire WordPress installation. This can be especially annoying with Auto-Updates in WordPress etc. We wouldn't want to break someone's installation in a minor version update whenever possible.

Support for a newer PHP major version may be a reason to upgrade a component. However, if any possible we want to avoid this and rather fork the component and apply the fixes ourselves assuming it wouldn't be a 4+ days of work to do this. If it's a lot of work then we would need to assess the risk together.

#### Checking for possible updates

Composer allows viewing all available updates for installed packages:

```bash
composer outdated
```

#### Updating the requirements

If there are major updates available we should go through them and update each. As some updates might require code changes on our side it is best to only update one requirement after the other. Otherwise it will be harder to identify why e.g. some code breaks or why some tests start failing.
Updating a single requirement can be achieved this way:

* Update the version number for the updated component in [matomo/composer.json](https://github.com/matomo-org/matomo/blob/4.x-dev/composer.json) if needed
* Execute `composer update --with-dependencies package/name`. You need to replace `package/name` with the name of the requirement, like `phpmailer/phpmailer`. 
* Commit & push `composer.json` and `composer.lock`.
* Check if any tests are failing and adjust the code / tests if needed.
* Create a PR and get it merged.

*Note: we use the `--with-dependencies` option, to ensure all dependencies are updated if needed.*

#### Problems with incompatible requirements

It might be possible that updating some dependencies might not work due to the PHP version requirements of Matomo. 
Some packages like `PHPUnit` might already require a higher PHP version than Matomo. 
This causes composer not to update to newer versions or a composer install to fail when updating the dependency in `composer.json`.

If an update to a newer version is mandatory there are basically two possible options
* Increase the PHP version requirement (which is usually only done for major releases)
* create a fork of the package and lower the minimum requirement (if the code really works with our minimum PHP requirement)

*Note: If you want to install newer requirements locally for testing purpose, you can achieve this using the `--ignore-platform-reqs` option of composer.*

### Updating internal packages

We are managing some of our [core components](/guides/core-components) and libraries through composer as well. Whenever we release a new version of those packages we should directly issue an update of the composer requirement in Matomo.

* Update the version number for the updated component in [matomo/composer.json](https://github.com/matomo-org/matomo/blob/4.x-dev/composer.json) if needed
* Execute `composer update matomo/$COMPONENT_NAME`. You need to replace `$COMPONENT_NAME` with the name of the component. For the cache component you may need to execute `composer update matomo/cache  matomo/doctrine-cache-fork`.
* Push `composer.json` and `composer.lock`.
* Create a PR and get it merged.

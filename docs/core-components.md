---
category: DevelopInDepth
---
# Core Components

As part of Matomo we maintain a few components which we embed into core using composer packages. [See the list of components on GitHub](https://github.com/matomo-org?q=component&type=&language=&sort=).

## Updating a component

### Step 1: releasing a new version 

* Create a pull request as usual and get it merged
* Then go to `Releases` in GitHub for the repository
* Click on `Draft a new release`
* Enter the version number and release title. We usually enter for both the same value. The new version number should be higher than before and use [Semantic Versioning](https://semver.org/).
* Click on `Publish release`.
* The newly published version should then populate on [Packagist](https://packagist.org/?query=matomo).

### Step 1B: Special step only needed for doctrine cache fork matomo-org/cache

* You need to increase the required version number in [component-cache/composer.json](https://github.com/matomo-org/component-cache/blob/2.0.3/composer.json#L26) see [example PR](https://github.com/matomo-org/component-cache/pull/32).
* Basically you require the newly released version number and then run `composer update matomo/doctrine-cache-fork`.
* Push `composer.json` and `composer.lock`.
* Create a PR and get it merged.
* Release a new version for the component cache which is same as step 1.

### Step 2: Updating the component in Matomo core

* Update the version number for the updated component in [matomo/composer.json](https://github.com/matomo-org/matomo/blob/5.x-dev/composer.json) if needed 
* Execute `composer update matomo/$COMPONENT_NAME`. You need to replace `$COMPONENT_NAME` with the name of the component. For the cache component you may need to execute `composer update matomo/cache  matomo/doctrine-cache-fork`.
* Push `composer.json` and `composer.lock`.
* Create a PR and get it merged.

---
category: DevelopInDepth
---
# Contributing to Matomo Core

## About this guide

**Read this guide if**

* you've **found a bug, fixed it and want to know how to get your fix accepted upstream**
* you're **interested in contributing changes to Piwik and _want to know where to start_ or _want to know what the process is like_**
* you'd like to know **what Piwik developers consider to be good code**

**Guide assumptions**

This guide assumes that you:

* can code in PHP and JavaScript,
* can use the [git](https://git-scm.com/) source code management tool
* are familiar with [GitHub](https://github.com),
* and have the necessary tools to contribute to Piwik (if not, see this section of our [Getting started extending Piwik](/guides/getting-started-part-1) guide).
* you must have [git lfs installed](https://git-lfs.github.com/)

## Contribution process

The contribution process starts with a bug you want to fix or an idea that you want to implement. _If you don't have one, feel free to pick an open ticket on [github.com/matomo-org/matomo/milestones](https://github.com/matomo-org/matomo/milestones)._

Once you've decided on something, continue below.

### Getting confirmation the Matomo team is interested in the idea

Most of the issues in Matomo issue tracker are ideas and bugs that the Matomo team would like to implement or solve. However it is not always the case, and the Matomo team may not be interested anymore in some of the issues even though they are opened. 

Before you spend time working on a bug or idea, and risking it may not be merged eventually, then it is highly recommended that **you first leave a comment on the issue and explain that you are interested to contribute to the issue**. In your comment also explain how you plan on solving the bug or creating the new feature, and ask the team for a quick validation of your plan. This gives the Matomo team the opportunity to review your proposal and whether they want to see this added to Matomo, and provide you guidance early on. The team will reply to you in the issue and once they confirm, then you can confidently work on the issue and work towards opening a Pull Request.

### Getting a copy of Piwik to work on

Before you can start contributing you need to get setup with [git](https://git-scm.com/) & [GitHub](https://github.com). If needed, you can [create a GitHub account here](https://github.com/).

If you are a Matomo core developer then you have write permissions to the Matomo repository and therefore you don't need to fork Matomo and can skip below steps. Instead clone the [Matomo repository](https://github.com/matomo-org/matomo) and push to it directly. This will simplify a lot of your work.

#### Fork the Piwik repository

While logged in GitHub, visit [Matomo's repository](https://github.com/matomo-org/matomo). In the upper right corner there is a _Fork_ button. Click it. Github will copy the repository into your account. This copy (or fork) is the one you will work on. If you don't know forks, read more about [forks on GitHub](https://help.github.com/articles/fork-a-repo/).

#### Setup git

When committing, git will need to know your username and email. To set them, run the following commands:

```bash
git config --global user.name John Doe
git config --global user.email john@example.com
```

#### Clone the forked repository

Clone your Piwik fork (replace `myusername` with you GitHub user name):

```bash
git clone https://github.com/myusername/piwik
```

This will copy the entire forked repository (including all history) to the _piwik_ folder on your machine.

Now, we'll run one more command so git remembers the original Piwik repository in addition to your fork:

```bash
git remote add upstream https://github.com/matomo-org/matomo
```

This will save _https://github.com/matomo-org/matomo_ as a remote and name it _upstream_.

#### Configure PHP

Contributions should not generate PHP errors or warnings. Applying the following settings to your `php.ini` file will enable you to catch these errors:

```ini
display_errors  = On
error_reporting = E_ALL | E_STRICT
```

#### Install Composer dependencies

Matomo uses various libraries that are required for running Matomo. While they are included in the official releases, those [dependencies](/guides/composer-dependencies) needs to be installed manually when checking out from Git.
To install the requirements you need to [download / install composer](https://getcomposer.org/download/) and run the following command in the Matomo directory.

```bash
composer install
```

### Hacking Piwik

Now that you have a copy of the latest Piwik source code, you can start modifying it. For this section, we'll assume there's a bug that you found and want to fix.

#### Create a new branch

See our guide for [creating a new branch using git](/guides/git#creating-a-new-branch).

#### Work on the code

Once you've created a branch, you have a place to start working on the feature. There's nothing special about this part of the process, just fix the bug or finish the feature you're working on.

If you're working on something more complex than a bugfix, you may have the need to keep your new branch updated with changes from the main repository. Keeping your branch up to date is a two-step process.

First, on your **4.x-dev** branch, pull changes from the main Piwik repository, nicknamed _upstream_:

```bash
git pull upstream 4.x-dev
```

Then, on your new branch (**bugfix** for this tutorial), merge with **4.x-dev**:

```bash
git merge 4.x-dev
```

If there are conflicts, you can read this guide: [How to resolve Git conflicts](https://githowto.com/resolving_conflicts).

#### Save your changes

Now that you've finished the bug fix or new feature (or just part of it), it's time to commit your changes and push them to your fork (the `origin` remote).

```bash
git add ModifiedFile.php AnotherFile.js
git commit -m 'Added new feature: XYZ (replace this with a descriptive commit message)'
git push
```

You can read [this guide](https://www.atlassian.com/git/tutorials/saving-changes/git-add) to learn how to commit changes. You can read [this guide](https://help.github.com/articles/pushing-to-a-remote/) to learn how to push commits.

In a branch it's fine to commit often and regularly. Later, when the PR will be merged we always squash the PR meaning it will only become one commit and the PR title will become the commit message and the PR will be linked to find more information about the commit if needed. This means the individual commit messages aren't too important but should still be useful.

## Creating a pull request

Now that you have pushed your changes it's time to get your changes merged. To learn more about this read our [Pull Requests & Reviews guide](/guides/pull-request-reviews).

## Switching between branches

### Keeping dependencies up to date

Every time you change the branch you may need to run composer install (and maybe also npm install). You can automate this task by following these steps:

* Create a file called `.git/hooks/compile.sh` containing this content

```bash
#!/bin/bash

changedFiles="$(git diff-tree -r --name-only --no-commit-id ORIG_HEAD HEAD)"

runOnChange() {
	echo "$changedFiles" | grep -q "$1" && eval "$2"
}

runOnChange package-lock.json "npm install"
runOnChange composer.lock "composer install"
```

* Make sure the file can be executed: `chmod +x .git/hooks/compile.sh`
* Add below line to the end of the file `.git/hooks/post-checkout`

```bash
.git/hooks/compile.sh
```

It will only be executed when the composer or npm actually changes.

### Dealing with Matomo updates

When the version inreases and there is an update, the UI/API will automatically let you know that a [migration update](https://developer.matomo.org/guides/extending-database#defining-database-updates) needs to be executed. The UI will directly present the update screen where it asks you to execute any outstanding migration updates. The API will return an error message mentioning an update is available and then you need to open the UI to execute this update or run `./console core:update --yes`.

In some cases a required migration update may not be executed. This happens for example if you're working in a different branch where the version number is higher and meanwhile in eg `4.x-dev` an update was added for a lower version number. It also happens when you're working on the current version number and an update is added to the current Matomo version number without increasing the version number. Matomo will then think it already executed the update because the version number didn't increase. You can't really detect when this happens until you run into a problem because for example a column is missing. When this happens, you need to manually set back the version number of your Matomo in the database and run for example below queries:

```sql
-- you may need to replace the DB table prefix "matomo_" and you need to set the version number to the correct version number so the not executed update script will be executed.
set @current_version = (select option_value from matomo_option x where option_name = 'version_core');
update matomo_option set option_value ='{new_version_number_you_want_to_set}' where option_name like 'version_%' and option_value = @current_version;
```

Note: Matomo updates are designed to always be executed multiple times. If the update already happened, for example a column was already added, then Matomo will "detect" this and not error. 

### Downgrading Matomo updates (not possible)

Sometimes you may need to run some code on a previous version of Matomo, for example, making a change to Matomo 3. There's no
current way to downgrade a database (undo an update) so in this case you'll have to use an upgraded version of Matomo
with the older code.

In practice this means creating features that downgrade still work on older versions. The only exception being changing
major versions. In this case there will be documentation for how to manually downgrade a database so we can run the older
version (for example this faq: https://matomo.org/faq/how-to/how-do-i-downgrade-from-matomo-4-to-matomo-3/).

### Learn more about Updates and how to write them

See our docs on Updates if you need to make changes to matomo for your pull request: [https://developer.matomo.org/guides/updates-aka-migrations](https://developer.matomo.org/guides/updates-aka-migrations).

## Matomo Core code standards

See our [dedicated guide for Matomo Code Standards](/guides/coding-standards).

## Debugging

See our [debugging Matomo core guide](/guides/debugging-core).

## Submodules

Matomo has various submodules. These will be updated weekly automatically using a GitHub action. This means if you push something to a submodule, for example the Tag Manager, then you won't need to create another pull request in Matomo repository to update the submodule. In some cases, for example if an important fix was made shortly before a release then you may need to create a PR to update the submodule reference in the Matomo repository.

## Automated tests

If you are fixing a bug, it is usually better to also submit a testcase covering this fix. Such a test will be useful to prevent the bug from reappearing again in the future.

If you are adding a new feature to Piwik, adding a new API method or modifying a core Archiving or Tracking algorithm, generally it is required to also submit new or updated unit or integration tests.

For more information about running or creating tests, read our [Testing guide](/guides/tests).

When naming unit/integration tests, it helps to use the **Given**, **When**, **Then** convention for writing tests.

Tests are critical part of ensuring Piwik stays a stable and useful software platform. We aim to keep test code as clean as production code so it is easy to improve and maintain.

## Submitting a plugin for integration into Core

If you've already developed a plugin (congratulations!) which you think could be included in Piwik Core, you can offer it for inclusion.

The adoption of a plugin into Piwik Core requires that we consider such criteria as (but not limited to):

- audience: plugin appeals to a broad spectrum of users
- desirability: is it a frequently requested feature by the Piwik community?
- functionality: feature completeness
- testability: use of unit, integration and UI tests and impact to manual testing (e.g., differences when plugin is activated vs deactivated)
- maturity: history and popularity of the plugin
- performance: impact on archiving and/or UI interaction
- supportability: likelihood of spawning support tickets and forum posts of the "how do I?" or "why does it?" variety
- complexity: simpler is better; +1 if developer has git commit privileges
- dependencies: does it depend on closed source and/or paid subscription services?
- licensing: license compatibility with GPLv3

In most cases, it should be enough for your plugin to be available on the [Marketplace](https://plugins.matomo.org).


## Learn more

- learn **the basics of Piwik development** in [Getting started with plugins](/guides/getting-started-part-1).
- to see a **list of available things you could work on**, see our [upcoming milestone](https://github.com/matomo-org/matomo/milestones)
- learn **more about Matomo's tests** in our [Testing](/guides/tests) guide.

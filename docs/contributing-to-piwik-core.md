---
category: DevelopInDepth
---
# Contributing to Piwik Core

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

## Contribution process

The contribution process starts with a bug you want to fix or an idea that you want to implement. _If you don't have one, feel free to pick an open ticket on [github.com/matomo-org/matomo/milestones](https://github.com/matomo-org/matomo/milestones)._

Once you've decided on something, continue below.

### Getting a copy of Piwik to work on

Before you can start contributing you need to get setup with [git](https://git-scm.com/) & [GitHub](https://github.com). If needed, you can [create a GitHub account here](https://github.com/).

#### Fork the Piwik repository

While logged in GitHub, visit [Piwik's repository](https://github.com/matomo-org/matomo). In the upper right corner there is a _Fork_ button. Click it. Github will copy the repository into your account. This copy (or fork) is the one you will work on. If you don't know forks, read more about [forks on GitHub](https://help.github.com/articles/fork-a-repo/).

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

### Hacking Piwik

Now that you have a copy of the latest Piwik source code, you can start modifying it. For this section, we'll assume there's a bug that you found and want to fix.

#### Create a new branch

Before you start coding, you should make sure to keep your changes separate from the `4.x-dev` branch. This will make it much easier to track the changes specific to your feature since your changes won't be mixed with any new commits to the `4.x-dev` branch from other developers.

We'll give our new branch a name. The branch name ideally always contains the GitHub issue number eg `1111` or `m1111` or if it's a Jira issue then eg `dev-1111`. Optionally, a descriptive name can be added if wanted. It's not a requirement though since the branch usually exists only temporarily anyway and a PR with description etc often exists too. To add a new branch, run the following command:

```bash
git checkout -b bugfix
```

The checkout command will create a new branch if the `-b` option is supplied, otherwise it will try to load an existing branch.

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
git commit -m'Added new feature: XYZ (replace this with a descriptive commit message)'
git push
```

You can read [this guide](https://www.atlassian.com/git/tutorials/saving-changes/git-add) to learn how to commit changes. You can read [this guide](https://help.github.com/articles/pushing-to-a-remote/) to learn how to push commits.

In a branch it's fine to commit often and regularly. Later, when the PR will be merged we always squash the PR meaning it will only become one commit and the PR title will become the commit message and the PR will be linked to find more information about the commit if needed. This means the individual commit messages aren't too important but should still be useful.

### Creating a pull request

Now that your changes are published, you can send them in a pull request to the main Piwik project.

To do so, visit your fork on GitHub and select the **bugfix** branch in the branch selector (located right above the directory listing on the left side of the page). Then click the _Pull Request_ button in the middle of the top of the page.

On this screen you'll be able to see exactly what changes you've made by looking at your commits and at what files have been changed. You can use this as an opportunity to review your changes.

Read [Creating Pull requests: best practises](#creating-pull-requests-best-practises) to maximise your changes to create a great pull request.

Once you're ready to create the pull request, write a description of the pull request and any notes that are important for the person who will review your code, and then click _Send pull request_. This will create a new pull request which you will be able to find and view [here](https://github.com/matomo-org/matomo/pulls).

If the PR is ready for a review, assign the label `Needs Review` and put it in the correct milestone. The milestone for the PR is usually the same milestone as the original issue you worked on.  If there is an issue for this PR, then we also assign the label `Not In Changelog`. This prevents the same issue being listed twice in the changelog. A PR will only be reviewed when it has the `Needs Review` label.

If the PR is not ready for a review yet and the PR is in progress, then you can click on the link `Convert to draft` which you find in the Github PR UI below `Reviewers`. Once you finished the work for the PR and it's ready for a review, you can click on `Ready for review` where it says `This pull request is still a work in progress` and assign the labels as mentioned above.

For more PR best practices read below.

And if you are a core developer, if there is an issue that the pull request will fix, and the issue is in a milestone, set the milestone of the pull request to the same one as the issue.

#### Updating the pull request

Once your pull request is public, developers will review it and leave comments regarding what should be changed. You can then make changes, commit them and then push them to your remote repository (**origin**) and they will automatically be shown in the pull request.

#### Sharing test example pages

If you find yourself building a simple test page to test a certain feature (like a tracking feature or a certain widget), then it may be useful to contribute this examples to our [test examples](https://github.com/matomo-org/test-examples) repository so other people can reuse such a page.

## Creating Pull requests: best practises

Here are best practises we aim to follow when creating, reviewing and merging pull requests:

* We try to avoid big pull requests and aim for small PRs that are easier to review
* When issuing a PR we set a label `Pull Request WIP` and replace this label with `Needs Review` once the PR is done. If a PR references another issue we assign the label `not-in-changelog`. The PR author also assigns the PR to a milestone (usually the same milestone as the referenced issue).
* A PR should contain a description explaining things if useful. It should contain as much as necessary and as little as possible.
* Small changes can be merged directly without a review if the developer is 100% certain the change won't have any side effects etc. It is still always recommended to quickly ask another developer that is online to have a look at this PR now as such PRs are quickly reviewed.
* If a PR affects the [public API](https://github.com/matomo-org/matomo/issues/8125) in any way a PR should not be merged without a review
* PRs that affect the [public API](https://github.com/matomo-org/matomo/issues/8125) or that affect Security need a thorough review. For other PRs it is always good to keep in mind that we can change later at anytime. Things therefore don't have to be "perfect" as long as the formal requirements are given (eg. an entry in the developer changelog if needed)
* When reviewing a PR it is important to check things like Security, Performance, Usability, etc. Minor "issues/feedback" such as feedback on code style are less important. If a reviewer notices only such minor things, we can merge the PR directly or the reviewer can make the changes directly and merge afterwards.
* The reviewer selects "Approve / Reject changes / Comment" when finishing a review so it's clear if a 
PR is accepted or more changes are needed
* The PR author marks an individual review conversion/comment as resolved when the feedback was applied or notices/acknowledged (not always do need changes to be made for each comment as sometimes they are suggestions etc)
  * If further feedback is needed for the conversation/comment then PR author will ask the reviewer to confirm the conversation is resolved 
* The reviewer removes the label "needs review" when changes are required. No new label is added for now for simplicity (but could also add on)
* The PR author adds the label "needs review" again once it's ready for another review
* When a PR is approved and no further review required then we aim to directly merge the PR if the tests pass
  *  If a PR is approved overall but tests are failing then we might need another round of review (meaning reject the PR and remove `needs review` label)
  * unless it is only needed to update the expected test results then maybe the PR author could later fix the build and merge directly without yet another review (or maybe only if the PR reviewer mentions that only test )... could clarify this further in a team meeting some day
* Before working on a new issue it is recommended to check for pending PRs that have a `Needs Review` label
* PHP code should use our Piwik code standards (see next section)
* Pull requests should contain tests
* Read the article: [Pull Requests: How to Get and Give Good Feedback](https://www.kickstarter.com/backing-and-hacking/pull-requests-how-to-get-and-give-good-feedback)
* When a pull request has many small commits, it is recommended to [Squash commits](http://eli.thegreenplace.net/2014/02/19/squashing-github-pull-requests-into-a-single-commit) so that there is only one (bigger) commit.

## Switching between branches

### Keeping dependencies up to date

Every time you change the branch you may need to run composer install (and maybe also npm install). You can automate this task by following these steps:

* Create a file called ".git/hooks/compile.sh" containing this content

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

## Piwik Core code standards

The following are a list of guidelines and requirements for contributions to Piwik Core. Developers and teams interested in contributing should read through them before starting to contribute and before sending a pull request. **Contributions that are not up to these standards will not be accepted**.

### General Considerations

* **Write clear, easily understandable code.** Is your code easy to read? Would anybody understand what each line and function does immediately after reading them? Code that does not do anything complicated should be this easy to understand. Complex code should have extra documentation that will aid new developers in understanding it.

* **Reuse as much code as possible.** Have you removed any redundancies in your code? Have you made sure your code does not replicate existing functionality? Try to reduce the amount of code you need to write for your contribution.

* **Write _correct_ code.** Does your code handle all possible scenarios? Does your code handle all possible error conditions (including any corner cases)? Do existing tests pass for your contribution? Does your code generate any unwanted PHP errors or warnings? We do not want contributions that introduce new bugs.

* **Write _efficient_ code.** Does your code scale well? What happens when there are hundreds of thousands of websites and billions of visits? Please note any potential performance issues and whether they would be easy to fix. We know how hard it can be to scale efficiently, but we would like for Piwik to be as fast as possible.

* **Follow our [security guidelines](/guides/security-in-piwik).** We do not allow any security vulnerabilities in contributions.

### Specific Considerations

* **Add new configuration settings for fixed values that may users may change.** Does your code use constants that users may want to change? They should be made configurable.

* **Use automated testing to test your PHP.** If you've written new PHP code, have you created unit and integration tests for them? All code that could benefit from automated tests should have tests written for them. Read our [Testing guide](/guides/tests) to learn about it.

* **Internationalize your text.** If your contribution has text, is it loaded from a language file? We want all text in Piwik Core to be available in as many languages as possible. To learn more about i18n in Piwik read our [Internationalization](/guides/internationalization) guide.

* **Generate HTML in template files only.** Does your PHP code contain HTML? It shouldn't. All HTML generation should be handled by Twig templates.

* **If your contribution includes third-party components & libraries, make sure they include GPL compatible licenses.** Third-party components/libraries must be compatible with GPL v3 since this is the license used by Piwik.

* **Make sure your code follows the [PSR 1](http://www.php-fig.org/psr/psr-1/), [PSR 12](https://www.php-fig.org/psr/psr-12/) and [PSR-4](http://www.php-fig.org/psr/psr-4/) coding standards.**

* **Make sure your source code files are encoded in UTF8.**

* **Make sure lines end with Linux EOL markers (LF).** To learn how to let git manage line endings for you, read [this](https://help.github.com/articles/dealing-with-line-endings#platform-all).

### Coding Considerations

The following are a list of guidelines you should follow while writing code and architecting software.

#### Include Path

Piwik does not set or depend on the include path. Plugins should rely on the autoloader for classes and use the absolute path convention for other files:

```php
require_once PIWIK_INCLUDE_PATH . '/folder/script.php';
```

#### Basic Clean Code recommendations

About classes:

* Classes should follow the [Single Responsibility Principle](https://en.wikipedia.org/wiki/Single_responsibility_principle).
* Refactor classes and aim for files/classes that are at most 400 lines.
* Avoid classes with both public attributes and getters/setters. Choose to use getters and setters only when they make code easier to read.
* Add `private` keywords to class attributes when forgotten.

About methods and functions:

* Functions should follow the Single Responsibility Principle: each function should do only one thing.
* Think about whether you can refactor the function body into smaller private methods.
* Aim for a maximum of 20-30 lines per method.
* Aim for maximum three function parameters.
* Extract the body of the `try {}` blocks into their own private method.

Keep the following principles (from Alan Shalloway) in mind while writing code: cohesion, loose coupling, no redundancy, encapsulation, testability, readability, and focus.

#### Commenting

In order for new developers to get up to speed quickly and in order to lessen the amount of bugs Piwik will ever experience, the Piwik source code must be easy to understand. Comments, in addition to general code cleanliness, are important in achieving this goal.

> Comments are a central part of professional coding. Comments can be divided into three categories: **documentary** (serving the purpose of documenting the evolution of code over time), **functional** (helping the co-ordination of the development effort inside the team) and **explanatory** (generating the software documentation for general use). All three categories are vital to the success of a software development project.

> &mdash; [The fine Art of Commenting](http://www.icsharpcode.net/TechNotes/Commenting20020413.pdf)

For an example of a well commented Piwik class, see [Piwik\Cookie](https://github.com/matomo-org/matomo/blob/master/core/Cookie.php).

Despite their importance, comments can sometimes cause information overload - or worse for out-of-date comments. Useless or inaccurate comments and autogenerated comments that add no value should be avoided. Rather than writing comments inside a function, it is better to write shorter functions that do only one thing and are named thoughtfully. A well refactored class made of small methods will be easy to read and will not need many comments.

#### No duplication

**No duplication** is a basic and core principle of extreme programming and of writing good code in general. Write code **"Once, and only once"**, i.e. Don't Repeat Yourself. Do not duplicate code.

#### Debugging & logging

In Piwik you can easily log debug messages to files, the database or the screen by enabling logging in your config/config.ini.php file. In your code, you can then call one of the [Log](/api-reference/Piwik/Log) singleton's logging methods to log new messages.

You can also show the debug output on screen by appending &debug=1 to the URL: this allows you to test and view debug messages only when needed, but still leave debug logging enabled. **See the FAQ to [enable logging output in Piwik](https://piwik.org/faq/troubleshooting/#faq_115) and the various options.**

Piwik comes with a SQL profiler, which reports the time spent by each query, how many times they were called, the total time spent in MySQL vs PHP, etc. It makes it easier to check the performance and overhead of your new code. See the FAQ to learn how to enable [SQL profiling](https://piwik.org/faq/troubleshooting/#faq_115).

### Automated tests

If you are fixing a bug, it is usually better to also submit a testcase covering this fix. Such a test will be useful to prevent the bug from reappearing again in the future.

If you are adding a new feature to Piwik, adding a new API method or modifying a core Archiving or Tracking algorithm, generally it is required to also submit new or updated unit or integration tests.

For more information about running or creating tests, read our [Testing guide](/guides/tests).

When naming unit/integration tests, it helps to use the **Given**, **When**, **Then** convention for writing tests.

Tests are critical part of ensuring Piwik stays a stable and useful software platform. We aim to keep test code as clean as production code so it is easy to improve and maintain.

### Submitting a plugin for integration into Core

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

In most cases, it should be enough for your plugin to be available on the [Marketplace](https://plugins.piwik.org).

### For Core Developers: Reviewing Pull Requests

#### Reviewing Core Developer PRs

As core developers one of our primary responsibilities is to review and merge other pull requests. This document lays out the general process and things to look for.
In the pull request template on github, there is a checklist of reminders of what to look for. Here, we'll go into details:

#### Functional review done

For every pull request it is expected that the reviewer will actually check out the code locally and test it. We want to make sure it does the thing it's supposed to,
and handles any error conditions gracefully.

This means manually testing and looking for possible issues in the submitted code. It's required for pull request changes to have a visible effect on the tests
(in most cases), but we don't want to rely on them alone, since it's always a possibility for people to make mistakes. The review is a chance to catch them before they become bugs.

Any problems found in the logic of a change should ideally result in new tests.

#### Potential edge cases thought about

When manual testing it's also required to think about any edge cases that might occur and cause issues. Running Matomo in the cloud, we've learned that edge cases,
despite their name, do occur every now and then, and cause problems. It's far better to try and avoid these problems before we merge PRs.

Some starting points that could help when looking for edge cases:

- thinking about what happens in the code when given strange input
- thinking about whether it's possible for there to be strange internal state and what would happen if this occurred
- thinking about how this code interacts with the different Matomo subsystems

By nature, edge cases are hard to find, but it's definitely better to catch them beforehand, rather than have to debug cloud, or worse, debug a user's Matomo via email.

#### Usability review done

If a feature touches Matomo's UX in any way, Thomas and Matt are required to provide their input (ping them if needed). But, we also want developers to think about usability themselves.

When reviewing a pull request, think about whether it's possible that users may be confused by how it works, or unsure of how to use it. If there's a possibility that they might reach
out to support or the forums or make a github issue, then we'd like to prevent that, either with a change to the pull request, or by creating/editing a faq so we can address these
requests quickly.

#### Security review done

We also want to make sure there are no security issues introduced by this pull request. We've created a checklist here for some security issues to look out
for: [https://developer.matomo.org/guides/security-in-piwik#checklist](https://developer.matomo.org/guides/security-in-piwik#checklist), but there are many other ways vulnerabilities
can manifest. And we very much want to prevent any from getting into the codebase.

#### Code review done

The code review is just that, looking for mistakes in the code, along with ways the code could be clearer, just in case the pull request author missed something. If you see something
that could be done with less code, or see something that confuses you as another developer, please bring it up.

We also find that most review items are best stated as questions, and not as demands, in order to foster a more positive environment that values collaboration over argument.

#### Tests were added if useful/possible

We want to take advantage of the benefits of automated testing as much as possible. If a pull request can be tested, it should be. OR it should at least show a change in the
existing tests. This also helps to prove the feature or fix does what it's supposed to.

The level of testing would vary based on what is being reviewed, but some form of test is required, unless it is really not possible.

#### Reviewed for breaking changes

If a change touches something users actively use or a piece of code that is considered public API for plugin developers or those integrating Matomo, then we want to make sure our
change doesn't break anything these users and developers might currently be doing.

This is fairly simple for code (for example, if we add a new parameter to a function considered public API we want to make sure it has a default value, so people currently calling
it won't encounter an error after updating Matomo). It's, unfortunately, a bit more complicated with users. There are many ways users manage to use Matomo, and keeping things working
the way they currently want it can be a challenge.

We want to make sure API methods still behave as they did before for the same inputs, old links still go to the same pages, CLI commands do not fail because parameters were removed,
and many other things. It can be hard to consider given there are so many ways we can break something for a user, but it's definitely important to keep our users workflows working.

#### Developer changelog updated if needed

The developer changelog is located at [https://github.com/matomo-org/matomo/blob/4.x-dev/CHANGELOG.md](https://github.com/matomo-org/matomo/blob/4.x-dev/CHANGELOG.md). If a change
affects the work of plugin developers or developers who integrate Matomo into their websites, we'd want to mention the change in the developer changelog. This can include:

* breaking changes

  A change that will force them to make modifications to their plugins or integrations. As said in a previous section, we like to avoid situations like this (except for major releases),
  but sometimes it's unavoidable.

* new features, API methods, configuration options

  If a new feature is something developers may want to take advantage of, then we want to mention it so more people become aware of it.

* changes to existing features

  If we change how an existing feature or API works, we want to mention it to developers. These are not breaking changes, those are mentioned above, just changes in the how something works.
  An example would be when we introduced an allowlist for trusted hosts to download geoip databases from. It's unlikely this would break anything for existing users, but it's still worth
  mentioning.

* deprecations

  If we deprecate some code or API, we want to mention it as early as possible, so developers have ample time to stop using it before we remove it.

#### Documentation added if needed

If the change is for a new feature or affects the way an existing feature works, then we'll want to modify the existing documentation (or create new documentation if it doesn't exist).
For changes that affect plugin developers and developers integrating Matomo, we'd want to document the changes within our existing phpdocs and the developer documentation website:
https://github.com/matomo-org/developer-documentation

Changes to features should be reflected in changes to user documentation. For new features we may give the task of writing documentation to technical writers or our support team,
but for smaller changes, developers might be expected to make those themselves.

We should also think about whether new faqs should be created or if we need to modify existing ones.

#### Reviewing External Contributors' PRs

External contributor pull requests should be reviewed in the same way as PRs from core developers, EXCEPT:

* we should assume that they may not want to or have the time to completely fix up their pull requests. It's possible we core devs may need to fix the build,
  or apply some changes, or other minor things. We shouldn't just take over the PR unless it is an easy task or a very useful thing to have merged.

* we should assume they don't have the technical knowledge we have of Matomo and may need more help than a core dev would.

* and we should always thank them for the contribution! It's always a good sign when people take an interest in our product, and it's pretty amazing when people decide to work for free :)

### For Core Developers: Merging Pull Requests

When reviewing a pull request in the current milestone, if it works, all review items have been addressed and tests pass, then core developers are allowed to merge it.

For anything else, we'd have to know fully whether it is something we want in the current milestone. This "approval" can be an explicit comment from Thomas or Matt, or it could
just be from a slack conversation (remember, we can always revert something later).

If reviewing something outside of the current milestone, or reviewing something that doesn't have a milestone, most of the time we'll just want to use the github approval feature.
Exceptions can be made, however, if the change is small and not likely to cause any problems when released. Then it's fine to change the milestone to the current one and merge it.

Since we work on issues in the current milestone first, reviewing pull requests outside of the current milestone isn't something that happens very often.

## Learn more

- learn **the basics of Piwik development** in [Getting started with plugins](/guides/getting-started-part-1).
- to see a **list of available things you could work on**, see our [upcoming milestone](https://github.com/matomo-org/matomo/milestones)
- learn **more about Piwik's tests** in our [Testing](/guides/tests) guide.

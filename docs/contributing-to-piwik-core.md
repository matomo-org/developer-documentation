# Contributing to Piwik Core

<!-- Meta (to be deleted)
Purpose:
- to describe process of contributing to piwik core,
- how devs interested in becoming contributors could start,
- how the review process works,
- the code standards for core contributions, etc.

Audience: devs who found bugs while developing plugins and want to fix them, devs who want to start contributing

Expected Result: devs who know how to contribute and know what kind of contribution would be successfully used

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you've **found a bug, fixed it and want to know how to get your fix accepted upstream**
* you're **interested in contributing changes to Piwik and _want to know where to start_ or _want what the process is like_**
* you'd like to know **what Piwik developers consider to be good code**

**Guide assumptions**

This guide assumes that you:

* can code in PHP and JavaScript,
* can use the [git](http://git-scm.com/) source code management tool
* are familiar with [github](http://github.com),
* and have the necessary tools to contribute to Piwik (if not, see this section of our [Getting started extending Piwik](#) guide).

## Contribution Process

The contribution process starts with a bug you want to fix or an idea that you want to implement. _If you don't have one, feel free to pick an open ticket on [dev.piwik.org](http://dev.piwik.org/trac/roadmap)._

Once you've decided on something, continue below.

### Getting a copy of Piwik to work on

Before you can start contributing you need to get setup with [git](http://git-scm.com/) & [github](https://github.com). First, get a [github](https://github.com) account [here](https://github.com/). Then login and...

#### Fork the Piwik repository

While logged in, visit [Piwik's github repo](https://github.com/piwik/piwik). In the upper right corner there will be a _Fork_ button. Click it. Github will copy the repository and place the new forked copy in your account.

#### Setup git

When committing, git will need to know your username & email. To set them, run the following commands (replacing `$username` with your github username and `$email` with the email address you told github about):

    git config --global user.name $username
    git config --global user.email $email

Also, if you have a favorite text editor you'd like to use when creating commit messages, you can configure git to launch it when you commit changes. For example:

    git config --global core.editor my-text-editor

#### Clone the forked repository

To be able to work on Piwik you'll need to have a local copy of your forked repository on your computer. To copy your forked repository, run the following command after replacing **myusername** with your github username:

    git clone https://github.com/myusername/piwik piwik

This will copy the entire forked repository (including all history) to the _piwik_ folder on your hard drive.

Now, we'll run one more command so git remembers the original Piwik repository in addition to your fork:

    git remote add upstream https://github.com/piwik/piwik

This will save _https://github.com/piwik/piwik_ as a remote and name it _upstream_.

#### Configuring up PHP

Contributions should not generate PHP errors or warnings. Applying the following settings to your php.ini file will enable you to catch these errors:

    display_errors  = On
    error_reporting = E_ALL | E_STRICT

### Hacking Piwik

Now that you have a copy of the latest Piwik source code, you can start modifying it. For this section, we'll assume there's a bug that you found and want to fix.

#### Create a new branch

Before you start coding, you should make sure to keep your changes separate from the master branch. This will make it much easier to track the changes specific to your feature since your changes won't be mixed with any new commits to the master branch from other developers.

We'll give our new branch a name, _bugfix_, that describes what we're doing so we can recognize it later. To add a new branch, run the following command:

    git checkout -b bugfix

The checkout command will create a new branch if the _-b_ option is supplied, otherwise it will try and load an existing branch.

#### Work on feature

Once you've created a branch, you have a place to start working on the feature. There's nothing special about this part of the process, just fix the bug or finish the feature you're working on.

If you're working on something more complex than a bugfix, though, you may have the need to keep your new branch updated with changes from the main repository. Keeping your branch up to date is a two-three step process. First, on your **master** branch (remember to use the _checkout_ command to switch branches), pull changes from the main Piwik repository, nicknamed _upstream_:

    git pull upstream master

Then, on your new branch (**bugfix** for this tutorial), merge with **master**:

    git merge master

If there are conflicts, git will list them and tell you to fix them and then commit. To fix commits, you can do it manually in a text editor (which is usually pretty simple), or you can let git launch a GUI by calling:

    git mergetool

What git will launch depends on what diff-ing tools you have installed.

After you fix conflicts, you have to let git know the conflicts are gone and re-commit. To do that, you run _git add_ on the files with conflicts then _git commit_. More on how to add files and commit in the next section.

#### Save your changes

Now that you've finished the bug fix or new feature (or just part of it), it's time to save your changes. First, you want to commit them to your local clone of your github repository. To do that, run the following command:

    git commit -a -m "Fixed a bug."

This will commit every modified file and use _"Fixed a bug."_ as the commit message. If you have new files to add, run the following command before committing:

    git add /path/to/file

If you only want to commit some files and not every modified file, run the above command for every modified file you want to commit, then run:

    git commit -m "..."

The _-a_ option (which we used above) tells git to automatically commit every file that has been modified, not just the specific files that have been used with _git add_.

If you delete a file, git will notice it is deleted, but you still have to _git add_ the file or use the _-a_ option to commit the deletion.

#### Publish your changes

Now that you've committed your changes locally, you need to make them visible on your github repository. This is done with one command:

    git push origin bugfix

This command will push every change you made on the **bugfix** branch to the **origin** remote (which is your github repository).

You can also use this command to publish changes to your **master** branch by running:

    git push origin master

### Create pull request & wait for someone to review the code

Your changes are published, which means you can now send a pull request to the main Piwik project. To do this, visit your forked repository in a browser, and select the **bugfix** branch in the branch selector (located right above the directory listing on the left side of the page). Then click the _Pull Request_ button in the middle of the top of the page.

On this screen you'll be able to see exactly what changes you've made by looking at your commits and at what files have been changed. You can use this as an opportunity to review your own code if you like.

Once you're ready to create the pull request, write a description of the pull request and any notes that are important for the person who will review your code, and then click _Send pull request_. This will create a new pull request which you will be able to find and view [here](https://github.com/piwik/piwik/pulls).

#### Based on the review, make changes & push those changes

Once your pull request is public, someone will review it and leave comments regarding what should be changed. You can then make changes, commit them and then push them to your remote repository (**origin**) and they will automatically be shown in the pull request.

_To see our coding standards for Piwik Core see [this section](#piwik-core-coding-standards) below._

#### Once your pull request has been merged, sync w/ master

Your pull request has been reviewed and deemed worthy: it has been merged with Piwik's **master** branch. Now, you need to sync your fork with the main repo. This is the same process that was described in [Work on Feature](#work-on-feature):

    # first make sure you're on master
    git checkout master

    # now we'll pull in changes from 'upstream' the original Piwik repository
    git pull upstream master

    # then we'll push those changes to 'origin'
    git push origin master

And finally, now that the changes are part of Piwik, there's no need for your feature branch, so we'll delete it:

    git branch -D bugfix

<a name="piwik-core-coding-standards"></a>
## Piwik Core Code Standards

The following are a list of guidelines and requirements for contributions to Piwik Core. Developers and teams interested in contributing should read through them before starting to contribute and before sending a pull request. _**Contributions that are not up to these standards will not be accepted.**_

### General Considerations

* **Write clear, easily understandable code.** Is your code easy to read? Do you understand what each line and function does immediately after reading them? Code that does not do anything complicated should be this easy to understand. Complex code should have extra documentation that will aid new developers in understanding it.

* **Reuse as much code as possible.** Have you removed any redundancies in your code? Have you made sure your code does not replicate existing functionality? Try to reduce the amount of code you need to write for your contribution.

* **Write _correct_ code.** Does your code handle all possible scenarios? Does your code handle all possible error conditions (including any corner cases)? Do existing tests pass for your contribution? Does your code generate any unwanted PHP errors or warnings? We do not want contributions that introduce new bugs.

* **Write _efficient_ code.** Does your code scale well? What happens when there are hundreds of thousands of websites and billions of visits? Please note any potential performance issues and whether they would be easy to fix. We know how hard it can be to scale efficiently, but we would like for Piwik to be as fast as possible.

* **Follow our [security guidelines](/guides/security-in-piwik).** We do not allow any security vulnerabilities in contributions.

### Specific Considerations

* **Add new configuration settings for fixed values that may users may change.** Does your code use constants that users may want to change? They should be made configurable.

* **Use automated testing to test your PHP.** If you've written new PHP code, have you created unit and integration tests for them? Some code cannot be tested this way (such as code in controllers), but all code that could benefit  from automated tests should have tests written for them. Read our [Automated Testing](/guides/automated-tests) guide to learn about Piwik's test suite.

* **Internationalize your text.** If your contribution has text, is it loaded from a language file? We want all text in Piwik Core to be available in as many languages as possible. To learn more about i18n in Piwik read our [Internationalization](/guides/internationalization) guide.

* **Generate HTML in template files only.** Does your PHP code contain HTML? It shouldn't. All HTML generation should be handled by Twig templates.

* **If your contribution includes changes to the UI, make sure to do manual testing of all relevant areas of Piwik's UI.** See [this section](/guides/manual-ui-testing) for details on how to do these tests.

* **If your contribution includes third-party components & libraries, make sure they include GPL compatible licenses.** Third-party components/libraries must be compatible with GPL v3 since this is the license used by Piwik.

* **Make sure your code follows the [PSR 0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md#mandatory), [PSR 1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md#basic-coding-standard) and [PSR 2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md#coding-style-guide) coding standards.**

* **Make sure your source code files are encoded in UTF8.**

* **Make sure lines end with Linux EOL markers (LF).** To learn how to let git manage line endings for you, read [this](https://help.github.com/articles/dealing-with-line-endings#platform-all).

### Coding Considerations

The following are a list of guidelines you should follow while writing code and architecting software:

#### Include Path

Piwik does not set or depend on the include path. Plugins should rely on the autoloader for classes and use the absolute path convention for other files:

    require_once PIWIK_INCLUDE_PATH . '/folder/script.php';

#### Basic Clean Code recommendations

About classes:

* A class should follow the Single Responsibility Principle.
* Refactor classes and aim for files/classes that are at most 400 lines.
* Avoid classes with both public attributes and getters/setters. Choose to use getters and setters only when they make code easier to read.
* Add `private` keywords to class attributes when forgotten.

About methods and functions:

* A function should follow the Single Responsibility Principle: each function should do only one thing.
* Think about whether you can refactor the function body into smaller private methods.
* Aim for a maximum of 20-30 lines per method.
* Aim for maximum three function parameters.
* Extract the body of the `try {}` blocks into their own private method.

Keep the following principles (from Alan Shalloway) in mind while writing code: cohesion, loose coupling, no redundancy, encapsulation, testability, readability, and focus.

#### Commenting

In order for new developers to get up to speed quickly and in order to lessen the amount of bugs Piwik will ever experience, the Piwik source code must be easy to understand. Comments, in addition to general code cleanliness, are important in achieving this goal.

> Comments are a central part of professional coding. Comments can be divided into three categories: **documentary** (serving the purpose of documenting the evolution of code over time), **functional** (helping the co-ordination of the development effort inside the team) and **explanatory** (generating the software documentation for general use). All three categories are vital to the success of a software development project.

&mdash; from [ The fine Art of Commenting](http://www.icsharpcode.net/TechNotes/Commenting20020413.pdf)

For an example of a well commented Piwik class, see [Piwik_Cookie](https://github.com/piwik/piwik/blob/master/core/Cookie.php).

Despite their importance, comments can sometimes cause information overload &mdash; or worse for out of date comments. Useless or inaccurate comments and autogenerated comments that add no value should be avoided. Rather than writing comments inside a function, it is better to write shorter functions that do only one thing and are named thoughtfully. A well refactored class made of small methods will be easy to read and will not need many comments.

#### No duplication

**No duplication** is a basic and core principle of extreme programming and of writing good code in general. Write code **"Once, and only once"**, i.e. Don't Repeat Yourself. Do not duplicate code.

#### Debugging & logging

In Piwik you can easily log debug messages to files, the database or the screen by enabling logging in your config/config.ini.php file. In your code, you can then call `Piwik\Log::info($message);` to log new messages. You can also show the debug output on screen by appending &debug to the URL: this allows you to test and view debug messages only when needed, but still leave debug logging enabled. **See the FAQ to [enable logging output in Piwik](http://piwik.org/faq/troubleshooting/#faq_115) and the various options.**

Piwik also comes with a SQL profiler, which reports the time spent by each query, how many times they were called, the total time spent in Mysql vs php, etc. It makes it easier to check the performance and overhead of your new code. See the FAQ to see how enable [SQL profiling](http://piwik.org/faq/troubleshooting/#faq_115).

### Automated Tests

If you are fixing a small bug or simply modifying the UI, there is usually no need to write new tests. But if you are adding a new feature to Piwik, adding a new API method or modifying a core Archiving or Tracking algorithm, generally it is required to also submit new or updated Unit tests or Integration tests.

For more information about running or creating tests, read our [Automated Testing](/guides/automated-tests) guide.

When naming unit/integration tests, it helps to use the **Given**, **When**, **Then** convention for writing tests.

Tests are critical part of ensuring Piwik stays a stable and useful software platform. We aim to keep test code as clean as production code so it is easy to improve and maintain.

### Manual UI Testing

**If you have modified the Javascript code, CSS, HTML, or PHP code that can affect the User Interface, you must manually test the UI to make sure everything still works.** Read about each manual check and test in our [Manual UI Testing](/guides/manual-ui-testing) guide.

If all UI tests pass, you have successfully made a change to the Piwik UI.

## Learn more

* To **learn the basics of Piwik development** in our [Getting started extending Piwik](#) guide.
* To see a **list of available things you could work on** see our [roadmaps](http://dev.piwik.org/trac/roadmap)
* To learn **more about Piwik's test suite** see our [Automated Testing](/guides/automated-tests) guide.

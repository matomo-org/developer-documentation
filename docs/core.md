# Core Development

## Coding standards
This section provides the coding guidelines for developers and teams contributing to Piwik.

### Piwik Code Review Process

In Piwik, we believe in **tested** and **readable** source code. This is why we review all new code, examining for code readability, general design and efficiency. Here is a list of things to consider while creating your contribution:

*   **Code Clarity** Is your code easy to read? Do you understand what each line and function does immediately after reading them?
*   **Correctness** Have you added unit tests and are they passing? Did you do UI testing to make sure there are no obvious bugs?
*   **Code Reuse** Did you make sure there is no redundancy in your code? Did you make sure your code does not replicate existing functionality? Is there code that you think can be put into an external library or included in Piwik's core? (If yes to this last one, let us know!)
*   **Configuration and Constants** Does your code use constants that different users may want to change? These constants should be configurable.
*   **Failure Handling** Does your code handle all error conditions, including corner cases? We do not want code with bugs in it.
*   **Performance** Does your code scale well? What happens when there are hundreds of thousands of websites and billions of visits? If there are performance issues, are they easy to fix? We know how hard it can be to scale efficiently, but we would like for Piwik to be as fast as possible.
*   ** Security** Are you using the [proper helper method](http://piwik.org/docs/plugins/security-checklist/) to retrieve GET or POST variables? Are you properly checking for user permissions to restrict data access?
*   **i18n** If your plugin contains text, is it all loaded from a language file?
*   **View VS Controller** Does your php code contain any HTML? If your code outputs data in the browser, the output should be defined in a separate View template file (.tpl).
*   **GPL Compatibility** Are any third-party components/libraries included? Are the licenses for them compatible with GPL v3? This is the license Piwik uses.

### PHP File Formatting, Naming Conventions, Coding Style

*   The Piwik source code follows the [PSR 1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md#basic-coding-standard) and [PSR 2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md#coding-style-guide) coding standards. Starting in Piwik 2.0 we will also follow [PSR 0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md#mandatory).
*   Several Piwik devs are using Phpstorm IDE. We have published our [customized PSR coding style xml file](https://github.com/piwik/piwik/tree/master/misc/others/phpstorm-codestyles) for Phpstorm if you wish to reuse it.
*   Please read PSR 1 &amp; 2 for more information.
*   Files in Piwik's Git repository are stored using Linux EOL markers (LF).
*   All source code files are encoded in UTF8.

### PHP Configuration for developers

Committed code should not generate php errors or warnings. Applying the following settings to your php configuration will enable you to achieve this goal:

*   display_errors = On (php.ini)
*   error_reporting = E_ALL | E_STRICT (php.ini)

### Include Path

Piwik does not set or depend on the include path. Plugins should rely on the autoloader for classes and use the absolute path convention for other files:

<pre>require_once PIWIK_INCLUDE_PATH . '/folder/script.php';</pre>

### Security

We have **high security standards**.

All plugins developers should carefully read the page about **[Security in Piwik code](../../plugins/security-checklist)**.

### Basic Clean Code recommendations

About classes:

*   A class should follow the Single Responsibility Principle.
*   Refactor classes and aim for files/classes that are at most 400 lines.
*   Avoid classes with both public attributes and getters/setters. Choose to use getters and setters only when they make code easier to read.
*   Add “private” keywords to class attributes when forgotten.

About methods and functions:

*   A function should follow the Single Responsibility Principle: each function should do only one thing.
*   Think if you can refactor the function body into smaller private methods.
*   Aim for a maximum of 20-30 lines per method.
*   Aim for maximum three&nbsp;function parameters.
*   Extract the body of the try {} blocks into their own private method.

Summary: Alan Shalloway has suggested that there are seven principles for writing clean code: cohesion, loose coupling, no redundancy, encapsulation, testability, readability, and focus.

### Commenting

In order to be the best web analytics framework, the Piwik source code must be easy to understand. Comments, in addition to general code cleanliness, are very important for achieving this goal.

_Comments are a central part of professional coding. Comments can be divided into three categories: **documentary** (serving the purpose of documenting the evolution of code over time), **functional** (helping the co-ordination of the development effort inside the team) and **explanatory** (generating the software documentation for general use). All three categories are vital to the success of a software development project._ (from [ The fine Art of Commenting](http://www.icsharpcode.net/TechNotes/Commenting20020413.pdf))

For an example of a well commented Piwik class, see [Piwik_Cookie](https://github.com/piwik/piwik/blob/master/core/Cookie.php).

Despite their importance, comments can sometimes cause information overload – or worse for out of date comments. We should avoid useless or inaccurate comments, including auto generated comments that do not add any value. Rather than writing comments inside a function, it is better to write shorter functions that do only one thing, and are named carefully. A well refactored class made of small methods will be easy to read and will not need many comments.

### No duplication

**No duplication** is a basic and core principle of extreme programming and of writing good code in general. **“Once, and only once”**, i.e. Don't Repeat Yourself. Do not duplicate code.

### Debug &amp; logging

In Piwik you can easily log debug messages to files, the database or the screen by enabling logging in your config/config.ini.php file. In your code, you can then call Piwik::log($message); to log new messages, or arrays. You can also show the debug output on screen by appending &amp;debug to the URL: this allows you to test and view debug messages only when needed, but still leave debug logging enabled. **See the FAQ to [enable logging output in Piwik ](http://piwik.org/faq/troubleshooting/#faq_115)and the various options.**

Piwik also comes with a SQL profiler, which reports the time spent by each query, how many times they were called, the total time spent in Mysql vs php, etc. It makes it easier to check the performance and overhead of your new code. See the FAQ to see how enable [SQL profiling](http://piwik.org/faq/troubleshooting/#faq_115).

### Automated Tests

If you are fixing a small bug or simply modifying the UI, there is usually no need to write new tests. But if you are adding a new feature to Piwik, adding a new API method or modifying a core Archiving or Tracking algorithm, generally it is required to also submit new or updated Unit tests or Integration tests.

For more information about running or creating tests,&nbsp;[see tests/README.md](https://github.com/piwik/piwik/blob/master/tests/README.md#readme).

When naming unit/integration tests, it helps to use the **Given**, **When**, **Then** convention for writing tests.

Tests are critical part of ensuring Piwik stays a stable and useful software platform. We aim to keep test code as clean as production code so it is easy to improve and maintain.

### References

In Summary, we like the words of Alan Shalloway who suggested that there are seven code qualities that matter: cohesion, loose coupling, no redundancy, encapsulation, testability, readability, and focus.

For more information:

*   [How to submit a pull request or a patch?](http://piwik.org/participate/development-process/#toc-how-to-submit-a-patch-or-pull-request)
*   [ Interesting read about hidden costs of a new feature](http://gettingreal.37signals.com/ch05_Hidden_Costs.php)
*   [ GPL compatible licenses](http://www.gnu.org/licenses/license-list.html#GPLCompatibleLicenses)
*   We also recommend the book “Clean code” by Robert C. Martin (or [this video](https://www.vimeo.com/12643301))

See also: [List of Features](http://piwik.org/features/), [Consultants](http://piwik.org/consulting/), [Testimonials](http://piwik.org/testimonials/), [Piwik supporters](), [Merchandise](http://piwik.org/shop/merchandise/) and [Participate in Piwik!](http://piwik.org/contribute/)

## Contributing to Piwik with Git

### Getting a copy of Piwik to work on

Before you can start contributing you need to get setup with git &amp; [github](https://github.com). First, get a [github](https://github.com) account [here](https://github.com/). Then login and…

#### Fork the Piwik repository

While logged in, visit [Piwik's github repo](https://github.com/piwik/piwik). In the upper right corner there will be a _Fork_ button. Click it. Github will copy the repository and place the new forked repository in your account.

#### Setup git

When committing, git will need to know your username &amp; email. To set them, run the following commands:

<pre><code>git config --global user.name $username
git config --global user.email $email
</code></pre>

Also, if you have a favorite text editor you'd like to use when creating commit messages, you can configure git to launch it when you commit changes. For example:

<pre>git config --global core.editor my-text-editor</pre>

#### Clone the forked repository

To be able to work on Piwik you'll need to have a copy of your forked repository on your computer. To copy your forked repository, run the following command after replacing **myusername** with your github username:

<pre>git clone https://github.com/myusername/piwik piwik
</pre>

This will copy the entire forked repository (including all history) to the _piwik_ folder on your hard drive.

Now, we'll run one more command so git remembers the original Piwik repository in addition to your fork:

<pre>git remote add upstream https://github.com/piwik/piwik
</pre>

This will save _https://github.com/piwik/piwik_ as a remote and name it _upstream_.

### Hacking Piwik

Now that you have a copy of the latest Piwik source code, you can start modifying it. For this section, let's assume there's a bug that you found and want to fix.

#### Create a new branch

Before you start coding, you should make sure to keep your changes separate from the master branch. This will make it much easier to track the changes specific to your feature since your changes won't be mixed with any of your other changes or new commits to the master branch from other developers.

We'll give our new branch a name, _bugfix_, that describes what we're doing so we can recognize it later. To add a new branch, run the following command:

<pre>git checkout -b bugfix
</pre>

The checkout command will create a new branch if the _-b_ option is supplied, otherwise it will try and load an existing branch.

#### Work on feature

Once you've created a branch, you have a place to start working on the feature. There's nothing special about this part of the process, just fix the bug or finish the feature you're working on.

If you're working on something more complex than a bugfix, though, you may have the need to keep your new branch updated with changes from the main repository. Keeping your branch up to date is a two-three step process. First, on your **master** branch (remember to use the _checkout_ command to switch branches), pull changes from the main Piwik repository, nicknamed _upstream_:

<pre>git pull upstream master
</pre>

Then, on your new branch (**bugfix** for this tutorial), merge with **master**:

<pre>git merge master
</pre>

If there are conflicts, git will list them and tell you to fix them and then commit. To fix commits, you can do it manually in a text editor (which is usually pretty simple), or you can let git launch a GUI by calling:

<pre>git mergetool
</pre>

What git will launch depends on what diff-ing tools you have installed.

After you fix conflicts, you have to let git know the conflicts are gone and re-commit. To do that, you run _git add_ on the files with conflicts then _git commit_. More on how to add files and commit in the next section.

#### Save your changes

Now that you've finished the bug fix or new feature (or just part of it), it's time to save your changes. First, you want to commit them to your local clone of your github repository. To do that, run the following command:

<pre>git commit -a -m "Fixed a bug."
</pre>

This will commit every modified file and use _“Fixed a bug.”_ as the commit message. If you have new files to add, run the following command before committing:

<pre>git add /path/to/file
</pre>

If you only want to commit some files and not every modified file, run the above command for every modified file you want to commit, then run:

<pre>git commit -m "..."
</pre>

The _-a_ option (which we used above) tells git to automatically commit every file that has been modified, not just the specific files that have been used with _git add_.

If you delete a file, git will notice it is deleted, but you still have to _git add_ the file or use the _-a_ option to commit the deletion.

#### Publish your changes

Now that you've committed your changes locally, you need to make them visible on your github repository. This is done with one command:

<pre>git push origin bugfix
</pre>

This command will push every change you made on the **bugfix** branch to the **origin** remote (which is your github repository).

You can also use this command to publish changes to your **master** branch by running:

<pre>git push origin master
</pre>

### Create pull request &amp; wait for someone to review the code

Your changes are published, which means you can now send a pull request to the main Piwik project. To do this, visit your forked repository in a browser, and select the **bugfix** branch in the branch selector (located right above the directory listing on the left side of the page). Then click the _Pull Request_ button in the middle of the top of the page.

On this screen you'll be able to see exactly what changes you've made by looking at your commits and at what files have been changed. You can use this as an opportunity to review your own code if you like.

Once you're ready to create the pull request, write a description of the pull request and any notes that are important for the person who will review your code, and then click _Send pull request_. This will create a new pull request which you will be able to find and view [here](https://github.com/piwik/piwik/pulls).

#### Based on the review, make changes &amp; push those changes

Once your pull request is public, someone will review it and leave comments regarding what should be changed. You can then make changes, commit them and then push them to your remote repository (**origin**) and they will automatically be shown in the pull request.

#### Once your pull request has been merged, sync w/ master

Your pull request has been reviewed and deemed worthy: it has been merged with Piwik's **master** branch. Now, you need to sync your fork with the main repo. This is the same process that was described in [Work on Feature](#work-on-feature):

<pre># first make sure you're on master
git checkout master

# now we'll pull in changes from 'upstream' the original Piwik repository
git pull upstream master

# then we'll push those changes to 'origin'
git push origin master
</pre>

And finally, now that the changes are part of Piwik, there's no need for your feature branch, so we'll delete it:

<pre>git branch -D bugfix
</pre>

### Appendix: List of useful commands

*   List all branches
    <pre>git branch</pre>
*   Create a new branch:
    <pre>git checkout -b $branch_name</pre>
*   Checkout an existing branch:
    <pre>git checkout $branch_name</pre>
*   Delete existing branch:
    <pre>git branch -D $branch_name</pre>
*   Delete branch in remote repository
    <pre># first delete the branch locally
    git branch -D $branch_name
    # then delete the remote branch by running this:
    git push $remote_name :$branch_name</pre>
*   Revert all changes that haven't been committed:
    <pre>git reset --hard</pre>
*   Revert changes to one specific file:
    <pre>git checkout -- path/to/file</pre>
*   Commit all modified files + all _git add_ed files:
    <pre>git commit -a -m "commit message goes here"</pre>
    _-m_ is optional.
*   Add specific changes and commit only those changes:
    <pre>git add path/to/new/file
    git add path/to/deleted/file
    git add path/to/modified/file
    git commit -m "Added new file, deleted old file &amp; modified existing file."</pre>
*   See status of all files:
    <pre>git status</pre>
*   See log of all commits:
    <pre>git log</pre>
*   Revert commit:
    <pre>git revert $commit_hash</pre>
    You can get a commit hash by looking through the commit log.
    _Note: reverting changes through the command can sometimes get complicated, especially if you're reverting a merge._
*   Push changes to remote:
    <pre>git push $remote_name $branch_name</pre>
*   Pull changes from remote:
    <pre>git pull $remote_name $branch_name</pre>
*   Merge a branch with the currently checked out branch:
    <pre>git merge $other_branch</pre>
*   Merge a branch but make it look like one commit:
    <pre>git merge --squash $other_branch
    git commit
    # in the editor, rewrite the commit message

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
*   Add "private" keywords to class attributes when forgotten.

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

Despite their importance, comments can sometimes cause information overload &mdash; or worse for out of date comments. We should avoid useless or inaccurate comments, including auto generated comments that do not add any value. Rather than writing comments inside a function, it is better to write shorter functions that do only one thing, and are named carefully. A well refactored class made of small methods will be easy to read and will not need many comments.

### No duplication

**No duplication** is a basic and core principle of extreme programming and of writing good code in general. **"Once, and only once"**, i.e. Don't Repeat Yourself. Do not duplicate code.

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
*   We also recommend the book "Clean code" by Robert C. Martin (or [this video](https://www.vimeo.com/12643301))

See also: [List of Features](http://piwik.org/features/), [Consultants](http://piwik.org/consulting/), [Testimonials](http://piwik.org/testimonials/), [Piwik supporters](), [Merchandise](http://piwik.org/shop/merchandise/) and [Participate in Piwik!](http://piwik.org/contribute/)

## User Interface

Usability is very important for us. If you can write html, css or even jquery: discuss, suggest or submit a new user interface or usability improvement. You can submit recommendations on how to improve the current UI, or tackle any of the [open tickets related to UI improvements](http://dev.piwik.org/trac/query?status=assigned&amp;status=new&amp;status=reopened&amp;group=status&amp;component=UI+%28templates%2C+javascript%29&amp;order=priority&amp;col=id&amp;col=summary&amp;col=owner&amp;col=type&amp;col=priority&amp;col=component&amp;col=sensitive).

Below are the quality requirements and test plans for Piwik's interface.

_See also: [List of Features](http://piwik.org/features/), [Consultants](http://piwik.org/consulting/), [Testimonials](http://piwik.org/testimonials/), [Piwik supporters](), [Merchandise](http://piwik.org/shop/merchandise/) and [Participate in Piwik!](http://piwik.org/contribute/)._

### How to test the User Interface after a modification?

_This is a checklist describing every User Interface features of piwik that you have to test after any modification in UI code, or before any public release._

** If you have modified the Javascript code, CSS, HTML, or PHP code that can be related to the User Interface, you have to go through this list to make sure everything is still working.**

### Asset Merging

Piwik framework comes with a dynamic JSS/CSS file minifier and merger mechanism. For more info see [Blog post &mdash; Making Piwik UI Faster](http://piwik.org/blog/2010/07/making-piwik-ui-faster/).

When you modify the Piwik Javascript files, to take your changes into consideration, add the following at the end of your file [ config/config.ini.php](https://github.com/piwik/piwik/blob/0.8/config/global.ini.php#L56):

<pre><code>[Debug]

disable_merged_assets=1
</code></pre>

Before testing the UI, please reactivate this feature by resetting disable_merged_assets to 0.

### Browsers to use to test the UI

These different features should be tested within several browsers:

*   Firefox,
*   Firefox with Firebug extension, check that there is no error or notice in the JS code,
*   Internet Explorer 8+
*   Internet Explorer with Debug enabled (set debugging in Tools &gt; Internet &gt; Advanced &gt; Debug),
*   Opera,
*   Safari,
*   CHrome

To help testing you may generate screenshots of the page on a web server using http://browsershots.org/

### Data Table

There are many features included in the Datatable element. In particular, check that:

*   Icons are present (eg: icon of google/yahoo/..., flags for country)
*   The style (background) is different between Odd/Even lines
*   Label text is truncated when necessary, and a tooltip displays original text
*   Test that the Column Documentation display on hover on a column name

Test that these features work:

*   Sort by column ("column sorted" icon should appear once the action is completed)
*   Pagination (previous/next), verify that 'current' and 'max' numbers are correct
*   Pagination should be reseted after a table refresh (column sort)
*   Test the Cog icon, in Page URLs report, and in Referers&gt; Websites.
*   Test the "Number of rows to display" element works in the bottom right
*

### Data Table Inline Search

Test the following:

*   Find a string that is present in the table, navigate in the table and cancel the search
*   Try to find a string that is not present in the table (should display 'No data...')

### Data Tables Visualizations

Check that all links work:

*   data export (csv/xml/json/php)
*   bar graph (should load jqplot graph as expected)
*   pie chart (idem)
*   tag cloud (displays values with relative font size)
*   table
*   (optional) table with Goal metrics

### Sub Data Table

Check that:

*   Click on a row displays a datatable (eg. for the Keywords table, the Search engine table) and verify all previous tests on this subDataTable (the same testing procedure as standard datatable)
*   There should be an external url link on some subdatatable rows (ie: Search engines subtable in the Keywords datatable)
*   Row Evolution + Multi RE works in subtables

### Data Table under Actions &gt; Pages

*   Run the same test than standard Data Table (the one difference with normal datatable is that the row colors are not alternate)
*   Expand and Minimize rows through several nesting levels (check that the left margin is growing)
*   Check that the figures sums up correctly in 'include low pop' mode

### Sparklines

Check that:

*   Click on a sparkline should update the graph above with the correct data

### Goals plugin

*   Try and create/edit/delete Goals
*   In the main Goal plugin page, check that the datatables are loading properly when the menu on the bottom left ("Goal by segments") is clicked.

### Dashboard

Test the features:

*   Move widgets around (Flash and non-Flash content)
*   Delete widget
*   Add a new widget
*   You should be able to quit the modal dialog by pressing 'esc' key
*   Make sure that already added widgets cannot be added again

### Calendar

Check that:

*   The currently selected period is highlighted in the calendar
*   Try to change date and period
*   Select a date range. Check that all widgets in the dashboards load.

### Menu

Test the following:

*   Click on a main menu item should select the first submenu item
*   The menu should indicate the current category when mouse isn't over it (timeout)
*   Test all menu/submenu for broken links

### Refresh and Back button

Test the following:

*   Select a submenu, press refresh, check that the page refreshes as expected for the same submenu, the same period and the same website
*   change the website, check that the selected menu is still the same
*   select two different submenus, press Back button and check the state is restored as expected

### Language Selector

Check that:

*   Click on the language shows the list of languages
*   Click on a language from the list reloads Piwik and loads the clicked language
*   A click outside the language selector should hide the language selector

If this works, it should also work for the Website Selector (which uses same code).

### Feedback

Check that:

*   clicking on the feedback link opens a box with grey background and links to forum and FAQ
*   clicking on "Contact the Piwik team" should display a form with a dropdown and two input fields to send feedback
*   test an invalid message (e.g., too short) and navigating back (using the left arrow in the feedback window)
*   test successfully sending a message
*   close window; re-click on feedback link should open box with grey background and links to forum and FAQ; there should be no trace of the previous error/success message

### Widgetize

*   Test one datatable widget in Widgetize iframe mode
*   Test that the dashboard loads well in iframe mode.

### Custom Segment Editor

The custom segment editor is a critical piece of the Piwik User Interface. Login as Super User and:

*   Create a segment "Hello '"world&lt;test&gt;end"
*   Add a few AND/OR segments, drag and drop metrics from the left
*   Verify that the Auto Suggest fields are working on the INPUT values (should display a drop down of suggested values)
*   Click on Save &amp; Apply segment
*   the "Loading data..." message should be displayed, and a notice about custom segments taking a few minutes to process.
*   On page reload, the data for the segment is displayed. We recommend to test using Visitors&gt; Visitor Log as it makes it easy to visualize the visits

At this stage you have created a custom segment. Now you can test:

*   Visitors&gt;Real time map, check it displays only visitors from the segment.
*   Click on&nbsp; "Email &amp; SMS" reports. Add a new Email report. When creating the report, select the newly created segment.

    *   Check that the Email report generated with the Custom Segment, contains the segment name at the top

*   Change the date in the calendar. This should keep the segment selected.

And maybe run some more advanced tests:

*   Rename the segment name to a new name, and changing one segment value to @#$%^,&amp;*(';:&lt;test&gt;Test.

    After clicking Save &amp; Apply, click [edit], the segment name and value should display correctly.
*   Check in a few reports that data is displayed for the Custom Segment

    *   in the datatable, click on Row Evolution and check that the data loaded is for the segmented visitor set
    *   The [Transition report ](http://piwik.org/docs/transitions/)should load for segmented data as well

### Embed / Widgetize

In the top menu click on "Widgetize".

*   Test that Dashboard widgetized works
*   Test that other reports work

###  Testing the installer

To view the installation screens, rename the file config/config.ini.php to config/_config.ini.php

Refresh Piwik: you will be prompted to install Piwik. Install in a new database or use a different prefix to go through the install steps.

### Testing the Updater

To test the updater process, first update the Piwik version number in the core/Version.php file, for example to 2.0-b100 (if you are using less than 2.0). Next, you need to create a new file in core/Updates/2.0-b100.php, copying an existing Update file for inspiration (rename the class to Piwik_Updates_2_0_b100).

Refresh Piwik and you should see the Update screen. If you click "Update" and need to test the Updater again, you can update the version Piwik think it is using with the SQL query (source: [faq](http://piwik.org/faq/how-to-update/#faq_179)):

<pre>UPDATE `piwik_option` SET option_value = "1.X" WHERE option_name = "version_core";</pre>

### Done!

If all the tests are passing, you have successfully made a change to the Piwik UI! Well done... and **thank you** for building the best open web analytics platform.

## Contributing to Piwik with Git

### Getting a copy of Piwik to work on

Before you can start contributing you need to get setup with git &amp; [github](https://github.com). First, get a [github](https://github.com) account [here](https://github.com/). Then login and...

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

This will commit every modified file and use _"Fixed a bug."_ as the commit message. If you have new files to add, run the following command before committing:

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
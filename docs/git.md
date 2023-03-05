---
category: DevelopInDepth
---
# Git

At Matomo we're using Git version control system. Below are some tips for using git along with a guide for how we work using git on the command line.

If you prefer using Git through your IDE like PHPStorm, or if you are more accustomed to use a slightly different commands or methods then please go with your preferred option of what you feel comfortable with. As often there is no right or wrong and not one way to do something.

## Prerequisites

* [Git LFS needs to be installed](https://github.com/git-lfs/git-lfs/wiki/Installation). If you cloned the repository without having Git LFS installed then [follow these instructions](#how-do-i-fix-the-error-some-screenshots-are-not-stored-in-lfs).

## Cloning a repository

GitHub supports cloning via HTTPS and SSH URLs. You will always want to use SSH URLs when cloning a repository, for example `git@github.com:matomo-org/matomo.git`.

To clone a repository, use for example:

```bash
git clone git@github.com:matomo-org/matomo.git matomo
git submodule update --init 
git lfs pull --exclude=
```

This clones the Matomo repository into a `matomo` directory, initialises all submodules and pulls all the screenshot testing files using LFS.

## Creating a new branch

Before you start coding on a new feature, you should make sure to keep your changes separate from the main branch. This allows you to [create a pull request from this branch later which can then be reviewed](/guides/pull-request-reviews).

We'll give our new branch a name. The branch name ideally always contains the GitHub issue number e.g. `matomo-1111` or if it's a Jira issue then e.g. `dev-1111`. Optionally, a descriptive name can be added to the branch name if wanted. It's not a requirement though, since the branch will only exist temporarily and the related issue will contain all the needed details. Ideally, the branch name is not just a pure number as it might cause a collision with a commit hash (explained below what this is) and git wouldn't know if it should check out a branch or a commit. To add a new branch, run the following command:

```bash
git checkout -b bugfix $MAIN_BRANCH
```

Where you need to replace `$MAIN_BRANCH` with the current main branch. This is for example `*.x-dev` when working on Matomo On-Premise (`5.x-dev` is the main branch at the time of writing this). For Matomo for WordPress this would be `develop`. For example: `git checkout -b bugfix 5.x-dev`. This way it will create a new branch from the `5.x-dev` branch. Otherwise, if you don't specify the base branch and you are already in another branch that has changes, then it would copy all changes from the current branch into the new branch.

The checkout command will create a new branch if the `-b` option is supplied, otherwise it will try to load an existing branch.

Instead of `git checkout -b` you can also use `git switch -c` if you are using a newer version of git.

## Adding, committing and pushing code

After you added or modified a few files, you will want to push these changes to the remote repository. It's good to commit and push regularly (at least daily) even if a feature is not finished yet, so you always have a backup if changes get lost for some reason.

### Add files

You will first want to execute `git status` to see which files have been modified.

To see what you changed in these files you can execute the command `git diff`. If you only want to see changes for a specific file or directory then you can list multiple files or directories as arguments like `git diff file1 file2 dir1`.

Once you are satisfied with the changes `git diff` shows you, you can add those files so they can be committed and pushed. So far these files are "unstaged" and once you add files then these will be "staged". Any added file will be included in your next commit.

The command to add files and directories is similar as `git diff` meaning you can add multiple file and directory paths to define which ones should be added:

```bash
git add index.php lang-directory file2
```

You don't have to add all files at once. You can add them over multiple comments before committing them:

```bash
git add index.php 
git add lang-directory file2
```

In some cases you might prefer the following command which asks you interactively which changes you want to add or not:

```bash
git add -p # please note this won't work for binary files like images, these would be skipped
``` 

You shouldn't execute a command like `git add --all` to add all files as chances are you might add some files you didn't want to add.

### Verifying the changes

Before we move on to the next step of committing these added changes, you will want to first verify what changes you added. To do this, run the command:

```bash
git diff --cached
```

#### Undo an added (staged) file

If you notice you added a change that you did not intend to add, then you can undo this again before committing by executing the below command:

```bash
git reset HEAD file1 # unstage one file
git reset HEAD file2 dir1 dir2 # unstage multiple files and directories at once
```

### Committing changes

Once these changes are added ("staged") then you can commit these changes. You can do this by executing this command:

```bash
git commit -m 'My awesome commit message'
```

If you executed the commit and notice a typo then you can update the commit message using the `--amend` option:

```bash
git commit --amend -m 'My awesome commit message'
```

In Matomo the commit messages are less important as we are usually creating a pull request and then squash all the commits into one commit when merging the PR. The title of the pull request will become the commit message. If you already pushed a commit, then don't update the commit message any more as it's not important and in the worst case causes issues as you would need to do a force push.

When you make a commit, then these commits are not yet sent to any remote server. You can do one or multiple commits before actually pushing these files to a remote server, which we will go into the next step.

#### Commit hashes

Each commit has a unique hash that identifies this commit (also known as commit reference). 

For example `commit 2b0891d1efb016882cd807196741963e3f6437b1`.

These hashes are useful for many things

* You can see the content of this commit using e.g. `git show $COMMIT_HASH`
* You can use it to check out this commit similar to a branch `git checkout $COMMIT_HASH`
* and much more.

Some git operations may require such a commit hash. You find these history in many places like Github commit history or when executing `git log`.
### Reviewing the last commit

If you committed changes and want to see what the last commit looked like then you can execute `git show`.

#### Undo last commit that is not pushed yet without losing the changes

This can be useful if you committed something that you didn't want to commit. The command will undo the last commit, but keep the changes.

```git reset --soft HEAD~1```

Technically, you can also undo the last commit that was already pushed but then it will require a force push (see below).


### Pushing changes

You can push changes using the command `git push`. If you are working on a branch then you may need to define the name of the so-called "remote" (which is usually `origin`) and the name of the branch you want to push. For example, if you created a branch `myfeature` then you need to execute `git push origin myfeature`.

Pushing means it will send all the previous commits to the remote server, which is github.com. You will then see the branch appear in the GitHub user interface and Travis will automatically run our suite of automated tests.

When you visit the repository you pushed the change to on github.com then GitHub will show you the branch you pushed to and you can inspect the pushed changes again. You then either make more pushes or if you are happy with the changes or seek feedback then you [create a pull request](/guides/pull-request-reviews).

#### Force pushes

Most main branches are protected from force pushes that rewrite the history. If you ever need to rewrite the history (which should be needed rarely) then you will want to use the below command:

`git push --force-with-lease`

While `git push --force` works too it overwrites the entire remote branch with your local branch, `--force-with-lease` is safer as it makes sure you won't overwrite someone else's work as it checks if your local copy of origin is the same as the remote origin and prevents pushing if someone else pushed to the branch in the meantime.

## Submodules

Various of our git repositories use submodules. From a git perspective a submodule within a repository is similar to work with as a file but its content includes a specific commit hash. This way git knows to which commit within a submodule it references.

Submodules are configured in a `.gitmodules` file ([see this example](https://github.com/matomo-org/matomo/blob/5.x-dev/.gitmodules)) and its content look like this:

``` 
[submodule "plugins/SecurityInfo"]
    path = plugins/SecurityInfo
    url = git@github.com:matomo-org/plugin-SecurityInfo.git
```

This means the repository has a submodule in the path `plugins/MyPlugin` and it points to the repository `git@github.com:matomo-org/plugin-SecurityInfo.git`. If the content of that submodule was to include the commit hash `0c3c4182d96edcb23c896ca86042bab06247db42`, then the directory `plugins/MyPlugin` will have the content of this specific commit checked out.

Every time this commit hash changes you will need to execute `git submodule update` to ensure the path has the correct version of the submodule checked out.

Note: If you are wondering why our repositories on GitHub use HTTPS git URLs this is so that Travis can clone this repository without issues.

### Making a change in a submodule and updating the reference to this submodule

The flow for updating a submodule is typically like below where we are assuming there is a repository which we refer to as "Parent" that has a submodule in `plugins/SecurityInfo`. In the commands replace `$MAIN_BRANCH` with the branch name of the main branch and `$MY_FEATURE_BRANCH` with the name of your feature branch.

* `cd plugins/SecurityInfo`.
* `git checkout -b mynewbranch $MAIN_BRANCH` 
* You make some changes in that submodule.
* You add, commit and push changes within this repository like `git add Controller.php && git commit -m "Update" && git push origin mynewbranch`.
* This commit will get a new unique commit hash.

Your next steps depend on whether you need those changes in your "Parent" repository right away or not.

#### Variation A - You don't need the submodule changes in your parent repository as part of your feature

This is the case most of the time. It happens when you add a new feature to a submodule or you fix a bug. You then create a PR in the submodule and get this change merged. Once the PR in the submodule was merged, then you update the reference in the "Parent" repository to make sure the change will be included in the next release and the change is considered in the tests of the "Parent" repository. 

* Create a pull request within the repository of the submodule.
* Get this change merged into the main branch.
* Now that the PR is merged in the submodule, you want to update the reference of the submodule within the "Parent" repository to the latest commit hash:
  * `git checkout -b $MY_FEATURE_BRANCH $MAIN_BRANCH`
  * `cd plugins/SecurityInfo`
  * `git checkout $MAIN_BRANCH`
  * `git pull origin $MAIN_BRANCH`
  * `cd ../..`
  * `git add plugins/SecurityInfo` this stages the submodule reference change
  * `git commit -m 'Update submodule'`
  * `git push origin $MY_FEATURE_BRANCH`

Now you can create a pull request in the "Parent" repository to update the submodule reference.

#### Variation B - You need the submodule change as part of your feature

This is mostly needed when you make some refactoring in the "Parent" repository that requires changes in the submodule for things to not break. It often indicates breaking changes. For example, you change an existing method in Matomo core and it requires changes in plugins.

* `git add plugins/SecurityInfo`
* `git commit -m 'Update submodule'`
* `git push origin $MY_FEATURE_BRANCH`

Now the "Parent" repository points the submodule to the commit in the branch `mynewbranch` which we created in the submodule. You will now finish your work in the "Parent" repository and then create a pull request for both the submodule and the main repository. You need to get the PR in the submodule merged first and then follow the steps in "Variation A".

### Fixing the error "reference is not a tree"

#### When you forgot to push the submodule

Let's say you make some changes in the submodule. Then you commit these changes, but you forget to push the changes like below:

* `cd plugins/SecurityInfo`.
* `git checkout -b $MY_FEATURE_BRANCH $MAIN_BRANCH`.
* `git add Controller.php && git commit -m "Update"`.
* Here usually a push should happen, but you forgot it.
* `cd ../..`
* `git add plugins/SecurityInfo` this stages the submodule reference change
* `git commit -m 'Update submodule'`
* `git push`

When you push now, then the updating of the submodule won't work because the commit only exists on your local computer but was never pushed. To resolve this issue, you need to push the commit using these commands:

* `cd plugins/SecurityInfo`.
* `git push origin $MY_FEATURE_BRANCH`.

#### When the branch was deleted 

The same error might happen if you point the submodule to a commit in a branch whose branch was deleted meanwhile. To fix this issue you need to instead update the reference in the submodule to a commit that still exists. Below example updates the commit reference back to the latest commit in the main branch. 

* `cd plugins/SecurityInfo`.
* `git checkout $MAIN_BRANCH`.
* `git pull origin $MAIN_BRANCH`.
* `cd ../..`
* `git add plugins/SecurityInfo`
* `git commit -m 'Update submodule'`
* `git push`

### Fixing the error "fatal: remote error: upload-pack: not our ref"

The exact reason for this error is unknown at present but likely related to a failed merge. It could be accompanied with various 'warning: ... multiple configurations found for submodule.xxx' messages.

To resolve this:

* Save a patch of the branch changes:
* `git diff $MAIN_BRANCH $FEATURE_BRANCH > $FEATURE_BRANCH.patch`
* Close the PR without merging.
* Checkout the main branch:
* `git checkout $MAIN_BRANCH`
* Create a new branch from the main branch:
* `git checkout -b $FEATURE_BRANCH_NEW`
* Apply the patch:
* `git apply $FEATURE_BRANCH.patch`
* Commit and push the changes:
* `git commit -m 'New branch'`
* `git push`
* Create a new PR from the new branch.

### Accidentally Committed Submodules?

Have you done some work on Matomo or another project and accidentally overridden the submodule commit? The below commands can help you point the submodule back to the same commit as the main branch does.

Replace the following variables in the commands below:

* `$MAIN_BRANCH` with the name of the main branch. Sometimes this is `live`, `develop` or `*.x-dev` (e.g. `5.x-dev`).
* `$FEATURE_BRANCH` with the name of your branch where you did the wrong commit.
* `$SUBMODULE_DIR` with a path to the submodule you want to correct. For example "plugins/Morpheus/icons".

```
git checkout $MAIN_BRANCH # switch to the main branch
git submodule update --init --recursive
git checkout $FEATURE_BRANCH  
git checkout $MAIN_BRANCH $SUBMODULE_DIR 
git add $SUBMODULE_DIR   # add the submodule back in its original state
git commit -m 'revert git submodule' # commit the changes
```

## Other useful commands

### Merging the latest changes in the main branch into your feature branch

You might be working on your branch for a few hours or days and meanwhile there were changes in the main branch that you would like to have in your feature branch. For example, this might be useful to resolve merge conflicts or if maybe in the main branch some tests were fixed that are failing in your branch. To do this, follow below steps and replace `$MAIN_BRANCH` with the main branch name of the repository you are working in (for example `5.x-dev`) and replace `$MY_FEATURE_BRANCH` with the name of your branch you are working in currently.

```bash
git checkout $MAIN_BRANCH
git pull origin $MAIN_BRANCH
git checkout $MY_FEATURE_BRANCH
git merge $MAIN_BRANCH # then save the file. Assuming you don't have any unstaged changes you could also do instead `git rebase $MAIN_BRANCH`
git push origin $MY_FEATURE_BRANCH
```

### Checking out a specific Matomo version

You can check out a specific version of Matomo by executing the `git checkout` command together with the version number. For example:

`git checkout 4.4.0`

### Fixing accidentally pushed other commits in your feature branch

Say you worked on a feature in a branch named `foo` and then you started working on a new feature in a branch named `bar`. You executed `git checkout -b bar` instead of `git checkout -b bar $MAIN_BRANCH`. This means the branch `bar` will also include all the changes from `foo` and when you create pull request there are changes from another PR included and it is not clear which changes you added as part of your work in the branch `bar`.

There are many ways you can fix this issue. 

#### If there are very little changes in the created PR

This may be only useful if there are only very few changes in only one file:

* Close the PR without merging.
* Create a new branch from the main branch.
* Apply the same changes again manually.
* Create a new PR.

#### The easiest solution 

If there are only few commits in your branch `bar` then the easiest solution can be to create a new branch and cherry pick all the commits that you want to commit into this new branch. You then close the initially created PR without merging and create a new PR.

```bash
git checkout -b $MY_FEATURE_BRANCH $MAIN_BRANCH
git cherry-pick $COMMIT_SHA # replace $COMMIT_SHA with the commit hash number that you want to keep
git cherry-pick $COMMIT_SHA # you may need to cherry pick multiple commits if needed
git push origin $MY_FEATURE_BRANCH
```

#### More complex solution

A more complex solution can be to find the last commit before your changes and then execute `git rebase -i $COMMIT_SHA`.

This allows you to remove not wanted commits by simply deleting lines and then saving the file. It will rewrite the history and you need to force push these changes. Please note that your changes may get lost if you are doing some things wrong here, so use it wisely. 

### Log Changes

You can log all changes that have happened to see exactly what was changed when and by who by executing `git log -p`.

If you don't want to get the actual changes but only the commit messages and each of their reference then execute `git log`.

### How do I fix the error "Some Screenshots are not stored in LFS"?

The error might look like this:

```
1) Piwik\Tests\Integration\ReleaseCheckListTest::test_screenshotsStoredInLfs
   Some Screenshots are not stored in LFS: plugins/YourPluginName/tests/UI/expected-screenshots/Filename.png
   Failed asserting that an array is empty.
```

You can fix this issue using these steps:

* `cd plugins/YourPluginName`
* `git rm tests/UI/expected-screenshots/*.png`
* Add `tests/UI/expected-screenshots/*.png filter=lfs diff=lfs merge=lfs` to the file `.gitattributes` in your plugin
* `git add tests .gitattributes`
* `git commit -m 'Remove screenshots'`
* `Add the expected UI test files again`
* `git add tests`
* `git commit -m 'Add screenshots using LFS'`
* Then update the submodule in core

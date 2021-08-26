---
category: DevelopInDepth
---
# Git

At Matomo we're using Git version control system. Below are some tips for using git.

## Prerequisites

* [Git LFS needs to be installed](https://github.com/git-lfs/git-lfs/wiki/Installation)

## Cloning a repository

Github supports cloning via HTTPS and SSH URLs. You will always want to use SSH URLs when cloning a repository, for example `git@github.com:matomo-org/matomo.git`

To clone a repository use for example:

`git clone git@github.com:matomo-org/matomo.git matomo`

This would clone the Matomo repository into a `matomo` directory.

## Creating a new branch

Before you start coding on a new feature, you should make sure to keep your changes separate from the main branch. This will allow you to [create a pull request from this branch later which can then be reviewed](/guides/pull-request-reviews).

We'll give our new branch a name. The branch name ideally always contains the GitHub issue number eg `1111` or `m1111` or if it's a Jira issue then eg `dev-1111`. Optionally, a descriptive name can be added if wanted. It's not a requirement though since the branch usually exists only temporarily anyway and a PR with description etc often exists too. To add a new branch, run the following command:

```bash
git checkout -b bugfix $BASE_BRANCH
```

Where you need to replace `$BASE_BRANCH` with the current main branch. This is for example `*.x-dev` when working on Matomo On-Premise (`4.x-dev` is the main branch at the time of writing this). For Matomo for WordPress this would be `develop`. For example: `git checkout -b bugfix 4.x-dev`. This way it will create a new branch from the `4.x-dev` branch. Otherwise, if you don't specify the base branch and you are already in another branch that has changes, then it would copy all changes from the current branch into the new branch.

The checkout command will create a new branch if the `-b` option is supplied, otherwise it will try to load an existing branch.

## Adding, committing and pushing code

After you added or modified a few files you will want to push these changes to the remote repository. It's good to commit regularly even if a feature is not finished yet so you always have a backup if changes get lost for some reason.

### Add files

You will first want to execute `git status` to see which files have been modified.

To see what you changed in these files you can execute the command `git diff`. If you only want to see changes for a specific file or directory then you can list multiple files or directories as arguments like `git diff file1 file2 dir1`.

Once you are satisfied with the changes `git diff` shows you, you can add those files so they can be later committed and pushed. So far these files are called "unstaged" and once you add files then these will be "staged". Any added file will be included in your next commit.

The command to add files and directories is similar as `git diff` in the sense of you can add multiple file and directory paths to define which ones should be added:

```bash
git add index.php lang-directory file2
```

You don't have to add all files at once. You can add them over multiple comments before committing them:

```bash
git add index.php 
git add lang-directory file2
```

In some cases you might prefer the following command which asks you interactively which changes you want to add or not:

`git add -p`

You shouldn't execute a command like `git add --all` to add all files as chances are you might add some files you didn't want to add.

### Verifying the changes

Before we move on to the next step of committing these added changes you will want to first verify what changes you added. To do this run the command:

```bash
git diff --cached
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

In Matomo the commit messages are less important as we are usually creating a pull request and then squash all the commits into one commit when merging the PR. The title of the pull request will become the commit message.

When you make a commit then these commits are not yet sent to any remote server. You can do one or multiple commits before actually pushing these files to a remote server which we will go into the next step.

### Reviewing the last commit

If you committed changes and want to see what the last commit looked like then you can execute `git show`.

#### Undo last commit that is not pushed yet without losing the changes

```git reset --soft HEAD~1```

This can be useful if you committed something that you didn't want to commit. The command will undo the last commit but keep the changes.

### Pushing changes

You can push changes using the command `git push`. If you are working on a branch then you may need to define the name of the so called "remote" (which is usually `origin`) and the name of the branch you want to push. For example, if you created a branch `myfeature` then you need to execute `git push origin myfeature`.

Pushing means it will send all the previous commits to the remote server which is github.com. You will then see the branch appear there and Travis will automatically run our suite of automated tests.

When you visit the repository you pushed the change to on github.com  then GitHub will directly show you branch you pushed to on the main page and you can click on it and inspect the changes. You then either make more pushes or if you are happy with the changes or seek feedback then you [create a pull request](/guides/pull-request-reviews).

## Submodules

### Accidentally Commited Submodules?

Have you done some work on Matomo or another project and accidentally overridden the submodule commit?

This may help you find your commands to recover.

```
git checkout 4.x-dev             # main branch, sometimes also called master
git submodule init
git submodule update --recursive
git checkout m-17640             # your branch where you did the wrong commit
git checkout 4.x-dev plugins/Morpheus/icons
                                 # main branch
                                 # submodule that was wrong
git add plugins/Morpheus/icons   # add the submodule back in its original state
git commit -m 'revert git submodule to 4.x-dev version #17640'
                                 # commit the changes
```

## Other useful commands

### Log Changes

```git log -p```

You can log all changes that have happened to see exactly what was changed when and by who.

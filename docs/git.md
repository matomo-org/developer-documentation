---
category: DevelopInDepth
---
# Git

At Matomo we're using Git version control system. Below are some tips for using git.

## Commits

### Undo last commit that is not pushed yet without losing the changes

```git reset --soft HEAD~1```

This can be useful if you committed something that you didn't want to commit. The command will undo the last commit but keep the changes.

### Patch Add

```git add -p```

With this you can add your changes interactively.

### Log Changes

```git log -p```

You can log all changes that have happened to see exactly what was changed when and by who.

### Show Changes of Current Working Tree or Branch with another Commit/Branch

```git diff 4.x-dev```

### Bisect (Binary - Fastest Search) for Commit That Breaks Something

```
git bisect start
git bisect good
git bisect bad
```

This is the most efficient way to find a commit that introduced a bug.

If you have an automatic test for this, even better and you can find the commit/change that introduced the bug automatically. There are more details [on the documentation](https://git-scm.com/docs/git-bisect#_bisect_run) website how to do this.

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

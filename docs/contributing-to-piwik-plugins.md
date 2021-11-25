---
category: DevelopInDepth
---

# Contributing to Matomo Plugins

### Commit messages to not trigger any release.

After your pull request is accepted and merged, the plugin needs to be released. Matomo tracks pushes to Matomo plugins using webhook.
This helps us in releasing new versions, however if you want to make certain changes and those changes should not create a new release, you need to include `[ignore_release]` keyword in your commit message`. 

Eg commit message: `{YOUR_COMMIT_MESSAGE} [ignore_release]`
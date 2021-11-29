---
category: DevelopInDepth
---

# Contributing to Matomo Plugins

### Commit message keyword to not track changes.

After your pull request is accepted and merged, Matomo uses webhooks to keep track of pushes in main branch.
This changes are weekly notified to the team, so that new version of plugin can be released, however if the changes made by you in plugins should not be notified weekly and no new release is required you need to include `[ignore_release]` keyword in your commit message.

Eg commit message: `{YOUR_COMMIT_MESSAGE} [ignore_release]`
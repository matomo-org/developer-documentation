---
category: DevelopInDepth
---

# Contributing to Matomo Plugins

### Commit message keyword to not track changes.

After your pull request is accepted and merged, Matomo uses webhooks to keep track of commits in the main branch.

All commit messages for a plugin are sent to the team on a regular interval. This way the team knows a new version of a plugin needs to be released. However, if a merged commit should not result in a new release (for example because it only fixes tests), then you need to include `[ignore_release]` keyword in your commit message. This way the plugins team won't be notified about this commit.

Example commit message: `{YOUR_COMMIT_MESSAGE} [ignore_release]`

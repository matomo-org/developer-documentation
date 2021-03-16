---
category: DevelopInDepth
title: Reproducing Issues
---
# Matomo core - Reproducing Issues

## Test Example Scripts

We have a [repository with various examples](https://github.com/matomo-org/test-examples) that let you easily test or reproduce a specific feature. For more information about this check out the repository.

### Adding new examples

There aren't any restrictions on what examples to put in this repository. The idea is that whenever we need to test or reproduce something, we check if an example already exists and if not, then we think about whether it may be useful to add one to the above repository so others can reuse it in the future if we find ourselves building such a page anyway.

Regarding keeping them up to date: Since we mostly keep BC they shouldn't regress too much and if they do become outdated, that may be fine as we'd notice this when testing an example.

While we build new features or fix bugs (mostly tracking related) we build such pages often for ourselves anyway and the idea is to share these pages with the team so they can be reused in the future. There is no obligation to add such a page as part of building a feature although it would be great to do in some cases as it would be mostly needed anyway for the author of a new feature/bugfix as well as the tester.

## Matomo System Report

If you can't reproduce an issue easily, then it may be useful to ask a user to provide the [Matomo system report](https://matomo.org/faq/troubleshooting/how-do-i-find-and-copy-the-system-check-in-matomo-on-premise/) which will be anonymised automatically and it should be safe to share in a GitHub comment. Alternatively, this could be posted to us by email.
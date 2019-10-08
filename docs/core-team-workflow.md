---
category: DevelopInDepth
---
# The Core Team Workflow

## About this guide

This guide describes how we, the team of developers that makes changes to Piwik Core, operate and how others can participate in our work.

**Read this guide if**

* you'd like to know **how the core team works**
* you'd like to know **how to reach the core team**
* you'd like to know **how to submit a bug report or feature request**
* you'd like to know **how to take part in core development by submitting a pull request**

**Guide assumptions**

**This guide makes no assumptions.** You do not need to know how to code or know how Piwik works in order to understand this guide.

## How we manage our work

We use **[Github](https://github.com/matomo-org/matomo/issues)** to keep track of all bugs, feature requests and tasks that concern Piwik, the website and Piwik's documentation.

We make sure all tickets contain enough information, including:

* if a bug, details regarding how to reproduce it,
* if a new feature, explain the use case with suggestions or a specification,
* if a UI improvement, mockups or a detailed description of the changes.

We are rather obsessed with keeping our issue tracker an organized place.
Tickets are either of the type 'Bug', 'Enhancement' or 'Task'.
Developers (Piwik team members or external contributors) decide for themselves which features they would like to work on, with the highest priority given to issues in the next version milestone. We have been using an issue tracker since [the beginning of the project](https://piwik.org/history/). 

## How we organise issues

### Milestones
All opened tickets are grouped in [Milestones](https://github.com/matomo-org/matomo/issues/milestones). Click the menu link 'Milestones' [in github issues](https://github.com/matomo-org/matomo/issues).
The versions milestones are listed at the very top and contains all the most important issues to close in accordance with [our vision for the Piwik analytics platform](https://piwik.org/roadmap/).

Most important issues and bugs are moved to [Short term milestone](https://github.com/matomo-org/matomo/milestones/Short%20term).
This milestone is our active tickets backlog. From time to time, we move one ticket from `Short term` to the current version milestone (eg. `Piwik 3.0.0`).

Other suggestions, tasks and feature requests which we haven't yet scheduled are moved to the [Mid term](https://github.com/matomo-org/matomo/milestones/Mid%20term) or [Long term](https://github.com/matomo-org/matomo/milestones/Long%20term) milestones.

### Labels
Most important labels are tagged to issues:
[Privacy](https://github.com/matomo-org/matomo/labels/c:%20Privacy),
[Security](https://github.com/matomo-org/matomo/labels/c:%20Security),
[Performance](https://github.com/matomo-org/matomo/labels/c:%20Performance),
[Tests & QA](https://github.com/matomo-org/matomo/labels/c:%20Tests%20&%20QA),
[Usability](https://github.com/matomo-org/matomo/labels/c:%20Usability),
[Platform](https://github.com/matomo-org/matomo/labels/c:%20Platform),
[Marketplace](https://github.com/matomo-org/matomo/labels/c:%20Marketplace) and
[Website piwik.org](https://github.com/matomo-org/matomo/labels/c:%20Website%20piwik.org).

Other important labels used are for [Critical](https://github.com/matomo-org/matomo/labels/Critical) and [Major](https://github.com/matomo-org/matomo/labels/Major) issues.
New developers can quickly make an impact by hacking on an [Easy pick](https://github.com/matomo-org/matomo/labels/Easy%20pick) issues.

## How we release new versions

### Frequent releases
We try to publish a new Piwik release [about once a month](https://piwik.org/faq/new-to-piwik/faq_18926/). A release is ready when the following release conditions are met:

- Our [continuous integration tests](https://piwik.org/qa/) must be green.
- All critical tickets [to the corresponding milestone](https://github.com/matomo-org/matomo/issues/milestones) must be closed.
- All [officially supported plugins](https://plugins.matomo.org/developer/matomo-org) (built by Matomo) available on the [Marketplace](https://plugins.matomo.org/) must be compatible.

Generally we will release several beta releases to give early access and ensuring continuous testing of Piwik.

To publish a new Piwik version, the release manager will tag the new version in git (see [all release tags](https://github.com/matomo-org/matomo/tags)).
A shell script is then run to generate the archives (zip and tar.gz) which are [cryptographically signed](https://piwik.org/blog/2014/11/verify-signatures-piwik-packages/) and then copied to the build server [builds.piwik.org](https://builds.piwik.org/) and [builds.piwik.org/LATEST](https://builds.piwik.org/LATEST) is updated with the latest stable release number.
Within hours, Piwik installations will be updated by users via the one click [upgrade mechanism](https://piwik.org/docs/update/) &ndash; or by manual upgrades.

Releases that contain the string "alpha", "beta", "rc", are built for testing purposes and are not advertised on [piwik.org](https://piwik.org).
They are however made available on the build server and the [builds.piwik.org/LATEST_BETA](https://builds.piwik.org/LATEST_BETA) is updated to contain the release's version string.
You can enable Piwik to use the latest Beta release automatically if you want to test the latest features ([see this faq to learn how](https://piwik.org/faq/how-to-update/#faq_159)).

### Changelog

The [Changelog](https://piwik.org/changelog/) is then updated with a new entry for this release.
The changelog typically lists all tickets closed in this release, and point people to the newest [FAQs](https://piwik.org/faq/) and [User guides](https://piwik.org/faq/).

## How we manage source code

The Piwik git repository is hosted at [Github](https://github.com) and is publicly accessible at [https://github.com/matomo-org/matomo](https://github.com/matomo-org/matomo).

As of 2014, we manage [over fourty repositories at Github](https://github.com/matomo-org). This includes the [main repository for Piwik](https://github.com/matomo-org/matomo) and several plugins, themes, and toolsets to make the most out of Piwik, such as Piwik clients for software development in Python, Ruby, C#, SDKs for iOS, debian packages and other useful Piwik developer tools.

#### Git Owners

All developers from the Piwik organization can push to all git repositories.

#### Git commit process

All code committed to git is reviewed by at least one other developer in the team. Very often, Piwik developers themselves will send bigger changes by pull request for review before committing. All pull requests or patches submitted by external developers are extensively reviewed.

It is highly recommended that code committed in the [master branch](https://github.com/matomo-org/matomo) respects the [Piwik coding standards](https://piwik.org/participate/coding-standards), does not cause tests to fail, and does not create regressions in the UI or the platform. And the commit message should reference a ticket number in almost all cases; for example,

    fixes #159 - changed patch to use wrapInner() instead of wrap()

This message will automatically close the ticket [#472](https://github.com/matomo-org/matomo/issues/472).
You can also use simply `#159` and a comment will be automatically added to the ticket #159 with a link to the commit on Github.

When applicable, the related [online documentation](https://piwik.org/docs/) and the related [FAQs](https://piwik.org/faq/) should be updated.


#### Git repository push access

To gain push access to the Piwik code repositories, one must make positive changes in the project, such as  [contributing pull requests](https://developer.piwik.org/guides/contributing-to-piwik-core), bringing new ideas, code, marketing, product visions. When a certain amount of work has been achieved, when we trust your skills and judgement, we will invite you to [join us in the core team](https://piwik.org/team/).


## Getting in touch with Core Team

### In the forums

Join us in the forums at [forum.piwik.org](https://forum.piwik.org)

Discover our vibrant community where analytics tips are shared, suggestions on how to make the most out of Piwik, or general questions. Several team members visit the forums regularly, as well as active members of the community.

### By email

You can contact the team by email: <a href='mailto:hello@matomo.org?subject=Contact the Piwik team'>hello (at) piwik.org</a>, or using [the contact form](https://piwik.org/contact/).

### Using IRC

Some team members may be available in IRC at [irc.freenode.net/#piwik](irc://irc.freenode.net#piwik) ([webchat](https://webchat.freenode.net/?channels=piwik&uio=MTE9NTE3a)).

## Influencing Piwik development

There are many ways you can make a difference in the project and influence the overall goodness of Piwik, most of which do not include coding.

### Comment on existing issues

If you find a new feature request very exciting or important, or if you're experiencing a particular bug, the best way to be heard by the Piwik team is to comment on the ticket. Features that are most requested are often higher on the priority list.

### Submitting a bug report

One way to help core development is to submit a report when you find a bug.

If you believe you have found a bug in Piwik, please do the following:

* make sure you are using the latest [Piwik release](https://piwik.org/download/)
* search in the [forum](https://forum.piwik.org/), [FAQ](https://piwik.org/faq/) and the [issue tracker](https://github.com/matomo-org/matomo/issues) if a similar or the same bug has already been reported.
* if your bug seems new, try to identify the steps to reproduce it.
* if you are ready to report a bug, register an account [in the issue tracker](https://github.com/matomo-org/matomo/issues), login and [create a new ticket](https://github.com/matomo-org/matomo/issues/new)
* make sure the title and description are as descriptive and clear as possible. Is the issue new to you, or has it always failed? If you give a clear description, you will help developers trying to reproduce and fix the issue.
* in the ticket, post instructions on how to reproduce the bug, add data sets if applicable, screenshots. Also include details about relevant parts of your configuration (browser, OS, PHP version, etc.).

### Submitting a feature request

Anyone can contribute to Piwik by submitting a feature request. You can discuss with other users what can be improved in Piwik in the [Feature Suggestions forum](https://forum.piwik.org/c/feature-suggestions), or search if someone reported your suggestion before in the [Piwik issue tracker](https://github.com/matomo-org/matomo/issues). If you find an existing issue, leave a comment to make your voice heard. Otherwise [create a new issue](https://github.com/matomo-org/matomo/issues/new) describing how Piwik can be improved to help you in your daily work (ideally explain why this is important, what problem it would solve for you, and maybe some suggestion on how it could be done). 

## Contributing to Piwik


### Contributing code

If you can code and want to directly help Piwik development, you can contribute changes! read our [Contributing to Piwik Core](/guides/contributing-to-piwik-core) guide to learn more.

### Other ways to contribute!

There are other useful ways to participate to Piwik and make a positive difference! Learn more: [How do I get involved?](https://piwik.org/get-involved/)

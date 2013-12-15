# Core Team Workflow

## About this guide

This guide describes how we, the team of developers that makes changes to Piwik Core, operate and how others can participate in our work.

**Read this guide if**

* you'd like to know **how the core team works**
* you'd like to know **how to reach the core team**
* you'd like to know **how to submit a bug report or feature request**
* you'd like to know **how to take part in core development by submiting a patch or pull request**
* you'd like to know **how to try and get your plugin included in Piwik Core**

**Guide assumptions**

**This guide makes no assumptions.** You do not need to know how to code or know how Piwik works in order to understand this guide.

## How we manage our work

We use **[trac](http://dev.piwik.org/trac)** to keep track of all bugs, feature requests, and other tasks concerning Piwik, the website and all documentation.

We make sure all tickets contain enough information, including:

* if a bug, details regarding how to reproduce it,
* if a new feature, some sort of specification,
* if a UI improvement, mockups or detailed a description of the changes.

We are rather obsessed with keeping trac an organized place. Tickets are generally prioritized tickets by severity (e.g. bugs). Developers (Piwik team members or external contributors) decide for themselves which features they would like to implement.

While we are aiming to implement the features in our roadmap, we are also open to accept new [unplanned features](http://dev.piwik.org/trac/query?status=assigned&status=new&status=reopened&group=status&milestone=Feature+requests) when the code and documentation meet our quality standards.

### Our release process

A release is ready when all assigned tickets [to the corresponding roadmap](http://dev.piwik.org/trac/roadmap) are closed. When this happens, and the release is considered **stable**, the release is tagged with the release number (see [all tags](https://github.com/piwik/piwik/tags)).

A shell script is run by the release manager to generate the archives (zip and tar.gz) which are copied to the build server [builds.piwik.org](http://builds.piwik.org/). The file [builds.piwik.org/LATEST](http://builds.piwik.org/LATEST) is updated with the latest stable release number. Within hours, thousands of Piwik installations will be updated by users via the one click upgrade mechanism – or manual upgrade.

Releases that contain the string “alpha”, “beta”, “rc”, are built for testing purposes and are not advertised on [piwik.org](http://piwik.org). They are, however, made available on the build server and the [builds.piwik.org/LATEST_BETA](http://builds.piwik.org/LATEST_BETA) is updated to contain the release's version string. You can enable Piwik to use the latest Beta release automatically if you want to test the latest features ([see this faq to learn how](http://piwik.org/faq/how-to-update/#faq_159)).

### Source Code Management

The Piwik git repository is hosted at [Github](https://github.com) and is publicly accessible at [https://github.com/piwik/piwik](https://github.com/piwik/piwik).

In case Github goes down, we maintain a backup Git Mirror at: [git.piwik.org](http://git.piwik.org).

#### Git Owners

All developers from the [Piwik team](http://piwik.org/the-piwik-team/) can commit to the git repo.

- Matthieu Aubry ([mattab](https://github.com/mattab)) is Release manager.
- Thomas Steur ([tsteur](https://github.com/tsteur)) owns the [Piwik Mobile app](http://piwik.org/mobile/).
- Cyril B. (CyrilB) is our resident Python guru and owns the [Log Analytics](http://piwik.org/log-analytics/) tool.

### Git commit process

All code committed to git is reviewed by at least one other developer in the team. Very often, Piwik developers themselves will send bigger changes by pull request for review before committing. All pull requests or patches submitted by external developers are extensively reviewed.

It is highly recommended that code committed in the [master branch](https://github.com/piwik/piwik) respects the [Piwik coding standards](http://piwik.org/participate/coding-standards), does not cause tests to fail, and does not create reressions in the UI. It is also highly recommended that the [UI be manually tested](http://piwik.org/participate/user-interface) if the user interface is affected by the change. Finally, the commit message should reference a ticket number when applicable; for example,

    fixes #159 - changed patch to use wrapInner() instead of wrap()

This message will automatically close the ticket [#159](http://dev.piwik.org/trac/ticket/159) in trac. You can also use the magic keyword

    Refs #159

and a comment will be automatically added to the ticket #159 with a link to the commit on Github.

When applicable, the related [online documentation](http://piwik.org/docs/) and the related [FAQs](http://piwik.org/faq/) should be updated.

## Participating in core development

There are many ways to participate in core development, most of which do not include coding. Read on to learn all the ways you can contribute to Piwik:

### Submitting a bug report

One way to help core development is to submit a report when you find a bug.

If you believe you have found a bug in Piwik, please do the following:

* make sure you are using the latest [Piwik release](http://piwik.org/participate/?page_id=348)
* search in the [forum](http://forum.piwik.org/), [FAQ](http://piwik.org/participate/?page_id=73) and the [bug tracker](http://dev.piwik.org/) if a similar or the same bug has already been reported.
* if your bug seems new, do you understand how to reproduce it?
* if you are ready to report a bug, register an account [in the bug tracker](http://dev.piwik.org/), login and create a new ticket
* make sure the title and description are as descriptive and clear as possible. In the bug description, please post instructions on how to reproduce, data sets that show the error if possible, screenshots, what exactly is not working? Is the issue new to you, or has it always failed? If you give a clear description, you will greatly help developers trying to reproduce and fix the issue.

### Submitting a feature request

Another way to contribute is to submit a feature request when you realize there is something you need that is missing in Piwik.

You can tell us what we can do to improve Piwik in the [Feature Suggestions forum](http://forum.piwik.org/index.php?showforum=3). Please check that it is not already in the [list of Piwik tickets](http://dev.piwik.org/trac/query?status=new&status=assigned&status=reopened&group=milestone&order=priority).

When submitting a significant new feature, it is highly recommended to be as descriptive as possible when creating a ticket. The ticket should contain

- a description of the product vision
- a few use cases to show how useful this feature would be
- mockups of what the new screens would be and how the existing screens would have to change
- if applicable, examples of how the feature is implemented in other existing tools

Please put as much information as possible as it will help in estimating the effort of the task and in determining how doable it would be (by the Piwik core team or a Piwik consultant). We will help with any technical details and questions outlined in the ticket.

### Contributing code

And of course if you can code and want to directly help Piwik development, you can contribute changes. To learn about contributing code changes, read our [Contributing to Piwik Core](/guides/contributing-to-piwik-core) guide.

### Submitting a plugin

If you've already developed a plugin that you think should be included in Piwik Core, you can offer it for inclusion. The adoption of a plugin into the Piwik core requires that we consider such criteria as (but not limited to):

- audience – plugin appeals to a broad spectrum of users
- desirabilty – is it a frequently requested feature by the Piwik community?
- functionality – feature completeness
- testability – use of unit tests and impact to manual testing (e.g., differences when plugin is activated vs deactivated)
- maturity – history and popularity of the plugin
- performance – impact on archiving and/or UI interaction
- supportability – likelihood of spawning support tickets and forum posts of the “how do I?” or “why does it?” variety
- complexity – simpler is better; +1 if developer has git commit privileges
- dependencies – does it depend on closed source and/or paid subscription services?
- licensing – license compatibility with GPLv3

In most cases, it should be enough for your plugin to be available on the [marketplace](http://plugins.piwik.org).

### Becoming a Core Contributor

If you want to become a core contributor and gain commit access to our git repository, simply continue to contribute patches and pull requests. When a certain amount are accepted and we trust your skills and judgement, we'll give you commit and add you to the core team.

## Getting in touch with the Core Team

There are several ways to talk to the Piwik team:

### Through our mailing lists

There are three mailing lists you can subscribe to and use to communicate with core team members:


- piwik-hackers [Archives](http://lists.piwik.org/pipermail/piwik-hackers/), [Subscribe](http://lists.piwik.org/cgi-bin/mailman/listinfo/piwik-hackers), [Search the archives](http://www.google.com/coop/cse?cx=012634963936527368460%3Akcozfhhm0io)

  This mailing list is used to discuss Piwik internals, ask questions about the architecture, discuss new ideas, etc.

- piwik-git [Archives](http://lists.piwik.org/pipermail/piwik-git/) (or [older svn](http://lists.piwik.org/pipermail/piwik-svn/)), [Subscribe](http://lists.piwik.org/cgi-bin/mailman/listinfo/piwik-git), [Search the archives](http://www.google.com/coop/cse?cx=012634963936527368460%3Afzsqvqnvzoi)

  This mailing list notifies all the commits to our [Git repository](https://github.com/piwik/piwik).

- piwik-trac [Archives](http://lists.piwik.org/pipermail/piwik-trac/), [Subscribe](http://lists.piwik.org/cgi-bin/mailman/listinfo/piwik-trac), [Search the archives](http://www.google.com/coop/cse?cx=012634963936527368460%3Apjvqvv4fcvk)

  This mailing list notifies all the changes to tickets in Trac (new ticket, closed, modifications, new comments, etc.)

### Using IRC

Some core team members are available via IRC at [irc.freenode.net/#piwik](irc://irc.freenode.net#piwik) ([webchat](http://webchat.freenode.net/?channels=piwik&uio=MTE9NTE3a)).
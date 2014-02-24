# Core Team Workflow

## About this guide

This guide describes how we, the team of developers that makes changes to Piwik Core, operate and how others can participate in our work.

**Read this guide if**

* you'd like to know **how the core team works**
* you'd like to know **how to reach the core team**
* you'd like to know **how to submit a bug report or feature request**
* you'd like to know **how to take part in core development by submiting a pull request**

**Guide assumptions**

**This guide makes no assumptions.** You do not need to know how to code or know how Piwik works in order to understand this guide.

## How we manage our work

We use **[trac](http://dev.piwik.org/trac)** to keep track of all bugs, feature requests and other tasks concerning Piwik, the website and all documentation.

We make sure all tickets contain enough information, including:

* if a bug, details regarding how to reproduce it,
* if a new feature, explain the use case with suggestions or a specification,
* if a UI improvement, mockups or a detailed description of the changes.

We are rather obsessed with keeping trac an organized place. Tickets are generally prioritized tickets by severity. Tickets are either of the type 'Bug', 'New feature' or 'Task'. All Bugs are moved to the current roadmap because of our [no-bug policy](http://piwik.org/roadmap/). Developers (Piwik team members or external contributors) decide for themselves which features they would like to work on.

## Roadmaps and Backlog

Trac, Piwik's official issue tracker, has been used since [the beginning of the project](http://piwik.org/history/). All opened tickets are grouped in [Roadmaps](http://dev.piwik.org/trac/roadmap). Click the menu link 'Roadmap' [in trac](http://dev.piwik.org). The Current roadmap is listed at the very top and contains all the most important tickets to fix in accordance with our [mission and vision for the Piwik analytics platform](http://piwik.org/roadmap/).

All other important and exciting tickets are moved to [The Great Piwik 2.x Backlog](http://dev.piwik.org/trac/query?status=assigned&status=new&status=reopened&milestone=2.x+-+The+Great+Piwik+2.x+Backlog&group=priority&col=id&col=summary&col=owner&col=type&col=priority&col=component&col=time&order=priority). This roadmap is our active Tickets Backlog. From time to time, we move one ticket from the Great Piwik 2.x Backlog to the current roadmap.

Other ideas and suggestions which we are not planning to implement in the future are moved to the [Future Releases roadmap](http://dev.piwik.org/trac/query?status=assigned&status=new&status=reopened&milestone=Future+releases&group=priority&col=id&col=summary&col=owner&col=type&col=priority&col=component&col=time&order=priority).

## Our release process

We generally publish a new Piwik release about once a month. A release is ready when the following release conditions are met. Our [continuous integration tests](http://piwik.org/qa/) must be green. Generally we will release several beta releases to give early access and ensuring continuous testing of Piwik. All critical tickets [to the corresponding roadmap](http://dev.piwik.org/trac/roadmap) must be closed.

To publish a new Piwik version, the release manager will tag the new version in git (see [all release tags](https://github.com/piwik/piwik/tags)). A shell script is then run to generate the archives (zip and tar.gz) which are copied to the build server [builds.piwik.org](http://builds.piwik.org/). The file [builds.piwik.org/LATEST](http://builds.piwik.org/LATEST) is updated with the latest stable release number. Within hours, Piwik installations will be updated by users via the one click [upgrade mechanism](http://piwik.org/docs/update/) &ndash; or by manual upgrades.

The Changelog is then updated with a new entry for this release. The changelog typically lists [all tickets closed in this release](http://dev.piwik.org/trac/report/1), and point people to the newest [FAQs](http://piwik.org/faq/) and [User guides](http://piwik.org/faq/).

Releases that contain the string "alpha", "beta", "rc", are built for testing purposes and are not advertised on [piwik.org](http://piwik.org). They are, however, made available on the build server and the [builds.piwik.org/LATEST_BETA](http://builds.piwik.org/LATEST_BETA) is updated to contain the release's version string. You can enable Piwik to use the latest Beta release automatically if you want to test the latest features ([see this faq to learn how](http://piwik.org/faq/how-to-update/#faq_159)).


## Source Code Management

The Piwik git repository is hosted at [Github](https://github.com) and is publicly accessible at [https://github.com/piwik/piwik](https://github.com/piwik/piwik).

In case Github goes down, we maintain a backup Git Mirror at: [git.piwik.org](http://git.piwik.org).

#### Git repositories

As of 2014, we are managing [over twenty repositories at Github](https://github.com/piwik). This includes the [main repository for Piwik](https://github.com/piwik/piwik) and several plugins, themes, and toolsets to make the most out of Piwik, such as Piwik clients for software development in Python, Ruby, C#, SDKs for iOS, debian packages and useful Piwik developer tools.

#### Git Owners

All developers from the [Piwik team](http://piwik.org/the-piwik-team/) can push to all git repositories.

### Git commit process

All code committed to git is reviewed by at least one other developer in the team. Very often, Piwik developers themselves will send bigger changes by pull request for review before committing. All pull requests or patches submitted by external developers are extensively reviewed.

It is highly recommended that code committed in the [master branch](https://github.com/piwik/piwik) respects the [Piwik coding standards](http://piwik.org/participate/coding-standards), does not cause tests to fail, and does not create regessions in the UI or the platform. It is also highly recommended that the [UI be manually tested](http://piwik.org/participate/user-interface) if the user interface is affected by the change. Finally, the commit message should reference a ticket number in almost all cases; for example,

    fixes #159 - changed patch to use wrapInner() instead of wrap()

This message will automatically close the ticket [#159](http://dev.piwik.org/trac/ticket/159) in trac. You can also use the magic keyword

    Refs #159

and a comment will be automatically added to the ticket #159 with a link to the commit on Github.

When applicable, the related [online documentation](http://piwik.org/docs/) and the related [FAQs](http://piwik.org/faq/) should be updated.

## How do I become an official Piwik team member?

All [Piwik team members](http://piwik.org/team/) have contributed major improvements to the project. They have contributed their talent towards our common goal of building the best open analytics platform. Some of these achievements were feats of engineering, as documented on our [blog posts](http://piwik.org/blob/) over the last few years.

To gain push access to our git repository, and be an official Piwik team member, one must make positive changes in the project, such as  [contributing pull requests](http://developer.piwik.org/guides/contributing-to-piwik-core), bringing new ideas, code, marketing, product visions. When a certain amount of work has been achieved, when we trust your skills and judgement, we will invite you to [join us in the core team](http://piwik.org/team/). Most of us also meet once a year in a beautiful European city for brainstorming the future of analytics, open source, [privacy](http://piwik.org/blog/2014/01/data-privacy-day-january-28th/) and Piwik.

There are other useful ways to participate to Piwik without joining the team, learn more: [How do I get involved?](http://piwik.org/get-involved/).

## Getting in touch with the Core Team

### In the forums

Join us in the forums at [forum.piwik.org](http://forum.piwik.org)

Discover our [vibrant Piwik community](http://forum.piwik.org/) where analytics tips are shared, suggestions on how to make the most out of Piwik, or general questions. Several team members visit the forums regularly, as well as active members of the community.

### By email

You can contact the team by email <a href='mailto:hello@piwik.org?subject=Contact the Piwik team'>hello (at) piwik.org</a>.

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

## Influencing Piwik development

There are many ways you can make a difference in the project and influence the overall goodness of Piwik, most of which do not include coding. Read on to learn all the ways you can contribute to Piwik:

### Comment on existing tickets

If you find a new feature request very exciting or important, or if you experience a particular bug, the best way to be heard by the Piwik team is to comment on the ticket. This will help us schedule with higher priority the features that are most often requested and commented on.

### Submitting a bug report

One way to help core development is to submit a report when you find a bug.

If you believe you have found a bug in Piwik, please do the following:

* make sure you are using the latest [Piwik release](http://piwik.org/download/)
* search in the [forum](http://forum.piwik.org/), [FAQ](http://piwik.org/faq/) and the [bug tracker](http://dev.piwik.org/) if a similar or the same bug has already been reported.
* if your bug seems new, do you know the steps to follow to reproduce it?
* if you are ready to report a bug, register an account [in the bug tracker](http://dev.piwik.org/), login and create a new ticket
* make sure the title and description are as descriptive and clear as possible. Is the issue new to you, or has it always failed? If you give a clear description, you will greatly help developers trying to reproduce and fix the issue.
* In the bug description, please post instructions on how to reproduce, data sets that show the error if possible, screenshots, what exactly is not working? Also include details about relevant parts of your configuration (Browser, OS, PHP version, etc.).

### Submitting a feature request

Another way to contribute is to submit a feature request when you realize there is something you need that is missing in Piwik.

You can tell us what we can do to improve Piwik in the [Feature Suggestions forum](http://forum.piwik.org/index.php?showforum=3). Please check that it is not already in the [list of Piwik tickets](http://dev.piwik.org/trac/query?status=assigned&status=new&status=reopened&type=!Bug&group=milestone&col=id&col=summary&col=status&col=owner&col=type&col=priority&col=component&order=priority).

When submitting a significant new feature, it is recommended to be as descriptive as possible when creating a ticket. The ticket should contain

- a description of the product vision
- a few use cases to show how useful this feature would be
- mockups of what the new screens would be and how the existing screens would have to change
- if applicable, examples of how the feature is implemented in other existing tools

Please put as much information as possible as it will help in estimating the effort of the task and in determining how doable it would be (by the Piwik core team or a Piwik consultant). We will help with any technical details and questions outlined in the ticket.

### Contributing code

And of course if you can code and want to directly help Piwik development, you can contribute changes. To learn about contributing code changes, read our [Contributing to Piwik Core](/guides/contributing-to-piwik-core) guide.

### Submitting a plugin

If you've already developed a plugin that you think should be included in Piwik Core, you can offer it for inclusion. The adoption of a plugin into the Piwik core requires that we consider such criteria as (but not limited to):

- audience &ndash; plugin appeals to a broad spectrum of users
- desirabilty &ndash; is it a frequently requested feature by the Piwik community?
- functionality &ndash; feature completeness
- testability &ndash; use of unit tests and impact to manual testing (e.g., differences when plugin is activated vs deactivated)
- maturity &ndash; history and popularity of the plugin
- performance &ndash; impact on archiving and/or UI interaction
- supportability &ndash; likelihood of spawning support tickets and forum posts of the "how do I?" or "why does it?" variety
- complexity &ndash; simpler is better; +1 if developer has git commit privileges
- dependencies &ndash; does it depend on closed source and/or paid subscription services?
- licensing &ndash; license compatibility with GPLv3

In most cases, it should be enough for your plugin to be available on the [marketplace](http://plugins.piwik.org).

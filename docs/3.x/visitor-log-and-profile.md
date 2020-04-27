---
category: Develop
---
# Visitor log & profile

The visitor log in Matomo displays a list of the visits in the selected date range. By implementing a [VisitorDetails](/api-reference/Piwik/Plugins/Live/VisitorDetailsAbstract) class it is possible to extend and manipulate the displayed details.

This is how a single visit is displayed in the visitor log:

<img src="/img/visitorlog.png"/>

As you can see it's basically split into three areas. On the left side there are some basic information on the visitor displayed. You can add some content there by implementing the method `renderVisitorDetails()`.
In the middle there are some icons displayed to give an overview over some settings and details of the visit. To add some content in this section you need to implement the method `renderIcons()`.

On the right side all actions of that visit are displayed. If you want to add additional actions to that list, you can do that by implementing `provideActionsForVisit()` and `provideActionsForVisitIds()`. 

The method `filterActions()` makes it possible to manipulate the list of all actions once it was gathered. 
To extend actions of other plugins with additional details, you can use the `extendActionDetails()` method. All actions are then being displayed using the `renderAction()` method.

In addition to those methods allowing to manipulate the visitor log, the [VisitorDetails](/api-reference/Piwik/Plugins/Live/VisitorDetailsAbstract) class has some methods to enrich the details that are computed for the visitor profile.

The visitor profile summarizes all visits of a single visitor. The actions of all visits are displayed the same way as in the visitor log. So if your plugin manipulates any actions displayed in the visitor log, they will also be displayed the same way in visitor profile.

In addition to the list of visits and their actions, the visitor profile also contains a summary section. It is possible to add a summary to this section by implementing a [ProfileSummary](/api-reference/Piwik/Plugins/Live/ProfileSummary/ProfileSummaryAbstract) class. Each plugin can have multiple ProfileSummary classes, so give them a meaningful name if you have more than one. Those classes need to be located in a folder named `ProfileSummary` within your plugin.

As those summaries normally show summarized values based on all visits or actions of the visitor the [VisitorDetails](/api-reference/Piwik/Plugins/Live/VisitorDetailsAbstract) class has some additional methods that help you to do that.
When creating a visitor profile, at first the method `initProfile()` is called of each VisitorDetails class. This can be used to set/instantiate some variables / details with their default values. After that, the method `handleProfileVisit()` is called with each visit that is displayed in the profile. For each action of those visits `handleProfileAction()` is called. Those methods can so be used to calculate some values that are based on multiple visits or actions.
After iterating through all visits and actions the method `finalizeProfile()` will be triggered. This allows to do some final calculations, that might not be possible while iterating.

To get more insights on how to implement that please have a look at the linked API references of the abstract classes. For most methods there are simple examples available. Additionally, you can have a look at the already existing implementations of `VisitorDetails` and `ProfileSummary` classes already used by various core plugins. 

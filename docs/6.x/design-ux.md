---
category: DevelopInDepth
title: UX and Design
---
# User Experience & Design

It's important that as a developer we also think about the user experience which includes aspects like design, usability, and the overall look & feel in Matomo. This applies not just to the user interface but also to our [APIs](https://matomo.org/docs/analytics-api/) and the [console](/guides/piwik-on-the-command-line).

## User Experience (UX)

### What does UX mean?

It summarises many elements such as (UI) design, information architecture, usability, accessibility, the look and feel, and more.
[Learn more about UX](https://en.wikipedia.org/wiki/User_experience_design).

We try to create an intuitive user interface where a user doesn’t need much training (or none at all) on how to use it.

## Usability 

### What to pay attention to

* Keep the UI simple and not too cluttered
* Reuse common UI elements that we use and create consistency
* Use tooltips where possible to explain more about a button, link, etc.
* Consider removing not needed parts and only show them if/when they are needed
* If there is an error, mention not only what was wrong, but also how it can be fixed
* Explain in the UI what is happening so users aren't lost
* Use typography to create a hierarchy

## UI Design

### What does UI design mean and what makes good design?

[Learn more about UI design.](https://en.wikipedia.org/wiki/User_interface_design)

### Material design 

In Matomo we are using [Material Design](https://material.io/design). You will find a lot of guidelines about colors, typography, iconography, and more. There are also various [components](https://material.io/components) shown.

Matomo also includes the [Materialize CSS frontend framework](https://materializecss.com/).

### Some of our UI components

Open `https://matomo.example.org/index.php?module=Morpheus&action=demo&idSite=1&period=day&date=yesterday` (replace the domain with your local developer domain) in the browser to find a list of most popular components that can be reused in Matomo. There are also many more components that can be reused that aren't shown there.

### What to pay attention to

* Font sizes 
* Gaps / spacing between elements
* Reuse existing colors
* Reuse existing wording whenever possible
* Reuse existing icons (and they should always have the same meaning / action)

## Accessibility

### What to pay attention to

* Make sure colors have enough contrast (see [Contrast Checker](https://webaim.org/resources/contrastchecker/)).
* Use correct HTML elements, for example use `nav` for a navigation. Use table where it is a table (not `div`). Use list elements for lists, etc.
* Use clear link texts and not just "click here".

---
category: DevelopInDepth
title: Tag Manager
---
# Matomo Tag Manager In Depth

This page is mostly aimed for Matomo contributors. If you are looking for instructions on how to extend the Tag Manager please also have a look at the [Tag Manager Develop guides](/guides/tagmanager/introduction) and the [Tag Manager JS API reference](/api-reference/tagmanager/javascript-api-reference).

## What browsers do we support in the Tag Manager containers?

We support the [same browsers as the JavaScript Tracker](/guides/tracking-javascript-guide#supported-browsers) does.

Some tags, variables, or triggers may require newer browser versions though which can be fine as long as the code doesn't break in older browsers. 

## How do I minify the TagManager JavaScript file

Open the file `javascripts/tagmanager.js`. In the beginning of the file you will find a comment with instructions on how to minify the file like this:

```html
/**
 * To minify execute
 * cat javascripts/tagmanager.js ...
 */
```

## When I change tagmanager.js or a tag / trigger / variable how do I test these changes?

It's currently required to run the command `./console tagmanager:regenerate-released-containers` to update all container JS files whenever you modify any of these files.

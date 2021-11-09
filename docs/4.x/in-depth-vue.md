---
category: DevelopInDepth
---
# Vue: In Depth

This documents advanced and/or uncommon patterns found in Matomo's use of Vue.

## Stateful Directives

In Vue, directives are meant to be stateless. The same is not true in AngularJS, the previous framework Matomo
used. During the migration from AngularJS to Vue, several stateful directives were migrated using a hacky pattern.
The pattern is basically just to store state in the binding value, which must be an object that is supplied by the
user of the directive. If the value is static and is not changed by the component that uses the directive, then the
directives work as expected.

**Important: new Vue code should not create stateful directives, this is just to document the existing directives.**

Directives that do this include:

* ExpandOnHover
* ExpandOnClick
* FocusAnywhereButHere
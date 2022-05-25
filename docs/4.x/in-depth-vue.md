---
category: DevelopInDepth
---
# Vue: In Depth

This documents advanced and/or uncommon patterns found in Matomo's use of Vue.

## Vue compilation

Plugin UMD modules are compiled through the Vue CLI tool. This tool uses Webpack and passes the code in a plugin's `vue/`
directory through the TypeScript compiler, then passes that output through babel to generate the final
UMD modules.

The base configuration for webpack is determined by the Vue CLI tool, but it is customized in the `vue.config.js`
file. The webpack configuration is also partially where the TypeScript compiler is configured (the main place
being the tsconfig.json file). Babel is configured primarily in the `babel.config.js` file.

During development, TypeScript is configured to do a passthrough transpile only. This means it does very little
type checking to keep compilation times fast. For the production UMD files however, we turn on full type checking.
The output of this type information is stored in the `@types` directory, and is only needed and present during
development.

### cli-service-proxy.js

When compiling .vue files, the Vue CLI service splits out the TypeScript part of the file before feeding it into
the TypeScript compiler. If errors are detected in this part of the file, the line numbers in the output will
correspond to the location in the `<script>` element, not to the whole .vue file, which is not especially
convenient.

The `cli-service-proxy.js` file in the CoreVue plugins invokes the Vue CLI service and corrects these line numbers
in the TypeScript output. `vue:build` invokes the proxy script.

## Stateful Directives

In Vue, directives are meant to be stateless. The same is not true in AngularJS, the previous framework Matomo
used. During the migration from AngularJS to Vue, several stateful directives were migrated using a hacky pattern.
The pattern is basically just to store state in the binding value, which must be an object that is supplied by the
user of the directive. Since the value is static and cannot be changed by the component that uses the directive, this
pattern works.

**Important: new Vue code should not create stateful directives, this is just to document the existing directives.**

Some directives that do this include:

* ExpandOnHover
* ExpandOnClick
* FocusAnywhereButHere
* SelectOnFocus

## Using Vue directives on raw HTML

Generally directives are a Vue specific concept. They involve methods that deal with Vue's update cycle as well
as being mounted/unmounted (created/destroyed). Which means using them outside of Vue doesn't make sense.

However, AngularJS is different, in that it allows directives to simply exist and be invoked on any HTML. During
the migration this behavior had to be maintained. Old AngularJS directives that were meant to be used on
raw HTML outside of another stateful AngularJS component/directive had to still be invoked on raw HTML.

This is accomplished by manually invoking the migrated Vue directive's mounted/unmounted on elements with
the attribute when Matomo compiles AngularJS code. An example can be found in the Goals plugin in the
GoalPageLink directive.

This directive listens to the Matomo.processDynamicHtml JavaScript event, and manually looks for and handles
the presence of the goal-page-link attribute.

**For all new code, this pattern should be avoided, and Vue directives should not be used, or be expected
to be used on HTML.**

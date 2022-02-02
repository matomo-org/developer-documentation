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

## Stateful Directives

In Vue, directives are meant to be stateless. The same is not true in AngularJS, the previous framework Matomo
used. During the migration from AngularJS to Vue, several stateful directives were migrated using a hacky pattern.
The pattern is basically just to store state in the binding value, which must be an object that is supplied by the
user of the directive. Since the value is static and cannot be changed by the component that uses the directive, this
pattern works.

**Important: new Vue code should not create stateful directives, this is just to document the existing directives.**

Directives that do this include:

* ExpandOnHover
* ExpandOnClick
* FocusAnywhereButHere
* SelectOnFocus
* 

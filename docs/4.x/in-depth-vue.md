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

## Extending Form Fields / Custom Form Controls

Matomo provides developers with a `Field` component that is used to create individual form fields. The type
of control (checkbox, select, text field, etc.) is specified via the `uicontrol` property.

Sometimes, however, you may need something more complicated than the default form fields, something specifically
related to your plugin. For cases like this, Matomo provides the `component` property, which allows you to specify
a custom Vue component:

```html
<Field
    :component="{plugin: 'MyPlugin', component: 'MyFieldComponent'}"
/>
```

The component used must follow the following contract:

* It must follow the v-model contract. That is, it must take a `modelValue` property and emit an
  `update:modelValue` event when the value changes.
* It must accept a `name` property which should be used on the `<input>`, if the custom component uses one.
* It must accept a `title` property which should be used to label the field.
* And it can accept a `uiControlAttributes` object property if you'd like the component to offer more configuration
  options. If users want to use these options, they will bind to the `:ui-control-attributes` property on the `Field`
  component, which will be forwarded to your custom component.

And that's it, once your custom component is done and exported properly, you'll be able to use it in Vue
components (via `Field` directly) or in Matomo settings via the `FieldConfig::$customFieldComponent` property.

## Allowing plugins to add content to your Vue components

This section describes the primary technique you can use to allow other plugins to extend your Vue component.

First, decide what part of your component you'd like to add content to, then, make your component accept
component references as a property:

```vue
<template>
  <div>
    
    // ... here's where we want to allow plugins to add content ...

  </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    extensions: Array,
  },
});
</script>
```

Here, `extensions` will be an array like: `[{ plugin: 'MyPlugin', component: 'MyComponent' }, ...]`.

Then we'll use dynamic Vue `<component>`s and the `useExternalPluginComponent` function to resolve those components
at runtime:

```vue
<template>
  <div>
    <div v-for="(refComponent, index) in componentExtensions" :key="index">
      <component :is="refComponent"/>
    </div>
  </div>
</template>
<script lang="ts">
import { defineComponent, markRaw } from 'vue';
import { useExternalPluginComponent } from 'CoreHome';

export default defineComponent({
  props: {
    extensions: Array,
  },
  computed: {
    componentExtensions() {
      return markRaw(this.extensions.map((ref) => useExternalPluginComponent(ref.plugin, ref.component)));
    },
  },
});
</script>
```

The component is now extendable, we just need to allow plugins to specify components to use and supply them to
our component. For the first part, you can use a server side event:

```php
class MyController extends \Piwik\Plugin\Controller
{
    private function getComponentExtensions()
    {
        $componentExtensions = [];
        Piwik::postEvent('MyPlugin.getComponentExtensions', [&$componentExtensions]);
        return $componentExtensions;
    }
}
```

The second part depends on where we use our extendable component. If we're using it in a twig template via, vue-entry,
then we'd just supply the extensions property that way:

```php
class MyController extends \Piwik\Plugin\Controller
{
    public function myPage()
    {
        $view = new View('@MyPlugin/myPage.twig');
        $view->extensions = self::getComponentExtensions();
        return $this->renderView($view);
    }

    public static function getComponentExtensions()
    {
        $componentExtensions = [];
        Piwik::postEvent('MyPlugin.getComponentExtensions', [&$componentExtensions]);
        return $componentExtensions;
    }
}
```

```twig
<div vue-entry="MyPlugin.MyExtendableComponent" extensions="{{ extensions|json_encode }}"></div>
```

If, however, the extendable component is used directly in another Vue component, then we'll need to store
the array as a global via the `Template.jsGlobalVariables` event:

```php
class MyPlugin extends \Piwik\Plugin
{
    public function registerEvents()
    {
        return [
            'Template.jsGlobalVariables' => 'addJsGlobalVariables',
        ];
    }
    
    public function addJsGlobalVariables(&$out)
    {
        $out .= "piwik.myPluginComponentExtensions = " . json_encode(MyController::getComponentExtensions()) . ";\n";
    }
}
```

then, we use this global variable when using our component:

```vue
<template>
  <MyExtendableComponent :extensions="extensions"/>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import MyExtendableComponent from './MyExtendableComponent.vue';

export default defineComponent({
  props: {},
  components: {
    MyExtendableComponent,
  },
  computed: {
    extensions() {
      return window.piwik.myPluginComponentExtensions;
    },
  },
});
</script>
```

---
category: DevelopInDepth
---
# Getting started with Vue

Upfront: This document is working draft and far from being complete. We will improve this over time as we do more work with Vue.

## Developer Concepts

### Component State vs. Application State

Vue allows us to create state driven UI components. Components are defined based on the data they display and manipulate.
This state is said to be "owned" by the component, in that only the component can modify it. Other components, even
child components that are given that state as properties, should not be allowed or capable of changing it. This
allows us to enforce a certain level of predictability in our UI.

Some state, however, is not owned by a single component. It might be state that needs to kept synchronized among
multiple components (for example, the number of notifications in an app that provides multiple places to view them)
or something that is derived from inherently global state (such as the value of a URL query parameter). Global
state like this has to be defined outside of a component and used by whoever needs it.

In Matomo, we accomplish this via the store pattern (see https://v3.vuejs.org/guide/state-management.html#official-flux-like-implementation).
Global state is encapsulated in classes, as are the operations that manipulate them. All the data in these stores
are stored as `reactive()` properties or `ref()` values, and the store exposes `computed()` properties for
Vue components to use. Vue components that use them automatically register with the property so when the data changes
in the store, the component will automatically update itself.

Example:

```typescript
import { reactive, computed } from 'vue';

class MyStore {
  private myState = reactive({
    counter: 0,
  });

  readonly counter = computed(() => this.myState.counter);
  readonly isZero = computed(() => this.myState.counter === 0);

  increment() {
    this.myState.counter += 1;
  }
  
  decrement() {
    this.myState.counter -= 1;
  }
}

export default new MyStore();
```

```vue
<template>
  <div>
    <h2>Counter value is: {{ counter }}</h2>
    <div v-if="isZero">The counter is at zero! Press increment or decrement to change the value.</div>
    <div>
      <button @click="increment()">Increment</button>
      <button @click="decrement()">Decrement</button>
    </div>
  </div>
</template>
<script>
import { defineComponent } from 'vue';
import MyStore from './MyStore';

export default defineComponent({
  setup() {
    return {
      // NOTE: we're not using the `.value` property here because we want Vue to bind the computed
      // property in order to be notified of changes.
      counter: MyStore.counter,
      isZero: MyStore.isZero,
      increment: MyStore.increment.bind(MyStore),
      decrement: MyStore.decrement.bind(MyStore),
    };
  },
});
</script>
```

Classes implementing the store pattern should:

* define private reactive state
* only provide public readonly access to that state. This readonly access should be deep, no part of the private
  state should be modifiable by other classes.
* use computed properties, not methods, to return derived data
* provide public methods for logic that mutates the state

### Accessing and changing the URL

URLs in Matomo are mainly based on query parameters, the path and host are not normally used. The base URL's
search has a query string, and the URL hash has another query string. Both are used to determine what the
query parameter values are, with the hash query parameters overriding the search ones.

In new Vue code, the URL query parameters can be accessed and changed via the MatomoUrl store. This store
provides a computed parsed `parsed` for easily accessing query parameter values. It also provides a method,
`updateHash()` that allows developers to change the URL, and thus potentially load a new page.

An example of accessing query parameter values and modifying the hash when needed:

```typescript
import { computed } from 'vue';
import { MatomoUrl } from 'CoreHome';

class GoalsStore
{
  readonly state = reactive({
    goals: {}, // maps idGoal => goal. filled out via an ajax request not displayed
  });
  
  readonly currentGoal = computed(() => {
    const idGoal = MatomoUrl.parsed.idGoal;
    if (idGoal && this.state.goals[idGoal]) {
      return this.state.goals[idGoal];
    }
    return undefined;
  });
  
  changeGoal(idGoal: number): void {
    MatomoUrl.updateHash({
      // NOTE: updateHash will rewrite the entire hash, so it is important to include existing query parameters,
      // if you only want to overwrite one or a few parameters.
      ...MatomoUrl.parsed.value,
      idGoal,
    });
  }
}
```

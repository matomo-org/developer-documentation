---
category: DevelopInDepth
---

# Troubleshooting common Vue issues

### TypeScript complains component computed property does not exist

This error occurs sometimes with Vue components that have no props entries where
for some reason, Vue will not add computed properties to the component's `this`
type, so expressions like `this.myComputedProperty` will result in errors.

This can be fixed by adding explicit return types to your computed properties,
for instance:

```typescript
export default defineComponent({
  computed: {
    myProperty(): string {
      return 'test';
    },
  },
})
```

---
category: Integrate
---
# Data Layer

The Data Layer is a central piece within Matomo's Tag Manager as it ensures maximum flexibility.

For example, you may wish to push a value from an ecommerce order into the data layer, allowing someone who configures a container to access this value as part of a tag or trigger configuration. It also allows you to trigger an event which in turn can fire a certain tag.

This way you can integrate for example any ecommerce, CRM, marketing suite, and more into the tag manager.

## Setting a variable

You can push one or multiple values at once to the data layer by calling the `_mtm.push` method:

```js
window._mtm = window._mtm || [];
window._mtm.push({'orderTotal': 4545.45, 'orderCurrency': 'EUR'});
```

<div markdown="1" class="alert alert-info">
As the container will be loaded asynchronously and the variable `_mtm` may not be defined from the beginning, you may have to add a `var _mtm = window._mtm || [];`.
</div>

### Configuration in Matomo Tag Manager

To access this value as a variable in Matomo Tag Manager, create a new variable of type `Data Layer` and configure as `Data Layer Variable Name` for example `orderTotal`. You can now assign this variable to any trigger or tag.

## Triggering an event

Triggering an event within the container works similar as setting a variable. Simply specify a property named `event` as part of the parameters:

```js
window._mtm = window._mtm || [];
window._mtm.push({'event': 'purchase', 'orderTotal': 4545.45});
```
<div markdown="1" class="alert alert-info">
Keep in mind that this does not send an event to Matomo, but allows you to create a tag in Matomo Tag Manager that reacts based on this event.
</div>

### Configuration in Matomo Tag Manager

To create a trigger that is listening to this event in Matomo Tag Manager, create a new trigger of type `Custom Event and configure as `Event Name` the value `purchase`. You can now assign this trigger to a tag to ensure a tag will be fired or blocked whenever this event is being triggered from your website or app.

Assuming you created a variable "Order Total" for the `orderTotal` data layer variable, you could even configure a condition along the trigger to for example only trigger when `Order Total is greater than 100`.

## Best practices

* Prefix your variable names with your company or application name. For example `woocommerce.orderTotal` to avoid any potential collision with other systems. If you want to use the same container logic for example for different ecommerce systems, you may want to go for a more general prefix like `ecommerce.orderTotal`.
* Ensure the casing for the variable is correct as the data layer is case-sensitive.
* When you define a variable, you should always enclose it in quotes as otherwise JavaScript errors may occur. Instead of `window._mtm.push({order-total: 100});` use `window._mtm.push({'order-total': 100});`

## Migration from Google Tag Manager

If you have used Google's Tag Manager in the past and have specified a data layer on page load for example like this: `dataLayer = {'orderTotal': 100}` you will be happy to hear that we are supporting this as long as you have configured the data layer variable as early as possible within your website. The variable needs to be defined before the container is loaded. Please note we do not support any renamed data layer variable. The Matomo data layer will also not be updated when you push changes to the GTM data layer afterwards. It is only able to pick up the initial data layer content.

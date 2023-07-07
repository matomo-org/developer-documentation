---
category: Integrate
title: Integration Plugin
---
# How to develop a Matomo Tag Manager integration plugin for a CMS, ecommerce shop, forum, ...

This guide explains two ways to develop an integration for platforms and frameworks to embed Matomo Tag Manager containers easily into a website, or shop. The goal of such an integration is that users don't need coding skills to embed a container into their website but instead have an easy to use UI.

Ideally, an integration plugin offers both ways to give users choice on how to embed a container, but this is entirely optional.

## A simple way

The easiest way to embed a container without needing any authentication is to ask a user of the integration for their Matomo URL and a Container ID. Based on those two inputs you can generate the embed code which should look like this:

```html
<!-- Matomo Tag Manager -->
<script type="text/javascript">
  window._mtm = window._mtm || [];
  window._mtm.push({'mtm.startTime': (new Date().getTime()), 'event': 'mtm.Start'});
  (function() {
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.src='https://{$MATOMO_URL}/js/container_${CONTAINERID}.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Tag Manager -->
```

Where you replace the `${MATOMOURL}` with the configured URL and `${CONTAINERID}` with the configured Container ID.

Alternatively, you could also simply add this to the `<head>` (preferred) or `<body>` directly:

```html
<script type="text/javascript">
window._mtm = window._mtm || [];
window._mtm.push({'mtm.startTime': (new Date().getTime()), 'event': 'mtm.Start'});
</script>
<script type="text/javascript" src="${MATOMOURL}/js/container_${CONTAINERID}.js" async="true" defer="true"></script>
```

If possible, we recommend offering this simple way as users won't need to configure an API token which increases the security. Also, it is an easy way for an integration developer to implement it.

### Supporting environments

However, this method will only work for the "live" environment since all other environments have a secret "token" included in the JavaScript file like this:

`/js/container_aaacont1_dev_898b2d94bd74e27ee3d2f672.js`

Where `dev` is the environment and the part next to it is a random generated key so it cannot be guessed by anyone. The random key is different for each container and for each environment. This key prevents for example leaking upcoming changes and announcements on a website. If needed, you could ask a user to instead enter the full path to the container file.

## A more advanced way through the API

Instead of a user having to configure the Container ID, you may want to instead ask for a Matomo API `token_auth`. Through the [HTTP API](https://developer.matomo.org/api-reference/reporting-api) you can then find out which Matomo sites the user has access to, which containers are configured within a site, and fetch the embed code for this container automatically.

The advantage is that if the embed code ever changes, you won't need to update the integration and you can offer the possibility to select an environment. The downside is, that a Matomo user needs to find and configure the `token_auth` in a third-party system which always poses some kind of risk (this token also gives access to all reports etc).

To fetch all available containers, follow this pseudo code. You can learn more about the [Matomo HTTP API here](https://developer.matomo.org/api-reference/reporting-api).

```php
$matomoUrl = 'https://localhost/matomo'; // user entered this URL
$tokenAuth = '123456789012345678901234'; // user entered this token

$api = new MatomoApiClient($matomoUrl, $tokenAuth);

$environments = $api->fetch('TagManager.getAvailableEnvironments');
$sites = $api->fetch($apiMethod = 'SitesManager.getSitesWithAtLeastViewAccess');
$containersForSite = array();

foreach ($sites as $site) {
   $idSite = $site['idsite'];
   // each site may have multiple containers
   $containersForSite[$idSite] = $api->fetch('TagManager.getContainers', array('idSite' => $idSite));
}

```

Now you have a list of all Matomo sites the user has access to, and the containers within that site. You can now offer the possibility to select an environment, a site, and a container within that site.

Instead of directly fetching all containers for all sites, you could alternatively first ask the user to select a site, and once the user has selected a site, fetch all containers for that site.

When the user has select these three fields, you can now fetch the embed code for this combination like this:

```php
$scriptEmbedTag = $api->fetch('TagManager.getContainerEmbedCode', array(
   'idSite' => $idSite,
   'idContainer' => $idContainer,
   'environment' => $environment
));
print $scriptEmbedTag; // be eg <script type="">...</script>
```

<div markdown="1" class="alert alert-info">
It is highly recommended to cache the response of the embed code for a couple of hours or a day for improved page load performance.
</div>

## Supporting the Data Layer

The [data layer](https://developer.matomo.org/guides/tagmanager/datalayer) part is optional. If you don't know what the data-layer is, [check out this guide](https://developer.matomo.org/guides/tagmanager/datalayer).

Simply said, the data layer feeds additional values into the container letting users reference these values in tags, triggers or variables.

For example if you are developing an integration for an ecommerce shop, you may want to push values like these to the data layer: username, items in the cart, number of items in the cart, currently viewed product name, currently viewed product price, etc:

```js
// for example when viewing a product
window._mtm.push({'woocommerce.productName': 'My Product', 'woocommerce.productPrice': '55.45', 'woocommerce.productCurrency': 'EUR'});
```

You may also trigger events through the `event` attribute on certain actions such as when a user is ordering something, when a user adds to the cart, or when a user is viewing a product.

```js
// for example when viewing a product as event
window._mtm.push({'event': 'myshop.productView', 'myshop.productName': 'My Product', 'myshop.productPrice': '55.45', 'myshop.productCurrency': 'EUR'});

// for example when user adds a product to the cart
window._mtm.push({'event': 'myshop.addToCart', 'myshop.productName': 'My Product', 'myshop.productPrice': '55.45', 'myshop.productCurrency': 'EUR'});

// for example when user purchased a product
window._mtm.push({'event': 'myshop.purchase', 'myshop.cartTotal': '55.45', 'myshop.cartCurrency': 'EUR'});
```

A forum may add values like the currently viewed forum category, the username, etc.

```js
// for example when viewing a product
window._mtm.push({'myforum.username': 'Myusername', 'myforum.forumCategory': 'Developers'});
```

### Prefixing data layer variables

We recommend prefixing data layer variable names with the name of your integration so it does not cause any trouble with any other integrations.

### Why supporting the data layer?

The data layer allows users to access these values in an easy way within the Tag Manager and react to events that you trigger. The possibilities are endless!

For example, if you push a `myintegration.username:"username"`, users could read this value as part of the container and track the username as a [custom dimension](https://matomo.org/docs/custom-dimensions/) or [`userId`](https://matomo.org/docs/user-id/). The events you push allow users to react to it through a trigger. For example, users may want to track an event whenever a product is being viewed (the event containing the product name, price and the currency). Or they could show a popover offering a discount whenever a certain product is being added to the cart.

If you support the data layer, we highly recommend that you document all available events and variables so users can access these values and listen to these events.

## Embedding multiple containers

It is possible for a user to embed multiple containers into one page. However, this is rather advanced and not as common. You may or may not offer the possibility to configure multiple containers.

When embedding multiple containers into one website, you simply print the embed code for a container one after another.

## Validating and completing inputs

In case you want to validate, filter, or complete any user input, here are a few tips:

* **Container ID**: Such an ID is currently 8 characters long consisting of alpha numerical characters (`[a-zA-Z0-9]{8}`). The length is not expected to change but it may happen. So you may want to allow 8 to 10 characters.
* **Token Auth**: The token is currently a MD5 hash consisting of 32 characters `[a-f0-9]{32}`. This will not change as part of Matomo 3 but may change in the future.
* **Matomo URL**: The Matomo URL is a regular HTTP or HTTPS URL.

## Have you developed an integration?

Please [let us know](https://matomo.org/contact) and we list your integration on our [Matomo integration page](https://matomo.org/integrate/).

## Any questions?

Please [get in touch with us](https://matomo.org/contact) if you have any questions. We are happy to help you develop an integration for Matomo Tag Manager.

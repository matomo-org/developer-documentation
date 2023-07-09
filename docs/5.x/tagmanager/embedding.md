---
category: Integrate
---
# Embedding

This guide will explain how you can embed the JavaScript Tag Manager into your website.

## Finding the embed code

To find the code to embed your container into your website, please log in to your Matomo and click on "Tag Manager".
Now you will see a list of containers for the current selected site. Now you have two options:

* Select "Manage Containers" and click on the "Install Code" icon on the very right next to a container.
* Select a container and click on "Install code".

Further options are:

* You can find the code by going to "Administration => Tracking Code". However, you will only see the JavaScript code for environments that have currently a published version. If you just created a container, and have not published (deployed) any version to an environment, you won't find the install code there.
* You can retrieve this code snippet via the [Matomo HTTP API](/api-reference/reporting-api#TagManager) by calling the method `TagManager.getContainerEmbedCode($idSite, $idContainer, $environment)`.

The code looks as follows:

```html
<!-- Matomo Tag Manager -->
<script type="text/javascript">
  window._mtm = window._mtm || [];
  window._mtm.push({'mtm.startTime': (new Date().getTime()), 'event': 'mtm.Start'});
  (function() {
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.src='https://{$MATOMO_URL}/js/container_{$CONTAINER_ID}.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Tag Manager -->
```

In your code, `{$MATOMO_URL}` will be replaced by your Matomo URL, and `{$CONTAINER_ID}` by a combination of containerId and possibly other factors.

We recommend embedding this HTML block as early as possible within the `<head>` element of your website.

## Multiple containers

Matomo Tag Manager lets you embed multiple containers at once. This may be useful when for example different people manage different containers and you need to embed all of them. For example, one team manages all ad related containers, and another team manages all other tags.

To use both tags, simply copy both embed codes inside your website, ideally one directly followed by the other.

## Using the same container on multiple websites

Matomo Tag Managers supports using the same container in multiple websites. The container will still be stored under one website in the Tag Manager interface. To use the same container on multiple websites, simply embed the code inside your websites.

## Loading a container from your website

When a user is visiting your website, the container will be loaded through your Matomo URL. Sometimes, a Matomo URL may be blocked for example by privacy or ad blockers causing the container to not load. If you want to reduce the likelihood of this, you may want to download the JavaScript file and upload it onto the server of your website. The disadvantage is, that the debug/preview feature won't work out of the box and you always need to update the JavaScript file whenever you publish a new version to an environment.

To download the JavaScript of a container, simply open the URL in `g.src='https://{$MATOMO_URL}/js/{$CONTAINER_ID}.js'` and save the file by clicking on "File => Save As" in your browser.

## Accessing the Matomo Tag Manager directly

A container is usually loaded asynchronously. This means you won't know at which point the tag manager has been initialized. If you want to perform a certain action, as soon as the tag manager JavaScript file has been initialized, simply define the global function `window.matomoTagManagerAsyncInit`. This method will be executed as soon as the global [window.MatomoTagManager](/api-reference/tagmanager/javascript-api-reference) object is available but before any container has been set up.

```js
window.matomoTagManagerAsyncInit = function (MatomoTagManager) {
    MatomoTagManager.THROW_ERRORS = false;

}
```

---
category: Integrate
---
# Content Tracking

**Content tracking** ([see user guide](https://matomo.org/docs/content-tracking/)) allows you to track interaction with the content of a web page or application.

For example, you could use content tracking to measure how often a specific ad was displayed on your website or how often it was clicked.

This feature is not only limited to ads or images, you can use it for any kind of HTML content. 

## Vocabulary

| Term                     | Purpose                                                              |
| ------------------------ | -------------------------------------------------------------------- |
| Content block            | Is a container which consists of a content name, piece and a target. |
| Content name             | A name that represents a content block. The name will be visible in reports. One name can belong to different content pieces. |
| Content piece            | This is the actual content that was displayed, eg a path to a video/image/audio file, a text, ... |
| Content target           | For instance the URL of a landing page where the user was led to after interacting with the content block. In a single page website it could be also the name of an anchor. In a mobile app it could be the name of the screen you are going to open. |
| Content impression       | Any content block that was displayed on a page, such as a banner or an ad. Optionally you can tell Piwik to track only impressions for visible content blocks. |
| Content interaction      | An interaction is happening when a visitor is interacting with a content block. This means usually a 'click' on a banner or ad, but it can be any interaction. |
| Content interaction rate | The ratio of content impressions to interactions. For instance an ad was displayed a 100 times and there were 2 interactions results in a rate of 2%. |

## Manual content tracking

You can track content impressions and interactions completely programmatically. To do so have a look at the methods [`trackContentImpression` and `trackContentInteraction`](/guides/tracking-javascript-guide#tracking-content-impressions-and-interactions-manually) in the JavaScript Tracker API reference.

Track content this way if you cannot easily change the markup of your site or if you want complete control over all tracked impressions and interactions.

## Declarative content tracking

Instead of programmatically tracking the content with the JavaScript API, you can use HTML attributes in your web page.

### Initializing the tracker

To make things work we first need to initialize the tracker. You'll have to decide whether you want to track all the content blocks of the page or only the visible ones.

For more details about this have a look at the JavaScript Tracker API reference: [`trackAllContentImpressions`](/guides/tracking-javascript-guide#track-all-content-impressions-within-a-page) and [`trackVisibleContentImpressions`](/guides/tracking-javascript-guide#track-only-visible-content-impressions-within-a-page)

Example for tracking all content blocks:

```javascript
var _paq = window._paq = window._paq || [];
_paq.push(['setTrackerUrl', 'matomo.php']);
_paq.push(['setSiteId', 1]);
_paq.push(['enableLinkTracking']);
_paq.push(['trackPageView']);
_paq.push(['trackAllContentImpressions']);
```

Example for tracking only visible content blocks:

```javascript
[...]
_paq.push(['trackPageView']);
_paq.push(['trackVisibleContentImpressions']);
```

### Tagging content

Once you have initialized the tracker you have to tag HTML blocks to declare them **content blocks**.

The following attributes and their corresponding CSS classes are used for this and explained in detail in the next chapters:

| Selector                                                                | Description                                         |
| ----------------------------------------------------------------------- | --------------------------------------------------- |
| `[data-track-content]` or `.matomoTrackContent`                         | Defines a content block                             |
| `[data-content-name=""]`                                                | Defines the name of the content block               |
| `[data-content-piece=""]` or `.matomoContentPiece`                      | Defines the content piece                           |
| `[data-content-target=""]` or `.matomoContentTarget`                    | Defines the content target                          |
| `[data-content-ignoreinteraction]` or `.matomoContentIgnoreInteraction` | Declares to not automatically track the interaction |


You can use either **HTML attributes** or **CSS classes** to tag content.

Attributes always take precedence over CSS classes. If you set the same attribute or the same class on multiple elements within one block, the first element found will always win. Nested content blocks are currently not supported.

#### HTML attributes or CSS classes?

HTML attributes are the recommended way to go as they allow you to set specific values for content name, content piece and content target. Otherwise, we have to detect the content name, piece and target automatically based on a set of rules which are explained further below. For instance, we are trying to read the content target from a `href` attribute of a link, the content piece from a `src` attribute of an image, and the name from a `title` attribute.
If you let us automatically detect those values it can influence your tracking over time. For instance if you provide the same page in different languages we might end up in many different combinations of content blocks that actually all represent the same. Also, if you add a `title` attribute to an element the detected content name could change although you didn't want this. Analyzing the evolution of a content block will no longer work in this case. Therefore, it is recommended to use the HTML attributes to tag your content and to specify values that change only if you want them to change.

#### Example

```html
<a href="/purchase" data-track-content data-content-name="My Product Name" data-content-piece="Buy now">
    translate('Buy it now')
</a>
```

Here we are defining a content block having the name "My Product Name". The used content piece will be always "Buy now" even if you use a translated version for different visitors based on their language. This can make it easier to analyze the data. The content target will be detected based on the `href` attribute which is usually considered ok.

#### How to define a block of content?

Defining a content block is mandatory in order to track any content. For each ad, banner or any other content you want to track you will have to create a content block. You can use either the attribute `data-track-content` or the CSS class `matomoTrackContent`. The attribute does not require any value.

Examples:

```html
<img src="img-en.jpg" data-track-content/>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""

// or
<img src="img-en.jpg" class="matomoTrackContent"/>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""
```

As you can see in these examples we do detect the content piece and name automatically based on the `src` attribute of the image. The content target cannot be detected since an image does not define a `href` attribute. Piwik will track an interaction automatically as soon as a visitor clicks on the image.

#### How do we detect the content piece?

* The simplest scenario is to provide an HTML attribute `data-content-piece="foo"` including a value anywhere within the content block or in the content block element itself.
* If there is no such attribute we will check whether the content piece element is media (audio, video, image, pdf, ...) and we will try to find the URL of the media automatically.
 * To find the content piece element we will search for an element having the attribute `data-content-piece` or the CSS class `matomoContentPiece`. This attribute/class can be specified anywhere within a content block. If we do not find any specific content piece element we will use the content block element.
 * In case of video or audio elements, when there are multiple sources defined, we will choose the URL of the first source.
 * We will automatically build a fully qualified URL of the source in case we find one. This allows you to see a preview in the UI and to know exactly which media was displayed in case relative paths are used.
* If we haven't found anything we will fall back to use the value "Unknown". In such a case you should set the attribute `data-content-piece` telling us explicitly what the content is.

Examples:

```html
<a href="https://www.example.com" data-track-content>
    <img src="img-en.jpg" data-content-piece="img.jpg"/>
</a>
// content name   = img.jpg
// content piece  = img.jpg
// content target = https://www.example.com
```

As you can see a specific value for the content piece is defined which can be useful if your text or images are different for each language. This time we can also automatically detect the content target since we have set the content block on an `a` element. More about this later. The `data-content-piece` attribute can be set on any element, even in the `a` element.


```html
<a href="https://www.example.com" data-track-content>
    <img src="img-en.jpg" data-content-piece/>
</a>

// or
<a href="https://www.example.com" data-track-content>
    <img src="img-en.jpg" class="matomoContentPiece"/>
</a>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = https://www.example.com
```

In these examples we were able to detect the name and the piece of the content automatically based on the `src` attribute. We will automatically build a fully qualified URL for the image.

```html
<a href="https://www.example.com" data-track-content>
    <p data-content-piece>Lorem ipsum dolor sit amet</p>
</a>

// or
<a href="https://www.example.com" data-track-content>
    <p class="matomoContentPiece">Lorem ipsum dolor sit amet</p>
</a>
// content name   = Unknown
// content piece  = Unknown
// content target = https://www.example.com
```

As the content piece element is not media we cannot detect the content automatically. In such a case you have to define the `data-content-piece` attribute and set a value to it. We do not use the text of this element because

* the text might change often resulting in many different content pieces
* the text could be very long and cutting the text automatically could be inaccurate
* the text could be translated which would result in many different content pieces although it is always the same
* the text might contain user specific or sensitive content

Better:

```html
<a href="https://www.example.com" data-track-content>
    <p data-content-piece="My content">Lorem ipsum dolor sit amet...</p>
</a>
// content name   = My content
// content piece  = My content
// content target = https://www.example.com
```

#### How do we detect the content name?

The content name represents a content block which will help you in the Piwik UI to easily identify a specific block. A content name groups different content pieces together. For instance while a content name could be "My Product 1" there could be many different content pieces to exactly know which content was displayed and interacted with. For example "Buy now", "Click here to buy", "/image.png".

* The simplest scenario is to provide an HTML attribute `data-content-name` with a value anywhere within a content block or in the content block element itself.
* If there is no such attribute we will use the value of the content piece in case there is one (if !== Unknown).
  * If content piece is a URL that is identical to the current domain of the website we will remove the domain from the URL
* If we do not find a value for content piece we will look for a `title` attribute in the content block element.
* If we do not find a name we will look for a `title` attribute in the content piece element.
* If we do not find a name we will look for a `title` attribute in the content target element.
* If we do not find a name we will fall back to "Unknown"

Detecting the name automatically based on a title or a content piece can result in many different content names. Once more we recommend specifying a name via the `data-content-name` attribute.

Examples:

```html
<img src="img-en.jpg" data-track-content data-content-name="Image1"/>
// content name   = Image1
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""
```

This example is the way to go by defining a `data-content-name` attribute anywhere we can easily detect the name of the content.

```html
<img src="img-en.jpg" data-track-content/>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""
```

If no content name is set, it will default to the content piece in case there is one. As the image has the same domain as the current page only the absolute path of the image will be used as a name.

```html
<img src="https://www.example.com/path/img-en.jpg" data-track-content/>
// content name   = /path/img-en.jpg
// content piece  = https://www.example.com/path/img-en.jpg
// content target = ""
```

If content piece contains a domain that is the same as the current website's domain we will remove it.

```html
<a href="https://www.example.com" data-track-content>Lorem ipsum...</a>
// content name   = Unknown
// content piece  = Unknown
// content target = https://www.example.com
```

In case there is no content name, no content piece and no title set anywhere it will default to "Unknown". To get a useful content name you should set either the `data-content-name` or a `title` attribute.

```html
<a href="https://www.example.com" data-track-content title="Block Title">
    <span title="Inner Title" data-content-piece>Lorem ipsum...</span>
</a>
// content name   = Block Title
// content piece  = Unknown
// content target = https://www.example.com
```

In case there is no content name and no content piece we will fall back to the `title` attribute of the content block. The `title` attribute of the block element takes precedence over the piece element in this example.

#### How do we detect the content target element?

The content target element will be used to find a URL as this element is usually a link or a button. We detect the target element either by the attribute `data-content-target` or by the class `.matomoContentTarget`. If no such element can be found we will fall back to the content block element.

#### How do we detect the content target?

* Ideally you provide an HTML attribute `data-content-target` with a value anywhere within a content block or in the content block element itself.
* If there is no such element we will search for an `href` attribute in the target element
* If there is no such attribute we will use an empty string ""

Examples:

```html
<a href="https://www.example.com" data-track-content>Click me</a>
// content name   = Unknown
// content piece  = Unknown
// content target = "https://www.example.com"
```

As no specific target element is set, we will read the `href` attribute of the content block.

```html
<a onclick="location.href='https://www.example.com'" data-content-target="http://www.example.com" data-track-content>Click me</a>
// content name   = Unknown
// content piece  = Unknown
// content target = "https://www.example.com"
```

No `href` attribute is set as the link will be executed via JavaScript. Therefore, a `data-content-target` attribute with a value has to be specified.

```html
<div data-track-content><input type="submit"/></div>
// content name   = Unknown
// content piece  = Unknown
// content target = ""
```

As there is neither a `data-content-target` attribute nor a `href` attribute we cannot detect the target.

```html
<div data-track-content>
    <input type="submit" data-content-target="https://www.example.com"/>
</div>
// content name   = Unknown
// content piece  = Unknown
// content target = "https://www.example.com"
```

As the `data-content-target` attribute is set with a value, we can detect the content target.

```html
<div data-track-content>
    <a href="https://www.example.com" class="matomoContentTarget">Click me</a>
</div>
// content name   = Unknown
// content piece  = Unknown
// content target = "https://www.example.com"
```

As the target element has a `href` attribute we can detect the content target automatically.

### Putting it all together

```html
<a href="https://ad.example.com" data-track-content>
    <img src="https://www.example.com/path/xyz.jpg" data-content-piece />
</a>
// content name   = /path/xyz.jpg
// content piece  = https://www.example.com/path/xyz.jpg
// content target = https://ad.example.com
```

A typical example for a content block that displays a banner ad.

```html
<a href="https://ad.example.com" data-track-content data-content-name="My Ad">
    Lorem ipsum....
</a>
// content name   = My Ad
// content piece  = Unknown
// content target = https://ad.example.com
```

A typical example for a content block that displays a text ad.

```html
<div data-track-content data-content-name="My Ad">
    <img src="https://www.example.com/path/xyz.jpg" data-content-piece />
    <a href="/anylink" data-content-target>Add to shopping cart</a>
</div>
// content name   = My Ad
// content piece  = https://www.example.com/path/xyz.jpg
// content target = /anylink
```

A typical example for a content block that displays an image - which is the content piece - and a call to action link - which is the content target - below. We would replace the `href=/anylink` with a link to matomo.php of your Piwik installation which will in turn redirect the user to the actual target to actually track the interaction.

#### How to debug / test whether all content blocks will be detected correctly?

In Piwik 2.15 we added a new method `logAllContentBlocksOnPage` to log all found content blocks within a page to the console. It will log an array of all content blocks to the console like this:

```js
[{name: '...', target:'...', piece: "..."},...]
```

To log them simply open the developer tools of the browser you are using and call `_paq.push(['logAllContentBlocksOnPage'])`.

### Content interactions

#### How do we track an interaction automatically?

Piwik tracks an interaction automatically by listening to clicks on the target element. On mobile devices you might want to listen to `touch` events. In this case you may have to disable automatic content interaction tracking see below.

The way we track interactions varies based on the type of the link.

##### Links to the same domain

In case we detect a link element having an `href` attribute to the same domain as the current page we will replace the `href` attribute with a link to the `matomo.php` tracker URL. Whenever a user clicks on such a link we will first send the user to the `matomo.php` of your Piwik installation and then redirect the user from there to the actual page. This makes sure to track an interaction even if someone opens the URL with a right click.

If the URL of the replaced `href` attribute changes meanwhile by your code we will respect the new link.

Note: The referrer information will get lost when redirecting from matomo.php to your page. If you depend on this you need to disable automatic tracking of an interaction see below.

##### Outlinks and downloads

Outlinks and downloads are handled as before via XHR. If a user clicks on a download or outlink we will track this action as usual along with some information related to the content interaction. If link tracking is not enabled we will track downloads having the same domain via `matomo.php` and all others via XHR.

Tracking via XHR can delay loading a new page by a few hundred ms as we have to track the outlink before moving the user to the new page.

##### Anchor links

Anchor and all other kind of links will be tracked using an XHR.

#### How to prevent the automatic tracking of an interaction?

Maybe you do not want us to track any interaction automatically as explained before. To do so you can either set the attribute `data-content-ignoreinteraction` or the CSS class `matomoContentIgnoreInteraction` on the content target element. In single page application you might have to disable automatic tracking of an interaction as otherwise a page reload and a redirect would occur.

Examples

```html
<a href="https://outlink.example.com" class="matomoTrackContent matomoContentIgnoreInteraction">Add to shopping cart</a>
//
<div data-track-content>
    <a href="https://outlink.example.com" data-content-target data-content-ignoreinteraction>Add to shopping cart</a>
</div>
```

In all examples we would track the impression automatically but not the interaction.


## FAQ

### How can I track dynamically loaded elements?

You have initialized all content blocks on page load via `trackContentImpression` or `trackVisibleContentImpressions`. Now you are adding
more HTML elements to the DOM, for instance a new banner, and you want to make sure to track an impression for it as well as an interaction
if a user interacts with it.

Call `_paq.push(['trackContentImpressionsWithinNode', domNode]);` to make sure an impression will be tracked for all content blocks contained within this `domNode`. An interaction will be tracked automatically once the user interacts with any content block.

Read more about tracking content impressions programmatically in the [JavaScript Tracking guide](/guides/tracking-javascript-guide#content-tracking).

### What can I do if an impression is tracked automatically but not an interaction?

Surely you are wondering why the interaction is not tracked automatically. There can be many reasons for it. For example if the target node is not actually clickable or if there is already a click listener on this element that stops the event.

If, for some reason, the interaction won't be tracked automatically you can trigger it manually by calling `_paq.push(['trackContentInteractionNode', domNode, typeOfInteraction])`.

Example:

```javascript
formElement.addEventListener('submit', function () {
    _paq.push(['trackContentInteractionNode', this, 'submittedForm']);
});
```

This will track an interaction named `submittedForm` once the user submits a form. Be aware that it will only work if the passed `domNode` is actually within a content block.

Read more about tracking content interactions manually in the [JavaScript Tracking guide](/guides/tracking-javascript-guide#content-tracking).

## What's next?

You can read more in:

- the [JavaScript Tracking guide](/guides/tracking-javascript-guide#content-tracking)
- the [JavaScript Tracker API reference](/api-reference/tracking-javascript)

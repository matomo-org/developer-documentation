# Technical concept for implementing Content Tracking [#4996](#4996)

See https://github.com/piwik/piwik/issues/4996 for explanation of the actual feature.

## Naming
| Name  | Purpose |
| ------------- | ------------- |
| Content block | Is a container which consists of a content name, piece, target and an interaction. |
| Content name | A name that represents a content block. The name will be visible in reports. One name can belong to differnt content pieces. |
| Content piece | This is the actual content that was displayed, eg a path to a video/image/audio file, a text, ... |
| Content target | For instance the URL of a landing page where the user was led to after interacting with the content block. |
| Content impression | Any content block that was displayed on a page, such as a banner or an ad. Optionally you can tell Piwik to track only impressions for content blocks that were actually visible. |
| Content interaction | Any content block that was interacted with by a user. This means usually a 'click' on a banner or ad happened, but it can be any interaction. |
| Content interaction rate | The ratio of content impressions to interactions. For instance an ad was displayed a 100 times and there were 2 interactions results in a rate of 2%. |

## Tracking the content completely programmatically

You can track content impressions and interactions with the content completely programmatically. To do so have a look at the methods `trackContentImpression` and `trackContentInteraction` in the JavaScript Tracker API reference.

Track content for instance this way if you cannot easily change the markup of your site or if you want to control it when an impression and when an interaction is triggered. 

## Tracking the content completely declarative

### Initializing the tracker

To make things work we need to inizialize the tracker first. Here you have to decide whether you want to track all content blocks within a side or only the ones that are actually visible.

For more details about this have a look at the JavaScript Tracker API reference: `trackAllContentImpressions` and `trackVisibleContentImpressions`

Example to track only visible content impressions
```
var _paq = _paq || [];
_paq.push(['setTrackerUrl', 'piwik.php']);
_paq.push(['setSiteId', 1]);
_paq.push(['trackPageView']);
_paq.push(['trackVisibleContentImpressions']);
_paq.push(['enableLinkTracking']);
```

Example to track all content impressions
```
var _paq = _paq || [];
_paq.push(['setTrackerUrl', 'piwik.php']);
_paq.push(['setSiteId', 1]);
_paq.push(['trackPageView']);
_paq.push(['trackAllContentImpressions']);
_paq.push(['enableLinkTracking']);
```

### Tagging content

Generally said you can usually choose between HTML attributes and CSS classes to define the content you want to track. Attributes always take precedence over CSS classes. So if you define an attribute on one element and a CSS class on another element we will always pick the element having the attribute. If you set the same attribute or the same class on multiple elements within one block, the first element will always win.
Nested content blocks are currently not supported.

HTML attributes are the recommended way to go as it allows you to set a specific value that will be used when detecting the content impressions on your website.
Imagine you do not have a value for an HTML attribute provided or if a CSS class is used, we will have to try to detect the content name, piece and target automatically based on a set of rules which are explained further below. For instance we are trying to read the content target from a `href` attribute of a link, the content piece from a `src` attribute of an image, and the name from a `title` attribute.
If you let us automatically detect those values it can influence your tracking over time. For instance if you provide the same page in different languages, and we will detect the content automatically, we might end up in many different content blocks that represent actually all the same. Therefore it is recommended to use the HTML-attributes including values.

The following attributes and their corresponding CSS classes are used which will be explained in detail below:
* `[data-track-content] or .piwikTrackContent` == Defines a content block
* `[data-content-name=""]` == Defines the name of the content block
* `[data-content-piece=""] or .piwikContentPiece` == Defines the content piece
* `[data-content-target=""] or .piwikContentTarget` == Defines the content target
* `[data-content-ignoreinteraction] or .piwikContentIgnoreInteraction` == Tells Piwik to not automatically track the interaction

#### How to define a block of content?
You can use either the attribute `data-track-content` or the CSS class `piwikTrackContent`. The attribute does not require any value.

Examples:
```
<img src="img-en.jpg" data-track-content/>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""

<img src="img-en.jpg" class="piwikTrackContent"/>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""
```

As you can see in these examples we do detect the content piece and name automatically based on the `src` attribute of the image. The content target cannot be detected since an image does not define a link.

Note: In the future we may allow to define the name of the content using this attribute instead of `data-content-name` but I did not want this for two reasons: It could also define the actual content (the content piece) so it would not be intuitive, using `data-content-name` attribute allows to set the name also on nested attributes.

#### How do we detect the content piece element?
The content piece element is used to detect the actual content of a content block.

To find the content piece element we will try to find an element having the attribute `data-content-piece` or the CSS class `piwikContentPiece`. This attribute/class can be specified anywhere within a content block.
If we do not find any specific content piece element, we will use the content block element.

#### How do we detect the content piece?

* The simplest scenario is to provide an HTML attribute `data-content-piece="foo"` including a value anywhere within the content block or in the content block element itself.
* If there is no such attribute we will check whether the content piece element is a media (audio, video, image) and we will try to detect the URL to the media automatically. For instance using the `src` attribute. If a found media URL does not include a domain or is not an absolute URL we will make sure to have a fully qualified URL.
  * In case of video and audio elements, when there are multiple sources defined, we will choose the URL of the first source
* If we haven't found anything we will fall back to use the value "Unknown". In such a case you should set the attribute `data-content-piece` telling us explicitly what the content is.

Examples:
```
<a href="http://www.example.com" data-track-content><img src="img-en.jpg" data-content-piece="img.jpg"/></a>
// content name   = img.jpg
// content piece  = img.jpg
// content target = http://www.example.com
```
As you can see we can now define a specific value for the content piece which can be useful if your text or images are different in for each language.
This time we can also automatically detect the content target since we have set the content block on an `a` element. More about this later. The `data-content-piece` attribute can be set on any element, also in the `a` element.

```
<a href="http://www.example.com" data-track-content><img src="img-en.jpg" data-content-piece/></a>
<a href="http://www.example.com" data-track-content><img src="img-en.jpg" class="piwikContentPiece"/></a>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = http://www.example.com
```

In this example we were able to detect the name and the piece of the content automatically based on the `src` attribute.

```
<a href="http://www.example.com" data-track-content><p data-content-piece>Lorem ipsum dolor sit amet</p></a>
<a href="http://www.example.com" data-track-content><p class="piwikContentPiece">Lorem ipsum dolor sit amet</p></a>
// content name   = Unknown
// content piece  = Unknown
// content target = http://www.example.com
```

As the content piece element is not an image, video or audio we cannot detect the content automatically. In such a case you have to define the `data-content-piece` attribute and set a value to it. We do not use the text of this element by default since the text might change often resulting in many content pieces, since it can be very long, since it can be translated and therefore results in many different content pieces although it is always the same, since it might contain user specific content and so on.

Better:
```
<a href="http://www.example.com" data-track-content><p data-content-piece="My content">Lorem ipsum dolor sit amet...</p></a>
// content name   = My content
// content piece  = My content
// content target = http://www.example.com
```

### How do we detect the content name?
The content name represents a content block which will help you in the Piwik UI to easily identify a specific block.

* The simplest scenario is that you provide us an HTML attribute `data-content-name` with a value anywhere within a content block or in a content block element itself.
* If there is no such element we will use the value of the content piece in case there is one (if !== Unknown).
  * A content piece will be usually detected automatically in case the content piece is an image, video or audio element.
  * If content piece is a URL that is identical to the current domain of the website we will remove the domain from the URL
* If we do not find a name we will look for a `title` attribute in the content block element.
* If we do not find a name we will look for a `title` attribute in the content piece element.
* If we do not find a name we will look for a `title` attribute in the content target element.
* If we do not find a name we will fall back to "Unknown"

Examples:
```
<img src="img-en.jpg" data-track-content data-content-name="Image1"/>
// content name   = Image1
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""
```

This example would be the way to go by defining a `data-content-name` attribute anywhere we can easily detect the name of the content.

```
<img src="img-en.jpg" data-track-content/>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""
```

If no content name is set, it will default to the content piece in case there is one.

```
<img src="http://www.example.com/path/img-en.jpg" data-track-content/>
// content name   = /path/img-en.jpg
// content piece  = http://www.example.com/path/img-en.jpg
// content target = ""
```

If content piece contains a domain that is the same as the current website's domain we will remove it

```
<a href="http://www.example.com" data-track-content>Lorem ipsum dolor sit amet...</p></a>
// content name   = Unknown
// content piece  = Unknown
// content target = http://www.example.com
```

In case there is no content name, no content piece and no title set anywhere it will default to "Unknown". To get a useful content name you should set either the `data-content-name` or a `title` attribute.

```
<a href="http://www.example.com" data-track-content title="Block Title"><span title="Inner Title" data-content-piece>Lorem ipsum dolor sit amet...</span></a>
// content name   = Block Title
// content piece  = Unknown
// content target = http://www.example.com
```

In case there is no content name and no content piece we will fall back to the `title` attribute of the content block. The `title` attribute of the block element takes precendence over the piece element in this example.

#### How do we detect the content target element?
The content target is the element that we will use to detect the URL of the landing page of the content block. The target element is usually a link or a button element. Generally said the target doesn't have to be a URL it can be anything but in most cases it will be a URL. A target could be for instance also a tab-container

We detect the target element either by the attribute `data-content-target` or by the class `.piwikContentTarget`. If no such element can be found we will fall back to the content block element.

#### How do we detect the content target URL?

* The simplest scenario is that you provide us an HTML attribute `data-content-target` with a value anywhere within a content block or in a content block element itself.
* If there is no such element we will look for an `href` attribute in the target element
* If there is no such attribute we will use an empty string ""

Examples:
```
<a href="http://www.example.com" data-track-content>Click me</a>
// content name   = Unknown
// content piece  = Unknown
// content target = "http://www.example.com"
```

As no specific target element is set, we will read the `href` attribute of the content block.

```
<a onclick="location.href='http://www.example.com'" data-content-target="http://www.example.com" data-track-content>Click me</a>
// content name   = Unknown
// content piece  = Unknown
// content target = "http://www.example.com"
```

No `href` attribute is used as the link is executed via javascript. Therefore a `data-content-target` attribute with value has to be specified.


```
<div data-track-content><input type="submit"/></div>

// content name   = Unknown
// content piece  = Unknown
// content target = ""
```

As there is neither a `data-content-target` attribute nor a `href` attribute we cannot detect the target.

```
<div data-track-content><input type="submit" data-content-target="http://www.example.com"/></div>

// content name   = Unknown
// content piece  = Unknown
// content target = "http://www.example.com"
```

As the `data-content-target` attribute is specifically set with a value, we can detect the target URL based on this. Otherwise we could not.

```
<div data-track-content><a href="http://www.example.com" data-content-target>Click me</a></div>
<div data-track-content><a href="http://www.example.com" class="piwikContentTarget">Click me</a></div>
// content name   = Unknown
// content piece  = Unknown
// content target = "http://www.example.com"
```

As the target element has a `href` attribute we can detect the content target automatically.

#### How do we track an interaction automatically?

Interactions can be detected declarative in case the detected target element is an `a` and `area` element with an `href` attribute. If not, you will have to track
the interaction programmatically, see one of the next sections. We generally treat links to the same page differently than downloads or outlinks.

We use `click` events do detect an interaction with a content. On mobile devices you might want to listen to `touch` events. In this case you may have to disable automatic content interaction tracking see below.

##### Links to the same domain
In case we detect a link to the same website we will replace the current `href` attribute with a link to the `piwik.php` tracker URL. Whenever a user clicks on such a link we will first send the user to the `piwik.php` of your Piwik installation and then redirect the user from there to the actual page. This click will be tracked as an event. Where the event category is the string `Content`, the event action is the value of the content interaction such as `click` and the event name will be the same as the content name.

If the URL of the replaced `href` attribute changes meanwhile by your code we will respect the new `href` attribute and make sure to update the link with a `piwik.php` URL. Therefore we will add a `click` listener to the element.

Note: The referrer information will get lost when redirecting from piwik.php to your page. If you depend on this you need to disable automatic tracking of interaction see below

If you have added an `href` attribute after we scanned the DOM for content blocks we can not detect this and an interaction won't be tracked.

##### Outlinks and downloads
Outlinks and downloads are handled as before. If a user clicks on a download or outlink we will track this action using an XHR. Along with the information of this action we will send the information related to the content block. We will not track an additional event for this.

##### Anchor links
Anchor links will be tracked using an XHR.

#### How to prevent the automatic tracking of an interaction?

Maybe you do not want us to track any interaction automatically as explained before.
To do so you can either set the attribute `data-content-ignoreinteraction` or the CSS class `piwikContentIgnoreInteraction` on the content target element.

Examples
```
<a href="http://outlink.example.com" class="piwikTrackContent piwikContentIgnoreInteraction">Add to shopping cart</a>
<a href="http://outlink.example.com" data-track-content data-content-ignoreinteraction>Add to shopping cart</a>
<div data-track-content><a href="http://outlink.example.com" data-content-target data-content-ignoreinteraction>Add to shopping cart</a></div>
```

In all examples we would track the impression automatically but not the interaction.

Note: In single page application you will most likely always have to disable automatic tracking of an interaction as otherwise a page reload and a redirect will happen.

#### Putting it all together

A few Examples:

```
<div data-track-content data-content-name="My Ad">
    <img src="http://www.example.com/path/xyz.jpg" data-content-piece />
    <a href="/anylink" data-content-target>Add to shopping cart</a>
</div>
// content name   = My Ad
// content piece  = http://www.example.com/path/xyz.jpg
// content target = /anylink
```

A typical example for a content block that displays an image - which is the content piece - and a call to action link - which is the content target - below.
We would replace the `href=/anylink` with a link to piwik.php of your Piwik installation which will in turn redirect the user to the actual target to actually track the interaction.

```
<a href="http://ad.example.com" data-track-content>
    <img src="http://www.example.com/path/xyz.jpg" data-content-piece />
</a>
// content name   = /path/xyz.jpg
// content piece  = http://www.example.com/path/xyz.jpg
// content target = http://ad.example.com
```

A typical example for a content block that displays a banner ad.

```
<a href="http://ad.example.com" data-track-content data-content-name="My Ad">
    Lorem ipsum....
</a>
// content name   = My Ad
// content piece  = Unknown
// content target = http://ad.example.com
```

A typical example for a content block that displays a text ad.

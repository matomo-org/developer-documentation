# In-depth guide to Content Tracking

We built a way to determine the performance of the pieces of content on any page of the website or app. You would use content tracking for instance when displaying ads on a website. An ad can be an image or a banner. Different ads might be displayed on the same page to different visitors or there could be even no ads sometimes. On the other side the same ad can be displayed on different pages. Use content tracking if you want to know how often a specific ad was displayed on any page and how often it was clicked. 

This feature is not only limited to ads or images. You can basically use it for any kind of content. A shorter user guide is coming.

## Naming 
| Name  | Purpose |
| ------------- | ------------- |
| Content block | Is a container which consists of a content name, piec and a target. |
| Content name | A name that represents a content block. The name will be visible in reports. One name can belong to differnt content pieces. |
| Content piece | This is the actual content that was displayed, eg a path to a video/image/audio file, a text, ... |
| Content target | For instance the URL of a landing page where the user was led to after interacting with the content block. In a single page website it could be also the name of an anchor. In a mobile app it could be the name of the screen you are going to open. |
| Content impression | Any content block that was displayed on a page, such as a banner or an ad. Optionally you can tell Piwik to track only impressions for visible content blocks. |
| Content interaction | An interaction is happening when a visitor is interacting with a content block. This means usually a 'click' on a banner or ad, but it can be any interaction. |
| Content interaction rate | The ratio of content impressions to interactions. For instance an ad was displayed a 100 times and there were 2 interactions results in a rate of 2%. |

## Tracking the content completely programmatically

You can track content impressions and interactions completely programmatically. To do so have a look at the methods [`trackContentImpression` and `trackContentInteraction`](http://developer.piwik.org/api-reference/tracking-javascript#tracking-content-impressions-and-interactions-manually) in the JavaScript Tracker API reference.

Track content this way if you cannot easily change the markup of your site or if you want to completely control any impression and interaction tracking to match your process.

## Tracking the content declarative

### Initializing the tracker

To make things work we need to inizialize the tracker first. Here you have to decide whether you want to track all content blocks within a page or only the ones that are actually visible.

For more details about this have a look at the JavaScript Tracker API reference: [`trackAllContentImpressions`](http://developer.piwik.org/api-reference/tracking-javascript#track-all-content-impressions-within-a-page) and [`trackVisibleContentImpressions`](http://developer.piwik.org/api-reference/tracking-javascript#track-only-visible-content-impressions-within-a-page)


Example for tracking all content impressions

<pre><code>var _paq = _paq || [];
_paq.push(['setTrackerUrl', 'piwik.php']);
_paq.push(['setSiteId', 1]);
_paq.push(['enableLinkTracking']);
_paq.push(['trackPageView']);
_paq.push(['trackAllContentImpressions']);</code></pre>

Example for tracking only visible content impressions

<pre><code>[...]
_paq.push(['trackPageView']);
_paq.push(['trackVisibleContentImpressions']);
[...]</code></pre>

### Tagging content

Once you have initialized the tracker you have to tag the actual content blocks in your pages.

Generally said you can usually choose between HTML attributes and CSS classes to tag the content you want to track. Attributes always take precedence over CSS classes. If you set the same attribute or the same class on multiple elements within one block, the first element found will always win. Nested content blocks are currently not supported.

HTML attributes are the recommended way to go as they allow you to set specific values for content name, content piece and content target. Otherwise we have to detect the content name, piece and target automatically based on a set of rules which are explained further below. For instance we are trying to read the content target from a `href` attribute of a link, the content piece from a `src` attribute of an image, and the name from a `title` attribute.
If you let us automatically detect those values it can influence your tracking over time. For instance if you provide the same page in different languages we might end up in many different content blocks that actually all represent the same block. Also if you add a `title` attribute to an element after a while the detected content name could change. Analyzing the evolution of a content block will no longer work in this case. Therefore it is recommended to use the HTML attributes to tag your content and to specify values that do not change over time.

The following attributes and their corresponding CSS classes are used which are explained in detail in the next chapters:

| Selector  | Description |
| ------------- | ------------- |
| `[data-track-content] or .piwikTrackContent` | Defines a content block |
| `[data-content-name=""]` | Defines the name of the content block |
| `[data-content-piece=""] or .piwikContentPiece` | Defines the content piece |
| `[data-content-target=""] or .piwikContentTarget` | Defines the content target |
| `[data-content-ignoreinteraction] or .piwikContentIgnoreInteraction` | Tells Piwik to not automatically track the interaction |

Good example:

<pre><code>&lt;a href="http://www.example.org" data-track-content data-content-name="My Product Name" data-content-piece="Buy now">translate('Buy it now')&lt;/a></code></pre>

Here we are defining a content block having the name "My Product Name". The used content piece will be always "Buy now" even if you use a translated version for different visitors based on their language. This can make it easier to analyze the data. The content target would be detected based on the `href` attribute which is usually ok but you can set a specified value using the `data-content-target` attribute.

#### How to define a block of content?

You can use either the attribute `data-track-content` or the CSS class `piwikTrackContent`. The attribute does not require any value. If you do not define a content block no content will be tracked.

Examples:

<pre><code>&lt;img src="img-en.jpg" data-track-content/>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""
//
// or
// 
&lt;img src="img-en.jpg" class="piwikTrackContent"/>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""</code></pre>

As you can see in these examples we do detect the content piece and name automatically based on the `src` attribute of the image. The content target cannot be detected since an image does not define a `href` attribute. We would track an interaction automatically as soon as a visitor clicks on the image.

#### How do we detect the content piece?

* The simplest scenario is to provide an HTML attribute `data-content-piece="foo"` including a value anywhere within the content block or in the content block element itself.
* If there is no such attribute we will check whether the content piece element is a media (audio, video, image) and we will try to find the URL of the media automatically. In case of video or audio elements, when there are multiple sources defined, we will choose the URL of the first source.
 * To find the content piece element we will search for an element having the attribute `data-content-piece` or the CSS class `piwikContentPiece`. This attribute/class can be specified anywhere within a content block. If we do not find any specific content piece element we will use the content block element.
 * We will automatically build a fully qualified URL of the source in case we find one allowing you to see a preview in the UI and to know exactly which media was displayed in case you are using a relative path
* If we haven't found anything we will fall back to use the value "Unknown". In such a case you should set the attribute `data-content-piece` telling us explicitly what the content is.

Examples:

<pre><code>&lt;a href="http://www.example.com" data-track-content>&lt;img src="img-en.jpg" data-content-piece="img.jpg"/>&lt;/a>
// content name   = img.jpg
// content piece  = img.jpg
// content target = http://www.example.com</code></pre>

As you can see a specific value for the content piece is defined which can be useful if your text or images are different for each language. This time we can also automatically detect the content target since we have set the content block on an `a` element. More about this later. The `data-content-piece` attribute can be set on any element, even in the `a` element.


<pre><code>&lt;a href="http://www.example.com" data-track-content>&lt;img src="img-en.jpg" data-content-piece/>&lt;/a>
// or
&lt;a href="http://www.example.com" data-track-content>&lt;img src="img-en.jpg" class="piwikContentPiece"/>&lt;/a>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = http://www.example.com</code></pre>

In these examples we were able to detect the name and the piece of the content automatically based on the `src` attribute. We will automatically build a fully qualified URL for the image.

<pre><code>&lt;a href="http://www.example.com" data-track-content>&lt;p data-content-piece>Lorem ipsum dolor sit amet&lt;/p>&lt;/a>
// or
&lt;a href="http://www.example.com" data-track-content>&lt;p class="piwikContentPiece">Lorem ipsum dolor sit amet&lt;/p>&lt;/a>
// content name   = Unknown
// content piece  = Unknown
// content target = http://www.example.com</code></pre>

As the content piece element is not a media we cannot detect the content automatically. In such a case you have to define the `data-content-piece` attribute and set a value to it. We do not use the text of this element by default because

* the text might change often resulting in many different content pieces
* the text could be very long and cutting the text automatically could be inaccurate
* the text could be translated which would result in many different content pieces although it is always the same
* the text might contain user specific or sensitive content

Better:

<pre><code>&lt;a href="http://www.example.com" data-track-content>&lt;p data-content-piece="My content">Lorem ipsum dolor sit amet...&lt;/p>&lt;/a>
// content name   = My content
// content piece  = My content
// content target = http://www.example.com</code></pre>

#### How do we detect the content name?

The content name represents a content block which will help you in the Piwik UI to easily identify a specific block. A content name groups different content pieces together. For instance while a content name could be "My Product 1" there could be many different content pieces to exactly know which content was displayed and interacted with. For example "Buy now", "Click here to buy", "/image.png".

* The simplest scenario is to provide an HTML attribute `data-content-name` with a value anywhere within a content block or in the content block element itself.
* If there is no such attribute we will use the value of the content piece in case there is one (if !== Unknown).
  * If content piece is a URL that is identical to the current domain of the website we will remove the domain from the URL
* If we do not find a value for content piece we will look for a `title` attribute in the content block element.
* If we do not find a name we will look for a `title` attribute in the content piece element.
* If we do not find a name we will look for a `title` attribute in the content target element.
* If we do not find a name we will fall back to "Unknown"

Detecting the name automatically based on a title or a content piece can result in many different content names. Once more we recommend to specify a name via the `data-content-name` attribute.

Examples:

<pre><code>&lt;img src="img-en.jpg" data-track-content data-content-name="Image1"/>
// content name   = Image1
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""</code></pre>

This example is the way to go by defining a `data-content-name` attribute anywhere we can easily detect the name of the content.

<pre><code>&lt;img src="img-en.jpg" data-track-content/>
// content name   = absolutePath(img-en.jpg)
// content piece  = absoluteUrl(img-en.jpg)
// content target = ""</code></pre>

If no content name is set, it will default to the content piece in case there is one. As the image has the same domain as the current page only the absolute path of the image will be used as a name. 

<pre><code>&lt;img src="http://www.example.com/path/img-en.jpg" data-track-content/>
// content name   = /path/img-en.jpg
// content piece  = http://www.example.com/path/img-en.jpg
// content target = ""</code></pre>

If content piece contains a domain that is the same as the current website's domain we will remove it

<pre><code>&lt;a href="http://www.example.com" data-track-content>Lorem ipsum dolor sit amet...&lt;/a>
// content name   = Unknown
// content piece  = Unknown
// content target = http://www.example.com</code></pre>

In case there is no content name, no content piece and no title set anywhere it will default to "Unknown". To get a useful content name you should set either the `data-content-name` or a `title` attribute.

<pre><code>&lt;a href="http://www.example.com" data-track-content title="Block Title">&lt;span title="Inner Title" data-content-piece>Lorem ipsum dolor sit amet...&lt;/span>&lt;/a>
// content name   = Block Title
// content piece  = Unknown
// content target = http://www.example.com</code></pre>

In case there is no content name and no content piece we will fall back to the `title` attribute of the content block. The `title` attribute of the block element takes precendence over the piece element in this example.

#### How do we detect the content target element?

The content target is the element that we will use to detect the URL of the landing page of the content block. The target element is usually a link or a button element. We detect the target element either by the attribute `data-content-target` or by the class `.piwikContentTarget`. If no such element can be found we will fall back to the content block element.

#### How do we detect the content target?

* Ideally you provide an HTML attribute `data-content-target` with a value anywhere within a content block or in the content block element itself.
* If there is no such element we will search for an `href` attribute in the target element
* If there is no such attribute we will use an empty string ""

Examples:

<pre><code>&lt;a href="http://www.example.com" data-track-content>Click me&lt;/a>
// content name   = Unknown
// content piece  = Unknown
// content target = "http://www.example.com"</code></pre>

As no specific target element is set, we will read the `href` attribute of the content block.

<pre><code>&lt;a onclick="location.href='http://www.example.com'" data-content-target="http://www.example.com" data-track-content>Click me&lt;/a>
// content name   = Unknown
// content piece  = Unknown
// content target = "http://www.example.com"</code></pre>

No `href` attribute is used as the link is executed via JavaScript. Therefore a `data-content-target` attribute with a value has to be specified.

<pre><code>&lt;div data-track-content>&lt;input type="submit"/>&lt;/div>
// content name   = Unknown
// content piece  = Unknown
// content target = ""</code></pre>

As there is neither a `data-content-target` attribute nor a `href` attribute we cannot detect the target.

<pre><code>&lt;div data-track-content>&lt;input type="submit" data-content-target="http://www.example.com"/>&lt;/div>
// content name   = Unknown
// content piece  = Unknown
// content target = "http://www.example.com"</code></pre>

As the `data-content-target` attribute is set with a value, we can detect the content target.

<pre><code>&lt;div data-track-content>&lt;a href="http://www.example.com" data-content-target>Click me&lt;/a>&lt;/div>
// or
&lt;div data-track-content>&lt;a href="http://www.example.com" class="piwikContentTarget">Click me&lt;/a>&lt;/div>
// content name   = Unknown
// content piece  = Unknown
// content target = "http://www.example.com"</code></pre>

As the target element has a `href` attribute we can detect the content target automatically.

#### How do we track an interaction automatically?

Piwik tracks an interaction automatically by listening to clicks on the target element. On mobile devices you might want to listen to `touch` events. In this case you may have to disable automatic content interaction tracking see below.

Generally we track interactions differently based on the type of the link.

##### Links to the same domain

In case we detect a link element having an `href` attribute to the same domain as the current page we will replace the `href` attribute with a link to the `piwik.php` tracker URL. Whenever a user clicks on such a link we will first send the user to the `piwik.php` of your Piwik installation and then redirect the user from there to the actual page. This makes sure to track the interaction if someone opens the URL with a right click.

If the URL of the replaced `href` attribute changes meanwhile by your code we will respect the new link. 

Note: The referrer information will get lost when redirecting from piwik.php to your page. If you depend on this you need to disable automatic tracking of interaction see below.

##### Outlinks and downloads

Outlinks and downloads are handled as before. If a user clicks on a download or outlink we will track this action as usual along with some information related to the content interaction. If link tracking is not enabled we will track downloads having the same domain via `piwik.php` and all others via XHR.

##### Anchor links

Anchor and all other kind of links will be tracked using an XHR.

#### How to prevent the automatic tracking of an interaction?

Maybe you do not want us to track any interaction automatically as explained before. To do so you can either set the attribute `data-content-ignoreinteraction` or the CSS class `piwikContentIgnoreInteraction` on the content target element. In single page application you might have to disable automatic tracking of an interaction as otherwise a page reload and a redirect would occur.

Examples

<pre><code>&lt;a href="http://outlink.example.com" class="piwikTrackContent piwikContentIgnoreInteraction">Add to shopping cart&lt;/a>

&lt;a href="http://outlink.example.com" data-track-content data-content-ignoreinteraction>Add to shopping cart&lt;/a>

&lt;div data-track-content>&lt;a href="http://outlink.example.com" data-content-target data-content-ignoreinteraction>Add to shopping cart&lt;/a>&lt;/div></code></pre>

In all examples we would track the impression automatically but not the interaction.

### Putting it all together

<pre><code>&lt;a href="http://ad.example.com" data-track-content>
    &lt;img src="http://www.example.com/path/xyz.jpg" data-content-piece />
&lt;/a>
// content name   = /path/xyz.jpg
// content piece  = http://www.example.com/path/xyz.jpg
// content target = http://ad.example.com</code></pre>

A typical example for a content block that displays a banner ad.

<pre><code>&lt;a href="http://ad.example.com" data-track-content data-content-name="My Ad">
    Lorem ipsum....
&lt;/a>
// content name   = My Ad
// content piece  = Unknown
// content target = http://ad.example.com</code></pre>

A typical example for a content block that displays a text ad.

<pre><code>&lt;div data-track-content data-content-name="My Ad">
    &lt;img src="http://www.example.com/path/xyz.jpg" data-content-piece />
    &lt;a href="/anylink" data-content-target>Add to shopping cart&lt;/a>
&lt;/div>
// content name   = My Ad
// content piece  = http://www.example.com/path/xyz.jpg
// content target = /anylink</code></pre>

A typical example for a content block that displays an image - which is the content piece - and a call to action link - which is the content target - below. We would replace the `href=/anylink` with a link to piwik.php of your Piwik installation which will in turn redirect the user to the actual target to actually track the interaction.

## What's next?
Have a look at the [JavaScript Tracker API reference](http://developer.piwik.org/api-reference/tracking-javascript#content-tracking) if you did not have a look yet. 

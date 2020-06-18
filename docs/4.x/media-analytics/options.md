---
category: Integrate
title: Enriching and Restricting 
---
# Enriching and customising media data tracking

In this guide we will learn how to customise how your Video and Audio media content is tracked 
(for example how to customise the video titles and video URLs), and how to specify which videos and audios should be tracked or ignored.
 
## Setting video and audio titles

When analyzing your media reports in Piwik, media titles are often more useful than the Media HTTP URLs (which may contain only 
random numbers and letters). The YouTube and Vimeo player let us retrieve the video title automatically, 
so your video reports directly show the original video titles. 
If you use HTML5 videos or audios, or if you wish to customise the video titles in your analytics reports, read on. 
Media Analytics will detect the media title by searching for the following pieces of information:

* firstly, the `data-matomo-title` HTML attribute.
* next, the `data-piwik-title` HTML attribute.
* Media title from YouTube / Vimeo player.
* `title` HTML attribute.
* finally, the `alt` HTML attribute.

Titles are detected in this priority, meaning that you can set a `data-matomo-title` (recommended) or a `data-piwik-title` attribute to overwrite
the YouTube or Vimeo video title. A `data-matomo-title` always has the highest priority and overwrites any title 
received from a media player.

```html
<video data-matomo-title="My custom Video title" title="A different title"></video>
```

In the above example your video analytics reports in Piwik will show "My custom Video title" as the media title. 
If the video title cannot be detected (depending on your media player) and there is none of these HTML attributes set, 
then the title will be shown as "Unknown".

### JW Player

If you want to track a custom title that is different to your video title, you can provide a 
 custom title that will be only used for tracking purposes by specifying a playlist item in the setup method like this:
 
```js 
playerInstance.setup({
    playlist: [{
        file: "https://example.org/actualUrl.mp4",
        title: "My Video",
        matomoTitle: "My custom Video title"
    }
});
```

Instead of the `matomoTitle` property (recommended) you can also use `piwikTitle`.

### Flowplayer

You can provide a custom title when you use flowplayer for tracking purposes by specifying a `matomoTitle` or `piwikTitle` property:
 
```js 
flowplayer("#player", {
    clip: {
        sources: [
            {type: "application/x-mpegurl", src: "https://example.org/actualUrl.m3u8"},
            {type: "video/mp4", src: "https://example.org/actualUrl.mp4" }
        ],
        title: "Javascript setup",
        matomoTitle: "My custom Video title"
    }
});
```

If you embed flowplayer using the `video` element, you can set the `data-matomo-title` attribute on the video element
directly as described above.


## Overwriting the video/audio resource URL being tracked

By default, the HTTP URL of a media is fetched from the player API or read in the DOM. There can be use cases
 where you might want to track a custom resource URL instead of the actual resource. For example when your media
  URLs contain unique ids and you prefer to have more readable  URLs when analyzing your Piwik reports.
To do this you can define a custom resource via the `data-matomo-resource` (recommended) or the `data-piwik-resource` HTML attribute. For example:

```html
<video src="https://example.org/actualUrl.mp4"
       data-matomo-resource="https://example.org/trackedUrl.mp4"></video>
```

### JW Player

If your resource URL is for example user dependent, and you always want to track the same resource, you can provide a 
 custom resource by specifying a playlist item in the setup method like this:
 
```js 
playerInstance.setup({
    playlist: [{
        file: "https://example.org/actualUrl.mp4",
        title: "My Video",
        matomoResource: "https://example.org/trackedUrl.mp4"
    }
});
```

Instead of the `matomoResource` property (recommended) you can also use `piwikResource`.

### Flowplayer

You can provide a custom resource URL when you use flowplayer by specifying a `matomoResource` or a `piwikResource` property:
 
```js 
flowplayer("#player", {
    clip: {
        sources: [
            {type: "application/x-mpegurl", src: "https://example.org/actualUrl.m3u8"},
            {type: "video/mp4", src: "https://example.org/actualUrl.mp4" }
        ],
        title: "Javascript setup",
        matomoResource: "https://example.org/trackedUrl"
    }
});
```

If you embed flowplayer using the `video` element, you can set the `data-matomo-resource` (recommended) or the `data-piwik-resource` attribute on the video element
directly as described above.

## Restricting which media data is tracked

### Excluding specific media from being tracked

By default, all detected videos and audio will be tracked. To prevent the tracking of a specific media while still tracking 
other media you can set a `data-matomo-ignore` (recommended) or a `data-piwik-ignore` attribute on a `<video>` or `<audio>` element to ignore it. For example:

```html
<video data-matomo-ignore>...</video>
<audio data-matomo-ignore>...</audio>
<iframe data-matomo-ignore src="..."></iframe>
```

### Ignoring all medias that use a certain media player

To avoid tracking any media from a particular media player, 
you can disable analytics for one or more players calling the `removePlayer` method:

```js
_paq.push(['MediaAnalytics::removePlayer', 'playerName']);
```

`playerName` should be one of `html5`, `vimeo` or `youtube`. 
For example if you don't want to track any Vimeo videos, you can remove that player as follows:
 
```js
_paq.push(['MediaAnalytics::removePlayer', 'vimeo']);
```
 
Make sure to call this method as early as possible, for example just after `_paq.push(['setSiteId', 'X']);`

If you want to disable any HTML5 based media player like JW Player or VideoJS, use `html5` to ignore such media.

### Disabling media tracker features

#### How can I disable the tracking of any media?

The tracking of any media can be disabled at any time by calling the following method in your website:

```js
_paq.push(['MediaAnalytics::disableMediaAnalytics']);
```

This can be useful when you track several websites in one Piwik installation and you want to track the media usage
only for some of your websites. For the websites you want to disable the media tracking simply call the above shown
method. If you do not use the `_paq` variable, you can disable the media tracker as follows:
 
```js
window.piwikMediaAnalyticsAsyncInit = function () {
    Matomo.MediaAnalytics.disableMediaAnalytics();
};
```

Calling this method will stop tracking any media data. No media event such as "play", "pause" or "resume", nor other media
data like how often or for how long a media was played, will be tracked. If you use multiple Piwik JavaScript trackers, 
calling this method will disable the tracking for all of them. 

It is recommended to call this method as early as possible, for example just after `_paq.push(['setSiteId', 'X']);` unless
you want to disable the tracking only after a certain amount of time.

To enable the tracking again at a later point, call the method `enableMediaAnalytics` followed by a `scanForMedia`:

```js
_paq.push(['MediaAnalytics::enableMediaAnalytics']);
_paq.push(['MediaAnalytics::scanForMedia']);
```

#### Is it possible to disable the tracking of media events such as play, pause, resume and finish?

Yes, the tracking of media events can be disabled by calling the following method:

```js
_paq.push(['MediaAnalytics.disableTrackEvents']);
```

This will stop the tracking of any action events, while still tracking the usage of the videos and audio itself. This means
you will still get all media reports that are listed under the menu category "Media" but won't get to see any media events in the 
Visits Log or in the "Action => Events" report.
 
It is recommended to call this method as early as possible, for example just after `_paq.push(['setSiteId', 'X']);`

#### Is it possible to disable the tracking of media data like how often or how long a media was played, while still tracking events like 'play' and 'pause'?

Yes, the tracking of media can be disabled by calling the following method:

```js
_paq.push(['MediaAnalytics.disableTrackProgress']);
```

This will stop tracking any media progress. Under the menu category "Media", most reports will not show any data. 
The Visits Log and the "Actions => Events" report will still show data unless you disable the tracking of events as well (see above).
 
It is recommended to call this method as early as possible, for example just after `_paq.push(['setSiteId', 'X']);`


## What to read next

If you use a player other than Youtube / Vimeo / HTML5 / JwPlayer / Flowplayer / Video.js, learn about [tracking your Custom Video Players](/guides/media-analytics/custom-player). 
Or you may want to learn more about the [Media Analytics JavaScript API](/guides/media-analytics/reference), 
 read the [Media Analytics User Guide](https://matomo.org/docs/media-analytics/), 
 the Media Analytics [User FAQs](https://matomo.org/faq/media-analytics/) or the [Developer FAQs](/guides/media-analytics/faq).

---
category: Integrate
title: Setting up
---
# Setting up Media Analytics

In this guide we will learn how to get [Media Analytics](https://www.media-analytics.net/) to automatically track your website's video and audio media, 
in particular: HTML5 videos and audios, Youtube videos and Vimeo videos. Supported players are for example JW Player, VideoJS, MediaElement.js, and also many other HTML5 based video players.

## Embedding the Media Analytics JavaScript Tracker

If you have already embedded the [Piwik JavaScript Tracking Code](/guides/tracking-javascript-guide) into your website,
the Media Analytics will automatically start tracking the usage of video and audio. 
The video player tracking code is directly added in your Piwik JavaScript tracker file `/piwik.js` as long as the file `piwik.js` in your Piwik directory is writable by the webserver/PHP.
 
To check whether this works by default for you, login into Piwik as a Super User, go to Administration, and open the "System Check" report. 
If the System Check displays a warning for "Writable Piwik.js" then [learn below how to solve this](#when-the-piwikjs-in-your-piwik-directory-file-is-not-writable).

## Tracking HTML5 videos

The tracking of HTML5 video works automatically. However, you may not be tracking accurate titles for your video by default. 
We do recommend [setting a `data-matomo-title` attribute](/guides/media-analytics/options) on your `<video>` elements:

```html
<video data-matomo-title="My Video Title">...</video>
```

This also works when you are using an HTML5 based video player like VideoJS.

## Tracking HTML5 audios

The tracking of HTML5 audio works automatically. However, you may not be tracking accurate titles for your audio by default. 
We do recommend [setting a `data-matomo-title` attribute](/guides/media-analytics/options) on your `<audio>` elements:

```html
<audio data-matomo-title="My Audio Title">...</audio>
```

## Tracking JW Player videos

The tracking of JW Player works automatically. However, you may not be tracking accurate titles for your video by default. 
We do recommend specifying a title in the `setup` method of your video:

```js
jwplayer("myDiv").setup({
    "file": "...",
    "title": "My Video Title"
});
```

## Tracking Flowplayer videos

The tracking of Flowplayer works automatically. However, you may not be tracking accurate titles for your video by default. 
If you use the JavaScript embed method, we recommend specifying a title in the `flowplayer` method of your video:

```js
flowplayer("#player", {
    clip: {
        sources: [
            {type: "video/mp4", src: "http://example.org/actualUrl.mp4"}
        ],
        title: "My Video Title"
    }
});
```

If you embed Flowplayer using the video element, please read the instructions for setting titles using HTML5 above. You can 
set a title using the `data-matomo-title`, `data-piwik-title` or `title` attribute.

Please note that we are currently only supporting HTML5 videos for Flowplayer. If you are tracking flash videos using flowplayer,
please get in touch with us, and we add support for it for you. If you are using flash because of HLS streams, you might want
to consider using the hlsjs plugin so HTML5 will be used instead of flash.

## Tracking Vimeo videos

The tracking of Vimeo videos works automatically if the video is embedded as an `<iframe>`.

## Tracking SoundCloud audio

The tracking of SoundCloud audio works automatically if the audio is embedded as an `<iframe>`.

## Tracking YouTube videos

MediaAnalytics uses the [YouTube iFrame API](https://developers.google.com/youtube/iframe_api_reference).
For your Youtube videos to be tracked, you need to enable this Youtube API by adding a URL parameter `?enablejsapi=1` to all your video source URLs. 
For example:

```html
<iframe src="https://www.youtube.com/embed/yA2NUur0770?enablejsapi=1"></iframe>
```

If the `enablejsapi=1` parameter is not specified in your Youtube URLs, the Media Analytics tracker will likely not receive video events from the YouTube player.

### Loading of additional YouTube files

The MediaAnalytics tracker loads a file `https://www.youtube.com/iframe_api` in order to receive events from the 
YouTube player. This is needed to track the usage of YouTube videos. If you already load this manually, or if you do not want this file to be loaded, you can disable the 
tracking of YouTube videos by calling the following JS method:

```js
_paq.push(['MediaAnalytics::removePlayer', 'youtube']);
```

Please note that this file will be only loaded when there is actually a YouTube video on a webpage.

### My website is using the YouTube Iframe JS API as well, is there anything to do?
 
If your website uses the same YouTube Iframe API and makes use of the  [onYouTubeIframeAPIReady callback](https://developers.google.com/youtube/player_parameters#Manual_IFrame_Embeds)
method, you need to let the media tracker know as soon as the YouTube Player API is available by calling the `MediaAnalytics::scanForMedia` method:

```js
window.onYouTubeIframeAPIReady = function () {
    // [...] your code
    _paq.push(['MediaAnalytics::scanForMedia']);
};
```

To not break your website the media tracker will not overwrite your `onYouTubeIframeAPIReady` method.

## When the `piwik.js` in your Piwik directory file is not writable
 
When your Settings > System Check reports that "The Piwik JavaScript tracker file `piwik.js` is not writable 
which means other plugins cannot extend the JavaScript tracker." then you have two options to solve this issue:

1. Make the `piwik.js` file writable, for example by executing `chmod a+w piwik.js` or `chown $phpuser piwik.js` (replace `$phpuser` with actual username) in your Piwik directory. 
We recommend running the [Piwik console](/guides/piwik-on-the-command-line) command `./console custom-piwik-js:update` after you have made the file writable.
2. or Load the MediaAnalytics tracker file manually in your website by adding in all your pages ideally in the `<head>`: 
   `<script src="https://your-piwik-domain/plugins/MediaAnalytics/tracker.min.js">`

#### Are there any disadvantages of including the file manually?

Yes, there are:

* An additional HTTP request is needed to load your website which increases your page load time
* If your `piwik.js` ever becomes writable, the MediaAnalytics tracker would be loaded twice (in such a case the tracker notices it was already initialized and won't track everything twice)

If possible, we recommend making the `piwik.js` file writable.

## What to read next

Now that you've setup Media Analytics, you may want to [enrich and customise how your media data is tracked](/guides/media-analytics/options), 
or if you use a player other than Youtube/Vimeo/HTML5, learn about [tracking your Custom Video Players](/guides/media-analytics/custom-player).

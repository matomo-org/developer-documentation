---
category: Integrate
title: Custom media player
---
# Media Analytics for your custom video players 

In this guide we will learn how you can implement [Media Analytics](https://www.media-analytics.net/) for your custom video players or audio players. 
 
## Tracking a new media player in the browser

The Media Analytics plugin currently supports out of the box the HTML5, Vimeo and YouTube media players (more details: [list of all supported media players](https://matomo.org/faq/media-analytics/faq_22380/)). If you are using
 a different media player for your videos and audio, you can measure them by registering your own player. 

If you need help implementing Media Analytics for your media player or if you wish to share your implementation with us, [please contact us](https://matomo.org/support/).
If you work with us. we will be able to maintain it and ensure it always works in the future.

### The raw skeleton

Let's start by adding the raw skeleton for a media player to your website tracking code. A media player tracker basically consists of two parts: 
 
 * A function that scans the DOM for new videos and audio
 * A class that tracks the interaction with the player
 
```js
window.matomoMediaAnalyticsAsyncInit = function () {
    var MA = Matomo.MediaAnalytics;
    
    function MyPlayer(node, mediaType) {
        // in this class we track interactions with the player
        // instance is created whenever a media for this player was found
    }
    MyPlayer.scanForMedia = function(documentOrElement) {
        // called whenever it is needed to scan the entire document 
        // or when a certain element area is scanned for new videos or audio
    };
    
    // adding the newly created player to the Media Analytics tracker
    MA.addPlayer('myPlayerName', MyPlayer);
};
```

It is recommended to define this method before the [Piwik JavaScript Tracking Code](/guides/tracking-javascript-guide).

### Scanning for media

The method `scanForMedia` is called whenever your player is supposed to search for new media. As an argument it receives
either the JavaScript variable `document`, or an instance of an `HTMLElement` when only a certain part of the DOM is 
supposed to be searched for new media. 

In the following example the player searches for video elements. Your own player would maybe search for iframe
elements or for a certain class to identify a media player within a web page.

```js
MyPlayer.scanForMedia = function (documentOrHTMLElement) {
    // find all medias for your player
    var html5Videos = documentOrHTMLElement.getElementsByTagName('video');
    
    for (var i = 0; i < html5Videos.length; i++) {
        // for each of the medias found, create an instance of your player as long as the media is 
        // not supposed to be ignored via a "data-matomo-ignore" attribute
        if (!MA.element.isMediaIgnored(html5Videos[i])) {
            new MyPlayer(html5Videos[i], MA.mediaType.VIDEO); 
            // there is also a MA.mediaType.AUDIO constant if you want to track audio
        }
    }
};
```

### Tracking the media data

Now that we detect media within a web page we need to implement the actual tracking. The basic concept behind this is 
to create a `Matomo.MediaAnalytics.MediaTracker` instance that lets you call methods like `play`, `pause` or `seek` which 
reflect what is currently happening in the player.

```js
function MyPlayer (node, mediaType) {
    
    if (node.hasPlayerInstance) {
        // prevent creating multiple trackers for the same media 
        // when scanning for media multiple times 
        return;
    }

    node.hasPlayerInstance = true;

    // find the actual resource / URL of the video
    var actualResource = MA.element.getAttribute(node, 'src');
    // a user can overwrite the actual resource by defining a "data-matomo-resource" attribute. 
    // the method `getMediaResource` will detect whether such an attribute was set 
    var resource = MA.element.getMediaResource(node, actualResource);
    
    // create an instance of the media tracker. 
    // Make sure to replace myPlayerName with your player name.
    var tracker = new MA.MediaTracker('myPlayerName', mediaType, resource);

    // for video you should detect the width, height, and fullscreen usage, if possible
    tracker.setWidth(node.clientWidth);
    tracker.setHeight(node.clientHeight);
    tracker.setFullscreen(MA.element.isFullscreen(node));

    // the method `getMediaTitle` will try to get a media title from a
    // "data-matomo-title", "title" or "alt" HTML attribute. Sometimes it might be possible
    // to retrieve the media title directly from the video or audio player
    var title = MA.element.getMediaTitle(node);
    tracker.setMediaTitle(title);

    // some media players let you already detect the total length of the video 
    tracker.setMediaTotalLengthInSeconds(node.duration);

    var useCapture = true;


    node.addEventListener('play', function() {
        // if the player supports something like playlists you might want to check 
        // whether the source has changed and if so, call the following 3 methods:
        // tracker.reset();
        // tracker.setResource(newResource);
        // tracker.setMediaTitle(newMediaTitleOrEmptyString);
        // this allows you to automatically track a new media as soon 
        // as the currently played video or audio changes

        // notify the tracker the media is now playing
        tracker.play();
        
    }, useCapture);
    
    
    node.addEventListener('pause', function() {
        // notify the tracker the media is now paused
        tracker.pause();
    }, useCapture);
    
    
    node.addEventListener('ended', function() { 
        // notify the tracker the media is now finished
        tracker.finish(); 
    }, useCapture);
    
    
    node.addEventListener('timeupdate', function() {
        // notify the tracker the media is still playing
        
        // we update the current made progress (time position) and duration of 
        // the media. Not all players might give you that information
        tracker.setMediaProgressInSeconds(node.currentTime);
        tracker.setMediaTotalLengthInSeconds(node.duration);

        // it is important to call the tracker.update() method regularly while the 
        // media is playing. If this method is not called eg every X seconds no 
        // updated data will be tracked. 
        // The method itself will not actually send a tracking request whenever it 
        // is called. Instead it will make sure to respect the set ping interval and
        // eg only send a tracking request every 5 seconds.
        tracker.update();
        
    }, useCapture);
    
    
    node.addEventListener('seeking', function() {
        // "seekStart" is needed when the player is seeking or buffering. 
        // It will stop the timer that tracks for how long the media has been played.
        tracker.seekStart(); 
    }, true);
    
    
    node.addEventListener('seeked', function() {
        // we update the current made progress (time position) and duration of 
        // the media. Not all players might give you that information
        tracker.setMediaProgressInSeconds(node.currentTime);
        tracker.setMediaTotalLengthInSeconds(node.duration);
        
        // "seekFinish" is needed when the player has finished seeking or buffering. 
        // It will start the timer again that tracks for how long the media has been played.
        tracker.seekFinish();
    }, useCapture);


    // for videos it might be useful to listen to the resize event to detect a 
    // changed video width or when the video has gone fullscreen
    window.addEventListener('resize', function () {
        tracker.setWidth(node.clientWidth);
        tracker.setHeight(node.clientHeight);
        tracker.setFullscreen(MA.element.isFullscreen(node));
    }, useCapture);


    // here we make sure to send an initial tracking request for this media. 
    // This basically tracks an impression for this media. 
    tracker.trackUpdate();
}
```

For more information about all the available methods have a look at the [Media Analytics JavaScript Tracker API reference](/guides/media-analytics/reference).

Once you have added support for your custom player analytics, please [contact us](https://matomo.org/support/), and we will try to help you maintain it in the future.

## Tracking a new player in mobile apps and desktop apps

You can use the MediaAnalytics plugin to track the media consumption in mobile apps, desktop apps and games. For this
to work you need to use the [Piwik HTTP Tracking API](/api-reference/tracking-api) or a [Piwik Tracking SDK](/guides/tracking-api-clients).

### Media Analytics HTTP Tracking API reference

These HTTP Tracking API parameters can be used to track the usage of media:

* `ma_id` - (required) A unique id that is always the same while playing a media. As soon as the played media changes (new video or audio started), this ID has to change.
* `ma_re` - (required) The URL of the media resource.
* `ma_mt` - (required) `video` or `audio` depending on the type of the media.
* `ma_ti` - The name / title of the media.
* `ma_pn` - The name of the media player, for example `html5`.
* `ma_st` - The time in seconds for how long a user has been playing this media. This number should typically increase when you send a media tracking request. It should be `0` if the media was only visible/impressed but not played. Do not increase this number when a media is paused.
* `ma_le` - The duration (the length) of the media in seconds. For example if a video is 90 seconds long, the value should be `90`.  
* `ma_ps` - The progress / current position within the media. Defines basically at which position within the total length the user is currently playing.
* `ma_ttp` - Defines after how many seconds the user has started playing this media. For example a user might have seen the poster of the video for 30 seconds before a user actually pressed the play button.
* `ma_w`  - The resolution width of the media in pixels. Only recommended being set for videos.
* `ma_h`  - The resolution height of the media in pixels. Only recommended being set for videos.
* `ma_fs` - Should be `0` or `1` and defines whether the media is currently viewed in full screen. Only recommended being set for videos.
* `ma_se` - An optional comma separated list of which positions within a media a user has played. For example if the user has viewed position 5s, 10s, 15s and 35s, then you would need to send `5,10,15,35`. We recommend to round to the next 5 seconds and not send a value for each second. Internally, Matomo may round to the next 15 or 30 seconds. For performance optimisation we recommend not sending the same position twice. Meaning if you have sent `ma_se=10`  there is no need to send later `ma_se=10,20` but instead only `ma_se=20`.

### Example request to track a media impression 

When tracking a media impression it is important to set the parameter `ma_st` to `0`:

```
https://yourpiwikdomain/matomo.php?ma_st=0ma_id=8C1gOQ9CPOiQfzft&ma_ti=MediaName&ma_pn=playerName&ma_mt=video&ma_re=https%3A%2F%2Fplayer.example.org%2Fvideo%2F1111111&idsite=1&rec=1&r=077275&h=15&m=33&s=48&url=http%3A%2F%2Fexample.piwik&...
```

### Example request to track a media progress 

When tracking a media progress it is important to send the same media unique id (`ma_id`) while the same media is playing.
As soon as a new video or audio is playing you need to reset all parameters and generate a new `ma_id`.

```
https://yourpiwikdomain/matomo.php?ma_st=5&ma_ttp=12&ma_fs=1&ma_w=500&ma_h=300&ma_ps=34&ma_le=100ma_id=8C1gOQ9CPOiQfzft&ma_ti=MediaName&ma_pn=playerName&ma_mt=video&ma_re=https%3A%2F%2Fplayer.example.org%2Fvideo%2F1111111&idsite=1&rec=1&r=077275&h=15&m=33&s=48&url=http%3A%2F%2Fexample.piwik&...
```

While a media is playing we recommend sending an update regularly, for example every 5 seconds. Most of the parameters
usually remain the same when sending updated media progress requests, but the current media position (`ma_ps`) and the played
media time (`ma_st`) should change with every request.

### Using a Piwik Tracking SDK 

There are many [Piwik Tracking SDKs](/guides/tracking-api-clients) available for Piwik so 
you do not have to send pure HTTP requests. There is for example a Piwik Tracking SDK for PHP, Android, iOS, C#, Java 
and more. They usually allow you to set custom tracking parameters like this:

```php
$phpTracker->setCustomTrackingParameter('ma_st', 0);
$phpTracker->setCustomTrackingParameter('ma_re', 'https://example.org/media.mp4');
$phpTracker->setCustomTrackingParameter('ma_ti', 'Media title');
...
```


## What to read next

Now that you've learnt how to implement analytics tracking of your custom Media player, you may want 
to learn more about the [Media Analytics JavaScript API](/guides/media-analytics/reference), 
or read the Media Analytics [User FAQs](https://matomo.org/faq/media-analytics/) 
 or the [Developer FAQs](/guides/media-analytics/faq).

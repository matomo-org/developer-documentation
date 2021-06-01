---
category: DevelopInDepth
---

This document lists strategies that can be useful in debugging the many different parts of Matomo while developing on the platform.
You might find these useful if you are contributing to core or are writing your own plugin.

# Debugging Tracking Code

### When you are not in control of the website

If you need to debug the tracking code for a plugin that is not behaving correctly on a website you do not control, for example,
a client or customer's website, this strategy can help:

1. setup and start your local matomo, with the plugin you want to debug activated
2. visit the website you want to test the tracking code on
3. in the developer tools window, execute the following javascript snippet manually:

    ```javascript
    delete window.Piwik;
    delete window.Matomo;

    var _paq = [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    // ... add the other methods you need to call here, examples below ...
    //_paq.push(['FormAnalytics::enableDebugMode']);
    //_paq.push(['HeatmapSessionRecording::disable']);

    (function() {
        var u="//apache.matomo/"; // replace apache.matomo with the domain your local matomo is on, eg, localhost
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
    ```

   Note: depending on the plugin you are testing, you may want or need to adjust what tracker methods are called.
4. tracking requests will now be sent to your local matomo, allowing you to debug the entire workflow, end to end, locally.

Once you're receiving tracking requests from the website, you may want to modify the tracking code that is used in order to
debug an issue or just get better insight into what's happening. You can do this by modifying the plugin's `tracker.js` file
(or the core `js/piwik.js`) and regenerating the JavaScript. Use the following method so the unminified code will be used:

```bash
./console custom-matomo-js:update --ignore-minified
```

Then reload the webpage and rerun the JavaScript snippet above to use the new tracking code.

This strategy can help increase the speed of debugging complex issues that you do not know how to reproduce locally
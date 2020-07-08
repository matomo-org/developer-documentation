---
category: Integrate
title: Websites (JavaScript)
---
# Running an A/B test experiment in your website using JavaScript only

This guide covers how to run experiments (A/B tests) in your website using the [Piwik JavaScript Tracker](/guides/tracking-javascript-guide)
and the Piwik A/B Testing JavaScript framework. 

We will learn how to embed the A/B testing framework in your website, how to embed and implement your experiments using best practises, 
and what to do when an experiment is finished. 

## Creating an experiment

Read the [A/B testing user guide](https://matomo.org/docs/ab-testing/) to learn more about creating an A/B test experiment.

## Embedding the A/B Testing JavaScript framework

The [A/B Testing plugin](https://www.ab-tests.net) directly adds the JavaScript A/B testing framework to your Matomo JavaScript tracker file `/matomo.js` 
and is therefore loaded automatically with the [Piwik JavaScript Tracking Code](/guides/tracking-javascript-guide).

This will work by default as long as the file `matomo.js` in your Piwik directory is writable by the webserver/PHP.
 
To check whether this works by default for you, login into Piwik as a Super User, go to Administration, and open the "System Check" report. 
If the System Check displays a warning for "Writable Matomo.js" then [learn below in the FAQ how to solve this](#how-do-i-include-the-ab-testing-framework-when-my-matomojs-file-is-not-writable).


### Loading matomo.js synchronously as early as possible

To prevent any flickering / flashing of content when you run your experiments, you need to make sure to load the 
`matomo.js` tracker file as early as possible. Edit your JavaScript tracking code as follows:

* Move the Piwik Tracking Code that loads the `matomo.js` file into the HTML `<head>`
* Load the file synchronously instead of asynchronously by:
  1. Removing the two lines containing: `var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);`
  2. Adding the following line after the closing `</script>` element: `<script type="text/javascript" src="//$yourPiwikDomain/matomo.js"></script>`
  3. Your JavaScript tracker code should look like this:
    
    ```html
    <head>
    <script type="text/javascript">
      var _paq = window._paq = window._paq || [];
      // [...]
      (function() {
        var u = "//$yourPiwikDomain/";
        _paq.push(['setTrackerUrl', u+'matomo.php']);
        _paq.push(['setSiteId', 'X']);
      })();
    </script>
    <script type="text/javascript" src="//$yourMatomoDomain/matomo.js">
    ```
    
In the case where you are using the [`SitesManager.getJavascriptTag` API](/api-reference/reporting-api#SitesManager) to embed the tracking code automatically into your website, 
the JavaScript code will automatically load synchronously. It is still recommended to move the tracking code into `<head>`.

## Embedding an experiment

When creating an experiment in your Piwik, the A/B testing plugin will generate for you the JavaScript code that will run your experiment
and that you need to embed in your pages. The code typically looks like this:

```js
_paq.push(['AbTesting::create', {
  name: 'theExperimentName',
  includedTargets: [{"attribute":"url","type":"starts_with","value":"http:\/\/www.example.org","inverted":"0"}],
  excludedTargets: [],
  variations: [
      {
          name: 'original',
          activate: function (event) {
              // usually nothing needs to be done here
          }
      },
      {
          name: 'blue',
          activate: function(event) {
              // eg $('#btn').attr('style', 'color: ' + this.name + ';');
          }
      }            
  ]
}]);
```

In this example an experiment is created via the `_paq.push` method and several experiment properties are set. 
This experiment code will be generated for you in your Piwik. 
For better understanding here is an explanation of what these properties mean:

* `name` - The name of the experiment as configured in Piwik. 
 * If you prefer not to expose your experiment's name to your users in the DOM, you can alternatively use the experiment ID. You can find the ID of an experiment in the list of all experiments in your Piwik.
* `includedTargets` - Specifies on which target pages the experiment is supposed to be activated. For an experiment to be activated, all rules need to match (logical AND) and none of the excluded targets is allowed to match.
* `excludedTargets` - Specifies on which target pages the experiment is supposed to not be activated. If any of the given rules matches (logical OR), the experiment will not be activated even if all of the included targets match. 
* `variations` - The list of different variations you want to compare. Experiments can be created for more than just two variations (A/B). 
 * Please note that you cannot simply add more variations in this JavaScript code. When Piwik receives a tracking request for an experiment, it will only accept the pre-configured variations. To define more experiment's variations or change an existing variation, edit your experiment in Piwik > Personal > Experiments. 

### Optional experiment properties

There are more properties that can be configured when you create an experiment in your Piwik. These properties are optional.

```js
_paq.push(['AbTesting::create', {
  // [...]
  percentage: 100,
  startDateTime: '2017/08/25 00:00:00 UTC',
  endDateTime: '2020/05/21 23:59:59 UTC',
  trigger: function () {
      if (isLoggedIn && userAge < 50) {
          return true;
      }
      return false;
  },
  piwikTracker: Matomo.getAsyncTracker(matomoUrl, matomoSiteId),
  variations: [
        // [...]
        {
            name: 'VariationA',
            percentage: 40,
            activate: function(event) {}
        }          
    ]
}]);
```
  
* `percentage` - The percentage of how many of your users should take part in this experiment. By default, 100% of your users will participate in your experiment and see either the original version or any of your variations.
* `startDateTime` - If configured, the experiment will not be activated until the specified start time. 
* `endDateTime` - If configured, the experiment will no longer be activated after the specified end time. 
* `trigger` - The `trigger` function allows you to further restrict which of your visitors will participate in your experiment. For example if you want to run the experiment only for visitors from a specific country or only want to activate the experiment on a certain type of pages, you can use this method to customize who will participate in this experiment. 
* `piwikTracker` - Lets you set a Piwik tracker instance if you track your data [into multiple Piwik instances](/guides/tracking-javascript-guide#multiple-piwik-trackers) and wish your experiments to be only tracked into one specific Piwik instance.
* `variation.percentage` - By default, each variation gets the same amount of traffic but you can allocate more or less
                           traffic to individual variations. You don't have to configure a percentage on all variations. 
                           If a percentage is only specified for a few variations, all other variations will share the 
                           remaining percentage equally. For example if you specify `VariationA` should get 40%, 
                           then the `original` version and `VariationB` will share the remaining 60% and be seen by 
                           30% of your traffic each. We recommend not to assign more than 100% across all of your variations.

## Implementing an experiment

To summarize what we've learnt so far:

* To prevent flickering/flashing of the content, the `matomo.js` file is loaded synchronously as early as possible.
* the Piwik generated experiment's code is copied and paste into the website.

Now you need to actually implement what is supposed to happen when a variation of your experiment gets activated. 
All you need to do is to implement the `activate` method for each of your variations. 

#### Example experimenting with different colors of a button 
 
For example if you want to compare different color buttons, you can implement the `activate` method as follows:

```js
variations: [{
  name: 'blue',
  activate: function(event) {
      document.getElementById('btn').style.color = '#0000ff';
  }
},
{
  name: 'red',
  activate: function(event) {
      document.getElementById('btn').style.color = '#ff0000';
  }
}] 
```

#### About the `activate` method

Within the `activate` method, the `this` context is within your variation. This means you can access the name of your variation via `this.name`. 

An `event` is passed to the `activate` method which lets you for example:

 * access the instance of your experiment via `event.experiment`, 
 * redirect users via `event.redirect(url)`,
 * define a function that is supposed to be executed as soon as the DOM is ready via `event.onReady(callback)`.

If you access the DOM using jQuery or another library, make sure that this library was already loaded when the experiment gets activated.

#### Testing variations

Testing variations can be cumbersome because variations are activated randomly and you always get to see the same variation. To test a specific variation you can append a URL parameter `?pk_ab_test=$variationName`. This will make sure to activate the given variation even if the experiment should not trigger yet because of a defined filter. It will also not track any experiment activation to your Piwik so your data is kept clean.

If you are running multiple tests on the same page, you can activate multiple variations by specifying the variation names comma separated: `?pk_ab_test=$variationName1,$variationName2`.

### Tracking a goal manually

When comparing different variations it is often needed to [track goals](https://matomo.org/docs/tracking-goals-web-analytics/) 
in order to decide which of the variations is the most successful. When you configure your experiment, you can assign 
multiple goals as a "success metric". These goals are usually converted automatically without having to do anything, but 
you can also track a goal conversion manually like this: 

```js
variations: [{
  name: 'blue',
  activate: function(event) {
      var button = document.getElementById('btn');
      button.style.color = '#0000ff';
      button.addEventListener('click', function () {
          var idGoal = 5;
          event.experiment.trackGoal(idGoal);
      });
  }
}] 
```

### Impact of ITP (Intelligent Tracking Protection)

Matomo stores the selected variation in the local storage to remember which variation was activated for a specific visitor. 
Since Safari 13.1, Safari deletes all locally stored data after seven days. This means if a visitor is not visiting your 
site for seven days, the activated variation is no longer remembered and the next time your visitor visits your website, 
a new variation will be randomly selected. Should the visitor visit your website again within seven days, we try to extend
the lifetime for another seven days. We don't expect this behaviour to bias or invalidate the results.

Should you want to exclude Safari when running A/B tests, you can add the following code to your tracking code:

```js
// works from A/B testing 3.2.18
_paq.push(['AbTesting::disableWhenItp']);
// or 
Matomo.AbTesting.disableWhenItp();
```

Make sure to call this method before you define any experiment.

### Disabling A/B testing feature

Should you not want to run any A/B test for a while without needing to remove all the already embedded experiments
from your website you can run execute the following code:

```js
// works from A/B testing 3.2.18
_paq.push(['AbTesting::disable']);
```

Make sure to call this method before you define any experiment.

### Preventing flickering / flashing of content

When you compare for example different button colors to see which of the colors converts the best, you could run into
a problem where first the original color is shown for a few milliseconds before the color gets changed to the color of a
variation. This is known as flickering or flashing of content.

To prevent this flickering, it is important to place the experiment tracking code at the right position in your website source code. 

#### Load matomo.js synchronously

As already mentioned earlier in this guide: it is highly recommended to load the `matomo.js` file 
[synchronously](#loading-matomojs-synchronously-as-early-as-possible) in the HTML `<head>`.

#### Deciding where to place the experiment code

We recommend pasting the experiment JavaScript code directly after the HTML element you want to change.

If you can't put the JavaScript code into the middle of your HTML, you can also put the code directly into the HTML 
`<head>` element, and perform the actual change as soon as the DOM is ready:

```js
{
  name: 'blue',
  activate: function(event) {
      event.onReady(function () {
          document.getElementById('btn').style.color = this.name;
      });
  }
}
``` 

Using the DOM Ready event can be problematic as there might be other DOM ready events registered that are executed before 
your experiment gets activated. If you use the `onReady` event, make sure to place the experiment code as high up in 
the HTML `<head>` as possible.

#### Consolidate your CSS changes

When you are changing many CSS styles at once, it is recommended to change them all at once like this:

```js
{
  name: 'blue',
  activate: function(event) {
    document.getElementById('btn').style.cssText = 'color: blue; font-size: 15px;';
  }
}
```

Alternatively you can use CSS classes to change multiple CSS styles at once:

```js
{
  name: 'blue',
  activate: function(event) {
    document.getElementById('btn').className += ' myClass';
  }
}
```

#### Use Vanilla JavaScript instead of jQuery or other libraries

If possible, try to use native JavaScript code in your variations. Using `document.getElementById('btn')` will be faster 
than `jQuery('#btn')`. If you need to support old browsers, we recommend testing that variations get activated
correctly in these browsers.

#### Move your experiment code out of a tag manager

We recommend moving the tracking code out of a tag manager if you use one at all, and instead paste the experiment code directly 
into your website. If you cannot move it out of your tag manager, make sure that your experiment is set to load synchronously in the tag manager.

#### Match the order of your experiments

If you run multiple experiments on your website, it can be beneficial to output first the experiment JavaScript code for 
experiments that affect elements that are above the fold. This ensures your experiments running above the fold will be executed first
and that code for experiments not visible above the fold will be executed afterwards.

#### Consider embedding the experiment without _paq.push

Read more about this option in [Custom experiment implementation without _paq.push](#how-do-i-implement-an-experiment-without-using-_paqpush).

#### Hide the body until the variations are executed

If you have a persistent flashing that you cannot resolve, you might want to consider to hide the entire `<body>`
until your experiment is executed. This should be usually not needed but it can be a solution if the other options didn't help.

## Finishing an experiment

When an experiment is finished:

 * remove the experimentation code from your website to make sure your visitors won't enter your experiment anymore. This is recommended even if you have scheduled a finish date. 
 * if the experiment proved that one of your variation performed significantly better than the original version, you likely want to change your website or app and implement the winning variation permanently. 

Happy experimenting!

## FAQ

### How do I activate the experiment only for a specific group of users?

You can do this using the `trigger` method that can be set as an experiment property. In that method you can execute
any custom logic and the experiment will get only activated if the method returns `true`. If a user is logged in and you know
 the age of the user, you could for example trigger an experiment only for users that have a certain age, or are from a 
 certain region.

### How do I activate the experiment only for a specific set of pages?

In the Piwik Admin UI, when you edit an experiment you can configure on which pages the experiment is supposed to be activated. 
However, you might have many different pages on which the experiment should be activated and these pages do not follow a specific 
rule. In this case, you can use the `trigger` method to activate the experiment only on a certain set of pages. 

First, we recommend making sure that the experiment is configured to be activated on all pages. This can be done when 
creating or when editing an experiment under "Target Pages". It should say "Activate experiment on any page / URL".

Next, you might need to set a JavaScript variable that lets you identify a certain type of page. For example if you
want to execute the experiment for product pages only, you could set a JavaScript variable `var isProductPage = true`. 
When you set such a JavaScript variable, make sure the variable is set in your web page earlier than where the experiment JavaScript code is embedded.

Last, you need to implement the `trigger` method. Here you could either access a previously set variable or implement 
any custom rule like this:

```js
includedTargets: [{"attribute":"url","type":"any","inverted":"0","value":""}],
trigger: function (event) {
  if ('undefined' !== typeof isProductPage && isProductPage) {
      return true;
  }
  
  if (location.href.indexOf('/products/') !== -1) {
      return true;
  }
  
  return false;
}       
```

In this example the experiment was configured (in your Piwik) to be activated on all pages, and will be actually activated for your visitors when the `trigger` method returns `true`.

### How do I activate a specific variation via URL parameter?

You can add a URL parameter `?pk_ab_test=$variationName` to force the activation of a specific variation. This is useful when you are integrating an experiment and you want to test each variation or when you need to share a URL for each variation with your colleagues to get an approval before running an experiment.

### Where does Piwik store which variation gets activated?

The selected variation for an experiment is persisted in the local storage of your users browsers. This makes sure the same user will always see 
the same variation on all subsequent visits. If the local storage feature is not supported by the browser, this information 
is stored in a cookie for up to 365 days.

### Can I use redirects in A/B tests to test entirely different pages or layouts?

Yes, please see below the different ways this can be achieved:

1. When you create your experiment in the UI, under the section “Redirects”, for each variation (including the “Original” variation) you can can enter the Page URL to redirect to and test. ([learn more in this FAQ](https://matomo.org/faq/ab-testing/faq_22493/)). This is the easiest way to compare the performance of different page URLs. Note that a page redirect will be triggered in JavaScript, which will cause a small delay before the page is reloaded and showing the variation, therefore for optimal performance we recommend to use server side redirects (see below).
2. Alternatively, you can compare different pages URLs by running an experiment on your [server](https://developer.matomo.org/guides/ab-tests/server#redirects). 
**Server side redirects** are recommended for performance reasons: they have the advantage that they are more SEO friendly and faster to load for your users.
It is highly recommended to send your users to a different page URL via an HTTP 302 redirect (temporary) and not via a 301 (permanent). 
This way search engines know the redirect is temporary and that they should keep the original URL in their search index. 
3. If running the experiment server-side is not an option, you can also use **JavaScript redirects**, by calling the `redirect` method on the `event` that is passed to your 
`activate` methods. Here is an example:

```js
variations: [
  {
      name: 'blue',
      activate: function(event) {
          event.redirect('/myDifferentLayout');
      }
  }            
]
```

Make sure to embed the experiment as early as possible in the HTML `<head>`. Please note that the A/B Testing framework will 
add two URL parameters `pk_abe` and `pk_abv` to the redirect URL so Piwik knows which experiment was activated. 

### How do I force a specific variation to be activated?

In order to do this you need to [implement the experiment without _paq.push](#how-do-i-implement-an-experiment-without-using-_paqpush). Make sure to set a
`trigger` method that always returns `false`. This way no variation gets activated by default. Once the experiment
has been created, you can force a custom variation like this:

```html
<script>
function forceExperiment() {
  var Experiment = Matomo.AbTesting.Experiment;
  
  var myExperiment = new Experiment({
    // [...]
    variations: [
      {
        name: 'blueVariation',
        activate: function(event) { 
          // this variation will get activated
        }
      }
    ],
    trigger: function () {
      // this is important, otherwise a random variation will be chosen
      return false; 
    }
  });

  myExperiment.forceVariation('blueVariation');
  // this will call the activate method for the blue variation.
}
if ('object' === typeof Piwik && 'object' === typeof Matomo.AbTesting) {
    // if matomo.js was embedded before this code
    forceExperiment();
} else {
    // if matomo.js is loaded after this code
    window.piwikAbTestingAsyncInit = forceExperiment;   
}
</script>
```

Forcing variations can be useful if an experiment requires you to make changes on the [server](/guides/ab-tests/server) 
and on the client at the same time. The workflow would be to first activate any of the experiment variations on the 
server and afterwards force the same variation in the client. 

### How do I know when the A/B Testing framework has been loaded and initialized?

The A/B Testing framework executes a method `window.piwikAbTestingAsyncInit` as soon as it has been loaded. When you 
specify such a method, you can be sure that variables like `Matomo.AbTesting` are available. If you load the `matomo.js`
file synchronously as recommended, you can be sure that `Matomo.AbTesting` will be defined just after the include of 
`matomo.js`

### Can I integrate the A/B Tests when I use a framework like Angular, Ember, ReactJS?

Yes, you can run your A/B tests in any popular JavaScript framework. 
We recommend [creating your experiment without _paq.push](#how-do-i-implement-an-experiment-without-using-_paqpush) as follows:
 
```js
var Experiment = Matomo.AbTesting.Experiment;

var myExperiment = new Experiment({
  // [...]
  variations: [
      {
          name: 'blue',
          activate: function(event) {
              // leave the activate method empty
          }
      }            
  ]
});

// eg in angular
$scope.linkColor = myExperiment.getActivatedVariationName();
```

This allows you to get the activated variation name directly, so you know which variation to serve. 
For example in the case of Angular, you would typically assign the variation name to a controller
or scope variable and use it in a template. This will usually help to prevent the flickering / flashing of content as
the content will be directly rendered the way it is supposed to be.

 
### How do I implement an experiment without using `_paq.push`?

By default, an experiment is activated via `_paq.push`. If you prefer not to use `_paq.push`, or if you want to be able to
[force a specific variation](#how-do-i-force-a-specific-variation-to-be-activated) or cannot prevent the flashing of content, you can embed and implement the 
experiment as follows:

```html
<script>
function createExperiment() {
  var Experiment = Matomo.AbTesting.Experiment;
    
  var myExperiment = new Experiment({
    name: 'theExperimentName',
    includedTargets: [{"attribute":"url","inverted":"0","type":"starts_with","value":"http:\/\/www.example.org"}],
    excludedTargets: [],
    variations: [
      {
        name: 'blue',
          activate: function(event) {
            // either place implementation code here, or below
        }
      }            
    ]
  });
    
  var selectedVariation = myExperiment.getActivatedVariationName();
  
  if (selectedVariation === 'blue') {
    // do something
  } else if (Experiment.NAME_ORIGINAL_VARIATION === selectedVariation) {
    // original version is supposed to be shown, usually nothing to do
  } else if (null === selectedVariation) {
    // the experiment is supposed to do nothing as the visitor does not participate in the experiment
    // basically means the original version is supposed to be shown
  }
}

if ('object' === typeof Piwik && 'object' === typeof Matomo.AbTesting) {
    // if matomo.js was embedded before this code
    createExperiment();
} else {
    // if matomo.js is loaded after this code
    window.piwikAbTestingAsyncInit = createExperiment;   
}
  
</script>
```

The method `getActivatedVariationName` will either return the name of the activated variation, a string 'original' 
if the original version is supposed to be shown or null if the visitor is not supposed to participate in the experiment 
at all.

### How do I include the A/B testing framework when my `matomo.js` file is not writable?
 
When your Settings > System Check reports that "The Piwik JavaScript tracker file `matomo.js` is not writable 
which means other plugins cannot extend the JavaScript tracker." then you have two options to solve this issue:

1. Make the `matomo.js` file writable, for example by executing `chmod a+w piwik.js` or `chown $phpuser piwik.js` (replace `$phpuser` with actual username) in your Piwik directory. 
We recommend running the [Piwik console](/guides/piwik-on-the-command-line) command `./console custom-piwik-js:update` after you have made the file writable.
2. or Load the A/B Testing framework manually in your website by adding in all your pages in the `<head>`: 
   `<script src="//$yourPiwikDomain/plugins/AbTesting/tracker.min.js">`
   
Please note there are a few disadvantages to include the A/B testing framework file manually:

* An additional HTTP request is needed to load your website which increases your page load time
* If your `matomo.js` ever becomes writable, the A/B Testing framework would be loaded twice (in such a case the tracker notices it was already initialized and won't initialize again)

If possible, we recommend making the `matomo.js` file writable.


### My A/B test experiment is not working, how do I debug it?

You can enable the debug mode by calling the following method:

```js
_paq.push(['AbTesting::enableDebugMode']);
```
 
Calling this method will start logging all tracking requests and some more information to the developer console of 
your browser. It is recommended to call this method as early as possible to capture all log messages. 

## What to read next

Learn more about running experiments in the [A/B Testing User Guide](https://matomo.org/docs/ab-testing/), the [A/B Testing FAQs](https://matomo.org/faq/ab-testing/)
and the [A/B testing website](https://www.ab-tests.net/).


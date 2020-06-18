---
category: Integrate
title: Mobile & Desktop Apps
---
# Running an A/B test experiment in an app eg. Android, iOS, desktop app or games 

You can run experiments in apps by using any A/B testing framework of your choice if you are tracking your users 
via one of the Piwik SDKs (eg [Android SDK](https://github.com/matomo-org/matomo-sdk-android), 
[iOS SDK](https://github.com/matomo-org/matomo-sdk-ios), [C#](https://github.com/matomo-org/piwik-dotnet-tracker), 
[PHP](https://github.com/matomo-org/matomo-php-tracker), [Java](https://github.com/matomo-org/piwik-java-tracker), 
[Python](https://github.com/matomo-org/matomo-python-tracker/tree/dev)). 

This guide requires that you track your application via a [Piwik Tracking SDK](/guides/tracking-api-clients), 
via the [Tracking HTTP API](/api-reference/tracking-api) or any other [Piwik Tracking Integration](https://matomo.org/integrate).
 
## Creating an experiment

First you need to create an A/B test experiment in Piwik: read the [A/B testing user guide](https://matomo.org/docs/ab-testing/) to learn more.

When you are asked on which target pages the experiment should be activated, we recommend selecting "Visitors enter this experiment on any page".

## Implementing an experiment

To implement the actual experiment, you can use any A/B testing framework of your choice.
 For example [PlanOut by Facebook](https://facebook.github.io/planout/) (Java, PHP, JavaScript, Go, Ruby) or [Vanity](https://github.com/assaf/vanity) (Ruby). For PHP we provide our own [InnoCraft PHP Experiments framework](https://github.com/innocraft/php-experiments).

When you choose an A/B testing framework, it is important that the framework lets you know which variation was chosen for a user. 
This will be important for the next step when you have to track which variation's name was used when a user entered
into an experiment. 

Using an A/B testing framework could look as follows (the following example is using our InnoCraft PHP Experiments framework):

```php
use InnoCraft\Experiments\Experiment;

$variations = [['name' => 'variation1'], ['name' => 'variation2']];
$experiment = new Experiment('theExperimentName', $variations);
$activated = $experiment->getActivatedVariation();
if ($activated->getName() == 'variation1') {
    /* do something variation1 */
} elseif ($activated->getName() == 'variation2') {
    /* do something variation2 */
}

// Important: let Piwik know that you have entered the current visitor into an experiment
$experiment->trackVariationActivation($piwikPhpTracker);
// executes $piwikPhpTracker->trackEvent('abtesting', 'theExperimentName', 'nameOfActivatedVariation');
```

### Sending the name of the activated variation to Piwik

So far you have created and implemented the experiment, so users get to see different versions of your app. 
Now you need to let Piwik know which variation was activated for your current user by tracking a [Piwik event](https://matomo.org/docs/event-tracking/):

```php
// example tracking request via PHP Piwik Tracker
$tracker->doTrackEvent('abtesting', 'buynowfoobar', 'nameOfVariation');
```

```objectivec
// example tracking request via Piwik iOS SDK
[[PiwikTracker sharedInstance] sendEventWithCategory:@"abtesting" action:@"buynowfoobar" name:@"nameOfVariation"];
```

```java
// example tracking request via Piwik Android SDK
TrackHelper.track().event("abtesting", "buynowfoobar").name("nameOfVariation").with(tracker);
```

When you track an event, make sure to pass the following values:
* Use `abtesting` as event category
* Use the experiment name or experiment ID as event action. 
* Use the variation name or variation ID as event name. When the original version was activated, use `original`. 

The experiment name and variation names that you use have to be pre-configured for that experiment in your Piwik. 
If you track a different variation name without having created it in your Piwik, 
the request will be ignored and a regular event will be tracked.

### Custom A/B testing framework

You can also implement a simple A/B testing framework yourself. An A/B test framework basically works as follows:

* If the current user has not participated in this experiment yet:
  * Select a variation or the `original` version randomly.
  * Persist which variation name got activated to make sure you always 
     show the same variation on subsequent sessions.  
* If the user has already participated in this experiment and a persisted variation name exists:
  * read the persisted variation value to find out which variation the user is supposed to see.
* Execute the app code for the randomly chosen, or previously activated variation: 
  * this is the code which implements the changes needed to display this variation in your app.  
* Send the name of the activated variation to Piwik  (see previous section)

## Finishing an experiment

When an experiment is finished:

 * Remove the experimentation code from your website to make sure your visitors won't enter your experiment anymore. This is recommended even if you have scheduled a finish date. 
 * If one of the variations performed significantly better than another, it is now time to change your app implementation to the winning variation and to benefit from better conversion rates. 

Happy experimenting!

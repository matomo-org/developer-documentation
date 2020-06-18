---
category: Integrate
title: Websites (Server-side)
---
# Running an A/B test experiment in your website server-side using PHP, Java, Python, Ruby, Perl, C#, ...

This guide covers how to run an A/B test for a website on the server instead of in the client (browser). For example, 
you might want to redirect your users to entirely different versions of your website, 
or test different fonts or different features that need to run a different code path on the server depending on which variation a visitor gets to see.

## Creating an experiment

First you need to create an A/B test experiment in Piwik: read the [A/B testing user guide](https://matomo.org/docs/ab-testing/) to learn more.

When you are asked on which target pages the experiment should be activated, we recommend selecting "Visitors enter this experiment on any page".

## Embedding an experiment

In most cases, nothing needs to be done as long as the regular [Piwik JavaScript Tracking Code](/guides/tracking-javascript-guide) 
is embedded into your website. Learn more about this step in the [Embedding the A/B Testing framework](/guides/ab-tests/browser#embedding-the-ab-testing-javascript-framework).
 
The generated experiment code (`_paq.push(['AbTesting::create', {...`) does not need to be embedded into your website.

## Implementing an experiment

To implement the actual experiment, you can use any A/B testing framework of your choice.
 For example [PlanOut by Facebook](https://facebook.github.io/planout/) (Java, PHP, JavaScript, Go, Ruby),
or [Vanity](https://github.com/assaf/vanity) (Ruby). For PHP we provide our own [PHP Experiments framework](https://github.com/innocraft/php-experiments).

When you choose an A/B testing framework, it is important that the framework lets you know which variation was chosen for a user. 
This will be important for the next step when you have to track in Piwik which variation's name was used when a user entered
into an experiment. 

Using an A/B testing framework could look as follows (the following example is in PHP using our InnoCraft PHP Experiments framework):

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

// Important: let Piwik know that you have entered the current visitor into an experiment. 
// We recommend escaping the experiment name and variation name if needed to prevent possible XSS.
$script = $experiment->getTrackingScript($experiment->getExperimentName(), $activated->getName());
echo $script; // prints eg "<script ...>_paq.push(['AbTesting::enter', {experiment: 'theExperimentName', variation: 'variation1'}]);"
```

### Sending the name of the activated variation to Piwik

So far you have created and implemented the experiment server-side, so your users get to see different variations of your website. 
Now you need to let Piwik know which variation was activated for your current user by adding a JavaScript tracking code to your
HTML:

```js
_paq.push(['AbTesting::enter', {experiment: 'theExperimentNameOrId', variation: 'myVariation'}]);
```

This tracking code lets Piwik know that you have entered the current visitor into an experiment. 

* `experiment` - The name of the experiment
 * If you prefer not to expose your experiment's name to your users in the DOM, you can alternatively use the experiment ID. You can find the ID of an experiment in the list of all experiments in your Piwik.
* `variation` - The name of the variation you have entered the current visitor into. If you have shown the
  original version of your website, use `original`. 
 * You can alternatively use the variation ID. 
 The variation ID is shown when you edit your experiment in your Piwik and hover a variation (put your mouse over a variation form field). 
  
The Piwik JavaScript Tracker will pick up this information when the website is loaded and will send a tracking request to your Piwik Tracking API.

### Redirects

Sometimes you might want to compare how entirely different pages or layouts perform against each other. 

For example you might have just implemented a new design for your website and want to make sure that your conversion rates 
will be at least the same with the new design. To do this you can run an experiment and send some of your users 
to the new layout before you use the new design permanently for all of your users. Piwik A/B tests lets you compare how your most 
important metrics are impacted for the old and the new design. When you run such an experiment we usually 
recommend to only send a few percentage of your users to the newly created layout or website just in case your new 
layout performs significantly worse.

When you redirect users to a different URL make sure to use an HTTP 302 (temporary) redirect and not an HTTP 301 redirect. 
An example looks as follows:

```php
/**
 * Example using InnoCraft PHP Experiments framework
 */
use InnoCraft\Experiments\Experiment;
 
$variations = [['name' => 'newDesign', 'url' => '/newDesign.php']];
$experiment = new Experiment('theExperimentName', $variations);
$activated = $experiment->getActivatedVariation();

// automatically redirects to newDesign.php if the "newDesign" version gets chosen for a user and makes
// sure to track the chosen variation on the next request.
$activated->run();

// if user was not redirected because the original version was chosen, we need to let Piwik know that 
// the original version was activated.
$script = $experiment->getTrackingScript($experiment->getExperimentName(), $activated->getName());
echo $script; // prints eg "<script ...>_paq.push(['AbTesting::enter', {experiment: 'theExperimentName', variation: 'original'}]);"
```

Alternative version performing the redirect manually:

```php
/**
 * in index.php:
 */
echo "_paq.push(['AbTesting::enter', {experiment: 'theExperimentName', variation: 'original'}]);"

$variations = [['name' => 'newDesign']];
$experiment = new Experiment('theExperimentName', $variations);
$activated = $experiment->getActivatedVariation();

if ($activated->getName() === 'newDesign') {
    // make sure to persist the selected variation so when newDesign.php is loaded you can
    // let Piwik know which variation was activated
    header("Location: /newDesign.php", true, 302);
    exit;
} else {
    // do nothing and show original variation
    echo "_paq.push(['AbTesting::enter', {experiment: 'theExperimentName', variation: 'original'}]);"
}

/**
 * in newDesign.php:
 */
echo "_paq.push(['AbTesting::enter', {experiment: 'theExperimentName', variation: 'newDesign'}]);"
```

### Custom A/B testing framework

You can also implement a simple A/B testing framework yourself. An A/B test framework basically works as follows:

* If the current user has not participated in this experiment yet:
  * Select a variation or the `original` version randomly.
  * Persist which variation name got activated to make sure you always 
     show the same variation on subsequent sessions. The variation can be persisted for example in a cookie or in the user session. 
* If the user has already participated in this experiment and a persisted variation name exists:
  * read the persisted variation value to find out which variation the user is supposed to see.
* Execute the server-side code for the randomly chosen, or previously activated variation: 
  * this is the code which implements the changes needed to display this variation in your website, for example displaying a different design.  
* Output in your website the one-line JavaScript code that lets Piwik know which variation was activated:
  * `_paq.push(['AbTesting::enter', {experiment: 'theExperimentName', variation: 'variationNameOrIdActivatedForCurrentVisitor'}]);`

## Finishing an experiment

When an experiment is finished:

 * Remove the experimentation code from your website to make sure your visitors won't enter your experiment anymore. This is recommended even if you have scheduled a finish date. 
 * If one of the variations performed significantly better than another, it is now time to change your app implementation to the winning variation and to benefit from better conversion rates. 

Happy experimenting!


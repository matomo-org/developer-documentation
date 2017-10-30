---
category: Integrate
title: Campaigns & Email Marketing 
---
# Running an A/B test experiment in a Marketing campaign eg. banner ad campaign or email marketing

Learn how to run A/B tests in your Marketing campaigns to analyze how different email and ad campaigns
affect the browsing behaviour and conversion rates on your website. For example, you could run three different ad campaigns and not only see which campaign gets clicked more often but also which campaigns actually converts better once the visitors are on your website. Or maybe you want to send different newsletters to your users and compare how they affect the browsing behaviour on your website.

In this guide you will learn how to create an experiment and implement it in your marketing email campaign, to let A/B Testing compare your campaigns and detect the better performing and winning variation.
 
## Creating an experiment

First you need to create an A/B test experiment in Piwik: read the [A/B testing user guide](https://piwik.org/docs/ab-testing/) to learn more.

When you are asked on which target pages the experiment should be activated, we recommend selecting "Visitors enter this experiment on any page".

## Embedding an experiment

In most cases, nothing needs to be done as long as the regular [Piwik JavaScript Tracking Code](/guides/tracking-javascript-guide) 
is embedded into your website. Learn more about this step in the [Embedding the A/B Testing framework](/guides/ab-tests/browser#embedding-the-ab-testing-javascript-framework).
 
The generated experiment code (`_paq.push(['AbTesting::create', {...`) does not need to be embedded into your website.


## Implementing an experiment

As marketing campaigns are typically seen by your audience outside of your website (on other websites, in emails, in search engines...), 
you need to modify the campaign URL that leads your users to your website. 

### Tagging the A/B test variation in your Marketing campaign URLs 
You only need to add two URL parameters: `pk_abe` and `pk_abv` which let Piwik know which campaign variation a user got to see. 

If your landing page is `https://example.org/landingpage`, you would include the following URL to link visitors to your website:

```
https://example.org/landingpage?pk_abe=$theExperimentNameOrId&pk_abv=$variationNameOrId
```

where:

* `$theExperimentNameOrId` is the name or the ID of the experiment
* `$variationNameOrId` is the name or the ID of the variation (use `original` for the original variation)

### Example of A/B tested Marketing Campaigns URLs  

For example, when the `blue` variation for experiment `buyNowColor` was shown, the URL will be:

```
https://example.org/landingpage?pk_abe=buyNowColor&pk_abv=blue
```

When the `original` version for experiment `buyNowColor` was shown, the URL will be:

```
https://example.org/landingpage?pk_abe=buyNowColor&pk_abv=original
```

If you prefer not to have the experiment name in the URL, use the experiment ID and variation ID:

```
https://example.org/landingpage?pk_abe=5&pk_abv=19
```

Once you have added the URL parameters, your visitors will automatically enter the experiment when they visit your website
 via your campaign and you can analyze if any of their behaviour is different depending on the shown variation.
 
### Finding an experiment ID and variation ID

As shown in the example above you can either use the experiment name and variation name or the experiment ID and 
variation ID in the URL. Using IDs is useful when you do not want to expose the names of your experiments and 
variations in the URL.

* You can find the ID of an experiment in the list of all experiments in your Piwik. 
* The ID of a variation is shown when you edit your experiment in your Piwik and hover a variation (put your mouse over a variation form field). 

The IDs are also shown in the "Embed code" area when you edit an experiment in the tracking code example.


## Using A/B tests along with the standard Piwik campaign tracking

Measuring the impact of your campaigns using experiments complements the existing built-in Piwik [Campaign Tracking](https://piwik.org/docs/tracking-campaigns/).

We recommend creating experiments to measure your marketing campaigns as it will provide you additional value such as:

* a clear and result-focused reporting, 
* a statistical significance indicator of how your campaign variations perform, 
* the ability to use IDs instead of names, 
* measure the impact of certain variations of your campaigns over time,
* measure how given variations perform across several marketing campaigns, 
* and more.


### Tagging Marketing campaign URL with both the A/B test experiment and the standard Campaign parameters
 
We recommend tagging your campaign URLs with both the standard Campaign Tracking parameters and your A/B test experiment.
 
The standard campaign parameters are:

* `pk_campaign` - The campaign name
* `pk_kwd` - The campaign keyword. This parameter is optional.

For example, when the `original` version for experiment `buyNowColor` was shown, and you are sending an Email marketing 
campaign `SummerDeals`, the URL you link in your emails will be:

```
https://example.org/landingpage?pk_abe=buyNowColor&pk_abv=original&pk_campaign=SummerDeals
```


## Finishing an experiment

When an experiment is finished:

 * remove the two URL parameters `pk_abe` and `pk_abv` from your marketing campaigns. 
 If visitors still visit your website via one of these URLs, Piwik will simply ignore the two URL parameters and not enter visitors into the experiment anymore. 
 * if the experiment proved that one of your campaign variations performed significantly better than another, it is now time to change your campaignsr to the winning variation and benefit from higher conversion rates. 

Happy experimenting!

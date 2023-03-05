---
category: Integrate
subGuides:
  - ab-tests/browser
  - ab-tests/server
  - ab-tests/apps
  - ab-tests/campaign
---
# A/B Testing - Experiments

This section contains guides that will help you run experiments (A/B tests) on your websites and apps using Matomo.

[A/B Testing](https://www.ab-tests.net/) is a plugin for Matomo that can be purchased on 
the [Matomo Marketplace](https://plugins.matomo.org/AbTesting). It is developed by [InnoCraft](https://www.innocraft.com), 
the makers of Matomo. If you want to learn more about this plugin we recommend having a look at the developer guides, 
the [A/B Testing User Guide](https://matomo.org/docs/ab-testing/) and the [A/B Testing FAQs](https://matomo.org/faq/ab-testing/).

An A/B test lets you compare different versions and see which variation makes you more successful. 
A/B tests are also known as experiments or split tests. In an A/B test you show two or more different variations to your 
users (visitors) and the variation that performs better wins. When a user enters the experiment, a variation will be 
randomly chosen and the user will see this variation for all subsequent visits. Experimenting in this 
way lets you take data-driven decisions that maximise your success.

This section contains the following developer guides that will help you to run experiments:

* **Websites (JavaScript)**: Run experiments on your website in the browser. Follow the [website implementation guide](/guides/ab-tests/browser) when you use the Piwik JavaScript Tracker on your website.  
* **Websites (Server-side)**: Run experiments server-side by using any A/B testing framework of your choice by following the [server side implementation guide](/guides/ab-tests/server) as long as you are also using the Piwik JavaScript tracker (works with [PHP](https://github.com/matomo-org/matomo-php-tracker), [Java](https://github.com/matomo-org/piwik-java-tracker), [C#](https://github.com/matomo-org/piwik-dotnet-tracker), [Python](https://github.com/matomo-org/piwik-python-tracker/tree/dev), ...).
* **Mobile, Desktop Apps & Games**: Run experiments using any A/B testing framework of your choice by following the [apps implementation guide](/guides/ab-tests/apps) when you are using a Piwik Tracker SDK (eg [Android SDK](https://github.com/matomo-org/matomo-sdk-android), [iOS SDK](https://github.com/matomo-org/matomo-sdk-ios), [C#](https://github.com/matomo-org/piwik-dotnet-tracker), [PHP](https://github.com/matomo-org/piwik-php-tracker), [Java](https://github.com/matomo-org/piwik-java-tracker), [Python](https://github.com/matomo-org/piwik-python-tracker/tree/dev)) to track your application.
* **Campaigns & Email Marketing**: Track how different campaigns affect the browsing behaviour on your website by following the [campaign implementation guide](/guides/ab-tests/campaign).

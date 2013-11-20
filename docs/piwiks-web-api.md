# Piwik's Web API

<!-- Meta (to be deleted)
Purpose:
- describe how reporting API is exposed,
- describe reporting API formats,
- describe how data is processed before outputted through API,
- describe generic filter query parameters,
- describe how API handles exceptions, bulk API requests

Audience: 

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how Piwik's Reporting API works and how your plugin can extend it**
* you'd like to know **what Piwik's Reporting API does to data before it is served**
* you'd like to know **what output formats can be used to view data that is returned from the Reporting API**
* you'd like to know **about query parameters that are used by the Reporting API to transform analytics data**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](#) guide).

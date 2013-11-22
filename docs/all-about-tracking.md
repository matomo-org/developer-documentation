# All About Tracking

<!-- Meta (to be deleted)
Purpose:
- describe how server-side tracking works (include notes such as scheduled task running, ),
- how clients should work,
- how plugins can hook into tracking process,
- tracker cache,
- tracker API (query parameters),
- how data is inserted into each table (log_action, conversion, etc.),
- referrer detection (and other stuff, ie how conversions are detected),
- how plugins can track their own data
- about bulk tracking requests

Audience: developers interested in the tracking API, devs interested in tracking new data, devs interested in understanding how the tracker works

Expected Result: developers who know how the tracker works, know where the tracking API reference is and devs who know how to track new data

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how to use the HTTP tracking API**
* you'd like to know **how plugins can extend the tracker and track new data**
* you'd like to know **the tracking system extracts information from tracking requests**
* you'd like to know **how the tracker inserts data into log tables**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* are knowledgeable about how HTTP works (eg, request & response headers),
* have a general understanding of extending Piwik (if not, read our [Getting Started](#) guide),

## Tracker Functionality

The Piwik Tracker tracks the data that Piwik analyzes. Tracker clients send HTTP requests to Piwik and based on the values of certain query parameters and HTTP request fields, visits, actions and conversions are tracked. This document explains exactly how this process works.

### Types of Tracking Requests

Different types of tracking requests will do different things. There are three types of tracking requests that the Piwik Tracker will recognize. These are requests to track visitor actions, requests to manually convert a goal and requests to track ecommerce orders. These three actions cannot be done simultaneously.

#### Visit Tracking

This type of tracking request is one that tracks visit related information such as a pageview, outlink or download. When the tracker receives this type of request, it will do the following things:

1. determine if the visitor has 

#### Manual Goal Conversion

#### Ecommerce Tracking
<!--
### Analyzing tracker requests

When the tracker receives a tracking request it will do its best to determine information based on the 

#### Conversion Detection

#### Location Detection
-->
### Inserting new log data

### The Tracker Cache

### Scheduled Tasks

## Extending the Tracker

## The Tracking Web API

### Supported Parameters

### Bulk Tracking

## Tracking Clients

## Learn more

* 

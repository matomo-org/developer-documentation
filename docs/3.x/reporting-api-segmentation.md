---
category: API Reference
title: Segmentation
---
# Segmentation in the API

Learn how to use the powerful segmentation feature available in Piwik. This page explains how to build the 'segment' parameter in your API requests. Segmentation makes it easy to request any Piwik report for a subset of your audience.

This page explains how to build and use the 'segment' API URL parameter, and you will find the list of all the supported visitor segments (country, entry page, keyword, returning visitor, etc.).

## Segment Parameter in the API URL Request

Segmentation can be applied to most API functions. The **segment** parameter contains the definition of the segment you wish to filter your reports to.

For example, you can request the "Best Keywords" report processed for all visits where "Country is Germany AND Browser is Firefox" by doing the following request:

    http://piwik.example.org/index.php
    ?token_auth=yourTokenHere
    &format=xml
    &date=2011-01-11
    &period=week
    &idSite=1
    &module=API&method=Referrers.getKeywords
    &segment=browserCode==FF;countryCode==DE

Example URL of top countries used by visits landing on the page: [virtual-drums.com/](http://www.virtual-drums.com/): [demo.piwik.org/?module=API&method=**UserCountry.getCountry**&idSite=3&date=yesterday&period=day&format=xml&filter_truncate=5&language=en**&segment=entryPageUrl==http%3A%2F%2Fwww.virtual-drums.com%2F**](https://demo.matomo.org/?module=API&method=UserCountry.getCountry&idSite=3&date=yesterday&period=day&format=xml&filter_truncate=5&language=en&segment=entryPageUrl==http%3A%2F%2Fwww.virtual-drums.com%2F)

Let's take a look at the segment string.

## Segment operators

Operator | Behavior           | Example
-- | ------------------------ | -------------
== | Equals                   | `&segment=countryCode==IN` Return results where the country is India
!= | Not equals               | `&segment=actions!=1` Return results where the number of actions (page views, downloads, etc.) is not 1
<= | Less than or equal to    | `&segment=actions<=4` Return results where the number of actions (page views, downloads, etc.) is 4 or less
<  | Less than                | `&segment=visitServerHour<12` Return results where the Server time (hour) is before midday.
>= | Greater than or equal to | `&segment=visitDuration>=600` Return results where visitors spent 10 minutes or more on the website.
>  | Greater than             | `&segment=daysSinceLastVisit>1` Return results where visitors are coming back to the website 2 days or more after their previous visit.
=@ | Contains                 | `&segment=referrerName=@piwik` Return results where the Referer name (website domain or search engine name) contains the word "piwik".
!@ | Does not contain         | `&segment=referrerKeyword!@yourBrand` Return results where the keyword used to access the website does not contain word "yourBrand".
=^ | Starts with         | `&segment=referrerKeyword=^yourBrand` Return results where the keyword used to access the website starts with "yourBrand" (requires at least Piwik 2.15.1).
=$ | Ends with         | `&segment=referrerKeyword=$yourBrand` Return results where the keyword used to access the website ends with "yourBrand" (requires at least Piwik 2.15.1).

## Combine Segments with AND and OR expressions

You can combine several segments together with AND and OR logic.

**OR** operator is the `,` (comma) character, for example:

- `&segment=countryCode==US,countryCode==DE` Country is either (United States OR Germany)

**AND** operator is the `;` (semi-colon) character, for example:

- `&segment=visitorType==returning;countryCode==FR` Returning visitors AND Country is France
- `&segment=referrerType==search;referrerKeyword!=Piwik` Visitors from Search engines AND Keyword is not Piwik

Note that if you combine OR and AND operators, the OR operator will take precedence. For example, the following query
`&segment=referrerType==search;referrerKeyword==Piwik,referrerKeyword==analytics`
will select "Visitors from Search engines AND (Keyword is Piwik OR Keyword is analytics)"

## List of segments

{@include https://demo2.piwik.org/index.php?module=API&action=listSegments&language=en}

### Segment values must be URL encoded

The segment value (located after the segment operator) must be URL encoded before being sent to Piwik. For example to select all visitors that visited your website via a Search keyword containing `My brand`, you need to URL encode the value such as: `&segment=referrerKeyword!@My%20brand`.

### Segment where value is empty / is not empty

You may sometimes want to segment your analytics reports, for all visitors where a given dimension is empty (a value was not set). This is similar to the SQL "is null" clause. To do so, you can leave the value blank after the operator `==` in the segment string. For example, to select all visitors that did not have any referrer keyword set, you can write:
`referrerKeyword==`

You can combine it with other segments, for example to select all visitors that come from India and did not have any keyword set:
`referrerKeyword==;countryCode==in`

Similarly, you can segment your traffic to select visitors where a particular segment is not empty (a value was set). This is similar to the SQL "is not null" clause. To do so, you can leave the value blank after the operator `!=` in the segment string. For example to select all visitors that come from India and have a City set, you can write:
`city!=;countryCode==in`

*Note: Leaving an empty value is supported for the operators == and !==*

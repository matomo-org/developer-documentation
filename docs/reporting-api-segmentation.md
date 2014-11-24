---
category: API Reference
title: Segmentation
---
# Segmentation in the API

Learn how to use the powerful segmentation feature available in Piwik. This page explains how to build the 'segment' parameter in your API requests. Segmentation makes it easy to request any Piwik report for a subset of your audience.

This page explains how to build and use the 'segment' API URL parameter, and you will find the list of all the supported visitor segments (country, entry page, keyword, returning visitor, etc.).

## Segment Parameter in the API URL Request

Segmentation can be applied to most API functions. The **segment** parameter contains the definition of the segment you wish to filter your reports to.

For example, you can request the "Best Keywords" report processed for all visits where "Country is Germany AND Browser is Firefox" (), by doing the following request:

    http://piwik.example.org/index.php
    ?token_auth=yourTokenHere
    &format=xml
    &date=2011-01-11
    &period=week
    &idSite=1
    &module=API&method=Referrers.getKeywords
    &segment=browserCode==FF;country==DE

Example URL of top countries used by visits landing on the page: [virtual-drums.com/](http://www.virtual-drums.com/): [demo.piwik.org/?module=API&method=**UserCountry.getCountry**&idSite=3&date=yesterday&period=day&format=xml&filter_truncate=5&language=en**&segment=entryPageUrl==http%3A%2F%2Fwww.virtual-drums.com%2F**](http://demo.piwik.org/?module=API&method=UserCountry.getCountry&idSite=3&date=yesterday&period=day&format=xml&filter_truncate=5&language=en&segment=entryPageUrl==http%3A%2F%2Fwww.virtual-drums.com%2F)

Let's take a look at the segment string.

## Segment operators

<table class="segments" markdown="1">
<tbody>
<tr>
<td class="segmentString">==</td>
<td>Equals</td>
<td>`&segment=country==IN`
Return results where the country is India</td>
</tr>
<tr>
<td class="segmentString">!=</td>
<td>Does not equal</td>
<td>`&segment=actions!=1`
Return results where the number of actions (page views, downloads, etc.) is not 1</td>
</tr>
<tr>
<td class="segmentString"><=</td>
<td>Less than or equal to</td>
<td>`&segment=actions<=4`
Return results where the number of actions (page views, downloads, etc.) is 4 or less</td>
</tr>
<tr>
<td class="segmentString"><</td>
<td>Less than</td>
<td>`&segment=visitServerHour<12`
Return results where the Server time (hour) is before midday.</td>
</tr>
<tr>
<td class="segmentString">>=</td>
<td>Greater than or equal to</td>
<td>`&segment=visitDuration>=600`
Return results where visitors spent 10 minutes or more on the website.</td>
</tr>
<tr>
<td class="segmentString">></td>
<td>Greater than</td>
<td>`&segment=daysSinceLastVisit>1`
Return results where visitors are coming back to the website 2 days or more after their previous visit.</td>
</tr>
<tr>
<td class="segmentString">=@</td>
<td>Contains</td>
<td>`&segment=referrerName=@piwik`
Return results where the Referer name (website domain or search engine name) contains the word "piwik".</td>
</tr>
<tr>
<td class="segmentString">!@</td>
<td>Does not contain</td>
<td>`&segment=referrerKeyword!@yourBrand`
Return results where the keyword used to access the website does not contain word "yourBrand".</td>
</tr>
</tbody>
</table>

## Combine Segments with AND and OR expressions

You can combine several segments together with AND and OR logic.

**OR** operator is the <span class="code" style="display: inline;">,</span> (comma) character.

Examples

<table class="exampleBoolean" markdown="1">
<tbody>
<tr>
<td>`&segment=country==US,country==DE`
Country is either (United States OR Germany)</td>
</tr>
</tbody>
</table>
**AND** operator is the <span class="code" style="display: inline;">;</span> (semi-colon) character.

Examples

<table class="exampleBoolean" markdown="1">
<tbody>
<tr>
<td>`&segment=visitorType==returning;country==FR`
Returning visitors AND Country is France</td>
</tr>
<tr>
<td>`&segment=referrerType==search;referrerKeyword!=Piwik`
Visitors from Search engines AND Keyword is not Piwik</td>
</tr>
</tbody>
</table>

Note that if you combine OR and AND operators, the OR operator will take precedence. For example, the following query
`&segment=referrerType==search;referrerKeyword==Piwik,referrerKeyword==analytics`
will select "Visitors from Search engines AND (Keyword is Piwik OR Keyword is analytics)"

## List of segments

{@include http://demo.piwik.org/index.php?module=API&action=listSegments&language=en}

### Segment where value is empty / is not empty

You may sometimes want to segment your analytics reports, for all visitors where a given dimension is empty (a value was not set). This is similar to the SQL "is null" clause. To do so, you can leave the value blank after the operator `==` in the segment string. For example, to select all visitors that did not have any referrer keyword set, you can write:
`referrerKeyword==`

You can combine it with other segments, for example to select all visitors that come from India and did not have any keyword set:
`referrerKeyword==;countryCode==in`

Similarly, you can segment your traffic to select visitors where a particular segment is not empty (a value was set). This is similar to the SQL "is not null" clause. To do so, you can leave the value blank after the operator `!=` in the segment string. For example to select all visitors that come from India and have a City set, you can write:
`city!=;countryCode==in`

_Note: Leaving an empty value is supported for the operators == and !=_
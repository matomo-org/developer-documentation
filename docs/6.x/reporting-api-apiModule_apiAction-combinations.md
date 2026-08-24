---
category: API Reference
---
# Compatible apiModule and apiAction combinations

With the [Matomo Reporting API](https://developer.matomo.org/api-reference/reporting-api), you can query specific reports using a valid combination of an `apiModule` and `apiAction` parameter to identify the exact dataset to retrieve. The `apiModule` specifies the plugin or area of functionality (such as Actions, Goals,
or Referrers), while apiAction refers to the specific method exposed by that module (such as `getPageUrls`, `getConversions`, or `getCountry`). Together, these define the API method you want to call.

Four Matomo API methods support the combined use of `apiModule` and `apiAction` parameters:

* `API.getMetadata` returns metadata about a report, including available dimensions, metrics, and display options.
* `API.getProcessedReport` returns the full report data, including calculated metrics and formatted values.
* `API.getRowEvolution` returns the time-series evolution for a specific row in a report (e.g. nb_visits for a specific page).
* `ImageGraph.get` generates a static PNG chart based on the selected report data.

**What makes the apiModule and apiAction combination valid?**

To be compatible with one or more of the four API methods, the apiModule.apiAction combination must:

* Be a valid report method (i.e. return data).
* Represent a report that appears in the Matomo UI.
* Accept the standard parameters: idSite, period, and date.

**Important**: Not every `apiModule.apiAction` combination is compatible with all four API methods. For example, `API.getRowEvolution` and `ImageGraph.get` only support reports with time-based, row-level data (i.e. tabular reports with dimensions). Some modules expose methods for internal logic, configuration, or management tasks (e.g. UsersManager.getUsers, AbTesting.getAllExperiments, Goals.addGoal, or SitesManager.addSite). These do not return data suitable for metadata or processed reports.

The next sections will cover valid combinations for each of the four API methods listed above.

## API.getMetadata

This returns structural information about a specific report. It includes the report's name, category, available dimensions, returned metrics (e.g. `nb_visits`, `bounce_rate`), descriptions of each metric, and the image graph URL (`imageGraphUrl`) if supported. For example, you can retrieve metadata for the Page URLs report via:
`?module=API&method=API.getMetadata&idSite=1&apiModule=Actions&apiAction=getPageUrls`

### Valid `apiModule.apiAction` combinations for API.getMetadata

#### Actions

- `Actions.get`: Returns metadata for the Actions report over the selected period (overview of actions taken on the website).
- `Actions.getPageUrls`: Returns metadata on the Page URLs report.
- `Actions.getPageUrlsFollowingSiteSearch`: Returns metadata on the Site Search report for page URLs viewed after a site search.
- `Actions.getPageTitlesFollowingSiteSearch`: Returns metadata on the Site Search report for page titles viewed after a site search.
- `Actions.getEntryPageUrls`: Returns metadata on the Entry pages report (first page viewed in a visit) by URL.
- `Actions.getExitPageUrls`: Returns metadata on the Exit pages report (last page viewed in a visit) by URL.
- `Actions.getPageTitles`: Returns metadata on all page titles viewed by users.
- `Actions.getEntryPageTitles`: Returns metadata for entry pages by title.
- `Actions.getExitPageTitles`: Returns metadata for exit pages by title.
- `Actions.getDownloads`: Returns metadata for files downloaded by users.
- `Actions.getOutlinks`: Returns metadata for external link clicks.
- `Actions.getSiteSearchKeywords`: Returns metadata for internal search keywords.
- `Actions.getSiteSearchNoResultKeywords`: Returns metadata for internal search keywords that returned no results.
- `Actions.getSiteSearchCategories`: Returns metadata for site search categories.

These methods are **not compatible** with `API.getMetadata` as they are single-row, detail-level reports that return metrics for a specific URL or name and do not return rows with labels: `Actions.getPageUrl`, `Actions.getPageTitle`, `Actions.getDownload` and `Actions.getOutlink`.

#### Contents

- `Contents.getContentNames`: Returns metadata for content impression tracking by name (e.g. banner names).
- `Contents.getContentPieces`: Returns metadata for individual content pieces viewed or interacted with.

#### Crash Analytics

This module is part of the [Crash Analytics premium feature](https://plugins.matomo.org/CrashAnalytics). If the plugin is not installed and activated, these methods will not work.

- `CrashAnalytics.get`: Returns metadata about the main crash analytics summary report and includes metric labels such as crash occurrences, visits with crashes, ignored crashes, and metrics documentation.
- `CrashAnalytics.getAllCrashMessages`: Returns metadata about the report showing crash metrics for every crash message in the selected period.
- `CrashAnalytics.getCrashMessages`: Returns metadata about the report showing crash metrics for every crash message and source file origin combination, excluding crashes without a source.
- `CrashAnalytics.getUnidentifiedCrashMessages`: Returns metadata about the report for crashes without a source that could not be grouped or identified.
- `CrashAnalytics.getDisappearedCrashes`: Returns metadata about the report showing crash messages and metrics for crashes that disappeared within the current period. A crash is considered disappeared if it stops occurring for a specified number of days.
- `CrashAnalytics.getReappearedCrashes`: Returns metadata about the report showing crash messages and related metrics for crashes that reoccurred during the selected period. A crash is considered reappeared if it had been absent for a specified number of days before occurring again.
- `CrashAnalytics.getNewCrashes`: Returns metadata about the report showing crash messages and metrics for crashes that occurred for the first time within the selected period.
- `CrashAnalytics.getCrashesByPageUrl`: Returns metadata about the report that groups crashes by the page URL where they occurred.
- `CrashAnalytics.getCrashesByPageTitle`: Returns metadata about the report that groups crashes by the page title where they occurred.
- `CrashAnalytics.getCrashesBySource`: Returns metadata about the report showing crash occurrences by source file (usually a JavaScript file or file path).
- `CrashAnalytics.getCrashesByCategory`: Returns metadata about the crash report grouped by predefined category types (e.g. JavaScript, network).
- `CrashAnalytics.getCrashesByFirstParty`: Returns metadata about report showing crashes originating from your own domain's scripts.
- `CrashAnalytics.getCrashesByThirdParty`: Returns metadata about report showing crashes originating from external or third-party resources.

These methods are **not compatible** with `API.getMetadata` as they return configuration data, internal state, or entity-specific information rather than structured reports with dimensions and metrics, for example, `CrashAnalytics.mergeCrashes`, `CrashAnalytics.getIgnoredCrashes`, `CrashAnalytics.getCrashGroups`, `CrashAnalytics.getCrashSummary`, `CrashAnalytics.getLastCrashesOverview`, `CrashAnalytics.getLastTopCrashes`, `CrashAnalytics.getCrashesForPageUrl`, `CrashAnalytics.getCrashesForSource`, and `CrashAnalytics.getCrashesForCategory`.

#### Custom Variables

- `CustomVariables.getCustomVariables`: Returns metadata for custom variables configured on your site.

#### DevicePlugins

- `DevicePlugins.getPlugin`: Returns metadata on the report showing the browser plugins (such as Java, PDF, etc.) detected among your visitors.

#### Devices Detection

- `DevicesDetection.getType`: Returns metadata about the report that shows device types used by visitors (e.g. desktop, smartphone, tablet).
- `DevicesDetection.getBrand`: Returns metadata about the report showing the brand of the visitor's device (e.g. Apple, Samsung).
- `DevicesDetection.getModel`: Returns metadata about the report listing specific device models used by visitors (e.g. iPhone 13, Galaxy S22).
- `DevicesDetection.getOsFamilies`: Returns metadata about the report showing the operating system family (e.g. Windows, iOS) used by visitors.
- `DevicesDetection.getOsVersions`: Returns metadata about the report listing specific versions of operating systems (e.g. Android 12, iOS 16.3) used by visitors.
- `DevicesDetection.getBrowsers`: Returns metadata about the report showing the browsers (e.g. Chrome, Safari) used by visitors.
- `DevicesDetection.getBrowserVersions`: Returns metadata about the report listing exact versions of browsers used by visitors.
- `DevicesDetection.getBrowserEngines`: Returns metadata about the report that shows the browser rendering engine (e.g. Blink, WebKit).

#### Events

- `Events.getCategory`: Returns metadata about the report displaying event categories triggered by website visitors (e.g., Video, Form, Button).
- `Events.getAction`: Returns metadata about the report showing actions associated with events (e.g., Play, Submit, Click).
- `Events.getName`: Returns metadata about the report listing the name of the event target or object interacted with (e.g., Subscribe Button, Product Image).

All other `Events.apiAction` parameters are not compatible with `API.getMetadata` because they rely on `idSubtable` rather than top-level report metadata.

#### Form Analytics

This module is part of the [Form Analytics premium feature](https://plugins.matomo.org/FormAnalytics). If the plugin is not installed and activated, the method will not work.

- `FormAnalytics.get`: Returns metadata about the Form Analytics Overview report showing metrics such as number of form views, form starters, form submissions, and form conversions.

#### Goals

- `Goals.get`: Returns metadata about the report overview showing how well your visitors convert a specific goal.
- `Goals.getItemsSku`: Returns metadata about the report for Ecommerce conversions grouped by product SKU, including quantity and revenue metrics.
- `Goals.getItemsName`: Returns metadata about the report for Ecommerce conversions grouped by product name, including quantity and revenue metrics.
- `Goals.getItemsCategory`: Returns metadata about the report for Ecommerce conversions grouped by product category, including quantity and revenue metrics.
- `Goals.getDaysToConversion`: Returns metadata about the report on how many days it took for conversions to occur.
- `Goals.getVisitsUntilConversion`: Returns metadata about the report showing the number of visits made before a visitor converts a goal.

#### MarketingCampaignsReporting

- `MarketingCampaignsReporting.getId`: Returns metadata about the report showing tracked campaign IDs.
- `MarketingCampaignsReporting.getName`: Returns metadata about the report showing tracked marketing campaign names (e.g. using mtm_campaign).
- `MarketingCampaignsReporting.getKeyword`: Returns metadata about the report showing tracked campaign keywords (e.g. using mtm_kwd).
- `MarketingCampaignsReporting.getSource`: Returns metadata about the report showing tracked campaign sources (e.g. using mtm_source).
- `MarketingCampaignsReporting.getMedium`: Returns metadata about the report showing tracked campaign medium (e.g. using mtm_medium).
- `MarketingCampaignsReporting.getContent`: Returns metadata about the report showing tracked campaign content (e.g. using mtm_content).
- `MarketingCampaignsReporting.getGroup`: Returns metadata about the report showing tracked campaign groups (e.g. using mtm_group).
- `MarketingCampaignsReporting.getPlacement`: Returns metadata about the report showing tracked campaign placements (e.g. using mtm_placement).
- `MarketingCampaignsReporting.getSourceMedium`: Returns metadata about the report combining source and medium dimensions to help distinguish traffic origins.

#### MediaAnalytics

This module is part of the [Media Analytics premium feature](https://plugins.matomo.org/MediaAnalytics). If the plugin is not installed and activated, these methods will not work.

- `MediaAnalytics.get`: Returns metadata about the report showing overall metrics for media playback across all tracked resources.
- `MediaAnalytics.getVideoResources`: Returns metadata about the report showing individual video file performance (e.g. number of plays, time watched).
- `MediaAnalytics.getAudioResources`: Returns metadata about the report showing individual audio file performance.
- `MediaAnalytics.getVideoTitles`: Returns metadata about the report showing performance grouped by video title rather than individual file.
- `MediaAnalytics.getAudioTitles`: Returns metadata about the report showing performance grouped by audio title.
- `MediaAnalytics.getGroupedVideoResources`: Returns metadata about the report showing information about the grouped resource URLs of videos that your visitors watched.
- `MediaAnalytics.getGroupedAudioResources`: Returns metadata about the report showing information about the grouped resource URLs of audio files that your visitors listened to.
- `MediaAnalytics.getVideoHours`: Returns metadata about the report showing the times of day when visitors watched your videos.
- `MediaAnalytics.getAudioHours`: Returns metadata about the report showing the times of day when visitors listened to your audio files.
- `MediaAnalytics.getVideoResolutions`: Returns metadata about the report showing the resolution (e.g. 720p, 1080p) of played video files.
- `MediaAnalytics.getPlayers`: Returns metadata about the report showing the media players used (e.g. HTML5, YouTube embed).

#### MultiSites

- `MultiSites.getAll`: Returns metadata on the report providing an informational overview for All Websites, containing the most general metrics about your visitors.
- `MultiSites.getOne`: Returns metadata on the report providing an informational overview for a specific website, containing the most general metrics about your visitors.

#### PagePerformance

- `PagePerformance.get`: Returns metadata for page load performance metrics such as load time, server response time, and page render time.

#### Referrers

- `Referrers.get`: Returns metadata about the report showing all referral sources, including search engines, campaigns, and websites.
- `Referrers.getReferrerType`: Returns metadata about the report that categorises referral traffic by type (search, direct, website, campaign).
- `Referrers.getAll`: Returns metadata about the report showing all available referral data for a given date range.
- `Referrers.getKeywords`: Returns metadata about the report showing keywords used by visitors in search engines.
- `Referrers.getSearchEngines`: Returns metadata for traffic sources from search engines.
- `Referrers.getSocials`: Returns metadata for social network referrals.
- `Referrers.getWebsites`: Returns metadata about referral websites that linked to your site.

#### Resolution

- `Resolution.getResolution`: Returns metadata about the report showing the screen resolutions used by visitors.
- `Resolution.getConfiguration`: Returns metadata about the report showing combinations of screen resolution, browser, and operating system used by your visitors.

#### SearchEngineKeywordsPerformance

This module is part of the [Search Engine Keywords Performance premium feature](https://plugins.matomo.org/SearchEngineKeywordsPerformance). If the plugin is not installed and activated, these methods will not work.

- `SearchEngineKeywordsPerformance.getKeywords`: Returns metadata about the report showing all keyword data from connected search engines.
- `SearchEngineKeywordsPerformance.getKeywordsImported`: Returns metadata about the report showing all imported keyword data.
- `SearchEngineKeywordsPerformance.getKeywordsBing`: Returns metadata about keyword data specifically from Bing.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleWeb`: Returns metadata about web search keyword data from Google.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleImage`: Returns metadata about image search keyword data from Google.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleVideo`: Returns metadata about video search keyword data from Google.
- `SearchEngineKeywordsPerformance.getCrawlingOverview`: Returns metadata on the Crawl overview for Bing and Yahoo! with information such as errors encountered by the search bot, items blocked by your robots.txt file and URLs potentially affected by malware.

#### UserCountry

- `UserCountry.getCountry`: Returns metadata about the report showing the countries your visitors came from.
- `UserCountry.getContinent`: Returns metadata about the report showing the continents your visitors came from.
- `UserCountry.getRegion`: Returns metadata about the report showing the regions your visitors came from.
- `UserCountry.getCity`: Returns metadata about the report showing the cities your visitors came from.

#### UserId

- `UserId.getUsers`: Returns metadata about the report showing visits grouped by User IDs.

#### UserLanguage

- `UserLanguage.getLanguage`: Returns metadata about the report showing the languages configured in visitors’ browsers.
- `UserLanguage.getLanguageCode`: Returns metadata about the report showing language codes (e.g. en-us, fr-fr) detected from visitors’ browsers.

#### UsersFlow

This module is part of the [UsersFlow premium feature](https://plugins.matomo.org/UsersFlow). If the plugin is not installed and activated, the method will not work.

- `UsersFlow.getUsersFlowPretty`: Returns metadata about the report showing the flow of user navigation through your site.

#### VisitFrequency

- `VisitFrequency.get`: Returns metadata about the report comparing visit frequency metrics for new and returning visitors, bounce rate, and actions per visit.

#### VisitTime

- `VisitTime.getVisitInformationPerLocalTime`: Returns metadata about the report showing visits by local time of the visitor.
- `VisitTime.getVisitInformationPerServerTime`: Returns metadata about the report showing visits by your server’s time zone.
- `VisitTime.getByDayOfWeek`: Returns metadata about the report showing visits grouped by day of the week.

#### VisitorInterest

- `VisitorInterest.getNumberOfVisitsPerVisitDuration`: Returns metadata about the report showing how long visitors spent on the site.
- `VisitorInterest.getNumberOfVisitsPerPage`: Returns metadata about the report showing how many pages visitors viewed per session.
- `VisitorInterest.getNumberOfVisitsByDaysSinceLast`: Returns metadata about the report showing how recently returning visitors last visited.
- `VisitorInterest.getNumberOfVisitsByVisitCount`: Returns metadata about the report showing how many times visitors have returned.

#### VisitsSummary

- `VisitsSummary.get`: Returns metadata about the report showing general visit metrics including visits, unique visitors, and bounce rate.

## API.getProcessedReport

This method returns the full dataset for a report, including calculated (processed) metrics, percentages, dimension labels, totals, and subtotals. Most `apiModule.apiAction` combinations that are valid for `API.getMetadata` are also compatible with `API.getProcessedReport`.

### Valid `apiModule.apiAction` combinations for API.getProcessedReport

#### Actions

- `Actions.get`: Returns a summary of all user actions (page views, downloads, outlinks) with aggregated metrics like visits and bounce rate.
- `Actions.getPageUrls`: Shows metrics per page URL visited, helping you analyse the performance of each webpage.
- `Actions.getPageUrlsFollowingSiteSearch`: Lists pages that visitors viewed immediately after using your site's internal search.
- `Actions.getPageTitlesFollowingSiteSearch`: Returns page titles (instead of URLs) that visitors opened after a site search, useful when analysing search-driven navigation.
- `Actions.getEntryPageUrls`: Shows the URLs of the first pages users landed on during their sessions.
- `Actions.getExitPageUrls`: Lists page URLs where visitors ended their sessions.
- `Actions.getPageTitles`: Displays page engagement data grouped by page titles, rather than by URL.
- `Actions.getEntryPageTitles`: Returns page titles of the entry pages where visitors started their sessions.
- `Actions.getExitPageTitles`: Shows page titles where sessions ended, offering insights into potential exit points.
- `Actions.getDownloads`: Lists downloaded files with related metrics, such as number of downloads and unique downloads.
- `Actions.getOutlinks`: Displays external links clicked by visitors, indicating outbound traffic sources.
- `Actions.getSiteSearchKeywords`: Shows keywords users entered in your site's search feature, along with search frequency and results.
- `Actions.getSiteSearchNoResultKeywords`: Lists site search keywords that returned no results, useful for identifying content gaps.
- `Actions.getSiteSearchCategories`: Returns search results grouped by custom-defined categories (if configured in your site search setup).

These methods are **not compatible** with `API.getProcessedReport` as they are single-row, detail-level reports that return metrics for a specific URL or name, and do not return rows with labels: `Actions.getPageUrl`, `Actions.getPageTitle`, `Actions.getDownload`, and `Actions.getOutlink`.

#### Contents

- `Contents.getContentNames`: Returns the names of tracked content blocks (e.g. banners), including impressions, interactions, and interaction rate.
- `Contents.getContentPieces`: Returns data on specific pieces of content (e.g. images or text), including how often each piece was viewed or clicked.

#### Crash Analytics

This module is part of the [Crash Analytics premium feature](https://plugins.matomo.org/CrashAnalytics). If the plugin is not installed and activated, these methods will not work.

- `CrashAnalytics.get`: Shows overall crash activity, including the number of crashes, affected visits, and trends over time.
- `CrashAnalytics.getAllCrashMessages`: Lists all unique crash messages seen during the selected period, including frequency and timing.
- `CrashAnalytics.getCrashMessages`: Lists identifiable crash messages with details on how often and when they occurred.
- `CrashAnalytics.getUnidentifiedCrashMessages`: Lists crash events where the exact error message could not be determined.
- `CrashAnalytics.getDisappearedCrashes`: Shows crash messages that were previously seen but no longer appear during the current period. A crash is considered disappeared if it stops occurring for a specified number of days.
- `CrashAnalytics.getReappearedCrashes`: Shows crash messages and related metrics for crashes that reoccurred during the selected period. A crash is considered reappeared if it had been absent for a specified number of days before occurring again.
- `CrashAnalytics.getNewCrashes`: Shows crash messages and metrics for crashes that occurred for the first time within the selected period.
- `CrashAnalytics.getCrashesByPageUrl`: The report groups crashes by the page URL where they occurred.
- `CrashAnalytics.getCrashesByPageTitle`: The report groups crashes by the page title where they occurred.
- `CrashAnalytics.getCrashesBySource`: The report groups crash occurrences by source file (usually a JavaScript file or file path).
- `CrashAnalytics.getCrashesByCategory`: The report groups crashes by predefined category types (e.g. JavaScript, network).
- `CrashAnalytics.getCrashesByFirstParty`: Shows crashes originating from your own domain's scripts.
- `CrashAnalytics.getCrashesByThirdParty`: Shows crashes originating from external or third-party resources.

These methods are **not compatible** with `API.getProcessedReport` as they return configuration data, internal state, or entity-specific information rather than structured reports with dimensions and metrics, for example, `CrashAnalytics.mergeCrashes`, `CrashAnalytics.getIgnoredCrashes`, `CrashAnalytics.getCrashGroups`, `CrashAnalytics.getCrashSummary`, `CrashAnalytics.getLastCrashesOverview`, `CrashAnalytics.getLastTopCrashes`, `CrashAnalytics.getCrashesForPageUrl`, `CrashAnalytics.getCrashesForSource`, and `CrashAnalytics.getCrashesForCategory`.

#### Custom Variables

- `CustomVariables.getCustomVariables`: Returns all tracked Custom Variable names and their values, including metrics like visits, actions, conversions, and more.

#### DevicePlugins

- `DevicePlugins.getPlugin`: Shows the type of browser plugins (such as Java, PDF, etc.) detected among your visitors.

#### Devices Detection

- `DevicesDetection.getType`: Shows device types used by visitors (e.g. desktop, smartphone).
- `DevicesDetection.getBrand`: Shows the brand of the visitor's device (e.g. Apple, Samsung).
- `DevicesDetection.getModel`: Lists specific device models used by visitors (e.g. iPhone 13, Galaxy S22).
- `DevicesDetection.getOsFamilies`: Lists the operating system family (e.g. Windows, iOS) used by visitors.
- `DevicesDetection.getOsVersions`: Lists specific versions of operating systems (e.g. Android 12, iOS 16.3) used by visitors.
- `DevicesDetection.getBrowsers`: Shows which browsers (e.g. Chrome, Safari) are used by visitors.
- `DevicesDetection.getBrowserVersions`: Lists the exact versions of browsers used by visitors.
- `DevicesDetection.getBrowserEngines`: Shows the browser rendering engine (e.g. Blink, WebKit) used by visitors.

#### Events

- `Events.getCategory`: Returns event data grouped by event category. Useful for understanding the high-level types of interactions that your visitors perform (e.g. video, downloads, buttons).
- `Events.getAction`: Returns event data grouped by action name, which reflects what users are doing (e.g. play, pause, click).
- `Events.getName`: Returns event data grouped by event name (e.g. Newsletter signup, Download Invest-PDF).

All other `Events.apiAction` methods return subtables, not top-level rows, and are not compatible with `API.getProcessedReport`.

#### FormAnalytics

This module is part of the [Form Analytics premium feature](https://plugins.matomo.org/FormAnalytics). If the plugin is not installed and activated, the method will not work.

- `FormAnalytics.get`: Returns key performance metrics for individual forms such as views, starts, submits, abandonments, and conversion rate. This provides an overview of form effectiveness over time.

#### Goals

Ecommerce metrics are only available if Ecommerce tracking is enabled.

- `Goals.get`: Returns conversion metrics for all defined goals on your site for the selected date range.
- `Goals.getItemsSku`: Shows Ecommerce metrics grouped by SKU, including label, revenue, average price and conversion rate.
- `Goals.getItemsName`: Shows Ecommerce metrics by product name, including revenue, orders, and conversion rate.
- `Goals.getItemsCategory`: Shows Ecommerce metrics by product category, including revenue, orders, and conversion rate.
- `Goals.getDaysToConversion`: Shows the total number of goal conversions that occurred within different time ranges and shows how many days passed between a visitor's first interaction and conversion.
- `Goals.getVisitsUntilConversion`: Shows how many visits it takes on average for users to convert, grouped by count of visits.

#### MarketingCampaignsReporting

- `MarketingCampaignsReporting.getId`: Returns metrics on tracked campaigns grouped by campaign ID.
- `MarketingCampaignsReporting.getName`: Returns metrics on tracked campaigns grouped by campaign name (e.g. using mtm_campaign).
- `MarketingCampaignsReporting.getKeyword`: Returns metrics on tracked campaigns grouped by campaign keyword (e.g. using mtm_kwd).
- `MarketingCampaignsReporting.getSource`: Returns metrics on tracked campaigns grouped by campaign source (e.g. using mtm_source).
- `MarketingCampaignsReporting.getMedium`: Returns metrics on tracked campaigns grouped by campaign medium (e.g. using mtm_medium).
- `MarketingCampaignsReporting.getContent`: Returns metrics on tracked campaigns grouped by campaign content (e.g. using mtm_content).
- `MarketingCampaignsReporting.getGroup`: Returns metrics on tracked campaigns grouped by campaign group (e.g. using mtm_group).
- `MarketingCampaignsReporting.getPlacement`: Returns metrics on tracked campaigns grouped by campaign placement (e.g. using mtm_placement).
- `MarketingCampaignsReporting.getSourceMedium`: Returns metrics on tracked campaigns grouped by campaign source-medium.

#### MediaAnalytics

This module is part of the [Media Analytics premium feature](https://plugins.matomo.org/MediaAnalytics). If the plugin is not installed and activated, these methods will not work.

- `MediaAnalytics.get`: Shows an overview of your visitor's media consumption including metrics such as number of video/audio plays, impressions, plays by unique visitors, and time spent on media.
- `MediaAnalytics.getVideoResources`: Lists the resource URLs of videos that your visitors watched.
- `MediaAnalytics.getAudioResources`: Lists the resource URLs of audio files that your visitors listened to.
- `MediaAnalytics.getVideoTitles`: Lists the video titles of videos that your visitors watched.
- `MediaAnalytics.getAudioTitles`: Lists the audio titles of audio that your visitors listened to.
- `MediaAnalytics.getGroupedVideoResources`: Shows metrics about the grouped resource URLs of videos that your visitors watched.
- `MediaAnalytics.getGroupedAudioResources`: Shows metrics about the grouped resource URLs of audio that your visitors listened to.
- `MediaAnalytics.getVideoHours`: Shows at which hours of the day visitors watched your videos. The hours are shown in the timezone of the website.
- `MediaAnalytics.getAudioHours`: Shows at which hours of the day visitors listened to your audio files. The hours are shown in the timezone of the website.
- `MediaAnalytics.getVideoResolutions`: Shows the resolution (width and height) at which your videos were watched.
- `MediaAnalytics.getPlayers`: Lists the media players used by your visitors to play the media on your website.

#### MultiSites

- `MultiSites.getAll`: Returns an informational overview for All Websites, containing the most general metrics about your visitors.
- `MultiSites.getOne`: Returns an informational overview for a specific website, containing the most general metrics about your visitors.

#### PagePerformance

- `PagePerformance.get`: Returns page performance metrics such as load time, server response time, and page render time to evaluate if performance impacts user experience.

#### Referrers

- `Referrers.get`: Returns an overview of all referrer types (e.g., search engines, websites, campaigns, and direct entries), including visit counts and engagement metrics.
- `Referrers.getReferrerType`: Displays grouped traffic sources by type: direct entry, websites, search engines, and campaigns. Offers a high-level categorisation of incoming traffic and supports processed report generation.
- `Referrers.getAll`: Returns a flattened view of all referrer data, including URLs and keyword information. This is a denormalised version suitable for exporting comprehensive referrer data.
- `Referrers.getKeywords`: Lists the keywords used by visitors in search engines to find your website. Aggregated metrics are shown per keyword.
- `Referrers.getSearchEngines`: Displays search engines that sent visitors to your site, grouped by name. Metrics such as visit count and bounce rate are included.
- `Referrers.getWebsites`: Lists referring websites, including the number of visits and associated engagement metrics.
- `Referrers.getSocials`: Returns traffic data originating from social networks.
- `Referrers.getUrlsForSocial`: Displays the exact URLs from social networks that referred traffic. Not compatible with `API.getMetadata`.

#### Resolution

- `Resolution.getResolution`: Returns the number of visits grouped by screen resolution (e.g., 1920x1080, 1366x768).
- `Resolution.getConfiguration`: Returns the number of visits grouped by the combination of operating system, browser, and screen resolution.

#### SearchEngineKeywordsPerformance

This module is part of the [Search Engine Keywords Performance premium feature](https://plugins.matomo.org/SearchEngineKeywordsPerformance). If the plugin is not installed and activated, these methods will not work.

- `SearchEngineKeywordsPerformance.getKeywords`: Shows all keyword data from connected search engines.
- `SearchEngineKeywordsPerformance.getKeywordsImported`: Shows all imported keyword data.
- `SearchEngineKeywordsPerformance.getKeywordsBing`: Returns keyword data specifically from Bing.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleWeb`: Returns web search keyword data from Google.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleImage`: Returns image search keyword data from Google.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleVideo`: Returns video search keyword data from Google.
- `SearchEngineKeywordsPerformance.getCrawlingOverview`: Returns the Crawl overview for Bing and Yahoo! with information such as errors encountered by the search bot, items blocked by your robots.txt file and URLs potentially affected by malware.

#### UserCountry

- `UserCountry.getCountry`: Shows visitor metrics by the country your visitors originated from.
- `UserCountry.getContinent`: Shows visitor metrics by the continent your visitors originated from.
- `UserCountry.getRegion`: Shows visitor metrics by the region your visitors originated from.
- `UserCountry.getCity`: Shows visitor metrics by the city your visitors originated from.

#### UserId

- `UserId.getUsers`: Shows visits and other general metrics for every individual User ID.

##### UserLanguage

- `UserLanguage.getLanguage`: Shows visit metrics by the language set in the visitor's browser.
- `UserLanguage.getLanguageCode`: Shows visit metrics by the language code set in the visitor's browser.

#### UsersFlow

This module is part of the [UsersFlow premium feature](https://plugins.matomo.org/UsersFlow). If the plugin is not installed and activated, the method will not work.

- `UsersFlow.getUsersFlowPretty`: Shows the flow of user navigation through your site even though its visualisation differs from standard tables.

#### VisitFrequency

- `VisitFrequency.get`: Compares visit frequency metrics for new and returning visitors, bounce rate, and actions per visit.

#### VisitTime

- `VisitTime.getVisitInformationPerLocalTime`: Shows what times visitors engaged with your website (in their local time zone).
- `VisitTime.getVisitInformationPerServerTime`: Shows what times visitors engaged with your website (in your server’s local time zone).
- `VisitTime.getByDayOfWeek`: Shows visits grouped by day of the week.

#### VisitorInterest

- `VisitorInterest.getNumberOfVisitsPerVisitDuration`: Reports on how long visitors spent on the site.
- `VisitorInterest.getNumberOfVisitsPerPage`: Reports on how many pages visitors viewed per session.
- `VisitorInterest.getNumberOfVisitsByDaysSinceLast`: Reports on how recently returning visitors last visited.
- `VisitorInterest.getNumberOfVisitsByVisitCount`: Reports on how many times visitors have returned.

#### VisitsSummary

- `VisitsSummary.get`: Returns general visit metrics including visits, unique visitors, and bounce rate.

## API.getRowEvolution

`API.getRowEvolution` requires a valid period (e.g. day, week, month) and a selected row label from a report that returns dimensioned tabular data. Reports that return only aggregate values such as `Actions.get` or `CrashAnalytics.get` are not supported, as they do not contain rows that can be evolved over time.
Only reports that return a primary dimension with identifiable labels (e.g. URL, title, keyword, campaign name, etc.) support `API.getRowEvolution`. `

### Valid `apiModule.apiAction` combinations for API.getRowEvolution

#### Actions

- `Actions.getPageUrls`: The Page URLs report.
- `Actions.getPageUrlsFollowingSiteSearch`: The Site Search report for page URLs viewed after a site search.
- `Actions.getPageTitlesFollowingSiteSearch`: The Site Search report for page titles viewed after a site search.
- `Actions.getEntryPageUrls`: The Entry pages report (first page viewed in a visit) by URL.
- `Actions.getExitPageUrls`: The Exit pages report (last page viewed in a visit) by URL.
- `Actions.getPageTitles`: All page titles viewed by users.
- `Actions.getEntryPageTitles`: The Entry pages report (first page viewed in a visit) by Title.
- `Actions.getExitPageTitles`: The Exit pages report (last page viewed in a visit) by Title.
- `Actions.getDownloads`: Report on files downloaded by users.
- `Actions.getOutlinks`: Report on external link clicks.
- `Actions.getSiteSearchKeywords`: Report on internal search keywords.
- `Actions.getSiteSearchNoResultKeywords`: Report on internal search keywords that returned no results.
- `Actions.getSiteSearchCategories`: Report on site search categories.

These methods are **not compatible** with `API.getRowEvolution`: `Actions.getPageUrl`, `Actions.getPageTitle`, `Actions.getDownload`, and `Actions.getOutlink`.

#### Contents

- `Contents.getContentNames`: Returns content impression tracking by name (e.g. banner names).
- `Contents.getContentPieces`: Returns individual content pieces viewed or interacted with.

#### Crash Analytics

This module is part of the [Crash Analytics premium feature](https://plugins.matomo.org/CrashAnalytics). If the plugin is not installed and activated, these methods will not work.

- `CrashAnalytics.getAllCrashMessages`: Returns crash metrics for every crash message in the selected period.
- `CrashAnalytics.getCrashMessages`: Returns crash metrics for every crash message and source file origin combination, excluding crashes without a source.
- `CrashAnalytics.getUnidentifiedCrashMessages`: Returns crashes without a source that could not be grouped or identified.
- `CrashAnalytics.getDisappearedCrashes`: Returns crash messages and metrics for crashes that disappeared within the current period. A crash is considered disappeared if it stops occurring for a specified number of days.
- `CrashAnalytics.getReappearedCrashes`: Returns crash messages and related metrics for crashes that reoccurred during the selected period. A crash is considered reappeared if it had been absent for a specified number of days before occurring again.
- `CrashAnalytics.getNewCrashes`: Returns crash messages and metrics for crashes that occurred for the first time within the selected period.
- `CrashAnalytics.getCrashesByPageUrl`: Report groups crashes by the page URL where they occurred.
- `CrashAnalytics.getCrashesByPageTitle`: Report groups crashes by the page title where they occurred.
- `CrashAnalytics.getCrashesBySource`: Returns crash occurrences by source file (usually a JavaScript file or file path).
- `CrashAnalytics.getCrashesByCategory`: Returns the crash report grouped by predefined category types (e.g. JavaScript, network).
- `CrashAnalytics.getCrashesByFirstParty`: Returns crashes originating from your own domain's scripts.
- `CrashAnalytics.getCrashesByThirdParty`: Returns crashes originating from external or third-party resources.

These methods are **not compatible** with `API.getRowEvolution` as they return configuration data, internal state, or entity-specific information rather than structured reports with dimensions and metrics, for example, `CrashAnalytics.mergeCrashes`, `CrashAnalytics.getIgnoredCrashes`, `CrashAnalytics.getCrashGroups`, `CrashAnalytics.getCrashSummary`, `CrashAnalytics.getLastCrashesOverview`, `CrashAnalytics.getLastTopCrashes`, `CrashAnalytics.getCrashesForPageUrl`, `CrashAnalytics.getCrashesForSource`, and `CrashAnalytics.getCrashesForCategory`.

#### Custom Variables

- `CustomVariables.getCustomVariables`: Returns custom variables configured on your site.

#### DevicePlugins

- `DevicePlugins.getPlugin`: Shows the type browser plugins (such as Java, PDF, etc.) detected among your visitors.

#### Devices Detection

- `DevicesDetection.getType`: Shows device types used by visitors (e.g. desktop, smartphone).
- `DevicesDetection.getBrand`: Shows the brand of the visitor's device (e.g. Apple, Samsung).
- `DevicesDetection.getModel`: Lists specific device models used by visitors (e.g. iPhone 13, Galaxy S22).
- `DevicesDetection.getOsFamilies`: Lists the operating system family (e.g. Windows, iOS) used by visitors.
- `DevicesDetection.getOsVersions`: Lists specific versions of operating systems (e.g. Android 12, iOS 16.3) used by visitors.
- `DevicesDetection.getBrowsers`: Shows which browsers (e.g. Chrome, Safari) are used by visitors.
- `DevicesDetection.getBrowserVersions`: Lists the exact versions of browsers used by visitors.
- `DevicesDetection.getBrowserEngines`: Shows the browser rendering engine (e.g. Blink, WebKit) used by visitors.

#### Events

- `Events.getCategory`: Returns event data grouped by event category. Useful for understanding the high-level types of interactions that your visitors perform (e.g. video, downloads, buttons).
- `Events.getAction`: Returns event data grouped by action name, which reflects what users are doing (e.g. play, pause, click).
- `Events.getName`: Returns event data grouped by event name (e.g. Newsletter signup, Download Invest-PDF).

#### Goals

Ecommerce metrics are only available if Ecommerce tracking is enabled.

- `Goals.getItemsSku`: Shows Ecommerce metrics grouped by SKU, including label, revenue, average price and conversion rate.
- `Goals.getItemsName`: Shows Ecommerce metrics by product name, including revenue, orders, and conversion rate.
- `Goals.getItemsCategory`: Shows Ecommerce metrics by product category, including revenue, orders, and conversion rate.
- `Goals.getDaysToConversion`: Shows the total number of goal conversions that occurred within different time ranges and shows how many days passed between a visitor's first interaction and conversion.
- `Goals.getVisitsUntilConversion`: Shows how many visits it takes on average for users to convert, grouped by count of visits.

#### MarketingCampaignsReporting

- `MarketingCampaignsReporting.getId`: Returns metrics on tracked campaigns grouped by campaign ID.
- `MarketingCampaignsReporting.getName`: Returns metrics on tracked campaigns grouped by campaign name (e.g. using mtm_campaign).
- `MarketingCampaignsReporting.getKeyword`: Returns metrics on tracked campaigns grouped by campaign keyword (e.g. using mtm_kwd).
- `MarketingCampaignsReporting.getSource`: Returns metrics on tracked campaigns grouped by campaign source (e.g. using mtm_source).
- `MarketingCampaignsReporting.getMedium`: Returns metrics on tracked campaigns grouped by campaign medium (e.g. using mtm_medium).
- `MarketingCampaignsReporting.getContent`: Returns metrics on tracked campaigns grouped by campaign content (e.g. using mtm_content).
- `MarketingCampaignsReporting.getGroup`: Returns metrics on tracked campaigns grouped by campaign group (e.g. using mtm_group).
- `MarketingCampaignsReporting.getPlacement`: Returns metrics on tracked campaigns grouped by campaign placement (e.g. using mtm_placement).
- `MarketingCampaignsReporting.getSourceMedium`: Returns metrics on tracked campaigns grouped by campaign source-medium.

#### MediaAnalytics

This module is part of the [Media Analytics premium feature](https://plugins.matomo.org/MediaAnalytics). If the plugin is not installed and activated, these methods will not work.

- `MediaAnalytics.getVideoResources`: Lists the resource URLs of videos that your visitors watched.
- `MediaAnalytics.getAudioResources`: Lists the resource URLs of audio files that your visitors listened to.
- `MediaAnalytics.getVideoTitles`: Lists the video titles of videos that your visitors watched.
- `MediaAnalytics.getAudioTitles`: Lists the audio titles of audio that your visitors watched.
- `MediaAnalytics.getGroupedVideoResources`: Shows metrics about the grouped resource URLs of videos that your visitors watched.
- `MediaAnalytics.getGroupedAudioResources`: Shows metrics about the grouped resource URLs of audio that your visitors listened to.
- `MediaAnalytics.getVideoHours`: Shows at which hours of the day visitors watched your videos. The hours are shown in the timezone of the website.
- `MediaAnalytics.getAudioHours`: Shows at which hours of the day visitors listened to your audio files. The hours are shown in the timezone of the website.
- `MediaAnalytics.getVideoResolutions`: Shows the resolution (width and height) at which your videos were watched.
- `MediaAnalytics.getPlayers`: Lists the media players used by your visitors to play the media on your website.

#### MultiSites

- `MultiSites.getAll`: Returns an informational overview for All Websites, containing the most general metrics about your visitors.
- `MultiSites.getOne`: Returns an informational overview for a specific website, containing the most general metrics about your visitors.

#### Referrers

- `Referrers.getReferrerType`: Displays grouped traffic sources by type: direct entry, websites, search engines, and campaigns. Offers a high-level categorisation of incoming traffic and supports processed report generation.
- `Referrers.getKeywords`: Lists the keywords used by visitors in search engines to find your website. Aggregated metrics are shown per keyword.
- `Referrers.getSearchEngines`: Displays search engines that sent visitors to your site, grouped by name. Metrics such as visit count and bounce rate are included.
- `Referrers.getWebsites`: Lists referring websites, including the number of visits and associated engagement metrics.
- `Referrers.getSocials`: Returns traffic data originating from social networks.
- `Referrers.getUrlsForSocial`: Displays the exact URLs from social networks that referred traffic.

#### Resolution

- `Resolution.getResolution`: Returns the number of visits grouped by screen resolution (e.g., 1920x1080, 1366x768).
- `Resolution.getConfiguration`: Returns the number of visits grouped by the combination of operating system, browser, and screen resolution.

#### SearchEngineKeywordsPerformance

This module is part of the [Search Engine Keywords Performance premium feature](https://plugins.matomo.org/SearchEngineKeywordsPerformance). If the plugin is not installed and activated, these methods will not work.

- `SearchEngineKeywordsPerformance.getKeywords`: Shows all keyword data from connected search engines.
- `SearchEngineKeywordsPerformance.getKeywordsImported`: Shows all imported keyword data.
- `SearchEngineKeywordsPerformance.getKeywordsBing`: Returns keyword data specifically from Bing.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleWeb`: Returns web search keyword data from Google.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleImage`: Returns image search keyword data from Google.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleVideo`: Returns video search keyword data from Google.

#### UserCountry

- `UserCountry.getCountry`: Shows visitor metrics by the country your visitors originated from.
- `UserCountry.getContinent`: Shows visitor metrics by the continent your visitors originated from.
- `UserCountry.getRegion`: Shows visitor metrics by the region your visitors originated from.
- `UserCountry.getCity`: Shows visitor metrics by the city your visitors originated from.

#### UserId

- `UserId.getUsers`: Shows visits and other general metrics for every individual User ID.

#### UserLanguage

- `UserLanguage.getLanguage`: Shows visit metrics by the language set in the visitor's browser.
- `UserLanguage.getLanguageCode`: Shows visit metrics by the language code set in the visitor's browser.

#### UsersFlow

This module is part of the [UsersFlow premium feature](https://plugins.matomo.org/UsersFlow). If the plugin is not installed and activated, the method will not work.

- `UsersFlow.getUsersFlowPretty`: Shows the flow of user navigation through your site. Although `getUsersFlowPretty` is primarily used for visualisation, it returns dimension rows suitable for time-based row evolution.

#### VisitTime

- `VisitTime.getVisitInformationPerLocalTime`: Shows what times visitors engaged with your website (in their local time zone).
- `VisitTime.getVisitInformationPerServerTime`: Shows what times visitors engaged with your website (in your server’s local time zone).

#### VisitorInterest

- `VisitorInterest.getNumberOfVisitsPerVisitDuration`: Reports on how long visitors spent on the site.
- `VisitorInterest.getNumberOfVisitsPerPage`: Reports on how many pages visitors viewed per session.
- `VisitorInterest.getNumberOfVisitsByDaysSinceLast`: Reports on how recently returning visitors last visited.
- `VisitorInterest.getNumberOfVisitsByVisitCount`: Reports on how many times visitors have returned.

## ImageGraph.get

`ImageGraph.get` generates a static PNG chart based on the selected report and time period. It provides a graphical summary of time-series metrics, including rows and aggregated values where applicable. This method is commonly used to export graphs for reporting, dashboards, or embedding in external systems.

### Valid `apiModule.apiAction` combinations for ImageGraph.get

#### Actions

- `Actions.get`: Displays a graph for the Actions report over the selected period (overview of actions taken on the website).
- `Actions.getPageUrls`: Displays a graph on the Page URLs report.
- `Actions.getPageUrlsFollowingSiteSearch`: Displays a graph on the Site Search report for page URLs viewed after a site search.
- `Actions.getPageTitlesFollowingSiteSearch`: Displays a graph on the Site Search report for page titles viewed after a site search.
- `Actions.getEntryPageUrls`: Displays a graph on the Entry pages report (first page viewed in a visit) by URL.
- `Actions.getExitPageUrls`: Displays a graph on the Exit pages report (last page viewed in a visit) by URL.
- `Actions.getPageTitles`: Displays a graph on all page titles viewed by users.
- `Actions.getEntryPageTitles`: Displays a graph for entry pages by title.
- `Actions.getExitPageTitles`: Displays a graph for exit pages by title.
- `Actions.getDownloads`: Displays a graph for files downloaded by users.
- `Actions.getOutlinks`: Displays a graph for external link clicks.
- `Actions.getSiteSearchKeywords`: Displays a graph for internal search keywords.
- `Actions.getSiteSearchNoResultKeywords`: Displays a graph for internal search keywords that returned no results.
- `Actions.getSiteSearchCategories`: Displays a graph for site search categories.

#### Contents

- `Contents.getContentNames`: Displays a graph for content impression tracking by name (e.g. banner names).
- `Contents.getContentPieces`: Displays a graph for individual content pieces viewed or interacted with.

#### Crash Analytics

This module is part of the [Crash Analytics premium feature](https://plugins.matomo.org/CrashAnalytics). If the plugin is not installed and activated, these methods will not work.

- `CrashAnalytics.get`: Displays a graph about the main crash analytics summary report and includes metric labels such as crash occurrences, visits with crashes, ignored crashes, and metrics documentation.
- `CrashAnalytics.getAllCrashMessages`: Displays a graph about the report showing crash metrics for every crash message in the selected period.
- `CrashAnalytics.getCrashMessages`: Displays a graph about the report showing crash metrics for every crash message and source file origin combination, excluding crashes without a source.
- `CrashAnalytics.getReappearedCrashes`: Displays a graph about the report showing crash messages and related metrics for crashes that reoccurred during the selected period. A crash is considered reappeared if it had been absent for a specified number of days before occurring again.
- `CrashAnalytics.getNewCrashes`: Displays a graph about the report showing crash messages and metrics for crashes that occurred for the first time within the selected period.
- `CrashAnalytics.getCrashesByPageUrl`: Displays a graph about the report that groups crashes by the page URL where they occurred.
- `CrashAnalytics.getCrashesByPageTitle`: Displays a graph about the report that groups crashes by the page title where they occurred.
- `CrashAnalytics.getCrashesBySource`: Displays a graph about the report showing crash occurrences by source file (usually a JavaScript file or file path).
- `CrashAnalytics.getCrashesByCategory`: Displays a graph about the crash report grouped by predefined category types (e.g. JavaScript, network).
- `CrashAnalytics.getCrashesByFirstParty`: Displays a graph about the report showing crashes originating from your own domain's scripts.
- `CrashAnalytics.getCrashesByThirdParty`: Displays a graph about the report showing crashes originating from external or third-party resources.

These methods are **not compatible** with `API.ImageGraph.get` as they return configuration data, internal state, or entity-specific information rather than structured reports with dimensions and metrics, for example, `CrashAnalytics.mergeCrashes`, `CrashAnalytics.getIgnoredCrashes`, `CrashAnalytics.getCrashGroups`, `CrashAnalytics.getCrashSummary`, `CrashAnalytics.getLastCrashesOverview`, `CrashAnalytics.getLastTopCrashes`, `CrashAnalytics.getCrashesForPageUrl`, `CrashAnalytics.getCrashesForSource`, and `CrashAnalytics.getCrashesForCategory`.

#### Custom Variables

- `CustomVariables.getCustomVariables`: Displays a graph for custom variables configured on your site.

#### DevicePlugins

- `DevicePlugins.getPlugin`: Displays a graph on the report showing the browser plugins (such as Java, PDF, etc.) detected among your visitors.

#### Devices Detection

- `DevicesDetection.getType`: Displays a graph about the report that shows device types used by visitors (e.g. desktop, smartphone, tablet).
- `DevicesDetection.getBrand`: Displays a graph about the report showing the brand of the visitor's device (e.g. Apple, Samsung).
- `DevicesDetection.getModel`: Displays a graph about the report listing specific device models used by visitors (e.g. iPhone 13, Galaxy S22).
- `DevicesDetection.getOsFamilies`: Displays a graph about the report showing the operating system family (e.g. Windows, iOS) used by visitors.
- `DevicesDetection.getOsVersions`: Displays a graph about the report listing specific versions of operating systems (e.g. Android 12, iOS 16.3) used by visitors.
- `DevicesDetection.getBrowsers`: Displays a graph about the report showing the browsers (e.g. Chrome, Safari) used by visitors.
- `DevicesDetection.getBrowserVersions`: Displays a graph about the report listing exact versions of browsers used by visitors.
- `DevicesDetection.getBrowserEngines`: Displays a graph about the report that shows the browser rendering engine (e.g. Blink, WebKit).

#### Events

- `Events.getCategory`: Displays a graph about the report displaying event categories triggered by website visitors (e.g., Video, Form, Button).
- `Events.getAction`: Displays a graph about the report showing actions associated with events (e.g., Play, Submit, Click).
- `Events.getName`: Displays a graph about the report listing the name of the event target or object interacted with (e.g., Subscribe Button, Product Image).

All other `Events.apiAction` methods are not compatible with `API.ImageGraph.get` as they rely on `idSubtable` and do not return top-level rows.

#### FormAnalytics

This module is part of the [Form Analytics premium feature](https://plugins.matomo.org/FormAnalytics). If the plugin is not installed and activated, the method will not work.

- `FormAnalytics.get`: Displays a graph about the Form Analytics Overview report showing metrics such as number of form views, form starters, form submissions, and form conversions.

#### Goals

Ecommerce metrics are only available if Ecommerce tracking is enabled.

- `Goals.get`: Displays a graph about the report overview showing how well your visitors convert a specific goal.
- `Goals.getItemsSku`: Displays a graph about the report for Ecommerce conversions grouped by product SKU, including quantity and revenue metrics.
- `Goals.getItemsName`: Displays a graph about the report for Ecommerce conversions grouped by product name, including quantity and revenue metrics.
- `Goals.getItemsCategory`: Displays a graph about the report for Ecommerce conversions grouped by product category, including quantity and revenue metrics.
- `Goals.getDaysToConversion`: Displays a graph about the report on how many days it took for conversions to occur.
- `Goals.getVisitsUntilConversion`: Displays a graph about the report showing the number of visits made before a visitor converts a goal.

#### MarketingCampaignsReporting

- `MarketingCampaignsReporting.getName`: Displays a graph about the report showing tracked marketing campaign names (e.g. using mtm_campaign).
- `MarketingCampaignsReporting.getKeyword`: Displays a graph about the report showing tracked campaign keywords (e.g. using mtm_kwd).
- `MarketingCampaignsReporting.getSource`: Displays a graph about the report showing tracked campaign sources (e.g. using mtm_source).
- `MarketingCampaignsReporting.getMedium`: Displays a graph about the report showing tracked campaign medium (e.g. using mtm_medium).
- `MarketingCampaignsReporting.getContent`: Displays a graph about the report showing tracked campaign content (e.g. using mtm_content).
- `MarketingCampaignsReporting.getGroup`: Displays a graph about the report showing tracked campaign groups (e.g. using mtm_group).
- `MarketingCampaignsReporting.getPlacement`: Displays a graph about the report showing tracked campaign placements (e.g. using mtm_placement).
- `MarketingCampaignsReporting.getSourceMedium`: Displays a graph about the report combining source and medium dimensions to help distinguish traffic origins.

#### MediaAnalytics

This module is part of the [Media Analytics premium feature](https://plugins.matomo.org/MediaAnalytics). If the plugin is not installed and activated, these methods will not work.

- `MediaAnalytics.get`: Displays a graph about the report showing overall metrics for media playback across all tracked resources.
- `MediaAnalytics.getVideoResources`: Displays a graph about the report showing individual video file performance (e.g. number of plays, time watched).
- `MediaAnalytics.getAudioResources`: Displays a graph about the report showing individual audio file performance.
- `MediaAnalytics.getVideoTitles`: Displays a graph about the report showing performance grouped by video title rather than individual file.
- `MediaAnalytics.getAudioTitles`: Displays a graph about the report showing performance grouped by audio title.
- `MediaAnalytics.getGroupedVideoResources`: Displays a graph about the report showing information about the grouped resource URLs of videos that your visitors watched.
- `MediaAnalytics.getGroupedAudioResources`: Displays a graph about the report showing information about the grouped resource URLs of audio files that your visitors listened to.
- `MediaAnalytics.getVideoHours`: Displays a graph about the report showing the times of day when visitors watched your videos.
- `MediaAnalytics.getAudioHours`: Displays a graph about the report showing the times of day when visitors listened to your audio files.
- `MediaAnalytics.getVideoResolutions`: Displays a graph about the report showing the resolution (e.g. 720p, 1080p) of played video files.
- `MediaAnalytics.getPlayers`: Displays a graph about the report showing the media players used (e.g. HTML5, YouTube embed).

#### MultiSites

- `MultiSites.getAll`: Returns a graph showing All Websites most general metrics about your visitors.
- `MultiSites.getOne`: Returns a graph for a specific website, containing the most general metrics about your visitors.

#### PagePerformance

- `PagePerformance.get`: Displays a graph for page load performance metrics such as load time, server response time, and page render time.

#### Referrers

- `Referrers.get`: Displays a graph about the report showing all referral sources, including search engines, campaigns, and websites.
- `Referrers.getReferrerType`: Displays a graph about the report that categorises referral traffic by type (search, direct, website, campaign).
- `Referrers.getAll`: Displays a graph about the report showing all available referral data for a given date range.
- `Referrers.getKeywords`: Displays a graph about the report showing keywords used by visitors in search engines.
- `Referrers.getSearchEngines`: Displays a graph for traffic sources from search engines.
- `Referrers.getWebsites`: Displays a graph about referral websites that linked to your site.
- `Referrers.getSocials`: Displays a graph for social network referrals.
- `Referrers.getUrlsForSocials`: Displays the exact URLs from social networks that referred traffic.

#### Resolution

- `Resolution.getResolution`: Displays a graph about the report showing the screen resolutions used by visitors.
- `Resolution.getConfiguration`: Displays a graph about the report showing combinations of screen resolution, browser, and operating system used by your visitors.

#### SearchEngineKeywordsPerformance

This module is part of the [Search Engine Keywords Performance premium feature](https://plugins.matomo.org/SearchEngineKeywordsPerformance). If the plugin is not installed and activated, these methods will not work.

- `SearchEngineKeywordsPerformance.getKeywords`: Displays a graph about the report showing all keyword data from connected search engines.
- `SearchEngineKeywordsPerformance.getKeywordsImported`: Displays a graph about the report showing all imported keyword data.
- `SearchEngineKeywordsPerformance.getKeywordsBing`: Displays a graph about keyword data specifically from Bing.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleWeb`: Displays a graph about web search keyword data from Google.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleImage`: Displays a graph about image search keyword data from Google.
- `SearchEngineKeywordsPerformance.getKeywordsGoogleVideo`: Displays a graph about video search keyword data from Google.

#### UserCountry

- `UserCountry.getCountry`: Displays a graph about the report showing the countries your visitors came from.
- `UserCountry.getContinent`: Displays a graph about the report showing the continents your visitors came from.
- `UserCountry.getRegion`: Displays a graph about the report showing the regions your visitors came from.
- `UserCountry.getCity`: Displays a graph about the report showing the cities your visitors came from.

#### UserId

- `UserId.getUsers`: Displays a graph about the report showing visits grouped by User IDs.

#### UserLanguage

- `UserLanguage.getLanguage`: Displays a graph about the report showing the languages configured in visitors’ browsers.
- `UserLanguage.getLanguageCode`: Displays a graph about the report showing language codes (e.g. en-us, fr-fr) detected from visitors’ browsers.

#### UsersFlow

This module is part of the [UsersFlow premium feature](https://plugins.matomo.org/UsersFlow). If the plugin is not installed and activated, the method will not work.

- `UsersFlow.getUsersFlowPretty`: Displays a graph about the report showing the flow of user navigation through your site.

#### VisitFrequency

- `VisitFrequency.get`: Displays a graph about the report comparing visit frequency metrics for new and returning visitors, bounce rate, and actions per visit.

#### VisitTime

- `VisitTime.getVisitInformationPerLocalTime`: Displays a graph about the report showing visits by local time of the visitor.
- `VisitTime.getVisitInformationPerServerTime`: Displays a graph about the report showing visits by your server’s time zone.
- `VisitTime.getByDayOfWeek`: Displays a graph about the report showing visits grouped by day of the week.

#### VisitorInterest

- `VisitorInterest.getNumberOfVisitsPerVisitDuration`: Displays a graph about the report showing how long visitors spent on the site.
- `VisitorInterest.getNumberOfVisitsPerPage`: Displays a graph about the report showing how many pages visitors viewed per session.
- `VisitorInterest.getNumberOfVisitsByDaysSinceLast`: Displays a graph about the report showing how recently returning visitors last visited.
- `VisitorInterest.getNumberOfVisitsByVisitCount`: Displays a graph about the report showing how many times visitors have returned.

#### VisitsSummary

- `VisitsSummary.get`: Displays a graph about the report showing general visit metrics including visits, unique visitors, and bounce rate.

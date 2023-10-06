---
category: API Reference
---
# Database schema

Piwik persists two main types of data:

- [**log data**](/guides/log-data): raw analytics data that Piwik receives in the tracker
- [**archive data**](/guides/archive-data): aggregated analytics data (constructed from log data) that is cached and used to build reports

Piwik also persists other simpler forms of data including:

- websites
- users
- goals
- options

Did you know? You can [extend the database](/guides/extending-database) with a plugin.

## Log data

There are five types of log data:

- [**visits**](#log-data-persistence-visits)
- [**action types**](#log-data-persistence-action-types)
- [**plugin specific actions**](#log-data-persistence-plugin-specific-actions)
- [**conversions**](#log-data-persistence-conversions)
- [**ecommerce items**](#log-data-persistence-ecommerce-items)

All log data is persisted in a similar way: new data is constantly added to the set at high volume and updates are non-existent, except for **visits**.

**Visit** data is updated while visits are active. So until a visit ends it is possible that Piwik will try to update it.

Log data is read when calculating analytics data and old data will sometimes be deleted (via the [data purging feature](https://matomo.org/docs/managing-your-databases-size/)).

Backends must ensure that inserting new log data is as fast as possible and aggregating log data is not too slow (though obviously, faster is better).

<a name="log-data-persistence-visits"></a>
### Visits

Visits are stored in the `log_visit` table.

Each visit contains the following information:

- `idsite`: the ID of the website it was tracked for
- `idvisitor`: a visitor ID (an 8 byte binary string)
- `user_id`: the [User ID](https://matomo.org/docs/user-id/) (if set)
- `visitor_localtime`: the visit datetime in the  visitor's time of day
- `visitor_returning`: whether the visit is the first visit for this visitor or not
- `visitor_count_visits`: the number of visits the visitor has made up to this one
- `visitor_seconds_since_last`: the number of seconds since this visitor's last visit (if any)
- `visitor_seconds_since_order`: the number of seconds since this visitor's last order (if any)
- `visitor_seconds_since_first`: the number of seconds since this visitor's first visit
- `visit_first_action_time`: the datetime of the visit's first action
- `visit_last_action_time`: the datetime of the visit's last action
- `visit_exit_idaction_url`: the ID of the URL action type of the visit's last action
- `visit_exit_idaction_name`: the ID of the page title action type of the visit's last action
- `visit_entry_idaction_url`: the ID of the URL action type of the visit's first action
- `visit_entry_idaction_name`: the ID of the page title action type of this visit's first action
- `visit_total_actions`: the count of actions performed during this visit
- `visit_total_searches`: the count of site searches performed during this visit
- `visit_total_events`: the count of custom events performed during this visit
- `visit_total_time`: the total elapsed time of the visit
- `visit_goal_converted`: whether this visit converted a goal or not
- `visit_goal_buyer`: whether the visitor ordered something during this visit or not
- `referer_type`: the type of this visitor's referrer. Can be one of the following values:
  - **Common::REFERRER\_TYPE\_DIRECT\_ENTRY = 1**: If set to this value, other `referer_...` fields have no meaning.
  - **Common::REFERRER\_TYPE\_SEARCH\_ENGINE = 2**: If set to this value, `referer_url` is the url of the search engine and `referer_keyword` is the keyword used (if we can find it).
  - **Common::REFERRER\_TYPE\_WEBSITE = 3**: If set to this value, `referer_url` is the url of the website.
  - **Common::REFERRER\_TYPE\_CAMPAIGN = 6**: If set to this value, `referer_name` is the name of the campaign.
  - **Common::REFERRER\_TYPE\_SOCIAL\_NETWORK = 7**: If set to this value, `referer_name` is the name of the social network.
- `referer_name`: referrer name; its meaning depends on the specific referrer type
- `referer_url`: the referrer URL; its meaning depends on the specific referrer type
- `referer_keyword`: the keyword used if a search engine was the referrer
- `campaign_keyword`: the campaign keyword (requires the [MarketingCampaignsReporting plugin](https://plugins.matomo.org/MarketingCampaignsReporting))
- `campaign_medium`: the campaign medium (requires the [MarketingCampaignsReporting plugin](https://plugins.matomo.org/MarketingCampaignsReporting))
- `campaign_name`: the campaign name (requires the [MarketingCampaignsReporting plugin](https://plugins.matomo.org/MarketingCampaignsReporting))
- `campaign_source`: the campaign source (requires the [MarketingCampaignsReporting plugin](https://plugins.matomo.org/MarketingCampaignsReporting))
- `campaign_content`: the campaign content (requires the [MarketingCampaignsReporting plugin](https://plugins.matomo.org/MarketingCampaignsReporting))
- `campaign_id`: the campaign ID (requires the [MarketingCampaignsReporting plugin](https://plugins.matomo.org/MarketingCampaignsReporting))
- `config_id`: a hash of all the visit's configuration options, including the OS, browser name, browser version, browser language, IP address and  all browser plugin information
- `profilable`: either 0 or 1. If no visitorId or userId was used, then the value is `0`. This means no profile can be created for this specific visitor meaning visitor profile would in most cases only show one visit, features like new/returning visit won't work for this visitor etc.
- `config_os`: a short string identifiying the operating system used to make this visit. See [Device Detector](https://github.com/matomo-org/device-detector) for more info
- `config_browser_name`: a short string identifying the browser used to make this visit. See [Device Detector](https://github.com/matomo-org/device-detector) for more info
- `config_browser_version`: a string identifying the version of the browser used to make this visit
- `config_resolution`: a string identifying the screen resolution the visitor used to make this visit (eg, `'1024x768'`)
- `config_pdf`: whether the visitor's browser can view PDF files or not
- `config_flash`: whether the visitor's browser can view flash files or not
- `config_java`: whether the visitor's browser can run Java or not
- `config_director`: <!-- TODO what is this? -->
- `config_quicktime`: whether the visitor's browser uses quicktime to play media files or not
- `config_realplayer`: whether the visitor's browser can play realplayer media files or not
- `config_windowsmedia`: whether the visitor's browser uses windows media player to play media files
- `config_gears`: <!-- TODO what is this? -->
- `config_silverlight`: whether the visitor's browser can run silverlight programs or not
- `config_cookie`: whether the visitor's browser has cookies enabled or not
- `location_ip`: the IP address of the computer that the visit was made from. Can be [anonymized](https://matomo.org/docs/privacy/#step-1-automatically-anonymize-visitor-ips)
- `location_browser_lang`: a string describing the language used in the visitor's browser
- `location_country`: a two character string describing the country the visitor was located in while visiting the site. Set by the [UserCountry](https://github.com/matomo-org/matomo/tree/master/plugins/UserCountry) plugin.
- `location_region`: a two character string describing the region of the country the visitor was in. Set by the [UserCountry](https://github.com/matomo-org/matomo/tree/master/plugins/UserCountry) plugin.
- `location_city`: a string naming the city the visitor was in while visiting the site. Set by the [UserCountry](https://github.com/matomo-org/matomo/tree/master/plugins/UserCountry) plugin.
- `location_latitude`: the latitude of the visitor while he/she visited the site. Set by the [UserCountry](https://github.com/matomo-org/matomo/tree/master/plugins/UserCountry) plugin.
- `location_longitude`: the longitude of the visitor while he/she visited the site. Set by the [UserCountry](https://github.com/matomo-org/matomo/tree/master/plugins/UserCountry) plugin.
- `custom_var_k1`: the custom variable name of the visit in the first slot for visit custom variables.
- `custom_var_v1`: the custom variable value of the visit in the first slot for visit custom variables.
- `custom_var_k2`: the custom variable name of the visit in the second slot for visit custom variables.
- `custom_var_v2`: the custom variable value of the visit in the second slot for visit custom variables.
- `custom_var_k3`: the custom variable name of the visit in the third slot for visit custom variables.
- `custom_var_v3`: the custom variable value of the visit in the third slot for visit custom variables.
- `custom_var_k4`: the custom variable name of the visit in the fourth slot for visit custom variables.
- `custom_var_v4`: the custom variable value of the visit in the fourth slot for visit custom variables.
- `custom_var_k5`: the custom variable name of the visit in the fifth slot for visit custom variables.
- `custom_var_v5`: the custom variable value of the visit in the fifth slot for visit custom variables.

Some plugins, such as the [Provider](https://github.com/matomo-org/matomo/tree/master/plugins/Provider) plugin, will add new information to visits.

#### Table details

The `index_idsite_config_datetime` index is used when trying to recognize returning visitors.

The `index_idsite_datetime` index is used when aggregating visits. Since log aggregation occurs only for individual day periods, this index helps Piwik find the visits for a website and period quickly. Without it, log aggregation would require a table scan through the entire `log_visit` table.

<a name="log-data-persistence-visit-actions"></a>
### Visit Actions

Visits also contain a list of actions, one for each action the visitor makes during the visit. Those are stored in the `log_link_visit_action` table.

Visit actions contain the following information:

- `server_time`: the datetime the action was tracked in the UTC timezone
- `idaction_url`: the ID of the URL action type for this action
- `idaction_url_ref`: the ID of the URL action type for the previous action in the visit
- `idaction_name`: the ID of the page title action type for this action
- `idaction_name_ref`: the ID of the page title action type for the previous action in the visit
- `pageview_position`: the position of the pageview within the visit, starting at 1. If the action being recorded is not a pageview (but is another action like an event, download, etc.) then the position is set to the last recorded pageview's position (before this action was recorded).
- `time_spent_ref_action`: the amount of time spent doing the previous action in seconds (see below for details)
- `time_spent`: the amount of time spent on this action (set by the CustomDimensions plugin)
- `custom_var_k1`: the custom variable name of the first slot for page custom variables
- `custom_var_v1`: the custom variable value of the first slot for page custom variables
- `custom_var_k2`: the custom variable name of the second slot for page custom variables
- `custom_var_v2`: the custom variable value of the second slot for page custom variables
- `custom_var_k3`: the custom variable name of the third slot for page custom variables
- `custom_var_v3`: the custom variable value of the third slot for page custom variables
- `custom_var_k4`: the custom variable name of the fourth slot for page custom variables
- `custom_var_v4`: the custom variable value of the fourth slot for page custom variables
- `custom_var_k5`: the custom variable name of the  slot for page custom variables
- `custom_var_v5`: the custom variable value of the  slot for page custom variables
- `custom_float`: an unspecified float field, mainly used to store the [Custom Event](https://matomo.org/docs/event-tracking/) value, as well as store the [time it took the server](https://matomo.org/docs/page-speed/) to serve this action

#### Table details

The `idsite` and `idvisitor` columns are copied from the visit action's associated visit in order to avoid having to join the log_visit table in some cases.

The `index_idvisit` index allows Piwik to quickly query the visit actions for a visit.

The `index_idsite_servertime` index is used when aggregating visit actions. It allows quick access to the visit actions that were tracked for a specific website during a specific period and lets us avoid a table scan through the whole table.

The `time_spent_ref_action` column contains the time spent by the visitor on their previous pageview. The previous pageview's Page URL as defined by `idaction_url_ref`  and previous pageview's Page Title as defined by `idaction_name_ref`. For example, to get the Time spent on a particular Page URL: first get the corresponding `idaction_url` value for this Page URL, then query eg. `SELECT count(*) as page_hits, sum(time_spent_ref_action) as total_time_spent_in_seconds FROM log_link_visit_action WHERE idaction_url_ref = IDACTION_URL_ID_HERE`. Note: to ensure you collect accurate time spent on each page, [enable the Heartbeat timer](https://developer.matomo.org/guides/tracking-javascript-guide#accurately-measure-the-time-spent-on-each-page).

<a name="log-data-persistence-action-types"></a>
### Action Types

Action types, such as a specific URL or page title, are analyzed as well as visits. Such analysis can lead to an understanding of, for example, which pages are more relevant to visitors than others.

When Piwik encounters a new action type, a new action type entity is persisted.

Action types are persisted in the `log_action` table and contain the following information:

- `name`: a string describing the action type. Can be a URL, a page title, campaign name or anything else. The meaning is determined by the `type` field.
- `hash`: a hash value calculated using the name.
- `type`: the action type's category. Can be one of the following values:
  - **Piwik\Tracker\Action::TYPE\_PAGE\_URL = 1**: the action is a URL to a page on the website being tracked.
  - **Piwik\Tracker\Action::TYPE\_OUTLINK = 2**: the action is a URL is of a link on the website being tracked. A visitor clicked it.
  - **Piwik\Tracker\Action::TYPE\_DOWNLOAD = 3**: the action is a URL of a file that was downloaded from the website being tracked.
  - **Piwik\Tracker\Action::TYPE\_PAGE\_TITLE = 4**: the action is the page title of a page on the website being tracked.
  - **Piwik\Tracker\Action::TYPE\_ECOMMERCE\_ITEM\_SKU = 5**: the action is the SKU of an ecommerce item that is sold on the site.
  - **Piwik\Tracker\Action::TYPE\_ECOMMERCE\_ITEM\_NAME = 6**: the action is the name of an ecommerce item that is sold on the site.
  - **Piwik\Tracker\Action::TYPE\_ECOMMERCE\_ITEM\_CATEGORY = 7**: the action is the name of an ecommerce item category that is used on the site.
  - **Piwik\Tracker\Action::TYPE_SITE_SEARCH = 8**: the action type is a site search action.
  - **Piwik\Tracker\Action::TYPE_EVENT_CATEGORY = 10**: the action is an event category (see [Tracking Events](https://matomo.org/docs/event-tracking/) user guide)
  - **Piwik\Tracker\Action::TYPE_EVENT_ACTION = 11**: the action is an event category
  - **Piwik\Tracker\Action::TYPE_EVENT_NAME = 12**: the action is an event name
  - **Piwik\Tracker\Action::TYPE_CONTENT_NAME = 13**:  the action is a content name (see [Content Tracking](https://matomo.org/docs/content-tracking/) user guide and [developer guide](https://developer.matomo.org/guides/content-tracking))
  - **Piwik\Tracker\Action::TYPE_CONTENT_PIECE = 14**: the action is a content piece
  - **Piwik\Tracker\Action::TYPE_CONTENT_TARGET = 15**: the action is a content target
  - **Piwik\Tracker\Action::TYPE_CONTENT_INTERACTION = 16**: the action is a content interaction
- `url_prefix`: if the name is a URL this refers to the prefix of the URL. The prefix is removed from actual URLs so the protocol and **www.** parts of a URL are ignored during analysis. Can be the following values:
  - `0`: `'http://'`
  - `1`: `'http://www.'`
  - `2`: `'https://'`
  - `3`: `'https://www.'`

#### Referencing action types

Action types are referenced in other log tables by idaction. For example, the `log_link_visit_action.idaction_url` and `log_link_visit_action.idaction_name` columns
reference the URL and page title for a single action in a visit. Other columns like `log_link_visit_action.idaction_event_category` can reference other
action types.

Some action type references change meaning based on context. For example, the `idaction_name` column can be the page title of the action, if `idaction_url` is
also specified, OR it can be the event name if `idaction_event_category` or `idaction_event_action` are supplied.

The specifics depend on how plugins implement tracking.

#### Table details

The `index_type_hash` index is used during tracking to find existing action types.

<a name="log-data-persistence-plugin-specific-actions"></a>
### Plugin specific actions

Some plugins are not using the `log_action` / `log_link_visit_action` tables to persist their actions. Instead some custom tables are used in order to be able to store the required action details

<a name="log-data-persistence-conversions"></a>
### Conversions

When a visit action is tracked that matches a goal's conversion parameters, a conversion is created and persisted. A conversion is a tally that counts a desired action that one of your visitors took. Piwik will analyze these tallies in conjunction with the actions that caused them in order to help Piwik users understand how to make their visitors take more desired actions.

Conversions are stored in the `log_conversion` table and consist of the following information:

- `idvisit`: the ID of the visit that caused this conversion
- `idsite`: the ID of the site this conversion is for
- `idvisitor`: the ID of the visitor that caused this conversion
- `server_time`: the datetime of the conversion in the UTC timezone
- `idaction_url`: the ID of the URL action type of the visit action that caused this conversion
- `idlink_va`: the ID of the specific visit action that resulted in this conversion
- `referer_visit_server_date`: <!-- TODO: what is this? tied to _refts query parameter -->
- `url`: the URL that caused this conversion to be tracked
- `idgoal`: the ID of the goal this conversion is for
- `idorder`: if this conversion is for an ecommerce order or abandoned cart, this will be the order's ID
- `items`: if this conversion is for an ecommerce order or abandoned cart, this will be the number of items in the order/cart
- `revenue`: if this conversion is for an ecommerce order or abandoned cart, this is the total revenue generated by the order
- `revenue_subtotal`: if this conversion is for an ecommerce order or abandoned cart, this is the total cost of the items in the order/cart
- `revenue_tax`: if this conversion is for an ecommerce order or abandoned cart, this is the total tax applied to the items in the order/cart
- `revenue_shipping`: if this conversion is for an ecommerce order or abandoned cart, this is the total cost of shipping
- `revenue_discount`: if this conversion is for an ecommerce order or abandoned cart, this is the total discount applied to the order

#### Table details

All extra information stored in the table that is not listed above is replicated from the Visit entity this conversion is for. This allows us to avoid joining the `log_visit` table in certain cases.

The `index_idsite_datetime` index is used when aggregating conversions. It allows quick access to the conversions that were tracked for a specific website during a specific period and lets us avoid a table scan through the entire table.

<a name="log-data-persistence-ecommerce-items"></a>
### Ecommerce items (aka conversion items)

An ecommerce item is an item that was sold in an ecommerce order or abandoned in an abandoned cart.

Ecommerce items are stored in the `log_conversion_item` table and consist of the following information:

- `server_time`: <!-- TODO: time of visit action? or time ecommerce item was added? -->
- `idorder`: the ID of the order that this ecommerce item is a part of
- `idaction_sku`: the ID of the action type entity that contains the item's SKU
- `idaction_name`: the ID of the action type entity that contains the ecommerce item's name
- `idaction_category`: the ID of an action type entity that contains a category for this ecommerce item
- `idaction_category2`: the ID of an action type entity that contains a category for this ecommerce item
- `idaction_category3`: the ID of an action type entity that contains a category for this ecommerce item
- `idaction_category4`: the ID of an action type entity that contains a category for this ecommerce item
- `idaction_category5`: the ID of an action type entity that contains a category for this ecommerce item
- `price`: the price of this individual ecommerce item
- `quantity`: the amount of this item that were present in the associated ecommerce order
- `deleted`: whether this item was removed from the order or not

#### Table details

The `idsite`, `idvisitor`, `server_time` and `idvisit` columns are copied from the Conversion entity this Ecommerce Item belongs to. They are copied, so we can aggregate Ecommerce Items without having to join other tables.

The `index_idsite_servertime` index is used when aggregating ecommerce items. It allows quick access to the items that were tracked for a specific website and during a specific period and lets us avoid a table scan through the entire table.

### Selecting & exporting Log data (visits, actions, conversions) using SQL queries

SQL queries that read the Log data across the tables above are provided [in the FAQ: SQL queries to select visitors, list of pageviews, searches, events in the Matomo database](https://matomo.org/faq/how-to/how-do-i-write-sql-queries-to-select-visitors-list-of-pageviews-searches-events-in-the-matomo-database/).

## Archive data

Archive data consists of **metrics** and **reports**. Metrics are numeric values and are stored as such. Reports are stored in [DataTable](/guides/datatable) instances and persisted as compressed binary strings.

Archive data is associated with the website ID, the period, and the segment it is for, along with the data's identifying name. All archive data will be queried many times by this information. Currently, the segment is hashed and attached to the end of the metric name. Archive data is also persisted with the current date and time so it is possible to know how old some data is.

All archive data will contain the following information:

- `idarchive`: An ID that is shared with all pieces of archive data that were archived with the same website ID, period and segment.
- `name`: The name of the report or metric. If a segment is used, a hash of the segment is appended to the name.
- `idsite`: The ID of the website this archive data is for.
- `date1`: The first date in the period this archive data is for.
- `date2`: The last date in the period this archive data is for.
- `period`: The type of period this archive data is for. Can be one of the following values:
  * `1`: for **day** periods.
  * `2`: for **week** periods.
  * `3`: for **month** periods.
  * `4`: for **year** periods.
  * `5`: for **range** periods.
- `ts_archived`: The datetime the archive data was cached.
- `value`: Either a numeric value (for a metric) or a binary string (for a report).

### Table details

Archive data is stored in tables partitioned by months, and missing tables are created automatically. Reports that aggregate visits from January 2012 will be held in a different table from reports that aggregate visits from February 2012.

Piwik creates two types of archive tables, one for each type of archive data. The `archive_numeric` tables store metric data and the `archive_blob` tables store report data. Tables are suffixed with the year and the month: for example the `archive_numeric` table for January 2012 would be named `archive_numeric_2012_01`.

In `archive_numeric` tables:

- the `index_idsite_dates_period` index is used when querying archive data. It lets Piwik quickly query archive data for any site and period, and for data that was archived past a certain date-time.
- the `index_period_archived` index is used when [purging archive data](https://matomo.org/docs/managing-your-databases-size/). It allows Piwik to quickly find archive data for a specific period that is old enough to be purged.

In `archive_blob` tables:

- the `index_period_archived` index is used in the same way as the one in `archive_numeric` tables
- `archive_blob` tables do not have an index that makes it fast to query for rows by site, period and archived date. This is because they should not be queried this way. Instead, the `archive_numeric` table should be queried and the `idarchive` values saved. These values can be used to query data in the `archive_blob` table.

### How many rows should I expect in an archive table?

Seeing millions of rows in an archiving table is not uncommon. Depending on what features a Matomo has enabled and how many unique goals, custom reports, funnels, action URLs and referrers a site tracks each individual archive contains on average approximately 30-100 entries in a blob table and 10-30 entries on average for each archive in the numeric table. Some Matomos might store a lot more or a lot less rows per archive.

For a fully completed month we typically have approximately 30 archives for each day, 4 archives for each week and 1 archive for the month. Meaning you might see around 35 different archives per month per site or segment. Each of these archives then include multiple entries see above (typically 40-80 in a blob table and 10-30 in a numeric table).

If you have say 10 sites and 10 segments, then you would have (10 + 10) * 35 = 700 archives. Again, each of these entries may contain a different number of entries per archive. If you have 10 sites with 10 global segments (applies to each site) then there would be (10 + 10*10) * 35 = 3850 different archives.

Additional archives will be stored when requesting data for a date range but these should be deleted again over time. The current month might store a lot more archive entries overall as the archiving might be launched many times per day resulting in many invalidated archives. These should also be deleted automatically over time.

## Other data

<a name="other-data-site"></a>
### Websites (aka sites)

**Site** entities contain information regarding a website whose visits are tracked. There won't be nearly as many of these as there are visits and archive data entries, but they will be queried often.

Every reporting request (either through the [Reporting API](/guides/piwiks-reporting-api) or through Piwik's UI) will query one or more site entities. The tracker will only query site data if the tracker cache needs to be updated. For most tracking requests, site data will not be queried (thus resulting in greater performance for the tracker).

Site entities are stored in the `site` table and contain the following information:

- `idsite`: the unique ID of the website.
- `name`: the name of the website.
- `main_url`: the main URL visitors should use to access the website.
- `ts_created`: the date & time the site entity was persisted.
- `ecommerce`: `1` if the site is an ecommerce site, `0` if not.
- `sitesearch`: `1` if the site contains an internal search feature, `0` if not.
- `sitesearch_keyword_parameters`: the query parameters the site uses to hold internal site search keywords. This is a comma separated list.
- `sitesearch_category_parameters`: the query parameters the site uses to hold internal site search categories. This is a comma separated list.
- `timezone`: the timezone of the website.
- `currency`: the currency the website uses. Only valid if the site is an ecommerce site.
- `excluded_ips`: a comma separated list of IP addresses or IP address ranges. Visits that come from one of these IP addresses will not be tracked for this website.
- `excluded_parameters`: a comma separated list of query parameter names. These query parameters will be removed from page URLs before visits and actions are tracked.
- `excluded_user_agents`: a comma separated list of strings. Visits with a user agent that contains one of these strings will not be tracked for this website.
- `group`: a string to define the website group. This feature is hidden from the UI but can be used to fetch websites with APIs like `SitesManager.getSitesFromGroup`.
- `type`: a string set to `website` by default. Can be also set to `intranet` ([faq](https://matomo.org/faq/how-to/faq_19/)), `mobileapp`, `rollup` ([docs](https://matomo.org/docs/roll-up-reporting/)), etc.
- `keep_url_fragment`: `1` if the URL fragment (everything after the `#`) should be kept in the URL when tracking actions, `0` if not.
- `creator_login`: the username who added this website

Site entities also contain a list of extra URLs that can be used to access the website. These are not stored within site entities themselves: they are stored in the `site_url` table.

Site entity data access occurs primarily through the [Piwik\Site](/api-reference/Piwik/Site) class. Anything that cannot be queried through that class can be queried through the [SitesManager](https://github.com/matomo-org/matomo/tree/master/plugins/SitesManager) core plugin.

<a name="other-data-goals"></a>
### Goals

Each site has an optional list of goals. A goal is a desired action that a website visitor should take.

Goals are stored in the `goal` table and contain the following information:

- `idsite`: The ID of the website this goal belongs to.
- `idgoal`: The ID for this goal (unique only among goals for this website).
- `name`: The name of this goal.
- `description`: the description of this goal.
- `match_attribute`: string describing what part of the request should be matched against when converting a goal. Can be one of the following values:
  - `manually`: the goal is converted by [manual conversion requests](/guides/tracking-javascript-guide#manually-trigger-goal-conversions).
  - `url`: the goal is converted based on what the action URL contains.
  - `title`: the goal is converted based on what the action page title contains.
  - `file`: the goal is converted based on what the filename of a downloaded file contains.
  - `external_website`: the goal is converted based on what the URL of an outlink contains.
- `pattern`: the pattern to use when checking if a goal is converted.
- `pattern_type`: the type of pattern matching to use when checking if a goal is converted.
  - `contains`: the goal is converted if the match attribute contains the pattern.
  - `exact`: the goal is converted if the match attribute equals the pattern exactly.
  - `regex`: the goal is converted if the match attribute is a regex match with the pattern.
- `case_sensitive`: `1` if the matching should be case-sensitive, `0` if otherwise.
- `allow_multiple`: `1` if multiple conversions are allowed per visit, `0` if otherwise.
- `revenue`: the amount of revenue a conversion generates (if any).
- `deleted`: `1` if this goal was deleted by a Piwik user, `0` if not.
- `event_value_as_revenue`: set to `1` to activate the feature where the Goal conversion revenue is set to the Event value of Event that triggered the goal.

_Note: The ecommerce and abandoned cart goals are two special goals with special IDs. Ecommerce websites automatically have these goals._


### Segments

[Segments](https://matomo.org/docs/segmentation/) are an easy and flexible way to filter visits based on a combination of dimension and metrics. 

The following information is stored in the `segment` table in a segment entity:

- `idsegment`: the segment id.
- `name`: the segment name.
- `definition`: the segment definition, see [Segment API reference](https://developer.matomo.org/api-reference/reporting-api-segmentation).
- `login`: the username who created this segment.
- `enable_all_users`: if set to `1`, the segment is visible by all users.
- `enable_only_idsite`: if set to a website ID, the segment is only visible to this website. If set to `0`, the segment is visible to all websites.
- `auto_archive`: set to `1` to have the segment pre-processed by the [core:archive console crontab](https://matomo.org/docs/setup-auto-archiving/).
- `ts_created`: the date when the segment was created.
- `ts_last_edit`: the date when the segment was last edited.
- `deleted`: set to `1` when a segment is deleted.

<a name="other-data-user"></a>
### Users

User entities describe each Piwik user. They are persisted in the `user` table.

The following information is stored in a user entity:

- `login`: the user's login handle.
- `password'`: a hash of the user's password.
- `alias`: the user's alias if any. This value is displayed instead of the login handle when addressing the user in the UI.
- `email`: the user's email address.
- `twofactor_secret`: the 2FA secret
- `token_auth`: a user's token auth.
- `superuser_access`: whether the user has Super User permission.
- `date_registered`: the date the user data was persisted.
- `ts_password_modified`: the date the user password was last changed.

User data is read on every UI and [Reporting API](/guides/piwiks-reporting-api) request.

There is some user related information that is not stored directly in user entities. They are described below:

<a name="other-data-user-access"></a>
### User permissions

Users can be allowed and disallowed access to websites. Piwik persists each user's access level for each website they have access to in the `access` table.

Piwik defines 4 types of permissions:

- [**view permission**](https://matomo.org/faq/general/faq_70/#faq_70): applies to a specific site
- [**write permission**](https://matomo.org/faq/general/faq_26910/#faq_70): applies to a specific site
- [**admin permission**](https://matomo.org/faq/general/faq_69/#faq_69): applies to a specific site
- [**super user permission**](https://matomo.org/faq/general/faq_35/#faq_35): applies to **whole Piwik** (all sites)

The following information is stored in the `access` table:

- `login`: the user's login handle.
- `access`: the user's permission on this website (`view` or `admin`).
- `idsite`: the website ID for which the user's `login` will have the specified `access`.

Note that the Super User permissions are stored in the `user` table in the column `superuser_access`.

To read more about users access, read the [Permissions](/guides/permissions) guide.

<a name="other-data-user-language-choice"></a>
### User language choice

Piwik will also persist each user's language of choice in the table `user_language` which stores the following information:

- `login`: the username.
- `language`: a language code string representing the preferred user's language. 
- `use_12_hour_clock`: whether the user prefers a 12 hour clock VS 24 hours.

_This association and the persistence logic is implemented by the [LanguagesManager](https://github.com/matomo-org/matomo/tree/master/plugins/LanguagesManager) plugin._

### User dashboards

Matomo's custom dashboards and widgets layout are stored in the `user_dashboard` table:

- `login`: the username to which this dashboard belongs.
- `iddashboard`: the dashboard id.
- `name`: the custom dashboard name.
- `layout`: a JSON string describing the dashboard layout and widgets.


### Options

[Options](/api-reference/Piwik/Option) are key-value pairs where the key is a string and the value is another string (possibly bigger and possibly binary). They are queried on every UI and [Reporting API](/guides/piwiks-reporting-api) request. The tracker will cache relevant option values and so will only query options when the cache needs updating.

Some options should be loaded on every non-tracking request. These options have a special **autoload** property set to `1`.

## Premium Features

[Premium Features](https://matomo.org/faq/general/faq_22573/) are paid add-ons under the [InnoCraft license](https://innocraft.com/license) for Matomo On-Premise ([GPL licensed](https://matomo.org/free-software)). If you are using [Matomo On-Premise](https://matomo.org/matomo-on-premise/) or [Matomo for WordPress](https://wordpress.org/plugins/matomo/) you can get these features from our [Matomo Marketplace](https://plugins.matomo.org/premium). On our [cloud-hosted Matomo](https://matomo.org/matomo-cloud/) service these features are included automatically.

### Heatmap Session Recording

Learn more about [Heatmaps](https://matomo.org/docs/heatmaps/) and [Session Recording](https://matomo.org/docs/session-recording/).

<a name="table-site_hsr"></a>
#### site_hsr

All configured heatmaps and session recordings are stored in this table.

- `idsitehsr`: The unique ID of the heatmap or session recording.
- `idsite`: The ID of the website.
- `name`: The name of the heatmap or session recording.
- `sample_rate`: A decimal between 0 and 100 defining the likelihood that a page view or session should be recorded
- `sample_limit`: Defines how many samples should be recorded. For heatmaps that is the number of page views, for session recordings that's the number of sessions (visits).
- `match_page_rules`: Stores a JSON encoded array that defines on which pages a heatmap or session recording should be recorded.
- `excluded_elements`: Stores a JSON encoded array of CSS selectors that should be excluded.
- `record_type`: Contains `1` if the row represents a heatmap, `2` if the row is a session recording.
- `page_treemirror`: When the row is a heatmap, the actual recorded DOM is stores in this column. The DOM is stored compressed using [gzcompress](https://www.php.net/manual/en/function.gzcompress.php). If no DOM is recorded yet, then Matomo will know we need to capture the DOM next time someone is viewing a matching page. 
- `screenshot_url`: If the row is a heatmap, and a screenshot URL is configured, then the DOM for the heatmap is only recorded when someone visits this specific URL. If no screenshot URL is configured and a DOM is being recorded (see `page_treemirror`), then the URL of that page will be stored in this column. This way we can set the correct HTML "base" URL.
- `breakpoint_mobile`: Any client width in pixel lower than this value will be assumed it is a "mobile" device unless the value is "0".
- `breakpoint_tablet`: Any client width in pixel lower than this value but higher than the mobile breakpoint will be assumed it is a "tablet" device unless the value is "0".
- `min_session_time`: A session will be only recorded when a visitor has spent at least the specified seconds on a page.
- `requires_activity`: If value is `1`, only sessions that have a scroll and a click activity in one page view will be recorded. 
- `capture_keystrokes`: If value is `1`, any text that is entered into text form fields are recorded. While the text is recorded, any character a user enters is replaced with a star ('*').
- `created_date`: Date time when the heatmap or session recording was created.
- `updated_date`: Date time when the heatmap or session recording was last updated.
- `status`: The status of the configured heatmap or session recording which can be "active", "ended" (eg sample limit reached) or "deleted".

<a name="table-log_hsr"></a>
#### log_hsr

For each recorded page view within a recorded session we create one row. 

In this and other `log_hsr_*` tables you will notice that we often save relative / percentage values instead of absolute values. This allows us to replay content more accurately as the exact coordinates always vary depending on device and browser. 

- `idloghsr`: The unique ID for this log entry.
- `idsite`: The ID of the website.
- `idvisit`: The ID of the visit.
- `idhsrview`: A randomly generated ID that identifies this page view. This way we make sure that when a user has for example multiple tabs open that all the actions are stored for the correct "idloghsr" entry.
- `idpageview`: The ID of the pageview entry matching the `log_link_visit_action.idpageview` column. Allows us to assign this interaction to a specific action.
- `idaction_url`: A `log_action` ID referencing on what page URL this page view was recorded.
- `device_type`: `1` for desktop, `2` for tablet, `3` for mobile.
- `server_time`: The date time when this row was created.
- `time_on_page`: How much time was spent on this page in milliseconds.
- `viewport_w_px`: The width of the view port in pixel.
- `viewport_h_px`: The height of the view port in pixel.
- `scroll_y_max_relative`: An integer between 0 and 1000 indicating how far the user scrolled down. If the value is 1000 then it means the user scrolled to the bottom of the page. If the value is 700, then it means the user has seen the top 70% of the page. 
- `fold_y_relative`: An integer between 0 and 1000 similar to `scroll_y_max_relative` but this time indicating how much of the page was visible above the fold when the page was opened. If the value is 200, then 20% of the page was visible above the fold.

<a name="table-log_hsr_site"></a>
#### log_hsr_site

This table stores a reference to which configured session recording a recorded page belongs to. This could have been stored in the `log_hsr` table in a `idsitehsr` column directly but this wasn't done to lower storage usage when multiple session recordings are configured. Sometimes users configure multiple session recordings and while viewing one page we need to record the same recording for multiple different sessions. By having this reference here we only need to write the `log_hsr` and all other entries only once and then link all needed session recordings here.

- `idsitehsr`: Unique ID of the session recording entry in `site_hsr` .
- `idloghsr`: Unique ID identifying a specific recorded page in `log_hsr`.

<a name="table-log_hsr_event"></a>
#### log_hsr_event

Stores each event / action that was performed on a page. For example a mouse move, mouse click, DOM change, form interaction, and more. 

- `idhsrevent`: Unique ID for this event.
- `idloghsr`: The unique `log_hsr` ID this event belongs to.
- `time_since_load`: An integer representing the amount of milliseconds that have passed since loading the page. This way we know when to replay which event.
- `event_type`: The type of event that was executed: `1`: Mouse movement, `2`: Mouse click, `3`: Scroll, `4`: Window resize, `5`: What the initial DOM looked like when the page was loaded, `6`: HTML DOM change, `9`: Form text field change, `10`: Form select field change, `12`: Scroll inside an element, `13`: CSS Content.
- `idselector`: A `log_action` ID referencing the CSS selector that uniquely describes what element an action was performed on (for example for scroll inside an element, or form text field change). 
- `x`: X coordinate for example for a mouse movement where exactly the mouse was moved to within an element. This is usually a percentage and not absolute pixel values. If the window was resized then it stores absolute pixel value.
- `y`: Y coordinate for example for a mouse movement where exactly the mouse was moved to within an element. This is usually a percentage and not absolute pixel values. If the window was resized then it stores absolute pixel value.
- `idhsrblob`: Some events store additional information like how the DOM changed. This ID links to the `log_hsr_blob` entry that contains the relevant content.

<a name="table-log_hsr_blob"></a>
#### log_hsr_blob

In the blob table we are storing content like DOM changes. To reduce the amount of storage this feature requires we are storing each blob only once and referencing it again every time there is a new page recording. This can have a massive impact on storage reduction as often the entire DOM is the same for all page views of the same URL. Also often the same DOM changes repeat and we can reuse existing entries.

- `idhsrblob`: The unique ID for this blob entry.
- `hash`: An integer representing a hash of the actual content. This way we can search faster if a specific blob already exists or not without needing to compare the entire value which could be multiple megabytes.
- `compressed`: `1` if the data was stored compressed using [gzcompress](https://www.php.net/manual/en/function.gzcompress.php), `0` otherwise. Smaller content may not be compressed as it takes less storage in this case to not compress and there is a benefit to seeing the raw text in the database.
- `value`: The actual content that was recorded.

### Multi Channel Conversion Attribution

Learn more about [Multi Channel Conversion Attribution](https://matomo.org/docs/multi-channel-conversion-attribution/).

<a name="table-goal_attribution"></a>
#### goal_attribution

Stores for which goals we should calculate the multi attribution report for. 

- `idsite`: The ID of the website.
- `idgoal`: The ID of the goal a report should be calculated for.

### Activity Log

Learn more about [Activity Log](https://plugins.matomo.org/ActivityLog).

<a name="table-activity_log"></a>
#### activity_log

Every activity logged by this feature will be stored in this table.

- `id`: The unique ID of this activity.
- `user_login`: The user login name that triggered this activity.
- `type`: The type of activity that was performed.
- `parameters`: Stores php serialised additional information about the activity that was performed. For example, what attributes were changed for a website.
- `ts_created`: The date time when this activity happened. 
- `country`: A country code where the user was located when this activity happened. 
- `ip`: The IP address of the client that triggered this activity.

### Form Analytics

Learn more about [Form Analytics](https://matomo.org/docs/form-analytics/).

<a name="table-site_form"></a>
#### site_form

Stores one row for each configured form that should be recorded.

- `idsiteform`: The unique ID of the form.
- `idsite`: The ID of the website this form belongs to.
- `name`: The name of the form.
- `description`: The description of the form.
- `status`: The status of the form. Can be "running", "archived" (still appears in UI but no longer collects data) or "deleted".
- `in_overview`: `1` if a report for this form should appear in the form overview reporting page. `0` if it should not appear there. 
- `match_form_rules`: A JSON encoded array defining which forms should match this specific form. For example, which form names and form IDs. 
- `match_page_rules`: A JSON encoded array defining whether the matched form should be only tracked on certain pages. 
- `conversion_rules`: A JSON encoded array defining how we can detect a form conversion automatically.
- `fields`: A JSON encoded array mapping HTML form field names to human readable form field names.
- `auto_created`: `1` if the form was created by Matomo automatically. `0` if a user created this form.
- `created_date`: Date time when this form was created.
- `updated_date`: Date time when this form was last updated.

<a name="table-log_form"></a>
#### log_form

Every time a user interacts with a new form that was configured to be tracked we create a new entry in this table. Interactions with each form field are stored in the `log_form_field` table. The `log_form_page` table often stores similar values as this table unless the same form was interacted with over multiple pages.

- `idlogform`: A unique ID for this form interaction for a given visit.
- `idsiteform`: The unique form ID that this record belongs to.
- `idsite`: The ID of the website.
- `idvisit`: The ID of the visit.
- `idvisitor`: The ID of the visitor (an 8 byte binary string).
- `first_idformview`: The value of a randomly generated ID Form when the user started interacting with this form. Technically, this value is not needed.
- `last_idformview`: The value of a randomly generated ID Form when the user interacted with it most recently. This can be beneficial if the user interacts with the same form in different tabs as it helps us identify to which action a form tracking request belongs to. 
- `num_views`: How often the form was viewed.
- `num_starts`: How often a user started interacting with this form. `0` if the user never started interacting with it. `1` if the user did interact with this form. The counter is also incremented further every time the user submits the form and then starts interacting with it again.
- `num_submissions`: How often this form was submitted.
- `converted`: `1` if the form was converted, `0` otherwise.
- `form_last_action_time`: Date time when the form was last interacted with. 
- `time_hesitation`: The time in milliseconds a visitor waited before interacting with the form.
- `time_spent`: The time in milliseconds the number spent interacting with this form. This is the difference in ms between the last interaction with the form and the first interaction. If the window was not focused for a while then this time is not counted.
- `time_to_first_submission`: The time in milliseconds it took the user to fill out the form and submit it for the first time. This is excluding the hesitation time and excluding time when the browser window was not active.
  
<a name="table-log_form_field"></a>
#### log_form_field

- `idlogform`:  Identified to which `log_form` entry this row belongs to.
- `idlogformpage`:  Identified to which `log_form_page` entry this row belongs to.
- `idformview`: A randomly generated ID identifying all interactions for this form.
- `idpageview`: The ID of the pageview entry matching the `log_link_visit_action.idpageview` column. Allows us to assign this interaction to a specific action.
- `field_name`: The name of the form field as it was defined in the name attribute in HTML.
- `time_spent`: The time in milliseconds the number spent interacting with this field. 
- `time_hesitation`: The time in milliseconds a visitor waited before interacting with the field.
- `field_size`: The number of characters a text field answer had. For example if someone enters "user" then it would store 4. 
- `left_blank`: `1` if the field was left blank, `0` otherwise.
- `submitted`: The number of how often this field was submitted.
- `num_changes`: The number of times a visitor has changed this field.
- `num_focus`: The number of times this field was focused.
- `num_deletes`: The number of times either a backspace or delete key was used when a field was changed.
- `num_cursor`: The number of times your visitors have used any of the cursor keys on this field.
  
<a name="table-log_form_page"></a>
#### log_form_page

This table stores details about on which page certain actions were done as the same form could be present on multiple pages.

- `idlogformpage`: The unique ID identifying this row.
- `idlogform`: Identified to which `log_form` entry this row belongs to.
- `idaction_url`: A `log_action` ID referencing on which page URL this form was interacted with.
- `num_views`: How often the form was viewed on this page.
- `num_starts`: How often a user started interacting with this form on this page. `0` if the user never started interacting with it. `1` if the user did interact with this form. The counter is also incremented further every time the user submits the form and then starts interacting with it again.
- `num_submissions`: How often this form was submitted on this page.
- `time_hesitation`: The time in milliseconds a visitor waited before interacting with the form.
- `time_spent`: The time in milliseconds the number spent interacting with this form. This is the difference in ms between the last interaction with the form and the first interaction. If the window was not focused for a while then this time is not counted.
- `time_to_first_submission`: The time in milliseconds it took the user to fill out the form and submit it for the first time. This is excluding the hesitation time and excluding time when the browser window was not active.
- `entry_field_name`: Which form field was interacted with first when starting to interact with this form.
- `exit_field_name`: Which form field was last interacted with.
  
### Media Analytics

Learn more about [Media Analytics](https://matomo.org/docs/media-analytics/).

<a name="table-log_media"></a>
#### log_media

The Media Analytics plugin uses the tables `log_media` and `log_media_plays` to store the details about the viewed media elements.

The table `log_media` holds the details of a media element that was shown to the user or the user interacted with:

- `idvisitor`: The ID of the visitor (an 8 byte binary string).
- `idvisit`: The ID of the visit.
- `idsite`: The ID of the website.
- `idview`: A random id to identify a specific media view (6 chars [a-z0-9]).
- `player_name`: The name of the media player.
- `media_type`: The media type (1 = video, 2 = audio).
- `resolution`: The resolution of the media (video only).
- `fullscreen`: A flag to identify if the media was viewed full screen (video only).
- `media_title`: Title of the media.
- `resource`: The resource of the media (typically a filename or url location).
- `server_time`: The date time the media view started.
- `time_to_initial_play`: The time it took until the user started the media.
- `watched_time`: The sum of the time the user watched/listened the media.
- `media_progress`: Progress of the media (defined by the last second that was consumed).
- `media_length`: The total length of the media in seconds.

<a name="table-log_media_plays"></a>
#### log_media_plays

In addition to a media view, the plugin stores which segments of a media has been consumed. This is done in the table `log_media_plays`.
Besides `idview` and `idvisit`, which are used to identify a record with an entry in `log_media`, the table has a lot of columns for each media segment.
The first 5 minutes of a media are tracked in 15 second intervals, the rest in 30 second intervals. That means the first 20 columns in `log_media_plays` represent 15 seconds each, the remaining columns represent 30 seconds each.
That means if the first 3 columns have a `1` then the user watched at least one second of each of those parts between 1-15s, 16-30s and 31-45s.
If only the 18 column had a `1` and all the other ones are `0`, then the user would have only watched the segment between second 256s-270s.
It doesn't mean the user watched the full 15s/30s segment, but at least 1s within this segment was seen.

- `idview`: The randomly generated `log_media.idview` this entry belongs to. 
- `idvisit`: The ID of the visit.
- `segment_15`: `1` if at least 1 second within this segment from 0s-15s was watched or listened to. `0` otherwise.
- `segment_30`: `1` if at least 1 second within this segment from 15s-30s was watched or listened to. `0` otherwise.
- `segment_45`: `1` if at least 1 second within this segment from 30s-45s was watched or listened to. `0` otherwise.
- `segment_...`: 
- `segment_7170`: `1` if at least 1 second within this segment from 7140s-7200s was watched or listened to. `0` otherwise.
- `segment_7200`: `1` if at least 1 second within this segment from 7170s-7200s was watched or listened to. `0` otherwise.


### A/B Testing

Learn more about [A/B Testing](https://matomo.org/docs/ab-testing/).

<a name="table-experiments"></a>
#### experiments

- `idexperiment`: The unique ID of an A/B test.
- `idsite`: The ID of the website.
- `confidence_threshold`: A decimal representing the percentage of the expected confidence. 
- `mde_relative`: An integer storing the percentage of the relative minimum improvement that you expect to detect.
- `name`: The name of the A/B test.
- `description`: The description of the A/B test.
- `hypothesis`: The hypothesis for this A/B test.
- `included_targets`: A JSON encoded array storing information about on which pages the A/B test should run.
- `excluded_targets`: A JSON encoded array storing information about on which pages the A/B test should not run.
- `success_metrics`: A JSON encoded array storing the list of configured success metrics.
- `percentage_participants`: An integer storing the percentage of how many of the website visitors should take part in this A/B test. Also known as "sample rate". 
- `original_redirect_url`: If redirect URLs are configured, it contains the URL for the original variation.
- `status`: The status of an A/B test which can be "created", "running", "finished" or "archived" (won't appear anymore in the UI once archived).
- `start_date`:  Date time when the A/B test was created.
- `modified_date`: Date time when the A/B test was last updated.
- `end_date`: Date time when the A/B test ended / finished.

<a name="table-experiments_strategy"></a>
#### experiments_strategy

Because the strategy we use for the calculations should not change for a metric during an A/B test we store in this table what strategy should be applied for a given metric.

- `idexperiment`: The unique ID of an A/B test this strategy belongs to.
- `metric`: The name of the metric this strategy belongs to within the A/B test.
- `strategy`: What strategy should be applied to calculate the confidence etc. Can be for example "TT" for Ttest, or "CS" for Chi Square or "MN" for Mann Whitney U. 

<a name="table-experiments_variations"></a>
#### experiments_variations

Each A/B test can reference an unlimited amount of variations.

- `idvariation`: The unique ID of this variation.
- `idexperiment`: The unique ID of an A/B test this variation belongs to.
- `name`: The name of the variation.
- `percentage`: An integer storing the percentage of how much traffic should be allocated to this variation.
- `redirect_url`: A redirect URL if one is configured. In that case Matomo will  redirect the user to this URL when the variation is activated.
- `deleted`: `0` if the variation is not deleted or `1` if the variation is deleted.

<a name="table-log_abtesting"></a>
#### log_abtesting

- `idvisitor`: The ID of the visitor (an 8 byte binary string).
- `idvisit`: The ID of the visit.
- `idsite`: The ID of the website.
- `idexperiment`: The ID of the A/B test this visit participated in.
- `idvariation`: The variation that was activated for this visitor.
- `entered`: `1` if the user actually viewed a page that included the experiment. `0` if it's a subsequent visit where the user might not have seen this experiment.
- `server_time`: The date time when the visitor took part in the experiment.

### Funnels

Learn more about [Funnels](https://matomo.org/docs/funnels/).

<a name="table-funnel"></a>
#### funnel

Each funnel configuration is stored in this table. The configured steps for each funnel are stored in the `funnel_steps` table.

- `idfunnel`: The unique ID of a funnel.
- `idsite`: The ID of the website.
- `idgoal`: The unique ID of a goal this funnel belongs to.
- `created_date`: Date time when this funnel was created.
- `activated`: `1` if the funnel is active and reports should be generated. `0` if the funnel is deactivated.
- `deleted`: `1` if the funnel is considered deleted and shouldn't show in the UI anymore, `0` if the funnel is not deleted.
- `deleted_date`: Date time when this funnel was deleted (if `deleted` column is `1`).

<a name="table-funnel_steps"></a>
#### funnel_steps

Each funnel consists of multiple steps which are stored in this table.

- `idfunnel`: The unique ID of the funnel this step belongs to.
- `position`: The position within the funnel this step is. Starts with `1`.
- `name`: The name of this step.
- `pattern_type`: The type of pattern that should be applied to match `pattern`. Can be for example "path_equals" or "url_regexp".
- `pattern`: Defines the value that the pattern type should be compared against to detect if a visitor matches this step or not.
- `required`: `1` if this step is required or `0` if the step is not required.

<a name="table-log_funnel"></a>
#### log_funnel

Every time a visit matches a certain step in a funnel we create a record in this table. This record is created during archiving, and not during tracking. It's created during archiving for performance reasons and because some funnel steps can be matched out of order. 

- `idfunnel`: The unique ID of the funnel this step belongs to.
- `step_position`: The step position that was matched.
- `idsite`: The ID of the website.
- `idvisit`: The ID of the visit.
- `idlink_va`: The ID of the `log_link_visit_action` entry that matched this step.
- `idaction`: The ID of the `log_action` entry that matched this step. This is for example the page URL that was viewed to match this step.
- `idaction_prev`: The ID of the `log_action` entry that the user viewed before matching this step. 
- `idaction_next`: The ID of the `log_action` entry the user navigated to next after matching this step.
- `min_step`: The step position where this visit entered this funnel. If the first step is configured to be "required" then this is usually "1". Otherwise the user might have entered on another step.
- `max_step`: The max step position this visit entered. It tells us basically how far in the funnel the user came.


### Custom Reports

Learn more about [Custom Reports](https://matomo.org/docs/custom-reports/).

<a name="table-custom_reports"></a>
#### custom_reports

This table stores the configuration of each custom report.

- `idcustomreport`: The unique ID of this custom report.
- `idsite`: The ID of the website.
- `revision`: An integer counter that increases every time a user updates the custom report. This helps us to "invalidate" all existing reports when a report is changed.
- `report_type`: Either "table" or "evolution".
- `name`: The name of this custom report.
- `description`: The description for this custom report.
- `category`: Defines on which reporting category page this report should be shown in the UI.
- `subcategory`: Defines on which reporting subcategory page this report should be shown in the UI.
- `dimensions`: A JSON encoded array defining the selected dimensions for this custom report. Evolution reports store an empty array.
- `metrics`: A JSON encoded array defining the selected metrics for this custom report.
- `segment_filter`: Stores a segment string if a segment was configured for this report.
- `created_date`: Date time when this report was created.
- `updated_date`: Date time when this report was last updated.
- `status`: The status of this report which can be either "active" or "deleted".

### Roll-Up Reporting

Learn more about [Roll-Up Reporting](https://matomo.org/docs/roll-up-reporting/).

<a name="table-site_rollup"></a>
#### site_rollup

We store one row for each children site within a roll-up.

- `parent_idsite`: The ID of a roll up site.
- `idsite`: The ID of the children website.

### Crash Analytics

Learn more about [Crash Analytics](https://matomo.org/guide/reports/crash-analytics/).

<a name="table-log_crash"></a>
#### log_crash

Crashes are stored in the `log_crash` table.

Each crash contains the following information:

- `idlogcrash`: The unique ID of this crash.
- `idsite`: The ID of the website.
- `crash_type`: The type of crash to record.
- `message`: The crash message to record.
- `resource_uri`: The URI of the crash.
- `stack_trace`: The stack trace of a crash.
- `resource_line`: The line number on the resource where crash was reported.
- `resource_column`: The column on the resource where crash was reported.
- `datetime_first_seen`: The timestamp when the crash was first seen.
- `datetime_ignored_error`: The timestamp when the crash was added to ignored list.
- `datetime_last_seen`: The timestamp when the crash was last seen.
- `datetime_last_reappeared`: The timestamp when the last crash was seen.
- `crc32_hash`: The hash of a crash message.
- `group_idlogcrash`: The groupID of a crash.

<a name="table-log_crash_event"></a>
#### log_crash_event

Crash events are stored in the `log_crash_event` table.

Each crash event contains the following information:

- `idlogcrashevent`: The unique ID of this crash event.
- `idsite`: The ID of the website.
- `idvisit`: The ID of the visit that caused this crash.
- `idvisitor`: The ID of the visitor that caused this crash.
- `idlogcrash`: The ID of the log present in `log_crash` table.
- `idaction_resource_uri`: The URI of the crash event
- `resource_line`: The line number on the resource where crash event was reported.
- `resource_column`: The column on the resource where crash event was reported. 
- `server_time`: The server timestamp on which this crash event was reported.
- `created_time`: The timestamp of this crash event.
- `idpageview`:  The ID of the pageview entry matching the `log_link_visit_action.idpageview` column. Allows us to assign this interaction to a specific action. 
- `idaction_url`: A `log_action` ID referencing on what page URL this page view was recorded.
- `idaction_name`: The ID of the page title action type for this action
- `prev_last_seen`: The timestamp when this crash event was reported previously.
- `category`: The category of this crash event.

<a name="table-log_crash_group"></a>
#### log_crash_group

Crash groups are stored in the `log_crash_group` table.

Each crash group contains the following information:

- `idlogcrash`: The unique ID of this crash group. 
- `datetime_first_seen`: The timestamp when the crash for this group was first seen.
- `datetime_last_seen`: The timestamp when the crash for this group was last seen.
- `datetime_last_reappeared`: The timestamp when the crash for this group was last seen.

<a name="table-log_crash_stack"></a>
#### log_crash_stack

Crash stack are stored in the `log_crash_stack` table.

Each crash stack contains the following information:

- `idlogcrashstack`: The unique ID of this crash stack.
- `hash`: The hash of this crash stack.
- `compressed`: A flag to indicate if the stack value is compressed and stored.
- `value`: The stack of a crash.

## Learn more

* To learn **how log data is aggregated** see our [Archiving](/guides/archiving) guide and take a look at the [LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator) class.
* To learn **how archive data is cached** see our [Archive Data](/guides/archive-data) guide.
* To learn **about Piwik's logging utility** see this section in our [Getting started extending Piwik](/guides/getting-started-part-1) guide.
* To learn **about database backed sessions** read [this FAQ entry](https://matomo.org/faq/how-to-install/faq_133/).
* To learn **how plugins can persist data** read the [Extending the Database](/guides/extending-database) guide.

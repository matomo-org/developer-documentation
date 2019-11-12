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

There are four types of log data:

- **visits**
- **action types**
- **conversions**
- **ecommerce items**

All log data is persisted in a similar way: new data is constantly added to the set at high volume and updates are non-existent, except for **visits**.

**Visit** data is updated while visits are active. So until a visit ends it is possible that Piwik will try to update it.

Log data is read when calculating analytics data and old data will sometimes be deleted (via the [data purging feature](https://piwik.org/docs/managing-your-databases-size/)).

Backends must ensure that inserting new log data is as fast as possible and aggregating log data is not too slow (though obviously, faster is better).

<a name="log-data-persistence-visits"></a>
### Visits

Visits are stored in the `log_visit` table.

Each visit contains the following information:

- `idsite`: the ID of the website it was tracked for
- `idvisitor`: a visitor ID (an 8 byte binary string)
- `visitor_localtime`: the visit datetime in the  visitor's time of day
- `visitor_returning`: whether the visit is the first visit for this visitor or not
- `visitor_count_visits`: the number of visits the visitor has made up to this one
- `visitor_days_since_last`: the number of days since this visitor's last visit (if any)
- `visitor_days_since_order`: the number of days since this visitor's last order (if any)
- `visitor_days_since_first`: the number of days since this visitor's first visit
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
- `referer_name`: referrer name; its meaning depends on the specific referrer type
- `referer_url`: the referrer URL; its meaning depends on the specific referrer type
- `referer_keyword`: the keyword used if a search engine was the referrer
- `config_id`: a hash of all the visit's configuration options, including the OS, browser name, browser version, browser language, IP address and  all browser plugin information
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
- `location_ip`: the IP address of the computer that the visit was made from. Can be [anonymized](https://piwik.org/docs/privacy/#step-1-automatically-anonymize-visitor-ips)
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
- `time_spent_ref_action`: the amount of time spent doing the previous action in seconds (see below for details)
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
- `custom_float`: an unspecified float field, mainly used to store the [Custom Event](http://piwik.org/docs/event-tracking/) value, as well as store the [time it took the server](https://piwik.org/docs/page-speed/) to serve this action

#### Table details

The `idsite` and `idvisitor` columns are copied from the visit action's associated visit in order to avoid having to join the log_visit table in some cases.

The `index_idvisit` index allows Piwik to quickly query the visit actions for a visit.

The `index_idsite_servertime` index is used when aggregating visit actions. It allows quick access to the visit actions that were tracked for a specific website during a specific period and lets us avoid a table scan through the whole table.

The `time_spent_ref_action` column contains the time spent by the visitor on her previous pageview. The previous pageview's Page URL as defined by `idaction_url_ref`  and previous pageview's Page Title as defined by `idaction_name_ref`. For example, to get the Time spent on a particular Page URL: first get the corresponding `idaction_url` value for this Page URL, then query eg. `SELECT count(*) as page_hits, sum(time_spent_ref_action) as total_time_spent_in_seconds FROM log_link_visit_action WHERE idaction_url_ref = IDACTION_URL_ID_HERE`. Note: to ensure you collect accurate time spent on each page, [enable the Heartbeat timer](https://developer.matomo.org/guides/tracking-javascript-guide#accurately-measure-the-time-spent-on-each-page).

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
  - **Piwik\Tracker\Action::TYPE_EVENT_CATEGORY = 10**: the action is an event category (see [Tracking Events](https://piwik.org/docs/event-tracking/) user guide)
  - **Piwik\Tracker\Action::TYPE_EVENT_ACTION = 11**: the action is an event category
  - **Piwik\Tracker\Action::TYPE_EVENT_NAME = 12**: the action is an event name
  - **Piwik\Tracker\Action::TYPE_CONTENT_NAME = 13**:  the action is a content name (see [Content Tracking](https://piwik.org/docs/content-tracking/) user guide and [developer guide](https://developer.piwik.org/guides/content-tracking))
  - **Piwik\Tracker\Action::TYPE_CONTENT_PIECE = 14**: the action is a content piece
  - **Piwik\Tracker\Action::TYPE_CONTENT_TARGET = 15**: the action is a content target
  - **Piwik\Tracker\Action::TYPE_CONTENT_INTERACTION = 16**: the action is a content interaction
- `url_prefix`: if the name is a URL this refers to the prefix of the URL. The prefix is removed from actual URLs so the protocol and **www.** parts of a URL are ignored during analysis. Can be the following values:
  - `0`: `'http://'`
  - `1`: `'http://www.'`
  - `2`: `'https://'`
  - `3`: `'https://www.'`

#### Table details

The `index_type_hash` index is used during tracking to find existing action types.

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

## Archive data

Archive data consists of **metrics** and **reports**. Metrics are numeric values and are stored as such. Reports are stored in [DataTable](/api-reference/Piwik/DataTable) instances and persisted as compressed binary strings.

Archive data is associated with the website ID, period and segment it is for along with the data's identifying name. All archive data will be queried many times by this information. Currently, the segment is hashed and attached to the end of the metric name. Archive data is also persisted with the current date and time so it is possible to know how old some data is.

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
- the `index_period_archived` index is used when [purging archive data](https://piwik.org/docs/managing-your-databases-size/). It allows Piwik to quickly find archive data for a specific period that is old enough to be purged.

In `archive_blob` tables:

- the `index_period_archived` index is used in the same way as the one in `archive_numeric` tables
- `archive_blob` tables do not have an index that makes it fast to query for rows by site, period and archived date. This is because they should not be queried this way. Instead, the `archive_numeric` table should be queried and the `idarchive` values saved. These values can be used to query data in the `archive_blob` table.

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

The following information is stored in a segment entity:

- `idsegment`: the segment id.
- `name`: the segment name.
- `definition`: the segment definition, see [Segment API reference](https://developer.matomo.org/api-reference/reporting-api-segmentation).
- `login`: the username who created this segment.
- `enable_all_users`: if set to `1`, the segment is visible by all users.
- `enable_only_idsite`: if set to a website ID, the segment is only visible to this website. If set to `0`, the segment is visible to all websites.
- `auto_archive`: set to `1` to have the segment pre-processed by the [core:archive console crontab](https://matomo.org/docs/setup-auto-archiving/) .
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

- [**view permission**](https://piwik.org/faq/general/faq_70/#faq_70): applies to a specific site
- [**write permission**](https://piwik.org/faq/general/faq_26910/#faq_70): applies to a specific site
- [**admin permission**](https://piwik.org/faq/general/faq_69/#faq_69): applies to a specific site
- [**super user permission**](https://piwik.org/faq/general/faq_35/#faq_35): applies to **whole Piwik** (all sites)

The following information is stored in the `access` table:

- `login`: the user's login handle.
- `access`: the user's permission on this website (`view` or `admin`)
- `idsite`: the website ID for which the user's `login` will have the specified `access`.

Note that the Super User permissions are stored in the `user` table in the column `superuser_access`.

To read more about users access, read the [Permissions](/guides/permissions) guide.

<a name="other-data-user-language-choice"></a>
### User language choice

Piwik will also persist each user's language of choice in the table `user_language` which stores the following information:

- `login`: the username
- `language`: a language code string representing the preferred user's language 
- `use_12_hour_clock`: whether the user prefers a 12 hour clock VS 24 hours

_This association and the persistence logic is implemented by the [LanguagesManager](https://github.com/matomo-org/matomo/tree/master/plugins/LanguagesManager) plugin._

### User dashboards

Matomo's custom dashboards and widgets layout are stored in the `user_dashboard` table:

- `login`: the username to which this dashboard belongs
- `iddashboard`: the dashboard id
- `name`: the custom dashboard name
- `layout`: a JSON string describing the dashboard layout and widgets


### Options

[Options](/api-reference/Piwik/Option) are key-value pairs where the key is a string and the value is another string (possibly bigger and possibly binary). They are queried on every UI and [Reporting API](/guides/piwiks-reporting-api) request. The tracker will cache relevant option values and so will only query options when the cache needs updating.

Some options should be loaded on every non-tracking request. These options have a special **autoload** property set to `1`.

## Learn more

* To learn **how log data is aggregated** see our [Archiving](/guides/archiving) guide and take a look at the [LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator) class.
* To learn **how archive data is cached** see our [Archive Data](/guides/archive-data) guide.
* To learn **about Piwik's logging utility** see this section in our [Getting started extending Piwik](/guides/getting-started-part-1) guide.
* To learn **about database backed sessions** read [this FAQ entry](https://piwik.org/faq/how-to-install/faq_133/).
* To learn **how plugins can persist data** read the [Extending the Database](/guides/extending-database) guide.

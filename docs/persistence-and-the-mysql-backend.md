# Persistence & the MySQL Backend

<!-- Meta (to be deleted)
Purpose:
- describe the mysql backend (schema + how tables are used),
- describe what info is stored when reports + log data are persisted,
- describe how plugins should persist their own data,
- describe future plans for NoSQL

Audience: devs who want to persist non-analytics data in their plugin, devs who want to understand how MySQL is used, devs interested in creating NoSQL backends

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how your plugin can persist new non-analytics data**
* you'd like to know **what information is stored when Piwik stores analytics data, log data and miscellaneous data**
* you'd like to know **how Piwik uses MySQL to persist data**

**Guide assumptions**

This guide assumes that you:

* can write PHP and SQL code
* and understand how relational databases work in general and MySQL in particular.

## What gets persisted

Piwik persists two main types of data: log data and archive data. **Log data** is everything that Piwik tracks and **archive data** is analytics data that is cached.

Piwik also persists other simpler forms of data including information about each:

* website being tracked,
* user,
* goal,
* and [option](#).

This guide describes exactly what information this data consists of and exactly how the MySQL backend persists it.

_Note: Piwik uses PHP arrays to hold data that will be persisted. When we describe what information is in each persisted entity, we list properties by the string name used to store the property in the entity array._

## Log Data Persistence

There are four types of log data, **visits**, **action types**, **conversions** and **ecommerce items**. All log data is persisted in a similar way: new data is constantly added to the set at high volume and updates are non-existant (except for **visits**).

**Visit** data is updated while visits are active. So until a visit ends it is possible that Piwik will try and update it.

Log data is read when calculating analytics data and old data will sometimes be deleted (via the [data purging feature](http://piwik.org/docs/managing-your-databases-size/)).

Backends must ensure that inserting new log data is as fast as possible and aggregating log data is not too slow (though obviously, faster is better).

### Visits

Each visit contains the following information:

* `'idsite'`: the ID of the the website it was tracked for
* `'idvisitor'`: a visitor ID (an 8 byte binary string)
* `'visitor_localtime'`: the visit datetime in the  visitor's time of day
* `'visitor_returning'`: whether the visit is the first visit for this visitor or not
* `'visitor_count_visits'`: the number of visits the visitor has made up to this one
* `'visitor_days_since_last'`: the number of days since this visitor's last visit (if any)
* `'visitor_days_since_order'`: the number of days since this visitor's last order (if any)
* `'visitor_days_since_first'`: the number of days since this visitors' first visit
* `'visit_first_action_time'`: the datetime of the visit's first action
* `'visit_last_action_time'`: the datetime of the visit's last action
* `'visit_exit_idaction_url'`: the ID of the URL action type of the visit's last action
* `'visit_exit_idaction_name'`: the ID of the page title action type of the visit's last action
* `'visit_entry_idaction_url'`: the ID of the URL action type of the visit's first action
* `'visit_entry_idaction_name'`: the ID of the page title action type of this visit's first action
* `'visit_total_actions'`: the count of actions performed during this visit
* `'visit_total_searches'`: the count of site searches performed during this visit
* `'visit_total_events'`: the count of custom events performed during this visit
* `'visit_total_time'`: the total elapsed time of the visit
* `'visit_goal_converted'`: whether this visit converted a goal or not
* `'visit_goal_buyer'`: whether the visitor ordered something during this visit or not
* `'referer_type'`: the type of this visitor's referrer. Can be one of the following values:
  * [Common::REFERRER_TYPE_DIRECT_ENTRY](#): If set to this value, other `'referer_...'` fields have no meaning.
  * [Common::REFERRER_TYPE_SEARCH_ENGINE](#): If set to this value, `'referer_url'` is the url of the search engine and `'referer_keyword'` is the keyword used (if we can find it).
  TODO: for search engine, will referer_name be set? (same for website)
  * [Common::REFERRER_TYPE_WEBSITE](#): If set to this value, `'referer_url'` is the url of the website.
  * [Common::REFERRER_TYPE_CAMPAIGN](#): If set to this value, `'referer_name'` is the name of the campaign.
  TODO: double check campaign info
* `'referer_name'`: referrer name; its meaning depends on the specific referrer type
* `'referer_url'`: the referrer URL; its meaning depends on the specific referrer type
* `'referer_keyword'`: the keyword used if a search engine was the referrer
* `'config_id'`: TODO: what is this?
* `'config_os'`: a short string identifiying the operating system used to make this visit. See [UserAgentParser](#) for more info
* `'config_browser_name'`: a short string identifying the browser used to make this visit. See [UserAgentParser](#) for more info (TODO: what about devicesdetection?)
* `'config_browser_version'`: a string identifying the version of the browser used to make this visit
* `'config_resolution'`: a string identifying the screen resolution the visitor used to make this visit (eg, `'1024x768'`)
* `'config_pdf'`: whether the visitor's browser can view PDF files or not
* `'config_flash'`: whether the visitor's browser can view flash files or not
* `'config_java'`: whether the visitor's browser can run Java or not
* `'config_director'`: TODO
* `'config_quicktime'`: whether the visitor's browser uses quicktime to play media files or not
* `'config_realplayer'`: whether the visitor's browser can play realplayer media files or not
* `'config_windowsmedia'`: whether the visitor's browser uses windows media player to play media files
* `'config_gears'`: TODO
* `'config_silverlight'`: whether the visitor's browser can run silverlight programs or not
* `'config_cookie'`: whether the visitor's browser has cookies enabled or not
* `'location_ip'`: the IP address of the computer that the visit was made from. can be [anonymized](#)
* `'location_browser_lang'`: a string describing the language used in the visitor's browser
* `'location_country'`: a two character string describing the country the visitor was located in while visiting the site. set by the [UserCountry](#) plugin.
* `'location_region'`: a two character string describing the region of the country the visitor was in. set by the [UserCountry](#) plugin.
* `'location_city'`: a string naming the city the visitor was in while visiting the site. set by the [UserCountry](#) plugin.
* `'location_latitude'`: the latitude of the visitor while he/she visited the site. set by the [UserCountry](#) plugin.
* `'location_longitude'`: the longitude of the visitor while he/she visited the site. set by the [UserCountry](#) plugin.
* `'custom_var_k1'`: the custom variable name of the visit in the first slot for visit custom variables
* `'custom_var_v1'`: the custom variable value of the visit in the first slot for visit custom variables
* `'custom_var_k2'`: the custom variable name of the visit in the second slot for visit custom variables
* `'custom_var_v2'`: the custom variable value of the visit in the second slot for visit custom variables
* `'custom_var_k3'`: the custom variable name of the visit in the third slot for visit custom variables
* `'custom_var_v3'`: the custom variable value of the visit in the third slot for visit custom variables
* `'custom_var_k4'`: the custom variable name of the visit in the fourth slot for visit custom variables
* `'custom_var_v4'`: the custom variable value of the visit in the fourth slot for visit custom variables
* `'custom_var_k5'`: the custom variable name of the visit in the fifth slot for visit custom variables
* `'custom_var_v5'`: the custom variable value of the visit in the fifth slot for visit custom variables

Some plugins, such as the [Provider](#) plugin, will add new information to visits.

#### Visit Actions

Visits also contain a list of actions, one for each action the visitor makes during the visit. Visit actions contain the following information:

* `'server_time'`: the datetime the action was tracked in the server's timezone
* `'idaction_url'`: the ID of the URL action type for this action
* `'idaction_url_ref'`: the ID of the URL action type for the previous action in the visit
* `'idaction_name'`: the ID of the page title action type for this action
* `'idaction_name_ref'`: the ID of the page title action type for the previous action in the visit
* `'time_spent_ref_action'`: the amount of time spent doing the previous action
* `'custom_float'`: an unspecified float field, usually used to hold the time it took the server to serve this action

TODO: custom events when finished
TODO: replace page title action type w/ action name? need to describe somewhere what an 'action name' is.

### Action Types

Action types, such as a specific URL or page title, are analyzed as well as visits. Such analysis can lead to an understanding of, for example, which pages are more relevant to visitors than others.

When Piwik encounters a new action type, a new action type entity is persisted.

Action types contain the following information:

* `'name'`: a string describing the action type. Can be a URL, a page title, campaign name or anything else. The meaning is determined by the **type** field.
* `'hash'`: the hash value for the name
* `'type'`: the action type's category. Can be one of the following values:
  * [Action::TYPE_PAGE_URL](#): the action type is a URL to a page on the website being tracked.
  * [Action::TYPE_OUTLINK](#): the action type is a URL is of a link on the website being tracked. A visitor clicked it.
  * [Action::TYPE_DOWNLOAD](#): the action type is a URL of a file that was downloaded from the website being tracked.
  * [Action::TYPE_PAGE_TITLE](#): the action type is the page title of a page on the website being tracked.
  * [Action::TYPE_ECOMMERCE_ITEM_SKU](#): the action type is the SKU of an ecommerce item that is sold on the site.
  * [Action::TYPE_ECOMMERCE_ITEM_NAME](#): the action type is the name of an ecommerce item that is sold on the site.
  * [Action::TYPE_ECOMMERCE_ITEM_CATEGORY](#): the action type is the name of an ecommerce item category that is used on the site.
  * [Action::TYPE_SITE_SEARCH](#): the action type is a site search action.
* `'url_prefix'`: if the name is a URL this refers to the prefix of the URL. Used to make sure the protocol and **www.** parts of a URL are ignored. Can be the following values:
  * `0`: `'http://'`
  * `1`: `'http://www.'`
  * `2`: `'https://'`
  * `3`: `'https://www.'`

### Conversions

### Conversion items

## Archive Data Persistence

### Metrics

### Reports

## Other Data Persistence

### Sites

### Users

### Languages

## The Database Logging Backend

## Plugin Persistence

### Reusing existing tables

### Adding new tables

## The MySQL Backend

### Log Data Tables

### Archive Tables

### Other Tables

## Other Backends

## Learn more

* 

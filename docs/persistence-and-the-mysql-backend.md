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
* `'custom_var_k1'`: the custom variable name of the first slot for page custom variables
* `'custom_var_v1'`: the custom variable value of the first slot for page custom variables
* `'custom_var_k2'`: the custom variable name of the second slot for page custom variables
* `'custom_var_v2'`: the custom variable value of the second slot for page custom variables
* `'custom_var_k3'`: the custom variable name of the third slot for page custom variables
* `'custom_var_v3'`: the custom variable value of the third slot for page custom variables
* `'custom_var_k4'`: the custom variable name of the fourth slot for page custom variables
* `'custom_var_v4'`: the custom variable value of the fourth slot for page custom variables
* `'custom_var_k5'`: the custom variable name of the  slot for page custom variables
* `'custom_var_v5'`: the custom variable value of the  slot for page custom variables
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
* `'url_prefix'`: if the name is a URL this refers to the prefix of the URL. The prefix is removed from actual URLs so the protocol and **www.** parts of a URL are ignored during analysis. Can be the following values:
  * `0`: `'http://'`
  * `1`: `'http://www.'`
  * `2`: `'https://'`
  * `3`: `'https://www.'`

### Conversions

When a visit action is tracked that matches a goal's conversion parameters, a conversion is created and persisted. A conversion is a tally that counts a desired action that one of your visitors took. Piwik will analyze these tallys in conjunction with the actions that caused them help users understand how to make their visitors take more desired actions.

A conversion consists of the following information:

* `'idvisit'`: the ID of the visit that caused this conversion
* `'idsite'`: the ID of the site this conversion is for
* `'idvisitor'`: the ID of the visitor that caused this conversion
* `'server_time'`: the datetime of the conversion in the server's timezone
* `'idaction_url'`: the ID of the URL action type of the visit action that caused this conversion
* `'idlink_va'`: the ID of the specific visit action that resulted in this conversion
* `'referer_visit_server_date'`: TODO: what is this? tied to _refts query parameter
* `'url'`: the URL that caused this conversion to be tracked
* `'idgoal'`: the ID of the goal this conversion is for
* `'idorder'`: if this conversion is for an ecommerce order or abandoned cart, this will be the order's ID
* `'items'`: if this conversion is for an ecommerce order or abandoned cart, this will be the number of items in the order/cart
* `'revenue'`: if this conversion is for an ecommerce order or abandoned cart, this is the total revenue generated by the order
* `'revenue_subtotal'`: if this conversion is for an ecommerce order or abandoned cart, this is the total cost of the items in the order/cart
* `'revenue_tax'`: if this conversion is for an ecommerce order or abandoned cart, this is the total tax applied to the items in the order/cart
* `'revenue_shipping'`: if this conversion is for an ecommerce order or abandoned cart, this is the total cost of shipping
* `'revenue_discount'`: if this conversion is for an ecommerce order or abandoned cart, this is the total discount applied to the order

TODO: can conversions have their own custom variables or are these replicated?
* `'custom_var_k1'`: 
* `'custom_var_v1'`: 
* `'custom_var_k2'`: 
* `'custom_var_v2'`: 
* `'custom_var_k3'`: 
* `'custom_var_v3'`: 
* `'custom_var_k4'`: 
* `'custom_var_v4'`: 
* `'custom_var_k5'`: 
* `'custom_var_v5'`: 

### Ecommerce items (aka, conversion items)

An ecommerce item is an item that was sold in an ecommerce order or abandoned in an abandoned cart. They consist of the following information:

* `'server_time'`: TODO: time of visit action? or time ecommerce item was added?
* `'idorder'`: the ID of the order that this ecommerce item is a part of
* `'idaction_sku'`: the ID of the action type entity that contains the item's SKU
* `'idaction_name'`: the ID of the action type entity that contains the ecommerce item's name
* `'idaction_category'`: the ID of an action type entity that contains a category for this ecommerce item
* `'idaction_category2'`: the ID of an action type entity that contains a category for this ecommerce item
* `'idaction_category3'`: the ID of an action type entity that contains a category for this ecommerce item
* `'idaction_category4'`: the ID of an action type entity that contains a category for this ecommerce item
* `'idaction_category5'`: the ID of an action type entity that contains a category for this ecommerce item
* `'price'`: the price of this individual ecommerce item
* `'quantity'`: the amount of this item that were present in the associated ecommerce order
* `'deleted'`: whether this item was removed from the order or not

TODO: this action type stuff is rather confusing. needs to be described better or refactored. are they actually a type of action a user can take? if so, why is SKU an idaction? and why url + page title?

## Archive Data Persistence

Archive data consists of **metrics** and **reports**. Metrics are numeric values and are stored as such. Reports are stored in [DataTable](#) instances and persisted as compressed binary strings.

Archive data is associated with the website ID, period and segment it is for along with the data's identifying name. All archive data will be queried many times by this information. Currently, the segment is hashed and attached to the end of the metric name.

Archive data is also persisted with the current date & time so it is possible to know how old some data is.

All archive data will contain the following information:

* `'idarchive'`: An ID that is shared with all pieces of archive data that were archived with the same website ID, period and segment.
* `'name'`: The name of the report or metric. If a segment is used, a hash of the segment is appended to the name.
* `'idsite'`: The ID of the website this archive data is for.
* `'date1'`: The first date in the period this archive data is for.
* `'date2'`: The last date in the period this archive data is for.
* `'period'`: The type of period this archive data is for. Can be one of the following values:
  * `1`: for **day** periods.
  * `2`: for **week** periods.
  * `3`: for **month** periods.
  * `4`: for **year** periods.
  * `5`: for **range** periods.
* `'ts_archived'`: The datetime the archive data was cached.
* `'value'`: Either a numeric value (for a metric) or a binary string (for a report).

## Other Data Persistence

### Websites (aka sites)

**Site** entities contain information regarding a website whose visits are tracked. There won't be nearly as many of these as there are visits and archive data entries, but they will be queried often.

Every reporting request (either through the [Reporting API](#) or through Piwik's UI) will query one or more site entities. The tracker will only query site data if the [tracker cache](#) needs to be updated. For most tracking requests, site data will not be queried (thus resulting in greater performance for the tracker).

Site entities contain the following information:

* `'idsite'`: the unique ID of the website.
* `'name'`: the name of the website.
* `'main_url'`: the main URL visitors should use to access the website.
* `'ts_created'`: the date & time the site entity was persisted.
* `'ecommerce'`: `1` if the site is an ecommerce site, `0` if not.
* `'sitesearch'`: `1` if the site contains an internal search feature, `0` if not.
* `'sitesearch_keyword_parameters'`: the query parameters the site uses to hold internal site search keywords. This is a comma separated list.
* `'sitesearch_category_parameters'`: the query parameters the site uses to hold internal site search categories. This is a comma separated list.
* `'timezone'`: the timezone of the website.
* `'currency'`: the currency the website uses. Only valid if the site is an ecommerce site.
* `'excluded_ips'`: a comma separated list of IP addresses or IP address ranges. Visits that come from one of these IP addresses will not be tracked for this website.
* `'excluded_parameters'`: a comma separated list of query parameter names. These query parameters will be removed from page URLs before visits and actions are tracked.
* `'excluded_user_agents'`: a comma separated list of strings. Visits with a user agent that contains one of these strings will not be tracked for this website.
* `'group'`: TODO: is this implemented yet?
* `'keep_url_fragment'`: `1` if the URL fragment (everything after the `#`) should be kept in the URL when tracking actions, `0` if not.

Site entities also contain a list of extra URLs that can be used to access the website. These are not stored within site entities themselves.

Site entity data access occurs primarily through the [Piwik\Site](#) class. Anything that cannot be queried through that class can be queried through the [SitesManager](#) core plugin.

#### Goals

Each site has an optional list of goals. A goal is a desired action that a website visitor should take.

The following information is stored in a goal entity:

* `'idsite'`: The ID of the website this goal belongs to.
* `'idgoal'`: The ID for this goal (unique only among goals for this website).
* `'name'`: The name of this goal.
* `'match_attribute'`: string describing what part of the request should be matched against when converting a goal. Can be one of the following values:
  * `'manually'`: the goal is converted by manual [conversion requests](#).
  * `'url'`: the goal is converted based on what the action URL contains.
  * `'title'`: the goal is converted based on what the action page title contains.
  * `'file'`: the goal is converted based on what the filename of a downloaded file contains.
  * `'external_website'`: the goal is converted based on what the URL of an outlink contains.
* `'pattern'`: the pattern to use when checking if a goal is converted.
* `'pattern_type'`: the type of pattern matching to use when checking if a goal is converted.
  * `'contains'`: the goal is converted if the match attribute contains the pattern.
  * `'exact'`: the goal is converted if the match attribute equals the pattern exactly.
  * `'regex'`: the goal is converted if the match attribute is a regex match with the pattern.
* `'case_sensitive'`: `1` if the matching should be case sensitive, `0` if otherwise.
* `'allow_multiple'`: `1` if multiple conversions are allowed per visit, `0` if otherwise.
* `'revenue'`: the amount of revenue a conversion generates (if any).
* `'deleted'`: `1` if this goal was deleted by a Piwik user, `0` if not. TODO: why not remove goals? to keep conversions valid?

_Note: The ecommerce and abandoned cart goals are two special goals that have special IDs. Ecommerce websites automatically have these goals._

### Users

User entities describe each Piwik user except the Super User. The following information is stored in a user entity:

* `'login'`: the user's login handle.
* `'password'`: a hash of the user's password.
* `'alias'`: the user's alias if any. This value is displayed instead of the login handle when addressing the user in the UI.
* `'email'`: the user's email address.
* `'token_auth'`: a user's [token auth](#).
* `'date_registered'`: the date the user data was persisted.

User data is read on every UI and [Reporting API](#) request. TODO: the tracker uses a token_auth, does that mean it reads user data? or is that data cached? or is it just for the superuser so the config is used?

There is some user related information that is not stored directly in user entities. They are descirbed below:

#### User access

Users can be allowed and disallowed access to websites. Piwik persists each user's access level for each website they have access to. If they don't have access to a website, then no information regarding that user + website combination will be persisted.

An access level can be one of the following values:

* `'view'`: The user has view access but cannot add goals or change any settings for the site.
* `'admin'`: The user can view analytics data for the site and add goals or change settings for the site.

#### User language choice

Piwik will also persist each user's language of choice. User logins will be associated with the name of the language (written in the chosen language as opposed to English). TODO: why not just associate it w/ the language code?

This association and the persistence logic is implemented by the [LanguagesManager](#) plugin.

### [Options](#)

Options are key-value pairs where the key is a string and the value is a another string (possibly bigger and possibly binary). They are queried on every UI and [Reporting API](#) request. The tracker will [cache](#) relevant option values and so will only query options when the cache needs updating.

## The Database Logging Backend

Piwik includes a [logging utility](#) that can be used to aid development or troubleshoot live Piwik installs. The utility can output log messages to multiple backends, including the database.

Every log entry contains the following information (all of which is persisted):

* `'tag'`: A string used to categorize the log entry. This will either be the name of the plugin that logged a message or, if it cannot be found, the name of the class.
* `'timestamp'`: When the log entry was made.
* `'level'`: The log level (as a string). Describes the severity of the entry. See [Piwik\Log](#) for a list of levels.
* `'message'`: The log entry's message.

## Plugin Persistence

Plugins can provide persistence for new data if they need to. At the moment, since MySQL is the only supported backend, this means directly adding and using new tables.

To add new tables to Piwik's MySQL database, execute a `CREATE TABLE` statement in the plugin descriptor's [install](#) method. For example:

    use Piwik\Db;

    public class MyPlugin extends \Piwik\Plugin
    {
        // ...

        public function install()
        {
            try {
                $sql = "CREATE TABLE " . Common::prefixTable('mynewtable') . " (
                            mykey VARCHAR( 10 ) NOT NULL ,
                            mydata VARCHAR( 100 ) NOT NULL ,
                            PRIMARY KEY ( mykey )
                        )  DEFAULT CHARSET=utf8 ";
                Db::exec($sql);
            } catch (Exception $e) {
                // ignore error if table already exists (1050 code is for 'table already exists')
                if (!Db::get()->isErrNo($e, '1050')) {
                    throw $e;
                }
            }
        }

        // ...
    }

Plugins should also clean up after themselves by dropping the tables in the [uninstall](#) method:

    use Piwik\Db;

    public class MyPlugin extends \Piwik\Plugin
    {
        // ...

        public function install()
        {
            Db::dropTables(Common::prefixTable('mynewtable'));
        }

        // ...
    }

**Note: New tables should be appropriately [prefixed](#).**

### Augmenting existing tables

Plugins can also augment existing tables. If, for example, a plugin wanted to track extra visit information, the plugin could add columns to the log data tables to have a place to put this new data. This would also be done in the [install](#) method:

    use Piwik\Db;

    public class MyPlugin extends \Piwik\Plugin
    {
        // ...

        public function install()
        {
            try {
                $q1 = "ALTER TABLE `" . Common::prefixTable("log_visit") . "`
                               ADD `mynewdata` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `config_os`,";
                Db::exec($q1);
            } catch (Exception $e) {
                // ignore column already exists error
                if (!Db::get()->isErrNo($e, '1060')) {
                    throw $e;
                }
            }
        }

        // ...
    }

Plugins should remove the column in the [uninstall](#) method, **unless doing so take very long time**. Since log tables can have millions and even billions of entries, removing columns from these tables when a plugin is uninstalled would be a bad idea.

TODO: this seems it will be a problem in the long run. must be some way to clear away unused data, even if the user has to say specifically they want to get rid of it.

## The MySQL Backend

### Log Data Tables

### Archive Tables

### Other Tables

## Other Backends

## Learn more

* 

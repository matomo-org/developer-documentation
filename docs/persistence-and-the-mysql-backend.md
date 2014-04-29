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
- how Piwik queries the tables. queries are not in one place, so hard to find
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

Piwik also persists other simpler forms of data including:

* websites,
* users,
* goals,
* and options.

This guide describes exactly what information this data consists of and exactly how the MySQL backend persists it.

_Note: Piwik uses PHP arrays to hold data that will be persisted. When we describe what information is in each persisted entity, we list properties by the string name used to store the property in the entity array._

## Log Data Persistence

There are four types of log data, **visits**, **action types**, **conversions** and **ecommerce items**. All log data is persisted in a similar way: new data is constantly added to the set at high volume and updates are non-existant (except for **visits**).

**Visit** data is updated while visits are active. So until a visit ends it is possible that Piwik will try and update it.

Log data is read when calculating analytics data and old data will sometimes be deleted (via the [data purging feature](http://piwik.org/docs/managing-your-databases-size/)).

Backends must ensure that inserting new log data is as fast as possible and aggregating log data is not too slow (though obviously, faster is better).

<a name="log-data-persistence-visits"></a>
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
  * **Common::REFERRER\_TYPE\_DIRECT\_ENTRY**: If set to this value, other `'referer_...'` fields have no meaning.
  * **Common::REFERRER\_TYPE\_SEARCH\_ENGINE**: If set to this value, `'referer_url'` is the url of the search engine and `'referer_keyword'` is the keyword used (if we can find it).
  <!-- TODO: for search engine, will referer_name be set? (same for website) -->
  * **Common::REFERRER\_TYPE\_WEBSITE**: If set to this value, `'referer_url'` is the url of the website.
  * **Common::REFERRER\_TYPE\_CAMPAIGN**: If set to this value, `'referer_name'` is the name of the campaign.
  <-- TODO: double check campaign info -->
* `'referer_name'`: referrer name; its meaning depends on the specific referrer type
* `'referer_url'`: the referrer URL; its meaning depends on the specific referrer type
* `'referer_keyword'`: the keyword used if a search engine was the referrer
* `'config_id'`: a hash of all the visit's configuration options, including the OS, browser name, browser version, browser language, IP address and  all browser plugin information
* `'config_os'`: a short string identifiying the operating system used to make this visit. See [UserAgentParser](https://github.com/piwik/piwik/blob/master/libs/UserAgentParser/UserAgentParser.php) for more info
* `'config_browser_name'`: a short string identifying the browser used to make this visit. See [UserAgentParser](https://github.com/piwik/piwik/blob/master/libs/UserAgentParser/UserAgentParser.php) for more info <!-- (TODO: what about devicesdetection?) -->
* `'config_browser_version'`: a string identifying the version of the browser used to make this visit
* `'config_resolution'`: a string identifying the screen resolution the visitor used to make this visit (eg, `'1024x768'`)
* `'config_pdf'`: whether the visitor's browser can view PDF files or not
* `'config_flash'`: whether the visitor's browser can view flash files or not
* `'config_java'`: whether the visitor's browser can run Java or not
* `'config_director'`: <!-- TODO what is this? -->
* `'config_quicktime'`: whether the visitor's browser uses quicktime to play media files or not
* `'config_realplayer'`: whether the visitor's browser can play realplayer media files or not
* `'config_windowsmedia'`: whether the visitor's browser uses windows media player to play media files
* `'config_gears'`: <!-- TODO what is this? -->
* `'config_silverlight'`: whether the visitor's browser can run silverlight programs or not
* `'config_cookie'`: whether the visitor's browser has cookies enabled or not
* `'location_ip'`: the IP address of the computer that the visit was made from. Can be [anonymized](http://piwik.org/docs/privacy/#step-1-automatically-anonymize-visitor-ips)
* `'location_browser_lang'`: a string describing the language used in the visitor's browser
* `'location_country'`: a two character string describing the country the visitor was located in while visiting the site. Set by the [UserCountry](https://github.com/piwik/piwik/tree/master/plugins/UserCountry) plugin.
* `'location_region'`: a two character string describing the region of the country the visitor was in. Set by the [UserCountry](https://github.com/piwik/piwik/tree/master/plugins/UserCountry) plugin.
* `'location_city'`: a string naming the city the visitor was in while visiting the site. Set by the [UserCountry](https://github.com/piwik/piwik/tree/master/plugins/UserCountry) plugin.
* `'location_latitude'`: the latitude of the visitor while he/she visited the site. Set by the [UserCountry](https://github.com/piwik/piwik/tree/master/plugins/UserCountry) plugin.
* `'location_longitude'`: the longitude of the visitor while he/she visited the site. Set by the [UserCountry](https://github.com/piwik/piwik/tree/master/plugins/UserCountry) plugin.
* `'custom_var_k1'`: the custom variable name of the visit in the first slot for visit custom variables.
* `'custom_var_v1'`: the custom variable value of the visit in the first slot for visit custom variables.
* `'custom_var_k2'`: the custom variable name of the visit in the second slot for visit custom variables.
* `'custom_var_v2'`: the custom variable value of the visit in the second slot for visit custom variables.
* `'custom_var_k3'`: the custom variable name of the visit in the third slot for visit custom variables.
* `'custom_var_v3'`: the custom variable value of the visit in the third slot for visit custom variables.
* `'custom_var_k4'`: the custom variable name of the visit in the fourth slot for visit custom variables.
* `'custom_var_v4'`: the custom variable value of the visit in the fourth slot for visit custom variables.
* `'custom_var_k5'`: the custom variable name of the visit in the fifth slot for visit custom variables.
* `'custom_var_v5'`: the custom variable value of the visit in the fifth slot for visit custom variables.

Some plugins, such as the [Provider](https://github.com/piwik/piwik/tree/master/plugins/Provider) plugin, will add new information to visits.

<a name="log-data-persistence-visit-actions"></a>
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

<!-- TODO: custom events when finished -->
<!-- TODO: replace page title action type w/ action name? need to describe somewhere what an 'action name' is. -->

<a name="log-data-persistence-action-types"></a>
### Action Types

Action types, such as a specific URL or page title, are analyzed as well as visits. Such analysis can lead to an understanding of, for example, which pages are more relevant to visitors than others.

When Piwik encounters a new action type, a new action type entity is persisted.

Action types contain the following information:

* `'name'`: a string describing the action type. Can be a URL, a page title, campaign name or anything else. The meaning is determined by the **type** field.
* `'hash'`: a hash value calculated using the name.
* `'type'`: the action type's category. Can be one of the following values:
  * **Piwik\Tracker\Action::TYPE\_PAGE\_URL**: the action type is a URL to a page on the website being tracked.
  * **Piwik\Tracker\Action::TYPE\_OUTLINK**: the action type is a URL is of a link on the website being tracked. A visitor clicked it.
  * **Piwik\Tracker\Action::TYPE\_DOWNLOAD**: the action type is a URL of a file that was downloaded from the website being tracked.
  * **Piwik\Tracker\Action::TYPE\_PAGE\_TITLE**: the action type is the page title of a page on the website being tracked.
  * **Piwik\Tracker\Action::TYPE\_ECOMMERCE\_ITEM\_SKU**: the action type is the SKU of an ecommerce item that is sold on the site.
  * **Piwik\Tracker\Action::TYPE\_ECOMMERCE\_ITEM\_NAME**: the action type is the name of an ecommerce item that is sold on the site.
  * **Piwik\Tracker\Action::TYPE\_ECOMMERCE\_ITEM\_CATEGORY**: the action type is the name of an ecommerce item category that is used on the site.
  * **Piwik\Tracker\Action::TYPE_SITE_SEARCH**: the action type is a site search action.
* `'url_prefix'`: if the name is a URL this refers to the prefix of the URL. The prefix is removed from actual URLs so the protocol and **www.** parts of a URL are ignored during analysis. Can be the following values:
  * `0`: `'http://'`
  * `1`: `'http://www.'`
  * `2`: `'https://'`
  * `3`: `'https://www.'`

<a name="log-data-persistence-conversions"></a>
### Conversions

When a visit action is tracked that matches a goal's conversion parameters, a conversion is created and persisted. A conversion is a tally that counts a desired action that one of your visitors took. Piwik will analyze these tallies in conjunction with the actions that caused them in order to help Piwik users understand how to make their visitors take more desired actions.

A conversion consists of the following information:

* `'idvisit'`: the ID of the visit that caused this conversion
* `'idsite'`: the ID of the site this conversion is for
* `'idvisitor'`: the ID of the visitor that caused this conversion
* `'server_time'`: the datetime of the conversion in the server's timezone
* `'idaction_url'`: the ID of the URL action type of the visit action that caused this conversion
* `'idlink_va'`: the ID of the specific visit action that resulted in this conversion
* `'referer_visit_server_date'`: <!-- TODO: what is this? tied to _refts query parameter -->
* `'url'`: the URL that caused this conversion to be tracked
* `'idgoal'`: the ID of the goal this conversion is for
* `'idorder'`: if this conversion is for an ecommerce order or abandoned cart, this will be the order's ID
* `'items'`: if this conversion is for an ecommerce order or abandoned cart, this will be the number of items in the order/cart
* `'revenue'`: if this conversion is for an ecommerce order or abandoned cart, this is the total revenue generated by the order
* `'revenue_subtotal'`: if this conversion is for an ecommerce order or abandoned cart, this is the total cost of the items in the order/cart
* `'revenue_tax'`: if this conversion is for an ecommerce order or abandoned cart, this is the total tax applied to the items in the order/cart
* `'revenue_shipping'`: if this conversion is for an ecommerce order or abandoned cart, this is the total cost of shipping
* `'revenue_discount'`: if this conversion is for an ecommerce order or abandoned cart, this is the total discount applied to the order

<a name="log-data-persistence-ecommerce-items"></a>
### Ecommerce items (aka, conversion items)

An ecommerce item is an item that was sold in an ecommerce order or abandoned in an abandoned cart. They consist of the following information:

* `'server_time'`: <!-- TODO: time of visit action? or time ecommerce item was added? -->
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

<!-- TODO: this action type stuff is rather confusing. needs to be renamed, described better or refactored. are they actually a type of action a user can take? if so, why is SKU an idaction? and why url + page title? -->

## Archive Data Persistence

Archive data consists of **metrics** and **reports**. Metrics are numeric values and are stored as such. Reports are stored in [DataTable](/api-reference/Piwik/DataTable) instances and persisted as compressed binary strings.

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

<a name="other-data-site"></a>
### Websites (aka sites)

**Site** entities contain information regarding a website whose visits are tracked. There won't be nearly as many of these as there are visits and archive data entries, but they will be queried often.

Every reporting request (either through the [Reporting API](/guides/piwiks-reporting-api) or through Piwik's UI) will query one or more site entities. The tracker will only query site data if the [tracker cache](/guides/all-about-tracking#the-tracker-cache) needs to be updated. For most tracking requests, site data will not be queried (thus resulting in greater performance for the tracker).

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
* `'group'`: <!-- TODO: is this implemented yet? -->
* `'keep_url_fragment'`: `1` if the URL fragment (everything after the `#`) should be kept in the URL when tracking actions, `0` if not.

Site entities also contain a list of extra URLs that can be used to access the website. These are not stored within site entities themselves.

Site entity data access occurs primarily through the [Piwik\Site](/api-reference/Piwik/Site) class. Anything that cannot be queried through that class can be queried through the [SitesManager](https://github.com/piwik/piwik/tree/master/plugins/SitesManager) core plugin.

<a name="other-data-goals"></a>
#### Goals

Each site has an optional list of goals. A goal is a desired action that a website visitor should take.

The following information is stored in a goal entity:

* `'idsite'`: The ID of the website this goal belongs to.
* `'idgoal'`: The ID for this goal (unique only among goals for this website).
* `'name'`: The name of this goal.
* `'match_attribute'`: string describing what part of the request should be matched against when converting a goal. Can be one of the following values:
  * `'manually'`: the goal is converted by [manual conversion requests](/api-reference/tracking-javascript#manually-trigger-a-conversion-for-a-goal).
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
* `'deleted'`: `1` if this goal was deleted by a Piwik user, `0` if not. <!-- TODO: why not DELETE goals? is it to keep conversions referencing old goals valid? -->

_Note: The ecommerce and abandoned cart goals are two special goals with special IDs. Ecommerce websites automatically have these goals._

<a name="other-data-user"></a>
### Users

User entities describe each Piwik user except the Super User. The following information is stored in a user entity:

* `'login'`: the user's login handle.
* `'password'`: a hash of the user's password.
* `'alias'`: the user's alias if any. This value is displayed instead of the login handle when addressing the user in the UI.
* `'email'`: the user's email address.
* `'token_auth'`: a user's token auth.
* `'date_registered'`: the date the user data was persisted.

User data is read on every UI and [Reporting API](/guides/piwiks-reporting-api) request. <~-- TODO: the tracker uses a token_auth, does that mean it reads user data? or is that data cached? or is it just for the superuser so the config is used? -->

There is some user related information that is not stored directly in user entities. They are descirbed below:

<a name="other-data-user-access"></a>
#### User access

Users can be allowed and disallowed access to websites. Piwik persists each user's access level for each website they have access to. If they don't have access to a website, then no information regarding that user + website combination will be persisted.

An access level can be one of the following values:

* `'view'`: The user has view access but cannot add goals or change any settings for the site.
* `'admin'`: The user can view analytics data for the site and add goals or change settings for the site.

<a name="other-data-user-language-choice"></a>
#### User language choice

Piwik will also persist each user's language of choice. User logins are associated with the name of the language (written in the chosen language as opposed to English). <!-- TODO: why not just associate it w/ the language code? -->

This association and the persistence logic is implemented by the [LanguagesManager](https://github.com/piwik/piwik/tree/master/plugins/LanguagesManager) plugin.

### [Options](/api-reference/Piwik/Option)

Options are key-value pairs where the key is a string and the value is a another string (possibly bigger and possibly binary). They are queried on every UI and [Reporting API](/guides/piwiks-reporting-api) request. The tracker will [cache](/guides/all-about-tracking#the-tracker-cache) relevant option values and so will only query options when the cache needs updating.

Some options should be loaded on every non-tracking request. These options have a special **autoload** property set to `1`.

## The Database Logging Backend

Piwik includes a [logging utility](/api-reference/Piwik/Log) that can be used to aid development or troubleshoot live Piwik installs. The utility can output log messages to multiple backends, including the database.

Every log entry contains the following information (all of which is persisted):

* `'tag'`: A string used to categorize the log entry. This will either be the name of the plugin that logged a message or, if it cannot be found, the name of the class.
* `'timestamp'`: When the log entry was made.
* `'level'`: The log level (as a string). Describes the severity of the entry. See [Piwik\Log](/api-reference/Piwik/Log) for a list of levels.
* `'message'`: The log entry's message.

## Plugin Persistence

Plugins can provide persistence for new data if they need to. At the moment, since MySQL is the only supported backend, this means directly adding and using new tables.

To add new tables to Piwik's MySQL database, execute a `CREATE TABLE` statement in the plugin descriptor's [install](/api-reference/Piwik/Plugin#install) method. For example:

    use Piwik\Db;
    use Piwik\Common;
    use \Exception;

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

Plugins should also clean up after themselves by dropping the tables in the [uninstall](/api-reference/Piwik/Plugin#uninstall) method:

    use Piwik\Db;
    use Piwik\Common;
    use \Exception;

    public class MyPlugin extends \Piwik\Plugin
    {
        // ...

        public function install()
        {
            Db::dropTables(Common::prefixTable('mynewtable'));
        }

        // ...
    }

**Note: New tables should be appropriately [prefixed](/api-reference/Piwik/Common#prefixtable).**

### Augmenting existing tables

Plugins can also augment existing tables. If, for example, a plugin wanted to track extra visit information, the plugin could add columns to log data tables and set these columns during tracking.This would also be done in the [install](/api-reference/Piwik/Plugin#install) method:

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

Plugins should remove the column in the [uninstall](/api-reference/Piwik/Plugin#uninstall) method, **unless doing so take very long time**. Since log tables can have millions and even billions of entries, removing columns from these tables when a plugin is uninstalled would be a bad idea.

<!-- TODO: this seems it will be a problem in the long run. must be some way to clear away unused data, even if the user has to say specifically they want to get rid of it. -->

## The MySQL Backend

This section lists each MySQL table used to store the data described above and details everything we did to them to make Piwik run as fast as possible.

_Note: All table names in the MySQL database are prefixed with the value in the `[database] tables_prefix` INI config._ This is to ensure that non-piwik tables do not get overwritten or used by accident. It also makes it possible to store multiple instances of Piwik in one datbase.

### Log Data Tables

#### log_visit

This table stores [Visit entities](#log-data-persistence-visits).

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE log_visit (
        idvisit INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        idsite INTEGER(10) UNSIGNED NOT NULL,
        idvisitor BINARY(8) NOT NULL,
        visitor_localtime TIME NOT NULL,
        visitor_returning TINYINT(1) NOT NULL,
        visitor_count_visits SMALLINT(5) UNSIGNED NOT NULL,
        visitor_days_since_last SMALLINT(5) UNSIGNED NOT NULL,
        visitor_days_since_order SMALLINT(5) UNSIGNED NOT NULL,
        visitor_days_since_first SMALLINT(5) UNSIGNED NOT NULL,
        visit_first_action_time DATETIME NOT NULL,
        visit_last_action_time DATETIME NOT NULL,
        visit_exit_idaction_url INTEGER(11) UNSIGNED NULL DEFAULT 0,
        visit_exit_idaction_name INTEGER(11) UNSIGNED NOT NULL,
        visit_entry_idaction_url INTEGER(11) UNSIGNED NOT NULL,
        visit_entry_idaction_name INTEGER(11) UNSIGNED NOT NULL,
        visit_total_actions SMALLINT(5) UNSIGNED NOT NULL,
        visit_total_searches SMALLINT(5) UNSIGNED NOT NULL,
        visit_total_events SMALLINT(5) UNSIGNED NOT NULL,
        visit_total_time SMALLINT(5) UNSIGNED NOT NULL,
        visit_goal_converted TINYINT(1) NOT NULL,
        visit_goal_buyer TINYINT(1) NOT NULL,
        referer_type TINYINT(1) UNSIGNED NULL,
        referer_name VARCHAR(70) NULL,
        referer_url TEXT NOT NULL,
        referer_keyword VARCHAR(255) NULL,
        config_id BINARY(8) NOT NULL,
        config_os CHAR(3) NOT NULL,
        config_browser_name VARCHAR(10) NOT NULL,
        config_browser_version VARCHAR(20) NOT NULL,
        config_resolution VARCHAR(9) NOT NULL,
        config_pdf TINYINT(1) NOT NULL,
        config_flash TINYINT(1) NOT NULL,
        config_java TINYINT(1) NOT NULL,
        config_director TINYINT(1) NOT NULL,
        config_quicktime TINYINT(1) NOT NULL,
        config_realplayer TINYINT(1) NOT NULL,
        config_windowsmedia TINYINT(1) NOT NULL,
        config_gears TINYINT(1) NOT NULL,
        config_silverlight TINYINT(1) NOT NULL,
        config_cookie TINYINT(1) NOT NULL,
        location_ip VARBINARY(16) NOT NULL,
        location_browser_lang VARCHAR(20) NOT NULL,
        location_country CHAR(3) NOT NULL,
        location_region char(2) DEFAULT NULL,
        location_city varchar(255) DEFAULT NULL,
        location_latitude float(10, 6) DEFAULT NULL,
        location_longitude float(10, 6) DEFAULT NULL,
        custom_var_k1 VARCHAR(200) DEFAULT NULL,
        custom_var_v1 VARCHAR(200) DEFAULT NULL,
        custom_var_k2 VARCHAR(200) DEFAULT NULL,
        custom_var_v2 VARCHAR(200) DEFAULT NULL,
        custom_var_k3 VARCHAR(200) DEFAULT NULL,
        custom_var_v3 VARCHAR(200) DEFAULT NULL,
        custom_var_k4 VARCHAR(200) DEFAULT NULL,
        custom_var_v4 VARCHAR(200) DEFAULT NULL,
        custom_var_k5 VARCHAR(200) DEFAULT NULL,
        custom_var_v5 VARCHAR(200) DEFAULT NULL,
        PRIMARY KEY(idvisit),
        INDEX index_idsite_config_datetime (idsite, config_id, visit_last_action_time),
        INDEX index_idsite_datetime (idsite, visit_last_action_time),
        INDEX index_idsite_idvisitor (idsite, idvisitor)
    )  DEFAULT CHARSET=utf8;

The **index\_idsite\_config_datetime** index is used when trying to recognize returning visitors.

The **index\_idsite\_datetime** index is used when aggregating visits. Since log aggregation occurs only for individual day periods, this index helps Piwik find the visits for a website and period quickly. Without it, log aggregation would require a table scan through the entire log_visit table.

<!-- TODO: what is the index\_idsite\_idvisitor index used for? Live + visitor profile? -->

#### log\_link\_visit\_action

This table stores [Visit Action entities](#log-data-persistence-visit-actions).

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE log_link_visit_action (
        idlink_va INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        idsite int(10) UNSIGNED NOT NULL,
        idvisitor BINARY(8) NOT NULL,
        server_time DATETIME NOT NULL,
        idvisit INTEGER(10) UNSIGNED NOT NULL,
        idaction_url INTEGER(10) UNSIGNED DEFAULT NULL,
        idaction_url_ref INTEGER(10) UNSIGNED NULL DEFAULT 0,
        idaction_name INTEGER(10) UNSIGNED,
        idaction_name_ref INTEGER(10) UNSIGNED NOT NULL,
        idaction_event_category INTEGER(10) UNSIGNED DEFAULT NULL,
        idaction_event_action INTEGER(10) UNSIGNED DEFAULT NULL,
        time_spent_ref_action INTEGER(10) UNSIGNED NOT NULL,
        custom_var_k1 VARCHAR(200) DEFAULT NULL,
        custom_var_v1 VARCHAR(200) DEFAULT NULL,
        custom_var_k2 VARCHAR(200) DEFAULT NULL,
        custom_var_v2 VARCHAR(200) DEFAULT NULL,
        custom_var_k3 VARCHAR(200) DEFAULT NULL,
        custom_var_v3 VARCHAR(200) DEFAULT NULL,
        custom_var_k4 VARCHAR(200) DEFAULT NULL,
        custom_var_v4 VARCHAR(200) DEFAULT NULL,
        custom_var_k5 VARCHAR(200) DEFAULT NULL,
        custom_var_v5 VARCHAR(200) DEFAULT NULL,
        custom_float FLOAT NULL DEFAULT NULL,
        PRIMARY KEY(idlink_va),
        INDEX index_idvisit(idvisit),
        INDEX index_idsite_servertime ( idsite, server_time )
    )  DEFAULT CHARSET=utf8

The `idsite` and `idvisitor` columns are copied from the visit action's associated visit in order to avoid having to join the log_visit table in some cases.

The **index\_idvisit** index allows Piwik to quickly query the visit actions for a visit.

The **index\_idsite\_servertime** index is used when aggregating visit actions. It allows quick access to the visit actions that were tracked for a specific website during a specific period and lets us avoid a table scan through the whole table.

#### log_action

This table stores [Action Type entities](#log-data-persistence-action-types).

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE log_action (
        idaction INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        name TEXT,
        hash INTEGER(10) UNSIGNED NOT NULL,
        type TINYINT UNSIGNED NULL,
        url_prefix TINYINT(2) NULL,
        PRIMARY KEY(idaction),
        INDEX index_type_hash (type, hash)
    )  DEFAULT CHARSET=utf8

The **index\_type\_hash** index is used during tracking to find existing action types.

#### log_conversion

This table stores [Conversion entities](#log-data-persistence-conversions).

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE `log_conversion` (
        idvisit int(10) unsigned NOT NULL,
        idsite int(10) unsigned NOT NULL,
        idvisitor BINARY(8) NOT NULL,
        server_time datetime NOT NULL,
        idaction_url int(11) default NULL,
        idlink_va int(11) default NULL,
        referer_visit_server_date date default NULL,
        referer_type int(10) unsigned default NULL,
        referer_name varchar(70) default NULL,
        referer_keyword varchar(255) default NULL,
        visitor_returning tinyint(1) NOT NULL,
        visitor_count_visits SMALLINT(5) UNSIGNED NOT NULL,
        visitor_days_since_first SMALLINT(5) UNSIGNED NOT NULL,
        visitor_days_since_order SMALLINT(5) UNSIGNED NOT NULL,
        location_country char(3) NOT NULL,
        location_region char(2) DEFAULT NULL,
        location_city varchar(255) DEFAULT NULL,
        location_latitude float(10, 6) DEFAULT NULL,
        location_longitude float(10, 6) DEFAULT NULL,
        url text NOT NULL,
        idgoal int(10) NOT NULL,
        buster int unsigned NOT NULL,
        idorder varchar(100) default NULL,
        items SMALLINT UNSIGNED DEFAULT NULL,
        revenue float default NULL,
        revenue_subtotal float default NULL,
        revenue_tax float default NULL,
        revenue_shipping float default NULL,
        revenue_discount float default NULL,
        custom_var_k1 VARCHAR(200) DEFAULT NULL,
        custom_var_v1 VARCHAR(200) DEFAULT NULL,
        custom_var_k2 VARCHAR(200) DEFAULT NULL,
        custom_var_v2 VARCHAR(200) DEFAULT NULL,
        custom_var_k3 VARCHAR(200) DEFAULT NULL,
        custom_var_v3 VARCHAR(200) DEFAULT NULL,
        custom_var_k4 VARCHAR(200) DEFAULT NULL,
        custom_var_v4 VARCHAR(200) DEFAULT NULL,
        custom_var_k5 VARCHAR(200) DEFAULT NULL,
        custom_var_v5 VARCHAR(200) DEFAULT NULL,
        PRIMARY KEY (idvisit, idgoal, buster),
        UNIQUE KEY unique_idsite_idorder (idsite, idorder),
        INDEX index_idsite_datetime ( idsite, server_time )
    ) DEFAULT CHARSET=utf8

All extra information stored in this table that is not listed for the conversion entity above is replicated from the Visit entity this conversion is for. This allows us to avoid joining the log_visit table in certain cases.

The **index\_idsite\_datetime** index is used when aggregating conversions. It allows quick access to the conversions that were tracked for a specific website during a specific period and lets us avoid a table scan through the entire table.

#### log\_conversion\_item

This table stores [Ecommerce Item entities](#log-data-persistence-ecommerce-items).

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE `log_conversion_item` (
        idsite int(10) UNSIGNED NOT NULL,
        idvisitor BINARY(8) NOT NULL,
        server_time DATETIME NOT NULL,
        idvisit INTEGER(10) UNSIGNED NOT NULL,
        idorder varchar(100) NOT NULL,

        idaction_sku INTEGER(10) UNSIGNED NOT NULL,
        idaction_name INTEGER(10) UNSIGNED NOT NULL,
        idaction_category INTEGER(10) UNSIGNED NOT NULL,
        idaction_category2 INTEGER(10) UNSIGNED NOT NULL,
        idaction_category3 INTEGER(10) UNSIGNED NOT NULL,
        idaction_category4 INTEGER(10) UNSIGNED NOT NULL,
        idaction_category5 INTEGER(10) UNSIGNED NOT NULL,
        price FLOAT NOT NULL,
        quantity INTEGER(10) UNSIGNED NOT NULL,
        deleted TINYINT(1) UNSIGNED NOT NULL,

        PRIMARY KEY(idvisit, idorder, idaction_sku),
        INDEX index_idsite_servertime ( idsite, server_time )
    ) DEFAULT CHARSET=utf8

The `idsite`, `idvisitor`, `server_time` and `idvisit` columns are copied from the Conversion entity this Ecommerce Item belongs to. They are copied so we can aggregate Ecommerce Items without having to join other tables.

The **index\_idsite\_servertime** index is used when aggregating ecommerce items. It allows quick access to the items that were tracked for a specific website and during a specific period and lets us avoid a table scan through the entire table.

### Archive Tables

In the MySQL backend archive data is partitioned by the month the archive data is for. So reports that aggregate visits from January, 2012 will be held in a different table from reports that aggregate visits from February 2012.

Piwik creates two types of archive tables, one for each type of archive data. The **archive\_numeric** tables store metric data and the **archive\_blob** tables store report data.

Archive tables are created dynamically. When Piwik needs to query or insert archive data for a certain month and it cannot find the table that holds this data, the table is created.

The year and month of an archive table is appended as the suffix to the name. So the **archive\_numeric** table for January, 2012 would have the name **archive\_numeric\_2012\_01**.

#### archive_numeric

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE archive_numeric_YYYY_MM (
        idarchive INTEGER UNSIGNED NOT NULL,
        name VARCHAR(255) NOT NULL,
        idsite INTEGER UNSIGNED NULL,
        date1 DATE NULL,
        date2 DATE NULL,
        period TINYINT UNSIGNED NULL,
        ts_archived DATETIME NULL,
        value DOUBLE NULL,
        PRIMARY KEY(idarchive, name),
        INDEX index_idsite_dates_period(idsite, date1, date2, period, ts_archived),
        INDEX index_period_archived(period, ts_archived)
    ) DEFAULT CHARSET=utf8

The **index\_idsite\_dates\_period** index is used when querying archive data. It lets Piwik quickly query archive data for any site and period, and for data that was archived past a certain date-time.

The **index\_period\_archived** index is used when [purging archive data](http://piwik.org/docs/managing-your-databases-size/). It allows Piwik to quickly find archive data for a specific period that is old enough to be purged.

#### archive_blob

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE archive_blob (
        idarchive INTEGER UNSIGNED NOT NULL,
        name VARCHAR(255) NOT NULL,
        idsite INTEGER UNSIGNED NULL,
        date1 DATE NULL,
        date2 DATE NULL,
        period TINYINT UNSIGNED NULL,
        ts_archived DATETIME NULL,
        value MEDIUMBLOB NULL,
        PRIMARY KEY(idarchive, name),
        INDEX index_period_archived(period, ts_archived)
    ) DEFAULT CHARSET=utf8

The **index\_period\_archived** index is used in the same way as the one in **archive\_numeric** tables.

**archive\_blob** tables do not have an index that makes it fast to query for rows by site, period and archived date. This is because they should not be queried this way. Instead, the **archive\_numeric** table should be queried and the `idarchive` values saved. These values can be used to query data in the **archive\_blob** table.

### Other Tables

#### site

This table stores [Website](#other-data-site) entities.

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE site (
        idsite INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(90) NOT NULL,
        main_url VARCHAR(255) NOT NULL,
        ts_created TIMESTAMP NULL,
        ecommerce TINYINT DEFAULT 0,
        sitesearch TINYINT DEFAULT 1,
        sitesearch_keyword_parameters TEXT NOT NULL,
        sitesearch_category_parameters TEXT NOT NULL,
        timezone VARCHAR( 50 ) NOT NULL,
        currency CHAR( 3 ) NOT NULL,
        excluded_ips TEXT NOT NULL,
        excluded_parameters TEXT NOT NULL,
        excluded_user_agents TEXT NOT NULL,
        `group` VARCHAR(250) NOT NULL,
        keep_url_fragment TINYINT NOT NULL DEFAULT 0,
        PRIMARY KEY(idsite)
    )  DEFAULT CHARSET=utf8

##### site_url

This table stores extra URLs for [Website](#other-data-site) entities.

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE site_url (
        idsite INTEGER(10) UNSIGNED NOT NULL,
        url VARCHAR(255) NOT NULL,
        PRIMARY KEY(idsite, url)
    )  DEFAULT CHARSET=utf8

#### goal

This table stores [Goal](#other-data-goal) entities.

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE `goal` (
        `idsite` int(11) NOT NULL,
        `idgoal` int(11) NOT NULL,
        `name` varchar(50) NOT NULL,
        `match_attribute` varchar(20) NOT NULL,
        `pattern` varchar(255) NOT NULL,
        `pattern_type` varchar(10) NOT NULL,
        `case_sensitive` tinyint(4) NOT NULL,
        `allow_multiple` tinyint(4) NOT NULL,
        `revenue` float NOT NULL,
        `deleted` tinyint(4) NOT NULL default '0',
        PRIMARY KEY  (`idsite`,`idgoal`)
    ) DEFAULT CHARSET=utf8

#### users

This table stores [User](#other-data-user) entities.

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE user (
        login VARCHAR(100) NOT NULL,
        password CHAR(32) NOT NULL,
        alias VARCHAR(45) NOT NULL,
        email VARCHAR(100) NOT NULL,
        token_auth CHAR(32) NOT NULL,
        date_registered TIMESTAMP NULL,
        PRIMARY KEY(login),
        UNIQUE KEY uniq_keytoken(token_auth)
    )  DEFAULT CHARSET=utf8

##### access

This table stores [User Access information](#other-data-user-access).

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE access (
        login VARCHAR(100) NOT NULL,
        idsite INTEGER UNSIGNED NOT NULL,
        access VARCHAR(10) NULL,
        PRIMARY KEY(login, idsite)
    )  DEFAULT CHARSET=utf8

##### user_language

This table stores [User Language Choice information](#other-data-user-language-choice).

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE user_language (
        login VARCHAR( 100 ) NOT NULL ,
        language VARCHAR( 10 ) NOT NULL ,
        PRIMARY KEY ( login )
    ) DEFAULT CHARSET=utf8

This table is created by the [LanguagesManager](https://github.com/piwik/piwik/tree/master/plugins/LanguagesManager) plugin.

#### option

This table stores [Option](#other-data-options) data.

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE `option` (
        option_name VARCHAR( 255 ) NOT NULL,
        option_value LONGTEXT NOT NULL,
        autoload TINYINT NOT NULL DEFAULT '1',
        PRIMARY KEY ( option_name ),
        INDEX autoload( autoload )
    )  DEFAULT CHARSET=utf8

#### logger_message

This table is used by the database logging backend.

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE logger_message (
        idlogger_message INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        tag VARCHAR(50) NULL,
        timestamp TIMESTAMP NULL,
        level VARCHAR(16) NULL,
        message TEXT NULL,
        PRIMARY KEY(idlogger_message)
    ) DEFAULT CHARSET=utf8

#### session

This table does not store entity data. It is used by Piwik to store session data (as an alternative to using file-based sessions).

The `CREATE TABLE` SQL for this table is:

    CREATE TABLE session (
        id CHAR(32) NOT NULL,
        modified INTEGER,
        lifetime INTEGER,
        data TEXT,
        PRIMARY KEY ( id )
    )  DEFAULT CHARSET=utf8

## Other Backends

Currently the MySQL backend is the only available backend. The use of MySQL is scattered throughout Piwik, so at the moment it is also not possible to create other backends.

That being said, the use of other peristence solutions is on our TODO list. Piwik will eventually work with different relational databases and with different NoSQL solutions.

## Learn more

* To learn **how the tracker inserts log data** see our [All About Tracking](/guides/all-about-tracking) guide.
* To learn **how log data is aggregated** see our [All About Analytics](/guides/all-about-analytics-data) guide and take a look at the [LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator) class.
* To learn **how archive data is cached** see our [All About Analytics](/guides/all-about-analytics-data) guide.
* To learn **about Piwik's logging utility** see this section in our [Getting started extending Piwik](/guides/getting-started-part-1) guide.
* To learn **about database backed sessions** read [this FAQ entry](http://piwik.org/faq/how-to-install/faq_133/).
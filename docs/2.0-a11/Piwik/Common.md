<small>Piwik</small>

Common
======

Static class providing functions used by both the CORE of Piwik and the visitor Tracking engine.

Description
-----------

This is the only external class loaded by the /piwik.php file.
This class should contain only the functions that are used in
both the CORE and the piwik.php statistics logging engine.


Constants
---------

This class defines the following constants:

- [`REFERRER_TYPE_DIRECT_ENTRY`](#REFERRER_TYPE_DIRECT_ENTRY) &mdash; Const used to map the referer type to an integer in the log_visit table
- [`REFERRER_TYPE_SEARCH_ENGINE`](#REFERRER_TYPE_SEARCH_ENGINE)
- [`REFERRER_TYPE_WEBSITE`](#REFERRER_TYPE_WEBSITE)
- [`REFERRER_TYPE_CAMPAIGN`](#REFERRER_TYPE_CAMPAIGN)
- [`HTML_ENCODING_QUOTE_STYLE`](#HTML_ENCODING_QUOTE_STYLE) &mdash; Flag used with htmlspecialchar See php.net/htmlspecialchars

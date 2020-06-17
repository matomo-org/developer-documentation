---
category: Develop
title: Data Access
next: wordpress/matomo-plugin
---
# Matomo for WordPress - Data Access

Within your WordPress plugin, you can access any data that Matomo has stored. There are two ways to do this:

* Without bootstrapping Matomo
* With bootstrapping Matomo

When possible, it is recommended not bootstrapping Matomo for performance and stability reason. It possibly takes 50-250ms
to bootstrap Matomo depending on the server and it can slow down the WordPress experience. Matomo is very powerful and
therefore comes with a few dependencies. Not bootstrapping Matomo reduces the chances of WordPress breaking
because some other plugin requires a dependency we require as well.

Especially in the WordPress frontend we do not recommend bootstraping Matomo but instead query the database directly when possible.

## Direct data access without bootstrapping Matomo

You can fetch any data by fetching data directly from the WordPress database. This is not always recommended or practical but in
some cases this can be much faster and more reliable.

Example on how to fetch the list of configured goals:

```php
$db_settings = new WpMatomo\Db\Settings();
$goal_table_name = $db_settings->prefix_table_name('goal');

global $wpdb;
$all_goals_configured_in_matomo = $wpdb->get_results('select * from ' . $goal_table_name);
```

[Learn more about Matomo database schema](/guides/database-schema)
[View a plugin example](https://github.com/matomo-org/matomo-wordpress-plugin-examples/tree/master/direct-data-access)

## Accessing data by bootstrapping Matomo

With just one method call you can bootstrap Matomo and afterwards access all it's
[HTTP API methods](https://developer.matomo.org/api-reference/reporting-api),
[PHP-APIs](https://developer.matomo.org/api-reference/classes) and
[Events](https://developer.matomo.org/api-reference/events).

Example on how to do an API call to request the list of goals and report data:

```php
$site = new \WpMatomo\Site();
$idsite = $site->get_current_matomo_site_id();

if ($idsite) {
    \WpMatomo\Bootstrap::do_bootstrap();

    $all_goals_configured_in_matomo = \Piwik\API\Request::processRequest('Goals.getGoals', array(
        'idSite' => $idsite
    );

    $country_report = \Piwik\API\Request::processRequest('UserCountry.getCountry', array(
        'idSite' => $idsite,
        'period' => 'day',
        'date' => 'today'
    );
}
```

[View a plugin example](https://github.com/matomo-org/matomo-wordpress-plugin-examples/tree/master/bootstrap-matomo-data-access)
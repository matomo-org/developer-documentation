<?php
if (! defined('CACHING_ENABLED')) {
    define('CACHING_ENABLED', true);
}
if (! defined('DEBUG')) {
    define('DEBUG', false);
}
if (! defined('DISABLE_INCLUDE')) {
    define('DISABLE_INCLUDE', false);
}

if (! defined('MIN_PIWIK_DOCS_VERSION')) {
    define('MIN_PIWIK_DOCS_VERSION', 3);
}

if (! defined('LATEST_PIWIK_DOCS_VERSION')) {
    define('LATEST_PIWIK_DOCS_VERSION', 5);
}

if (! defined('DOCS_DOMAIN')) {
    define('DOCS_DOMAIN', 'developer.matomo.org');
}

if (! defined('WEBHOOK_TOKEN')) {
    define('WEBHOOK_TOKEN', '$2y$10$7StRWWP4gYyuhLIOAWD1Cuw.jOsMWuTwi9DTENPUVakrNN4/H31Gq'); // "changeme"
}

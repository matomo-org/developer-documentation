<?php

$rootDir = str_replace('/generator', '', __DIR__);

define('PIWIK_DOCUMENT_ROOT', $rootDir . '/piwik');
define('PIWIK_USER_PATH', PIWIK_DOCUMENT_ROOT);
define('PIWIK_INCLUDE_PATH', PIWIK_DOCUMENT_ROOT);

require_once PIWIK_INCLUDE_PATH . '/vendor/autoload.php';
require $rootDir . '/generator/vendor/autoload.php';
require $rootDir . '/generator/vendor/nikic/php-parser/lib/bootstrap.php';
require_once PIWIK_INCLUDE_PATH . '/libs/upgradephp/upgrade.php';

$environment = new \Piwik\Application\Environment(null);

try {
    $environment->init();
} catch(\Exception $e) {
    echo sprintf("There was an error during the initialisation but we try to proceed anyway. FYI: error was %s \n\n", $e->getMessage());
}

ini_set('xdebug.max_nesting_level', 2000);

spl_autoload_register(function ($class)
{
    $classPath = str_replace('\\', '/', $class);
    $path      = __DIR__ . '/' . $classPath . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});

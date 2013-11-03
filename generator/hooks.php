<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @package Piwik
 */

$rootDir = str_replace('/generator', '', __DIR__);

define('PIWIK_DOCUMENT_ROOT', $rootDir . '/piwik');
define('PIWIK_USER_PATH', PIWIK_DOCUMENT_ROOT);
define('PIWIK_INCLUDE_PATH', PIWIK_DOCUMENT_ROOT);

require $rootDir . '/generator/vendor/autoload.php';
require_once PIWIK_INCLUDE_PATH . '/core/Loader.php';
require $rootDir . '/generator/vendor/nikic/php-parser/lib/bootstrap.php';
require __DIR__ . '/hooks/Hooks.php';
ini_set('xdebug.max_nesting_level', 2000);

$target   = $rootDir . '/docs/Hooks.md';

$files    = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(PIWIK_DOCUMENT_ROOT));
$phpFiles = new RegexIterator($files, '/piwik\/(core|plugins)(.*)\.php$/');

try {

    $hooks = new Hooks();
    $view  = array('hooks' => array());

    foreach ($phpFiles as $phpFile) {
        $relativeFileName = str_replace(PIWIK_DOCUMENT_ROOT, '', $phpFile);
        $foundHooks = $hooks->searchForHooksInFile($relativeFileName, $phpFile);

        if (!empty($foundHooks)) {
            foreach ($foundHooks as $hook) {
                $view['hooks'][] = $hook;
            }
        }
    }

    $view['hooks'] = $hooks->sortHooksByName($view['hooks']);
    $view['hooks'] = $hooks->addUsages($view['hooks']);

    $hooks->generateDocumentation($view, $target);

} catch (Exception $e) {
    echo 'Parse Error: ', $e->getMessage();
}
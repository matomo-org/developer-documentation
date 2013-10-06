<?php
$dir = dirname(__FILE__) == '/' ? '' : dirname(__FILE__);

define('PIWIK_DOCUMENT_ROOT', $dir . '/vendor/piwik/piwik');
define('PIWIK_USER_PATH', PIWIK_DOCUMENT_ROOT);
define('PIWIK_INCLUDE_PATH', PIWIK_DOCUMENT_ROOT);

require_once __DIR__ . '/vendor/autoload.php';
require_once PIWIK_INCLUDE_PATH . '/core/Loader.php';
require_once __DIR__ . '/ApiFilter.php';

use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Resources')
    ->exclude('tests')
    ->in(array(PIWIK_DOCUMENT_ROOT . '/core', PIWIK_DOCUMENT_ROOT . '/plugins'))
;

$latestStable = file_get_contents('http://builds.piwik.org/LATEST_BETA');
/*
$versions = GitVersionCollection::create($dir)
    ->addFromTags($latestStable)
    ->add('master', 'master branch');
*/
return new Sami($iterator, array(
    'theme'                => 'github',
   // 'versions'             => $versions,
    'title'                => 'Piwik API',
    'build_dir'            => __DIR__.'/docs',
    'cache_dir'            => __DIR__.'/cache',
    'template_dirs'        => array(__DIR__.'/vendor/phine/sami-github'),
    'default_opened_level' => 5,
    'filter'               => new ApiFilter()
));
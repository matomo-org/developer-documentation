<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

$dir = dirname(__FILE__) == '/' ? '' : dirname(__FILE__);

define('PIWIK_DOCUMENT_ROOT', $dir . '/piwik');
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
    ->exclude('tests')
    ->in(array(PIWIK_DOCUMENT_ROOT . '/core', PIWIK_DOCUMENT_ROOT . '/plugins'))
;

$latestStable = file_get_contents('http://builds.piwik.org/LATEST_BETA');
$latestStable = trim($latestStable);

if (empty($latestStable)) {
    echo 'Unable to fetch latest version';
    exit(1);
}

$versions = GitVersionCollection::create(PIWIK_DOCUMENT_ROOT)
    ->add('master', 'master branch')
    //->add($latestStable, 'latest stable')
;

return new Sami($iterator, array(
    'theme'                => 'markdown',
    'versions'             => $versions,
    'title'                => 'Piwik Plugin API',
    'build_dir'            => __DIR__.'/docs/%version%',
    'cache_dir'            => __DIR__.'/cache/%version%',
    'template_dirs'        => array(__DIR__.'/template'),
    'default_opened_level' => 5,
    'filter'               => new ApiFilter()
));
<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @package Piwik
 */

include_once 'bootstrap.php';

use PhpParser\NodeAbstract;
use Sami\Sami;
use Symfony\Component\Finder\Finder;
use Sami\Reflection\ClassReflection;
use Sami\Version\GitVersionCollection;
use Linkparser\InlineLinkParser;
use Linkparser\LinkParser;
use Linkparser\Scope;
use Hooks\Parser as HooksParser;
use ApiClasses\Filter as ApiClassFilter;

$branch = '';
$targetName = '';

if (!empty($argv)) {
    foreach ($argv as $arg) {
        if (strpos($arg, '--branch=') === 0) {
            $branch = str_replace('--branch=', '', $arg);
        }

        if (strpos($arg, '--targetname=') === 0) {
            $targetName = str_replace('--targetname=', '', $arg);
        }
    }
}

if (empty($branch) || empty($targetName)) {
    echo "Missing branch or targetname. Make sure to specify eg '--branch=4.x-dev --targetname=4.x'\n";
    echo "Branch defines which branch to check out, targetname defines the directory in docs the generated files should go to\n";
    exit(1);
}

try {

    function generateApiClassesReference($rootDir, $versionName, $longVersionName)
    {
        $trackerPath = '/vendor/matomo/matomo-php-tracker';
        if ($longVersionName === '3.x') {
            $trackerPath = '/vendor/piwik/piwik-php-tracker';
        }

        $iterator = Finder::create()
            ->files()
            ->name('*.php')
            ->notName('tcpdf_config.php')
            ->exclude(array('tests', 'config', 'ScheduledReports/config'))
            ->in(array(PIWIK_DOCUMENT_ROOT . '/core',
                       PIWIK_DOCUMENT_ROOT . '/plugins',
                       PIWIK_DOCUMENT_ROOT . $trackerPath))
        ;

        $sami = new Sami($iterator, array(
            'theme'                => 'markdown',
            'versions'             => $versionName,
            'title'                => 'Piwik Plugin API',
            'build_dir'            => $rootDir.'/docs/' . $longVersionName . '/generated/',
            'cache_dir'            => $rootDir.'/docs/' . $longVersionName . '/cache/',
            'template_dirs'        => array($rootDir.'/generator/template'),
            'store'                => new \Sami\Store\ArrayStore(),
            'default_opened_level' => 5,
            'include_parent_data'  => true,
            'filter'               => new ApiClassFilter()
        ));

        /** @var Twig_Environment $twig */
        $twig = $sami->offsetGet('twig');

        $twig->addFilter(new Twig_SimpleFilter('inlinelinkparser', function ($description, ClassReflection $class) use ($sami) {
            $scope = new Scope();
            $scope->class     = $class;
            $scope->classes   = $sami->offsetGet('project')->getProjectClasses();
            $scope->namespace = $class->getNamespace();

            $linkConverter = new InlineLinkParser($scope);
            return $linkConverter->parse($description);
        }));

        $twig->addFilter(new Twig_SimpleFilter('linkparser', function ($description, ClassReflection $class) use ($sami) {
            $scope = new Scope();
            $scope->class     = $class;
            $scope->classes   = $sami->offsetGet('project')->getProjectClasses();
            $scope->namespace = $class->getNamespace();

            $linkConverter = new LinkParser($scope);
            return $linkConverter->parse($description);
        }));
        $twig->addFilter(new Twig_SimpleFilter('removeNewLine', function ($content) {
            $content = preg_replace("/(\n)+/", ' ', $content);
            $content = preg_replace("/(\s)+/", ' ', $content);
            return $content;
        }));
        $twig->addFilter(new Twig_SimpleFilter('string', function ($content) {
            if (is_object($content) && $content instanceof NodeAbstract && property_exists($content, 'name')) {
                return $content->name;
            } 
            return (string) $content;
        }));
        $twig->addFilter(new Twig_SimpleFilter('shortDescription', function ($content) {

            $pos = strpos($content, '. ');
            if ($pos > 1) {
                return substr($content, 0, $pos+1);
            }
            return $content;
        }));

        $sami['project']->update();

        return $sami;
    }

    function generateHooksReference($rootDir, $versionName, $versionLongName, $sami)
    {
        $target   = $rootDir . '/docs/' . $versionLongName . '/generated/Hooks.md';
        $files    = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(PIWIK_DOCUMENT_ROOT));
        $phpFiles = new RegexIterator($files, '/piwik\/(core|plugins)(.*)\.php$/');

        $matomoMajorVersion = (int) $versionLongName;

        $hooks = new HooksParser($sami, $matomoMajorVersion);
        $view  = array('hooks' => array(), 'versionName' => $versionName);

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
    }

    $sami = generateApiClassesReference($rootDir, $branch, $targetName);
    generateHooksReference($rootDir, $branch, $targetName, $sami);

} catch (Exception $e) {
    echo 'Parse Error: ', $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString();
}

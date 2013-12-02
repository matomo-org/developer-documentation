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

use Sami\Sami;
use Symfony\Component\Finder\Finder;
use Sami\Reflection\ClassReflection;
use Sami\Version\GitVersionCollection;
use Linkparser\InlineLinkParser;
use Linkparser\Scope;
use Hooks\Parser as HooksParser;
use ApiClasses\Filter as ApiClassFilter;

try {

    function generateApiClassesReference($rootDir, $versionName)
    {
        $iterator = Finder::create()
            ->files()
            ->name('*.php')
            ->exclude('tests')
            ->in(array(PIWIK_DOCUMENT_ROOT . '/core',
                       PIWIK_DOCUMENT_ROOT . '/plugins',
                       PIWIK_DOCUMENT_ROOT . '/libs/PiwikTracker'))
        ;

        $sami = new Sami($iterator, array(
            'theme'                => 'markdown',
            'versions'             => $versionName,
            'title'                => 'Piwik Plugin API',
            'build_dir'            => $rootDir.'/docs/generated/%version%',
            'cache_dir'            => $rootDir.'/docs/cache/%version%',
            'template_dirs'        => array($rootDir.'/generator/template'),
            'default_opened_level' => 5,
            'filter'               => new ApiClassFilter()
        ));

        /** @var Twig_Environment $twig */
        $twig = $sami->offsetGet('twig');

        $twig->addFilter(new Twig_SimpleFilter('linkparser', function ($description, ClassReflection $class) use ($sami) {
            $scope = new Scope();
            $scope->class      = $class;
            $scope->classes    = $sami->offsetGet('project')->getProjectClasses();
            $scope->namespace  = $class->getNamespace();

            $linkConverter = new InlineLinkParser($scope);
            return $linkConverter->parse($description);

        }));

        $sami['project']->update();

        return $sami;
    }

    function generateHooksReference($rootDir, $versionName, $sami)
    {
        $target   = $rootDir . '/docs/generated/' . $versionName . '/Hooks.md';
        $files    = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(PIWIK_DOCUMENT_ROOT));
        $phpFiles = new RegexIterator($files, '/piwik\/(core|plugins)(.*)\.php$/');

        $hooks = new HooksParser($sami);
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

    $latestStable = file_get_contents('http://builds.piwik.org/LATEST_BETA');
    $latestStable = trim($latestStable);

    if (empty($latestStable)) {
        echo 'Unable to fetch latest version';
        exit(1);
    }

    /** @var $versions GitVersionCollection */
    $versions = GitVersionCollection::create(PIWIK_DOCUMENT_ROOT)
        ->add('master', 'master branch')
        ->add($latestStable, 'latest stable')
    ;

    $versions->rewind();
    while ($versions->valid()) {
        $version = $versions->current();
        $sami    = generateApiClassesReference($rootDir, $version->getName());
        generateHooksReference($rootDir, $version->getName(), $sami);
        $versions->next();
    }

} catch (Exception $e) {
    echo 'Parse Error: ', $e->getMessage();
}
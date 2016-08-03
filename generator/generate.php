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
    echo "Missing branch or targetname. Make sure to specify eg '--branch=master --targetname=2.x'\n";
    echo "Branch defines which branch to check out, targetname defines the directory in docs the generated files should go to\n";
    exit(1);
}

try {

    function generateApiClassesReference($rootDir, $versionName, $longVersionName)
    {
        $iterator = Finder::create()
            ->files()
            ->name('*.php')
            ->notName('tcpdf_config.php')
            ->exclude(array('tests', 'config', 'ScheduledReports/config'))
            ->in(array(PIWIK_DOCUMENT_ROOT . '/core',
                       PIWIK_DOCUMENT_ROOT . '/plugins',
                       PIWIK_DOCUMENT_ROOT . '/vendor/piwik/piwik-php-tracker'))
        ;

        $sami = new Sami($iterator, array(
            'theme'                => 'markdown',
            'versions'             => $versionName,
            'title'                => 'Piwik Plugin API',
            'build_dir'            => $rootDir.'/docs/' . $longVersionName . '/generated/',
            'cache_dir'            => $rootDir.'/docs/' . $longVersionName . '/cache/',
            'template_dirs'        => array($rootDir.'/generator/template'),
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

        $sami['project']->update();

        return $sami;
    }

    function generateHooksReference($rootDir, $versionName, $versionLongName, $sami)
    {
        $target   = $rootDir . '/docs/' . $versionLongName . '/generated/Hooks.md';
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

    /** @var $versions GitVersionCollection */
    $versions = GitVersionCollection::create(PIWIK_DOCUMENT_ROOT)
        ->add($branch, $targetName);
    // we cannot add multiple versions here. Why? Because we load all Piwik classes when generating docs for the
    // first version. In the next step we would checkout another branch and load several files again but because some
    // files were already included once it would not redefine some classes. Eg it would use an old "ViewDataTable"
    // class from Piwik 2 and use it for a plugin from Piwik 3 (class from previous branch would be used in current
    // branch). Instead we force to parse arguments to generate docs.

    $versions->rewind();
    while ($versions->valid()) {
        $version = $versions->current();
        passthru(PHP_BINARY . ' ' . $rootDir . '/generator/composer.phar install --working-dir "' . $rootDir . '/piwik" || true');
        $sami    = generateApiClassesReference($rootDir, $version->getName(), $version->getLongName());
        generateHooksReference($rootDir, $version->getName(), $version->getLongName(), $sami);
        $versions->next();
    }

} catch (Exception $e) {
    echo 'Parse Error: ', $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString();
}

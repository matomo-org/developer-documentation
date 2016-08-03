<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

require '../vendor/autoload.php';
if (file_exists('../config/local.php')) {
    require '../config/local.php';
}
require '../config/app.php';

use Slim\Slim;
use Slim\Views\Twig as Twig;
use helpers\Log;
use helpers\CacheMiddleware;

date_default_timezone_set("UTC");
$twig = new Twig();

// New Slim App
$app = new Slim(array(
    'view' => $twig,
    'log.enabled' => true,
    'debug'       => DEBUG,
    'templates.path' => '../templates',
    'templates.cache' => realpath('../tmp/templates'),
    'templates.charset' => 'utf-8',
    'templates.auto_reload' => true,
    'templates.autoescape' => true,
    'log.writer'  => new \Slim\Extras\Log\DateTimeFileWriter(
        array('path' => realpath('../tmp/logs'), 'name_format' => 'Y-m-d')
    )
));
$app->add(new CacheMiddleware());
$environment = $app->environment;

// we match eg /2.x or /3.x /19.x and remove it from the path so our routes in routes/page.php still match.
// Instead of changing the path I wanted to add a group around all routes in page but slim 2 doesn't allow us to define
// a condition on a group route unfortunately
if (preg_match('/\/(\d)+\.x(\/)?/', $environment['PATH_INFO'], $matches)) {
    if ($matches[1] < LATEST_PIWIK_DOCS_VERSION) {
        // we only allow usage of 2.x or 3.x for outdated Piwik versions. Latest will be always only / whereas older versions
        // will be /2.x . Once Piwik 4 is available, it will also work for '/2.x' and '/3.x'
        \helpers\Environment::setPiwikVersion($matches[1]);
        \helpers\Environment::setUrlPrefix('/' . $matches[1] . '.x');
        $environment['PATH_INFO'] = substr($environment['PATH_INFO'], strlen('/' . $matches[1] . '.x'));
    }
}

$app->error(function (\Exception $e) use ($app) {
    Log::error('An unhandled exception occurred: ' . $e->getMessage() . $e->getTraceAsString());

    $app->response()->status(500);
});

$app->setName('developer.piwik.org');
$log = $app->getLog();
$log->setEnabled(true);

helpers\Twig::registerFilter($app->view->getInstance());

require '../routes/page.php';

$app->run();

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
use helpers\PiwikVersionMiddleware;

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
$app->add(new PiwikVersionMiddleware());
$app->add(new CacheMiddleware());

$app->error(function (\Exception $e) use ($app) {
    Log::error('An unhandled exception occurred: ' . $e->getMessage() . $e->getTraceAsString());

    $app->response()->status(500);
});

$app->setName('developer.matomo.org');
$log = $app->getLog();
$log->setEnabled(true);

helpers\Twig::registerFilter($app->view->getInstance());

require '../routes/page.php';

$app->run();

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

use helpers\Environment;
use helpers\Git;

//use helpers\CacheMiddleware;
//use helpers\PiwikVersionMiddleware;
use helpers\Url;
use Monolog\ErrorHandler;

date_default_timezone_set("UTC");

$config = [
    'settings' => [
        'displayErrorDetails' => DEBUG,
    ],
];

$app = new \Slim\App($config);

//// New Slim App
//$app = new Slim(array(
//    'view' => $twig,
//    'log.enabled' => true,
//    'debug'       => DEBUG,
//    'templates.path' => '../templates',
//    'templates.cache' => realpath('../tmp/templates'),
//    'templates.charset' => 'utf-8',
//    'templates.auto_reload' => true,
//    'templates.autoescape' => true,
//    'log.writer'  => new \Slim\Extras\Log\DateTimeFileWriter(
//        array('path' => realpath('../tmp/logs'), 'name_format' => 'Y-m-d')
//    )
//));
//$app->add(new PiwikVersionMiddleware());
//$app->add(new CacheMiddleware());

//$app->error(function (\Exception $e) use ($app) {
//    Log::error('An unhandled exception occurred: ' . $e->getMessage() . $e->getTraceAsString());
//
//    $app->response()->status(500);
//});

//$log = $app->getLog();
//$log->setEnabled(true);

// Get container
$container = $app->getContainer();
// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(realpath("../templates/"), [
        'cache' => realpath('../tmp/templates'),
        'debug' => DEBUG
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new \Twig_Extension_Debug());
    $twig = $view->getEnvironment();
    helpers\Twig::registerFilter($twig);

    $view->getEnvironment()->addGlobal('urlIfAvailableInNewerVersion', false);
    $view->getEnvironment()->addGlobal('availablePiwikVersions', Environment::getAvailablePiwikVersions());
    $view->getEnvironment()->addGlobal('selectedPiwikVersion', Environment::getPiwikVersion());
    $view->getEnvironment()->addGlobal('latestPiwikDocsVersion', LATEST_PIWIK_DOCS_VERSION);
    $view->getEnvironment()->addGlobal('revision', Git::getCurrentShortRevision());
//    $view->getEnvironment()->addGlobal('currentPath', $app->request->getPathInfo());

    return $view;
};

$container['logger'] = function ($c) {
    $logger = new \Monolog\Logger('site-logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../tmp/logs/app.log', \Monolog\Logger::DEBUG);
    $logger->pushHandler($file_handler);
    ErrorHandler::register($logger);
    return $logger;
};
$container['errorHandler'] = function ($c) {
    return function (Slim\Http\Request $request, Slim\Http\Response $response, Slim\Exception\SlimException $exception) use ($c) {
        /** @var \Monolog\Logger $logger */
        $logger = $c->logger;
        $logger->addError('An unhandled exception occurred: ' . $exception->getMessage(), $exception->getTraceAsString());

        return $response->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!');
    };
};

//Override the default Not Found Handler
$container['notFoundHandler'] = function ($c) {
    return function (Slim\Http\Request $request, Slim\Http\Response $response) use ($c) {
        /** @var \Monolog\Logger $logger */
        $logger = $c->logger;
        $logger->addInfo('Site not found', [
            "path" => (string)$request->getUri()
        ]);

        $alternativeUrls = array();
        foreach (Environment::getAvailablePiwikVersions() as $piwikVersion) {
            if ($piwikVersion != Environment::getPiwikVersion()) {
                $url = Url::getUrlIfDocumentIsAvailableInPiwikVersion($request->getUri()->getPath(), $piwikVersion);
                if (!empty($url)) {
                    $alternativeUrls[] = $url;
                }
            }
        }
        return $c->view->render($response->withStatus(404), '404.twig', [
            "alternativeUrls" => $alternativeUrls
        ]);
    };
};
$app->add(new \helpers\CacheMiddleware());
$app->add(new \helpers\PiwikVersionMiddleware());

require '../routes/page.php';

$app->run();

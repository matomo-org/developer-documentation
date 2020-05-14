<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use DI\Container;
use helpers\CacheMiddleware;
use helpers\Environment;
use helpers\Git;
use helpers\MatomoVersionMiddleware;
use helpers\Url;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
use Slim\Middleware\ContentLengthMiddleware;
use Slim\Psr7\Response;
use Slim\Views\Twig;

require '../vendor/autoload.php';
if (file_exists('../config/local.php')) {
    require '../config/local.php';
}
require '../config/app.php';


date_default_timezone_set("UTC");

// Create Container
$container = new Container();
AppFactory::setContainer($container);

// Set view in Container
$container->set('view', function () {
    $view = Twig::create('../templates', ['cache' => '../tmp/templates']);
    $view->getEnvironment()->addGlobal('urlIfAvailableInNewerVersion', false);
    $view->getEnvironment()->addGlobal('availablePiwikVersions', Environment::getAvailablePiwikVersions());
    $view->getEnvironment()->addGlobal('selectedPiwikVersion', Environment::getPiwikVersion());
    $view->getEnvironment()->addGlobal('latestPiwikDocsVersion', LATEST_PIWIK_DOCS_VERSION);
    $view->getEnvironment()->addGlobal('revision', Git::getCurrentShortRevision());
    return $view;
});

$app = AppFactory::create();

helpers\Twig::registerFilter($container->get("view")->getEnvironment());

$app->add(new MatomoVersionMiddleware());
$app->add(new CacheMiddleware());

$routeCollector = $app->getRouteCollector();
if (!DEBUG) {
    $routeCollector->setCacheFile('../tmp/cache/route_cache.php');
}

$contentLengthMiddleware = new ContentLengthMiddleware();
$app->add($contentLengthMiddleware);

$errorMiddleware = $app->addErrorMiddleware(DEBUG, true, true);
$errorMiddleware->setErrorHandler(
    HttpNotFoundException::class,
    function (ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails) {
        $response = new Response();


        $alternativeUrls = array();
        foreach (Environment::getAvailablePiwikVersions() as $piwikVersion) {
            if ($piwikVersion != Environment::getPiwikVersion()) {
                $url = Url::getUrlIfDocumentIsAvailableInPiwikVersion($request->getUri()->getPath(), $piwikVersion);
                if (!empty($url)) {
                    $alternativeUrls[] = $url;
                }
            }
        }
        return $this->get("view")->render($response->withStatus(404), '404.twig', [
            "alternativeUrls" => $alternativeUrls
        ]);
    });

require '../routes/page.php';

$app->run();

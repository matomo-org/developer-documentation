<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use helpers\Cache;
use helpers\Content\ApiReferenceGuide;
use helpers\Content\Category\ApiReferenceCategory;
use helpers\Content\Category\Category;
use helpers\Content\Category\CategoryList;
use helpers\Content\Category\ChangelogCategory;
use helpers\Content\Category\DesignCategory;
use helpers\Content\Category\DevelopCategory;
use helpers\Content\Category\DevelopInDepthCategory;
use helpers\Content\Category\IntegrateCategory;
use helpers\Content\Category\SupportCategory;
use helpers\Content\Category\TracTicketArchiveCategory;
use helpers\Content\Guide;
use helpers\Content\PhpDoc;
use helpers\DocumentNotExistException;
use helpers\Environment;
use helpers\Redirects;
use helpers\SearchIndex;
use helpers\Url;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;


function renderGuide(Slim\Views\Twig $view, Response $response, Psr\Http\Message\UriInterface $uri, Guide $guide, Category $category)
{
    return $view->render($response, 'guide.twig', [
        'category' => $category,
        'guide' => $guide,
        'linkToEditDocument' => $guide->linkToEdit(),
        'activeMenu' => $category->getName(),
        'currentPath' => $uri->getPath(),
        'selectedPiwikVersion' => Environment::getPiwikVersion(),
        'urlIfAvailableInNewerVersion' => (Environment::isLatestPiwikVersion() ? false : Url::getUrlIfDocumentIsAvailableInPiwikVersion($uri->getPath(), LATEST_PIWIK_DOCS_VERSION))
    ]);
}


// Redirects
foreach (Redirects::getRedirects() as $url => $redirect) {
    $app->get($url, function (Request $request, Response $response, $args) use ($redirect) {
        return $response->withStatus(301)->withHeader('Location', $redirect);
    });
}


$app->get('/', function (Request $request, Response $response, $args) {
    return $this->get("view")->render($response, 'home.twig', ['isHome' => true]);
});

$app->get('/guides/{name1}/{name2}', function (Request $request, Response $response, $args) {
    try {
        $guide = new Guide($args["name1"] . '/' . $args["name2"]);
    } catch (DocumentNotExistException $e) {
        throw new HttpNotFoundException($request);
    }
    $category = CategoryList::getCategory($guide->getCategory());

    return renderGuide($this->get("view"), $response, $request->getUri(), $guide, $category);
});

$app->get('/guides/{name}', function (Request $request, Response $response, $args) {
    try {
        $guide = new Guide($args["name"]);
    } catch (DocumentNotExistException $e) {
        throw new HttpNotFoundException($request);
    }
    $category = CategoryList::getCategory($guide->getCategory());

    return renderGuide($this->get("view"), $response, $request->getUri(), $guide, $category);
});


$app->get('/integration', function (Request $request, Response $response, $args) {
    $category = new IntegrateCategory();
    return renderGuide($this->get("view"), $response, $request->getUri(), $category->getIntroGuide(), $category);
});

$app->get('/design', function (Request $request, Response $response, $args) {
    $category = new DesignCategory();
    return renderGuide($this->get("view"), $response, $request->getUri(), $category->getIntroGuide(), $category);
});

$app->get('/develop', function (Request $request, Response $response, $args) {
    $category = new DevelopCategory();
    return renderGuide($this->get("view"), $response, $request->getUri(), $category->getIntroGuide(), $category);
});

$app->get('/piwik-in-depth', function (Request $request, Response $response, $args) {
    $category = new DevelopInDepthCategory();
    return renderGuide($this->get("view"), $response, $request->getUri(), $category->getIntroGuide(), $category);
});


$app->get('/api-reference/Piwik/[{params:.*}]', function (Request $request, Response $response, $args) {
    $paramArray = explode("/", $request->getAttribute('params'));
    if (!ctype_alnum(implode('', $paramArray))) {
        throw new HttpNotFoundException($request);
    }

    $file = 'Piwik/' . $request->getAttribute('params');

    try {
        $doc = new PhpDoc($file, $file);
    } catch (DocumentNotExistException $e) {
        throw new HttpNotFoundException($request);
    }
    return renderGuide($this->get("view"), $response, $request->getUri(), $doc, new ApiReferenceCategory());
});

$app->get('/api-reference/classes', function (Request $request, Response $response, $args) {
    return renderGuide($this->get("view"), $response, $request->getUri(), new PhpDoc('Classes', 'classes'), new ApiReferenceCategory());
});
$app->get('/api-reference/events', function (Request $request, Response $response, $args) {
    return renderGuide($this->get("view"), $response, $request->getUri(), new PhpDoc('Hooks', 'events'), new ApiReferenceCategory());
});

$app->get('/api-reference/index', function (Request $request, Response $response, $args) {
    return renderGuide($this->get("view"), $response, $request->getUri(), new PhpDoc('Index', 'index'), new ApiReferenceCategory());
});

$app->get('/api-reference/PHP-Matomo-Tracker', function (Request $request, Response $response, $args) {

    $matomoTracker = 'MatomoTracker';
    if (Environment::getPiwikVersion() <= 3) {
        $matomoTracker = 'PiwikTracker';
    }
    return renderGuide($this->get("view"), $response, $request->getUri(), new PhpDoc($matomoTracker, 'PHP-Matomo-Tracker'), new ApiReferenceCategory());
});

$app->group('/openapi', function (\Slim\Routing\RouteCollectorProxy $group) {
    $group->get('/docs', function (Request $request, Response $response, array $args) {
        $isEmbedded = $request->getQueryParams()['embedded'] ?? false;
        return $this->get('view')->render($response, 'swagger-ui.twig', [
            'embedded' => !in_array($isEmbedded, ['false', '0']),
        ]);
    });

    $group->get('/spec', function (Request $request, Response $response, array $args) {
        $format = strtolower($request->getQueryParams()['format'] ?? 'json');
        if ($format !== 'json') {
            throw new \Slim\Exception\HttpBadRequestException($request, 'Unsupported response format: ' . $format);
        }

        // Load the JSON OpenAPI spec file
        $response->getBody()->write(file_get_contents(__DIR__ . '/../openapi/demo_matomo_spec_v1.0.0.json'));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });

    $group->get('/source/{file}', function (Request $request, Response $response, array $args) {
        $fileName = $args['file'];

        // Allow only whitelisted source files from the swagger-ui dist/ directory
        if (!in_array($fileName, ['swagger-ui.css', 'swagger-ui-bundle.js', 'swagger-ui-standalone-preset.js'])) {
            throw new HttpNotFoundException($request);
        }

        $json = file_get_contents(__DIR__ . '/../vendor/swagger-api/swagger-ui/dist/' . $fileName);
        $response->getBody()->write($json);
        $contentType = pathinfo($fileName, PATHINFO_EXTENSION) === 'js' ? 'text/javascript' : 'text/css';
        return $response->withHeader('Content-Type', $contentType)
            ->withStatus(200);
    });
})->add(function (Request $request, \Psr\Http\Server\RequestHandlerInterface $handler) {
    // Only allow OpenAPI endpoints for Matomo 5 or greater
    if (Environment::getPiwikVersion() < 5) {
        throw new HttpNotFoundException($request, 'This is only supported in Matomo version 5 or higher.');
    }

    return $handler->handle($request);
});

$app->get('/api-reference/{reference1}/{reference2}', function (Request $request, Response $response, $args) {
    try {
        $guide = new ApiReferenceGuide($args["reference1"] . '/' . $args["reference2"]);
    } catch (DocumentNotExistException $e) {
        throw new \Slim\Exception\HttpNotFoundException($request);
    }
    return renderGuide($this->get("view"), $response, $request->getUri(), $guide, new ApiReferenceCategory());
});

$app->get('/api-reference/{reference}', function (Request $request, Response $response, $args) {

    try {
        $guide = new ApiReferenceGuide($args["reference"]);
    } catch (DocumentNotExistException $e) {
        throw new HttpNotFoundException($request);
    }
    return renderGuide($this->get("view"), $response, $request->getUri(), $guide, new ApiReferenceCategory());
});
$app->get('/api-reference', function (Request $request, Response $response, $args) {
    $category = new ApiReferenceCategory();
    return renderGuide($this->get("view"), $response, $request->getUri(), $category->getIntroGuide(), $category);
});

$app->get('/support', function (Request $request, Response $response, $args) {
    $category = new SupportCategory();
    return renderGuide($this->get("view"), $response, $request->getUri(), $category->getIntroGuide(), $category);
});

$app->get('/trac-ticket-archive', function (Request $request, Response $response, $args) {
    $category = new TracTicketArchiveCategory();
    return renderGuide($this->get("view"), $response, $request->getUri(), $category->getIntroGuide(), $category);
});

$app->get('/trac/ticket/{id}', function (Request $request, Response $response, $args) {
    return $response->withStatus(301)->withHeader('Location', '/trac-ticket-archive');
});

$app->get('/changelog', function (Request $request, Response $response, $args) {
    $fetchContent = false;
    $piwikVersion = Environment::getPiwikVersion();
    $targetFile = '../../docs/changelog-'.$piwikVersion.'x.md';

    if (!file_exists($targetFile)) {
        $fetchContent = true;
    } else {
        $lastModified = filemtime($targetFile);
        $invalidateAfterSeconds = 60 * 60 * 4; // invalidate every 4 hours
        if (time() - $lastModified > $invalidateAfterSeconds) {
            $fetchContent = true;
        }
    }
    if ($fetchContent) {
        $markdown = file_get_contents('https://raw.githubusercontent.com/piwik/piwik/'.$piwikVersion.'.x-dev/CHANGELOG.md');
        if ($markdown === false) {
            throw new \Exception("Could not fetch changelog");
        }
        file_put_contents($targetFile, $markdown);
    }

    $category = new ChangelogCategory();
    return renderGuide($this->get("view"), $response, $request->getUri(), $category->getIntroGuide(), $category);
});

$app->get('/data/documents', function (Request $request, Response $response, $args) {
    $searchIndex = new SearchIndex();
    $index = $searchIndex->buildIndex();
    $response->getBody()->write(json_encode([
        'urls' => array_keys($index),
        'names' => array_values($index),
    ]));
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->post('/receive-commit-hook', function (Request $request, Response $response, $args) {
    $params = $request->getQueryParams();
    if (empty($params["token"]) || !password_verify($params["token"], WEBHOOK_TOKEN)) {
        $response->getBody()->write("parameter 'token' missing or incorrect");
        return $response->withStatus(403);
    }

    system('git pull origin live');

    Cache::invalidate();
    Cache::invalidate_Twig_Cache();

    $response->getBody()->write("Here is a cookie!");
    return $response->withHeader('Content-Type', 'text/plain');
});

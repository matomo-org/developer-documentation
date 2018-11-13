<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use helpers\Content\ApiReferenceGuide;
use helpers\Content\Category\Category;
use helpers\Content\Category\CategoryList;
use helpers\Content\Category\ChangelogCategory;
use helpers\Content\Category\DesignCategory;
use helpers\Content\Category\DevelopCategory;
use helpers\Content\Category\DevelopInDepthCategory;
use helpers\Content\Guide;
use helpers\Content\PhpDoc;
use helpers\Content\Category\IntegrateCategory;
use helpers\Content\Category\ApiReferenceCategory;
use helpers\Redirects;
use helpers\SearchIndex;
use helpers\Content\Category\SupportCategory;
use helpers\DocumentNotExistException;
use helpers\Git;
use helpers\Environment;
use Slim\Slim;

function send404NotFound(Slim $app) {
    $app->pass();
}

function initView($app)
{
    $app->hook('slim.before.dispatch', function () use ($app) {
        $app->view->setData('urlIfAvailableInNewerVersion', false);
        $availableVersions = Environment::getAvailablePiwikVersions();

        if (!Environment::isLatestPiwikVersion()) {
            $matomoVersion = Environment::getPiwikVersion();
            $alternativeUrl = getUrlIfDocumentIsAvailableInPiwikVersion($app, LATEST_PIWIK_DOCS_VERSION);

            if (in_array($matomoVersion, $availableVersions)) {
                $app->view->setData('urlIfAvailableInNewerVersion', $alternativeUrl);
            } else {
                // redirect to newest version
                //$app->response->redirect($alternativeUrl, 301);
                // exit;
                $app->view->setData('urlIfAvailableInNewerVersion', $alternativeUrl);
            }
        }

        $app->view->setData('availablePiwikVersions', $availableVersions);
        $app->view->setData('selectedPiwikVersion', Environment::getPiwikVersion());
        $app->view->setData('latestPiwikDocsVersion', LATEST_PIWIK_DOCS_VERSION);
        $app->view->setData('revision', Git::getCurrentShortRevision());
        $app->view->setData('currentPath', $app->request->getPathInfo());
    });
}

function renderGuide(Slim $app, Guide $guide, Category $category)
{
    $app->render('guide.twig', [
        'category'           => $category,
        'guide'              => $guide,
        'linkToEditDocument' => $guide->linkToEdit(),
        'activeMenu'         => $category->getName(),
    ]);
}

initView($app);

function getUrlIfDocumentIsAvailableInPiwikVersion($app, $piwikVersion)
{
    $currentPiwikVersion = Environment::getPiwikVersion();

    // we now work in context of that piwik version
    Environment::setPiwikVersion($piwikVersion);

    $path = $app->request->getPath();
    $url = '';

    if ($path === '/' || $path === '') {
        $url = '/';
    }
    if (empty($url)) {
        if (strpos($path, '/guides/') !== false) {
            try {
                // we check if the requested resource maybe exists for another Piwik version
                $guide = new Guide(str_replace('/guides/', '', $path));
                $url = Environment::completeUrl($guide->getMenuUrl());
            } catch (DocumentNotExistException $e) {}
        }
    }

    if (empty($url)) {
        if (strpos($path, '/api-reference/') !== false) {

            try {
                $replaced = str_replace('/api-reference/', '', $path);
                // we check if the requested resource maybe exists for another Piwik version
                $guide = new ApiReferenceGuide( $replaced );
                $url = Environment::completeUrl($guide->getMenuUrl());
            } catch (DocumentNotExistException $e) {
            }

            try {
                $replaced = str_replace('/api-reference/', '', $path);
                // we check if the requested resource maybe exists for another Piwik version
                $phpdoc = new PhpDoc($replaced, $replaced);
                $url = Environment::completeUrl($phpdoc->getMenuUrl());
            } catch (DocumentNotExistException $e) {
            }
        }
    }

    if (empty($url)) {
        /** @var \helpers\Content\MenuItem[] $categories */
        $categories = [
            new IntegrateCategory(),
            new DevelopCategory(),
            new DesignCategory(),
            new ApiReferenceCategory(),
            new DevelopInDepthCategory()
        ];

        foreach ($categories as $category) {
            if ($path === $category->getMenuUrl() ) {
                $url = $path;
                break;
            }
        }
    }
    
    Environment::setPiwikVersion($currentPiwikVersion);

    return $url;
}

$app->notFound(function () use ($app) {
    $alternativeUrls = array();
    foreach (Environment::getAvailablePiwikVersions() as $piwikVersion) {
        if ($piwikVersion != Environment::getPiwikVersion()) {
            $url = getUrlIfDocumentIsAvailableInPiwikVersion($app, $piwikVersion);
            if (!empty($url)) {
                $alternativeUrls[] = $url;
            }
        }
    }
    $app->view->setData('alternativeUrls', $alternativeUrls);

    $app->render('404.twig');
});

// Redirects
foreach (Redirects::getRedirects() as $url => $redirect) {
    $app->get($url, function () use ($app, $redirect) {
        $app->redirect($redirect, 301);
    });
}

$app->get('(/)', function () use ($app) {
    $app->render('home.twig', ['isHome' => true]);
});

$app->get('/guides/:name1/:name2(/)', function ($name1, $name2) use ($app) {
    try {
        $guide = new Guide($name1 . '/' . $name2);
    } catch (DocumentNotExistException $e) {
        send404NotFound($app);
        return;
    }
    $category = CategoryList::getCategory($guide->getCategory());

    renderGuide($app, $guide, $category);
});

$app->get('/guides/:name(/)', function ($name) use ($app) {
    try {
        $guide = new Guide($name);
    } catch (DocumentNotExistException $e) {
        send404NotFound($app);
        return;
    }
    $category = CategoryList::getCategory($guide->getCategory());

    renderGuide($app, $guide, $category);
});

$app->get('/integration', function () use ($app) {
    $category = new IntegrateCategory();
    renderGuide($app, $category->getIntroGuide(), $category);
});

$app->get('/design', function () use ($app) {
    $category = new DesignCategory();
    renderGuide($app, $category->getIntroGuide(), $category);
});

$app->get('/develop', function () use ($app) {
    $category = new DevelopCategory();
    renderGuide($app, $category->getIntroGuide(), $category);
});

$app->get('/piwik-in-depth', function () use ($app) {
    $category = new DevelopInDepthCategory();
    renderGuide($app, $category->getIntroGuide(), $category);
});

$app->get('/api-reference/Piwik/:names+', function ($names) use ($app) {
    if (! ctype_alnum(implode('', $names))) {
        send404NotFound($app);
        return;
    }

    $names = array_filter($names);
    $file = 'Piwik/' . implode('/', $names);

    try {
        $doc = new PhpDoc($file, $file);
    } catch (DocumentNotExistException $e) {
        send404NotFound($app);
        return;
    }

    renderGuide($app, $doc, new ApiReferenceCategory());
});

$app->get('/api-reference/classes', function () use ($app) {
    renderGuide($app, new PhpDoc('Classes', 'classes'), new ApiReferenceCategory());
});
$app->get('/api-reference/events', function () use ($app) {
    renderGuide($app, new PhpDoc('Hooks', 'events'), new ApiReferenceCategory());
});
$app->get('/api-reference/index', function () use ($app) {
    renderGuide($app, new PhpDoc('Index', 'index'), new ApiReferenceCategory());
});
$app->get('/api-reference/PHP-Piwik-Tracker', function () use ($app) {
    renderGuide($app, new PhpDoc('PiwikTracker', 'PHP-Piwik-Tracker'), new ApiReferenceCategory());
});

$app->get('/api-reference/:reference1/:reference2', function ($reference1, $reference2) use ($app) {

    try {
        $guide = new ApiReferenceGuide($reference1 . '/' . $reference2);
    } catch (DocumentNotExistException $e) {
        send404NotFound($app);
        return;
    }

    renderGuide($app, $guide, new ApiReferenceCategory());
});

$app->get('/api-reference/:reference', function ($reference) use ($app) {

    try {
        $guide = new ApiReferenceGuide($reference);
    } catch (DocumentNotExistException $e) {
        send404NotFound($app);
        return;
    }

    renderGuide($app, $guide, new ApiReferenceCategory());

});

$app->get('/api-reference', function () use ($app) {
    $category = new ApiReferenceCategory();
    renderGuide($app, $category->getIntroGuide(), $category);
});

$app->get('/support', function () use ($app) {
    $category = new SupportCategory();
    renderGuide($app, $category->getIntroGuide(), $category);
});

$app->get('/changelog', function () use ($app) {
    $fetchContent = false;
    $targetFile   = '../../docs/changelog.md';

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
        $markdown = file_get_contents('https://raw.githubusercontent.com/piwik/piwik/3.x-dev/CHANGELOG.md');
        file_put_contents($targetFile, $markdown);
    }

    $category = new ChangelogCategory();
    renderGuide($app, $category->getIntroGuide(), $category);
});

$app->get('/data/documents', function () use ($app) {
    $searchIndex = new SearchIndex();
    $index = $searchIndex->buildIndex();
    echo json_encode([
        'urls' => array_keys($index),
        'names' => array_values($index)
    ], JSON_PRETTY_PRINT);
});

$app->post('/receive-commit-hook', function () use ($app) {
    system('git pull');
    \helpers\Cache::invalidate();

    echo 'Here is a cookie!';
    exit;
});

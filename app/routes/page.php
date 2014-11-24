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
use helpers\Content\Guide;
use helpers\Content\PhpDoc;
use helpers\Home;
use helpers\Content\Category\IntegrateCategory;
use helpers\Content\Category\ApiReferenceCategory;
use helpers\Redirects;
use helpers\SearchIndex;
use helpers\Content\Category\SupportCategory;
use helpers\DocumentNotExistException;
use helpers\Git;
use Slim\Slim;

function send404NotFound(Slim $app) {
    $app->pass();
}

function initView($app)
{
    $path          = $app->request->getPath();
    $activeSection = Home::getMenuItemByUrl($path);

    $app->view->setData('menu', Home::getMainMenu());
    $app->view->setData('path', $path);
    $app->view->setData('revision', Git::getCurrentShortRevision());

    if (!empty($activeSection['title'])) {
        $app->view->setData('activeCategory', $activeSection['title']);
        $app->view->setData('activeMenu', $activeSection['title']);
    }
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

$app->notFound(function () use ($app) {
    $app->render('404.twig');
});

// Redirects
foreach (Redirects::getRedirects() as $url => $redirect) {
    $app->get($url, function () use ($app, $redirect) {
        $app->redirect($redirect, 301);
    });
}

$app->get('/', function () use ($app) {
    $app->view->setData('home', Home::getMainMenu());
    $app->render('home.twig', ['isHome' => true]);
});

$app->get('/guides/:name', function ($name) use ($app) {
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

$app->get('/api-reference/:reference', function ($reference) use ($app) {
    renderGuide($app, new ApiReferenceGuide($reference), new ApiReferenceCategory());
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
        $markdown = file_get_contents('https://raw.githubusercontent.com/piwik/piwik/master/CHANGELOG.md');
        file_put_contents($targetFile, $markdown);
    }

    renderGuide($app, new Guide('changelog'), new ChangelogCategory());
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

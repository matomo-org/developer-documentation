<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use helpers\Home;
use helpers\Guide;
use helpers\Document;
use helpers\ApiReference;
use helpers\Support;
use helpers\DocumentNotExistException;
use helpers\Git;

function send404NotFound($app) {
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

initView($app);

$app->get('/', function () use ($app) {

    $app->render('index.twig', array('isHome' => true));
});

$app->get('/api-reference/:reference', function ($reference) use ($app) {
    $reference = ApiReference::getMenuItemByUrl('/api-reference/' . $reference);

    if (empty($reference)) {
        send404NotFound($app);
        return;
    }

    try {
        $doc = new Document($reference['file']);
    } catch (DocumentNotExistException $e) {
        send404NotFound($app);
        return;
    }

    $app->render('layout/documentation.twig', array(
        'doc'          => $doc->getRenderedContent(),
        'sections'     => $doc->getSections(),
        'sectionTitle' => $doc->getTitle(),
        'categories'   => ApiReference::getReferencesMenu()
    ));

});

$app->get('/api-reference/:names+', function ($names) use ($app) {
    if (!ctype_alnum(implode('', $names))) {
        send404NotFound($app);
        return;
    }

    $names     = array_filter($names);
    $className = implode('\\', $names);

    $file = implode('/', $names);

    if ('Piwik/' != substr($file, 0, 6)) {
        $file = 'Piwik/' . $file;
    }

    $file = 'generated/master/' . $file;

    try {
        $doc = new Document($file);
    } catch (DocumentNotExistException $e) {
        send404NotFound($app);
        return;
    }

    $app->render('layout/documentation.twig', array(
        'activeCategory' => 'Classes',
        'doc'            => $doc->getRenderedContent(),
        'sections'       => $doc->getSections(),
        'sectionTitle'   => $className,
        'categories'     => ApiReference::getClassesMenu()
    ));
});

$app->get('/guides/:category', function ($category) use ($app) {

    $guide = Guide::getMenuItemByUrl('/guides/' . $category);

    if (empty($guide)) {
        send404NotFound($app);
        return;
    }

    try {
        $doc = new Document($guide['file']);
    } catch (DocumentNotExistException $e) {
        send404NotFound($app);
        return;
    }

    $mainMenu = Guide::getMainMenu();
    $thisMenuItem = null;
    foreach ($mainMenu as $itemCategory => $items) {
        foreach ($items as $item) {
            if ($item['file'] == $category) {
                $thisMenuItem = $item;
                break;
            }
        }
    }

    $app->render('layout/documentation.twig', array(
        'doc'          => $doc->getRenderedContent(),
        'sections'     => $doc->getSections(),
        'sectionTitle' => $doc->getTitle(),
        'categories'   => $mainMenu,
        'linkToEditDocument' => $doc->linkToEditDocument(),
        'thisItem'     => $thisMenuItem
    ));
});

$app->get('/guides', function () use ($app) {

    $app->render('documentation.twig', array(
        'guides' => Guide::getMainMenu(),
        'categorized' => true,
        'noContainer' => true
    ));
});

$app->get('/api-reference', function () use ($app) {
    $references = ApiReference::getReferencesMenu();

    $app->render('apireference.twig', array(
        'references' => $references,
        'categorized' => true,
        'noContainer' => true
    ));
});

$app->get('/support', function () use ($app) {

    $app->render('support.twig', array(
        'supports' => Support::getMainMenu()
    ));
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

    $document = new Document('changelog');
    $content  = $document->getRenderedContent();
    $content  = preg_replace('/<h1(.*?)<\/h1>/', '', $content);

    $app->render('changelog.twig', array(
        'changelog' => $content,
        'title' => $document->getTitle(),
        'linkToEditDocument' => 'https://github.com/piwik/piwik/blob/master/CHANGELOG.md'
    ));
});

$app->get('/data/documents.json', function () use ($app) {
    $documentsMap = array_merge(Guide::getDocumentList(), ApiReference::getDocumentList());
    $documentsData = array(
        'urls' => array_keys($documentsMap),
        'names' => array_values($documentsMap)
    );

    echo json_encode($documentsData);
});

$app->post('/receive-commit-hook', function () use ($app) {

    system('git pull');
    \helpers\Cache::invalidate();

    echo 'Here is a cookie!';
    exit;
});

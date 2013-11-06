<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use helpers\Menu;
use helpers\Guide;
use helpers\Document;
use helpers\ApiReference;
use helpers\Support;
use helpers\DocumentNotExistException;

function send404NotFound($app) {
    $app->pass();
}

$app->view->setData('menu', Menu::getMainMenu());

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
        'activeMenu'   => 'api-reference',
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
    $className = implode('/', $names);

    $file = $className;
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
        'activeMenu'     => 'api-reference',
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

    $app->render('layout/documentation.twig', array(
        'activeMenu'   => 'guides',
        'doc'          => $doc->getRenderedContent(),
        'sections'     => $doc->getSections(),
        'sectionTitle' => $doc->getTitle(),
        'categories'   => Guide::getMainMenu()
    ));
});

$app->get('/guides', function () use ($app) {

    $app->render('documentation.twig', array(
        'activeMenu' => 'guides',
        'guides'     => Guide::getMainMenu()
    ));
});

$app->get('/api-reference', function () use ($app) {
    $references = ApiReference::getReferencesMenu();

    $app->render('apireference.twig', array(
        'references' => $references,
        'activeMenu' => 'api-reference'
    ));
});

$app->get('/support', function () use ($app) {

    $app->render('support.twig', array(
        'activeMenu' => 'support',
        'supports'   => Support::getMainMenu()
    ));
});

$app->post('/receive-commit-hook', function () use ($app) {

    system('git pull');
    \helpers\Cache::invalidate();

    echo 'Here is a cookie!';
    exit;
});

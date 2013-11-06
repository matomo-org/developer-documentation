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

$app->view->setData('menu', Menu::getMainMenu());

$app->get('/', function () use ($app) {

    $app->render('index.twig', array('isHome' => true));
});

$app->get('/guides', function () use ($app) {

    $app->render('documentation.twig', array(
        'activeMenu' => 'guides',
        'guides'     => Guide::getMainMenu()
    ));
});

$app->get('/support', function () use ($app) {

    $app->render('support.twig', array(
        'activeMenu' => 'support',
        'supports'   => Support::getMainMenu()
    ));
});

$app->get('/api-reference/:reference', function ($reference) use ($app) {
    $references = ApiReference::getReferences();
    $file       = $references[$reference]['file'];

    $doc = new Document($file);

    $app->render('layout/documentation.twig', array(
        'activeMenu'   => 'api-reference',
        'doc'          => $doc->getRenderedContent(),
        'sections'     => $doc->getSections(),
        'sectionTitle' => $doc->getTitle(),
        'categories'   => $references
    ));

})->conditions(array('reference' => '(' . implode('|', array_keys(ApiReference::getReferences())) . ')'));

$app->get('/api-reference/:names+', function ($names) use ($app) {

    $className = implode('/', $names);

    $file = $className;
    if ('Piwik/' != substr($file, 0, 6)) {
        $file = 'Piwik/' . $file;
    }

    $file = 'generated/master/' . $file;

    $doc  = new Document($file);

    $app->render('layout/documentation.twig', array(
        'activeMenu'     => 'api-reference',
        'activeCategory' => 'Classes',
        'doc'            => $doc->getRenderedContent(),
        'sections'       => $doc->getSections(),
        'sectionTitle'   => $className,
        'categories'     => ApiReference::getClassNames()
    ));

});

$app->get('/api-reference', function () use ($app) {
    $references = ApiReference::getReferences();

    $app->render('apireference.twig', array(
        'references' => $references,
        'activeMenu' => 'api-reference'
    ));
});

$app->get('/guides/:category', function ($category) use ($app) {

    $doc = new Document($category);

    $app->render('layout/documentation.twig', array(
        'activeMenu'   => 'guides',
        'doc'          => $doc->getRenderedContent(),
        'sections'     => $doc->getSections(),
        'sectionTitle' => $doc->getTitle(),
        'categories'   => Guide::getMainMenu()
    ));

})->conditions(array('category' => '(' . implode('|', array_keys(Guide::getMainMenu())) . ')'));
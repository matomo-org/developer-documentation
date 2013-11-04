<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use helpers\Menu;
use helpers\Guides;
use helpers\ApiReference;

$app->view->setData('menu', Menu::getMainMenu());

$app->get('/', function () use ($app) {

    $app->render('index.twig', array('isHome' => true));
});

$app->get('/guides', function () use ($app) {
    $guides = Guides::getMainMenu();

    $app->render('documentation.twig', array('guides' => $guides, 'activeMenu' => 'guides'));
});

$app->get('/support', function () use ($app) {

    $doc         = new Guides('support');
    $renderedDoc = $doc->getRenderedContent();

    $app->render('layout/base.twig', array(
        'content' => $renderedDoc,
        'activeMenu'  => 'support'
    ));
});

$app->get('/api-reference/:reference', function ($reference) use ($app) {
    $references = ApiReference::getReferences();
    $file       = $references[$reference]['file'];

    $doc = new Guides($file);

    $app->render('layout/documentation.twig', array(
        'activeMenu'  => 'api-reference',
        'doc'         => $doc->getRenderedContent(),
        'sections'    => $doc->getSections()
    ));

})->conditions(array('reference' => '(' . implode('|', array_keys(ApiReference::getReferences())) . ')'));

$app->get('/api-reference/:names+', function ($names) use ($app) {

    $file = implode('/', $names);

    if ('Piwik/' != substr($file, 0, 6)) {
        $file = 'Piwik/' . $file;
    }

    $file = 'generated/master/' . str_replace('.md', '', $file);

    $doc  = new Guides($file);

    $app->render('layout/documentation.twig', array(
        'activeMenu' => 'api-reference',
        'doc'        => $doc->getRenderedContent(),
        'sections'   => $doc->getSections()
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

    $doc         = new Guides($category);
    $renderedDoc = $doc->getRenderedContent();
    $subMenu     = $doc->getSections();

    $app->render('layout/documentation.twig', array(
        'doc'           => $renderedDoc,
        'activeMenu'    => 'guides',
        'sections'      => $subMenu
    ));

})->conditions(array('category' => '(' . implode('|', array_keys(Guides::getMainMenu())) . ')'));
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

$app->get('/', function () use ($app) {
    $menu = Menu::getMainMenu();

    $app->render('index.twig', array('menu' => $menu));
});

$app->get('/guides', function () use ($app) {
    $menu = Guides::getMainMenu();

    $app->render('documentation.twig', array('menu' => $menu));
});

$app->get('/hooks', function () use ($app) {

    $doc         = new Guides('generated/Hooks');
    $renderedDoc = $doc->getRenderedContent();

    $app->render('layout/base.twig', array('content' => $renderedDoc));
});

$app->get('/support', function () use ($app) {

    $doc         = new Guides('support');
    $renderedDoc = $doc->getRenderedContent();

    $app->render('layout/base.twig', array('content' => $renderedDoc));
});

$app->get('/api-reference/:reference', function ($reference) use ($app) {
    $references = ApiReference::getReferences();
    $file       = $references[$reference]['file'];

    $doc         = new Guides($file);
    $renderedDoc = $doc->getRenderedContent();

    $menu = ApiReference::getReferences();

    $app->render('layout/documentation.twig', array('doc' => $renderedDoc, 'menu' => $menu));

})->conditions(array('reference' => '(' . implode('|', array_keys(ApiReference::getReferences())) . ')'));

$app->get('/api-reference/:names+', function ($names) use ($app) {

    $file = implode('/', $names);
    $file = 'generated/master/' . str_replace('.md', '', $file);

    $doc         = new Guides($file);
    $renderedDoc = $doc->getRenderedContent();

    $menu = ApiReference::getReferences();

    $app->render('layout/documentation.twig', array('doc' => $renderedDoc, 'menu' => $menu));

});

$app->get('/api-reference', function () use ($app) {
    $references = ApiReference::getReferences();

    $app->render('apireference.twig', array('references' => $references));
});

$app->get('/guides/:category', function ($category) use ($app) {

    $doc         = new Guides($category);
    $renderedDoc = $doc->getRenderedContent();

    $mainMenu = Guides::getMainMenu();

    $app->render('layout/documentation.twig', array('doc' => $renderedDoc, 'menu' => $mainMenu));

})->conditions(array('category' => '(' . implode('|', array_keys(Guides::getMainMenu())) . ')'));
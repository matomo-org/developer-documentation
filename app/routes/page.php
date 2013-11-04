<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use helpers\Menu;
use helpers\Documentation;
use helpers\ApiReference;

$app->get('/', function () use ($app) {
    $menu = Menu::getMainMenu();

    $app->render('index.twig', array('menu' => $menu));
});

$app->get('/documentation', function () use ($app) {
    $menu = Documentation::getMainMenu();

    $app->render('documentation.twig', array('menu' => $menu));
});

$app->get('/hooks', function () use ($app) {

    $doc         = new Documentation('generated/Hooks');
    $renderedDoc = $doc->getRenderedContent();

    $app->render('layout/base.twig', array('content' => $renderedDoc));
});

$app->get('/support', function () use ($app) {

    $doc         = new Documentation('support');
    $renderedDoc = $doc->getRenderedContent();

    $app->render('layout/base.twig', array('content' => $renderedDoc));
});

$app->get('/api-reference/:reference', function ($reference) use ($app) {
    $references = ApiReference::getReferences();
    $file       = $references[$reference]['file'];

    $doc         = new Documentation($file);
    $renderedDoc = $doc->getRenderedContent();

    $menu = ApiReference::getReferences();

    $app->render('layout/documentation.twig', array('doc' => $renderedDoc, 'menu' => $menu));

})->conditions(array('reference' => '(' . implode('|', array_keys(ApiReference::getReferences())) . ')'));

$app->get('/api-reference', function () use ($app) {
    $references = ApiReference::getReferences();

    $app->render('apireference.twig', array('references' => $references));
});

$app->get('/:category', function ($category) use ($app) {

    $doc         = new Documentation($category);
    $renderedDoc = $doc->getRenderedContent();

    $mainMenu = Documentation::getMainMenu();

    $app->render('layout/documentation.twig', array('doc' => $renderedDoc, 'menu' => $mainMenu));

})->conditions(array('category' => '(' . implode('|', array_keys(Documentation::getMainMenu())) . ')'));
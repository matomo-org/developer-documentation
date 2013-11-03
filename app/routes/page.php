<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use helpers\Menu;
use helpers\Documentation;

$app->get('/', function () use ($app) {
    $menu = new Menu();

    $app->render('index.twig', array('isHome' => true, 'menu' => $menu->getMainMenu()));
});

$app->get('/documentation', function () use ($app) {
    $menu = new Menu();

    $app->render('index.twig', array('menu' => $menu->getMainMenu()));
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

$app->get('/api-reference', function () use ($app) {
    $app->render('layout.twig', array());
});


$menu     = new Menu();
$mainMenu = $menu->getMainMenu();

$app->get('/:category', function ($category) use ($app) {

    $doc         = new Documentation($category);
    $renderedDoc = $doc->getRenderedContent();

    $menu     = new Menu();
    $mainMenu = $menu->getMainMenu();

    $app->render('documentation.twig', array('doc' => $renderedDoc, 'menu' => $mainMenu));

})->conditions(array('category' => '(' . implode('|', array_keys($mainMenu)) . ')'));
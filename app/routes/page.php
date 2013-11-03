<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use helpers\Markdown;

function send404NotFound(\Slim\Slim $app)
{

}

$app->get('/', function () use ($app) {
    $app->render('index.twig', array('isHome' => true));
});

$app->get('/hooks', function () use ($app) {
    $md = new Markdown(file_get_contents('../../docs/Hooks.md'));
    $md->transform();

    $app->render('documentation.twig', array('documentation' => $md->transform()));
});

$app->get('/api', function () use ($app) {
    $app->render('layout.twig', array());
});

$app->get('/introduction', function () use ($app) {
    $app->render('layout.twig', array());
});

$app->get('/marketplace', function () use ($app) {
    $app->render('layout.twig', array());
});

$app->get('/plugins', function () use ($app) {
    $app->render('layout.twig', array());
});

$app->get('/themes', function () use ($app) {
    $app->render('layout.twig', array());
});

$app->get('/faq', function () use ($app) {
    $app->render('layout.twig', array());
});

$app->get('/use-cases', function () use ($app) {
    $app->render('layout.twig', array());
});
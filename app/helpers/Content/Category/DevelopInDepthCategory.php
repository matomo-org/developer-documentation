<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers\Content\Category;

use helpers\Content\EmptySubCategory;
use helpers\Content\Guide;
use helpers\Content\RemoteLink;

class DevelopInDepthCategory extends Category
{
    public function getName()
    {
        return 'Piwik In Depth';
    }

    public function getItems()
    {
        return [
            new Guide('piwik-in-depth-introduction'),
            new EmptySubCategory('Understanding Piwik', [
                new Guide('how-piwik-works'),
                new Guide('http-request-handling'),
                new Guide('piwiks-extensibility-points'),
            ]),
            new EmptySubCategory('Web Interface', [
                new Guide('controllers'),
                new Guide('views'),
                new Guide('javascript-extended'),
                new Guide('themable-plugins'),
            ]),
            new EmptySubCategory('Utils', [
                new Guide('piwiks-ini-configuration'),
            ]),
            new EmptySubCategory('Reporting API', [
                new Guide('apis'),
                new Guide('piwiks-reporting-api'),
            ]),
            new Guide('data-model'),
            new EmptySubCategory('Tests', [
                new Guide('tests-system'),
                new Guide('tests-travis-extended'),
            ]),
            new EmptySubCategory('Piwik Core development', [
                new Guide('contributing-to-piwik-core'),
                new Guide('core-team-workflow'),
                new RemoteLink('Piwik\'s Roadmap', 'http://piwik.org/roadmap/'),
            ]),
            new DevelopCategory(),
        ];
    }

    public function getUrl()
    {
        return '/piwik-in-depth';
    }

    public function getIntroGuide()
    {
        return new Guide('piwik-in-depth-introduction');
    }
}

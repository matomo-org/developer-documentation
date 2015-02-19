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
use helpers\Content\InternalLink;
use helpers\Content\RemoteLink;

class CoreDevelopCategory extends Category
{
    public function getName()
    {
        return 'Core Development';
    }

    public function getItems()
    {
        return [
            new Guide('core-develop-introduction'),
            new EmptySubCategory('Understanding Piwik', [
                new Guide('how-piwik-works'),
                new Guide('http-request-handling'),
                new Guide('piwiks-extensibility-points'),
            ]),
            new EmptySubCategory('Web Interface', [
                new Guide('controllers'),
                new Guide('views'),
                new Guide('javascript-extended'),
            ]),
            new EmptySubCategory('Reporting API', [
                new Guide('apis'),
                new Guide('piwiks-reporting-api'),
            ]),
            new Guide('data-model'),
            new Guide('themable-plugins'),
            new EmptySubCategory('Tests', [
                new Guide('tests-system'),
                new Guide('tests-travis-extended'),
            ]),
            new Guide('piwiks-ini-configuration'),
            new EmptySubCategory('Piwik Core development', [
                new Guide('contributing-to-piwik-core'),
                new Guide('core-team-workflow'),
                new RemoteLink('Piwik\'s Roadmap', 'http://piwik.org/roadmap/'),
            ]),
            new InternalLink('Plugin development', '/develop'),
        ];
    }

    public function getUrl()
    {
        return '/core';
    }

    public function getIntroGuide()
    {
        return new Guide('core-develop-introduction');
    }
}

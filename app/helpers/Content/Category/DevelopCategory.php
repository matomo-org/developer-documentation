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

class DevelopCategory extends Category
{
    public function getName()
    {
        return 'Develop';
    }

    public function getItems()
    {
        return [
            new Guide('develop-introduction'),
            new EmptySubCategory('Getting Started With Plugins', [
                new Guide('getting-started-part-1'),
                new Guide('getting-started-part-2'),
                new Guide('getting-started-part-3'),
                new Guide('distributing-your-plugin'),
            ]),
            new EmptySubCategory('Understanding Piwik', [
                new Guide('how-piwik-works'),
                new Guide('http-request-handling'),
                new Guide('piwiks-extensibility-points'),
            ]),
            new EmptySubCategory('Web Interface', [
                new Guide('controllers'),
                new Guide('views'),
                new Guide('pages'),
                new Guide('menus'),
                new Guide('widgets'),
                new Guide('working-with-piwiks-ui'),
                new Guide('visualizing-report-data'),
            ]),
            new EmptySubCategory('Reporting API', [
                new Guide('apis'),
                new Guide('piwiks-reporting-api'),
            ]),
            new Guide('piwik-on-the-command-line'),
            new Guide('data-model'),
            new EmptySubCategory('Database', [
                new Guide('persistence-and-the-mysql-backend'),
                new Guide('extending-database'),
            ]),
            new Guide('piwik-configuration'),
            new EmptySubCategory('Security', [
                new Guide('security-in-piwik'),
                new Guide('permissions'),
            ]),
            new Guide('internationalization'),
            new Guide('tests'),
            new Guide('logging'),
            new Guide('scheduled-tasks'),
            new EmptySubCategory('Piwik Core development', [
                new Guide('contributing-to-piwik-core'),
                new Guide('core-team-workflow'),
                new RemoteLink('Piwik\'s Roadmap', 'http://piwik.org/roadmap/'),
            ]),
            new Guide('design-introduction'),
            new EmptySubCategory('Blog articles', [
                new RemoteLink('Make your plugin multilingual', 'http://piwik.org/blog/2014/10/how-to-make-your-plugin-multilingual-introducing-the-piwik-platform/'),
            ]),
        ];
    }

    public function getUrl()
    {
        return '/develop';
    }

    public function getIntroGuide()
    {
        return new Guide('develop-introduction');
    }
}

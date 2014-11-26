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
use helpers\Content\RemoteGuide;

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
                new Guide('all-about-analytics-data'),
                new Guide('piwiks-extensibility-points'),
            ]),
            new Guide('mvc-in-piwik'),
            new Guide('piwik-configuration'),
            new Guide('piwiks-ini-configuration'),
            new Guide('persistence-and-the-mysql-backend'),
            new Guide('security-in-piwik'),
            new Guide('internationalization'),
            new Guide('tests'),
            new Guide('visualizing-report-data'),
            new Guide('working-with-piwiks-ui'),
            new Guide('piwik-on-the-command-line'),
            new EmptySubCategory('Piwik Core development', [
                new Guide('contributing-to-piwik-core'),
                new Guide('core-team-workflow'),
                new RemoteGuide('Piwik\'s Roadmap', 'http://piwik.org/roadmap/'),
            ]),
            new EmptySubCategory('Blog articles', [
                new RemoteGuide('Make your plugin configurable', 'http://piwik.org/blog/2014/09/make-plugin-configurable-introducing-piwik-platform/'),
                new RemoteGuide('Scheduled tasks', 'http://piwik.org/blog/2014/08/create-scheduled-task-introducing-piwik-platform/'),
                new RemoteGuide('Widgets', 'http://piwik.org/blog/2014/09/create-widget-introducing-piwik-platform/'),
                new RemoteGuide('Adding pages and menu items', 'http://piwik.org/blog/2014/09/add-new-page-menu-item-piwik-introducing-piwik-platform/'),
                new RemoteGuide('Make your plugin multilingual', 'http://piwik.org/blog/2014/10/how-to-make-your-plugin-multilingual-introducing-the-piwik-platform/'),
                new RemoteGuide('How to verify user permissions', 'http://piwik.org/blog/2014/11/how-to-verify-user-permissions-introducing-piwik-platform/'),
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

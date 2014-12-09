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
                new Guide('all-about-analytics-data'),
                new Guide('piwiks-extensibility-points'),
            ]),
            new Guide('mvc-in-piwik'),
            new EmptySubCategory('User interface', [
                new Guide('pages'),
                new Guide('menus'),
                new Guide('widgets'),
                new Guide('working-with-piwiks-ui'),
                new Guide('visualizing-report-data'),
            ]),
            new Guide('piwik-configuration'),
            new Guide('persistence-and-the-mysql-backend'),
            new Guide('security-in-piwik'),
            new Guide('internationalization'),
            new Guide('tests'),
            new Guide('piwiks-reporting-api'),
            new Guide('scheduled-tasks'),
            new Guide('piwik-on-the-command-line'),
            new EmptySubCategory('Piwik Core development', [
                new Guide('contributing-to-piwik-core'),
                new Guide('core-team-workflow'),
                new RemoteLink('Piwik\'s Roadmap', 'http://piwik.org/roadmap/'),
            ]),
            new Guide('design-introduction'),
            new EmptySubCategory('Blog articles', [
                new RemoteLink('Make your plugin multilingual', 'http://piwik.org/blog/2014/10/how-to-make-your-plugin-multilingual-introducing-the-piwik-platform/'),
                new RemoteLink('How to verify user permissions', 'http://piwik.org/blog/2014/11/how-to-verify-user-permissions-introducing-piwik-platform/'),
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

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
use helpers\Content\SubCategory;

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
            new EmptySubCategory('Getting Started', [
                new Guide('getting-started-part-1'),
                new Guide('distributing-your-plugin'),
            ]),
            new EmptySubCategory('Plugin Basics', [
                new Guide('custom-reports'),
                new Guide('visualizing-report-data'),
                new Guide('theming'),
                new Guide('pages'),
                new Guide('menus'),
                new Guide('widgets'),
                new Guide('working-with-piwiks-ui'),
                new Guide('plugin-settings'),
                new Guide('piwiks-ini-configuration'),
                new Guide('scheduled-tasks'),
                new Guide('piwik-on-the-command-line'),
            ]),
            new SubCategory(new Guide('internationalization'), [
                new RemoteLink('Make your plugin multilingual', 'http://piwik.org/blog/2014/10/how-to-make-your-plugin-multilingual-introducing-the-piwik-platform/'),
            ]),
            new Guide('tests'),
            new EmptySubCategory('Security', [
                new Guide('security-in-piwik'),
                new Guide('permissions'),
            ]),
            new EmptySubCategory('Database', [
                new Guide('persistence-and-the-mysql-backend'),
                new Guide('extending-database'),
            ]),
            new Guide('logging'),
            new InternalLink('Core development', '/core'),
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

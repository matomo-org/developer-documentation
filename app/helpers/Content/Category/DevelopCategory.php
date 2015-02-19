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

class DevelopCategory extends Category
{
    public function getName()
    {
        return 'Develop';
    }

    public function getMenuTitle()
    {
        return 'Plugin Development';
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
                new Guide('theming'),
                new Guide('pages'),
                new Guide('menus'),
                new Guide('widgets'),
                new Guide('working-with-piwiks-ui'),
                new Guide('visualizing-report-data'),
                new Guide('scheduled-tasks'),
                new Guide('piwik-on-the-command-line'),
            ]),
            new EmptySubCategory('Security', [
                new Guide('security-in-piwik'),
                new Guide('permissions'),
            ]),
            new EmptySubCategory('Utils', [
                new Guide('events'),
                new Guide('plugin-settings'),
                new Guide('translations'),
                new Guide('extending-database'),
                new Guide('logging'),
            ]),
            new Guide('tests'),
            new DevelopInDepthCategory(),
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

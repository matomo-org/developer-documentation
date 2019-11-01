<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers\Content\Category;

use helpers\Content\Guide;
use helpers\Content\UnlinkedCategory;

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
            new UnlinkedCategory('develop-getting-started'),
            new UnlinkedCategory('develop-plugin-analytics'),
            new UnlinkedCategory('develop-plugin-tagmanager'),
            new UnlinkedCategory('develop-plugin-wordpress'),
            new UnlinkedCategory('develop-plugin-basics'),
            new UnlinkedCategory('develop-security'),
            new UnlinkedCategory('develop-utils'),
            new Guide('tests'),
            new UnlinkedCategory('develop-migration'),
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

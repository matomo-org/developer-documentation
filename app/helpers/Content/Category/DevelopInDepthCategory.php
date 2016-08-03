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
use helpers\Content\UnlinkedCategory;

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
            new UnlinkedCategory('in-depth-understanding-piwik'),
            new UnlinkedCategory('in-depth-web-interface'),
            new UnlinkedCategory('in-depth-utils'),
            new UnlinkedCategory('in-depth-utils'),
            new UnlinkedCategory('in-depth-reporting-api'),
            new Guide('data-model'),
            new UnlinkedCategory('in-depth-tests'),
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

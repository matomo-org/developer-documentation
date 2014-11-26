<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers\Content\Category;

use helpers\Content\Guide;
use helpers\Content\RemoteLink;

class DesignCategory extends Category
{
    public function getName()
    {
        return 'Design';
    }

    public function getUrl()
    {
        return '/design';
    }

    public function getItems()
    {
        return [
            new Guide('design-introduction'),
            new RemoteLink('How to create a custom theme', 'http://piwik.org/blog/2014/08/create-custom-theme-piwik-introducing-piwik-platform/'),
            new Guide('theming'),
        ];
    }

    public function getIntroGuide()
    {
        return new Guide('design-introduction');
    }
}

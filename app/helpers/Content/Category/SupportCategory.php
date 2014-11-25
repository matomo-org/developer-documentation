<?php
/**
 * Piwik - Open source web analytics
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers\Content\Category;

use helpers\Content\Guide;

class SupportCategory extends Category
{
    public function getName()
    {
        return 'Support';
    }

    public function getUrl()
    {
        return '/support';
    }

    public function getItems()
    {
        return [];
    }

    public function getIntroGuide()
    {
        return new Guide('support');
    }
}

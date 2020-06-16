<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers\Content\Category;

use helpers\Content\Guide;
use helpers\Environment;

class ChangelogCategory extends Category
{
    public function getName()
    {
        return 'Changelog';
    }

    public function getUrl()
    {
        return '/changelog';
    }

    public function getItems()
    {
        return [];
    }

    public function getIntroGuide()
    {
        return new Guide('changelog-' . Environment::getPiwikVersion() . 'x');
    }
}

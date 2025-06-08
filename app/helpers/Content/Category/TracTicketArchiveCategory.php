<?php
/**
 * Piwik - Open source web analytics
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers\Content\Category;

use helpers\Content\Guide;

class TracTicketArchiveCategory extends Category
{
    public function getName()
    {
        return 'Legacy ticket archive';

    }

    public function getUrl()
    {
        return '/trac-ticket-archive';
    }

    public function getItems()
    {
        return [];
    }

    public function getIntroGuide()
    {
        return new Guide('trac-ticket-archive');
    }
}
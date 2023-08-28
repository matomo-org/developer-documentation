<?php
/**
 * Piwik - Open source web analytics
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers\Content\Category;

use helpers\Content\Guide;
use helpers\Content\RemoteLink;

class IntegrateCategory extends Category
{
    public function getName()
    {
        return 'Integrate';
    }

    public function getUrl()
    {
        return '/integration';
    }

    public function getItems()
    {
        return [
            new Guide('integrate-introduction'),
            new Guide('tracking-introduction'),
            new Guide('reporting-introduction'),
            new RemoteLink('Integrations', 'https://matomo.org/integrate/'),
            new Guide('tagmanager/introduction'),
            new Guide('ab-tests'),
            new Guide('heatmap-session-recording'),
            new Guide('crash-analytics'),
            new Guide('media-analytics'),
            new Guide('form-analytics'),
        ];
    }

    public function getIntroGuide()
    {
        return new Guide('integrate-introduction');
    }
}

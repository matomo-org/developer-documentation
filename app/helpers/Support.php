<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Support {

    public static function getMainMenu()
    {
        $menu = array();

        $menu['forums'] = array(
            'title'       => 'Forums',
            'url'         => 'http://forum.piwik.org/list.php?9',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['tickets'] = array(
            'title'       => 'Tickets',
            'url'         => 'http://dev.piwik.org',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['piwikpro'] = array(
            'title'       => 'Piwik Pro',
            'url'         => 'http://piwik.org/consulting/',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );


        return $menu;
    }

}
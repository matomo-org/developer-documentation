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
            'description' => 'Ask other developers for help. Someone might have encountered your problem before.'
        );

        $menu['tickets'] = array(
            'title'       => 'Tickets',
            'url'         => 'http://dev.piwik.org',
            'description' => 'Create a bug report on our bug tracking system or check on the status of an existing bug.'
        );

        $menu['piwikpro'] = array(
            'title'       => 'Piwik Pro',
            'url'         => 'http://piwik.org/consulting/',
            'description' => 'If your looking for someone to create a plugin for you or want someone to fix a bug for you ASAP, then get in touch with a professional consultant.'
        );


        return $menu;
    }

}
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

        $menu['issues'] = array(
            'title'       => 'Issues',
            'url'         => 'http://dev.piwik.org',
            'description' => 'Create a bug report on our bug tracking system or check on the status of an existing bug.'
        );

        $menu['irc'] = array(
            'title'        => 'IRC',
            'url'          => 'http://webchat.freenode.net/?channels=piwik&uio=MTE9NTE3a',
            'description'  => 'Speak to us and the community in IRC: irc.freenode.net/#piwik',
            'callToAction' => 'Webchat'
        );

        $menu['piwikpro'] = array(
            'title'       => 'Piwik Pro',
            'url'         => 'http://piwik.org/consulting/',
            'description' => 'If your looking for someone to create a plugin for you or want someone to fix a bug for you ASAP, then get in touch with a professional consultant.'
        );

        $menu['roadmap'] = array(
            'title'       => 'Roadmap',
            'url'         => 'http://piwik.org/roadmap/',
            'description' => 'Our mission is to liberate web analytics worldwide, and help you grow your project with better data insights. Check out what else we have planned for the future.'
        );

        return $menu;
    }

}

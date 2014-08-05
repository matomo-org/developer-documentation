<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Home {

    private static function getUrl($key)
    {
        return '/' . $key;
    }

    public static function getMenuItemByUrl($url)
    {
        foreach (static::getMainMenu() as $menu) {
            if (0 === strpos($url, $menu['url'])) {
                return $menu;
            }
        }
    }

    public static function getMainMenu()
    {
        $menu = array();

        $menu[] = array(
            'title'        => 'Guides',
            'url'          => static::getUrl('guides'),
            'description'  => 'Learn how to create your own plugins and contributions or delve deep into Piwik\'s inner workings and learn how it all works.',
            'callToAction' => 'Start learning'
        );

        $menu[] = array(
            'title'        => 'API Reference',
            'url'          => static::getUrl('api-reference'),
            'description'  => 'Detailed documentation for every PHP class you might want to use. If you need help with a specific class, this is where to go.',
            'callToAction' => 'Go'
        );

        $menu[] = array(
            'title'        => 'Changelog',
            'url'          => static::getUrl('changelog'),
            'description'  => '',
            'callToAction' => ''
        );

        $menu[] = array(
            'title'        => 'Support',
            'url'          => static::getUrl('support'),
            'description'  => 'If the documentation isn\'t helping you with something or you\'ve found a bug and want to report it, click here and learn how to get help.',
            'callToAction' => 'Get help'
        );

        return $menu;
    }

}
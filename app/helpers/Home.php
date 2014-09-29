<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Home {

    public static function getUrl($key)
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
        return null;
    }

    public static function getMainMenu()
    {
        $menu = array();

        $menu[] = array(
            'title'       => 'Integrate Piwik',
            'url'         => static::getUrl('integration'),
            'description' => 'Track your application or access Piwik reports using the HTTP API.',
            'links'       => array(
                'Track your application' => static::getUrl('integration#tracking'),
                'Access Piwik reports'   => static::getUrl('integration#reporting'),
                'Client libraries & SDK' => static::getUrl('integration#clients'),
            ),
        );

        $menu[] = array(
            'title'       => 'Develop Plugins',
            'url'         => static::getUrl('plugins'),
            'description' => 'Extend and customize Piwik by developing plugins and themes.',
            'links'       => array(
                'Getting started with Plugins' => static::getUrl('plugins#getting-started'),
                'Plugin documentation'         => static::getUrl('plugins#documentation'),
                'Custom themes'                => static::getUrl('plugins#themes'),
                'Distributing your Plugin'     => static::getUrl('plugins#marketplace'),
            ),
        );

        $menu[] = array(
            'title'       => 'Develop Piwik',
            'url'         => static::getUrl('contributing'),
            'description' => 'Discover how Piwik works and get involved in its development with the Core team.',
            'links'       => array(
                'Contributing to Piwik'    => static::getUrl('contributing#introduction'),
                'How Piwik works'          => static::getUrl('contributing#internals'),
                'The development workflow' => static::getUrl('contributing#workflow'),
            ),
        );

        $menu[] = array(
            'title'       => 'API Reference',
            'url'         => static::getUrl('api-reference'),
            'description' => 'Check out the low-level documentation for the HTTP, Javascript or PHP API.',
            'links'       => array(
                'HTTP API'       => static::getUrl('api-reference#http'),
                'Javascript API' => static::getUrl('api-reference#javascript'),
                'PHP API'        => static::getUrl('api-reference#php'),
            ),
        );

        $menu[] = array(
            'title'       => 'Community & Support',
            'url'         => static::getUrl('support'),
            'description' => 'Get help or get involved with the developer community.',
            'links'       => array(
                'Developer blog' => 'http://piwik.org/blog/category/development/',
                'Forums'         => 'http://forum.piwik.org/list.php?9',
                'IRC'            => 'http://webchat.freenode.net/?channels=piwik&uio=MTE9NTE3a',
                'Issues'         => 'https://github.com/piwik/piwik/issues',
            ),
        );

        return $menu;
    }

}
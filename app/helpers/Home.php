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
        $menu = [];

        $menu[] = [
            'title'       => 'Integrate',
            'menuTitle'   => 'Integrate',
            'url'         => '/integration',
            'description' => 'Track your application or access Piwik data using the HTTP API.',
            'links'       => [
                'Track your application' => '/guides/tracking-introduction',
                'Access Piwik data'      => '/guides/reporting-introduction',
                'Client libraries & SDK' => '/guides/tracking-api-clients',
            ],
        ];

        $menu[] = [
            'title'       => 'Develop',
            'menuTitle'   => 'Develop',
            'url'         => '/develop',
            'description' => 'Extend and customize Piwik by contributing or developing plugins.',
            'links'       => [
                'Getting started with Plugins' => '/guides/getting-started',
                'MVC in Piwik'                 => '/guides/mvc-in-piwik',
                'The Marketplace'              => '/guides/distributing-your-plugin',
            ],
        ];

        $menu[] = [
            'title'       => 'Design',
            'menuTitle'   => 'Design',
            'url'         => '/design',
            'description' => 'Discover how Piwik works and get involved in its development with the Core team.',
            'links'       => [
                'Writing a theme' => '/guides/theming',
            ],
        ];

        $menu[] = [
            'title'       => 'API Reference',
            'menuTitle'   => 'API Reference',
            'url'         => '/api-reference',
            'description' => 'Check out the low-level documentation for the HTTP, Javascript or PHP API.',
            'links'       => [
                'HTTP API'       => static::getUrl('api-reference#http'),
                'Javascript API' => static::getUrl('api-reference#javascript'),
                'PHP API'        => static::getUrl('api-reference#php'),
            ],
        ];

        $menu[] = [
            'title'       => 'Platform Changelog',
            'menuTitle'   => 'Changelog',
            'url'         => '/changelog',
            'description' => 'What has changed in the latest Piwik versions for the developers.',
            'links'       => [
            ],
        ];

        $menu[] = [
            'title'       => 'Community & Support',
            'menuTitle'   => 'Support',
            'url'         => '/support',
            'description' => 'Get support or get involved with the developer community.',
            'links'       => [
                'Developer blog' => 'http://piwik.org/blog/category/development/',
                'Forums'         => 'http://forum.piwik.org/list.php?9',
                'IRC'            => 'http://webchat.freenode.net/?channels=piwik&uio=MTE9NTE3a',
                'Issues'         => 'https://github.com/piwik/piwik/issues',
            ],
        ];

        return $menu;
    }

}
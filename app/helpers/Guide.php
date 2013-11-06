<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Guide {

    private static function getUrl($key)
    {
        return '/guides/' . $key;
    }

    public static function getMenuItemByUrl($url)
    {
        foreach (static::getMainMenu() as $menu) {
            if ($url == $menu['url']) {
                return $menu;
            }
        }
    }

    public static function getMainMenu()
    {
        $menu = array();

        $menu['introduction'] = array(
            'title'       => 'Introduction',
            'file'        => 'introduction',
            'url'         => static::getUrl('introduction'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['plugins'] = array(
            'title'       => 'Plugins',
            'file'        => 'plugins',
            'url'         => static::getUrl('plugins'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['themes'] = array(
            'title'       => 'Themes',
            'file'        => 'themes',
            'url'         => static::getUrl('themes'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['marketplace'] = array(
            'title'       => 'Marketplace',
            'file'        => 'marketplace',
            'url'         => static::getUrl('marketplace'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['tracking-api'] = array(
            'title'       => 'Tracking API',
            'file'        => 'tracking-api',
            'url'         => static::getUrl('tracking-api'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['reporting-api'] = array(
            'title'       => 'Reporting API',
            'file'        => 'reporting-api',
            'url'         => static::getUrl('reporting-api'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['javascript-api'] = array(
            'title'       => 'JavaScript API',
            'file'        => 'javascript-api',
            'url'         => static::getUrl('javascript-api'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['faq'] = array(
            'title'       => 'FAQ',
            'file'        => 'faq',
            'url'         => static::getUrl('faq'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['use-cases'] = array(
            'title'       => 'Use cases',
            'file'        => 'use-cases',
            'url'         => static::getUrl('use-cases'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        return $menu;
    }
}
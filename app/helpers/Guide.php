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

        $menu[] = array(
            'title'       => 'Introduction',
            'file'        => 'introduction',
            'url'         => static::getUrl('introduction'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu[] = array(
            'title'       => 'Plugins',
            'file'        => 'plugins',
            'url'         => static::getUrl('plugins'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu[] = array(
            'title'       => 'Themes',
            'file'        => 'themes',
            'url'         => static::getUrl('themes'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu[] = array(
            'title'       => 'Marketplace',
            'file'        => 'marketplace',
            'url'         => static::getUrl('marketplace'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu[] = array(
            'title'       => 'Core Development',
            'file'        => 'core',
            'url'         => static::getUrl('core-development'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu[] = array(
            'title'       => 'Tracking API',
            'file'        => 'tracking-api',
            'url'         => static::getUrl('tracking-api'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu[] = array(
            'title'       => 'Reporting API',
            'file'        => 'reporting-api',
            'url'         => static::getUrl('reporting-api'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu[] = array(
            'title'       => 'JavaScript API',
            'file'        => 'javascript-api',
            'url'         => static::getUrl('javascript-api'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu[] = array(
            'title'       => 'FAQ',
            'file'        => 'faq',
            'url'         => static::getUrl('faq'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu[] = array(
            'title'       => 'Use cases',
            'file'        => 'use-cases',
            'url'         => static::getUrl('use-cases'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        // TODO: remove above entries when new guides finished
        $menu[] = array(
            'title'       => 'Getting started extending Piwik',
            'file'        => 'getting-started',
            'url'         => static::getUrl('getting-started'),
            'description' => 'Setup your development environment and learn the basics of Piwik plugin/theme development.'
        );

        $menu[] = array(
            'title'       => 'MVC in Piwik',
            'file'        => 'mvc-in-piwik',
            'url'         => static::getUrl('mvc-in-piwik'),
            'description' => 'Learn how Piwik handles HTTP requests and how Piwik generates the HTML that is displayed to the user.'
        );

        $menu[] = array(
            'title'       => 'Visualizing Report Data',
            'file'        => 'visualizing-report-data',
            'url'         => static::getUrl('visualizing-report-data'),
            'description' => 'Learn about the different ways Piwik can display analytics data and how plugins can create new ways to display it.'
        );

        return $menu;
    }
}
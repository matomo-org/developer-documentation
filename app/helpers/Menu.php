<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Menu {

    public function getMainMenu()
    {
        $menu = array();

        $menu['introduction'] = array(
            'title'       => 'Introduction',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['plugins'] = array(
            'title'       => 'Plugins',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['themes'] = array(
            'title'       => 'Themes',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['marketplace'] = array(
            'title'       => 'Marketplace',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['tracking-api'] = array(
            'title'       => 'Tracking API',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['reporting-api'] = array(
            'title'       => 'Reporting API',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['faq'] = array(
            'title'       => 'FAQ',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['use-cases'] = array(
            'title'       => 'Use cases',
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        return $menu;
    }
}
<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Guides {

    private $name;

    public function __construct($name)
    {
        if (!$this->isValid($name)) {
            throw new \Exception('Requested documentation is not valid');
        }

        $this->name = $name;
    }

    private function isValid($name)
    {
        return preg_match('/^([\w\/-])*$/', $name) && '/' != substr($name, 0, 1);
    }

    private function getRawContent()
    {
        $path = '../../docs/' . $this->name . '.md';

        if (!file_exists($path)) {
            throw new \Exception('Requested documentation does not exist');
        }

        return file_get_contents($path);
    }

    public function getRenderedContent()
    {
        $content = $this->getRawContent();

        $md = new Markdown($content);
        $rendered = $md->transform();

        return $rendered;
    }

    private static function getUrl($key)
    {
        return '/guides/' . $key;
    }

    public static function getMainMenu()
    {
        $menu = array();

        $menu['introduction'] = array(
            'title'       => 'Introduction',
            'url'         => static::getUrl('introduction'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['plugins'] = array(
            'title'       => 'Plugins',
            'url'         => static::getUrl('plugins'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['themes'] = array(
            'title'       => 'Themes',
            'url'         => static::getUrl('themes'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['marketplace'] = array(
            'title'       => 'Marketplace',
            'url'         => static::getUrl('marketplace'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['tracking-api'] = array(
            'title'       => 'Tracking API',
            'url'         => static::getUrl('tracking-api'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['reporting-api'] = array(
            'title'       => 'Reporting API',
            'url'         => static::getUrl('reporting-api'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['faq'] = array(
            'title'       => 'FAQ',
            'url'         => static::getUrl('faq'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        $menu['use-cases'] = array(
            'title'       => 'Use cases',
            'url'         => static::getUrl('use-cases'),
            'description' => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.'
        );

        return $menu;
    }
}
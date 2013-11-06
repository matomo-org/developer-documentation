<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class ApiReference {

    private static function getUrl($key)
    {
        return '/api-reference/' . $key;
    }

    public static function getClassNames()
    {
        $doc = new Document('generated/master/Classnames');

        $classes = $doc->getSections();

        $menu = array();
        foreach ($classes as $class) {
            $className = $class['title'];

            $menu[$className] = array(
                'title' => $className,
                'url'   => static::getUrl('Piwik\\' . $className)
            );
        }

        return $menu;
    }

    public static function getReferences()
    {
        $menu = array();

        $menu['index'] = array(
            'title'        => 'Overview',
            'file'         => 'generated/master/Index',
            'url'          => static::getUrl('index'),
            'description'  => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
            'callToAction' => 'Browse'
        );

        $menu['classes'] = array(
            'title'        => 'Classes',
            'file'         => 'generated/master/Classes',
            'url'          => static::getUrl('classes'),
            'description'  => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
            'callToAction' => 'Browse'
        );

        $menu['hooks'] = array(
            'title'        => 'Hooks',
            'file'         => 'generated/Hooks',
            'url'          => static::getUrl('hooks'),
            'description'  => 'Extend Piwik by writing your own plugins or themes. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
            'callToAction' => 'Browse'
        );

        return $menu;
    }
}
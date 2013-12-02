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

    public static function getClassesMenu()
    {
        $doc = new Document('generated/master/Classnames');

        $classes = $doc->getSections();

        $menu = array();
        foreach ($classes as $class) {
            $className = $class['title'];

            $menu[$className] = array(
                'title' => $className,
                'url'   => static::getUrl('Piwik/' . str_replace('\\', '/', $className))
            );
        }

        return $menu;
    }

    public static function getMenuItemByUrl($url)
    {
        foreach (static::getReferencesMenu() as $menu) {
            if ($url == $menu['url']) {
                return $menu;
            }
        }
    }

    public static function getReferencesMenu()
    {
        $menu = array();

        $menu[] = array(
            'title'        => 'Classes',
            'file'         => 'generated/master/Classes',
            'url'          => static::getUrl('classes'),
            'description'  => 'View reference docs for every Piwik class that plugin developers should use.',
            'callToAction' => 'Browse'
        );

        $menu[] = array(
            'title'        => 'Events',
            'file'         => 'generated/master/Hooks',
            'url'          => static::getUrl('hooks'),
            'description'  => 'View reference docs for every event posted by Piwik and its Core Plugins.',
            'callToAction' => 'Browse'
        );

        $menu[] = array(
            'title'        => 'PHP Piwik Tracker',
            'file'         => 'generated/master/PiwikTracker',
            'url'          => static::getUrl('PHP-Piwik-Tracker'),
            'description'  => 'View reference docs for the PHP tracking client.',
            'callToAction' => 'Browse'
        );

        $menu[] = array(
            'title'        => 'Index',
            'file'         => 'generated/master/Index',
            'url'          => static::getUrl('index'),
            'description'  => 'View every class and method in an alphabetized index.',
            'callToAction' => 'Browse'
        );

        return $menu;
    }
}
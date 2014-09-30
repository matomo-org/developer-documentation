<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class ApiReference {

    public static function getUrl($key)
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

        return [['items' => $menu]];
    }

    public static function getMenuItemByUrl($url)
    {
        foreach (static::getReferencesMenu() as $category) {
            foreach ($category['items'] as $menu) {
                if ($url == $menu['url']) {
                    return $menu;
                }
            }
        }
        return null;
    }

    public static function getReferencesMenu()
    {
        return [
            [
                'category' => 'HTTP API Documentation',
                'id'       => 'http',
                'items'    => [
                    [
                        'title'        => 'Tracking HTTP API',
                        'file'         => 'tracking-api',
                        'url'          => static::getUrl('tracking-api'),
                        'description'  => 'View reference docs for the Tracking HTTP API.',
                        'callToAction' => 'Browse',
                    ],
                    [
                        'title'        => 'Reporting API Listing',
                        'file'         => 'reporting-api/listing',
                        'url'          => static::getUrl('reporting-api'),
                        'description'  => 'View every API method exposed in and every parameter supported by Piwik\'s Reporting API.',
                        'callToAction' => 'Browse',
                    ],
                    [
                        'title'        => 'Metadata',
                        'file'         => 'reporting-api/metadata',
                        'url'          => static::getUrl('metadata'),
                        'description'  => 'View information about API methods that query report metadata.',
                        'callToAction' => 'Browse',
                    ],
                    [
                        'title'        => 'Segmentation',
                        'file'         => 'reporting-api/segmentation',
                        'url'          => static::getUrl('segmentation'),
                        'description'  => 'View all available segment dimensions and segment operators.',
                        'callToAction' => 'Browse',
                    ],
                ],
            ],
            [
                'category' => 'JavaScript Documentation',
                'id'       => 'javascript',
                'items'    => [
                    [
                        'title'        => 'Javascript Tracking client',
                        'file'         => 'tracking-javascript',
                        'url'          => static::getUrl('tracking-javascript'),
                        'description'  => 'View reference docs for the Javascript tracking client.',
                        'callToAction' => 'Browse',
                    ],
                ],
            ],
            [
                'category' => 'PHP Documentation',
                'id'       => 'php',
                'items'    => [
                    [
                        'title'        => 'Classes',
                        'file'         => 'generated/master/Classes',
                        'url'          => static::getUrl('classes'),
                        'description'  => 'View reference docs for every Piwik class that plugin developers should use.',
                        'callToAction' => 'Browse',
                    ],
                    [
                        'title'        => 'Events',
                        'file'         => 'generated/master/Hooks',
                        'url'          => static::getUrl('events'),
                        'description'  => 'View reference docs for every event posted by Piwik and its Core Plugins.',
                        'callToAction' => 'Browse',
                    ],
                    [
                        'title'        => 'Index',
                        'file'         => 'generated/master/Index',
                        'url'          => static::getUrl('index'),
                        'description'  => 'View every class and method in an alphabetized index.',
                        'callToAction' => 'Browse',
                    ],
                    [
                        'title'        => 'PHP Tracking client',
                        'file'         => 'generated/master/PiwikTracker',
                        'url'          => static::getUrl('PHP-Piwik-Tracker'),
                        'description'  => 'View reference docs for the PHP tracking client.',
                        'callToAction' => 'Browse',
                    ],
                ],
            ],
        ];
    }

    public static function getDocumentList()
    {
        $indexPath = '../../docs/generated/master/Index.md';
        $indexMarkdown = file_get_contents($indexPath);

        $count = preg_match_all("/^- \[`?([a-zA-Z0-9_\(\)\$]+)`?\]\(([\$a-zA-Z0-9_.\/\#]+)\)/m", $indexMarkdown, $documentMatches);

        $result = array();
        for ($i = 0; $i < $count; ++$i) {
            $url = $documentMatches[2][$i];
            $url = str_replace('.md', '', $url);
            $url = self::getUrl($url);

            $parts = explode('/', $url);
            $parts = explode('#', end($parts));
            $className = reset($parts);

            $title = $documentMatches[1][$i];
            if (strpos($title, "()") !== false) { // is method
                $title = $className . '::' . $title;
            } else if (strpos($title, "$") !== false) { // is property
                $title = $className . '::' . $title;
            }

            $result[$url] = $title;
        }
        return $result;
    }
}
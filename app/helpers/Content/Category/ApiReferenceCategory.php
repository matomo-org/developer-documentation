<?php
/**
 * Piwik - Open source web analytics
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers\Content\Category;

use helpers\Content\ApiReferenceGuide;
use helpers\Content\EmptySubCategory;
use helpers\Content\PhpDoc;

class ApiReferenceCategory extends Category
{
    public function getName()
    {
        return 'API Reference';
    }

    public function getUrl()
    {
        return '/api-reference';
    }

    public function getItems()
    {
        return [
            new ApiReferenceGuide('api-reference-introduction'),
            new ApiReferenceGuide('tracking-api'),
            new ApiReferenceGuide('reporting-api'),
            new EmptySubCategory('Javascript Documentation', [
                new ApiReferenceGuide('tracking-javascript'),
            ]),
            new EmptySubCategory('PHP Documentation', [
                new PhpDoc('Classes', 'classes'),
                new PhpDoc('Hooks', 'events'),
                new PhpDoc('Index', 'index'),
                new PhpDoc('PiwikTracker', 'PHP-Piwik-Tracker'),
            ]),
        ];
    }

    public function getIntroGuide()
    {
        return new ApiReferenceGuide('api-reference-introduction');
    }

    public static function getAllApiReference()
    {
        $indexPath = '../../docs/generated/master/Index.md';
        $indexMarkdown = file_get_contents($indexPath);

        $count = preg_match_all("/^- \[`?([a-zA-Z0-9_\(\)\$]+)`?\]\(([\$a-zA-Z0-9_.\/\#]+)\)/m", $indexMarkdown,
            $documentMatches);

        $result = [];
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
            } else {
                if (strpos($title, "$") !== false) { // is property
                    $title = $className . '::' . $title;
                }
            }

            $result[$url] = $title;
        }
        return $result;
    }
}

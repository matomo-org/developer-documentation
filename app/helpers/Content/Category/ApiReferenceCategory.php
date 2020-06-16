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
use helpers\Content\Guide;
use helpers\Content\PhpDoc;
use helpers\Content\UnlinkedCategory;
use helpers\Environment;

class ApiReferenceCategory extends Category
{
    public function getName()
    {
        return 'API Reference';
    }

    public function getUrl()
    {
        return self::getTheUrl();
    }

    public static function getTheUrl()
    {
        return '/api-reference';
    }

    public function getItems()
    {
        $matomoTracker = 'MatomoTracker';
        if (Environment::getPiwikVersion() <= 3) {
            $matomoTracker = 'PiwikTracker';
        }

        return [
            new ApiReferenceGuide('api-reference-introduction'),
            new EmptySubCategory('Tracking', [
                new ApiReferenceGuide('tracking-api'),
                new ApiReferenceGuide('tracking-javascript'),
                new PhpDoc($matomoTracker, 'PHP-Matomo-Tracker', 'PHP Tracking Client'),
            ]),
            new EmptySubCategory('Tag Manager', [
                new ApiReferenceGuide('tagmanager/javascript-api-reference'),
            ]),
            new EmptySubCategory('Reporting HTTP API', [
                new ApiReferenceGuide('reporting-api'),
                new ApiReferenceGuide('reporting-api-metadata'),
                new ApiReferenceGuide('reporting-api-segmentation')
            ]),
            new EmptySubCategory('PHP Plugins API', [
                new PhpDoc('Classes', 'classes'),
                new PhpDoc('Hooks', 'events'),
                new PhpDoc('Index', 'index'),
            ]),
	        new EmptySubCategory('WordPress', [
		        new ApiReferenceGuide('wordpress/classes-reference'),
		        new ApiReferenceGuide('wordpress/hooks-reference'),
		        new ApiReferenceGuide('wordpress/restapi-reference')
	        ]),
            new EmptySubCategory('Database', [
                new Guide('database-schema'),
            ]),
        ];
    }

    public function getIntroGuide()
    {
        return new ApiReferenceGuide('api-reference-introduction');
    }

    public static function getAllApiReference()
    {
        $indexPath = Environment::getPathToGeneratedDocs() . '/Index.md';
        $indexMarkdown = file_get_contents($indexPath);

        $count = preg_match_all("/^- \[`?([a-zA-Z0-9_\(\)\$]+)`?\]\(([\$a-zA-Z0-9_.\/\#]+)\)/m", $indexMarkdown,
            $documentMatches);

        $result = [];
        for ($i = 0; $i < $count; ++$i) {
            $url = $documentMatches[2][$i];
            $url = str_replace('.md', '', $url);
            $url = self::getTheUrl();

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

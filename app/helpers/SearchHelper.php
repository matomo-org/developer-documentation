<?php

namespace helpers;

use Monolog\Logger;
use TeamTNT\TNTSearch\TNTSearch;

class SearchHelper
{

    private static $storagePath = "../tmp/index/";
    private static $docsPath = '../../docs/';

    public static function searchTitles($array, $query) {
        $results = [];
        foreach ($array as $site) {
            if (strpos(strtolower($site["title"]), $query) !== false) {
                $results[] = $site;
            }
        }
        return $results;

    }

    public static function index() {
        $tnt = new TNTSearch;
        $excludedDirs = ["2.x/", "3.x/generated/"];
        // as tntsearch doesn't suport excluding directories, we need to give it a list of files in those directories
        $exclude = [];
        foreach ($excludedDirs as $dir) {
            $path = realpath(static::$docsPath . $dir);
            $excludedFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
            /** @var \SplFileInfo $excludedFile */
            foreach ($excludedFiles as $excludedFile) {
                $name = str_replace(realpath('../../docs/') . "/", '', $excludedFile->getRealPath());
                $exclude[] = $name; // path relative to the docs directory
            }
        }
        $config = [
            "storage" => self::$storagePath,
            "driver" => 'filesystem',
            "location" => static::$docsPath,
            "extension" => "md",
            "exclude" => $exclude
        ];

        $tnt->loadConfig($config);
        $indexer = $tnt->createIndex('docs');
        $indexer->run();
    }

    public static function search($query, $asYouType, Logger $logger) {
        $guideIndex = static::getGuideIndex();
        $guides = $guideIndex["guides"];
        $phpDoc = $guideIndex["phpDoc"];
        $tnt = new TNTSearch;

        $config = [
            "storage" => self::$storagePath,
            "driver" => 'filesystem',
        ];

        $tnt->loadConfig($config);

        $tnt->selectIndex("docs");
        $tnt->asYouType = $asYouType;
        $results = $tnt->search($query, 10);
        $rootdir = realpath(Environment::getBaseDocsPath());
        $formatedResults = [];

        $formatedResults = array_merge($formatedResults, static::searchTitles($guides, $query));
        foreach ($results as $result) {

            $markdownPath = str_replace($rootdir, "", $result["path"]);
            $markdownPath = str_replace(Environment::getPiwikVersionDirectory() . "/", "", substr($markdownPath, 1));
            $markdownPath = str_replace(".md", "", $markdownPath);
            if (!empty($guides[$markdownPath])) {
                $formatedResults[] = $guides[$markdownPath];
            } else {
                $logger->warning("no URL for Markdown file: " . $markdownPath);
            }
        }
        $formatedResults = array_merge($formatedResults, static::searchTitles($phpDoc, $query));

        return $formatedResults;
    }

    public static function getGuideIndex() {
        $cached = Cache::get('index.json');

        if (!empty($cached)) {
            return json_decode($cached, true);
        }

        $searchIndex = new SearchIndex();
        $index = $searchIndex->buildIndex();

        Cache::set('index.json', json_encode($index));

        return $index;
    }

}
<?php

namespace helpers;

use helpers\Content\Category\ApiReferenceCategory;
use helpers\Content\Category\Category;
use helpers\Content\Category\DevelopInDepthCategory;
use helpers\Content\Category\DesignCategory;
use helpers\Content\Category\DevelopCategory;
use helpers\Content\Category\IntegrateCategory;
use helpers\Content\EmptySubCategory;
use helpers\Content\MenuItem;
use helpers\Content\RemoteLink;

/**
 * Builds the search index: all guides + all API references.
 */
class SearchIndex
{
    public function buildIndex()
    {
        return array_merge($this->getGuides(), $this->getPhpDocReferences());
    }

    private function getGuides()
    {
        $categories = [
            new IntegrateCategory(),
            new DevelopCategory(),
            new DesignCategory(),
            new ApiReferenceCategory(),
            new DevelopInDepthCategory()
        ];

        $items = [];

        // Recursively merge all menu items from the categories
        array_walk($categories, function (Category $category) use (&$items) {
            $categoryItems = $category->getItems();

            $items = array_merge($items, $categoryItems);

            foreach ($categoryItems as $categoryItem) {
                $subItems = $categoryItem->getSubItems();
                if (count($subItems) > 0) {
                    $items = array_merge($items, $subItems);
                }
            }
        });

        // Remove from the list the empty categories and remote links
        $items = array_filter($items, function (MenuItem $item) {
            if ($item instanceof EmptySubCategory) {
                return false;
            }
            if ($item instanceof RemoteLink) {
                return false;
            }
            return true;
        });

        $urls = array_map(function (MenuItem $item) {
            return $item->getMenuUrl();
        }, $items);
        $titles = array_map(function (MenuItem $item) {
            return $item->getMenuTitle();
        }, $items);

        return array_combine($urls, $titles);
    }

    private function getPhpDocReferences()
    {
        $indexPath = Environment::getPathToGeneratedDocs() . '/Index.md';
        $indexMarkdown = file_get_contents($indexPath);

        $count = preg_match_all("/^- \[`?([a-zA-Z0-9_\(\)\$]+)`?\]\(([\$a-zA-Z0-9_.\/\#]+)\)/m", $indexMarkdown, $documentMatches);

        $result = [];
        for ($i = 0; $i < $count; ++$i) {
            $url = $documentMatches[2][$i];
            $url = str_replace('.md', '', $url);
            $url = '/api-reference/' . $url;

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

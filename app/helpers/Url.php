<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

use helpers\Content\ApiReferenceGuide;
use helpers\Content\Category\ApiReferenceCategory;
use helpers\Content\Category\DesignCategory;
use helpers\Content\Category\DevelopCategory;
use helpers\Content\Category\DevelopInDepthCategory;
use helpers\Content\Category\IntegrateCategory;
use helpers\Content\Guide;
use helpers\Content\PhpDoc;

class Url
{
    public static function getUrlIfDocumentIsAvailableInPiwikVersion($path, $piwikVersion) {
        $currentPiwikVersion = Environment::getPiwikVersion();

        // we now work in context of that piwik version
        Environment::setPiwikVersion($piwikVersion);

        $url = '';

        if ($path === '/' || $path === '') {
            $url = '/';
        }
        if (empty($url)) {
            if (strpos($path, '/guides/') !== false) {
                try {
                    // we check if the requested resource maybe exists for another Piwik version
                    $guide = new Guide(str_replace('/guides/', '', $path));
                    $url = Environment::completeUrl($guide->getMenuUrl());
                } catch (DocumentNotExistException $e) {
                }
            }
        }

        if (empty($url)) {
            if (strpos($path, '/api-reference/') !== false) {

                try {
                    $replaced = str_replace('/api-reference/', '', $path);
                    // we check if the requested resource maybe exists for another Piwik version
                    $guide = new ApiReferenceGuide($replaced);
                    $url = Environment::completeUrl($guide->getMenuUrl());
                } catch (DocumentNotExistException $e) {
                }

                try {
                    $replaced = str_replace('/api-reference/', '', $path);
                    // we check if the requested resource maybe exists for another Piwik version
                    $phpdoc = new PhpDoc($replaced, $replaced);
                    $url = Environment::completeUrl($phpdoc->getMenuUrl());
                } catch (DocumentNotExistException $e) {
                }
            }
        }

        if (empty($url)) {
            /** @var \helpers\Content\MenuItem[] $categories */
            $categories = [
                new IntegrateCategory(),
                new DevelopCategory(),
                new DesignCategory(),
                new ApiReferenceCategory(),
                new DevelopInDepthCategory()
            ];

            foreach ($categories as $category) {
                if ($path === $category->getMenuUrl()) {
                    $url = $path;
                    break;
                }
            }
        }

        Environment::setPiwikVersion($currentPiwikVersion);

        return $url;
    }
}
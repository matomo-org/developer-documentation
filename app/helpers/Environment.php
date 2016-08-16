<?php
/**
 * Piwik - Open source web analytics
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Environment
{
    private static $piwikVersion = LATEST_PIWIK_DOCS_VERSION;

    public static function isLatestPiwikVersion()
    {
        return self::getPiwikVersion() == LATEST_PIWIK_DOCS_VERSION;
    }

    // this prefix will be used for internal links in Piwik, this way we keep the piwik version in the URL
    public static function getCurrentUrlPrefix()
    {
        if (self::isLatestPiwikVersion()) {
            return '';
        }

        return self::buildUrlPrefix(self::getPiwikVersion());
    }

    public static function buildUrlPrefix($piwikVersion)
    {
        return '/' . $piwikVersion . '.x';
    }

    public static function setPiwikVersion($piwikVersion)
    {
        self::$piwikVersion = (int) $piwikVersion;
    }
    
    public static function completeUrl($path)
    {
        if (strpos($path, '://') !== false) {
            return $path; // we only rewrite internal links
        }

        if(empty($path)) {
            $path = '/';
        }

        $urlPrefix = self::getCurrentUrlPrefix();

        if ($urlPrefix && strpos($path, $urlPrefix) === 0) {
            return $path;
        } elseif ($urlPrefix) {
            return $urlPrefix . $path;
        }

        return $path;
    }

    // returns the piwik versions that can be chosen via the selector
    public static function getAvailablePiwikVersions()
    {
        return range(2, LATEST_PIWIK_DOCS_VERSION);
    }

    public static function getPiwikVersion()
    {
        if (!isset(self::$piwikVersion)) {
            self::$piwikVersion = LATEST_PIWIK_DOCS_VERSION;
        }
        
        return self::$piwikVersion;
    }

    public static function getPiwikVersionDirectory()
    {
        $piwikVersion = self::getPiwikVersion();

        return $piwikVersion . '.x';
    }

    public static function getBaseDocsPath()
    {
        return __DIR__ . '/../../docs/';
    }

    public static function getVersionedDocsPath()
    {
        $piwikVersion = self::getPiwikVersionDirectory();
        $path = self::getBaseDocsPath();

        return $path . $piwikVersion;
    }

    public static function getPathToGeneratedDocs()
    {
        $path = self::getVersionedDocsPath();

        return $path . '/generated';
    }
}

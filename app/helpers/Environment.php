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

    public static function getPiwikVersion()
    {
        if (!empty($_COOKIE['piwikVersion'])) {
            $piwikVersion = (int)$_COOKIE['piwikVersion'];
        } else {
            $piwikVersion = PIWIK_DEFAULT_VERSION;
        }

        return $piwikVersion;
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

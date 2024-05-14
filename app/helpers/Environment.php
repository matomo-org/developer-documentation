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

    public static function renamePiwikToMatomo($content)
    {
        $oldBrand = 'Piwik';
        $newBrandFirst = 'Matomo (formerly Piwik)';
        $newBrandOthers = 'Matomo';
        $replaceOld = array($oldBrand . ' ', ' ' . $oldBrand);
        $replaceNew = array($newBrandOthers . ' ', ' ' . $newBrandOthers);

        // eg makes sure Piwik won't be replaced again
        $keepWording = array('Matomo Developer Zone (formerly Piwik)', 'Piwik Developer Zone', 'Matomo (Piwik)', $newBrandFirst, 'Piwik.Media', 'Piwik.Form', 'Piwik.AbTest', 'Piwik.Heatmap', 'Piwik.get', 'PiwikTracker', 'typeof Piwik', '\Piwik', 'Piwik\\', 'Piwik::', 'extends PiwikUpdates');
        $keepWordingReplace = array('#_#MATOMODEVZONEFORMERLY#_#', '#_#MATOMODEVZONEFORMERLY#_#', '#_#MATOMOPIWIK#_#', '#_#saveReplace#_#', '#_#piwikmedia#_#', '#_#piwikform#_#', '#_#piwikabtest#_#', '#_#piwikheatmap#_#', '#_#piwikget#_#', '#_#piwiktracker#_#', '#_#typeofpiwik#_#', '#_#shlashpiwik#_#', '#_#piwikslash#_#','#_#piwikdoublecolon#_#', '#_#extendspiwikupdates#_#');

        $content = str_replace($keepWording, $keepWordingReplace, $content);

        $patternsToTest = array(' Piwik', 'Piwik ');
        $lowestPos = false;
        $patternToReplace = false;
        foreach ($patternsToTest as $patternToTest) {
            $pos = $content ? strpos($content, $patternToTest) : false;
            if ($pos !== false && ($lowestPos === false || $pos < $lowestPos)) {
                $lowestPos = $pos;
                $patternToReplace = $patternToTest;
            }
        }
        if ($lowestPos !== false) {
            $saveDoNotReplaceThisTerm = str_replace('Piwik', $newBrandFirst, $patternToReplace);
            $content = substr_replace($content, $saveDoNotReplaceThisTerm, $lowestPos, strlen($patternToReplace));
        }

        $content = str_replace($newBrandFirst, '#_#saveReplace#_#', $content);
        $content = str_replace($replaceOld, $replaceNew, $content);
        $content = str_replace($keepWordingReplace, $keepWording, $content);

        return str_replace('#_#saveReplace#_#', $newBrandFirst, $content);
    }

    public static function completeUrl($path)
    {

        if(empty($path)) {
            $path = '/';
        }

        $external = $path ? strpos($path, '://') : false;
        if ($external !== false) {
            return $path; // we only rewrite internal links
        }
        //if (strpos($path, '://') !== false) {
        //    return $path; // we only rewrite internal links
        //}

        $urlPrefix = self::getCurrentUrlPrefix();
        $internal = $path ? strpos($path, $urlPrefix) : false;

        if ($urlPrefix && $internal === 0) {
            return $path;
        } elseif ($urlPrefix) {
            return $urlPrefix . $path;
        }

        return $path;
    }

    // returns the piwik versions that can be chosen via the selector
    public static function getAvailablePiwikVersions()
    {
        return range(MIN_PIWIK_DOCS_VERSION, LATEST_PIWIK_DOCS_VERSION);
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
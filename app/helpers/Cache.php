<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Cache
{
    private static $folder = '../tmp/cache';

    public static function get($key)
    {
        if (!static::isEnabled()) {
            return;
        }

        $key = static::getKey($key);

        if (empty($key)) {
            return;
        }

        if (!file_exists($key)) {
            return;
        }

        $content = file_get_contents($key);

        if (!empty($content)) {

            return $content;
        }
    }

    public static function set($key, $content)
    {
        if (!static::isEnabled()) {
            return;
        }

        if (empty($content)) {
            return;
        }

        if (empty($key)) {
            return;
        }

        $key = static::getKey($key);

        file_put_contents($key, $content);
    }

    private static function isEnabled()
    {
        return (defined('CACHING_ENABLED') && CACHING_ENABLED);
    }

    private static function getKey($key)
    {
        return static::$folder . '/' . $key;
    }

    public static function invalidate()
    {
        static::unlinkRecursive(static::$folder);
    }

    private static function unlinkRecursive($dir)
    {
        if (!$dh = @opendir($dir)) {
            return;
        }

        while (false !== ($obj = readdir($dh))) {
            if ($obj && $obj[0] == '.') {
                continue;
            }

            $fileOrDir = $dir . '/' . $obj;

            if (!@unlink($fileOrDir)) {
                static::unlinkRecursive($fileOrDir);
            }

            if (is_dir($fileOrDir)) {
                rmdir($fileOrDir);
            }
        }

        closedir($dh);
    }

}
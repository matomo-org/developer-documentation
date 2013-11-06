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
    public static function get($key)
    {
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

    private static function getKey($key)
    {
        return '../tmp/cache/' . $key;
    }

    public static function set($key, $content)
    {
        if (empty($content)) {
            return;
        }

        if (empty($key)) {
            return;
        }

        $key = static::getKey($key);

        file_put_contents($key, $content);
    }
}
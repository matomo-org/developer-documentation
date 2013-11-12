<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Git
{
    public static function getCurrentShortRevision()
    {
        $cached = Cache::get('git_revision');

        if (!empty($cached)) {
            return $cached;
        }

        $rev = shell_exec('git rev-parse --short HEAD');

        if (empty($rev)) {
            return '';
        }

        $rev = trim($rev);

        Cache::set('git_revision', $rev);

        return $rev;
    }

}
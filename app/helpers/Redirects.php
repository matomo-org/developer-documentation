<?php
/**
 * Piwik - Open source web analytics
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Redirects
{
    public static function getRedirects()
    {
        return [
            '/guides'                     => '/',
            '/contributing'               => '/guides/contributing-to-piwik-core',
            '/plugins'                    => '/develop',
            '/api-reference/metadata'     => '/api-reference/reporting-api-metadata',
            '/api-reference/segmentation' => '/api-reference/reporting-api-segmentation',
            '/guides/automated-tests'     => '/guides/tests',
            '/guides/mvc-in-piwik'        => '/guides/controllers',
            '/guides/mvc-models'          => '/guides/apis',
            '/guides/mvc-views'           => '/guides/views',
            '/guides/mvc-controllers'     => '/guides/controllers',
        ];
    }
}

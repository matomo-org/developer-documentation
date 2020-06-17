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
            '/guides'                          => '/',
            '/guides/'                         => '/',
            '/api-reference/PHP-Piwik-Tracker' => '/api-reference/PHP-Matomo-Tracker',
            '/api-reference/PHP-Piwik-Tracker/' => '/api-reference/PHP-Matomo-Tracker/',
            '/api-reference/php-piwik-tracker/' => '/api-reference/PHP-Matomo-Tracker/',
            '/api-reference/php-piwik-tracker' => '/api-reference/PHP-Matomo-Tracker/',
            '/contributing'                    => '/guides/contributing-to-piwik-core',
            '/plugins'                         => '/develop',
            '/core'                            => '/piwik-in-depth',
            '/api-reference/metadata'          => '/api-reference/reporting-api-metadata',
            '/api-reference/segmentation'      => '/api-reference/reporting-api-segmentation',
            '/guides/automated-tests'          => '/guides/tests',
            '/guides/mvc-in-piwik'             => '/guides/controllers',
            '/guides/mvc-models'               => '/guides/apis',
            '/guides/mvc-views'                => '/guides/views',
            '/guides/mvc-controllers'          => '/guides/controllers',
            '/guides/all-about-analytics-data' => '/guides/data-model',
            '/guides/all-about-tracking'       => '/guides/tracking-introduction',
            '/guides/getting-started-part-2'   => '/guides/report',
            '/guides/internationalization'     => '/guides/translations',
            '/guides/persistence-and-the-mysql-backend' => '/guides/database-schema',
        ];
    }
}

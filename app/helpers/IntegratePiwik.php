<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class IntegratePiwik {

    private static function getUrl($key)
    {
        return '/integration/' . $key;
    }

    public static function getMenuItemByUrl($url)
    {
        foreach (static::getMainMenu() as $category) {
            foreach ($category['items'] as $menu) {
                if ($url == $menu['url']) {
                    return $menu;
                }
            }
        }
        return null;
    }

    public static function getMainMenu()
    {
        return [
            [
                'category' => 'Tracking your application',
                'id'       => 'tracking',
                'items'    => [
                    [
                        'title'       => 'All about Tracking',
                        'file'        => 'all-about-tracking',
                        'url'         => static::getUrl('all-about-tracking'),
                        'description' => 'Learn in detail about how Piwik\'s tracking system works.',
                    ],
                    [
                        'title'       => 'Content tracking',
                        'file'        => 'content-tracking',
                        'url'         => static::getUrl('content-tracking'),
                        'description' => 'Learn how to track content in Piwik.',
                    ],
                    [
                        'title'       => 'The Javascript tracking client [API reference]',
                        'url'         => ApiReference::getUrl('tracking-javascript'),
                        'description' => 'The reference documentation for the Javascript tracking client.',
                    ],
                    [
                        'title'       => 'The Tracking HTTP API [API reference]',
                        'url'         => ApiReference::getUrl('tracking-api'),
                        'description' => 'The reference documentation for the Tracking HTTP API.',
                    ],
                ],
            ],
            [
                'category' => 'Accessing Piwik reports',
                'id'       => 'reporting',
                'items'    => [
                    [
                        'title'       => 'Getting started using the Reporting API',
                        'file'        => 'reporting-api-tutorial',
                        'url'         => static::getUrl('reporting-api-tutorial'),
                        'description' => 'The Reporting API tutorial in less than one minute.',
                    ],
                    [
                        'title'       => 'Piwik\'s Reporting API',
                        'file'        => 'piwiks-web-api',
                        'url'         => static::getUrl('piwiks-reporting-api'),
                        'description' => 'Learn how Piwik exposes API methods in its Reporting API and how third party applications can use its Tracking API.',
                    ],
                    [
                        'title'       => 'Querying the Reporting API',
                        'file'        => 'querying-the-reporting-api',
                        'url'         => static::getUrl('querying-the-reporting-api'),
                        'description' => 'Learn how to query for report data via HTTP requests and from within Piwik\'s source code.',
                    ],
                    [
                        'title'       => 'The Reporting API [API reference]',
                        'url'         => ApiReference::getUrl('reporting-api'),
                        'description' => 'The reference documentation for the Reporting HTTP API.',
                    ],
                    [
                        'title'       => 'The Metadata API [API reference]',
                        'url'         => ApiReference::getUrl('metadata'),
                        'description' => 'The reference documentation for querying report metadata.',
                    ],
                    [
                        'title'       => 'The Segmentation API [API reference]',
                        'url'         => ApiReference::getUrl('segmentation'),
                        'description' => 'View all available segment dimensions and segment operators.',
                    ],
                ],
            ],
            [
                'category' => 'Client libraries & SDK',
                'id'       => 'clients',
                'items'    => [
                    [
                        'title'       => 'Tracking clients (TODO)',
                        'file'        => 'tracking-clients',
                        'url'         => static::getUrl('tracking-clients'),
                        'description' => 'To be written…',
                    ],
                    [
                        'title'       => 'Reporting clients (TODO)',
                        'file'        => 'reporting-clients',
                        'url'         => static::getUrl('reporting-clients'),
                        'description' => 'To be written…',
                    ],
                ],
            ],
        ];
    }
}

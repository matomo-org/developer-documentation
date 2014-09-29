<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class DevelopPiwik
{
    private static function getUrl($key)
    {
        return '/contributing/' . $key;
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
                'category' => 'Contributing to Piwik',
                'id'       => 'introduction',
                'items'    => [
                    [
                        'title'       => 'Contributing to Piwik Core',
                        'file'        => 'contributing-to-piwik-core',
                        'url'         => static::getUrl('contributing-to-piwik-core'),
                        'description' => 'Learn how to contribute changes to Piwik Core. Learn about Piwik\'s coding standards and the contribution process.',
                    ],
                ],
            ],
            [
                'category' => 'How Piwik works',
                'id'       => 'internals',
                'items'    => [
                    [
                        'title'       => 'Piwik\'s INI Configuration',
                        'file'        => 'contributing/piwiks-ini-configuration',
                        'url'         => static::getUrl('piwiks-ini-configuration'),
                        'description' => 'Learn how Piwik reads and manipulates the INI configuration settings.',
                    ],
                ],
            ],
            [
                'category' => 'The development workflow',
                'id'       => 'workflow',
                'items'    => [
                    [
                        'title'       => 'The Core team workflow',
                        'file'        => 'core-team-workflow',
                        'url'         => static::getUrl('core-team-workflow'),
                        'description' => 'Learn how the core development team manages Piwik development and makes changes to the source code. Learn how you can participate in this process.',
                    ],
                    [
                        'title'       => 'Piwik\'s roadmap',
                        'url'         => 'http://piwik.org/roadmap/',
                        'description' => 'Our mission is to liberate web analytics worldwide, and help you grow your project with better data insights. Check out what else we have planned for the future.',
                    ],
                    [
                        'title'       => 'Changelog',
                        'url'         => '/changelog',
                        'description' => 'The changelog for released versions.',
                    ],
                    [
                        'title'       => 'Issues',
                        'url'         => 'https://github.com/piwik/piwik/issues',
                        'description' => 'Create a bug report on our bug tracking system or check on the status of an existing bug.',
                    ],
                ],
            ],
        ];
    }
}

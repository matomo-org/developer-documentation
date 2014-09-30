<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class DevelopPlugins
{
    private static function getUrl($key)
    {
        return '/guides/' . $key;
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

    public static function getCategoryName()
    {
        return 'Develop Plugins';
    }

    public static function getMainMenu()
    {
        return [
            [
                'category' => 'Getting started',
                'id'       => 'getting-started',
                'items'    => [
                    [
                        'title'       => 'Getting Started Part I: Setting Up',
                        'file'        => 'getting-started-part-1',
                        'url'         => static::getUrl('getting-started-part-1'),
                        'description' => 'Setup your development environment and create an empty Piwik plugin.',
                        'next'        => static::getUrl('getting-started-part-2'),
                    ],
                    [
                        'title'       => 'Getting Started Part II: Tour of Piwik Internals',
                        'file'        => 'getting-started-part-2',
                        'url'         => static::getUrl('getting-started-part-2'),
                        'description' => 'Learn the basics of Piwik plugin development by making your plugin define a new report.',
                        'next'        => static::getUrl('getting-started-part-3'),
                        'prev'        => static::getUrl('getting-started-part-1'),
                    ],
                    [
                        'title'       => 'Getting Started Part III: Extras',
                        'file'        => 'getting-started-part-3',
                        'url'         => static::getUrl('getting-started-part-3'),
                        'description' => 'Learn how to make plugins configurable and available in different languages by building on the result of part II.',
                        'prev'        => static::getUrl('getting-started-part-2'),
                    ],
                ],
            ],
            [
                'category' => 'Basics',
                'id'       => 'basics',
                'items'    => [
                    [
                        'title'       => 'MVC (Model-View-Controller) in Piwik',
                        'file'        => 'mvc-in-piwik',
                        'url'         => static::getUrl('mvc-in-piwik'),
                        'description' => 'Learn how Piwik handles HTTP requests and how Piwik generates the HTML that is displayed to the user.',
                    ],
                    [
                        'title'       => 'Configuration',
                        'file'        => 'piwik-configuration',
                        'url'         => static::getUrl('piwik-configuration'),
                        'description' => 'Learn how Piwik is configured and how plugins can define their own configuration settings.',
                    ],
                    [
                        'title'       => 'Make your plugin configurable',
                        'url'         => 'http://piwik.org/blog/2014/09/make-plugin-configurable-introducing-piwik-platform/',
                        'description' => 'Learn how to define settings for your plugin.',
                    ],
                    [
                        'title'       => 'Persistence & MySQL',
                        'file'        => 'persistence-and-the-mysql-backend',
                        'url'         => static::getUrl('persistence-and-the-mysql-backend'),
                        'description' => 'Learn about what log data and analytics data consists of and about how it is stored in Piwik\'s MySQL database.',
                    ],
                    [
                        'title'       => 'Security',
                        'file'        => 'security-in-piwik',
                        'url'         => static::getUrl('security-in-piwik'),
                        'description' => 'Learn how Piwik protects itself from potential attackers and how you can write secure code for your plugin.',
                    ],
                ],
            ],
            [
                'category' => 'Advanced topics',
                'id'       => 'advanced',
                'items'    => [
                    [
                        'title'       => 'Scheduled tasks',
                        'url'         => 'http://piwik.org/blog/2014/08/create-scheduled-task-introducing-piwik-platform/',
                        'description' => 'Learn how to execute scheduled tasks in the background, for instance sending a daily email.',
                    ],
                    [
                        'title'       => 'Widgets',
                        'url'         => 'http://piwik.org/blog/2014/09/create-widget-introducing-piwik-platform/',
                        'description' => 'Learn how to easily create a new widget.',
                    ],
                    [
                        'title'       => 'Adding pages and menu items',
                        'url'         => 'http://piwik.org/blog/2014/09/add-new-page-menu-item-piwik-introducing-piwik-platform/',
                        'description' => 'Get started in Controller, View and Menu API.',
                    ],
                    [
                        'title'       => 'All about Analytics Data',
                        'file'        => 'all-about-analytics-data',
                        'url'         => static::getUrl('all-about-analytics-data'),
                        'description' => 'Learn about how analytics reports are calculated and stored in Piwik (the Archiving Process) and how plugins can define their own reports.',
                    ],
                    [
                        'title'       => 'Internationalization',
                        'file'        => 'internationalization',
                        'url'         => static::getUrl('internationalization'),
                        'description' => 'Learn how Piwik makes its text available in many different languages and how your plugin can do the same.',
                    ],
                    [
                        'title'       => 'Tests',
                        'file'        => 'automated-tests',
                        'url'         => static::getUrl('automated-tests'),
                        'description' => 'Learn how to setup unit, integration and UI tests for your new plugin and how to work with Piwik Core\'s tests.',
                    ],
                    [
                        'title'       => 'Visualizing Report Data',
                        'file'        => 'visualizing-report-data',
                        'url'         => static::getUrl('visualizing-report-data'),
                        'description' => 'Learn about the different ways Piwik can display analytics data and how plugins can create new ways to display it.',
                    ],
                    [
                        'title'       => 'Working with Piwik\'s UI',
                        'file'        => 'working-with-piwiks-ui',
                        'url'         => static::getUrl('working-with-piwiks-ui'),
                        'description' => 'Learn about Piwik\'s JavaScript code and how to write JavaScript for your plugin.',
                    ],
                    [
                        'title'       => 'Piwik\'s extensibility points',
                        'file'        => 'piwiks-extensibility-points',
                        'url'         => static::getUrl('piwiks-extensibility-points'),
                        'description' => 'Learn about everything that allows Piwik to be extended including, the eventing system, report metadata, and plugins themselves.',
                    ],
                    [
                        'title'       => 'Piwik on the command line',
                        'file'        => 'piwik-on-the-command-line',
                        'url'         => static::getUrl('piwik-on-the-command-line'),
                        'description' => 'Learn about Piwik\'s command line tool and how your plugin can extend it.',
                    ],
                ],
            ],
            [
                'category' => 'Custom themes',
                'id'       => 'themes',
                'items'    => [
                    [
                        'title'       => 'How to create a custom theme',
                        'url'         => 'http://piwik.org/blog/2014/08/create-custom-theme-piwik-introducing-piwik-platform/',
                        'description' => 'Get started in customizing the look of Piwik.',
                    ],
                    [
                        'title'       => 'Theming',
                        'file'        => 'theming',
                        'url'         => static::getUrl('theming'),
                        'description' => 'Learn how themes can change Piwik\'s look and feel and how you can create your own.',
                    ],
                ],
            ],
            [
                'category' => 'The Marketplace',
                'id'       => 'marketplace',
                'items'    => [
                    [
                        'title'       => 'Distributing your plugin',
                        'file'        => 'distributing-your-plugin',
                        'url'         => static::getUrl('distributing-your-plugin'),
                        'description' => 'Learn how to share your completed plugin with all other Piwik users. Learn about the Piwik marketplace and how you can use it to distribute your plugin.',
                    ],
                ],
            ],
        ];
    }

    public static function getDocumentList()
    {
        $result = array();
        foreach (self::getMainMenu() as $category) {
            foreach ($category['items'] as $item) {
                $result[$item['url']] = $item['title'] . ' <em>(Guide)</em>';
            }
        }
        return $result;
    }
}

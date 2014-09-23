<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Guide {

    private static function getUrl($key)
    {
        return '/guides/' . $key;
    }

    public static function getMenuItemByUrl($url)
    {
        foreach (static::getMainMenu() as $items) {
            foreach ($items as $menu) {
                if ($url == $menu['url']) {
                    return $menu;
                }
            }
        }
    }

    public static function getMainMenu()
    {
        $menu = array();

        $menu[] = array(
            'title'       => 'Getting Started Part I: Setting Up',
            'file'        => 'getting-started-part-1',
            'url'         => static::getUrl('getting-started-part-1'),
            'description' => 'Setup your development environment and create an empty Piwik plugin.',
            'category'    => 'Getting Started',
            'next'        => static::getUrl('getting-started-part-2')
        );

        $menu[] = array(
            'title'       => 'Getting Started Part II: Tour of Piwik Internals',
            'file'        => 'getting-started-part-2',
            'url'         => static::getUrl('getting-started-part-2'),
            'description' => 'Learn the basics of Piwik plugin development by making your plugin define a new report.',
            'category'    => 'Getting Started',
            'next'        => static::getUrl('getting-started-part-3'),
            'prev'        => static::getUrl('getting-started-part-1')
        );

        $menu[] = array(
            'title'       => 'Getting Started Part III: Extras',
            'file'        => 'getting-started-part-3',
            'url'         => static::getUrl('getting-started-part-3'),
            'category'    => 'Getting Started',
            'description' => 'Learn how to make plugins configurable and available in different languages by building on the result of part II.',
            'prev'        => static::getUrl('getting-started-part-2')
        );

        $menu[] = array(
            'title'        => 'Getting started using the Reporting API',
            'file'         => 'reporting-api-tutorial',
            'url'          => static::getUrl('reporting-api-tutorial'),
            'description'  => 'The Reporting API tutorial in less than one minute.',
            'category'    => 'Getting Started'
        );

        $menu[] = array(
            'title'        => 'How to create a custom theme',
            'file'         => '',
            'url'          => 'http://piwik.org/blog/2014/08/create-custom-theme-piwik-introducing-piwik-platform/',
            'description'  => 'Get started in customizing the look of Piwik.',
            'category'    => 'Getting Started'
        );

        $menu[] = array(
            'title'        => 'How to create a scheduled task',
            'file'         => '',
            'url'          => 'http://piwik.org/blog/2014/08/create-scheduled-task-introducing-piwik-platform/',
            'description'  => 'Learn how to execute scheduled tasks in the background, for instance sending a daily email.',
            'category'    => 'Getting Started'
        );

        $menu[] = array(
            'title'        => 'How to create a widget',
            'file'         => '',
            'url'          => 'http://piwik.org/blog/2014/09/create-widget-introducing-piwik-platform/',
            'description'  => 'Learn how to easily create a new widget.',
            'category'    => 'Getting Started'
        );

        $menu[] = array(
            'title'        => 'How to create a widget',
            'file'         => '',
            'url'          => 'http://piwik.org/blog/2014/09/create-widget-introducing-piwik-platform/',
            'description'  => 'Learn how to easily create a new widget.',
            'category'    => 'Getting Started'
        );

        $menu[] = array(
            'title'        => 'How to add new pages and menu items',
            'file'         => '',
            'url'          => 'http://piwik.org/blog/2014/09/add-new-page-menu-item-piwik-introducing-piwik-platform/',
            'description'  => 'Get started in Controller, View and Menu API.',
            'category'     => 'Getting Started'
        );

        $menu[] = array(
            'title'        => 'How to make your plugin configurable',
            'file'         => '',
            'url'          => 'http://piwik.org/blog/2014/09/make-plugin-configurable-introducing-piwik-platform/',
            'description'  => 'Learn how to define settings for your plugin.',
            'category'     => 'Getting Started'
        );

        $menu[] = array(
            'title'       => 'All about Analytics Data',
            'file'        => 'all-about-analytics-data',
            'url'         => static::getUrl('all-about-analytics-data'),
            'description' => 'Learn about how analytics reports are calculated and stored in Piwik (the Archiving Process) and how plugins can define their own reports.',
            'category'    => 'In-depth guides'
        );

        $menu[] = array(
            'title'       => 'All about Tracking',
            'file'        => 'all-about-tracking',
            'url'         => static::getUrl('all-about-tracking'),
            'description' => 'Learn in detail about how Piwik\'s tracking system works.',
            'category'    => 'In-depth guides'
        );

        $menu[] = array(
            'title'       => 'MVC in Piwik',
            'file'        => 'mvc-in-piwik',
            'url'         => static::getUrl('mvc-in-piwik'),
            'description' => 'Learn how Piwik handles HTTP requests and how Piwik generates the HTML that is displayed to the user.',
            'category'    => 'In-depth guides'
        );

        $menu[] = array(
            'title'       => 'Content tracking',
            'file'        => 'content-tracking',
            'url'         => static::getUrl('content-tracking'),
            'description' => 'Learn how to track content in Piwik.',
            'category'    => 'In-depth guides'
        );

        $menu[] = array(
            'title'       => 'Piwik\'s Reporting API',
            'file'        => 'piwiks-web-api',
            'url'         => static::getUrl('piwiks-reporting-api'),
            'description' => 'Learn how Piwik exposes API methods in its Reporting API and how third party applications can use its Tracking API.',
            'category'    => 'Piwik HTTP APIs'
        );

        $menu[] = array(
            'title'        => 'Querying the Reporting API',
            'file'         => 'querying-the-reporting-api',
            'url'          => static::getUrl('querying-the-reporting-api'),
            'description'  => 'Learn how to query for report data via HTTP requests and from within Piwik\'s source code.',
            'category'    => 'Piwik HTTP APIs'
        );

        $menu[] = array(
            'title'       => 'Theming',
            'file'        => 'theming',
            'url'         => static::getUrl('theming'),
            'description' => 'Learn how themes can change Piwik\'s look and feel and how you can create your own.',
            'category'    => 'Piwik Development'
        );

        $menu[] = array(
            'title'        => 'Security in Piwik',
            'file'         => 'security-in-piwik',
            'url'          => static::getUrl('security-in-piwik'),
            'description'  => 'Learn how Piwik protects itself from potential attackers and how you can write secure code for your plugin.',
            'category'    => 'Piwik Development'
        );

        $menu[] = array(
            'title'        => 'Internationalization',
            'file'         => 'internationalization',
            'url'          => static::getUrl('internationalization'),
            'description'  => 'Learn how Piwik makes its text available in many different languages and how your plugin can do the same.',
            'category'    => 'Piwik Development'
        );

        $menu[] = array(
            'title'       => 'Automated Tests',
            'file'        => 'automated-tests',
            'url'         => static::getUrl('automated-tests'),
            'description' => 'Learn how to setup unit, integration and UI tests for your new plugin and how to work with Piwik Core\'s tests.',
            'category'    => 'Piwik Development'
        );

        $menu[] = array(
            'title'       => 'Visualizing Report Data',
            'file'        => 'visualizing-report-data',
            'url'         => static::getUrl('visualizing-report-data'),
            'description' => 'Learn about the different ways Piwik can display analytics data and how plugins can create new ways to display it.',
            'category'    => 'Piwik\'s UI'
        );

        $menu[] = array(
            'title'        => 'Working with Piwik\'s UI',
            'file'         => 'working-with-piwiks-ui',
            'url'          => static::getUrl('working-with-piwiks-ui'),
            'description'  => 'Learn about Piwik\'s JavaScript code and how to write JavaScript for your plugin.',
            'category'     => 'Piwik\'s UI'
        );

        $menu[] = array( // TODO: finish splitting up.
            'title'       => 'Piwik configuration',
            'file'        => 'piwik-configuration',
            'url'         => static::getUrl('piwik-configuration'),
            'description' => 'Learn how Piwik is configured and how plugins can define their own configuration settings.',
            'category'    => 'Piwik Configuration'
        );

        $menu[] = array(
            'title'       => 'Piwik\'s INI configuration',
            'file'        => 'piwiks-ini-configuration',
            'url'         => static::getUrl('piwiks-ini-configuration'),
            'description' => 'Learn how Piwik reads and manipulates the INI configuration settings.',
            'category'    => 'Piwik Configuration'
        );

        $menu[] = array(
            'title'       => 'Distributing your plugin',
            'file'        => 'distributing-your-plugin',
            'url'         => static::getUrl('distributing-your-plugin'),
            'description' => 'Learn how to share your completed plugin with all other Piwik users. Learn about the Piwik marketplace and how you can use it to distribute your plugin.',
            'category'    => 'Distributing your plugin'
        );

        // TODO: create guide for scheduled tasks
        $menu[] = array(
            'title'       => 'Piwik\'s extensibility points',
            'file'        => 'piwiks-extensibility-points',
            'url'         => static::getUrl('piwiks-extensibility-points'),
            'description' => 'Learn about everything that allows Piwik to be extended including, the eventing system, report metadata, and plugins themselves.',
            'category'    => 'Piwik Internals'
        );

        $menu[] = array(
            'title'       => 'Persistence & the MySQL Backend',
            'file'        => 'persistence-and-the-mysql-backend',
            'url'         => static::getUrl('persistence-and-the-mysql-backend'),
            'description' => 'Learn about what log data and analytics data consists of and about how it is stored in Piwik\'s MySQL database.',
            'category'    => 'Piwik Internals'
        );

        $menu[] = array(
            'title'       => 'Piwik on the command line',
            'file'        => 'piwik-on-the-command-line',
            'url'         => static::getUrl('piwik-on-the-command-line'),
            'description' => 'Learn about Piwik\'s command line tool and how your plugin can extend it.',
            'category'    => 'Piwik Internals'
        );

        $menu[] = array(
            'title'       => 'Contributing to Piwik Core',
            'file'        => 'contributing-to-piwik-core',
            'url'         => static::getUrl('contributing-to-piwik-core'),
            'description' => 'Learn how to contribute changes to Piwik Core. Learn about Piwik\'s coding standards and the contribution process.',
            'category'    => 'About the Piwik Project'
        );

        $menu[] = array(
            'title'       => 'Core Team Workflow',
            'file'        => 'core-team-workflow',
            'url'         => static::getUrl('core-team-workflow'),
            'description' => 'Learn how the core development team manages Piwik development and makes changes to the source code. Learn how you can participate in this process.',
            'category'    => 'About the Piwik Project'
        );

        /* TODO: Guide review. Ask following questions:
         - Are the titles appropriate to what is described within the guides?
        */

        $result = array();
        foreach ($menu as $item) {
            $result[$item['category']][$item['url']] = $item;
        }
        return $result;
    }

    public static function getDocumentList()
    {
        $result = array();
        foreach (self::getMainMenu() as $info) {
            $result[$info['url']] = $info['title'] . ' <em>(Guide)</em>';
        }
        return $result;
    }
}

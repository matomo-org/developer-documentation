<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace helpers;

class Twig {

    public static function registerFilter(\Twig_Environment $environment)
    {
        $environment->addFilter(static::getCompleteUrlFilter());
    }

    private static function getCompleteUrlFilter()
    {
        return new \Twig_SimpleFilter('completeUrl', function ($value) {
            return Environment::completeUrl($value);
        });
    }

}
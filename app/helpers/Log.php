<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

use Slim\Slim;

class Log {
    private static $log;

    public static function setLogger($log)
    {
        static::$log = $log;
    }

    public static function initForCli()
    {
        static::setLogger(new \Slim\Log(new \Slim\Extras\Log\DateTimeFileWriter(
            array('path' => __DIR__ . '/../../logs', 'name_format' => 'Y-m-d')
        )));
    }

    public static function debug($message)
    {
        static::log('debug', $message);
    }

    public static function info($message)
    {
        static::log('info', $message);
    }

    public static function warn($message)
    {
        static::log('warn', $message);
    }

    public static function error($message)
    {
        static::log('error', $message);
    }

    public static function alert($message)
    {
        static::log('alert', $message);
    }

    private static function log($level, $message)
    {
        $log = static::getLog();

        if (!empty($log)) {
            $log->$level($message);
        }
    }

    private static function getLog()
    {
        if (!empty(static::$log)) {
            return static::$log;
        }

        if (Slim::getInstance()) {

            return Slim::getInstance()->getLog();
        }
    }
}
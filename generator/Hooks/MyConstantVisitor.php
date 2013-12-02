<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @package Piwik
 */

namespace Hooks;

class MyConstantVisitor extends \PHPParser_NodeVisitorAbstract
{
    public static $constants = array();

    public function __construct()
    {
        self::$constants = array();
    }

    public function leaveNode(\PHPParser_Node $node) {

        if ($node instanceof \PHPParser_Node_Const) {

            $prettyPrinter = new \PHPParser_PrettyPrinter_Default();

            static::$constants[$node->name] = $prettyPrinter->prettyPrintExpr($node->value);
        }
    }
}
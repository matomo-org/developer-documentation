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

use Sami\Sami;

class MyHookVisitor extends \PHPParser\NodeVisitorAbstract
{
    private $events     = array();
    private $classes    = array();
    private $namespaces = array();
    private $piwikFile  = '';
    /**
     * @var Sami
     */
    private $sami;

    public function __construct($piwikFile, $sami)
    {
        $this->piwikFile = $piwikFile;
        $this->sami = $sami;
    }

    private function getCurrentClass()
    {
        if (empty($this->classes)) {
            return '';
        }

        $len = count($this->classes);

        return $this->classes[$len - 1];
    }

    private function getCurrentNamespace()
    {
        if (empty($this->namespaces)) {
            return '';
        }

        $len = count($this->namespaces);

        return $this->namespaces[$len - 1];
    }

    public function enterNode(\PHPParser\Node $node)
    {
        if ($node instanceof \PHPParser\Node\Stmt\Namespace_) {

            if (!empty($node->name->parts[0])) {
                $this->namespaces[] = implode('/', $node->name->parts);
            }

        } elseif ($node instanceof \PHPParser\Node\Stmt\Class_) {

            $this->classes[] = $node->name;

        }
    }

    public function leaveNode(\PHPParser\Node $node) {

		if ($node instanceof \PhpParser\Node\Expr\StaticCall) {
			if (!$node->name || 'postEvent' !== (string) $node->name) {
                return;
            }

            if (empty($node->class->parts) || !in_array('Piwik', $node->class->parts)) {
                return;
            }

            $event = array(
                'name'      => '',
                'category'  => '',
                'arguments' => array(),
                'comment'   => null,
                'file'      => $this->piwikFile,
                'line'      => $node->getLine(),
                'class'     => $this->getCurrentClass(),
                'namespace' => $this->getCurrentNamespace(),
            );

            $args = $node->args;
            if (!empty($args)) {
                $eventArg = array_shift($args);

                $event['name']     = $this->getEventName($eventArg);
                $event['category'] = $this->getCategoryFromEventName($event['name']);
            }

            if (!empty($args)) {
                $event['arguments'] = $this->getArg(array_shift($args));
            }

            $docComment = $this->getDocComment($node);
            if (!empty($docComment)) {
                $event['comment'] = $docComment;
            } else {
                echo sprintf("Hook %s has no documentation\n", $event['name']);
            }

            if (!empty($event['comment']['ignore'])) {
                return;
            }

            $this->events[] = $event;
        }
    }

    public function afterTraverse(array $nodes)
    {
        return $this->events;
    }

    public function getArg(\PHPParser\Node\Arg $arg)
    {
        if ($arg->value instanceof \PHPParser\Node\Expr\ClassConstFetch) {

            $constant  = $arg->value;
            $rightPart = (string) $constant->name;

            if (array_key_exists($rightPart, MyConstantVisitor::$constants)) {
                return MyConstantVisitor::$constants[$rightPart];
            }
        }

        $prettyPrinter = new \PHPParser\PrettyPrinter\Standard();

        return $prettyPrinter->prettyPrintExpr($arg->value);
    }

    private function getDocComment(\PHPParser\Node $node)
    {
        $docComment = $node->getDocComment();
        if (empty($docComment)) {
            return;
        }

        $docParser = new \Sami\Parser\DocBlockParser();
        $parsedDoc = $docParser->parse($docComment->getText(), $this->sami->offsetGet('parser_context'));

        $ignore = $parsedDoc->getTag('ignore');

        return array(
            'raw'       => $docComment->getText(),
            'formatted' => $docComment->getReformattedText(),
            'shortDesc' => trim($parsedDoc->getShortDesc()),
            'longDesc'  => trim($parsedDoc->getLongDesc()),
            'ignore'    => !empty($ignore),
            'params'    => $parsedDoc->getTag('param')
        );
    }

    private function getEventName($eventArg)
    {
        $eventName = str_replace("'", '', $this->getArg($eventArg));

        if (false !== strpos($eventName, 'sprintf')) {
            $eventName = str_replace("sprintf(", '', $eventName);
            $eventName = str_replace(")", '', $eventName);

            $partsOfName = explode(', ', $eventName);
            if (2 <= count($partsOfName)) {
                $eventName = vsprintf(array_shift($partsOfName), $partsOfName);
            }
        }

        return $eventName;
    }

    private function getCategoryFromEventName($eventName)
    {
        $categories = explode('.', $eventName);

        return array_shift($categories);
    }
}
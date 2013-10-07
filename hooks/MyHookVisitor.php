<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @package Piwik
 */

class MyHookVisitor extends PHPParser_NodeVisitorAbstract
{
    private $events     = array();
    private $classes    = array();
    private $namespaces = array();
    private $piwikFile  = '';

    public function __construct($piwikFile)
    {
        $this->piwikFile = $piwikFile;
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

    public function enterNode(PHPParser_Node $node)
    {
        if ($node instanceof PHPParser_Node_Stmt_Namespace) {

            if (!empty($node->name->parts[0])) {
                $this->namespaces[] = implode('/', $node->name->parts);
            }

        } elseif ($node instanceof PHPParser_Node_Stmt_Class) {

            $this->classes[] = $node->name;

        }
    }

    public function leaveNode(PHPParser_Node $node) {

        if ($node instanceof PHPParser_Node_Expr_FuncCall) {
            $name = $node->name;

            if (is_null($name->parts)) {
                return;
            }

            if (!in_array('Piwik_PostEvent', $name->parts)) {
                return;
            }

            $event = array(
                'name'  => '',
                'file'  => $this->piwikFile,
                'line'  => $node->getLine(),
                'class' => $this->getCurrentClass(),
                'namespace' => $this->getCurrentNamespace(),
            );

            $docComment = $node->getDocComment();
            if (!empty($docComment)) {

                $docParser = new Sami\Parser\DocBlockParser();
                $parsedDoc = $docParser->parse($docComment->getText());

                $event['comment'] = array(
                    'raw'       => $docComment->getText(),
                    'formatted' => $docComment->getReformattedText(),
                    'shortDesc' => trim($parsedDoc->getShortDesc()),
                    'longDesc'  => trim($parsedDoc->getLongDesc())
                );
            }

            $args = $node->args;
            if (!empty($args)) {
                $eventArg  = array_shift($args);

                $event['name'] = $this->getArg($eventArg);

                $event['arguments'] = array();
                foreach ($args as $arg)  {
                    $event['arguments'][] = $this->getArg($arg);
                }
            }

            if (empty($docComment)) {
                echo sprintf("Hook %s has no documentation\n", $event['name']);
            }

            $this->events[] = $event;
        }
    }

    public function afterTraverse(array $nodes)
    {
        return $this->events;
    }

    public function getArg(PHPParser_Node_Arg $arg)
    {
        if ($arg->value instanceof PHPParser_Node_Expr_ClassConstFetch) {

            $constant  = $arg->value;
            $rightPart = $constant->name;

            if (array_key_exists($rightPart, MyConstantVisitor::$constants)) {
                return MyConstantVisitor::$constants[$rightPart];
            }
        }

        $prettyPrinter = new PHPParser_PrettyPrinter_Default();

        return $prettyPrinter->prettyPrintExpr($arg->value);
    }
}
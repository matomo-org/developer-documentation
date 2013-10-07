<?php

require 'MyConstantVisitor.php';
require 'MyHookVisitor.php';

class Hooks {

    /**
     * @var PHPParser_Parser
     */
    private $parser;

    public function __construct()
    {
        $this->parser = new PHPParser_Parser(new PHPParser_Lexer);
    }

    public function searchForHooksInFile($filename, $phpFile)
    {
        $code  = file_get_contents($phpFile);

        if (false === strpos($code, 'PostEvent')) {
            return array();
        }

        $stmts = $this->parser->parse($code);

        $traverser = new PHPParser_NodeTraverser();
        $traverser->addVisitor(new MyConstantVisitor());
        $traverser->addVisitor(new MyHookVisitor($filename));
        $hooks = $traverser->traverse($stmts);

        return $hooks;
    }

    public function sortHooksByName($hooks)
    {
        usort($hooks, function ($hook1, $hook2) {
            return $hook1['name'] > $hook2['name'] ? 1 : -1;
        });

        return $hooks;
    }

    public function generateDocumentation($viewVariables, $target)
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../template');
        $twig   = new Twig_Environment($loader, array());

        $documentation = $twig->render('hooks.twig', $viewVariables);

        file_put_contents($target, $documentation);
    }

}

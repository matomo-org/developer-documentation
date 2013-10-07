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

    function searchForHooksInFile($piwikDir, $phpFile)
    {
        $relativeFileName = str_replace($piwikDir, '', $phpFile);

        $code  = file_get_contents($phpFile);
        $stmts = $this->parser->parse($code);

        $traverser = new PHPParser_NodeTraverser();
        $traverser->addVisitor(new MyConstantVisitor());
        $traverser->addVisitor(new MyHookVisitor($relativeFileName));
        $hooks = $traverser->traverse($stmts);

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

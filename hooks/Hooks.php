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
            return strtolower($hook1['name']) > strtolower($hook2['name']) ? 1 : -1;
        });

        return $hooks;
    }

    public function addUsages($hooks)
    {
        foreach ($hooks as &$hook) {

            $hook['usages'] = array();

            $pluginNames = $this->getPluginNames();

            foreach ($pluginNames as $pluginName) {
                $plugin = \Piwik\PluginsManager::getInstance()->loadPlugin($pluginName);
                $registeredHooks = $plugin->getListHooksRegistered();

                if (array_key_exists($hook['name'], $registeredHooks)) {
                    $registeredMethod = $registeredHooks[$hook['name']];

                    if (!is_string($registeredMethod)) {
                        continue;
                    }

                    $className       = get_class($plugin);
                    $reflectionClass = new ReflectionClass($className);
                    $method = $reflectionClass->getMethod($registeredMethod);
                    $hook['usages'][] = array(
                        'methodName' => $method->getName(),
                        'startLine'  => $method->getStartLine(),
                        'className'  => $reflectionClass->getShortName(),
                        'namespace'  => $reflectionClass->getNamespaceName(),
                        'file'       => str_replace(PIWIK_INCLUDE_PATH, '', $reflectionClass->getFileName())
                    );
                }

            }
        }

        return $hooks;
    }

    protected function getPluginNames()
    {
        $pluginDirs = glob(PIWIK_INCLUDE_PATH . '/plugins/*', GLOB_ONLYDIR);

        $pluginNames = array();
        foreach ($pluginDirs as $pluginDir) {
            $pluginNames[] = basename($pluginDir);
        }

        return $pluginNames;
    }

    public function generateDocumentation($viewVariables, $target)
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../template');
        $twig   = new Twig_Environment($loader, array());

        $documentation = $twig->render('hooks.twig', $viewVariables);

        file_put_contents($target, $documentation);
    }

}

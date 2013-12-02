<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

use Sami\Reflection\ClassReflection;

abstract class ApiReferenceFormatter extends Formatter {

    protected function isLinkToExternalClass(Link $link)
    {
        return 0 < strpos($link->getDestination(), '::');
    }

    protected function parseLinkToExternalClass(Link $link)
    {
        return explode('::', $link->getDestination());
    }

    protected function isMethodLink($method)
    {
        return $this->stringEndsWith($method, '()');
    }

    /**
     * @param string $className
     * @return ClassReflection|null
     */
    protected function getApiClass($className)
    {
        if (array_key_exists($className, $this->scope->classes)) {

            return $this->scope->classes[$className];
        }

        $classWithNamespace = $this->scope->namespace . '\\' . $className;

        if ($this->scope->namespace && array_key_exists($classWithNamespace, $this->scope->classes)) {

            return $this->scope->classes[$classWithNamespace];
        }
    }

    protected function isPropertyLink($property)
    {
        return (0 === strpos($property, '$'));
    }

    protected function getLinkToApiClass($className)
    {
        $class = $this->getApiClass($className);

        if (empty($class)) {
            return;
        }

        $className = $class->getName(); // classname including namespace
        $className = str_replace('\\', '/', $className);

        return '/api-reference/' . $className;
    }

    private function stringEndsWith($haystack, $needle)
    {
        if ('' === $needle) {
            return true;
        }

        $lastCharacters = substr($haystack, -strlen($needle));

        return $lastCharacters === $needle;
    }
}
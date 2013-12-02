<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

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

    protected function isPropertyLink($property)
    {
        return (0 === strpos($property, '$'));
    }

    protected function getLinkToApiClass($className)
    {
        $class = $this->scope->findClass($className);

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
<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class PhpInternalFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        if ($this->isPhpFunction($link)) {
            return $this->formatPhpFunction($link);
        } else if ($this->isPhpClass($link)) {
            return $this->formatPhpClass($link);
        }
    }

    private function isPhpFunction(Link $link)
    {
        $functionName = $link->getDestination();

        if (!$this->isMethodLink($functionName)) {
            return;
        }

        $functionName = substr($functionName, 0, -2);

        if (!function_exists($functionName)) {
            return false;
        }

        $functionReflection = new \ReflectionFunction($functionName);

        return $functionReflection->isInternal();
    }

    private function isPhpClass(Link $link)
    {
        $className = $link->getDestination();

        if (!class_exists($className, false)) {
            return false;
        }

        $classReflection = new \ReflectionClass($link->getDestination());

        return $classReflection->isInternal();
    }

    private function formatPhpClass(Link $link)
    {
        $link = sprintf('[%s](http://php.net/class.%s)', $link->getDescription(), $link->getDestination());

        return $link;
    }

    private function formatPhpFunction(Link $link)
    {
        $link = sprintf('[%s](http://php.net/function.%s)', $link->getDescription(), $link->getDestination());

        return $link;
    }

}
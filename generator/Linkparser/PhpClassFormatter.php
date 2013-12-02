<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class PhpClassFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        if ($this->isPhpClass($link)) {
            return $this->formatPhpClass($link);
        }
    }

    private function isPhpClass(Link $link)
    {
        $className = $link->getDestination();

        if (!class_exists($className, false)) {
            return false;
        }

        $r = new \ReflectionClass($link->getDestination());

        return $r->isInternal();
    }

    private function formatPhpClass(Link $link)
    {
        $link = sprintf('[%s](http://php.net/class.%s)', $link->getDescription(), $link->getDestination());

        return $link;
    }

}
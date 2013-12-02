<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class InternalMethodFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        if ($this->isInternalMethod($link)) {
            return $this->formatInternalMethod($link);
        }
    }

    private function isInternalMethod(Link $link)
    {
        return $this->isMethodLink($link->getDestination()) && !$this->isLinkToExternalClass($link);
    }

    private function formatInternalMethod(Link $link)
    {
        $methodName = substr($link->getDestination(), 0, strlen($link->getDestination()) -2);

        if (empty($this->scope->class)) {
            return;
        }

        $methods = $this->scope->class->getMethods(true);

        if (empty($methodName) || !array_key_exists($methodName, $methods)) {
            return;
        }

        $linkToClass = $this->getLinkToApiClass($this->scope->class->getName());

        return sprintf('[%s](%s#%s)', $link->getDescription(), $linkToClass, strtolower($methodName));
    }
}
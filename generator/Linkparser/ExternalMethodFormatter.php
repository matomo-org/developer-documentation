<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class ExternalMethodFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        if ($this->isExternalMethod($link)) {
            return $this->formatExternalMethod($link);
        }
    }

    private function isExternalMethod(Link $link)
    {
        if ($this->isLinkToExternalClass($link)) {

            list($className, $method) = $this->parseLinkToExternalClass($link);

            if ($this->isMethodLink($method) && $this->getApiClass($className)) {
                return true;
            }

        }
    }

    private function formatExternalMethod(Link $link)
    {
        list($className, $method) = $this->parseLinkToExternalClass($link);

        $class      = $this->getApiClass($className);
        $methodName = substr($method, 0, strlen($method) -2);

        $methodInstance = $class->getMethod($methodName);

        if (empty($methodInstance)) {
            return;
        }

        $linkToClass = $this->getLinkToApiClass($className);

        return sprintf('[%s](%s#%s)', $link->getDescription(), $linkToClass, strtolower($methodName));
    }

}
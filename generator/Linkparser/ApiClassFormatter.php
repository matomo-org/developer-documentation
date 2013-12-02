<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class ApiClassFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        if ($this->isApiClass($link)) {
            return $this->formatApiClass($link);
        }
    }

    private function isApiClass(Link $link)
    {
        $class = $this->findApiClass($link);

        return !empty($class) && $class->isProjectClass();
    }

    /**
     * @param Link $link
     * @return null|\Sami\Reflection\ClassReflection
     */
    private function findApiClass(Link $link)
    {
        return $this->scope->findClass($link->getDestination());
    }

    private function formatApiClass(Link $link)
    {
        $linkToClass = $this->getLinkToApiClass($link->getDestination());

        if (empty($linkToClass)) {
            return;
        }

        $class = $this->findApiClass($link);
        $link  = sprintf('[%s](%s)', $class->getShortName(), $linkToClass);

        return $link;
    }

}
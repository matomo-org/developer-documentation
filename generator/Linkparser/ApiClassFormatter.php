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
        $class = $this->scope->findClass($link->getDestination());

        return !empty($class) && $class->isProjectClass();
    }

    private function formatApiClass(Link $link)
    {
        $linkToClass = $this->getLinkToApiClass($link->getDestination());

        if (empty($linkToClass)) {
            return;
        }

        $description = $link->getDescription();
        $parts = explode("\\", $description);
        $description = end($parts);

        $link = sprintf('[%s](%s)', $description, $linkToClass);

        return $link;
    }

}
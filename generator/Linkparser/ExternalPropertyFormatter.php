<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class ExternalPropertyFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        if ($this->isExternalProperty($link)) {
            return $this->formatExternalProperty($link);
        }
    }

    private function isExternalProperty(Link $link)
    {
        if ($this->isLinkToExternalClass($link)) {

            list($className, $property) = $this->parseLinkToExternalClass($link);

            if ($this->isPropertyLink($property) && $this->scope->findClass($className)) {
                return true;
            }
        }

        return false;
    }

    private function formatExternalProperty(Link $link)
    {
        list($className, $property) = $this->parseLinkToExternalClass($link);

        $class        = $this->scope->findClass($className);
        $properties   = $class->getProperties(true);
        $propertyName = substr($property, 1);

        if (!$propertyName || !array_key_exists($propertyName, $properties)) {
            return;
        }

        $linkToClass = $this->getLinkToApiClass($className);

        $description = $link->getDescription();
        $description = str_replace('Piwik\\', '', $description);

        return sprintf('[%s](%s#$%s)', $description, $linkToClass, strtolower($propertyName));
    }


}
<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class InternalPropertyFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        if ($this->isPropertyLink($link->getDestination()) && !$this->isLinkToExternalClass($link)) {
            return $this->formatInternalProperty($link);
        }
    }

    private function formatInternalProperty(Link $link)
    {
        $properties   = $this->scope->class->getProperties(true);
        $propertyName = substr($link->getDestination(), 1);

        if (!array_key_exists($propertyName, $properties)) {
            return;
        }

        return sprintf('[%s](#$%s)', $link->getDescription(), strtolower($propertyName));
    }
}
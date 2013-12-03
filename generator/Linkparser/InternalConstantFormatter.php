<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class InternalConstantFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        if ($this->isInternalConstant($link)) {
            return $this->formatInternalConstant($link);
        }
    }

    private function isInternalConstant(Link $link)
    {
        return $this->isConstantLink($link->getDestination()) && !$this->isLinkToExternalClass($link);
    }

    private function formatInternalConstant(Link $link)
    {
        $constName = $link->getDestination();

        if (empty($this->scope->class) || empty($constName)) {
            return;
        }

        $constants = $this->scope->class->getConstants(true);

        if (!array_key_exists($constName, $constants)) {
            return;
        }

        $constant = $constants[$constName];

        if (!$constant) {
            return;
        }

        $description = $link->getDescription();

        if ($constant->getLongDesc()) {
            // we are displaying a link only to constants having a long description.
            $linkToClass = $this->getLinkToApiClass($this->scope->class->getName());

            return sprintf('`[%s](%s#%s)`', $description, $linkToClass, strtolower($constant));
        }

        return sprintf('`%s`', $description);
    }
}
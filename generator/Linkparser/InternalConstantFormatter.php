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

        // we are displaying only constants having a long description.
        if (!$constant || !$constant->getLongDesc()) {
            return;
        }

        $linkToClass = $this->getLinkToApiClass($this->scope->class->getName());

        return sprintf('[%s](%s#%s)', $link->getDescription(), $linkToClass, strtolower($constant));
    }
}
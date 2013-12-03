<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class ExternalConstantFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        if ($this->isExternalConstant($link)) {
            return $this->formatExternalConstant($link);
        }
    }

    private function isExternalConstant(Link $link)
    {
        if ($this->isLinkToExternalClass($link)) {

            list($className, $constant) = $this->parseLinkToExternalClass($link);

            if ($this->isConstantLink($constant) && $this->scope->findClass($className)) {
                return true;
            }
        }
    }

    private function formatExternalConstant(Link $link)
    {
        list($className, $constantName) = $this->parseLinkToExternalClass($link);

        $class     = $this->scope->findClass($className);
        $constants = $class->getConstants(true);

        if (!array_key_exists($constantName, $constants)) {
            return;
        }

        $constant = $constants[$constantName];

        // we are displaying only constants having a long description.
        if (!$constant || !$constant->getLongDesc()) {
            return;
        }

        $linkToClass = $this->getLinkToApiClass($className);

        $description = $link->getDescription();
        $description = str_replace('Piwik\\', '', $description);

        return sprintf('[%s](%s#%s)', $description, $linkToClass, strtolower($constantName));
    }
}
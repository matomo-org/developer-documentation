<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class DefaultFormatter extends ApiReferenceFormatter {

    public function formatting(Link $link)
    {
        $this->logUnresolvedLink($link);

        $description = $link->getDescription();
        $description = $this->makeSureDescriptionGetsNotEmphasizedAccidentally($description);

        return $description;
    }

    private function logUnresolvedLink(Link $link)
    {
        $blacklist = array('array', 'string', 'mixed', 'int', 'integer', 'bool', 'boolean');

        if (in_array($link->getDestination(), $blacklist)) {
            return;
        }

        $message = 'Unresolved link: "' . $link->getDestination() . '"';

        if (empty($this->scope->class) && $this->scope->namespace) {
            $message .= ' in Namespace '  . $this->scope->namespace;
        } elseif (!empty($this->scope->class)) {
            $message .= ' in Class ' . $this->scope->class;
        }

        error_log($message);
    }

    private function makeSureDescriptionGetsNotEmphasizedAccidentally($description)
    {
        return str_replace('_', '\_', $description);
    }
}
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
        return $link->getDescription();
    }
}
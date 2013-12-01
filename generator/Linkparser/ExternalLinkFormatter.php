<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class ExternalLinkFormatter extends Formatter {

    public function formatting(Link $link)
    {
        return $this->formatExternalLink($link->getDestination(), $link->getDescription());
    }

    private function formatExternalLink($destination, $description)
    {
        if (0 === strpos($destination, 'http')) {

            return sprintf('[%s](%s)', $description, $destination);

        } else if (0 === strpos($destination, 'mailto:')) {

            $text = str_replace('mailto:', '', $description);

            return sprintf('[%s](%s)', $text, $destination);
        }
    }

}
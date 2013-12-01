<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class Link {

    private $destination;
    private $description;

    public function __construct($link)
    {
        list($this->destination, $this->description) = $this->parseLinkAndDescription($link);
    }

    private function parseLinkAndDescription($link)
    {
        $link        = trim($link);
        $description = $link;

        if ($this->containsDescription($link)) {
            $parts = explode(' ', $link);

            $link        = array_shift($parts);
            $description = implode(' ', $parts);
        }

        return array($link, $description);
    }

    private function containsDescription($link)
    {
        return false !== strpos($link, ' ');
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function getDescription()
    {
        return !empty($this->description) ? $this->description : $this->destination;
    }

}
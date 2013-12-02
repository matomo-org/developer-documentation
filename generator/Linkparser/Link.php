<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class Link {

    /**
     * @var string
     */
    private $destination;

    /**
     * @var string
     */
    private $description;

    public function __construct($link)
    {
        list($this->destination, $this->description) = $this->parseLinkAndDescription($link);
    }

    private function parseLinkAndDescription($destination)
    {
        $destination = trim($destination);
        $description = $destination;

        if ($this->containsDescription($destination)) {
            $parts = explode(' ', $destination);

            $destination = array_shift($parts);
            $description = implode(' ', $parts);
        }

        return array($destination, $description);
    }

    private function containsDescription($destination)
    {
        return false !== strpos($destination, ' ');
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
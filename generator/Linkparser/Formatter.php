<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

abstract class Formatter {

    /**
     * @var Scope
     */
    protected $scope;

    /**
     * @param Scope $scope
     */
    public function __construct($scope)
    {
        $this->scope = $scope;
    }

    /**
     * @var Formatter
     */
    private $successor = null;

    /**
     * @param Formatter $formatter
     */
    final public function append(Formatter $formatter)
    {
        if (is_null($this->successor)) {
            $this->successor = $formatter;
        } else {
            $this->successor->append($formatter);
        }
    }

    /**
     * Format the link.
     *
     * @param Link $link
     *
     * @return bool
     */
    final public function format(Link $link)
    {
        $formatted = $this->formatting($link);

        if (empty($formatted)) {
            // the link has not been formatted by this formatter, try next formatter
            if (!is_null($this->successor)) {
                $formatted = $this->successor->format($link);
            }
        }

        return $formatted;
    }

    /**
     * Each concrete formatter has to implement the formatting of the link
     *
     * @param Link $link
     */
    abstract protected function formatting(Link $link);

}
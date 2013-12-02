<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class Scope {

    /**
     * @var \Sami\Reflection\ClassReflection|null
     */
    public $class = null;

    /**
     * @var \Sami\Reflection\ClassReflection[]
     */
    public $classes = array();

    /**
     * @var string|null
     */
    public $namespace = null;
}
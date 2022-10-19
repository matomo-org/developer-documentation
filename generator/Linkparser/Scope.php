<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

use Sami\Reflection\ClassReflection;
use Sami\Reflection\ConstantReflection;

class Scope {

    /**
     * @var ClassReflection|null
     */
    public $class = null;

    /**
     * @var ClassReflection[]
     */
    public $classes = array();

    /**
     * @var string|null
     */
    public $namespace = null;

    /**
     * @param string $className
     * @return ClassReflection|null
     */
    public function findClass($className)
    {
	    $className= (string) $className;
        if (empty($className)) {
            return;
        }

        if (0 === strpos($className, '\\')) {
            $className = substr($className, 1);
        }

        if (!empty($className) && array_key_exists($className, $this->classes)) {
            return $this->classes[$className];

        }

        if (empty($this->namespace)) {
            return;
        }

        $namespacedClassname = $this->namespace . '\\' . $className;

        if (!empty($namespacedClassname) && array_key_exists($namespacedClassname, $this->classes)) {
            return $this->classes[$namespacedClassname];
        }
    }
}
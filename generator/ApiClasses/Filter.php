<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace ApiClasses;

use \Sami\Reflection\ClassReflection;
use \Sami\Reflection\MethodReflection;
use \Sami\Reflection\PropertyReflection;

/**
 * Class ApiFilter
 * Accept a class, method or property only if doc block contains a tag "@api".
 */
class Filter extends \Sami\Parser\Filter\DefaultFilter {

    public function acceptClass(ClassReflection $class)
    {
        if (!class_exists($class->getName())) {
            return false;
        }

        if ($this->inheritsFromBlacklistedClass($class)) {
            return false;
        }

        if ($this->shouldBeIgnored($class)) {
            return false;
        }

        if ($this->hasApiTag($class)) {
            return true;
        }

        if ($this->isAnyMethodAnApi($class)) {
            return true;
        }

        if ($this->isAnyPropertyAnApi($class)) {
            return true;
        }

        return false;
    }

    public function acceptMethod(MethodReflection $method)
    {
        if ($method->isPrivate()) {
            return false;
        }

        if ($method->isProtected() && !$this->hasApiTag($method)) {
            return false;
        }

        if ($this->shouldBeIgnored($method)) {
            return false;
        }

        if ($this->hasApiTag($method)) {
            return true;
        }

        if ($this->hasApiTag($method->getClass())) {
            return true;
        }

        return false;
    }

    public function acceptProperty(PropertyReflection $property)
    {
        if ($property->isPrivate()) {
            return false;
        }

        if ($property->isProtected() && !$this->hasApiTag($property)) {
            return false;
        }

        if ($this->hasApiTag($property)) {
            return true;
        }

        if ($this->hasApiTag($property->getClass())) {
            return true;
        }

        return false;
    }

    private function shouldBeIgnored(\Sami\Reflection\Reflection $reflection)
    {
        $ignoreTags = ($reflection->getTags('ignore'));

        return !empty($ignoreTags);
    }

    private function inheritsFromBlacklistedClass(ClassReflection $class)
    {
        $rc = new \ReflectionClass($class->getName());

        if ($rc->isSubclassOf('Symfony\Component\Console\Command\Command')) {
            return true;
        }
        
        if ($rc->isSubclassOf('Piwik\Plugin\Tasks')) {
            return true;
        }

        if ($rc->isSubclassOf('Piwik\Plugin\Widgets')) {
            return true;
        }
        
        if ($rc->isSubclassOf('Piwik\Plugin\Archiver')) {
            return true;
        }

        if ($rc->isSubclassOf('Piwik\Plugin\Menu')) {
            return true;
        }

        if ($rc->isSubclassOf('Piwik\Plugin\Segment')) {
            return true;
        }

        if ($rc->isSubclassOf('Piwik\Plugin\Report')) {
            return true;
        }

        if ($rc->isSubclassOf('Piwik\Plugin\Visualization')) {
            return true;
        }

        $trackingDimensions = array(
            'Piwik\Plugin\Dimension\ActionDimension',
            'Piwik\Plugin\Dimension\ConversionDimension',
            'Piwik\Plugin\Dimension\VisitDimension',
        );

        if (in_array($rc->getName(), $trackingDimensions)) {
            return false;
        }

        if ($rc->isSubclassOf('Piwik\Columns\Dimension') ||
            $rc->isSubclassOf('Piwik\Plugin\Dimension\ActionDimension') ||
            $rc->isSubclassOf('Piwik\Plugin\Dimension\ConversionDimension') ||
            $rc->isSubclassOf('Piwik\Plugin\Dimension\VisitDimension')) {

            return true;
        }

        return $rc->isSubclassOf('Piwik\Plugin\Controller');
    }


    private function hasApiTag(\Sami\Reflection\Reflection $reflection)
    {
        $apiTags = ($reflection->getTags('api'));

        return !empty($apiTags);
    }

    private function isAnyMethodAnApi(ClassReflection $class)
    {
        $rc = new \ReflectionClass($class->getName());

        $methods = $rc->getMethods();
        foreach ($methods as $method) {
            $docComment = $method->getDocComment();

            if (false !== strpos($docComment, '@api')) {
                return true;
            }
        }

        return false;
    }

    private function isAnyPropertyAnApi(ClassReflection $class)
    {
        $rc = new \ReflectionClass($class->getName());

        $props = $rc->getProperties();
        foreach ($props as $prop) {
            $docComment = $prop->getDocComment();

            if (false !== strpos($docComment, '@api')) {
                return true;
            }
        }

        return false;
    }
}

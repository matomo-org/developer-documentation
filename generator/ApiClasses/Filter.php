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
        if (!class_exists($class->getName())
            && !interface_exists($class->getName())
        ) {
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

        if (!empty($ignoreTags)) {
            return true;
        }

        $ignoreTags = ($reflection->getTags('internal'));

        if (!empty($ignoreTags)) {
            return true;
        }

        // fixes in some cases the tags are not recognoized
        $docComment = $reflection->getDocComment() ?? "";

        if (false !== strpos($docComment, ' @internal')) {
            return true;
        }

        if (false !== strpos($docComment, ' @ignore')) {
            return true;
        }

        return false;
    }

    private function isSubclassOf(\ReflectionClass $rc, $subclass)
    {
        if (!class_exists($subclass)) {
            return false;
        }

        return $rc->isSubclassOf($subclass);
    }

    private function inheritsFromBlacklistedClass(ClassReflection $class)
    {
        $rc = new \ReflectionClass($class->getName());

        if ($this->isSubclassOf($rc, 'Symfony\Component\Console\Command\Command')) {
            return true;
        }

        if ($this->isSubclassOf($rc, 'Piwik\Plugin\Tasks')) {
            return true;
        }

        if ($this->isSubclassOf($rc, 'Piwik\Plugin\Widgets')
            || $this->isSubclassOf($rc, 'Piwik\Widget\Widget')
            || $this->isSubclassOf($rc, 'Piwik\Widget\WidgetContainerConfig')
            || $this->isSubclassOf($rc, 'Piwik\Widget\ReportWidgetConfig')) {
            return true;
        }

        if ($this->isSubclassOf($rc, 'Piwik\Plugin\Archiver')) {
            return true;
        }

        if ($this->isSubclassOf($rc, 'Piwik\Settings\Settings')) {
            return true;
        }

        if ($this->isSubclassOf($rc, 'Piwik\Plugin\Menu')) {
            return true;
        }

        if ($this->isSubclassOf($rc, 'Piwik\Plugin\Segment')) {
            return true;
        }

        if ($this->isSubclassOf($rc, 'Piwik\Plugin\Report')) {
            return true;
        }

        if ($this->isSubclassOf($rc, 'Piwik\Plugin\Visualization')) {
            return true;
        }

        if (class_exists('Piwik\Plugins\TagManager\Template\Tag\BaseTag')
            && $this->isSubclassOf($rc, 'Piwik\Plugins\TagManager\Template\Tag\BaseTag')) {
            return true;
        }

        if (class_exists('Piwik\Plugins\TagManager\Template\Trigger\BaseTrigger')
            && $this->isSubclassOf($rc, 'Piwik\Plugins\TagManager\Template\Trigger\BaseTrigger')) {
            return true;
        }

        if (class_exists('Piwik\Plugins\TagManager\Template\Variable\BaseVariable')
            && $this->isSubclassOf($rc, 'Piwik\Plugins\TagManager\Template\Variable\BaseVariable')) {
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

        if ($this->isSubclassOf($rc, 'Piwik\Columns\Dimension') ||
            $this->isSubclassOf($rc, 'Piwik\Plugin\Dimension\ActionDimension') ||
            $this->isSubclassOf($rc, 'Piwik\Plugin\Dimension\ConversionDimension') ||
            $this->isSubclassOf($rc, 'Piwik\Plugin\Dimension\VisitDimension')) {

            return true;
        }

        if ($rc->getName() === 'Piwik\Plugin\ControllerAdmin') {
            // controller admin extends controller but is an api itself. should not be blacklisted
            return false;
        }

        return $this->isSubclassOf($rc, 'Piwik\Plugin\Controller');
    }

    private function hasApiTag(\Sami\Reflection\Reflection $reflection)
    {
        $apiTags = ($reflection->getTags('api'));

        if (!empty($apiTags)) {
            return true;
        }

        // fixes when using eg `@api since Piwik 3.0.0` the API tag is not recognized
        $docComment = $reflection->getDocComment() ?? "";

        if (false !== strpos($docComment, ' @api ')) {
            return true;
        }

        return false;
    }

    private function isAnyMethodAnApi(ClassReflection $class)
    {
        $rc = new \ReflectionClass($class->getName());

        $methods = $rc->getMethods();
        foreach ($methods as $method) {
            $docComment = $method->getDocComment() ?? "";

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
            $docComment = $prop->getDocComment() ?? "";

            if (false !== strpos($docComment, '@api')) {
                return true;
            }
        }

        return false;
    }
}
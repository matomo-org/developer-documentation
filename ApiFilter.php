<?php
use \Sami\Reflection\ClassReflection;
use \Sami\Reflection\MethodReflection;
use \Sami\Reflection\PropertyReflection;

/**
 * Class ApiFilter
 * Accept a class, method or property only if doc block contains a tag "@api".
 */
class ApiFilter extends \Sami\Parser\Filter\DefaultFilter {

    public function acceptClass(ClassReflection $class)
    {
        if ($this->hasApiTag($class)) {
            return true;
        }

        if (!class_exists($class->getName())) {
            return false;
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
        if (!$method->isPublic()) {
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
        if (!$property->isPublic()) {
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

    private function hasApiTag(\Sami\Reflection\Reflection $reflection)
    {
        $apiTags = ($reflection->getTags('api'));

        return !empty($apiTags);
    }

    private function isAnyMethodAnApi(ClassReflection $class)
    {
        $rc = new ReflectionClass($class->getName());

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
        $rc = new ReflectionClass($class->getName());

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
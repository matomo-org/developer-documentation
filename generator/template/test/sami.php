<?php

use Sami\Parser\Filter\FilterInterface;
use Sami\Reflection\ClassReflection;
use Sami\Reflection\MethodReflection;
use Sami\Reflection\PropertyReflection;
use Sami\Sami;
use Symfony\Component\Finder\Finder;

$sami = new Sami(
    Finder::create()
        ->files()
        ->name('*.php')
        ->in(__DIR__ . '/source'),
    array(
        'build_dir' => __DIR__ . '/build',
        'cache_dir' => __DIR__ . '/cache',
        'template_dirs' => array(__DIR__ . '/..'),
        'theme' => 'github',
    )
);

$sami['filter'] = $sami->share(
    function () {
        return new CustomFilter();
    }
);

/**
 * Allows public and protected members to be rendered.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class CustomFilter implements FilterInterface
{
    public function acceptClass(ClassReflection $class)
    {
        return true;
    }

    public function acceptMethod(MethodReflection $method)
    {
        return ($method->isPublic() || $method->isProtected());
    }

    public function acceptProperty(PropertyReflection $property)
    {
        return ($property->isPublic() || $property->isProtected());
    }
}

return $sami;

<?php

namespace helpers\Content\Category;

class CategoryList
{
    /**
     * @param string $name
     * @return Category
     */
    public static function getCategory($name)
    {
        switch ($name) {
            case 'Integrate':
                return new IntegrateCategory();
            case 'CoreDevelop':
                return new CoreDevelopCategory();
            case 'Develop':
                return new DevelopCategory();
            case 'Design':
                return new DesignCategory();
            case 'API Reference':
                return new ApiReferenceCategory();
            default:
                throw new \RuntimeException('Unknown category ' . $name);
        }
    }
}

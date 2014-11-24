<?php

namespace helpers\Content;

/**
 * Empty sub-category for the menu.
 */
class EmptySubCategory implements MenuItem
{
    private $name;

    /**
     * @var MenuItem[]
     */
    private $subitems;

    public function __construct($name, array $subitems)
    {
        $this->name = $name;
        $this->subitems = $subitems;
    }

    public function getMenuTitle()
    {
        return $this->name;
    }

    public function getMenuUrl()
    {
        return '#';
    }

    public function getSubItems()
    {
        return $this->subitems;
    }
}

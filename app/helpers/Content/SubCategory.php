<?php

namespace helpers\Content;

/**
 * Sub-category for the menu.
 */
class SubCategory implements MenuItem
{
    /**
     * @var Guide
     */
    private $guide;

    /**
     * @var MenuItem[]
     */
    private $subitems;

    public function __construct(Guide $guide, array $subitems)
    {
        $this->guide = $guide;
        $this->subitems = $subitems;
    }

    public function getMenuTitle()
    {
        return $this->guide->getMenuTitle();
    }

    public function getMenuUrl()
    {
        return $this->guide->getMenuUrl();
    }

    public function getSubItems()
    {
        return $this->subitems;
    }
}

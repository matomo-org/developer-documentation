<?php

namespace helpers\Content;

/**
 * A section is a guide with several sub-guides.
 */
class Section extends Guide implements MenuItem
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var MenuItem[]
     */
    private $items;

    public function __construct($name, array $subItems)
    {
        parent::__construct($name);
        $this->items = $subItems;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Guide[]
     */
    public function getItems()
    {
        return $this->items;
    }
}

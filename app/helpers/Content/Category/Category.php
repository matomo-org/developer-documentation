<?php

namespace helpers\Content\Category;

use helpers\Content\Guide;
use helpers\Content\MenuItem;

/**
 * A category groups several sections or guides.
 */
abstract class Category implements MenuItem
{
    /**
     * @return string
     */
    public abstract function getName();

    /**
     * @return string
     */
    public abstract function getUrl();

    /**
     * @return MenuItem[]
     */
    public abstract function getItems();

    /**
     * @return Guide
     */
    public abstract function getIntroGuide();

    public function getMenuTitle()
    {
        return $this->getName();
    }

    public function getMenuUrl()
    {
        return $this->getUrl();
    }

    public function getSubItems()
    {
        return [];
    }

    protected function guideUrl($name)
    {
        return '/guides/' . $name;
    }
}

<?php

namespace helpers\Content\Category;

use helpers\Content\Guide;
use helpers\Content\MenuItem;

/**
 * A category groups several sections or guides.
 */
abstract class Category
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

    protected function guideUrl($name)
    {
        return '/guides/' . $name;
    }
}

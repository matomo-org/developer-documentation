<?php

namespace helpers\Content;

/**
 * Empty sub-category for the menu.
 */
class UnlinkedCategory extends Guide
{
    /**
     * @return string
     */
    public function getRenderedContent()
    {
        return '';
    }

    /**
     * @return string
     */
    public function getMenuUrl()
    {
        return null;
    }


}

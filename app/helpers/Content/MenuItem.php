<?php

namespace helpers\Content;

interface MenuItem
{
    /**
     * @return string
     */
    public function getMenuTitle();

    /**
     * @return string
     */
    public function getMenuUrl();

    /**
     * @return MenuItem[]
     */
    public function getSubItems();
}

<?php

namespace helpers\Content;

/**
 * API Reference document.
 */
class ApiReferenceGuide extends Guide
{
    /**
     * @return string
     */
    public function getMenuUrl()
    {
        return '/api-reference/' . $this->name;
    }
}

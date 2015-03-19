<?php

namespace helpers\Content;

/**
 * Generated PhpDoc.
 */
class PhpDoc extends Guide
{
    private $url;
    private $title;

    public function __construct($name, $url, $title = null)
    {
        parent::__construct($name);

        $this->url = $url;
        $this->title = $title;
    }

    public function getMenuTitle()
    {
        if (!is_null($this->title)) {
            return $this->title;
        }

        return parent::getMenuTitle();
    }

    public function getMenuUrl()
    {
        return '/api-reference/' . $this->url;
    }

    protected function getFilePath()
    {
        return __DIR__ . '/../../../docs/generated/master/' . $this->name . '.md';
    }
}

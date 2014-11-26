<?php

namespace helpers\Content;

/**
 * Generated PhpDoc.
 */
class PhpDoc extends Guide
{
    private $url;

    public function __construct($name, $url)
    {
        parent::__construct($name);

        $this->url = $url;
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

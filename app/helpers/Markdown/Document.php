<?php

namespace helpers\Markdown;

/**
 * Document.
 */
class Document
{
    /**
     * @var string
     */
    public $htmlContent;

    /**
     * @var string
     */
    public $title;

    /**
     * @var array
     */
    public $sections = array();

    /**
     * @var array
     */
    public $metadata = array();

    public function __construct($htmlContent, array $metadata = [])
    {
        $this->htmlContent = $htmlContent;
        $this->metadata = $metadata;
    }
}

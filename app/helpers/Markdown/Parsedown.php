<?php

namespace helpers\Markdown;

/**
 * Parses Markdown Extra using ParsedownExtra.
 */
class Parsedown implements MarkdownParserInterface
{
    private $parsedown;

    public function __construct()
    {
        $this->parsedown = new \ParsedownExtra();
    }

    public function parse($markdown)
    {
        return $this->parsedown->text($markdown);
    }
}

<?php

namespace helpers\Markdown;

interface MarkdownParserInterface
{
    /**
     * Parses Markdown to HTML.
     *
     * @param string $markdown
     *
     * @return string HTML
     */
    public function parse($markdown);
}

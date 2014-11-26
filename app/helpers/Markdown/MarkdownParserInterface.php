<?php

namespace helpers\Markdown;

interface MarkdownParserInterface
{
    /**
     * Parses Markdown to HTML.
     *
     * @param string $markdown
     *
     * @return Document
     */
    public function parse($markdown);
}

<?php

namespace helpers\Markdown;

use Mni\FrontYAML\Bridge\Parsedown\ParsedownParser;
use Mni\FrontYAML\Parser;

/**
 * Parses Markdown Extra using ParsedownExtra.
 */
class Parsedown implements MarkdownParserInterface
{
    private $parser;

    public function __construct()
    {
        // Use the FrontYAML parser to decode both Markdown and FrontYAML metadata
        $this->parser = new Parser(null, new ParsedownParser(new \ParsedownExtra()));
    }

    public function parse($markdown)
    {
        $parsed = $this->parser->parse($markdown);

        $html = $parsed->getContent();
        $metadata = $parsed->getYAML();

        if (! is_array($metadata)) {
            $metadata = [];
        }

        return new Document($html, $metadata);
    }
}

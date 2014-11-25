<?php

namespace helpers\Markdown;

use Mni\FrontYAML\Parser;

/**
 * Parses FrontYaml in Markdown files.
 */
class FrontYamlParser implements MarkdownParserInterface
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var MarkdownParserInterface
     */
    private $wrapped;

    public function __construct(MarkdownParserInterface $wrapped)
    {
        $this->wrapped = $wrapped;
        $this->parser = new Parser();
    }

    public function parse($markdown)
    {
        $parsed = $this->parser->parse($markdown, false);

        // Get the FrontYaml content
        $metadata = $parsed->getYAML();
        if (! is_array($metadata)) {
            $metadata = [];
        }

        // Get the Markdown with the FrontYaml removed
        $markdown = $parsed->getContent();

        $document = $this->wrapped->parse($markdown);

        $document->metadata = array_merge($document->metadata, $metadata);

        return $document;
    }
}

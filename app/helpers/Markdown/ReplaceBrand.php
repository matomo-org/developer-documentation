<?php

namespace helpers\Markdown;
use helpers\Environment;

/**
 * Fixed links to other Markdown documents.
 */
class ReplaceBrand implements MarkdownParserInterface
{
    /**
     * @var MarkdownParserInterface
     */
    private $wrapped;

    public function __construct(MarkdownParserInterface $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public function parse($markdown)
    {
        $document = $this->wrapped->parse($markdown);

        if (!empty($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/changelog') === 0) {
            return $document;
        }

        $html = $document->htmlContent;

        $document->htmlContent = Environment::renamePiwikToMatomo($html);

        return $document;
    }
}

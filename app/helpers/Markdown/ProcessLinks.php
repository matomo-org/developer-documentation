<?php

namespace helpers\Markdown;

/**
 * Fixed links to other Markdown documents.
 */
class ProcessLinks implements MarkdownParserInterface
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

        $html = $document->htmlContent;

        $html = preg_replace('/href="([^(http)].*?)(.md)(.*?)"/', 'href="${1}${3}"', $html);
        $html = preg_replace('/href="((..\/)+)Piwik(.*?)(.md)(.*?)"/', 'href="${1}Piwik${3}${5}"', $html);

        $document->htmlContent = $html;

        return $document;
    }
}

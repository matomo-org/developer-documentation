<?php

namespace helpers\Markdown;
use helpers\Environment;

/**
 * Fixed links to other Markdown documents.
 */
class ProcessImages implements MarkdownParserInterface
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

        $urlPrefix = Environment::buildUrlPrefix(Environment::getPiwikVersion());
        $html = preg_replace('/src="\/img\/(.+?)"/', 'src="/img' . $urlPrefix . '/${1}"', $html);
        $html = preg_replace('/src="(.+?)developer.matomo.org\/img\/(.+?)"/i', 'src="${1}' . DOCS_DOMAIN . '/img' . $urlPrefix . '/${2}"', $html);
        $html = preg_replace('/src="(.+?)developer.piwik.org\/img\/(.+?)"/i', 'src="${1}' . DOCS_DOMAIN . '/img' . $urlPrefix . '/${2}"', $html);

        $document->htmlContent = $html;

        return $document;
    }
}

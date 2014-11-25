<?php

namespace helpers\Markdown;

/**
 * Creates a Markdown parser.
 */
class MarkdownParserFactory
{
    /**
     * @return MarkdownParserInterface
     */
    public static function build()
    {
        return new IncludeFilePostprocessor(
            new TitleIdPreprocessor(
                new MichelfMarkdown()
            )
        );
    }
}

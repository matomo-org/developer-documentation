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
        return new ProcessLinks(
            new ExtractSectionsPostprocessor(
                new IncludeFilePostprocessor(
                    new TitleIdPreprocessor(
                        new Parsedown()
                    )
                )
            )
        );
    }
}

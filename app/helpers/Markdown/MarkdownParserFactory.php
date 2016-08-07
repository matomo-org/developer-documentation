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
        // Welcome to the decorators party!
        return new ProcessImages(
            new ProcessLinks(
                new ExtractSectionsPostprocessor(
                    new IncludeFilePostprocessor(
                        new TitleIdPreprocessor(
                            new FrontYamlParser(
                                new MichelfMarkdown()
                            )
                        )
                    )
                )
            )
        );
    }
}

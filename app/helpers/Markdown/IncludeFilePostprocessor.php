<?php

namespace helpers\Markdown;

use helpers\Log;

/**
 * Addition to Markdown to allow including remote files.
 *
 * Usage:
 *
 *     {@include http://example.com/file.html}
 *     {@include escape http://example.com/file.html}
 *
 * Use the `escape` option to escape the included HTML content.
 *
 * This is a postprocessor, which means included content will not be parsed
 * as Markdown. It will be inserted as-is in the final HTML content.
 */
class IncludeFilePostprocessor implements MarkdownParserInterface
{
    /**
     * Anything matching:
     * - {@include <url>}
     * - {@include escape <url>}
     */
    const TAG_REGEX = '/\{@include( escape)? ([^\}]+)\}/';

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
        $replacements = [];

        // We need to replace "{@include <url>}" tags with random unique IDs
        // else URLs are turned into <a> tags by the Markdown parser
        $markdown = $this->replaceTagsWithUniqueIds($markdown, $replacements);

        $document = $this->wrapped->parse($markdown);

        $document->htmlContent = $this->replaceUniqueIdsWithFileContent($document->htmlContent, $replacements);

        return $document;
    }

    private function replaceTagsWithUniqueIds($markdown, array &$replacements)
    {
        return preg_replace_callback(self::TAG_REGEX, function (array $matches) use (&$replacements) {
            $uniqueId = uniqid();
            $escape = ($matches[1] != null) ? true : false;
            $replacements[$uniqueId] = $this->getFileContent($matches[2], $escape);
            return $uniqueId;
        }, $markdown);
    }

    private function getFileContent($url, $escape)
    {
        if (DISABLE_INCLUDE) {
            return 'remote file inclusion disabled';
        }

        try {
			$content = @file_get_contents($url);
			if ($content) {
                $content = htmlspecialchars_decode(htmlentities($content));
			}
        } catch (\Exception $e) {
            Log::error(sprintf("Error while retrieving %s\n%s", $url, $e->getMessage()));

            return 'Error while retrieving ' . htmlentities($url);
        }

        if ($escape) {
            $content = htmlspecialchars($content);
        }

        return $content;
    }

    private function replaceUniqueIdsWithFileContent($html, array $replacements)
    {
        return str_replace(array_keys($replacements), array_values($replacements), $html);
    }
}

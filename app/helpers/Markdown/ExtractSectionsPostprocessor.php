<?php

namespace helpers\Markdown;

/**
 * Extracts sections from Markdown content.
 */
class ExtractSectionsPostprocessor implements MarkdownParserInterface
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

        $document->title = $this->getTitle($document->htmlContent);
        $document->sections = $this->getAvailableSections($document->htmlContent);

        return $document;
    }

    private function getTitle($html)
    {
        $sections = $this->getAvailableSectionsFromContent('h1', $html);

        if (empty($sections)) {
            return '';
        }

        $first = reset($sections);
        return $first['title'];
    }

    private function getAvailableSections($html)
    {
        $sections = $this->getAvailableSectionsFromContent('h2', $html);

        if (empty($sections)) {
            return [];
        }

        $parsed = [];

        foreach ($sections as $section) {

            $content     = $this->getSectionContent($section['title'], $html);
            $subSections = $this->getAvailableSectionsFromContent('h3', $content);

            $sub = [];
            foreach ($subSections as $subSection) {
                $sub[] = [
                    'title'    => $subSection['title'],
                    'id'       => $subSection['id'],
                    'children' => []
                ];
            }

            $parsed[] = [
                'title'    => $section['title'],
                'id'       => $section['id'],
                'children' => $sub
            ];

        }

        return $parsed;
    }

    private function getSectionContent($sectionName, $html)
    {
        $sectionName = str_replace('\\', '\\\\', $sectionName);
        $sectionName = str_replace('/', '\/', $sectionName);

        $matches = [];
        $pattern = sprintf('/>%s<\/h2>(.*?)(<h2|$)/is', $sectionName);

        preg_match($pattern, $html, $matches);

        if (!empty($matches[1])) {
            $parsed = $matches[1];
        } else {
            $parsed = '';
        }

        return $parsed;
    }

    private function getAvailableSectionsFromContent($headline, $html)
    {
        if (empty($html)) {
            return [];
        }

        $regex = sprintf('/(?:<a[^>]*name=["\']([^"\']+)["\'][^>]*><\/a>\s*)?<%s(.*?)>(.*)<\/%s>/', $headline, $headline);

        $resultCount = preg_match_all($regex, $html, $matches);

        $result = [];
        for ($i = 0; $i < $resultCount; ++$i) {
            $title = $matches[3][$i];

            if (!empty($matches[1][$i])) {
                $id = $matches[1][$i];
            } else {
                $id = TitleIdPreprocessor::headlineTextToHtmlId($title);
            }

            $result[] = ['id' => $id, 'title' => $title];
        }
        return $result;
    }
}

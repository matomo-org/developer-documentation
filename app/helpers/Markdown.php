<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Markdown {

    /**
     * @var string
     */
    private $markdown = '';

    /**
     * @var string
     */
    private $transformedHtml = '';

    public function __construct($markdown)
    {
        $this->markdown = $markdown;
    }

    public function setTransformedHtml($html)
    {
        $this->transformedHtml = $html;
    }

    public function transform()
    {
        $this->transformIfNeeded();

        return $this->transformedHtml;
    }

    public function getTitle()
    {
        $this->transformIfNeeded();

        $sections = $this->getAvailableSectionsFromContent('h1', $this->transformedHtml);

        if (empty($sections)) {
            return '';
        }

        $first = reset($sections);
        return $first['title'];
    }

    public function getAvailableSections()
    {
        $this->transformIfNeeded();

        $sections = $this->getAvailableSectionsFromContent('h2', $this->transformedHtml);

        if (empty($sections)) {
            return array();
        }

        $parsed = array();

        foreach ($sections as $section) {

            $content     = $this->getSectionContent($section['title']);
            $subSections = $this->getAvailableSectionsFromContent('h3', $content);

            $sub = array();
            foreach ($subSections as $subSection) {
                $sub[] = array(
                    'title'    => $subSection['title'],
                    'id'       => $subSection['id'],
                    'children' => array()
                );
            }

            $parsed[] = array(
                'title'    => $section['title'],
                'id'       => $section['id'],
                'children' => $sub
            );

        }

        return $parsed;
    }

    private function getSectionContent($sectionName)
    {
        $this->transformIfNeeded();

        $sectionName = str_replace('\\', '\\\\', $sectionName);
        $sectionName = str_replace('/', '\/', $sectionName);

        $matches = array();
        $pattern = sprintf('/>%s<\/h2>(.*?)(<h2|$)/is', $sectionName);

        preg_match($pattern, $this->transformedHtml, $matches);

        if (!empty($matches[1])) {
            $parsed = $matches[1];
        } else {
            $parsed = '';
        }

        return $parsed;
    }

    private function transformIfNeeded()
    {
        if (!empty($this->transformedHtml)) {
            return $this->transformedHtml;
        }

        $parser = new MarkdownParser();

        $this->transformedHtml = $parser->transform($this->markdown);
    }

    private function getAvailableSectionsFromContent($headline, $content)
    {
        if (empty($content)) {
            return array();
        }

        $regex = sprintf('/(?:<a[^>]*name=["\']([^"\']+)["\'][^>]*><\/a>\s*)?<%s(.*?)>(.*)<\/%s>/', $headline, $headline);

        $resultCount = preg_match_all($regex, $content, $matches);

        $result = array();
        for ($i = 0; $i < $resultCount; ++$i) {
            $title = $matches[3][$i];

            if (!empty($matches[1][$i])) {
                $id = $matches[1][$i];
            } else {
                $id = MarkdownParser::headlineTextToId($title);
            }

            $result[] = array('id' => $id, 'title' => $title);
        }
        return $result;
    }
}

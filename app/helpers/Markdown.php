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

    public function getAvailableSections()
    {
        $this->transformIfNeeded();

        $sections = $this->getAvailableSectionsFromContent('h2', $this->transformedHtml);

        if (empty($sections)) {
            return array();
        }

        $parsed = array();

        foreach ($sections as $section) {

            $content     = $this->getSectionContent($section);
            $subSections = $this->getAvailableSectionsFromContent('h3', $content);

            $sub = array();
            foreach ($subSections as $subSection) {
                $sub[] = array(
                    'title'    => $subSection,
                    'id'       => MarkdownParser::headlineTextToId($subSection),
                    'children' => array()
                );
            }

            $parsed[] = array(
                'title'    => $section,
                'id'       => MarkdownParser::headlineTextToId($section),
                'children' => $sub
            );

        }

        return $parsed;
    }

    private function getSectionContent($sectionName)
    {
        $this->transformIfNeeded();

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

        $html   = $parser->transform($this->markdown);

        $config = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,h1[id],h2[id],h3[id],h4[id],h5,code,pre,strong,em,b,a[href|name|id],i,span,ul,ol,li,cite,img[src]');
        $config->set('Attr.EnableID', true);
        $purifier = new \HTMLPurifier($config);

        $this->transformedHtml = $purifier->purify($html);
    }

    private function getAvailableSectionsFromContent($headline, $content)
    {
        if (empty($content)) {
            return array();
        }

        $regex = sprintf('/<%s(.*?)>(.*)<\/%s>/', $headline, $headline);

        preg_match_all($regex, $content, $matches);

        if (!empty($matches[2])) {
            return $matches[2];
        }

        return array();
    }
}

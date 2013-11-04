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

        $matches = array();
        preg_match_all('/<h2>(.*)<\/h2>/', $this->transformedHtml, $matches);

        if (!empty($matches[1])) {
            $parsed = $matches[1];
        } else {
            $parsed = array();
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
}

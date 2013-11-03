<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

use \dflydev\markdown\MarkdownParser;

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

    private function transformIfNeeded()
    {
        if (!empty($this->transformedHtml)) {
            return $this->transformedHtml;
        }

        $parser = new MarkdownParser();

        $html     = $parser->transform($this->markdown);
        $config   = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,h1,h2,h3,h4,h5,strong,em,b,a[href],i,span,ul,ol,li,cite,img[src]');
        $purifier = new \HTMLPurifier($config);

        $this->transformedHtml = $purifier->purify($html);
    }
}
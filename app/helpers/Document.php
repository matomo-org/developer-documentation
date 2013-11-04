<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Document {

    private $name;
    private $markdown;

    public function __construct($name)
    {
        if (!$this->isValid($name)) {
            throw new \Exception('Requested documentation is not valid');
        }

        $this->name     = $name;
        $content        = $this->getRawContent();
        $this->markdown = new Markdown($content);
    }

    private function isValid($name)
    {
        return preg_match('/^([\w\/-])*$/', $name) && '/' != substr($name, 0, 1);
    }

    private function getRawContent()
    {
        $path = '../../docs/' . $this->name . '.md';

        if (!file_exists($path)) {
            throw new \Exception('Requested documentation does not exist');
        }

        return file_get_contents($path);
    }

    public function getRenderedContent()
    {
        $html = $this->markdown->transform();

        $html = preg_replace('/href="(.*?)(.md)(.*?)"/', 'href="${1}${3}"', $html);

        return $html;
    }

    public function getTitle()
    {
        return $this->markdown->getTitle();
    }

    public function getSections()
    {
        return $this->markdown->getAvailableSections();
    }
}
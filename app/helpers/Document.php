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
        $this->name = $name;

        if (!$this->isValid($name)) {
            throw new DocumentNotExistException('Requested documentation is not valid');
        }

        $content        = $this->getRawContent();
        $this->markdown = new Markdown($content);
    }

    private function isValid($name)
    {
        if (!preg_match('/^([\w\/-])*$/', $name)) {
            return false;
        }

        if ('/' == substr($name, 0, 1)) {
            return false;
        }

        if (!file_exists($this->getPathToFile())) {
            return false;
        }

        return true;
    }

    private function getPathToFile()
    {
        return '../../docs/' . $this->name . '.md';
    }

    private function getRawContent()
    {
        $path = $this->getPathToFile();

        if (!file_exists($path)) {
            throw new DocumentNotExistException('Requested documentation does not exist');
        }

        return file_get_contents($path);
    }

    public function getRenderedContent()
    {
        $html = $this->markdown->transform();

        $html = preg_replace('/href="([^(http)].*?)(.md)(.*?)"/', 'href="${1}${3}"', $html);

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

    public function linkToEditDocument()
    {
        return 'https://github.com/piwik/developer-documentation/tree/master/docs/' . $this->name . '.md';
    }
}
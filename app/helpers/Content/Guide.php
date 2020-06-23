<?php

namespace helpers\Content;

use helpers\DocumentNotExistException;
use helpers\Environment;
use helpers\Markdown\Document;
use helpers\Markdown\MarkdownParserFactory;

/**
 * Guide.
 */
class Guide implements MenuItem
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Document
     */
    protected $document;

    public function __construct($name)
    {
        $this->name = $name;

        $this->validateName();

        $markdownParser = MarkdownParserFactory::build();
        $this->document = $markdownParser->parse($this->getMarkdown());
    }

    /**
     * @return string
     */
    public function getRenderedContent()
    {
        return $this->document->htmlContent;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        if (isset($this->document->metadata['title'])) {
            return $this->document->metadata['title'];
        }

        return $this->document->title;
    }

    public function getSections()
    {
        return $this->document->sections;
    }

    /**
     * @return string
     */
    public function getMenuTitle()
    {
        return $this->getTitle();
    }

    /**
     * @return string
     */
    public function getMenuUrl()
    {
        return '/guides/' . $this->name;
    }

    /**
     * @return MenuItem[]
     */
    public function getSubItems()
    {
        if (! isset($this->document->metadata['subGuides'])) {
            return [];
        }

        $subGuides = $this->document->metadata['subGuides'];

        return array_map(function ($guideName) {
            return new Guide($guideName);
        }, $subGuides);
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        if (! isset($this->document->metadata['category'])) {
            throw new \RuntimeException('No category defined for guide ' . $this->name);
        }

        return $this->document->metadata['category'];
    }

    public function linkToEdit()
    {
        $path = '';
        if ($this->isVersionedGuide()) {
            $piwikVersion = Environment::getPiwikVersionDirectory();
            $path = $piwikVersion . '/';
        }

        return 'https://github.com/matomo-org/developer-documentation/tree/live/docs/' . $path . $this->name . '.md';
    }

    public function getPrevious()
    {
        if (isset($this->document->metadata['previous'])) {
            return new static($this->document->metadata['previous']);
        }

        return null;
    }

    public function getNext()
    {
        if (isset($this->document->metadata['next'])) {
            return new static($this->document->metadata['next']);
        }

        $subGuides = $this->getSubItems();
        if (count($subGuides) > 0) {
            return $subGuides[0];
        }

        return null;
    }

    protected function getFilePath()
    {
        $file = '/' . $this->name . '.md';

        if ($this->isVersionedGuide()) {
            return Environment::getVersionedDocsPath() . $file;
        }

        return Environment::getBaseDocsPath() . $file;
    }

    private function isVersionedGuide()
    {
        $file = '/' . $this->name . '.md';

        $path = Environment::getVersionedDocsPath() . $file;

        return file_exists($path);
    }

    private function validateName()
    {
        if (!preg_match('/^([\w\/-])*$/', $this->name)) {
            throw new DocumentNotExistException('The requested documentation is not valid: ' . $this->name);
        }

        if ('/' == substr($this->name, 0, 1)) {
            throw new DocumentNotExistException('The requested documentation is not valid: ' . $this->name);
        }

        if (!file_exists($this->getFilePath())) {
            throw new DocumentNotExistException('The requested documentation does not exist: ' . $this->name);
        }
    }

    private function getMarkdown()
    {
        $path = $this->getFilePath();

        if (!file_exists($path)) {
            throw new DocumentNotExistException('Requested documentation does not exist');
        }

        return file_get_contents($path);
    }

    /**
     * @return string
     */
    public function getSEOTitle()
    {
        try {

            //Some guides may not have the category set
            return $this->getTitle().': '.$this->getCategory();

        } catch (\RuntimeException $e) {

            return $this->getTitle();
        }
    }
}

<?php

namespace helpers\Content;

use helpers\Environment;

/**
 * A global guide includes content that is available globally and not Piwik version dependent.
 * For example support and changelog content never change depending on the Piwik version.
 */
class GlobalGuide extends Guide
{
    public function linkToEdit()
    {
        return 'https://github.com/piwik/developer-documentation/tree/master/docs/' . $this->name . '.md';
    }

    protected function getFilePath()
    {
        // TODO get current version
        return Environment::getDocsBasePath() . '/' . $this->name . '.md';
    }

}

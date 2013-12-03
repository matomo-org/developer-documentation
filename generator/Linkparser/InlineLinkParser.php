<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

class InlineLinkParser {

    /**
     * @var Scope $scope
     */
    private $scope;

    /**
     * @param Scope $scope
     */
    public function __construct(Scope $scope)
    {
        $this->scope = $scope;
    }

    public function parse($comment)
    {
        if (preg_match_all('/{\@link(.*?)}/', $comment, $matches)) {

            foreach ($matches[0] as $key => $rawLink) {

                $linkParser    = new LinkParser($this->scope);
                $linkFormatted = $linkParser->parse($matches[1][$key]);

                $comment = str_replace($rawLink, $linkFormatted, $comment);
            }

        }

        return $comment;
    }
}
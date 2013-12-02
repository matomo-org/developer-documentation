<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Linkparser;

use Sami\Sami;
use Sami\Reflection\ClassReflection;

class InlineLinkParser {

    /**
     * @var Scope $scope
     */
    private $scope;

    /**
     * If class/namespace of scope is not given, there might be links which cannot be resolved. For instance {@link Map}
     * because we won't know that we are in namespace `Piwik\DataTable`. Or we cannot resolve {@link $mytest} when we
     * don't know the current class.
     *
     * @param Scope $scope
     */
    public function __construct(Scope $scope)
    {
        $this->scope = $scope;
    }

    public function parse($comment)
    {
        if (!preg_match_all('/{\@link(.*)}/', $comment, $matches)) {
            return $comment;
        }

        foreach ($matches[0] as $key => $rawLink) {

            $link = new Link($matches[1][$key]);

            $formatter = new ExternalLinkFormatter($this->scope);
            $formatter->append(new InternalPropertyFormatter($this->scope));
            $formatter->append(new InternalMethodFormatter($this->scope));
            $formatter->append(new ExternalPropertyFormatter($this->scope));
            $formatter->append(new ExternalMethodFormatter($this->scope));
            $formatter->append(new ApiClassFormatter($this->scope));
            $formatter->append(new DefaultFormatter($this->scope));

            $linkFormatted = $formatter->format($link);

            $comment = str_replace($rawLink, $linkFormatted, $comment);
        }

        return $comment;
    }
}
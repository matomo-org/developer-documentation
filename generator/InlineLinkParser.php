<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

require_once 'Linkparser/Formatter.php';
require_once 'Linkparser/ApiReferenceFormatter.php';
foreach (glob(__DIR__ . '/Linkparser/*.php') as $file) {
    require_once $file;
}

use Sami\Sami;
use Sami\Reflection\ClassReflection;

use Linkparser\Link;
use Linkparser\ExternalLinkFormatter;
use Linkparser\InternalPropertyFormatter;
use Linkparser\InternalMethodFormatter;
use Linkparser\ExternalPropertyFormatter;
use Linkparser\ExternalMethodFormatter;
use Linkparser\ApiClassFormatter;
use Linkparser\DefaultFormatter;

class InlineLinkParser {

    private $class;
    private $sami;

    public function __construct(ClassReflection $class, Sami $sami)
    {
        $this->class = $class;
        $this->sami  = $sami;
    }

    public function parse($comment)
    {
        if (!preg_match_all('/{\@link(.*)}/', $comment, $matches)) {
            return $comment;
        }

        $scope = $this->buildScope();

        foreach ($matches[0] as $key => $rawLink) {

            $link = new Link($matches[1][$key]);

            $formatter = new ExternalLinkFormatter($scope);
            $formatter->append(new InternalPropertyFormatter($scope));
            $formatter->append(new InternalMethodFormatter($scope));
            $formatter->append(new ExternalPropertyFormatter($scope));
            $formatter->append(new ExternalMethodFormatter($scope));
            $formatter->append(new ApiClassFormatter($scope));
            $formatter->append(new DefaultFormatter($scope));

            $linkFormatted = $formatter->format($link);

            $comment = str_replace($rawLink, $linkFormatted, $comment);
        }

        return $comment;
    }

    private function buildScope()
    {
        $classArray = $this->class->toArray();

        $scope = new Linkparser\Scope();
        $scope->class      = $this->class;
        $scope->classes    = $this->sami->offsetGet('project')->getProjectClasses();
        $scope->classNames = array_keys($scope->classes);
        $scope->namespace  = $classArray['namespace'];

        return $scope;
    }
}
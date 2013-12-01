<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

use Sami\Sami;
use Sami\Reflection\ClassReflection;

class InlineLinkParser {
    private $class;
    private $classNames;
    private $namespace;

    public function __construct(ClassReflection $class, Sami $sami)
    {
        $this->class = $class;

        $project       = $sami->offsetGet('project');
        $this->classes = $project->getProjectClasses();
        $this->classNames = array_keys($project->getProjectClasses());

        $classArray       = $class->toArray();
        $this->namespace  = $classArray['namespace'];
    }

    public function parse($comment)
    {
        if (!preg_match_all('/{\@link(.*)}/', $comment, $matches)) {
            return $comment;
        }

        // Chain-of-responsibility pattern?
        foreach ($matches[0] as $key => $rawLink) {
            list($link, $description) = $this->parseLinkAndDescription($matches[1][$key]);
            $linkFormatted = '';

            if ($this->isExternalLink($link)) {
                $linkFormatted = $this->formatExternalLink($link, $description);
            } elseif ($this->isPropertyLink($link)) {
                $linkFormatted = $this->formatInternalProperty($link, $description);
            } elseif ($this->isMethodLink($link) && !$this->isClassSymbol($link)) {
                $linkFormatted = $this->formatInternalMethod($link, $description);
            } elseif ($this->isClassSymbol($link)) {

                list($class, $symbol) = $this->parseClassAndSymbol($link);

                if ($this->isApiClass($class) && $this->isPropertyLink($symbol)) {
                    $linkFormatted = $this->formatExternalProperty($class, $symbol, $description);
                } elseif ($this->isApiClass($class) && $this->isMethodLink($symbol)) {
                    $linkFormatted = $this->formatExternalMethod($class, $symbol, $description);
                }

            } elseif ($this->isApiClass($link)) {
                $linkFormatted = $this->formatApiClass($link, $description);
            }

            if (empty($linkFormatted) && !empty($description)) {
                $linkFormatted = $description;
            } elseif (empty($linkFormatted)) {
                $linkFormatted = $link;
            }

            $comment = str_replace($rawLink, $linkFormatted, $comment);
        }

        return $comment;
    }

    private function containsDescription($link)
    {
        return false !== strpos($link, ' ');
    }

    private function parseLinkAndDescription($link)
    {
        $link        = trim($link);
        $description = $link;

        if ($this->containsDescription($link)) {
            $parts = explode(' ', $link);

            $link        = array_shift($parts);
            $description = implode(' ', $parts);
        }

        return array($link, $description);
    }

    private function isPropertyLink($link)
    {
        return (0 === strpos($link, '$'));
    }

    private function formatInternalProperty($property, $description)
    {
        $properties = $this->class->getProperties(true);
        $propertyName = substr($property, 1);

        if (!array_key_exists($propertyName, $properties)) {
            return;
        }

        return sprintf('[%s](#$%s)', $description ? $description : $property, strtolower($propertyName));
    }

    private function formatInternalMethod($method, $description)
    {
        $methodName = substr($method, 0, strlen($method) -2);

        $methodInstance = $this->class->getMethod($methodName);

        if (empty($methodInstance)) {
            return;
        }

        return sprintf('[%s](#%s)', $description ? $description : $method, strtolower($methodName));
    }

    private function formatExternalProperty($className, $property, $description)
    {
        $class        = $this->getApiClass($className);
        $properties   = $class->getProperties(true);
        $propertyName = substr($property, 1);

        if (!array_key_exists($propertyName, $properties)) {
            return;
        }

        $linkToClass = $this->getLinkToApiClass($className);

        return sprintf('[%s](%s#$%s)', $description ? $description : $property, $linkToClass, strtolower($propertyName));
    }

    private function formatExternalMethod($className, $method, $description)
    {
        $class      = $this->getApiClass($className);
        $methodName = substr($method, 0, strlen($method) -2);

        $methodInstance = $class->getMethod($methodName);

        if (empty($methodInstance)) {
            return;
        }

        $linkToClass = $this->getLinkToApiClass($className);

        return sprintf('[%s](%s#%s)', $description ? $description : $method, $linkToClass, strtolower($methodName));
    }

    private function isMethodLink($link)
    {
        return $this->stringEndsWith($link, '()');
    }

    private function isExternalLink($link)
    {
        return (0 === strpos($link, 'http') || 0 === strpos($link, 'mailto:'));
    }

    private function formatExternalLink($link, $description)
    {
        if (0 === strpos($link, 'http')) {

            $textToDisplay = $description ? $description : $link;

            return sprintf('[%s](%s)', $textToDisplay, $link);

        } else if (0 === strpos($link, 'mailto:')) {

            $textToDisplay = str_replace('mailto:', '', !empty($description) ? $description : $link);

            return sprintf('[%s](%s)', $textToDisplay, $link);
        }
    }

    private function isApiClass($link)
    {
        $class = $this->getApiClass($link);

        return !empty($class);
    }

    /**
     * @param $link
     * @return ClassReflection|null
     */
    private function getApiClass($link)
    {
        if (in_array($link, $this->classNames)) {
            return $this->classes[$link];
        } elseif (in_array($this->namespace . '\\' . $link, $this->classNames)) {
            return $this->classes[$this->namespace . '\\' . $link];
        }
    }

    private function getLinkToApiClass($link)
    {
        $class = $this->getApiClass($link);

        if (empty($class)) {
            return;
        }

        $className = $class->getName();

        $className = str_replace('\\', '/', $className);

        return '/api-reference/' . $className;
    }

    private function formatApiClass($link, $description)
    {
        $linkToClass = $this->getLinkToApiClass($link);

        if (empty($linkToClass)) {
            return;
        }

        $link = sprintf('[%s](%s)', $description ? $description : $link, $linkToClass);

        return $link;
    }

    private function isClassSymbol($link)
    {
        return 0 < strpos($link, '::');
    }

    private function parseClassAndSymbol($link)
    {
        return explode('::', $link);
    }

    private function stringEndsWith($haystack, $needle)
    {
        if ('' === $needle) {
            return true;
        }

        $lastCharacters = substr($haystack, -strlen($needle));

        return $lastCharacters === $needle;
    }

}
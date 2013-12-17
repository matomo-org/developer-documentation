<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

use \dflydev\markdown\MarkdownExtraParser as DefaultMarkdownParser;

class MarkdownParser extends DefaultMarkdownParser {

    function __construct(array $configuration = null) {
        parent::__construct($configuration);

        // hack to make sure <pre><code markdown="1"> blocks render correctly
        $this->block_tags_re = 'p|div|h[1-6]|blockquote|table|dl|ol|ul|address|form|fieldset|iframe|hr|legend';
    }

    function _doHeaders_callback_atx($matches) {
        $level = strlen($matches[1]);
        $id    = static::headlineTextToId($this->runSpanGamut($matches[2]));
        $block = "<h$level id=\"$id\">".$this->runSpanGamut($matches[2])."</h$level>";
        return "\n" . $this->hashBlock($block) . "\n\n";
    }

    function _doCodeBlocks_callback($matches) {
      $codeblock = $matches[1];
      $codeblock = $this->outdent($codeblock);

      list($codeblock, $language) = $this->handleCodeLanguageSpecifier($codeblock);
      $languageSuffix = $language ? " class=\"$language\"" : "";

      $codeblock = htmlspecialchars($codeblock, ENT_NOQUOTES);

      # trim leading newlines and trailing newlines
      $codeblock = preg_replace('/\A\n+|\n+\z/', '', $codeblock);

      $codeblock = "<pre><code$languageSuffix>$codeblock\n</code></pre>";
      return "\n\n".$this->hashBlock($codeblock)."\n\n";
    }

    function makeCodeSpan($code) {
        #
        # Create a code span markup for $code. Called from handleSpanToken.
        #
        list($code, $language) = $this->handleCodeLanguageSpecifier($code);
        $languageSuffix = $language ? " class=\"$language\"" : "";

        $code = htmlspecialchars(trim($code), ENT_NOQUOTES);
        $code = $this->doAnchors($code);
        return $this->hashPart("<code$languageSuffix>$code</code>");
    }

    function _doHeaders_callback_setext($matches) {
        # Terrible hack to check we haven't found an empty list item.
        if ($matches[2] == '-' && preg_match('{^-(?: |$)}', $matches[1]))
            return $matches[0];

        $level = $matches[3]{0} == '=' ? 1 : 2;
        $attr  = $this->_doHeaders_attr($id =& $matches[2]);
        $block = "<h$level$attr>".$this->runSpanGamut($matches[1])."</h$level>";
        return "\n" . $this->hashBlock($block) . "\n\n";
    }

    function _doAnchors_reference_callback($matches) {
        $link_text = $matches[2];

        $isInclude = preg_match("/include url=\"([^\"]+)\"(?: escape=\"([^\"]+)\")?/", $link_text, $linkMatches);
        if (!$isInclude) {
            return parent::_doAnchors_reference_callback($matches);
        }

        $url = $linkMatches[1];
        $contents = mb_convert_encoding(file_get_contents($url), 'HTML-ENTITIES', 'utf-8');
        if (isset($linkMatches[2]) && $linkMatches[2] == 'true') {
            $contents = htmlspecialchars($contents);
        }

        return $this->hashPart($contents);
    }

    public static function headlineTextToId($headlineText)
    {
        $headlineText = strip_tags($headlineText);
        $headlineText = trim($headlineText);
        $headlineText = preg_replace('/\s/', '-', $headlineText);
        $headlineText = preg_replace('/[^a-zA-Z0-9\-\_]/', '', $headlineText);
        $headlineText = preg_replace('/(\-)+/', '-', $headlineText);
        $headlineText = strtolower($headlineText);

        return $headlineText;
    }

    public function handleCodeLanguageSpecifier($codeString)
    {
        $language = false;
        if (preg_match("/\A\s*\[([^\]]+)\]/", $codeString, $matches)
            && in_array($matches[1], array('php', 'ini', 'http', 'javascript'))
        ) {
            $language = $matches[1];
            $codeString = substr($codeString, strlen($matches[0]));
        }

        return array($codeString, $language);
    }
}
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
    function _doHeaders_callback_atx($matches) {
        $level = strlen($matches[1]);
        $id    = static::headlineTextToId($this->runSpanGamut($matches[2]));
        $block = "<h$level id=\"$id\">".$this->runSpanGamut($matches[2])."</h$level>";
        return "\n" . $this->hashBlock($block) . "\n\n";
    }

    function makeCodeSpan($code) {
        #
        # Create a code span markup for $code. Called from handleSpanToken.
        #
        $code = htmlspecialchars(trim($code), ENT_NOQUOTES);
        $code = $this->doAnchors($code);
        return $this->hashPart("<code>$code</code>");
    }

    function _doHeaders_callback_setext($matches) {
        # Terrible hack to check we haven't found an empty list item.
        if ($matches[2] == '-' && preg_match('{^-(?: |$)}', $matches[1]))
            return $matches[0];

        $level = $matches[2]{0} == '=' ? 1 : 2;
        $id    = static::headlineTextToId($this->runSpanGamut($matches[1]));
        $block = "<h$level id=\"$id\">".$this->runSpanGamut($matches[1])."</h$level>";
        return "\n" . $this->hashBlock($block) . "\n\n";
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
}
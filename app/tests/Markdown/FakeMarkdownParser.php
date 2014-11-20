<?php

namespace tests\Markdown;

use helpers\Markdown\MarkdownParserInterface;

class FakeMarkdownParser implements MarkdownParserInterface
{
    public function parse($markdown)
    {
        return $markdown;
    }
}

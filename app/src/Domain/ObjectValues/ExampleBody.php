<?php

namespace TKuni\PhpCliAppTemplate\Domain\ObjectValues;

class ExampleBody
{
    /**
     * @var string
     */
    private $body;

    public function __construct(string $body)
    {
        $this->body = trim($body);
    }

    public function separate() : array
    {
        $texts = preg_split('/[.?]/', $this->body, -1, PREG_SPLIT_NO_EMPTY);

        $trimmedTexts = array_map(function($text) {
            return trim($text);
        }, $texts);

        $filteredTexts = array_filter($trimmedTexts, function($trimed) {
            return !empty($trimed);
        });

        return $filteredTexts;
    }
}
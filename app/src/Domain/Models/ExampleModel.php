<?php

namespace TKuni\PhpCliAppTemplate\Domain\Models;

use TKuni\PhpCliAppTemplate\Domain\ObjectValues\ExampleBody;

class ExampleModel implements \JsonSerializable
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var ExampleBody
     */
    private $body;

    public function __construct(string $id, string $title, ExampleBody $body)
    {
        $this->title = $title;
        $this->body  = $body;
        $this->id    = $id;
    }

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function body()
    {
        return $this->body;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'title' => $this->title,
            'body'  => $this->body
        ];
    }
}
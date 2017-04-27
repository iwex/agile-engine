<?php

namespace App\Http\Api\Responses;

class ArrayResponse extends ResponseAbstract
{
    /**
     * ArrayResponse constructor.
     *
     * @param string|array $content
     * @param int $status
     * @param array $headers
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($content = '', $status = 200, $headers = [])
    {
        $content = collect($content);
        parent::__construct($content, $status, $headers);
    }
}
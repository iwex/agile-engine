<?php

namespace App\Http\Api\Responses;


class SuccessResponse extends ResponseAbstract
{
    /**
     * Success Response constructor.
     *
     * @param array $headers
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($headers = [])
    {
        parent::__construct(null, 204, $headers);
    }
}
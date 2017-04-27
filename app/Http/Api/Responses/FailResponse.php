<?php

namespace App\Http\Api\Responses;


use Symfony\Component\HttpFoundation\Response;

class FailResponse extends ResponseAbstract
{
    /**
     * Fail Response constructor.
     *
     * @param array $headers
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($headers = [])
    {
        parent::__construct(null, Response::HTTP_I_AM_A_TEAPOT, $headers);
    }
}
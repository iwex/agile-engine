<?php

use App\Helpers\Fractal\Fractal;
use League\Fractal\TransformerAbstract;

/**
 * Create one fractal item
 * @param                            $item
 * @param string|TransformerAbstract $transformer
 *
 * @return Fractal
 */
function fractalItem($item, $transformer)
{
    return (new Fractal())->item($item, $transformer);
}

/**
 * Create fractal collection
 *
 * @param                            $collection
 * @param string|TransformerAbstract $transformer
 *
 * @return Fractal
 */
function fractalCollection($collection, $transformer)
{
    return (new Fractal())->collection($collection, $transformer);
}

/**
 * Generate success response
 *
 * @return \App\Http\Api\Responses\SuccessResponse
 */
function success()
{
    return new \App\Http\Api\Responses\SuccessResponse();
}

/**
 * Generate fail response
 *
 * @return \App\Http\Api\Responses\FailResponse
 */
function fail()
{
    return new \App\Http\Api\Responses\FailResponse();
}

/**
 * Create array response
 *
 * @param array|Fractal $array
 * @param int $status
 * @param array $headers
 *
 * @return \App\Http\Api\Responses\ArrayResponse
 */
function arrayResponse($array = [], $status = 200, $headers = [])
{
    if ($array instanceof Fractal) {
        $array = $array->toArray();
    }
    
    return new \App\Http\Api\Responses\ArrayResponse($array, $status, $headers);
}

/**
 * Create fractal array response
 *
 * @param $data
 * @param $transformer
 * @param int $status
 * @param array $headers
 *
 * @return \App\Http\Api\Responses\ArrayResponse
 */
function fractalResponse($data, $transformer, $status = 200, $headers = [])
{
    return arrayResponse(
        (new Fractal())->decide($data, $transformer),
        $status,
        $headers
    );
}
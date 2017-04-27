<?php

namespace App\Http\Api\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Api\Responses\Transformers\ProductTransformer;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ShowController extends Controller
{
    /**
     * GET /products/{product}
     *
     * Show one product
     *
     * @param \App\Models\Product $product
     *
     * @return \App\Http\Api\Responses\ArrayResponse
     */
    public function show(Product $product)
    {
        return fractalResponse($product, ProductTransformer::class);
    }
}

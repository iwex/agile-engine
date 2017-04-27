<?php

namespace App\Http\Api\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class BuyController extends Controller
{
    /**
     * POST /products/{product}/buy
     *
     * Buy product and make it inactive
     *
     * @param \App\Models\Product $product
     *
     * @return \App\Http\Api\Responses\SuccessResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function buy(Product $product)
    {
        $product->buy();
        
        return success();
    }
}

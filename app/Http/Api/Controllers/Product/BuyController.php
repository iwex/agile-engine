<?php

namespace App\Http\Api\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\ProductRepository;

class BuyController extends Controller
{
    /**
     * POST /products/{product}/buy
     *
     * Buy product and make it inactive
     *
     * @param \App\Models\Product $product
     * @param \App\Repositories\ProductRepository $productRepository
     *
     * @return \App\Http\Api\Responses\SuccessResponse
     */
    public function buy(Product $product, ProductRepository $productRepository)
    {
        $product->buy();
        
        return success();
    }
}

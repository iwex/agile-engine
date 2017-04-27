<?php

namespace App\Http\Api\Controllers\Product;

use App\Http\Api\Responses\Transformers\ProductTransformer;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;

class ListController extends Controller
{
    protected $perPage = 25;
    
    /**
     * GET /products
     *
     * Get list of all products
     *
     * @param \App\Repositories\ProductRepository $productRepository
     *
     * @return \App\Http\Api\Responses\ArrayResponse
     */
    public function index(ProductRepository $productRepository)
    {
        $products = $productRepository->with(['vouchers', 'vouchers.discountTier'])->findAll();
        
        return fractalResponse($products, ProductTransformer::class);
    }
}

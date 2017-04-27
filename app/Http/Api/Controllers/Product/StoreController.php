<?php

namespace App\Http\Api\Controllers\Product;

use App\Http\Api\Requests\Product\StoreProductRequest;
use App\Http\Api\Responses\Transformers\ProductTransformer;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    /**
     * POST /products
     *
     * Create new product
     *
     * @param \App\Http\Api\Requests\Product\StoreProductRequest $request
     * @param \App\Repositories\ProductRepository $productRepository
     *
     * @return \App\Http\Api\Responses\ArrayResponse
     */
    public function store(StoreProductRequest $request, ProductRepository $productRepository)
    {
        $toSave  = $request->only('name', 'price');
        $product = $productRepository->create($toSave);
        
        return fractalResponse($product, ProductTransformer::class, Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Api\Controllers\Product;

use App\Http\Api\Requests\Product\BindVouchersRequest;
use App\Http\Api\Requests\Product\RemoveBindVouchersRequest;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\ProductRepository;

class BindVoucherController extends Controller
{
    /**
     * @var \App\Repositories\ProductRepository
     */
    protected $productRepository;
    
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    /**
     * PATCH /products/{product}/vouchers
     *
     * Add vouchers to product
     *
     * @param \App\Models\Product $product
     * @param \App\Http\Api\Requests\Product\BindVouchersRequest $request
     *
     * @return \App\Http\Api\Responses\SuccessResponse
     */
    public function bind(Product $product, BindVouchersRequest $request)
    {
        $voucherIds = $request->input('voucher_ids');
        
        $product->vouchers()->attach($voucherIds);
        $this->productRepository->forgetCache();
        
        return success();
    }
    
    /**
     * DELETE /products/{product}/vouchers
     *
     * Detach vouchers from product
     *
     * @param \App\Models\Product $product
     * @param \App\Http\Api\Requests\Product\RemoveBindVouchersRequest $request
     *
     * @return \App\Http\Api\Responses\SuccessResponse
     */
    public function removeBinding(Product $product, RemoveBindVouchersRequest $request)
    {
        $voucherIds = $request->input('voucher_ids');
        
        $product->vouchers()->detach($voucherIds);
        $this->productRepository->forgetCache();
        
        return success();
    }
}

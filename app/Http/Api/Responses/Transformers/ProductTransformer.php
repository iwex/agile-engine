<?php

namespace App\Http\Api\Responses\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'vouchers'
    ];
    
    public function transform(Product $product)
    {
        return [
            'id'    => $product->id,
            'name'  => $product->name,
            'price' => $product->discountedPrice()
        ];
    }
    
    public function includeVouchers(Product $product)
    {
        $vouchers = $product->vouchers;
        
        return fractalCollection($vouchers, VoucherTransformer::class)->getResource();
    }
}
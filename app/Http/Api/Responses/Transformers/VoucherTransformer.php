<?php

namespace App\Http\Api\Responses\Transformers;

use App\Models\Voucher;
use League\Fractal\TransformerAbstract;

class VoucherTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'discountTiers'
    ];
    
    public function transform(Voucher $voucher)
    {
        return [
            'id'         => $voucher->id,
            'start_date' => $voucher->start_date->timestamp,
            'end_date'   => $voucher->end_date->timestamp,
        ];
    }
    
    public function includeDiscountTiers(Voucher $voucher)
    {
        $discountTier = $voucher->discountTier;
        
        return fractalItem($discountTier, DiscountTierTransformer::class)->getResource();
    }
}
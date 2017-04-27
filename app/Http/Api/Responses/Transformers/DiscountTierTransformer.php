<?php

namespace App\Http\Api\Responses\Transformers;

use App\Models\DiscountTier;
use League\Fractal\TransformerAbstract;

class DiscountTierTransformer extends TransformerAbstract
{
    public function transform(DiscountTier $tier)
    {
        return [
            'id'      => $tier->id,
            'percent' => $tier->percent
        ];
    }
}
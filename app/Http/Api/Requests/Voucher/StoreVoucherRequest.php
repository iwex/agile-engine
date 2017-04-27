<?php

namespace App\Http\Api\Requests\Voucher;

use App\Http\Api\Requests\Request;
use Illuminate\Validation\Rule;

class StoreVoucherRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'discount_tier_id' => ['required', Rule::exists('discount_tiers', 'id')],
            'start_date'       => 'required|date',
            'end_date'         => 'required|date|after:start_date',
        ];
    }
}

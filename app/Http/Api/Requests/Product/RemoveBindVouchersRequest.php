<?php

namespace App\Http\Api\Requests\Product;

use App\Http\Api\Requests\Request;
use Illuminate\Validation\Rule;

class RemoveBindVouchersRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'voucher_ids'   => 'required|array',
            'voucher_ids.*' => Rule::exists('vouchers', 'id')
        ];
    }
}

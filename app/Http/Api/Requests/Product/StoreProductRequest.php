<?php

namespace App\Http\Api\Requests\Product;

use App\Http\Api\Requests\Request;

class StoreProductRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|max:255',
            'price' => 'required|numeric'
        ];
    }
}

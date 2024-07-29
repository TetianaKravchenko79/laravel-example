<?php

namespace App\Http\Requests;

class CartRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'product_id' => 'required|numeric',      
            'size_id' => 'required|numeric',
            'qty' => 'required|numeric'             
        ];
    }
}

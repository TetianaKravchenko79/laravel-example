<?php

namespace App\Http\Requests;

class ChangePasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'password' => 'required|min:8|string|confirmed',      
                        
        ];
    }
}

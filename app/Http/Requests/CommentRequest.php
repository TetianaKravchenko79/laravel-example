<?php

namespace App\Http\Requests;

class CommentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'comment' => 'required',  
            'rating' => 'in:0,1,2,3,4,5',           
        ];
    }

    public function messages()
    {
          return [
            'comment.required' => 'Field New Comment must be filled in!',
            'rating.in' => 'Only values 0,1,2,3,4,5!',
          ];
    }
}

<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class GenerateSlugRequest extends FormRequest
{
    public function authorize() : bool
    {
        return isAdmin();
    }

    public function rules() : array
    {
        return [
            'name' => [
                'required',
                'string',
                'filled',
            ]
        ];
    }
}

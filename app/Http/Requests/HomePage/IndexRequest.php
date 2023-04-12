<?php

namespace App\Http\Requests\HomePage;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categories' => [
                'array',
            ],
            'min_price' => [
                'integer',
            ],
            'max_price' => [
                'integer',
            ],
        ];
    }
}

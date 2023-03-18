<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name'        => [
                'bail',
                'required',
                'string',
            ],
            'description' => [
                'bail',
                'required',
                'string',
            ],
            'price'       => [
                'bail',
                'required',
                'numeric',
            ],
            'slug'        => [
                'bail',
                'required',
                'string',
                Rule::unique(Product::class)->ignore($this->product),
            ],
            'image'       => [
                'bail',
                'nullable',
                'file',
                'image',
            ],
            'category_id' => [
                'required',
                Rule::exists(Category::class, 'id'),
            ],
        ];
    }
}

<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
            ],
            'description' => [
                'bail',
                'required',
                'string',
            ],
            'price' => [
                'bail',
                'required',
                'numeric',
            ],
            'slug' => [
                'bail',
                'required',
                'string',
                'unique:App\Models\Product,slug',
            ],
            'image' => [
                'bail',
                'required',
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

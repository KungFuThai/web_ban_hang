<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestroyRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'category' => [
                'required',
                Rule::exists(Category::class,'id'),
            ],
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge(['category' => $this->route('category')]);
    }
}

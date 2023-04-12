<?php

namespace App\Http\Requests\Producer;

use App\Models\Producer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestroyRequest extends FormRequest
{
    public function authorize() : bool
    {
        return isSuperAdmin();
    }

    public function rules() : array
    {
        return [
            'producer' => [
                'required',
                Rule::exists(Producer::class,'id'),
            ],
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge(['producer' => $this->route('producer')]);
    }
}

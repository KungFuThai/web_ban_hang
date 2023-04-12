<?php

namespace App\Http\Requests\Producer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return isAdmin();
    }

    public function rules(): array
    {
        return [
            'name'    => [
                'bail',
                'required',
                'string',
                'unique:App\Models\Producer,name',
            ],
            'phone'   => [
                'bail',
                'required',
                'regex:/(0)[0-9]{9}/',
                'min:10',
                'unique:App\Models\Producer,phone',
            ],
            'address' => [
                'bail',
                'required',
                'string',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'    => '"tên nhà cung cấp"',
            'phone'   => '"số điện thoại nhà cung cấp"',
            'address' => '"địa chỉ nhà cung cấp"',
        ];
    }
}

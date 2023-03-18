<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name'  => [
                'bail',
                'required',
                'string',
            ],
            'first_name' => [
                'bail',
                'required',
                'string',
            ],
            'phone'      => [
                'bail',
                'required',
                'regex:/(0)[0-9]{9}/',
                'min:10',
                'unique:App\Models\Admin,phone',
            ],
            'address'    => [
                'bail',
                'required',
                'string',
            ],
            'gender'     => [
                'bail',
                'required',
                'boolean',
            ],
            'email'      => [
                'bail',
                'required',
                'string',
                'unique:App\Models\Admin,email',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'last_name'  => '"họ và lót"',
            'first_name' => '"tên"',
            'phone'      => '"số điện thoại"',
            'address'    => '"địa chỉ"',
            'gender'     => '"giới tính"',
            'email'      => '"email"',
        ];
    }
}

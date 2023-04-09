<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'email'    => [
                'bail',
                'required',
                'string',
                Rule::exists(Customer::class, 'email'),
            ],
            'password' => [
                'bail',
                'required',
                'string',
            ],
        ];
    }
    public function attributes(): array
    {
        return [
            'email'      => '"email"',
            'password'      => '"mật khẩu"',
        ];
    }
}

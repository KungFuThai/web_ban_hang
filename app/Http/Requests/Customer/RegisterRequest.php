<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'last_name'    => [
                'bail',
                'required',
                'string',
            ],
            'first_name'    => [
                'bail',
                'required',
                'string',
            ],
            'phone'      => [
                'bail',
                'required',
                'regex:/(0)[0-9]{9}/',
                'min:10',
                'unique:App\Models\Customer,phone',
            ],
            'email'    => [
                'bail',
                'required',
                'string',
                Rule::unique(Customer::class, 'email'),
            ],
            'password'    => [
                'bail',
                'required',
                'string',
                'confirmed',
            ],
        ];
    }
    public function attributes(): array
    {
        return [
            'last_name'      => '"họ và lót"',
            'first_name'      => '"tên"',
            'phone'      => '"số điện thoại"',
            'email'      => '"email"',
            'password'      => '"mật khẩu"',
        ];
    }
}

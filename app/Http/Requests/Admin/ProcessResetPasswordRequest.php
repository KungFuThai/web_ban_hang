<?php

namespace App\Http\Requests\Admin;

use App\Models\Customer;
use App\Models\ForgetPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProcessResetPasswordRequest extends FormRequest
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
            'token'    => [
                'required',
                'string',
                Rule::exists(ForgetPassword::class, 'token'),
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
            'password'      => '"mật khẩu"',
        ];
    }
}

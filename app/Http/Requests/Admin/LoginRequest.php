<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            'email'    => [
                'bail',
                'required',
                'string',
                Rule::exists(Admin::class, 'email'),
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

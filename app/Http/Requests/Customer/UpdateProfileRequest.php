<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isCustomer();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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
            'birth_date' => [
                'bail',
                'nullable',
                'date',
                'before:today',
            ],
            'address'    => [
                'bail',
                'nullable',
                'string',
            ],
            'gender'     => [
                'bail',
                'nullable',
                'boolean',
            ],
            'avatar'     => [
                'bail',
                'nullable',
                'file',
                'image',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'last_name'    => '"họ và lót"',
            'first_name' => '"tên"',
            'birth_date' => '"ngày sinh"',
            'address' => '"địa chỉ"',
            'gender' => '"giới tính"',
            'avatar' => '"avatar"',
        ];
    }
}

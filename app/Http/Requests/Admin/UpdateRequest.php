<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                Rule::unique(Admin::class)->ignore($this->admin),
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
                Rule::unique(Admin::class)->ignore($this->admin),
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
